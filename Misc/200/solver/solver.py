import sys

print sys.argv
if len(sys.argv) != 3:
	print "solver.py input output"
	sys.exit(1)

from Crypto.Cipher import AES

algo = AES.new('steganographyfun', AES.MODE_CBC, '\x9d\x9c>n\xeb!!2,\xd8\xf9\xd0T1\xbd#')

with open(sys.argv[1], "rb") as f:
        d = f.read()

d = algo.encrypt(d)

with open(sys.argv[2], "wb") as f:
        f.write(d)
