<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$clearStaleConfigCache = static function (): void {
    $basePath = dirname(__DIR__);
    $envPath = $basePath . '/.env';
    $configCachePath = $basePath . '/bootstrap/cache/config.php';

    if (!is_file($envPath) || !is_file($configCachePath)) {
        return;
    }

    $envUpdatedAt = filemtime($envPath);
    $configCachedAt = filemtime($configCachePath);

    if ($envUpdatedAt !== false && $configCachedAt !== false && $envUpdatedAt > $configCachedAt) {
        @unlink($configCachePath);
        clearstatcache(true, $configCachePath);

        return;
    }

    $parseEnvFile = static function ($path): array {
        $values = [];
        $lines = @file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if (!is_array($lines)) {
            return $values;
        }

        foreach ($lines as $line) {
            $line = trim($line);

            if ($line === '' || strpos($line, '#') === 0 || strpos($line, '=') === false) {
                continue;
            }

            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            if ($key === '') {
                continue;
            }

            if ($value !== '' && (($value[0] === '"' && substr($value, -1) === '"') || ($value[0] === "'" && substr($value, -1) === "'"))) {
                $value = substr($value, 1, -1);
            } else {
                $hashPosition = strpos($value, ' #');
                if ($hashPosition !== false) {
                    $value = rtrim(substr($value, 0, $hashPosition));
                }
            }

            $values[$key] = $value;
        }

        return $values;
    };

    $env = $parseEnvFile($envPath);
    $cachedConfig = @include $configCachePath;

    if (!is_array($cachedConfig)) {
        return;
    }

    $cachedValues = [
        'APP_URL' => $cachedConfig['app']['url'] ?? null,
        'DB_HOST' => $cachedConfig['database']['connections']['mysql']['host'] ?? null,
        'DB_PORT' => $cachedConfig['database']['connections']['mysql']['port'] ?? null,
        'DB_DATABASE' => $cachedConfig['database']['connections']['mysql']['database'] ?? null,
        'DB_USERNAME' => $cachedConfig['database']['connections']['mysql']['username'] ?? null,
        'DB_PASSWORD' => $cachedConfig['database']['connections']['mysql']['password'] ?? null,
    ];

    foreach ($cachedValues as $key => $cachedValue) {
        if (array_key_exists($key, $env) && (string) $env[$key] !== (string) $cachedValue) {
            @unlink($configCachePath);
            clearstatcache(true, $configCachePath);

            return;
        }
    }
};

$clearStaleConfigCache();
unset($clearStaleConfigCache);

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

$domain = null;
if (isset($_SERVER['HTTP_HOST'])) {
    $domain = $_SERVER['HTTP_HOST'];
} elseif (getenv('TENANT_DOMAIN')) {
    $domain = getenv('TENANT_DOMAIN');
}

if ($domain) {
    $domain = str_replace('www.', '', $domain);
    $envFile = 'subdomains/.env.' . $domain;
    if (file_exists(dirname(__DIR__) . '/' . $envFile)) {
        $app->loadEnvironmentFrom($envFile);
    }
}

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/


return $app;
