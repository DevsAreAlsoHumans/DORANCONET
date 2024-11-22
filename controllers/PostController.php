<?php

namespace doranconet\controllers;
require_once '/../models/PostModel.php';
use doranconet\models\PostModel;


class PostController
{
    // Afficher tous les posts
    public function index()
    {
        // Récupérer tous les posts via le modèle
        $posts = (new PostModel())->getAllPosts();
        $posts_path = dirname(__FILE__) . '/views/view_posts.php';

        if (file_exists($posts_path)) {
            include($posts_path);
        } else {
            echo "Le fichier de vue 'view_posts.php' est introuvable.";
        }
    }

//    // Afficher le formulaire de création et gérer la soumission
//    public function insert()
//    {
//        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//            // Récupération des données du formulaire
//            $user_id = $_POST['user_id'] ?? null;
//            $content = $_POST['content'] ?? '';
//            $image_path = $_POST['image_path'] ?? null;
//            $likes = $_POST['likes'] ?? 0; // Correction de $POST en $_POST
//            $created_at = $_POST['createdat'] ?? date('Y-m-d H:i:s'); // Correction de $POST en $_POST
//
//            // Validation des données
//            if (empty($userid) || empty($content)) {
//                die("User ID et contenu sont obligatoires !");
//            }
//
//            // Création d'un nouvel objet PostModel
//            $post = new PostModel();
//
//            if ($post->insert($userid, $content, $image_path, $likes, $created_at)) {
//                header('Location: /posts');
//                exit;
//            } else {
//                echo "Erreur : Le post n'a pas pu être créé.";
//            }
//        }
//
//        // Charger la vue de création de post
//        require_once __DIR__ . '/../views/create_post.php';
//    }
}

