## Install & Use HTTrack To Download Websites
Install HTTrack
```
sudo apt-get install httrack
```

Download Website (with 1 external link)
```
httrack --ext-depth=1 http://winapp.com
```
ext-depth is how deep it should go (external links follow) when downloading