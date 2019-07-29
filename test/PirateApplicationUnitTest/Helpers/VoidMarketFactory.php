<?php declare(strict_types=1);

namespace PirateApplicationUnitTest\Helpers;

use PirateApplication\Domain\Market\Factory\MarketFactoryInterface;
use PirateApplication\Domain\Market\Market;

class VoidMarketFactory implements MarketFactoryInterface
{
    private $callback;

    public function __construct(callable $callback = null)
    {
        if (null === $callback) {
            $callback = function (string $name = null) {
                return new Market($name);
            };
        }
        $this->callback = $callback;
    }

    public function create(string $name): Market
    {
        return ($this->callback)($name);
    }
}
