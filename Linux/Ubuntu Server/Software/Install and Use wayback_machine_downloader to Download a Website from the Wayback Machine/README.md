## Install and Use wayback_machine_downloader to Download a Website from the Wayback Machine
Install Ruby
```
apt-get install ruby
```

Install Wayback Machine Downloader
```
gem install wayback_machine_downloader
```

Basic Usage
```
wayback_machine_downloader http://example.com
```

Advanced Usage
```
Usage: wayback_machine_downloader http://example.com

Download an entire website from the Wayback Machine.

Optional options:
    -d, --directory PATH             Directory to save the downloaded files into
				     Default is ./websites/ plus the domain name
    -s, --all-timestamps             Download all snapshots/timestamps for a given website
    -f, --from TIMESTAMP             Only files on or after timestamp supplied (ie. 20060716231334)
    -t, --to TIMESTAMP               Only files on or before timestamp supplied (ie. 20100916231334)
    -e, --exact-url                  Download only the url provied and not the full site
    -o, --only ONLY_FILTER           Restrict downloading to urls that match this filter
				     (use // notation for the filter to be treated as a regex)
    -x, --exclude EXCLUDE_FILTER     Skip downloading of urls that match this filter
				     (use // notation for the filter to be treated as a regex)
    -a, --all                        Expand downloading to error files (40x and 50x) and redirections (30x)
    -c, --concurrency NUMBER         Number of multiple files to download at a time
				     Default is one file at a time (ie. 20)
    -p, --maximum-snapshot NUMBER    Maximum snapshot pages to consider (Default is 100)
				     Count an average of 150,000 snapshots per page
    -l, --list                       Only list file urls in a JSON format with the archived timestamps, won't download anything
```

https://github.com/hartator/wayback-machine-downloader