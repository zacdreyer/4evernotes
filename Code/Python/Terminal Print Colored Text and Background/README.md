## Terminal Print Colored Text and Background

Display Colour Table
```
def print_format_table():
    """
    prints table of formatted text format options
    """
    for style in range(8):
        for fg in range(30, 38):
            s1 = ''
            for bg in range(40, 48):
                format = ';'.join([str(style), str(fg), str(bg)])
                s1 += '\x1b[%sm %s \x1b[0m' % (format, format)
            print(s1)
        print('\n')
  
print_format_table()
```

Colour Class
```
class bcolors:
    HEADER = '\033[1;33;44m'
    FOOTER = '\033[1;30;43m'
    PLAIN = '\033[0;37;40m'
    BOLD = '\033[1;37;40m'
    PASSED = '\033[1;33;42m'
    FAILED = '\033[1;33;41m'
    ENDC = '\033[0m'
```

Colour Output
```
print(bcolors.HEADER + '=' * length + bcolors.ENDC)
```
