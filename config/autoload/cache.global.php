<?php declare(strict_types=1);

use PirateApplication\Cache\CacheFactory;

return [
    'cache' => [
        'adapter' => env('CACHE_ADAPTER'),
        'connection' => [
            CacheFactory::REDIS_ADAPTER => [
                'scheme' => env('CACHE_REDIS_SCHEME'),
                'host' => env('CACHE_REDIS_HOST'),
                'port' => env('CACHE_REDIS_PORT'),
            ],
        ],
        'response' => [
            'ttl' => env('CACHE_RESPONSE_TTL', '+5 minutes'),
        ],
    ],
];
