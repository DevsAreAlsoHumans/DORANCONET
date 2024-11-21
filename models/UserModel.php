<?php
namespace App\Doranconet\UserModel;
use http\Exception;
use PDO;
require "config/database.php";
class UserModel{
    public $id;
    public $firstName;
    public $lastName;
    public $date_of_birth;
    public $email;
    public $profile_picture;
    public $password;
    public $is_active;
    public $deleted_at;


    public function verifUser($email, $password)
    {
        $login_err = "";
        try {
            $stmt = $this->pdo->prepare("SELECT id, email, password FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() === 1) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                var_dump($user);
                if (password_verify($password, $user['password'])) {
                    $_SESSION["id"] = $user['id'];
                    $_SESSION["email"] = $user['email'];
                    header("Location: index.php"); // Redirection vers la page d'accueil après connexion
                    exit;
                } else {
                    $login_err = "Email ou mot de passe incorrect.";
                }
            } else {
                $login_err = "Email ou mot de passe incorrect.";
            }
        } catch (Exception $e) {
            error_log("Erreur lors de la connexion : " . $e->getMessage());
            echo "Une erreur est survenue. Veuillez réessayer plus tard.";
        }
        return $login_err;
    }
}