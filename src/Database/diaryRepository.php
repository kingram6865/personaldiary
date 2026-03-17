<?php

declare(strict_types=1);

namespace App\Database;

use InvalidArgumentException;
use PDO;

function createDiaryEntry(PDO $pdo, array $data): int
{
    if (!isset($data['keywords']) || trim((string) $data['keywords']) === '') {
        throw new InvalidArgumentException('keywords is required.');
    }

    $sql = '
        INSERT INTO diary (title, keywords, full_text, note)
        VALUES (:title, :keywords, :full_text, :note)
    ';

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
            DATE_FORMAT(entry_date, "%Y-%m-%d %H:%i:%s") AS recorded,
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
        'keywords_like' => $like,
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
            title = :title,
            keywords = :keywords,
            full_text = :full_text,
            note = :note
        WHERE objid = :objid
    ';

    return executeDml($pdo, $sql, [
        'objid' => $objid,
        'title' => normalizeNullableString($data['title'] ?? null),
        'keywords' => trim((string) $data['keywords']),
        'full_text' => normalizeNullableString($data['full_text'] ?? null),
        'note' => normalizeNullableString($data['note'] ?? null),
    ]);
}