<?php

declare(strict_types=1);

namespace Ray\TestDouble;

final class Log
{
    /**
     * @param array<mixed> $arguments
     * @param array<mixed> $namedArguments
     */
    public function __construct(
        public array $arguments,
        public array $namedArguments,
        public mixed $result,
        public float $time,
    ) {
    }
}
