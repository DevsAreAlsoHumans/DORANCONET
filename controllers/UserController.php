<?php

namespace App\Doranconet\Controllers;

use App\Doranconet\models\UserModel;
use Exception;

require_once __DIR__ . '/../models/UserModel.php';

class UserController
{
    public function register()
{
    try {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                throw new Exception("CSRF token invalide.");
            }

            $firstName = htmlspecialchars(trim($_POST['first_name'] ?? ''));
            $lastName = htmlspecialchars(trim($_POST['last_name'] ?? ''));
            $dateOfBirth = htmlspecialchars(trim($_POST['trip-start'] ?? ''));
            $email = htmlspecialchars(trim($_POST['email'] ?? ''));
            $password = htmlspecialchars(trim($_POST['password'] ?? ''));
            $profilePicture = htmlspecialchars(trim($_POST['profile_picture'] ?? ''));

            // Log des données pour débogage
            error_log("Données soumises : " . json_encode([
                'firstName' => $firstName,
                'lastName' => $lastName,
                'dateOfBirth' => $dateOfBirth,
                'email' => $email,
                'password' => $password,
                'profilePicture' => $profilePicture
            ]));

            if (empty($firstName) || empty($lastName) || empty($dateOfBirth) || empty($email) || empty($password)) {
                throw new Exception("Tous les champs sont obligatoires.");
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Email invalide.");
            }

            $userModel = new UserModel();
            $result = $userModel->registerUser($firstName, $lastName, $dateOfBirth, $email, $password, $profilePicture);

            if ($result === true) {
                $_SESSION['success_message'] = "Enregistrement réussi !";
                header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "/login.php");
                exit;
            } else {
                throw new Exception($result);
            }
        }
    } catch (Exception $e) {
        $_SESSION['register_error'] = $e->getMessage();
        header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "/login.php");
        exit;
    }
}

}
