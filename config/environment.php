<?php declare(strict_types=1);

/**
 * This file loads the env vars using dotenv.
 * If you want to change an env var, please do on the .env file on the project root folder
 */

return function (string $environmentFileName = '.env'): void {
    $dotenv = new \Dotenv\Dotenv(__DIR__ . '/../', $environmentFileName);
    $dotenv->safeLoad();
};
