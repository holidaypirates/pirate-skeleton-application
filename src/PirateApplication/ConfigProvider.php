<?php declare(strict_types=1);

namespace PirateApplication;

use PirateApplication\Cache\CacheFactory;
use PirateApplication\Cache\CacheItemPoolFactory;
use PirateApplication\HTTP\Middleware\ErrorLoggerMiddleware;
use PirateApplication\HTTP\Middleware\Factory\CacheExpirationMiddlewareFactory;
use PirateApplication\HTTP\Middleware\Factory\ErrorLoggerMiddlewareFactory;
use PirateApplication\HTTP\Middleware\Factory\ResponseCacheMiddlewareFactory;
use PirateApplication\HTTP\Middleware\ResponseCacheMiddleware;
use PirateApplication\Logger\Factory\AccessLogMiddlewareFactory;
use Middlewares\AccessLog as AccessLogMiddleware;
use PirateApplication\Command\Factory\ApplicationFactory;
use PirateApplication\Logger\Factory\LoggerFactory;
use Middlewares\Expires as CacheExpirationMiddleware;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\Console\Application;

/**
 * The configuration provider for the PirateApplication module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'factories' => [
                //Midlewares
                CacheExpirationMiddleware::class => CacheExpirationMiddlewareFactory::class,
                ResponseCacheMiddleware::class => ResponseCacheMiddlewareFactory::class,

                // CLI Application
                Application::class => ApplicationFactory::class,

                // Logger
                LoggerInterface::class => LoggerFactory::class,
                AccessLogMiddleware::class => AccessLogMiddlewareFactory::class,
                ErrorLoggerMiddleware::class => ErrorLoggerMiddlewareFactory::class,

                // Cache
                CacheInterface::class => CacheFactory::class,
                CacheItemPoolInterface::class => CacheItemPoolFactory::class,
            ],
        ];
    }
}
