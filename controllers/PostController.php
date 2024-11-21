<?php

namespace App\controllers;

use App\models\PostModel;

class PostController
{
    // Display all posts
    public function index()
    {
        $posts = Post::getAll();
        requireonce _DIR . '/../views/views_posts.php';
    }

    // Display post creation form and treatment function
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get data from form
            $user_id = $_POST['user_id'] ?? null;
            $content = $_POST['content'] ?? '';
            $image_path = $_POST['image_path'] ?? null;
            $likes = $_POST['likes'] ?? 0;
            $created_at = $POST['createdat'] ?? date('Y-m-d H:i:s');

            if (empty($user_id) || empty($content)) {
                die("L'utilisateur et le contenu sont obligatoires !");
            }

            // Create PostModel object
            $post = new PostModel(null, $user_id, $content, $image_path, $likes, $created_at);

            if ($post->createPost()) {
                header('Location: /posts');
                exit;
            } else {
                echo "Erreur lors de la création du post.";
            }
        }
        require_once __DIR . '/../views/create_post.php';
    }


}