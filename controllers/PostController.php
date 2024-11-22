<?php

namespace doranconet\controllers;
use PostModel;

require_once './models/PostModel.php';

class PostController
{
    public function index()
    {

        $posts = (new PostModel())->getAllPosts();
        $postsPath = __DIR__.'/../views/view_posts.php';
        if (file_exists($postsPath)) {
            include($postsPath);
        } else {
            echo "Le fichier de vue 'view_posts.php' est introuvable.";
        }
    }

    public function insert()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $userId = $_POST['user_id'] ?? null;
            $content = $_POST['content'] ?? '';
            $imagePath = $_POST['image_path'] ?? null;
            $likes = $_POST['likes'] ?? 0;
            $createdAt = $_POST['createdat'] ?? date('Y-m-d H:i:s');


            if (empty($userId) || empty($content)) {
                die("User ID et contenu sont obligatoires !");
            }
            $post = new PostModel();

            if ($post->insert($userId, $content, $imagePath, $likes, $createdAt)) {
                header('Location: /posts');
                exit;
            } else {
                echo "Erreur : Le post n'a pas pu être créé.";
            }
        }
        require_once __DIR__ . '/../views/create_post.php';
    }
}

