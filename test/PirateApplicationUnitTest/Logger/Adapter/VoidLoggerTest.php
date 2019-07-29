<?php declare(strict_types=1);

namespace PirateApplicationUnitTest\Logger\Adapter;

use PirateApplication\Logger\Adapter\VoidLogger;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;

class VoidLoggerTest extends TestCase
{
    public function testInfo(): void
    {
        $expectedLevel = Logger::INFO;
        $expectedMessage = 'info message';
        $expectedContext = ['context' => 'in_here'];

        $logger = new VoidLogger(function (
            $level,
            $message,
            array $context = []
        ) use (
            $expectedLevel,
            $expectedMessage,
            $expectedContext
        ) {
            TestCase::assertEquals($expectedLevel, $level);
            TestCase::assertEquals($expectedMessage, $message);
            TestCase::assertEquals($expectedContext, $context);
        });

        $logger->info($expectedMessage, $expectedContext);
    }

    public function testCritical(): void
    {
        $expectedLevel = Logger::CRITICAL;
        $expectedMessage = 'critical message';
        $expectedContext = ['context' => 'in_here'];

        $logger = new VoidLogger(function (
            $level,
            $message,
            array $context = []
        ) use (
            $expectedLevel,
            $expectedMessage,
            $expectedContext
        ) {
            TestCase::assertEquals($expectedLevel, $level);
            TestCase::assertEquals($expectedMessage, $message);
            TestCase::assertEquals($expectedContext, $context);
        });

        $logger->critical($expectedMessage, $expectedContext);
    }

    public function testEmergency(): void
    {
        $expectedLevel = Logger::EMERGENCY;
        $expectedMessage = 'emergency message';
        $expectedContext = ['context' => 'in_here'];

        $logger = new VoidLogger(function (
            $level,
            $message,
            array $context = []
        ) use (
            $expectedLevel,
            $expectedMessage,
            $expectedContext
        ) {
            TestCase::assertEquals($expectedLevel, $level);
            TestCase::assertEquals($expectedMessage, $message);
            TestCase::assertEquals($expectedContext, $context);
        });

        $logger->emergency($expectedMessage, $expectedContext);
    }

    public function testError(): void
    {
        $expectedLevel = Logger::ERROR;
        $expectedMessage = 'error message';
        $expectedContext = ['context' => 'in_here'];

        $logger = new VoidLogger(function (
            $level,
            $message,
            array $context = []
        ) use (
            $expectedLevel,
            $expectedMessage,
            $expectedContext
        ) {
            TestCase::assertEquals($expectedLevel, $level);
            TestCase::assertEquals($expectedMessage, $message);
            TestCase::assertEquals($expectedContext, $context);
        });

        $logger->error($expectedMessage, $expectedContext);
    }

    public function testDebug(): void
    {
        $expectedLevel = Logger::DEBUG;
        $expectedMessage = 'debug message';
        $expectedContext = ['context' => 'in_here'];

        $logger = new VoidLogger(function (
            $level,
            $message,
            array $context = []
        ) use (
            $expectedLevel,
            $expectedMessage,
            $expectedContext
        ) {
            TestCase::assertEquals($expectedLevel, $level);
            TestCase::assertEquals($expectedMessage, $message);
            TestCase::assertEquals($expectedContext, $context);
        });

        $logger->debug($expectedMessage, $expectedContext);
    }

    public function testNotice(): void
    {
        $expectedLevel = Logger::NOTICE;
        $expectedMessage = 'notice message';
        $expectedContext = ['context' => 'in_here'];

        $logger = new VoidLogger(function (
            $level,
            $message,
            array $context = []
        ) use (
            $expectedLevel,
            $expectedMessage,
            $expectedContext
        ) {
            TestCase::assertEquals($expectedLevel, $level);
            TestCase::assertEquals($expectedMessage, $message);
            TestCase::assertEquals($expectedContext, $context);
        });

        $logger->notice($expectedMessage, $expectedContext);
    }

    public function testWarning(): void
    {
        $expectedLevel = Logger::WARNING;
        $expectedMessage = 'warning message';
        $expectedContext = ['context' => 'in_here'];

        $logger = new VoidLogger(function (
            $level,
            $message,
            array $context = []
        ) use (
            $expectedLevel,
            $expectedMessage,
            $expectedContext
        ) {
            TestCase::assertEquals($expectedLevel, $level);
            TestCase::assertEquals($expectedMessage, $message);
            TestCase::assertEquals($expectedContext, $context);
        });

        $logger->warning($expectedMessage, $expectedContext);
    }

    public function testAlert(): void
    {
        $expectedLevel = Logger::ALERT;
        $expectedMessage = 'info message';
        $expectedContext = ['context' => 'in_here'];

        $logger = new VoidLogger(function (
            $level,
            $message,
            array $context = []
        ) use (
            $expectedLevel,
            $expectedMessage,
            $expectedContext
        ) {
            TestCase::assertEquals($expectedLevel, $level);
            TestCase::assertEquals($expectedMessage, $message);
            TestCase::assertEquals($expectedContext, $context);
        });

        $logger->alert($expectedMessage, $expectedContext);
    }
}
