<?php

require __DIR__ . '/../config/database.php';
//require('../config/database.php');
class PostModel {
   private $pdo;

    private $id;
    private $user_id;
    private $content;
    private $image_path;
    private $likes;
    private $created_at;


    public function __construct()
    {
        $this->pdo = getDatabaseConnection();
    }
    public function constructWithArguments($id, $user_id, $content, $image_path, $likes, $created_at)
    {
        $instance = new PostModel();
        $instance->id = $id;
        $instance->user_id = $user_id;
        $instance->content = $content;
        $instance->image_path = $image_path;
        $instance->likes = $likes;
        $instance->created_at = $created_at;
        return $instance;
    }
    public function insert($user_id,$content,$image_path,$likes,$created_at): bool{
        $conn = $this->pdo;
        try {
            // prepare and bind
            $stmt = $conn->prepare("INSERT INTO posts (user_id, content, image_path, likes,created_at) VALUES (:user_id, :content, :image_path, :likes,:created_at)");
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':image_path', $image_path);
            $stmt->bindParam(':likes', $likes);
            $stmt->bindParam(':created_at', $created_at);

            return $stmt->execute();
        } catch (Exception $e)
        {
            return false;
        }

    }
    public function getAllPosts(): array
    {
        $conn = $this ->pdo;
        $stmt = $conn->prepare("SELECT * FROM posts");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getPostById($id)
    {
        $conn = $this ->pdo;
        $stmt = $conn->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();

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
        return $this->user_id;
    }

    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
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
        return $this->image_path;
    }

    public function setImagePath($image_path): void
    {
        $this->image_path = $image_path;
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
        return $this->created_at;
    }

    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }


}
?>