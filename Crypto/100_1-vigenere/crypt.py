text = ''
f = open('text.txt', 'r')
text = f.read()
f.close()

key = 'glados'

enc = ''
for i in range(len(text)):
  c = chr(ord(text[i]) ^ ord(key[i%len(key)]))
  enc = enc + c

f = open('enc', 'w')
f.write(enc)
f.flush()
f.close()
