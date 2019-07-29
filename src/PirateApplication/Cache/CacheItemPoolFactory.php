<?php declare(strict_types=1);

namespace PirateApplication\Cache;

use Psr\Cache\CacheItemPoolInterface;
use Psr\Container\ContainerInterface;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\Cache\Adapter\Psr16Adapter;

class CacheItemPoolFactory
{
    public function __invoke(ContainerInterface $container): CacheItemPoolInterface
    {
        $cacheAdapter = $container->get(CacheInterface::class);

        return new Psr16Adapter($cacheAdapter);
    }
}
