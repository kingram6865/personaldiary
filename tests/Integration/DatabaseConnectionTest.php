<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class DatabaseConnectionTest extends TestCase
{
    public function testCanConnectToDatabase(): void
    {
        require __DIR__ . '/../bootstrap.php';

        $pdo = $database->getConnection('default');
        $stmt = $pdo->query('SELECT NOW() AS current_db_time');
        $row = $stmt->fetch();

        $this->assertIsArray($row);
        $this->assertArrayHasKey('current_db_time', $row);
        $this->assertNotEmpty($row['current_db_time']);
    }
}
