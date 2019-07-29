<?php declare(strict_types=1);

namespace PirateApplicationUnitTest\Command\Factory;

use PirateApplication\Command\Factory\ApplicationFactory;
use PirateApplication\Command\PingCommand;
use PirateApplicationUnitTest\Helpers\VoidContainer;
use PirateApplication\Logger\Adapter\VoidLogger;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use RuntimeException;
use Symfony\Component\Console\Application;

class ApplicationFactoryTest extends TestCase
{
    public function testFactory()
    {
        $container = $this->getContainerMock();
        $factory = new ApplicationFactory();
        $instance = $factory($container);

        TestCase::assertInstanceOf(Application::class, $instance);
    }

    private function getContainerMock(): ContainerInterface
    {
        return new VoidContainer(
            function ($identifier) {
                switch ($identifier) {
                    case LoggerInterface::class:
                        return new VoidLogger();
                    case PingCommand::class:
                        return $this->prophesize(PingCommand::class)->reveal();
                    default:
                        throw new RuntimeException($identifier . ' is not expected in this test');
                }
            }
        );
    }
}
