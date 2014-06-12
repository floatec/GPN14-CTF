#apt-get install python-opencv python-scipy python-pygame python-setuptools python-zbar
#easy_install SimpleCV

import time
from SimpleCV import Image, Camera, Display

display = Display((800,600))
cam = Camera()

while True:
	#img = cam.getImage()
	img = Image("qr.png")
	barcode = img.findBarcode()
	if barcode:
		data = str(barcode[0].data)
		barcode.draw()
		img.drawText("\'%s\' detected." % data, 10, 10, fontsize=30)
		#activate challenge here
	img.save(display)
	time.sleep(1.0)
