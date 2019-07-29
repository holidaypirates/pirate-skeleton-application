<?php declare(strict_types=1);

namespace PirateApplicationUnitTest;

use PirateApplication\EnvironmentProvider;
use LogicException;
use PHPUnit\Framework\TestCase;

class EnvironmentProviderTest extends TestCase
{
    public function testLoadFromEnvVar(): void
    {
        putenv('ENVIRONMENT=development');
        $environment = new EnvironmentProvider();

        TestCase::assertEquals(EnvironmentProvider::DEVELOPMENT, $environment->getCurrent());

        //Test casting to string
        TestCase::assertEquals(EnvironmentProvider::DEVELOPMENT, (string)$environment);
    }

    public function testChangeOnRuntime(): void
    {
        // Unset the env var
        putenv('ENVIRONMENT');

        $environment = new EnvironmentProvider();

        //By default it should set as production
        TestCase::assertEquals(EnvironmentProvider::PRODUCTION, $environment->getCurrent());

        //Test if we can mock so it can be reusable in tests
        $environment->setCurrent(EnvironmentProvider::STAGING);
        TestCase::assertEquals(EnvironmentProvider::STAGING, $environment->getCurrent());
    }

    public function testIfThrowExceptionOnInvalidValue(): void
    {
        $this->expectException(LogicException::class);
        new EnvironmentProvider('invalid value');
    }
}
