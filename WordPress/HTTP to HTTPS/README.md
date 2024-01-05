## HTTP to HTTPS
Add to wp-config.php
```
define('FORCE_SSL_ADMIN', true);
```

For Apache add to .htaccess
```
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
</IfModule>
```
