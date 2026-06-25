<?php

header('Content-Type: text/plain; charset=UTF-8');
header('X-Robots-Tag: noindex, nofollow', true);

$data = [
    'php_version' => PHP_VERSION,
    'php_sapi' => PHP_SAPI,
    'ioncube_loader_loaded' => extension_loaded('ionCube Loader') ? 'yes' : 'no',
    'ioncube_loader_version' => function_exists('ioncube_loader_version') ? ioncube_loader_version() : null,
    'server_name' => $_SERVER['SERVER_NAME'] ?? null,
    'http_host' => $_SERVER['HTTP_HOST'] ?? null,
    'server_addr' => $_SERVER['SERVER_ADDR'] ?? null,
    'document_root' => $_SERVER['DOCUMENT_ROOT'] ?? null,
];

foreach ($data as $key => $value) {
    echo $key.': '.($value === null || $value === '' ? '(empty)' : $value).PHP_EOL;
}
