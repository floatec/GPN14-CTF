import requests
from PIL import Image
import subprocess


r = requests.get('http://gigajum.spdns.de/sqrtsctf/index.php')
print "index",r
cookie = r.cookies
r = requests.get('http://gigajum.spdns.de/sqrtsctf/image.php',cookies=cookie)
print "image", r
f = open('img.png','w')
f.write(r.content)
f.close()

im = Image.open("img.png")
pix = im.load()

imo = Image.new('RGB',im.size,"green")
pixo = imo.load()
l = []
for y in range(im.size[1]):
	#print pix[0,y]
	l.append((pix[0,y],y));

#print l
s = sorted(l,key=lambda k: k[0], reverse=True)
#s = sorted(l,key=lambda k: k[0])
#print s
i = 0
for x,y in s:
	#print x,y
	for a in range(im.size[0]):
		pixo[a,i] = pix[a,y]
	i+=1
imo.save('out.png')

proc = subprocess.Popen(['gocr', 'out.png', '-o', 'str.txt'])
proc.wait()
code = ""
with open('str.txt', 'r') as f:
    code = f.read()

#print code
#print len(code)
if len(code.strip()) == 16:
	r = requests.post('http://gigajum.spdns.de/sqrtsctf/index.php',data={'user':'pearce','password':'Elb%hzJ4GL=6/Y+7[AlNu\/uAnF>p:v#1ZdhkOWH','captcha':code.strip()},cookies=cookie)
	print "login",r
	print r.text
else:
	print "ocr failed (length wrong)"