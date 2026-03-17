<?php

declare(strict_types=1);

use function App\Database\fetchAll;

return static function (PDO $pdo): array {
    $entries = fetchAll(
        $pdo,
        'SELECT objid, date_format(entry_date, "%Y-%m-%d %h:%i:%s") as recorded, title, keywords, full_text, note
         FROM diary
         ORDER BY entry_date DESC'
    );

    return [
        'title' => 'All Diary Entries',
        'contentView' => __DIR__ . '/../../views/pages/listEntries.php',
        'entries' => $entries,
    ];
};
