## Install & Use PHPStan

Install PHPStan
```
composer require --dev phpstan/phpstan
```

Install Extension Manager
```
composer require --dev phpstan/extension-installer && composer require --dev phpstan/phpstan-beberlei-assert
```
PHPStan Extentions: https://phpstan.org/user-guide/extension-library

Usage
```
vendor/bin/phpstan analyse --level=9 --memory-limit=<memory allocation e.g 4G> </path/to/code>
```

Usage, output to file
```
vendor/bin/phpstan analyse --level=9 --memory-limit=<memory allocation e.g 4G> </path/to/code>
 | tee </path/to/reportFile>
```

Getting Help
```
vendor/bin/phpstan --help
```

Source: https://phpstan.org/user-guide/getting-started
