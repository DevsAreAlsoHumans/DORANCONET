<?php

require_once __DIR__ . '/../config/database.php';
//require('../config/database.php');
class PostModel {
   private $pdo;

    private $id;
    private $userId;
    private $content;
    private $imagePath;
    private $likes;
    private $createdAt;


    public function __construct()
    {
        $this->pdo = getDatabaseConnection();
    }
    public function constructWithArguments($id, $userId, $content, $imagePath, $likes, $createdAt)
    {
        $instance = new PostModel();
        $instance->id = $id;
        $instance->userId = $userId;
        $instance->content = $content;
        $instance->imagePath = $imagePath;
        $instance->likes = $likes;
        $instance->createdAt = $createdAt;
        return $instance;
    }
    public function insert($userId,$content,$imagePath,$likes,$createdAt): bool{
        $conn = $this->pdo;
        try {
            // prepare and bind
            $stmt = $conn->prepare("INSERT INTO posts (user_id, content, image_path, likes,created_at) VALUES (:user_id, :content, :image_path, :likes,:created_at)");
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':image_path', $imagePath);
            $stmt->bindParam(':likes', $likes);
            $stmt->bindParam(':created_at', $createdAt);

            return $stmt->execute();
        } catch (Exception $e)
        {
            return false;
        }

    }
    public function getAllPosts(): array
    {
        try {
            // prepare and bind
            $conn = $this ->pdo;
            $stmt = $conn->prepare("SELECT * FROM posts");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e)
        {
            return false;
        }
    }
    public function getPostById($id)
    {

        try {
            $conn = $this ->pdo;
            $stmt = $conn->prepare("SELECT * FROM posts WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e)
        {
            return false;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content): void
    {
        $this->content = $content;
    }

    public function getImagePath()
    {
        return $this->imagePath;
    }

    public function setImagePath($imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    public function getLikes()
    {
        return $this->likes;
    }

    public function setLikes($likes): void
    {
        $this->likes = $likes;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }


}
?>