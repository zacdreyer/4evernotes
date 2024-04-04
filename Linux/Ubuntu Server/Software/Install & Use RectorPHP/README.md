## Install & Use RectorPHP

Install RectorPHP
```
composer require rector/rector --dev
```

After installation you need to create a rector.php in your root directory. Here is an example of it's contents
```
use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictConstructorRector;

return RectorConfig::configure()
    // register single rule
    ->withRules([
        TypedPropertyFromStrictConstructorRector::class
    ])
    // here we can define, what prepared sets of rules will be applied
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true
    );
```
For more info on this see https://getrector.com/documentation

Usage
```
vendor/bin/rector process </path/to/code>
```

Usage (Dry Run)
```
vendor/bin/rector process </path/to/code> --dry-run
```

Source: https://github.com/rectorphp/rector