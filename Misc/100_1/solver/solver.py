from PIL import Image
from os import listdir
from os.path import isfile, join


onlyfiles = [ f for f in listdir('.') if isfile(join('.',f)) and f.endswith('.png')]

donefiles = []

for a in onlyfiles:

	ima = Image.open(a)
	pixa = ima.load()
	for b in onlyfiles:
		if a == b or b in donefiles:
			continue
		print "comparing: ",a,b, "  => ",
		whitecount = 0
		imb = Image.open(b)
		pixb = imb.load()

		for x in range(ima.size[0]):
			for y in range(ima.size[1]):
				f = pixa[x,y]
				g = pixb[x,y]
				if f[0] + g[0] >= 255 and f[1] + g[1] >= 255 and f[2] + g[2] >= 255:
					whitecount += 1
		print whitecount,

		if whitecount >= 33000:
			print "<================",
		print
	donefiles.append(a)
