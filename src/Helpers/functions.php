<?php declare(strict_types=1);

/**
 * .env file helper
 *
 * Stolen from Cuttysark that stole from Laravel.
 */
if (!function_exists('env')) {
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return $default instanceof Closure ? $default() : $default;
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return null;
        }

        if (strlen($value) > 1 && strpos($value, '"') === 0 && substr($value, -strlen('"'))) {
            return substr($value, 1, -1);
        }

        return $value;
    }
}
