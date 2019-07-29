<?php declare(strict_types=1);

namespace PirateApplication\Logger\Adapter;

use Monolog\Logger;
use Psr\Log\LoggerInterface;

class VoidLogger implements LoggerInterface
{
    private $callback;

    public function __construct(callable $callback = null)
    {
        $this->callback = $callback;
    }

    public function emergency($message, array $context = [])
    {
        $this->log(Logger::EMERGENCY, $message, $context);
    }

    public function alert($message, array $context = [])
    {
        $this->log(Logger::ALERT, $message, $context);
    }

    public function critical($message, array $context = [])
    {
        $this->log(Logger::CRITICAL, $message, $context);
    }

    public function error($message, array $context = [])
    {
        $this->log(Logger::ERROR, $message, $context);
    }

    public function warning($message, array $context = [])
    {
        $this->log(Logger::WARNING, $message, $context);
    }

    public function notice($message, array $context = [])
    {
        $this->log(Logger::NOTICE, $message, $context);
    }

    public function info($message, array $context = [])
    {
        $this->log(Logger::INFO, $message, $context);
    }

    public function debug($message, array $context = [])
    {
        $this->log(Logger::DEBUG, $message, $context);
    }

    public function log($level, $message, array $context = [])
    {
        if (false == is_null($this->callback)) {
            ($this->callback)($level, $message, $context);
        }
    }
}
