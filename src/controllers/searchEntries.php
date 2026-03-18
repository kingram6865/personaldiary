<?php

declare(strict_types=1);

use App\Database\DiaryRepositoryClass;

return static function (PDO $pdo): array {
    $repo = new DiaryRepositoryClass($pdo);

    $keyword = trim($_GET['keyword'] ?? '');
    $entries = [];

    if ($keyword !== '') {
        $entries = $repo->searchByKeyword($keyword);
    }

    return [
        'title' => 'Search Diary Entries by Keyword',
        'contentView' => __DIR__ . '/../../views/pages/searchEntries.php',
        'keyword' => $keyword,
        'entries' => $entries,
    ];
};
