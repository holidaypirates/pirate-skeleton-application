<?php declare(strict_types=1);

namespace PirateApplication\HTTP\Middleware\Factory;

use PirateApplication\HTTP\Middleware\ResponseCacheMiddleware;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class ResponseCacheMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): ResponseCacheMiddleware
    {
        $cacheExpiration = $container->get('config')['cache']['response']['ttl'] ?? '+5 minutes';

        $instance = new ResponseCacheMiddleware(
            $container->get(CacheItemPoolInterface::class),
            $cacheExpiration
        );

        $instance->setLogger($container->get(LoggerInterface::class));

        return $instance;
    }
}
