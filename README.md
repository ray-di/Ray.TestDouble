# Ray.TestDouble
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ray-di/Ray.TestDouble/badges/quality-score.png?b=1.x)](https://scrutinizer-ci.com/g/ray-di/Ray.TestDouble/?branch=1.x)
[![Code Coverage](https://scrutinizer-ci.com/g/ray-di/Ray.TestDouble/badges/coverage.png?b=1.x)](https://scrutinizer-ci.com/g/ray-di/Ray.TestDouble/?branch=1.x)

An AOP powered test double framework

## Installation

### Composer install

    $ composer require ray/test-double --dev

### Module install

```php
$targets = [
    Foo::class,           // Spy targets
    BarInterface::class,
];
$this->install(new TestDoubleModule($targets));

```

# What is Spy?

A Spy is a test double that records every invocation made against it and can verify certain interactions took place after the fact.

## Create Spy

You can do it directly with `newInstance` or specify it with a binding.

### By newInstance()

```php
$spyLog = new SpyLog();
$spy = (new Spy())->newInstance(Foo::class, 'add', $spyLog);
// $spy records the 'add' method cal
```

### By SpyModule

Specify the target to spy on by interface or class name.

```php
$injector = new Injector(new class extends AbstractModule{
        protected function configure(): void
        {
            $spyTargets = [
                FooInterface::class,
            ];
            $this->install(new SpyModule($spyTargets));
        }
    }
);
$spy = $injector->getInstance(Foo::class);
```

### By Matcher

Specify the spying target using the Ray.Aop matcher.

```php
$injector = new Injector(new class extends AbstractModule
{
    protected function configure(): void
    {
        $this->install(new SpyBaseModule());
        $this->bindInterceptor(
            $this->matcher->any(),
            $this->matcher->startsWith('add'),
            [SpyInterceptor::class]
        );
    }
});
$fake = $injector->getInstance(FakeAdd::class);
$spy = $injector->getInstance(Foo::class);
```


## Assertion

`SpyLog::get($className, $methodName)`でログを取得してアサーションを行います。

```php
public function testSpy()
{
    $result = $foo->add(1, 2); // 3
    $spy = $injector->getInstance(Spy::class);
    // @var array<int, Log> $addLog
    $addLog = $spyLog->getLogs(FakeAdd::class, 'add');   
    $subLog = $spyLog->getLogs(FakeAdd::class, 'sub');   

    $this->assertSame(1, count($addLog), 'Should have received once');
    $this->assertSame(0, count($subLog), 'Should have not received');
    $this->assertSame([1, 2], $addLog[0]->arguments);
    $this->assertSame(1, $addLog[0]->namedArguments['a']);

}
```

