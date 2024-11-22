<?php

use PHPUnit\Framework\TestCase;

class PostModelTest extends TestCase
{
    private $db;
    private $postModel;

    protected function setUp(): void
    {
        require_once __DIR__ . '/../config/database.php';
        require_once __DIR__ . '/../models/PostModel.php';

        $this->db = getDatabaseConnection();
        $this->postModel = new PostModel();
    }

    public function testInsert()
    {
        $userId = 1;
        $content = 'Test Content';
        $imagePath = 'test_image.jpg';
        $likes = "0";
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

    public function testGetAllPosts()
    {
        $posts = $this->postModel->getAllPosts();
        $this->assertIsArray($posts, 'La méthode getAllPosts n\'a pas retourné un tableau.');
        $this->assertNotEmpty($posts, 'Le tableau retourné par getAllPosts est vide.');

        // Vérifie le format du premier post (si des données existent déjà)
        if (!empty($posts)) {
            $this->assertArrayHasKey('id', $posts[0], 'Le post ne contient pas de champ "id".');
            $this->assertArrayHasKey('user_id', $posts[0], 'Le post ne contient pas de champ "user_id".');
            $this->assertArrayHasKey('content', $posts[0], 'Le post ne contient pas de champ "content".');
        }
    }

    public function testGetPostById()
    {
        $userId = 2;
        $content = 'Test Content 2';
        $imagePath = 'test_image2.jpg';
        $likes = "2";
        $createdAt = date('Y-m-d H:i:s');

        $this->postModel->insert($userId, $content, $imagePath, $likes, $createdAt);

        // Récupérer l'ID du post inséré
        $stmt = $this->db->prepare('SELECT id FROM posts WHERE content = :content');
        $stmt->bindParam(':content', $content);
        $stmt->execute();
        $postId = $stmt->fetchColumn();

        // Appeler la méthode à tester
        $post = $this->postModel->getPostById($postId);

        // Assertions
        $this->assertNotFalse($post, 'La méthode getPostById a échoué.');
        $this->assertEquals($postId, $post['id'], 'L\'ID du post récupéré ne correspond pas.');
        $this->assertEquals($content, $post['content'], 'Le contenu du post récupéré ne correspond pas.');
        $this->assertEquals($imagePath, $post['image_path'], 'Le chemin de l\'image ne correspond pas.');
        $this->assertEquals($likes, $post['likes'], 'Le nombre de likes ne correspond pas.');
        $this->assertEquals($createdAt, $post['created_at'], 'La date de création ne correspond pas.');
    }
}
