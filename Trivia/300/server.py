#apt-get install python-opencv python-scipy python-pygame python-setuptools python-zbar
#easy_install SimpleCV

import time
import os
import hashlib
from SimpleCV import Image, Camera, Display

SAVE_TO = "./imgs"

display = Display((800,600))
cam = Camera()

while True:
	img = cam.getImage()
	#img = Image("qr.png")
	barcode = img.findBarcode()
	if barcode:
		data = str(barcode[0].data)
		#save image for projection
		img.save(os.path.join(SAVE_TO, hashlib.md5(str(time.time())).hexdigest()))

		#show recognition
		barcode.draw()
		img.drawText("\'%s\' detected." % data, 10, 10, fontsize=30)

		#activate challenge here

	#show on screen
	img.save(display)
	time.sleep(1.0)
