<?php

require __DIR__ . '/../config/database.php';
//require('../config/database.php');
class PostModel {
   private $pdo;

    public function __construct()
    {
        $this->pdo = getDatabaseConnection();
    }
    public function savePost($user_id,$content,$image_path,$likes,$created_at): bool{
        $conn = $this ->pdo;
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

}
?>