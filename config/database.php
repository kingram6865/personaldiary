<?php

declare(strict_types=1);

return [
    'default' => [
        'driver' => 'mysql',
        'host' => $_ENV['DB_HOST'] ?? '127.0.0.1',
        'port' => isset($_ENV['DB_PORT']) ? (int) $_ENV['DB_PORT'] : 3306,
        'dbname' => $_ENV['DB_NAME'] ?? '',
        'user' => $_ENV['DB_USER'] ?? '',
        'pass' => $_ENV['DB_PASS'] ?? '',
        'charset' => 'utf8mb4',
    ],

    'personal' => [
        'driver' => 'pgsql',
        'host' => $_ENV['DIARY_DB_HOST'] ?? '127.0.0.1',
        'port' => isset($_ENV['DIARY_DB_PORT']) ? (int) $_ENV['DIARY_DB_PORT'] : 5432,
        'dbname' => $_ENV['DIARY_DB_NAME'] ?? '',
        'user' => $_ENV['DIARY_DB_USER'] ?? '',
        'pass' => $_ENV['DIARY_DB_PASS'] ?? '',
    ],
];