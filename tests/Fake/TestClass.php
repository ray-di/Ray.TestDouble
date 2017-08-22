<?php

namespace Ray\TestDouble;

use Ray\TestDouble\Annotation\Fakeable;

/**
 * @Fakeable
 */
class TestClass
{
    public function output() {
        return  "test class output";
    }
}