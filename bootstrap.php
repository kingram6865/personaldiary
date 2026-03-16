<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use Sdl\Database\Database;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = require __DIR__ . '/config/database.php';

$database = new Database($config);
$pdo = $database->getConnection();
