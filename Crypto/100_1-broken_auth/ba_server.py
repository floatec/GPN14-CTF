# -*- coding: utf-8 -*-
import SocketServer
import sys
import gnupg
from Crypto.Cipher import AES
from Crypto import Random
import base64
import threading

# apt-get install gpg
# pip install Crypto python-gnupg
KEY = "sqrts{968c4bff9d3b67d285dfe24482c3f239}"

users = (
    ('Alice', 5668, 'bernd@none'),
    ('Bernd', 5669, 'alice@none')
)

NONCE_LENGTH = AES.block_size/2
RESP_DECODE_ERR = "You screwed up your encoding or something :-("
RESP_KEY = "And this is why you shouldn't roll your own crypto. By the way, you are probably looking for this: %s" % KEY
RESP_WRONG_NONCE = "That's wrong! I cannot trust you!"
RESP_BROKEN_CRYPTO = "Can't read that. Wrong encryption?"
RESP_HELLO = "Hello, this is %s! Please provide your challenge."
RESP_ENCODING_ERR = "Your encoding seems to be broken. Use utf-8 (mind gpg?)"

def pad(BS, s):
    return s + (BS - len(s) % BS) * chr(BS - len(s) % BS) 
lid = 0

class BrokenAuthEndpoint(SocketServer.BaseRequestHandler):
    def decrypt(self, e):
        d = self.server.gpg.decrypt(
            base64.b64decode(e),
            always_trust=True
        )
        data = str(d.data)
        if not d.ok or len(data) != NONCE_LENGTH:
            return None
        return data

    def encrypt(self, d):
        e = str(self.server.gpg.encrypt(
            d,
            self.server.mail,
            always_trust=True,
            armor=True
        ))
        return base64.b64encode(e)+"\n"

    def handle(self):
        global lid
        cur_thread = lid
        lid += 1
        ra = Random.new()
        fsock = self.request.makefile()
        
        print "[%4d] connection from %s" % (cur_thread, self.request.getpeername())

        try:
            fsock.write((RESP_HELLO % self.server.user)+"\n")
            fsock.flush()
            
            user_chal_nonce  = fsock.readline().rstrip()
            user_chal_key    = fsock.readline().rstrip()
            
            try:
                user_nonce = self.decrypt(user_chal_nonce)
                user_key   = self.decrypt(user_chal_key)
            except TypeError:
                print "[%4d] decode error" % (cur_thread)
                fsock.write(RESP_DECODE_ERR+"\n")
                fsock.flush()
                fsock.close()
                return

            
            #print "[%4d] user challenge" % (cur_thread)

            if None in (user_nonce, user_key):
                print "[%4d] crypto error" % (cur_thread)
                fsock.write(RESP_BROKEN_CRYPTO+"\n")
                fsock.flush()
                fsock.close()
                return

            server_nonce    = ra.read(NONCE_LENGTH)
            server_key      = ra.read(NONCE_LENGTH)
            
            fsock.write(base64.b64encode(user_nonce)+"\n")
            fsock.write(self.encrypt(server_nonce))
            fsock.write(self.encrypt(server_key))
            fsock.flush()

            #print "[%4d] server challenge" % (cur_thread)

            try:
                server_nonce_compare = base64.b64decode(fsock.readline().rstrip())
                #print "[%4d] user verification nonce" % (cur_thread)
                if server_nonce != server_nonce_compare:
                    print "[%4d] nonce wrong" % (cur_thread)
                    fsock.write(RESP_WRONG_NONCE+"\n")
                    fsock.flush()
                    return
            except TypeError:
                print "[%4d] decode error" % (cur_thread)
                fsock.write(RESP_DECODE_ERR+"\n")
                fsock.flush()
                return

            iv  = ra.read(AES.block_size)
            aes = AES.new(user_key + server_key, AES.MODE_CBC, iv)

            symm_msg = pad(AES.block_size, RESP_KEY)
            symm_msg = aes.encrypt(symm_msg)

            print "[%4d] sent flag" % (cur_thread)

            fsock.write(base64.b64encode(iv)+"\n")
            fsock.write(base64.b64encode(symm_msg)+"\n")
            fsock.flush()
        except IOError, e:
            print "[%4d] disconnect due to error: %s" % (cur_thread, str(e))
        except UnicodeDecodeError, e:
            fsock.write(RESP_ENCODING_ERR+"\n")
            fsock.flush()
            fsock.close()
            return

class ThreadedTCPServer(SocketServer.ThreadingMixIn, SocketServer.TCPServer):
    pass

if __name__ == "__main__":
    if len(sys.argv) < 2:
        print "specify user id 0/1"
        sys.exit(1)

    user        = users[int(sys.argv[1])]
    gpg         = gnupg.GPG(gnupghome='./%s-gpg' % user[0], use_agent=False)
    gpg.encoding = 'utf-8'

    SocketServer.TCPServer.allow_reuse_address = True
    server      = ThreadedTCPServer(("", user[1]), BrokenAuthEndpoint)
    server.user = user[0]
    server.mail = user[2]
    server.gpg  = gpg
    print "listening on", server.server_address

    server.serve_forever()

    server.shutdown()

    