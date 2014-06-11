#!/usr/bin/env python

import re
import sys
import math
import random
import SocketServer
import random
import time
import bfc

FLAG = 'sqrts{16f3a102e8cb187da3662be549e417a7}'

class GameHandler(SocketServer.StreamRequestHandler):
    def handle(self):
        random.seed(time.time())
        z = random.randint(0,len(FLAG)-3)
        while z < 5 and random.randint(0,30) != 0:
            z = random.randint(0,len(FLAG)-3)
        self.request.send(bfc.translate2(FLAG[z:z+3])+"\n")
        return


SocketServer.TCPServer.allow_reuse_address = True
httpd = SocketServer.ForkingTCPServer(('', 1234), GameHandler)
print "Server started"
httpd.serve_forever()

