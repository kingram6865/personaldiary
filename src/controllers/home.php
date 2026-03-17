<?php

declare(strict_types=1);

return static function (PDO $pdo): array {
  return [
    'title' => 'Diary Home',
    'contentView' => __DIR__ . '/../../views/pages/home.php',
    'items' => [
      'Create a new diary entry',
      'Show all entries',
      'Show entries by keyword',
      'Show entries by partial title',
    ],
  ];
};
