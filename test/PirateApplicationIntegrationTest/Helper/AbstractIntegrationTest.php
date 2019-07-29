<?php declare(strict_types=1);

namespace PirateApplicationIntegrationTest\Helper;

use PirateApplicationIntegrationTest\Helper\Container\ContainerDependantTestTrait;
use PHPUnit\Framework\TestCase;

abstract class AbstractIntegrationTest extends TestCase
{
    use ContainerDependantTestTrait;

    public function setUp() : void
    {
    }

    public function tearDown() : void
    {
        $this->resetContainer();
    }
}
