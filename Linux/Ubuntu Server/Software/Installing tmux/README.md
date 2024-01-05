Install
```
apt-get install tmux
```

Config
```
nano ~/.tmux.conf
```
-paste:
```
# remap prefix to Control + a
set -g prefix C-a
unbind C-b
bind C-a send-prefix


# force a reload of the config file
unbind r
bind r source-file ~/.tmux.conf


# quick pane cycling
unbind ^A
bind ^A select-pane -t :.+
```

UI
```
mkdir ~/tmux
```
- new command:
```
nano ~/tmux/new
```
-- paste:
```
#!/bin/bash


clear
echo Create New TMUX Session
echo -----------------------
echo "Please name your new session"
read -p '>> ' session_name


tmux new -s $session_name
```
- resume command:
```
nano ~/tmux/resume
```
— paste:
```
#!/bin/bash


clear
echo "Resume TMUX Session"
echo "-------------------"
echo ""
tmux list-sessions
echo ""
echo "-------------------"
echo "Please enter the session name"
read -p '>> ' session_name


tmux attach -t $session_name
```
- set permissions
```
chmod 777 ~/tmux/ -R
```

UI from github
```
git clone https://github.com/zacdreyer/tmux-ui.git ~/tmux
```
- set permissions
```
chmod 777 ~/tmux/ -R
```
