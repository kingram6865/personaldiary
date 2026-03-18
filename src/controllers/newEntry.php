<?php

declare(strict_types=1);

use InvalidArgumentException;
use Throwable;

use App\Database\DiaryRepositoryClass;

return static function (\PDO $pdo): array {
  $repo = new DiaryRepositoryClass($pdo);

  $message = null;
  $error = null;

  $formData = [
    'title' => '',
    'keywords' => '',
    'full_text' => '',
    'note' => '',
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

      $newId = $repo->create($formData);
      // $newId = createDiaryEntry($pdo, [
      //   'title' => $formData['title'],
      //   'keywords' => $formData['keywords'],
      //   'full_text' => $formData['full_text'],
      //   'note' => $formData['note'],
      // ]);

      $message = "Diary entry created successfully. objid: {$newId}";
    } catch (Throwable $e) {
      $error = $e->getMessage();
    }
  }

  return [
    'title' => 'Add Diary Entry',
    'contentView' => __DIR__ . '/../../views/pages/newDiaryEntry.php',
    'message' => $message,
    'error' => $error,
    'formData' => $formData,
  ];
};
