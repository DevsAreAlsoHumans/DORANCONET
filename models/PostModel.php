<?php

require __DIR__ . '/../config/database.php';
//require('../config/database.php');
class PostModel {
   private $id;
   private $user_id;
   private $content;
   private $image_path;
   private $likes;
   private $created_at;
   private $pdo;


    public function __construct($id, $user_id, $content, $image_path, $likes, $created_at)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->content = $content;
        $this->image_path = $image_path;
        $this->likes = $likes;
        $this->created_at = $created_at;
        $this->pdo = getDatabaseConnection();

    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getImagePath()
    {
        return $this->image_path;
    }

    public function setImagePath($image_path)
    {
        $this->image_path = $image_path;
    }

    public function getLikes()
    {
        return $this->likes;
    }

    public function setLikes($likes)
    {
        $this->likes = $likes;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }
    public function savePost(): bool{
        $conn = $this ->pdo;
        try {
            // prepare and bind
            $stmt = $conn->prepare("INSERT INTO posts (user_id, content, image_path, likes,created_at) VALUES (:user_id, :content, :image_path, :likes,:created_at)");
            $stmt->bindParam(':user_id', $this->user_id);
            $stmt->bindParam(':content', $this->content);
            $stmt->bindParam(':image_path', $this->image_path);
            $stmt->bindParam(':likes', $this->likes);
            $stmt->bindParam(':created_at', $this->created_at);

            return $stmt->execute();
        } catch (Exception $e)
        {
            return false;
        }

    }

}
?>