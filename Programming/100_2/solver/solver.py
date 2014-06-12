import socket
import sys

def cleanup(code):
  return filter(lambda x: x in ['.', ',', '[', ']', '<', '>', '+', '-'], code)

def buildbracemap(code):
  temp_bracestack, bracemap = [], {}

  for position, command in enumerate(code):
    if command == "[": temp_bracestack.append(position)
    if command == "]":
      start = temp_bracestack.pop()
      bracemap[start] = position
      bracemap[position] = start
  return bracemap

def evaluate_bf(code):

  retval = ""
  code     = cleanup(list(code))
  bracemap = buildbracemap(code)

  cells, codeptr, cellptr = [0], 0, 0

  while codeptr < len(code):
    command = code[codeptr]
    if command == ">":
      cellptr += 1
      if cellptr == len(cells): cells.append(0)

    if command == "<":
      cellptr = 0 if cellptr <= 0 else cellptr - 1

    if command == "+":
      cells[cellptr] = cells[cellptr] + 1 if cells[cellptr] < 255 else 0

    if command == "-":
      cells[cellptr] = cells[cellptr] - 1 if cells[cellptr] > 0 else 255

    if command == "[" and cells[cellptr] == 0: codeptr = bracemap[codeptr]
    if command == "]" and cells[cellptr] != 0: codeptr = bracemap[codeptr]
    if command == ".": retval += chr(cells[cellptr])
    if command == ",": cells[cellptr] = ord(getch.getch())
      
    codeptr += 1
  return retval

t = []
for i in range(4000):
	s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
	s.connect(('localhost',1234))
	c = s.recv(1024).strip()
	t.append(evaluate_bf(c))
	s.close()

print "solution:"

out = "sqr"
for i in range(1,2000):
    for x in t:
        if x[0] == out[i] and x[1] == out[i+1]:
            out += x[2]
            break
    else:
        break
print out