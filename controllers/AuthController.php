<?php
namespace App\Doranconet\Controllers;
use App\Doranconet\UserModel\UserModel;
require "../config/database.php";
class AuthController
{
    public function login()
    {
        session_start();
        // Si la méthode de la requête est POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Vérification du token CSRF
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die("Token CSRF invalide.");
            }

            // Récupération des données du formulaire
            $email = htmlspecialchars(trim($_POST["email"]));
            $password = htmlspecialchars(trim($_POST["password"]));
            var_dump($email);
            var_dump($password);
            $email_err = $password_err = $login_err = "";
            // Validation des données
            if (empty($email)) {
                $email_err = "Veuillez entrer un email.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_err = "Veuillez entrer un email valide.";
            }

            if (empty($password)) {
                $password_err = "Veuillez entrer un mot de passe.";
            }

            // Si aucune erreur de validation, vérifier l'utilisateur
            if (empty($email_err) && empty($password_err)) {
                $userModel = new UserModel();  // Instanciation du modèle
                $login_err = $userModel->verifUser($email, $password); // Vérification des identifiants
            }
        }

        // Génération du token CSRF pour le formulaire
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Inclusion de la vue et transmission des erreurs
        require "views/login.php";
    }
}