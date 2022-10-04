<?php

declare(strict_types=1);

namespace Ray\TestDouble;

use Ray\Aop\Bind;
use Ray\Aop\Weaver;

use function sys_get_temp_dir;

final class Spy
{
    private string $tmpDir;

    public function __construct(string|null $tmpDir = null)
    {
        $this->tmpDir = $tmpDir ?? sys_get_temp_dir();
    }

    /**
     * @param class-string<T> $class
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
