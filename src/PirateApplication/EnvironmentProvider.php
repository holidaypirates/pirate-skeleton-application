<?php declare(strict_types=1);

namespace PirateApplication;

use LogicException;

class EnvironmentProvider
{
    public const STAGING = 'staging';
    public const PRODUCTION = 'production';
    public const DEVELOPMENT = 'development';

    private $currentEnvironment;

    public function __construct(string $currentEnvironment = null)
    {
        if (null === $currentEnvironment) {
            $currentEnvironment = env('ENVIRONMENT', self::PRODUCTION);
        }

        $this->setCurrent($currentEnvironment);
    }

    public function setCurrent(string $environment): void
    {
        $possibleEnvironments = [self::STAGING, self::PRODUCTION, self::DEVELOPMENT];

        if (false === in_array($environment, $possibleEnvironments, true)) {
            throw new LogicException(sprintf(
                '"%s" is not a valid environment.',
                $environment
            ));
        }

        $this->currentEnvironment = $environment;
    }

    public function getCurrent(): string
    {
        return $this->currentEnvironment;
    }

    public function __toString(): string
    {
        return $this->getCurrent();
    }
}
