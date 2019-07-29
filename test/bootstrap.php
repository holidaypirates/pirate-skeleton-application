<?php declare(strict_types=1);

use PirateApplicationIntegrationTest\Helper\Container\ContainerSingleton;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

(function () {
    // Execute programmatic/declarative the test environment loading
    (require 'config/environment.php')('.env-testing');

    /** @var ContainerInterface $container */
    $container = require 'config/container.php';

    /** @var Application $app */
    $app = $container->get(Application::class);
    $factory = $container->get(MiddlewareFactory::class);

    // Execute programmatic/declarative middleware pipeline and routing
    // configuration statements
    (require 'config/pipeline.php')($app, $factory, $container);
    (require 'config/routes.php')($app, $factory, $container);

    //TODO Find out how to use TestListeners to inject the container into the tests and remove this monstruosity
    ContainerSingleton::setContainerFactory(function () use ($container) {
        return clone $container;
    });
})();
