from PIL import Image, ImageFont, ImageDraw
import random
import time
import os
import hashlib
from os import listdir
from os.path import isfile, join
"""
text = 'sqrts{657d88abe56abbba7cb9a5be079df4d3}'

im = Image.new("RGB", (512, 512), "white")
pix = im.load()
draw = ImageDraw.Draw(im)
font = ImageFont.truetype("resources/HelveticaNeueLight.ttf", 12)

draw.text((10, 0), txt, (0,0,0), font=font)

im.save('flag.png')
"""
random.seed(time.time())


fim = Image.open('flag.png')
fpix = fim.load()

im1 = Image.new("RGB", (512, 512), "white")
pix1 = im1.load()

for x in range(im1.size[0]):
	for y in range(im1.size[1]):
		pix1[x,y] = (random.randrange(0,255),random.randrange(0,255),random.randrange(0,255))


im2 = Image.new("RGB",(512,512), "white")
pix2 = im2.load()

for x in range(im1.size[0]):
	for y in range(im1.size[1]):
		c = fpix[x,y]
		if c != (255,255,255):
			t = pix1[x,y]
			pix2[x,y] = (255-t[0],255-t[1],255-t[2])
		else:
			pix2[x,y] = (random.randrange(0,255),random.randrange(0,255),random.randrange(0,255))
im1.save('test.png')
im2.save('test2.png')


for c in range(198):
	imt = Image.new("RGB",(512,512), "white")
	pixt = imt.load()
	for x in range(imt.size[0]):
		for y in range(imt.size[1]):
			pixt[x,y] = (random.randrange(0,255),random.randrange(0,255),random.randrange(0,255))

	imt.save(str(c)+'.png')



onlyfiles = [ f for f in listdir('.') if isfile(join('.',f)) and f.endswith('.png')]

for f in onlyfiles:
	if f == 'flag.png':
		continue



	d = open(f,'r')
	c = d.read()
	d.close()
	md5 = hashlib.md5(c).hexdigest()
	os.rename(f,str(md5)+'.png')
	if f == 'test.png' or f == 'test2.png':
		print "part a is now "+str(md5)