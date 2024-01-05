## Install Local Composer
The composer.json file should already exist.

```
php -r "readfile('https://getcomposer.org/installer');" | php
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

Support Links

- Troubleshooting: https://getcomposer.org/doc/articles/troubleshooting.md
- Package Info: https://packagist.org/