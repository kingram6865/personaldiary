<?php

declare(strict_types=1);

use function App\Database\getDiaryEntriesByPartialTitle;

return static function (PDO $pdo): array {
    $titleQuery = trim($_GET['title'] ?? '');
    $entries = [];

    if ($titleQuery !== '') {
        $entries = getDiaryEntriesByPartialTitle($pdo, $titleQuery);
    }

    return [
        'title' => 'Search Diary Entries by Partial Title',
        'contentView' => __DIR__ . '/../../views/pages/titleSearchEntries.php',
        'titleQuery' => $titleQuery,
        'entries' => $entries,
    ];
};
