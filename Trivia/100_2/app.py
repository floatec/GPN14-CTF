import time
import datetime
import math
import os
import hashlib

from flask import Flask, render_template, request
from PIL import Image
import PIL.ExifTags

# easy_install flask PIL
FLAG = "sqrts{02ad35dc002a5b20e522e67ba70ca1c7}"
SAVE_TO = "./imgs"
CMP_DIST = 3000.0
CMP_DAT_START = "2014:06:09 00:00:00"
CMP_DAT_END = "2014:06:15 23:59:59"

# DO NOT CHANGE BELOW
R = 6371
CMP_LAT = -90.0
CMP_LON = 0.0
CMP_LAT_RAD = math.radians(CMP_LAT)
CMP_TIME_START = time.mktime(datetime.datetime.strptime(CMP_DAT_START, "%Y:%m:%d %H:%M:%S").timetuple())
CMP_TIME_END = time.mktime(datetime.datetime.strptime(CMP_DAT_END, "%Y:%m:%d %H:%M:%S").timetuple())

app = Flask(__name__)
# 2 MiB file size limit
app.config['MAX_CONTENT_LENGTH'] = 2 * 1024 * 1024

def degminsec_to_deg(v):
    format_val = lambda x: float(x[0]) / float(x[1])
    pos_fulldeg = format_val(v[0])
    pos_min = format_val(v[1])
    pos_sec = format_val(v[2])

    return pos_fulldeg + pos_min/60 + pos_sec/3600

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/upload', methods=['POST'])
def upload():
    if not 'file' in request.files.keys():
        return "No file uploaded.", 400
    try:
        img = Image.open(request.files['file'].stream)
    except (OSError, IOError):
        return "Invalid file type", 415

    exif = {
        PIL.ExifTags.TAGS[k]: v
        for k, v in img._getexif().items()
        if k in ExifTags.TAGS
    }

    try:
        img_time = time.mktime(datetime.datetime.strptime(exif.get("DateTimeOriginal", ""), "%Y:%m:%d %H:%M:%S").timetuple())
        gps_lat = exif["GPSInfo"][2]
        gps_d1  = exif["GPSInfo"][1]
        gps_lon = exif["GPSInfo"][4]
        gps_d2  = exif["GPSInfo"][3]

        lat_deg = degminsec_to_deg(gps_lat)
        lon_deg = degminsec_to_deg(gps_lon)
    except (ValueError, KeyError):
        return "Bad image format", 400

    if gps_d1 == "S":
        lat_deg *= -1
    if gps_d2 == "W":
        lon_deg *= -1

    lat_rad = math.radians(lat_deg)
    
    diff_lat = math.sin(math.radians(lat_deg-CMP_LAT)/2.0)
    diff_lon = math.sin(math.radians(lon_deg-CMP_LON)/2.0)

    a = diff_lat * diff_lat + math.cos(lat_rad) * math.cos(CMP_LAT_RAD) \
         * diff_lon * diff_lon
    c = 2 * math.atan2(math.sqrt(a), math.sqrt(1-a))
    d = R * c

    
    if d < CMP_DIST and CMP_TIME_START < img_time < CMP_TIME_END:
        if request.form.get("hide", u"off") != u"on":
            img.save(os.path.join(SAVE_TO, "%s.jpg" % hashlib.md5(repr(request.headers)).hexdigest()))

        return "Yep, you really were there! The flag is %s" % FLAG
    

    return "Your image is wrong!", 400

if __name__ == '__main__':
    app.run(host='0.0.0.0', debug=False)
