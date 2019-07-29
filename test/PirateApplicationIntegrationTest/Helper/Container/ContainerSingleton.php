<?php declare(strict_types=1);

namespace PirateApplicationIntegrationTest\Helper\Container;

use LogicException;
use Psr\Container\ContainerInterface;

/**
 * Sorry father for I sinned...
 * I know that Singleton is anti-pattern, but I couldn't find any other way to make the container available to the tests
 */
class ContainerSingleton
{
    private static $container;
    private static $containerFactory;

    public static function setContainerFactory(callable $container): void
    {
        self::$containerFactory = $container;
    }

    public static function getContainer(): ContainerInterface
    {
        if (self::$container instanceof ContainerInterface) {
            return self::$container;
        }

        return self::resetContainer();
    }

    public static function resetContainer(): ContainerInterface
    {
        if (false === is_callable(self::$containerFactory)) {
            throw new LogicException('The container factory was never set');
        }

        $container = (self::$containerFactory)();
        self::$container = $container;

        return self::getContainer();
    }
}
