<?php
namespace App\Doranconet\Controllers;
use App\Doranconet\UserModel;
use http\Exception;
use PDO;
require "config/database.php";
class AuthController
{
    private $pdo;
    public function login()
    {
        session_start();
        $email = $password = "";
        $email_err = $password_err = $login_err = "";
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die("Invalid CSRF token.");
            }
            $email = htmlspecialchars(trim($_POST["email"]));
            $password = htmlspecialchars(trim($_POST["password"]));
            if (empty($email)) {
                $email_err = "Please enter an email address.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_err = "Please enter a valid email address.";
            }
            if (empty($password)) {
                $password_err = "Please enter a password.";
            }
            if (empty($email_err) && empty($password_err)) {
                try {
                    $stmt = $this->pdo->prepare("SELECT id, email, password FROM users WHERE email = :email");
                    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmt->execute();
                    if ($stmt->rowCount() === 1) {
                        $user = $stmt->fetch(PDO::FETCH_ASSOC);
                        if (password_verify($password, $user['password'])) {
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $user['id'];
                            $_SESSION["email"] = $user['email'];
                            header("location: index.php");
                            exit;
                        } else {
                            $login_err = "email or password is incorrect.";
                        }
                    } else {
                        $login_err = "email or password is incorrect.";
                    }
                } catch (Exception $e) {
                    error_log("Error while connecting: " . $e->getMessage());
                    echo "An error has occurred. Please try again later.";
                }
            }
        }
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        if (!empty($login_err)) {
            echo "<p style='color:red;'>$login_err</p>";
        }

    }
}