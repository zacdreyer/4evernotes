## Install Certbot
Install Dependencies
```
sudo apt-get update
sudo apt-get -y install software-properties-common
sudo apt-get -y install python3-certbot-apache
echo "0 2 * * * /usr/bin/certbot renew" >> /var/spool/cron/crontabs/root
```

Initialise for a domain
```
certbot certonly -n --agree-tos --email user@domain.com --authenticator webroot --webroot-path /path/to/web/root/ --installer apache -d subdomain.domain.com
```

Renew
```
certbot renew
```

Force Renew
```
certbot --force-renewal
```
Useful for when IP changes but domain stays the same