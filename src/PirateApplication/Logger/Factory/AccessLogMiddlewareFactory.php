<?php declare(strict_types=1);

namespace PirateApplication\Logger\Factory;

use Middlewares\AccessLog;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class AccessLogMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): AccessLog
    {
        return new AccessLog(
            $container->get(LoggerInterface::class)
        );
    }
}
