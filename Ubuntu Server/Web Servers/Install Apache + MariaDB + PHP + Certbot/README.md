## Install Apache + MariaDB + PHP + Certbot
**Installing Apache**
```
apt-get -y install apache2 apache2-utils
systemctl start apache2
systemctl enable apache2
systemctl status apache2
apache2 -v
chown www-data:www-data /var/www/html/ -R
```

**Installing MariaDB**
```
apt-get -y install software-properties-common
apt-key adv --fetch-keys 'https://mariadb.org/mariadb_release_signing_key.asc'
add-apt-repository 'deb [arch=amd64,arm64,ppc64el] https://mariadb.mirror.liquidtelecom.com/repo/10.5/ubuntu focal main'
apt update
apt -y install mariadb-server mariadb-client
systemctl start mariadb
systemctl enable mariadb
systemctl status mariadb
```

**Installing PHPMod**
```
apt -y install php libapache2-mod-php php-mysql php-common php-cli php-common php-json php-opcache php-readline php-pear
a2enmod php
systemctl restart apache2
```

**Change MySQL root password**
```
mysql -uroot -ppassword
CREATE USER 'd3vdigital'@'localhost' IDENTIFIED BY 'NEWPASSWORD';
GRANT ALL PRIVILEGES ON *.* TO 'd3vdigital'@'localhost' WITH GRANT OPTION;
CREATE USER 'd3vdigital'@'%' IDENTIFIED BY 'NEWPASSWORD';
GRANT ALL PRIVILEGES ON *.* TO 'd3vdigital'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;
QUIT

service mysql restart

mysql_secure_installation
```

**Apache Config**
```
ufw allow http
ufw allow https
service ufw restart
```
Hardening: [https://www.thefanclub.co.za/how-to/how-secure-ubuntu-1604-lts-server-part-1-basics](url)

**Apache Enable Mods**
```
cd /etc/apache2/mods-enabled
a2enmod headers
a2enmod rewrite
a2enmod deflate
a2enmod ssl
a2enmod cache
a2enmod setenvif
a2enmod speling

apt-get install -y gcc make autoconf libc-dev pkg-config php-pear libmcrypt-dev libreadline-dev php-dev
python -m pip install mysql-connector
pecl channel-update pecl.php.net 
pecl install mcrypt ssh2-1.2

apt-get install -y libapache2-mod-evasive
a2enmod evasive
nano /etc/apache2/mods-available/evasive.conf
Add >>
DOSHashTableSize 3097
DOSPageCount 10
DOSSiteCount 30
DOSPageInterval 1
DOSSiteInterval 3
DOSBlockingPeriod 3600
DOSLogDir /var/log/apache2/mod_evasive.log

touch /var/log/apache2/mod_evasive.log
chown www-data:www-data /var/log/apache2/mod_evasive.log

apt-get install -y libapache2-mod-security2
a2enmod unique_id
a2enmod security2
cp /etc/modsecurity/modsecurity.conf{-recommended,}
nano /etc/modsecurity/modsecurity.conf
Alter >>
SecRuleEngine On
SecResponseBodyAccess Off

cd /root/
git clone https://github.com/SpiderLabs/owasp-modsecurity-crs.git
mv /usr/share/modsecurity-crs /usr/share/modsecurity-crs.bak
mv owasp-modsecurity-crs /usr/share/modsecurity-crs
mv /usr/share/modsecurity-crs/crs-setup.conf.example /usr/share/modsecurity-crs/crs-setup.conf
nano /etc/apache2/mods-enabled/security2.conf
Add these lines at the end >>
IncludeOptional "/usr/share/modsecurity-crs/*.conf
IncludeOptional "/usr/share/modsecurity-crs/rules/*.conf


systemctl restart apache2
```

**Setup sites-enabled**
```
cd /etc/apache2/sites-enabled
rm 000-default.conf
cp ../sites-available/000-default.conf ./default.domain.conf
nano default.domain.conf
```
Make sure the .conf looks more or less like this
```
<VirtualHost *:80>
        ServerName default.domain
        ServerAdmin admin@server.com
        DocumentRoot /path/to/storage
        
        RewriteEngine On
        ErrorLog ${APACHE_LOG_DIR}/error-default-domain.log
        CustomLog ${APACHE_LOG_DIR}/access-default-domain.log combined

        DirectoryIndex index.php index.html index.htm
        
        <Directory "/path/to/storage">
                Options -Indexes +FollowSymLinks +MultiViews
                AllowOverride All
                Order allow,deny
                Allow from all
        </Directory>
</VirtualHost>
```

**PHP Addons and Configs**
[https://serverpilot.io/docs/available-php-extensions](url)
```
apt-get install -y php-mbstring php7.4-mbstring libapache2-mod-php php-curl php-gd


nano /etc/php/8.1/apache2/php.ini
Alter >>
upload_max_filesize = 50M
memory_limit = 1024M
post_max_size = 50M
max_execution_time = 1800


service apache2 restart


phpenmod mbstring
phpenmod curl
phpenmod mysqli
phpenmod xml
phpenmod xmlreader
phpenmod xmlwriter
phpenmod xsl
phpenmod simplexml


service apache2 restart
```

**Harden PHP**
```
nano /etc/php/8.1/apache2/php.ini
Alter >>
disable_functions = exec,system,shell_exec,passthru
expose_php = Off
display_errors = Off
html_errors = Off
mail.add_x_header = Off
session.name = NEWSESSID

Add >>
register_globals = Off
magic_quotes_gpc = Off

service apache2 restart
```

**Install and configure certbot**
```
apt-get update
apt-get -y install software-properties-common
apt-get install -y certbot python3-certbot-apache
service apache2 restart

certbot certonly -n --agree-tos --email zac@dreycor.com --authenticator webroot --webroot-path /var/www/html/sudo.d3v.sh/ --installer apache -d www.d3v.sh

certbot

#https://crontab-generator.org/
crontab -e
Insert >>
0 21 * * * certbot renew >/dev/null 2>&1
```

**Update apache virtual hosts files to include ssl**
```
<IfModule mod_ssl.c>
    <VirtualHost *:443>
    
        ServerName default.domain
        ServerAdmin admin@server.com
        DocumentRoot /path/to/storage
        
        RewriteEngine On
    
        ErrorLog ${APACHE_LOG_DIR}/error-default-domain.log
        CustomLog ${APACHE_LOG_DIR}/access-default-domain.log combined
        DirectoryIndex index.php index.html index.htm

        <Directory "/path/to/storage">
                Options -Indexes +FollowSymLinks +MultiViews
                AllowOverride All
                Order allow,deny
                allow from all
        </Directory>

    
        SSLCertificateFile /etc/letsencrypt/live/default.domain/fullchain.pem
        SSLCertificateKeyFile /etc/letsencrypt/live/default.domain/privkey.pem
        Include /etc/letsencrypt/options-ssl-apache.conf

    </VirtualHost>
</IfModule>
```