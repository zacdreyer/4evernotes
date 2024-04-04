## Execute System Commands

Import:
```
import os
import platform
import subprocess
```

Code:
```
cmd = os.system(‘ls -l /’)
```

Try Code:
```
try:
    subprocess.call(["wget", "your", "parameters", "here"])
except OSError as e:
    if e.errno == errno.ENOENT:
        # handle file not found error.
    else:
        # Something else went wrong while trying to run `wget`
        raise
```

Code For Output:
```
cmd = subprocess.Popen(['perldoc', '-l', module],
                       stdout=subprocess.PIPE,
                       stderr=subprocess.STDOUT)
stdout, stderr = cmd.communicate()
print(stdout)
```
