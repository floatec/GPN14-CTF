#!/usr/bin/env python
import SocketServer
import random
import time
import random

port = 1234
d = 4467425933095040278527570182371257905
n = 53633566352303236952836378986267311063

class RSAHandler(SocketServer.StreamRequestHandler):
    def handle(self):
        print "[",time.ctime(),"] new client connected: ", self.client_address
        random.seed(time.time())
        self.request.send('>> Go ahead: give me your encrypted number: \n')
        num = self.request.recv(1024).strip()
        self.request.send(self.decode(num) + '\n')

    def decode(self, encrypt):
      # Blacklist:
      if encrypt == '31319528277563551791166984607206341790':
        return 'The truth? You can\'t handle the truth!'
      if encrypt == '52328194408328484924705300633987824601':
        return 'So you want info about my credit-card? Good luck with that...'
      if encrypt == '13844352034402046597051199604661448400':
        return 'Nope. Just nope!'
      if encrypt == '7835151743034815136837316253595630346':
        return 'Over 9000!'
      #Normal code
      if not encrypt.isdigit():
        return 'Input was not a number.'
      encrypt = long(encrypt)
      if len(str(encrypt)) > 50:
        return 'Sorry, input is too big.'
      num = pow(encrypt, d, n)
      if num == 3133734221:
        return 'Congratulations! Hash this number 3133734221 for the flag.'
      return 'Your decrpyted number is: ' + str(num)


SocketServer.TCPServer.allow_reuse_address = True
httpd = SocketServer.ForkingTCPServer(('', port), RSAHandler)
print "Server started"
httpd.serve_forever()
