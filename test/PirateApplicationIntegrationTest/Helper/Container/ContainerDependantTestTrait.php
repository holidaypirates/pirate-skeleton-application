<?php declare(strict_types=1);

namespace PirateApplicationIntegrationTest\Helper\Container;

use Psr\Container\ContainerInterface;

trait ContainerDependantTestTrait
{
    public function getContainer(): ContainerInterface
    {
        return ContainerSingleton::getContainer();
    }

    public function resetContainer(): ContainerInterface
    {
        return ContainerSingleton::resetContainer();
    }
}
