<?php
namespace App\Doranconet\models;

use PDO;
use PDOException;
use DateTime;

require_once __DIR__ . '/../config/database.php';

class UserModel
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = getDatabaseConnection();
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . htmlspecialchars($e->getMessage()));
        }
    }

    public function verifUser($email, $password)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT id, email, password FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() === 1) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if (password_verify($password, $user['password'])) {
                    return $user;
                } else {
                    return "Email ou Mot de passe incorrect.";
                }
            } else {
                return "Email ou Mot de passe incorrect.";
            }
        } catch (PDOException $e) {
            error_log("Erreur lors de la vérification de l'utilisateur : " . $e->getMessage());
            return "Une erreur interne est survenue. Veuillez réessayer plus tard.";
        }
    }

    public function registerUser($firstName, $lastName, $dateOfBirth, $email, $password, $profilePicture)
    {
        try {
            // Hash du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insertion dans la base de données
            $stmt = $this->pdo->prepare("
                INSERT INTO users (first_name, last_name, date_of_birth, email, password, profile_picture, is_active)
                VALUES (:first_name, :last_name, :date_of_birth, :email, :password, :profile_picture, 1)
            ");

            $stmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
            $stmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
            $stmt->bindParam(':date_of_birth', $dateOfBirth, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':profile_picture', $profilePicture, PDO::PARAM_STR);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Erreur SQL : " . $e->getMessage());
            return "Erreur SQL : " . $e->getMessage(); // Retourner l'erreur pour débogage
        }
    }



}
?>
