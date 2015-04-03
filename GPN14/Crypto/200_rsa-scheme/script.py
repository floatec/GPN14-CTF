import os

files = os.listdir('./files')

class bcolors:
    HEADER = '\033[95m'
    OKBLUE = '\033[94m'
    OKGREEN = '\033[92m'
    WARNING = '\033[93m'
    FAIL = '\033[91m'
    ENDC = '\033[0m'

nums = []
for file in files:
  f = open('./files/' + file, 'r')
  nums.append((int(f.read().strip()), file))
  f.close()

m = 48178053614270249105223164288953659473
d = 4467425933095040278527570182371257905
n = 53633566352303236952836378986267311063

def encode(number, m, n):
  print '================================================================='
  print '>      ' + bcolors.HEADER + 'SECURE ENCRYPTION v.0.0.1' + bcolors.ENDC
  print '================================================================='
  print 'Encrypting ' + bcolors.OKGREEN + number[1] + bcolors.ENDC
  print 'm=' + bcolors.OKBLUE + str(m) + bcolors.ENDC
  print 'N=' + bcolors.OKBLUE + str(n) + bcolors.ENDC
  print '...' * len(str(number[0])) * 15
  print 'Encrypted to: ' + bcolors.WARNING + str(pow(number[0], m, n)) + bcolors.ENDC
  print '================================================================='
for t in nums:
  encode(t, m, n)
