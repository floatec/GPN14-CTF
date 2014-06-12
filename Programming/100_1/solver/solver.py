__author__ = 'floatec'
from StringIO import StringIO
from PIL import Image
import requests

s = requests.session()
rq = s.get('http://localhost/colorful%20live/image.php')
i = Image.open(StringIO(rq.content))
rgb_im = i.convert('RGB')

r, g, b = rgb_im.getpixel((1, 1))

print r, g, b
payload = {'r': r, 'g': g,'b':b}
rq = s.post("http://localhost/colorful%20live/validate.php", data=payload)
print rq.text