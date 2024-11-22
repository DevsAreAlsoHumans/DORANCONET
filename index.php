<?php


use App\controllers\Router;
use doranconet\controllers\PostController;

include '/controllers/PostController.php';
//$router = new Router();
//$router->add('/', [PostController::class, 'index']);
//$router->add('/create_post', [PostController::class, 'create']);
//$currentUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//$router->dispatch($currentUri);
$posts_controller = new PostController();
?>