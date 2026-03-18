<?php

declare(strict_types=1);

use App\Database\DiaryRepositoryClass;

return static function (\PDO $pdo): array {
  $repo = new DiaryRepositoryClass($pdo);

  $objid = isset($_GET['objid']) ? (int) $_GET['objid'] : 0;
  $entry = false;

  if ($objid > 0) {
    $entry = $repo->getById($objid);
  }

  return [
    'title' => 'View Diary Entry',
    'contentView' => __DIR__ . '/../../views/pages/viewEntry.php',
    'objid' => $objid,
    'entry' => $entry,
  ];
};
