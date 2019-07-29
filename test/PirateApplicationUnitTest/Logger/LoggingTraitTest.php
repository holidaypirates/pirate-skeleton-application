<?php declare(strict_types=1);

namespace PirateApplicationUnitTest\Logger;

use PirateApplication\Logger\Adapter\VoidLogger;
use PirateApplication\Logger\LoggingTrait;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class LoggingTraitTest extends TestCase
{
    public function testLoggerAccess(): void
    {
        $logger = $this->prophesize(LoggerInterface::class)->reveal();

        $testClass = new class()
        {
            use LoggingTrait;
        };

        $testClass->setLogger($logger);

        TestCase::assertSame($logger, $testClass->getLogger());
    }

    public function testLoggerAccessWhenNotSet(): void
    {
        $testClass = new class()
        {
            use LoggingTrait;
        };

        TestCase::assertInstanceOf(VoidLogger::class, $testClass->getLogger());
    }
}
