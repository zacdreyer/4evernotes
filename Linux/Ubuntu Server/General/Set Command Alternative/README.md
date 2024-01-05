## Set Command Alternative
Set <CMD> as default version using command:
```
update-alternatives --set <CMD> /usr/bin/<APP>
```

Alternatively, you can run the following command to set which system wide version of the app you want to use by default.
```
update-alternatives --config <CMD>
```


Examples
Set PHP 7.4 as default version using command:
```
update-alternatives --set php /usr/bin/php7.4
```

Alternatively, you can run the following command to set which system wide version of PHP you want to use by default.
```
update-alternatives --config php
```
