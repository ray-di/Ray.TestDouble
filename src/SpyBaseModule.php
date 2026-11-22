<?php

declare(strict_types=1);

namespace Ray\TestDouble;

use Override;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

final class SpyBaseModule extends AbstractModule
{
    #[Override]
    protected function configure()
    {
        $this->bind(LoggerInterface::class)->to(Logger::class)->in(Scope::SINGLETON);
    }
}
