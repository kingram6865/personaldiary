<?php

declare(strict_types=1);

use function App\Database\getDiaryEntriesByKeyword;

return static function (PDO $pdo): array {
    $keyword = trim($_GET['keyword'] ?? '');
    $entries = [];

    if ($keyword !== '') {
        $entries = getDiaryEntriesByKeyword($pdo, $keyword);
    }

    return [
        'title' => 'Search Diary Entries by Keyword',
        'contentView' => __DIR__ . '/../../views/pages/searchEntries.php',
        'keyword' => $keyword,
        'entries' => $entries,
    ];
};
