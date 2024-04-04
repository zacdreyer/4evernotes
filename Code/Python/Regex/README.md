## Regex in Python

Import
```
import re
```

String
```
re.search('^Regex', string):
```

Bytes
```
re.search(rb’^Regex', string):
```


Example: Search for command line output
```
import subprocess
import re
cmd = subprocess.Popen(['perldoc', '-l', module],
                       stdout=subprocess.PIPE,
                       stderr=subprocess.STDOUT)
stdout, stderr = cmd.communicate()
if stderr != 'None':
    if re.search(rb'^/', stdout):
        return True
return False
```
