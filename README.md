# Ray.TestDouble 

A test double suite for Ray.Di

## Installation

### Composer install

    $ composer require ray/test-double 1.x-dev --dev
    
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


There are ways to specify the target class by using the `@Fakeable` annotation or explicitly specifying a list of class names.

Annotate `@Fakeable` annotation for the target. Then, 'Fake' prefixed class in same namespace will be called instead of original class.

### @Fakeable annotation binding

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

### Explicit class name binding

```php
$fakeable = [
    Foo::class,
    // ...
    BarInterface::class
];
$this->install(new TestDoubleModule($fakeable));

```

### 'Fake' prefixed fake class

```php
class FakeFoo extend Foo
{
    public function getDate() {
        return '20170801';
    }
}
```
