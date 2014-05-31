# -*- coding: utf-8 -*-
import socket
import gnupg
import base64
import sys
from Crypto.Cipher import AES
from Crypto import Random

# apt-get install gpg
# pip install Crypto python-gnupg
users = (
    ('Alice', "localhost", 5668, 'alice@none'),
    ('Bernd', "localhost", 5669, 'bernd@none')
)

NONCE_LENGTH = AES.block_size/2

def unpad(s):
    return s[0:-ord(s[-1])]

def connectTo(user):
    s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    s.connect((user[1], user[2]))
    f = s.makefile()
    f.readline().rstrip()
    return f

def encrypt(gpg, d, t):
    e = str(gpg.encrypt(
        d,
        t,
        always_trust=True,
        armor=True
    ))
    return base64.b64encode(e)+"\n"

def decrypt(gpg, e):
    d = gpg.decrypt(
        base64.b64decode(e),
        always_trust=True
    )
    data = str(d.data)
    if not d.ok or len(data) != NONCE_LENGTH:
        print "crypto error"
        return None
    return data

def decryptBy(user, gpg, data):
    socket  = connectTo(user)
    stuff     = Random.new().read(NONCE_LENGTH)
    
    socket.write(data+"\n")
    socket.write(encrypt(gpg, stuff, user[3]))
    socket.flush()

    data = base64.b64decode(socket.readline().rstrip())
    socket.close()
    return data

if __name__ == "__main__":
    gpg = gnupg.GPG(gnupghome="./solver-gpg", use_agent=False)
    gpg.encoding = 'utf-8'
    ra = Random.new()

    # aquire encrypted key
    s_alice     = connectTo(users[0])

    #just send random stuff, we don't care
    my_key_alice = ra.read(NONCE_LENGTH)
    my_nonce = ra.read(NONCE_LENGTH)

    print "Connected to Alice. My Key: %s, my nonce: %s" % (repr(my_key_alice), repr(my_nonce))
    s_alice.write(encrypt(gpg, my_nonce, users[0][3]))
    s_alice.write(encrypt(gpg, my_key_alice, users[0][3]))
    s_alice.flush()

    print "Server verification nonce:", repr(base64.b64decode(s_alice.readline().rstrip()))
    alice_nonce = decryptBy(users[1], gpg, s_alice.readline().rstrip())
    alice_key   = decryptBy(users[1], gpg, s_alice.readline().rstrip())
    
    print "Decrypted alice challenge: Key: %s, Nonce: %s" % (repr(alice_key), repr(alice_nonce))
    if None in (alice_nonce, alice_key):
        s_alice.close()
        sys.exit(0)
    
    s_alice.write(base64.b64encode(alice_nonce)+"\n")
    s_alice.flush()

    iv   = base64.b64decode(s_alice.readline().rstrip())
    data = base64.b64decode(s_alice.readline().rstrip())

    print "Encrypted message. len: %d" % (len(data))

    cipher = AES.new(my_key_alice+alice_key, AES.MODE_CBC, iv)
    print "Decrypt: ", unpad(cipher.decrypt(data))
    s_alice.close()

    