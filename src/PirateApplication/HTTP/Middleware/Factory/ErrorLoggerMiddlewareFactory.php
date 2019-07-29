<?php declare(strict_types=1);

namespace PirateApplication\HTTP\Middleware\Factory;

use PirateApplication\HTTP\Middleware\ErrorLoggerMiddleware;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class ErrorLoggerMiddlewareFactory
{
    public function __invoke(ContainerInterface $container): ErrorLoggerMiddleware
    {
        return new ErrorLoggerMiddleware(
            $container->get(LoggerInterface::class)
        );
    }
}
