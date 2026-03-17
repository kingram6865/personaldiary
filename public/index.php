<?php
declare(strict_types=1);

$services = require __DIR__ . '/../bootstrap.php';
$pdo = $services['pdo'];

$routes = require __DIR__ . '/../src/routing/routes.php';

$path = rtrim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/');

if ($path === '') {
  $path = '/';
}

if (!isset($routes[$path])) {
  http_response_code(404);

  $pageData = [
      'title' => 'Page Not Found',
      'contentView' => __DIR__ . '/../views/pages/home.php',
      'items' => ['The requested page could not be found.'],
  ];
} else {
  $controllerName = $routes[$path];
  $controllerFile = __DIR__ . '/../src/controllers/' . $controllerName . '.php';
  $controller = require $controllerFile;
  $pageData = $controller($pdo);
}

extract($pageData, EXTR_SKIP);

require __DIR__ . '/../views/layout.php';
