<?php declare(strict_types=1);

use Monolog\Logger;

return [
    'logger' => [
        'error_reporting_level' => (int)env('ERROR_REPORTING_LEVEL', Logger::WARNING),
        'log_requests' => (bool) env('LOG_REQUESTS', false),
    ],
];
