#!/usr/bin/env python
import SocketServer
import random
import time
import random
flag = "sqrts{a7564b471df5ed2f3a0189fea0234668}"
number_of_games = 300
guess_per_round = 6
port = 1234

class GameHandler(SocketServer.StreamRequestHandler):
    def handle(self):
        print "[",time.ctime(),"] new client connected: ", self.client_address
        random.seed(time.time())
        self.request.send('>> New game started.\n>> Good luck!\n')
        for round in range(1, number_of_games):
            self.request.send('>> Round '+str(round)+'\n')
            t1 = time.time()
            answer = self.generateAnswer()
            print "[",time.ctime(),", ",self.client_address,"] new value to solve",answer
            #while True:
            for tries in range(1,guess_per_round+1):
                userGuess = self.getUserGuess(tries)
                if userGuess == answer:
                    t2 = time.time()
                    if round > 5 and random.randrange(0,10) > 0 and t2-t1 > 1:
                        self.request.send('>> Game over!\n')    
                        print "[",time.ctime(),", ",self.client_address,"] too slow after round 5"
                        return
                    else:
                        self.request.send('>> Congratulations, you won round '+str(round)+'!\n')#Play another round?'
                        print "[",time.ctime(),", ",self.client_address,"] has won round",round
                        break
                self.request.send('>> The answer you provided is incorrect.\n')
                
                if userGuess is not None:
                    self.request.send('>> Perhaps this hint will help you: \n')
                    self.request.send(self.giveFeedback(answer, userGuess))
            else:
                self.request.send('>> Game over!\n')
                print "[",time.ctime(),", ",self.client_address,"] too many tries"
                return
        self.request.send('>> Congratulations, here is the flag\n')
        self.request.send(flag)

    def generateAnswer(self):
        digits = [str(x) for x in range(10)]
        answer = ''
        for i in range(4):
            digit = random.sample(digits, 1)[0]
            digits.remove(digit)
            answer += digit
        return answer

    def getUserGuess(self,guess):
        #guess = raw_input('>> Please enter a 4-digit number: ').strip()
        self.request.send('guess '+str(guess)+':')
        guess = self.request.recv(1024).strip()
        if len(guess) != 4:
            print "[",time.ctime(),", ",self.client_address,"] client submitted wrong length answer: ",guess
            return None
        guessIsValid = True
        for x in guess:
            if guess.count(x) != 1 or ord(x) not in range(48, 58):
                guessIsValid = False
                break
        if guessIsValid:
            print "[",time.ctime(),", ",self.client_address,"] client submitted valid answer: ",guess
            return guess
        print "[",time.ctime(),", ",self.client_address,"] client submitted invalid answer: ",guess            
        return None

    def giveFeedback(self, answer, guess):
        ret = ""
        for i in range(4):
            if guess[i] == answer[i]:
                ret += 'X '
                continue
            if guess[i] in answer:
                ret += 'O '
                continue
            ret += '- '
        ret += '\n'
        return ret


SocketServer.TCPServer.allow_reuse_address = True
httpd = SocketServer.ForkingTCPServer(('', port), GameHandler)
print "Server started"
httpd.serve_forever()

