## Install Nginx + PHP 7.4 FPM + MariaDB + Certbot
Installing Required Packages
```
screen -S nginx_install
sudo -i

add-apt-repository ppa:ondrej/nginx-mainline -y

nano /etc/apt/sources.list.d/ondrej-ubuntu-nginx-mainline-*.list
#Uncomment deb-src line

add-apt-repository ppa:ondrej/php -y

apt-get update
apt-get upgrade -y

apt-get install -y make gcc build-essential autoconf automake libtool libfuzzy-dev ssdeep gettext pkg-config libcurl4-openssl-dev liblua5.3-dev libpcre3 libpcre3-dev libxml2 libxml2-dev libyajl-dev doxygen libcurl4 libgeoip-dev libssl-dev zlib1g-dev libxslt-dev liblmdb-dev libpcre++-dev libgd-dev software-properties-common sshpass libmcrypt-dev libperl-dev libperl-dev libssl-dev libfile-find-rule-perl libssl-dev libgmp3-dev libssh2-1-dev libssh2-1 libgmp3-dev zip sendmail curl git uuid-dev nginx-core nginx-common nginx nginx-full mariadb-server mariadb-client php7.4 php7.4-fpm php7.4-mysql php7.4-cli php7.4-common php7.4-json php7.4-opcache php7.4-readline php7.4-mbstring php7.4-xml php7.4-gd php7.4-curl php7.4-pdo php7.4-zip php7.4-bcmath php7.4-ctype php7.4-fileinfo php7.4-tokenizer php7.4-imap php7.4-mail php7.4-ssh2 php7.4-dev php7.4-zip
```

Configure Nginx
```
systemctl start nginx

systemctl enable nginx

systemctl status nginx

nano /etc/nginx/nginx.conf
http {
    # Basic Settings
    Add / Alter >>
    server_tokens off;    

    ssl_protocols TLSv1.2 TLSv1.3; # Dropping SSLv3, ref: POODLE
                                

    Add >>
    ##buffer policy
    #client_body_buffer_size 1K;
    #client_header_buffer_size 1k;
    client_max_body_size 128M;
    #large_client_header_buffers 2 1k;
    
    fastcgi_buffers 32 32k;
    fastcgi_buffer_size 64k;

    # If Proxy
    #proxy_buffer_size   128k;
    #proxy_buffers   4 256k;
    #proxy_busy_buffers_size   256k;
    ##end buffer policy

nginx -t

ufw allow 'Nginx Full'
service ufw restart
netfilter-persistent save

systemctl restart nginx
systemctl status nginx
```

Configure MariaDB
```
systemctl start mariadb

systemctl enable mariadb

systemctl status mariadb

mysql -uroot -ppassword
UPDATE mysql.user SET authentication_string = PASSWORD(‘NEWPASSWORD') WHERE user = 'root’; 
CREATE USER 'd3vdigital'@'localhost' IDENTIFIED BY 'NEWPASSWORD';
GRANT ALL PRIVILEGES ON *.* TO 'd3vdigital'@'localhost' WITH GRANT OPTION;
CREATE USER 'd3vdigital'@'%' IDENTIFIED BY 'NEWPASSWORD';
GRANT ALL PRIVILEGES ON *.* TO 'd3vdigital'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;
QUIT

service mysql restart

mysql_secure_installation
```

Configure PHP
```
systemctl start php7.4-fpm

systemctl enable php7.4-fpm

systemctl status php7.4-fpm

nano /etc/php/7.4/fpm/php.ini

Alter >>
upload_max_filesize = 128M
memory_limit = 1024M
post_max_size = 128M
max_execution_time = 1800
disable_functions = exec,system,shell_exec,passthru
expose_php = Off
display_errors = Off
track_errors = Off
html_errors = Off
mail.add_x_header = Off
session.name = NEWSESSID

Add >>
register_globals = Off
magic_quotes_gpc = Off

service php7.4-fpm restart

touch /run/php/php7.4-fpm.sock
```

Configure Default Server Block
```
rm /etc/nginx/sites-enabled/default
nano /etc/nginx/sites-enabled/default

Add >>
server {
    listen 80;
    listen [::]:80;
    server_name d3v.sh www.d3v.sh; #use _ as a wildcard for everything
    root /var/www/html/;
    index index.php index.html index.htm;

    #Security
    if ($request_method !~ ^(GET|HEAD|POST|OPTIONS)$ )
    {
         return 405;
    }
    
    add_header Strict-Transport-Security "max-age=31536000; includeSubdomains; preload";
    add_header Content-Security-Policy "default-src 'self' https: data: blob:; script-src 'self' 'unsafe-inline' https:; style-src 'self' 'unsafe-inline' https:; img-src 'self' 'unsafe-inline' https: data: blob:; font-src font-src 'self' 'unsafe-inline' https: data: blob:; frame-src 'self' https:; child-src 'self' https:; frame-ancestors 'self' https:; form-action 'self' https:; upgrade-insecure-requests;";
    add_header Referrer-Policy "no-referrer, strict-origin";
    add_header Permissions-Policy "accelerometer=*, ambient-light-sensor=*, autoplay=*, battery=*, camera=*, cross-origin-isolated=*, display-capture=*, document-domain=*, encrypted-media=*, execution-while-not-rendered=*, execution-while-out-of-viewport=*, fullscreen=*, geolocation=*, gyroscope=*, keyboard-map=*, magnetometer=*, microphone=*, midi=*, navigation-override=*, payment=*, picture-in-picture=*, screen-wake-lock=*, sync-xhr=*, usb=*, web-share=*, xr-spatial-tracking=*, clipboard-read=*, clipboard-write=*, gamepad=*, speaker-selection=*, conversion-measurement=*, focus-without-user-activation=*, hid=*, idle-detection=*, interest-cohort=*, serial=*, sync-script=*, trust-token-redemption=*, window-placement=*, vertical-scroll=*";
    add_header X-Content-Type-Options "nosniff";
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Permitted-Cross-Domain-Policies "none";
    add_header Expect-Ct "max-age=0";
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php7.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
        include snippets/fastcgi-php.conf;
    }
    
    # disable access to hidden files
    location ~ /\.ht {
        access_log off;
        log_not_found off;
        deny all;
    }
    
    # disable access to git files  
    location ~ /\.git {
        access_log off;
        log_not_found off;
        deny all;
    }

}

systemctl restart nginx

rm /var/www/html/index.html
mv /var/www/html/index.nginx-debian.html /var/www/html/index.html
```

Install and configure certbot
```
apt-get install -y certbot python3-certbot-nginx

certbot -n --agree-tos --redirect --email zac@dreycor.com --nginx -d d3v.sh -d www.d3v.sh

#https://crontab-generator.org/
crontab -e
Insert >>
0 21 * * * certbot renew >/dev/null 2>&1

service nginx restart
```

