

def translate1(input):
    '''Simplest possible way - using one cell - long source strings'''

    input = [ord(char) for char in input]

    output = []
    last_letter = 0

    for letter in input:

        if letter > last_letter:
            output += ['+'] * (letter - last_letter)

        elif letter < last_letter:
            output += ['-'] * (last_letter - letter)

        output.append('.')

        last_letter = letter

    return ''.join(output)


def translate2(input):
    '''Smarter solution - first load cells with some values - and then use
    the closest ones to print the text'''

    # output = list('++++++++++[>+++++++>++++++++++>+++>+<<<<-]')
    # cells = [0, 70, 100, 30, 10]

    pointer_position = 0

    #output = list('++++++++++++++++++[>++>+++>++++>+++++<<<<-]++++++++++++++++++')
    #cells = [18, 36, 54, 72, 90]
    #output = list('++++++++++[>+++++++>++++++++++>+++>+<<<<-]')
    #cells = [0, 70, 100, 30, 10]
    output = list('++++++++[>++++++>++++++++++++<<-]')
    cells = [0, 48, 96]
    for letter in [ord(char) for char in input]:

        # find index of the closest value in cells
        closest = min(range(len(cells)), key=lambda i: abs(cells[i] - letter))

        # move ptr to it
        delta = pointer_position - closest

        if delta > 0:
            output += ['<'] * delta
        else:
            output += ['>'] * -delta

        pointer_position = closest

        # inc/dec value of cell
        delta = letter - cells[pointer_position]

        if delta > 0:
            output += ['+'] * delta
        else:
            output += ['-'] * -delta

        cells[pointer_position] = letter

        output += ['.']

    return ''.join(output)


if __name__ == '__main__':
    print translate2('ts{')