<?php

declare(strict_types=1);

use App\Database\DiaryRepositoryClass;

return static function (PDO $pdo): array {
  $repo = new DiaryRepositoryClass($pdo);

  $titleQuery = trim($_GET['title'] ?? '');
  $entries = [];

  if ($titleQuery !== '') {
    $entries = $repo->searchByPartialTitle($titleQuery);
  }

  return [
    'title' => 'Search Diary Entries by Partial Title',
    'contentView' => __DIR__ . '/../../views/pages/titleSearchEntries.php',
    'titleQuery' => $titleQuery,
    'entries' => $entries,
  ];
};
