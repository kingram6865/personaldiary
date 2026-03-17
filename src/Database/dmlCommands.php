<?php
declare(strict_types=1);

namespace App\Database;

use PDO;
use PDOStatement;
use InvalidArgumentException;

function execute(PDO $pdo, string $sql, array $params = []): PDOStatement
{
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt;
}

function fetchAll(PDO $pdo, string $sql, array $params = []): array
{
    $stmt = execute($pdo, $sql, $params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function executeDml(PDO $pdo, string $sql, array $params = []): int
{
    $stmt = execute($pdo, $sql, $params);

    return $stmt->rowCount();
}

function insert(PDO $pdo, string $sql, array $params = []): int
{
    execute($pdo, $sql, $params);

    return (int) $pdo->lastInsertId();
}

function createDiaryEntry(PDO $pdo, array $data): int
{
  if (!isset($data['keywords']) || trim((string) $data['keywords']) === '') {
    throw new InvalidArgumentException('keywords is required.');
  }  

  $sql = 'INSERT INTO diary (title, keywords, full_text, note) 
          VALUES (:title, :keywords, :full_text, :note)';

  return insert($pdo, $sql, [
    'title' => normalizeNullableString($data['title'] ?? null),
    'keywords' => trim((string) $data['keywords']),
    'full_text' => normalizeNullableString($data['full_text'] ?? null),
    'note' => normalizeNullableString($data['note'] ?? null),
  ]);
}

function getAllDiaryEntries(PDO $pdo): array
{
    $sql = '
        SELECT
            objid, entry_date, title, keywords, full_text, 
            total_expenses, total_credits, total_income, 
            income_source, word_count, note, notes_word_count
        FROM diary
        ORDER BY entry_date DESC, objid DESC
    ';

    return fetchAll($pdo, $sql);
}

function getDiaryEntryById(PDO $pdo, int $objid): array|false
{
    $sql = '
        SELECT
            objid,
            entry_date,
            title,
            keywords,
            full_text,
            total_expenses,
            total_credits,
            total_income,
            income_source,
            word_count,
            note,
            notes_word_count
        FROM diary
        WHERE objid = :objid
    ';

    return fetchOne($pdo, $sql, [
        'objid' => $objid,
    ]);
}

function getDiaryEntriesByKeyword(PDO $pdo, string $keyword): array
{
    $sql = '
        SELECT
            objid,
            DATE_FORMAT(entry_date, "%Y-%m-%d %h:%i:%s") as recorded,
            title,
            keywords,
            full_text,
            total_expenses,
            total_credits,
            total_income,
            income_source,
            word_count,
            note,
            notes_word_count
        FROM diary
        WHERE keywords LIKE :keywords_like
           OR full_text LIKE :full_text_like
           OR note LIKE :note_like
        ORDER BY entry_date DESC, objid DESC
    ';

    $like = '%' . $keyword . '%';

    return fetchAll($pdo, $sql, [
        'keywords_like' => '%' . $keyword . '%',
        'full_text_like' => $like,
        'note_like' => $like,
    ]);
}

function getDiaryEntriesByPartialTitle(PDO $pdo, string $partialTitle): array
{
    $sql = '
        SELECT
            objid,
            entry_date,
            title,
            keywords,
            full_text,
            total_expenses,
            total_credits,
            total_income,
            income_source,
            word_count,
            note,
            notes_word_count
        FROM diary
        WHERE title LIKE :title
        ORDER BY entry_date DESC, objid DESC
    ';

    return fetchAll($pdo, $sql, [
        'title' => '%' . $partialTitle . '%',
    ]);
}

function updateDiaryEntry(PDO $pdo, int $objid, array $data): int
{
    if (!isset($data['keywords']) || trim((string) $data['keywords']) === '') {
        throw new InvalidArgumentException('keywords is required.');
    }

    $sql = '
        UPDATE diary
        SET
            entry_date = :entry_date,
            title = :title,
            keywords = :keywords,
            full_text = :full_text,
            total_expenses = :total_expenses,
            total_credits = :total_credits,
            total_income = :total_income,
            income_source = :income_source,
            word_count = :word_count,
            note = :note,
            notes_word_count = :notes_word_count
        WHERE objid = :objid
    ';

    return executeDml($pdo, $sql, [
        'objid' => $objid,
        'entry_date' => normalizeNullableDateTime($data['entry_date'] ?? null),
        'title' => normalizeNullableString($data['title'] ?? null),
        'keywords' => trim((string) $data['keywords']),
        'full_text' => normalizeNullableString($data['full_text'] ?? null),
        'total_expenses' => normalizeNullableDecimal($data['total_expenses'] ?? null),
        'total_credits' => normalizeNullableDecimal($data['total_credits'] ?? null),
        'total_income' => normalizeNullableDecimal($data['total_income'] ?? null),
        'income_source' => normalizeNullableString($data['income_source'] ?? null),
        'word_count' => normalizeNullableInt($data['word_count'] ?? null),
        'note' => normalizeNullableString($data['note'] ?? null),
        'notes_word_count' => normalizeNullableInt($data['notes_word_count'] ?? null),
    ]);
}

function normalizeNullableString(mixed $value): ?string
{
  if ($value === null) {
      return null;
  }

  $value = trim((string) $value);
  return $value === '' ? null : $value;
}

function normalizeNullableInt(mixed $value): ?int
{
  if ($value === null || $value === '') {
      return null;
  }

  return (int) $value;
}

function normalizeNullableDecimal(mixed $value): ?string
{
  if ($value === null || $value === '') {
      return null;
  }

  return (string) $value;
}