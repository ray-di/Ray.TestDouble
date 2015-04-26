<?php
/**
 * This file is part of the Ray.FakeModule
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace Ray\FakeModule\Annotation;

/**
 * @Annotation
 * @Target("METHOD")
 */
final class FakeResource extends AbstractFakeModule
{
    /**
     * @var string
     */
    public $uri;
}