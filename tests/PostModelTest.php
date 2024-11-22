<?php

use PHPUnit\Framework\TestCase;

class PostModelTest extends TestCase
{
    private $db;
    private $postModel

    protected function setUp(): void
    {
        require __DIR__ . '/../config/database.php';
        require __DIR__ . '/../models/PostModel.php';

        $postModel = new PostModel();
    }

    public function testConstruct(): void {
        
        $this->assertInstanceOf(PostModel::class, $postModel);
    }

    public function testInsert()
    {
        $userId = 1;
        $content = 'Test Content';
        $imagePath = 'test_image.jpg';
        $likes = 0;
        $createdAt = date('Y-m-d H:i:s');

        $result = $this->postModel->insert($userId, $content, $imagePath, $likes, $createdAt);
        $this->assertTrue($result, 'L\'insertion dans la base de données a échoué.');

        // Vérifie si l'enregistrement a été inséré
        $stmt = $this->db->prepare('SELECT * FROM posts WHERE content = :content');
        $stmt->bindParam(':content', $content);
        $stmt->execute();
        $record = $stmt->fetch();

        $this->assertNotEmpty($record, 'Aucun enregistrement trouvé après l\'insertion.');
        $this->assertEquals($content, $record['content'], 'Le contenu de l\'enregistrement ne correspond pas.');
    }
}
