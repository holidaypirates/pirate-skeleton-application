<?php declare(strict_types=1);

namespace PirateApplication\Cache;

use PirateApplication\Cache\Adapter\VoidCacheAdapter;
use PirateApplication\Logger\LoggingTrait;
use InvalidArgumentException;
use Predis\Client as RedisClient;
use Predis\Connection\ConnectionException;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\Cache\Simple\RedisCache;

class CacheFactory
{
    use LoggingTrait;

    public const REDIS_ADAPTER = 'redis';
    public const VOID_ADAPTER = 'void';
    public const ADAPTER_NOT_SET = 'not_set';

    public function __invoke(ContainerInterface $container): CacheInterface
    {
        $this->setLogger($container->get(LoggerInterface::class));
        $adapter = $this->getAdapterType($container);

        switch ($adapter) {
            case self::REDIS_ADAPTER:
                return $this->factoryRedisCacheAdapter($container);
            case self::ADAPTER_NOT_SET:
            case self::VOID_ADAPTER:
                $this->getLogger()->warning('CacheFactory: Cache adapter is not set.');

                return new VoidCacheAdapter();
            default:
                $this->getLogger()->warning("CacheFactory: Cache adapter {$adapter} is not supported.");

                throw new InvalidArgumentException(sprintf(
                    '%s is not a valid supported cache adapter.',
                    $adapter
                ));
        }
    }

    private function getAdapterType(ContainerInterface $container): string
    {
        $config = $container->get('config');

        if ($config['cache']['adapter']) {
            return $config['cache']['adapter'];
        }


        return self::ADAPTER_NOT_SET;
    }

    private function factoryRedisCacheAdapter(ContainerInterface $container): CacheInterface
    {
        $connectionParameters = $container->get('config')['cache']['connection'][self::REDIS_ADAPTER];

        // persistent redis cache
        $client = new RedisClient([
            'scheme' => $connectionParameters['scheme'],
            'host' => $connectionParameters['host'],
            'port' => $connectionParameters['port'],
        ]);

        try {
            $client->connect();

            return new RedisCache($client);
        } catch (ConnectionException $exception) {
            $this->getLogger()->warning(
                'CacheFactory: The Redis client could not connect. Parameters: ' .
                implode(' : ', $connectionParameters),
                [
                    'exceptionMessage' => $exception->getMessage(),
                    'exception' => $exception,
                ]
            );

            return new VoidCacheAdapter();
        }
    }
}
