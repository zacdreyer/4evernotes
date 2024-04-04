## Install & Use phpcompatibility
Install PHP_CodeSniffer
```
composer require --dev squizlabs/php_codesniffer
```

Install PHPCompatibility
```
composer require --dev phpcompatibility/php-compatibility
```

Register PHPCompatibility with PHP_CodeSniffer
```
vendor/bin/phpcs --config-set installed_paths vendor/phpcompatibility/php-compatibility
```

Usage, output to file
```
vendor/bin/phpcs -p </path/to/code> --standard=PHPCompatibility --runtime-set testVersion <php.version>- --extensions=php -d memory_limit=2048M --report-<report_output_type>=</path/to/reportFile>
```

Getting PHPCompatibility Help
```
vendor/bin/phpcs --help
```

Source: https://cu.be/a-comprehensive-guide-to-using-phpcompatibility-in-your-project/
Repo: https://github.com/PHPCompatibility/PHPCompatibility
