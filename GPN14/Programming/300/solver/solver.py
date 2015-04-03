#!/usr/bin/env python
import socket
import random
import time
import random
import re
import copy
import sys
from operator import itemgetter

availnumbers = {}
rightpos = {}
inlist = {}
guess = []
places = {}
#1-4 #position
#8 unknown pos
#9 not in list
#6 in list but not right place

searchnumbers = 4

def initialise():
    global availnumbers,rightpos,inlist,guess,places
    #print "intitalising"
    for i in range(0,10):
        availnumbers[i] = 8 # not in list
    rightpos = {}
    inlist = {}
    guess = []
    places = {}

def makeguess(sock):
    global guess,availnumbers,inlist,rightpos,places
#    if not inlist and not rightpos: #if inlist is empty
#        sock.send('1234')
#        guess = [1,2,3,4]
#        del availnumbers[1]
#        del availnumbers[2]
#        del availnumbers[3]
#        del availnumbers[4]
#        print availnumbers
#    else:
    #print "blubb", len(rightpos.keys()) + len(inlist.keys()) , len(availnumbers.keys())
    if len(rightpos.keys()) + len(inlist.keys()) < searchnumbers and len(availnumbers.keys()) > searchnumbers:
        ans = ""
        guess = []        
        for x in range(0,searchnumbers):
            keys = availnumbers.keys()
            random.shuffle(keys)
            key = keys[0]
            #print key, keys
            ans += str(key)
            guess.append(key)
            #print "deleting:", keys[x]
            del availnumbers[key]

        #print "sending "+ans
        sock.send(ans)
        #print "avail",availnumbers
    elif len(rightpos.keys()) + len(inlist.keys()) < searchnumbers: #check if we have less then the right numbers
        #print "part 2"
        #print "inlist",inlist
        restitems = len(availnumbers.keys()) #number must kept free
        l = {}
        xlist = copy.deepcopy(inlist)

        avpos = {}
        for i in range(0,searchnumbers):
            avpos[i] = i

        #print "xlist",xlist
        if len(xlist.keys()) + restitems < searchnumbers: #we have to less items, so add known position ones
            #print "adding known positions"
            #print len(xlist.keys()), restitems, searchnumbers
            for i in range(len(xlist.keys()) + restitems, searchnumbers):
                #print "range:", i
                for x in rightpos:
                    if rightpos[x] in avpos:
                        l[rightpos[x]] = x
                        del avpos[rightpos[x]]
                        break

        #print "debug ab",availnumbers
        xlist = copy.deepcopy(inlist)
        awpos = copy.deepcopy(avpos)
        #print "debug l",l,"avpos ",avpos
        if len(availnumbers.keys()) < searchnumbers:
            for x in sorted(awpos.keys(), reverse=True):
                for y in availnumbers:
                    #print "debug xy" ,y
                    l[x] = y
                    del avpos[x]
                    del availnumbers[y]
                    break

        else:
            for x in awpos:
                for y in availnumbers:
                    #print "debug xy" ,y
                    l[x] = y
                    del avpos[x]
                    del availnumbers[y]
                    break


        #print "debug l",l,"avpos ",avpos, "xlist", xlist
        awpos = copy.deepcopy(avpos)
      
        for x in awpos:
            #print "xyz",x
            xlist = copy.deepcopy(inlist)
            for z in xlist:
                #print "abc",z
                if xlist[z] != x:
                    #print "debug x",x
                    l[x] = z
                    del avpos[x]
                    #print "omg debug",inlist,z
                    del inlist[z]
                    break


        #after here we add it somewhere without checks
        xlist = copy.deepcopy(inlist)
        awpos = copy.deepcopy(avpos)
        if len(l) < 4: #check for action
            #print "rescue"
            #print l
            m = []
            for x in l:
                m.append(l[x])
            #print "numbers",m
            for i in range(0,searchnumbers):
                #print "checking",i,"in",l
                if i not in l:
                    while True:
                        n = random.randrange(0,10)
                        if n not in m:
                            break
                    #print "setting",i,"to",n
                    l[i] = n
