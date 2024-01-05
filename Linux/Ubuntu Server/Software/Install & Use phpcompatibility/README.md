## Install & Use phpcompatibility
Install Composer

```
php -r "readfile('https://getcomposer.org/installer');" | php
```

---

Update php_codesniffer and phpcompatibility

Edit composer.json and Add:
```
{
    "require-dev": {
        "squizlabs/php_codesniffer": "*",
        "phpcompatibility/php-compatibility": "*"
    },
        "prefer-stable" : true,
        "scripts": {
                "post-install-cmd": "\"vendor/bin/phpcs\" --config-set installed_paths vendor/phpcompatibility/php-compatibility",
                "post-update-cmd" : "\"vendor/bin/phpcs\" --config-set installed_paths vendor/phpcompatibility/php-compatibility"
        }
}
```

Then run
```
php composer.phar install
```

---

Update Composer

```
php composer.phar selfupdate
```

---

Update Vendors

```
php composer.phar update
```

---

Check Installed Vendors

```
php composer.phar show -i
```

---

Running phpcompatibility

```
/path/to/composer-vendor/bin/phpcs -p /path/to/php-code/ --standard=PHPCompatibility --runtime-set testVersion 7.2 --report-full=/path/to/report/report.txt 


/root/apps/vendor/bin/phpcs -p /root/workspace/CodeIgniter-3.1.10/ --standard=PHPCompatibility --runtime-set testVersion 7.2 --report-full=/var/www/html/sudo.d3v.sh/ci3-report.txt
```
