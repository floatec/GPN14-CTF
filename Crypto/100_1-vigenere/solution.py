from itertools import product
import string

f = open('enc', 'r')
data = f.read()
f.close()

mono_alpha = {}

for i in range(6):
  mono_alpha[i] = []

for i in range(len(data)):
  mono_alpha[i%6].append(data[i])

results = []


# Find char for which the result is printiable, when XORd with the encoded data

for i in range(len(mono_alpha)):
  curr = []
  for p in string.ascii_lowercase:
    if all(chr(c) in string.printable for c in map(lambda x: ord(p) ^ ord(x), mono_alpha[i])):
      curr.append(p)
  results.append(curr)

test_string = data[:42]

# Test combination of first 4 letters (easier to spot viable candidate)

for candidate in product(results[0], results[1], results[2], results[3]):
  string = ''
  for i in range(len(candidate)):
    string =  string + chr(ord(candidate[i]) ^ ord(test_string[i]))
  print string, candidate

print '#################'

# Find result => fix 'glad' (because starting with "This" makes sense)

for candidate in product(results[4], results[5]):
  key = 'glad' + candidate[0] + candidate[1]
  decode = ''
  for i in range(len(test_string)):
    decode = decode + chr(ord(key[i%len(key)]) ^ ord(test_string[i]))
  print '=========================='
  print decode
  print 'Key:' + key

# decode text and write in file

key = 'glados'
decoded = ''
for i in range(len(data)):
  decode = decode + chr(ord(key[i%len(key)]) ^ ord(data[i]))

f = open('win', 'w')
f.write(decode)
f.close()
