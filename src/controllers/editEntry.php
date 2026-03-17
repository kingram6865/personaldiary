<?php

declare(strict_types=1);

use InvalidArgumentException;
use function App\Database\getDiaryEntryById;
use function App\Database\updateDiaryEntry;

return static function (\PDO $pdo): array {
    $objid = isset($_GET['objid']) ? (int) $_GET['objid'] : 0;

    $message = null;
    $error = null;

    $entry = false;

    if ($objid > 0) {
        $entry = getDiaryEntryById($pdo, $objid);
    }

    $formData = [
        'title' => $entry['title'] ?? '',
        'keywords' => $entry['keywords'] ?? '',
        'full_text' => $entry['full_text'] ?? '',
        'note' => $entry['note'] ?? '',
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $formData = [
            'title' => trim($_POST['title'] ?? ''),
            'keywords' => trim($_POST['keywords'] ?? ''),
            'full_text' => trim($_POST['full_text'] ?? ''),
            'note' => trim($_POST['note'] ?? ''),
        ];

        try {
            if ($formData['keywords'] === '') {
                throw new InvalidArgumentException('Keywords is required.');
            }

            updateDiaryEntry($pdo, $objid, [
                'title' => $formData['title'],
                'keywords' => $formData['keywords'],
                'full_text' => $formData['full_text'],
                'note' => $formData['note'],
            ]);

            $message = "Diary entry updated successfully.";

            // reload fresh data after update
            $entry = getDiaryEntryById($pdo, $objid);

            $formData = [
                'title' => $entry['title'] ?? '',
                'keywords' => $entry['keywords'] ?? '',
                'full_text' => $entry['full_text'] ?? '',
                'note' => $entry['note'] ?? '',
            ];

        } catch (\Throwable $e) {
            $error = $e->getMessage();
        }
    }

    return [
        'title' => 'Edit Diary Entry',
        'contentView' => __DIR__ . '/../../views/pages/editEntry.php',
        'objid' => $objid,
        'entry' => $entry,
        'message' => $message,
        'error' => $error,
        'formData' => $formData,
    ];
};