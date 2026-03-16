<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

try {
    $pdo = $database->getConnection('default');

    $stmt = $pdo->query('SELECT NOW() AS current_db_time');
    $row = $stmt->fetch();

    echo "Connected successfully.\n";
    print_r($row);
} catch (Throwable $e) {
    echo 'Connection failed: ' . $e->getMessage() . PHP_EOL;
}
