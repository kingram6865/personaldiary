<?php

declare(strict_types=1);

namespace App\Database;

use PDO;
use PDOStatement;

function execute(PDO $pdo, string $sql, array $params = []): PDOStatement
{
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt;
}

function fetchOne(PDO $pdo, string $sql, array $params = []): array|false
{
    $stmt = execute($pdo, $sql, $params);

    return $stmt->fetch(PDO::FETCH_ASSOC);
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

function normalizeNullableDateTime(mixed $value): ?string
{
  if ($value === null || $value === '') {
      return null;
  }

  return (string) $value;
}