<?php

declare(strict_types=1);

namespace Ray\TestDouble;

final class Log
{
    /**
     * @param class-string          $class
     * @param array<int, scalar>    $arguments
     * @param array<string, scalar> $namedArguments
     */
    public function __construct(
        public array $arguments,
        public array $namedArguments,
        public mixed $result,
        public float $time,
    ) {
    }
}
