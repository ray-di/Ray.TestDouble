# Ray.TestDouble 

A TestDobule suite for Ray.Di

## Installation

### Composer install

    $ composer require ray/fake-module 1.x-dev --dev
    
### Module install

```php
use Ray\Di\AbstractModule;
use Ray\TestDouble\TestDoubleModule;

class AppModule extends AbstractModule
{
    protected function configure()
    {
        $this->install(new TestDoubleModule);
    }
}
```

## Fake a class method


Annotate `@Fakeable` annotation for the target. Then, 'Fake' prefixed class in same namespace will be called instead of original class.

Actual class

```php
use Ray\TestDouble\Annotation\Fakeable;

/**
 * @Fakeable
 */
class Foo
{
    public function getDate() {
        return date("Ymd");
    }
}
```

Fake class

```php
class FakeFoo extend Foo
{
    public function getDate() {
        return '20170801';
    }
}
```

