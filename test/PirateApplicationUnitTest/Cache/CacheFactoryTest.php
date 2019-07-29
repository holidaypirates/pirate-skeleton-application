<?php declare(strict_types=1);

namespace PirateApplicationUnitTest\Cache;

use PirateApplication\Cache\Adapter\VoidCacheAdapter;
use PirateApplication\Cache\CacheFactory;
use PirateApplication\Logger\Adapter\VoidLogger;
use PirateApplicationUnitTest\Helpers\VoidContainer;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class CacheFactoryTest extends TestCase
{
    public function testFactoryRedis(): void
    {
        $factory = new CacheFactory();
        $container = new VoidContainer(function ($identifier) {
            switch ($identifier) {
                case LoggerInterface::class:
                    return new VoidLogger();
                case 'config':
                    return [
                        'cache' => [
                            'adapter' => CacheFactory::REDIS_ADAPTER,
                            'connection' => [
                                CacheFactory::REDIS_ADAPTER => [
                                    'scheme' => 'tcp',
                                    'host' => 'fake-host',
                                    'port' => 'fake-port',
                                ],
                            ],
                        ],
                    ];
            }
        });

        $factory($container);

        $this->expectNotToPerformAssertions();
    }

    public function testFactoryVoidAdapter(): void
    {
        $factory = new CacheFactory();

        $container = new VoidContainer(function ($identifier) {
            switch ($identifier) {
                case LoggerInterface::class:
                    return new VoidLogger();
                case 'config':
                    return [
                        'cache' => [
                            'adapter' => CacheFactory::VOID_ADAPTER,
                        ],
                    ];
            }
        });

        $instance = $factory($container);

        TestCase::assertInstanceOf(VoidCacheAdapter::class, $instance);
    }

    public function testFactoryVoidAdapterWhenNotSpecifiedOnConfig(): void
    {
        $factory = new CacheFactory();
        $container = new VoidContainer(function ($identifier) {
            switch ($identifier) {
                case LoggerInterface::class:
                    return new VoidLogger();
                case 'config':
                    return [];
            }
        });
        $instance = $factory($container);

        TestCase::assertInstanceOf(VoidCacheAdapter::class, $instance);
    }
}
