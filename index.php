<?php

require_once "./controllers/UserController.php";
require_once "./controllers/AuthController.php";
require_once "./router.php";

use App\Doranconet\Controllers\AuthController;
use App\Doranconet\Controllers\UserController;
use App\Router;

$authController = new AuthController;
$userController = new UserController;
$postController = null; // TODO: set postController

Router::addRoute("GET", "/", [$postController, "viewPost"]);

Router::addRoute("GET", "/createUser", [$userController, "createUser"]);
Router::addRoute("POST", "/register", [$userController, "register"]);
Router::addRoute("GET", "/login", [$authController, "connection"]);
Router::addRoute("GET", "/logout", [$authController, "logout"]);

$method = $_SERVER["REQUEST_METHOD"];
$path = $_SERVER["REQUEST_URI"];

Router::dispatch($method, $path);
