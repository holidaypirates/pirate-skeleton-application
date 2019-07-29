<?php declare(strict_types=1);

namespace PirateApplication\Logger;

use PirateApplication\Logger\Adapter\VoidLogger;
use Psr\Log\LoggerInterface;

trait LoggingTrait
{
    private $logger;

    public function getLogger(): LoggerInterface
    {
        if ($this->logger instanceof LoggerInterface) {
            return $this->logger;
        }

        return new VoidLogger();
    }

    public function setLogger(LoggerInterface$logger): void
    {
        $this->logger = $logger;
    }
}
