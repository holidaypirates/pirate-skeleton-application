<?php declare(strict_types=1);

namespace PirateApplication\Logger\Factory;

use PirateApplication\EnvironmentProvider;
use MeadSteve\MonoSnag\BugsnagHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Bugsnag\Client as BugsnagClient;

class LoggerFactory
{
    public function __invoke(ContainerInterface $container): LoggerInterface
    {
        $logger = new Logger('PirateApplication');
        $this->addBugsnagHandler($logger, $container);
        $this->addStreamHandler($logger);

        return $logger;
    }

    private function addBugsnagHandler(Logger $logger, ContainerInterface $container): void
    {
        if (false === env('BUGSNAG_API_KEY', false)) {
            return;
        }

        $bugsnagClient = BugsnagClient::make();
        $bugsnagClient
            ->getConfig()
            ->setBatchSending(false)
            ->setReleaseStage($container->get(EnvironmentProvider::class)->getCurrent())
            ->setAppVersion(env('APPLICATION_VERSION_TAG', env('environment', 'development')));

        $errorReportingLevel = $container->get('config')['logger']['error_reporting_level'];
        $bugsnagHandler = new BugsnagHandler($bugsnagClient, $errorReportingLevel);
        $logger->pushHandler($bugsnagHandler);
    }

    private function addStreamHandler(Logger $logger): void
    {
        //This will ensure that loggers also output into the CLI output streams.
        //Won't interfere with requests as they don't rely on I/O streams.
        $logger->pushHandler(new StreamHandler('php://stdout'));

        // If is set to, it will log into the file
        if (env('LOG_FILE', false)) {
            $formatter = new LineFormatter();
            $formatter->allowInlineLineBreaks(true);
            try {
                $handler = new StreamHandler(getcwd() . env('LOG_FILE'));
                $handler->setFormatter($formatter);
                $logger->pushHandler($handler);
            } catch (\Exception $exception) {
                // If the logger cannot start, die silently ¯\_(ツ)_/¯
            }
        }
    }
}
