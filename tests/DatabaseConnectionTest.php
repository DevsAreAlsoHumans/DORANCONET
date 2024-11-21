<?php

use PHPUnit\Framework\TestCase;

class DatabaseConnectionTest extends TestCase
{
    private $db;

    protected function setUp(): void
    {
        require __DIR__ . '/../config/database.php';
    }

    public function testDatabaseConnection()
    {
        $this->db = getDatabaseConnection();
        $this->assertInstanceOf(PDO::class, $this->db, 'La connexion à la base de données n\'est pas une instance valide de PDO.');

        $stmt = $this->db->query('SELECT 1');
        $this->assertTrue($stmt !== false, 'La requête de test a échoué.');
    }

    protected function tearDown(): void
    {

        $this->db = null;
    }
}
