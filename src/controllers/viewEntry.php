<?php

declare(strict_types=1);

use function App\Database\getDiaryEntryById;

return static function (\PDO $pdo): array {
    $objid = isset($_GET['objid']) ? (int) $_GET['objid'] : 0;
    $entry = false;

    if ($objid > 0) {
        $entry = getDiaryEntryById($pdo, $objid);
    }

    return [
        'title' => 'View Diary Entry',
        'contentView' => __DIR__ . '/../../views/pages/viewEntry.php',
        'objid' => $objid,
        'entry' => $entry,
    ];
};
