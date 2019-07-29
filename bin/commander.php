<?php declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

/**
 * Self-called anonymous function that creates its own scope and keep the global namespace clean.
 */
(static function () {
    // Execute programmatic/declarative the environment loading
    (require 'config/environment.php')();

    /** @var ContainerInterface $container */
    $container = require 'config/container.php';

    /** @var Application $app */
    $app = $container->get(Application::class);
    $app->run();
})();
