<?php

declare(strict_types=1);

use App\Database\DiaryRepositoryClass;

return static function (\PDO $pdo): array {
    $repo = new DiaryRepositoryClass($pdo);
    $entries = $repo->getAll();

    return [
        'title' => 'All Diary Entries',
        'contentView' => __DIR__ . '/../../views/pages/listEntries.php',
        'entries' => $entries,
    ];
};
