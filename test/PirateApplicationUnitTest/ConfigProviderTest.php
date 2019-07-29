<?php declare(strict_types=1);

namespace PirateApplicationUnitTest;

use PirateApplication\ConfigProvider;
use PHPUnit\Framework\TestCase;

class ConfigProviderTest extends TestCase
{
    public function testGetDependencies(): void
    {
        $configProvider = new ConfigProvider();
        $config = $configProvider();

        TestCase::assertNotEmpty($config);
    }
}
