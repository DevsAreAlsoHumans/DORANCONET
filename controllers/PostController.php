<?php

namespace App\controllers;

use DORANCONET\models\PostModel;

class Router
{
    private $routes = [];

    // Ajout d'une méthode pour ajouter des routes
    public function add($path, $action)
    {
        $this->routes[$path] = $action;
    }

    // Dispatch pour exécuter les actions en fonction des URI
    public function dispatch($uri)
    {
        foreach ($this->routes as $path => $action) {
            if ($path === $uri) {
                if (strpos($action, '@') !== false) {
                    list($controller, $method) = explode('@', $action);

                    // Ajout du namespace si nécessaire
                    $controller = "App\controllers\$controller";

                    // Vérifie que le contrôleur et la méthode existent
                    if (class_exists($controller) && method_exists($controller, $method)) {
                        $controllerInstance = new $controller();
                        $controllerInstance->$method();
                    } else {
                        echo "Erreur : Contrôleur ou méthode introuvable.";
                    }
                } else {
                    echo "Erreur : Action invalide.";
                }
                return;
            }
        }
        echo "404 - Route non trouvée.";
    }
}
class PostController
{
    // Afficher tous les posts
    public function index()
    {
        // Exemple de récupération de posts via un modèle (vous devrez implémenter PostModel::getAllPosts)
        $posts = PostModel::getAllPosts();
        require_once __DIR__ . '/../views/views_posts.php';
        var_dump("coucou");
    }

    // Afficher le formulaire de création et gérer la soumission
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupération des données du formulaire
            $user_id = $_POST['user_id'] ?? null;
            $content = $_POST['content'] ?? '';
            $image_path = $_POST['image_path'] ?? null;
            $likes = $_POST['likes'] ?? 0; // Correction de $POST en $_POST
            $created_at = $_POST['createdat'] ?? date('Y-m-d H:i:s'); // Correction de $POST en $_POST

            // Validation des données
            if (empty($userid) || empty($content)) {
                die("User ID et contenu sont obligatoires !");
            }

            // Création d'un nouvel objet PostModel
            $post = new PostModel(null, $userid, $content, $image_path, $likes, $created_at);

            if ($post->insert()) {
                header('Location: /posts');
                exit;
            } else {
                echo "Erreur : Le post n'a pas pu être créé.";
            }
        }

        // Charger la vue de création de post
        require_once __DIR__ . '/../views/create_post.php';
    }
}
