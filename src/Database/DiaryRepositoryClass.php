<?php

declare(strict_types=1);

namespace App\Database;

use PDO;
use InvalidArgumentException;

class DiaryRepositoryClass
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getById(int $objid): array|false
    {
        return fetchOne($this->pdo, '
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
        ', [
            'objid' => $objid,
        ]);
    }

    public function getAll(): array
    {
        return fetchAll($this->pdo, '
            SELECT objid, date_format(entry_date, "%Y-%m-%d %h:%i:%s") as recorded, title, keywords, full_text, note
            FROM diary
            ORDER BY entry_date DESC
        ');
    }

    public function create(array $data): int
    {
        if (!isset($data['keywords']) || trim((string) $data['keywords']) === '') {
            throw new InvalidArgumentException('keywords is required.');
        }

        return insert($this->pdo, '
            INSERT INTO diary (title, keywords, full_text, note)
            VALUES (:title, :keywords, :full_text, :note)
        ', [
            'title' => normalizeNullableString($data['title'] ?? null),
            'keywords' => trim((string) $data['keywords']),
            'full_text' => normalizeNullableString($data['full_text'] ?? null),
            'note' => normalizeNullableString($data['note'] ?? null),
        ]);
    }

    public function update(int $objid, array $data): int
    {
        if (!isset($data['keywords']) || trim((string) $data['keywords']) === '') {
            throw new InvalidArgumentException('keywords is required.');
        }

        return executeDml($this->pdo, '
            UPDATE diary
            SET
                title = :title,
                keywords = :keywords,
                full_text = :full_text,
                note = :note
            WHERE objid = :objid
        ', [
            'objid' => $objid,
            'title' => normalizeNullableString($data['title'] ?? null),
            'keywords' => trim((string) $data['keywords']),
            'full_text' => normalizeNullableString($data['full_text'] ?? null),
            'note' => normalizeNullableString($data['note'] ?? null),
        ]);
    }
}