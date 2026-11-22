<?php

declare(strict_types=1);

namespace Ray\TestDouble;

use Ray\Aop\Bind;
use Ray\Aop\Weaver;

use function assert;
use function sys_get_temp_dir;

final class Spy
{
    /** @var non-empty-string */
    private string $tmpDir;

    /** @param non-empty-string|null $tmpDir */
    public function __construct(string|null $tmpDir = null)
    {
        $tmpDir ??= sys_get_temp_dir();
        assert($tmpDir !== '');
        $this->tmpDir = $tmpDir;
    }

    /**
     * @param class-string<T>  $class
     * @param non-empty-string $method
     *
     * @return T
     *
     * @template T of object
     */
    public function newInstance(string $class, string $method, Logger $spyLog): object
    {
        $bind = (new Bind())->bindInterceptors($method, [new SpyInterceptor($spyLog)]);
        $compiler = new Weaver($bind, $this->tmpDir);

        return $compiler->newInstance($class, []);
    }
}
