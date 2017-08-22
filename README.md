# Ray.TestDouble 

An AOP powered test double framework

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

'Fake' prefixed fake class

```php
class FakeFoo extend Foo
{
    public function getDate() {
        return '20170801';
    }
}
```

### Explicit class name binding

```php
$fakeable = [
    Foo::class,
    Bar::class
];
$this->install(new TestDoubleModule($fakeable));

```

## Spy method invocation

A Spy is a test double that records every invocation made against it and can verify certain interactions took place after the fact. 

Annotate `@Spy` to class for all method, or particular method which you want spy.

```php
use Ray\TestDouble\Annotation\Spy;

/**
 * @Spy
 */
class FakeSpy
{
    public function exec($a, $b)
    {
        return $a + $b;
    }
}
```

Or manuaally bind with matcher in module.

```php
$this->bindInterceptor(
    $this->matcher->subclassesOf(FooInterface::class),
    $this->matcher->any(),
    [SpyInterceptor::class]
);

```

```php
public function testSpy()
{
    $injector = new Injector(new TestModule);
    $foo = $injector->getInstance(Foo::class);
    $result = $foo->exec(1, 2); // 3
    $spy = $injector->getInstance(Spy::class);
    
    // get spy logs
    $logs = $spy->getLogs(FakeSpy::class, 'exec');
    $this->assertSame(1, count($logs)); // call time
    $log = $logs[0]; // first call log
    /* @var $log SpyLog */
    $this->assertSame([1, 2], $log->argument);
    $this->assertSame(3, $log->result);
}
```

## Autoload

It is a good idea to separate the Fake class in the same namespace into different `tests/Fake` folder. Add `autoload-dev` section into `composer.json` for that.

```json
"autoload-dev": {
    "psr-4": {
        "MyVendor\\MyProject\\": "tests/Fake"
    }
},
```