<?php

namespace App\Doranconet\Controllers;

use App\Doranconet\models\UserModel;

require_once __DIR__ . '/../models/UserModel.php';

class AuthController
{
  public function connection()
  {
    require_once __DIR__ . "/../views/login.php";
  }

  public function login()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    $_SESSION['email_err'] = $_SESSION['password_err'] = $_SESSION['login_err'] = '';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['login_err'] = "Token CSRF invalide.";
        header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "/login.php");
        exit;
      }

      $email = htmlspecialchars(trim($_POST["email"] ?? ''));
      $password = htmlspecialchars(trim($_POST["password"] ?? ''));

      if (empty($email)) {
        $_SESSION['email_err'] = "Veuillez entrer un email.";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['email_err'] = "Veuillez entrer une adresse email valide.";
      }

      if (empty($password)) {
        $_SESSION['password_err'] = "Veuillez entrer un mot de passe.";
      }

      if (!empty($_SESSION['email_err']) || !empty($_SESSION['password_err'])) {
        $_SESSION['email'] = $email;
        header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "/login.php");
        exit;
      }

      $userModel = new UserModel();
      $result = $userModel->verifUser($email, $password);

      if (is_array($result)) {
        $_SESSION['user'] = $result;
        header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "/view_posts.php");
        exit;
      } else {
        $_SESSION['login_err'] = $result;
        $_SESSION['email'] = $email;
        header("Location: /login");
        exit;
      }
    }

    if (!isset($_SESSION['csrf_token'])) {
      $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    header("Location: /");
    exit;
  }

  public function logout()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    session_unset();
    session_destroy();

    header("Location: /");
    exit;
  }
}
