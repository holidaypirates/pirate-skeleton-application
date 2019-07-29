<?php declare(strict_types=1);

namespace PirateApplicationUnitTest\Logger\Factory;

use PirateApplication\Logger\Factory\AccessLogMiddlewareFactory;
use PirateApplicationUnitTest\Helpers\VoidContainer;
use Middlewares\AccessLog;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class AccessLogMiddlewareFactoryTest extends TestCase
{
    public function testFactory()
    {
        $factory = new AccessLogMiddlewareFactory();
        $container = new VoidContainer(function () {
            return $this->prophesize(LoggerInterface::class)->reveal();
        });

        $middleware = $factory($container);

        TestCase::assertInstanceOf(AccessLog::class, $middleware);
    }
}