#            if len(availnumbers) > 0:   #check for left availnumbers
#                for i in range(0,searchnumbers):
#                    if in not in l:
#                        l[i] = 
#
#            elif len(xlist) > 0:
#
#            else:

        #print "len(avpos.keys()) != len(availnumbers.keys())",len(avpos.keys()), len(availnumbers.keys())
        availnumbers = {}

        if len(l) < 4:                    
            print "extrem debug part 2, now we have a serious problem avail: ", availnumbers,"inlist: ", inlist,"rightpos: ",rightpos, "outlist", l
            return

        guess = []  
        ans = ""
        for x in l:
            ans += str(l[x])
            guess.append(l[x])
        #print "sending "+ans
        sock.send(ans)     
    else: #less then a full row available, try inlist and remaining ones
        #print "part 3"
        #print "lists",availnumbers,rightpos,inlist
        xlist = copy.deepcopy(inlist)
        avpos = {}
        for i in range(0,searchnumbers):
            avpos[i] = i
        #print "avpos", avpos
        l = {}
        for x in rightpos:
            #print ">>> setting",rightpos[x], "to",x
            l[rightpos[x]] = x
            #print "deleting avpos",rightpos[x], rightpos
            del avpos[rightpos[x]]
        #print "List 1", l    
        #print "places",places, l
        awpos = copy.deepcopy(avpos)      
   
        for x in awpos:
            #print "debug x",x, avpos, xlist
            xlist = copy.deepcopy(inlist)
            for y in xlist:
                #print "checking for",y, "in", places[y]
                if x not in places[y]:
                    #print "><> setting",x, "to",y
                    l[x] = y
                    del avpos[x]
                    #print "omg debug",inlist,y
                    del inlist[y]
                    break                              
                else:
                    continue
        else:
             
           
            #add without checking
            awpos = copy.deepcopy(avpos) 
            for x in awpos:
                xlist = copy.deepcopy(inlist)
                for y in xlist:
                    l[x] = y
                    
                    #print "haha",avpos,x,inlist,y
                    del avpos[x]
                    del inlist[y]
                    break
            #print "we should never reach this"
        #print "List 2", l
        #print "3 l len", len(l)
        if len(l) < 4:
            for i in range(0,searchnumbers):
                #print "debug0r",l
                if i not in l:
                    #print "bla",i,"not in",l
                    for x in rightpos:
                        if rightpos[x] == i:
                            l[i] = rightpos[x]

        if len(l) < 4:                    
            print "extrem debug part 3, now we have a serious problem avail: ", availnumbers,"inlist: ", inlist,"rightpos: ",rightpos, "outlist", l
            return                            
        guess = []
        ans = ""
        for x in l:
            ans += str(l[x])
            guess.append(l[x])
        #print "sending "+ans
        sock.send(ans)        

    #print "abc",availnumbers, rightpos, inlist, places

def parse(sock,data):
    
    if '>> Round' in data:
        print data
        initialise()
        return
    elif 'guess' in data:
        makeguess(sock)
        return
    elif ">>" in data or len(data) == 0:
        return
    elif 'X' not in data and '-' not in data and 'O' not in data:
        print "unknown: "+ data
    m = re.search( r'([-OX ]+ )', data, re.M|re.I)
    #print m
    if m is not None:
        a = m.group(1)
        b = a.split(' ')
        #print "split", b
        for i, x in enumerate(b):
            if x == 'O':
                #print "adding ", guess[i], "to position ",i, "in list"

                #print "special"
                if guess[i] in places:
                    places[guess[i]].add(i)
                else:
                    places[guess[i]] = { i }
                inlist[guess[i]] = i
            elif x == 'X':
                #print "adding ", guess[i], "to position ",i, "in rightpos"
                rightpos[guess[i]] = i

sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
sock.connect((sys.argv[1], int(sys.argv[2])))



while True:
    data = sock.recv(512)
    if not data: break
    d = data.split('\n')
    #print "->"+d
    for x in d:
        parse(sock,x)
