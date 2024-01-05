## Install Bash-it
Initial
```
nano ~/.bash_profile
Add >>
if [ -f ~/.bashrc ]; then
  . ~/.bashrc
fi

git clone --depth=1 https://github.com/Bash-it/bash-it.git ~/.bash_it
~/.bash_it/install.sh
```

Modify Config
```
nano ~/.bashrc
```

Updating
```
bash-it update
```

Migrate from older version
```
bash-it migrate
```


Source: https://github.com/Bash-it/bash-it