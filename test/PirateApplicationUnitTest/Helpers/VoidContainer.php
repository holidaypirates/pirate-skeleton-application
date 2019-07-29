<?php declare(strict_types=1);

namespace PirateApplicationUnitTest\Helpers;

use Psr\Container\ContainerInterface;

class VoidContainer implements ContainerInterface
{
    private $getCallback;
    private $hasCallback;

    public function __construct(callable $get = null, callable $has = null)
    {
        $this->getCallback = $get;
        $this->hasCallback = $has;
    }

    public function get($id)
    {
        return ($this->getCallback)($id);
    }

    public function has($id)
    {
        return ($this->hasCallback)($id);
    }
}
