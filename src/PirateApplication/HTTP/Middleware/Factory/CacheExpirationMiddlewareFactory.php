<?php declare(strict_types=1);

namespace PirateApplication\HTTP\Middleware\Factory;

use Middlewares\Expires as CacheExpirationMiddleware;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\MiddlewareInterface;

class CacheExpirationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): MiddlewareInterface
    {
        $cacheExpiration = $container->get('config')['cache']['response']['ttl'] ?? '+5 minutes';

        return (new CacheExpirationMiddleware())->defaultExpires($cacheExpiration);
    }
}
