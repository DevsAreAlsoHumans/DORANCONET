<?php
session_start();
require_once __DIR__ . '/../controllers/AuthController.php';

use App\Doranconet\Controllers\AuthController;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $authController = new AuthController();
    $authController->login();
    exit;
}

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$email_err = $_SESSION['email_err'] ?? '';
$password_err = $_SESSION['password_err'] ?? '';
$login_err = $_SESSION['login_err'] ?? '';
$email = $_SESSION['email'] ?? '';

unset($_SESSION['email_err'], $_SESSION['password_err'], $_SESSION['login_err'], $_SESSION['email']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="color-scheme" content="light dark" />
    <title>Connexion</title>
    <link rel="stylesheet" href="../public/assets/css/login.css">
    <link rel="stylesheet" href="../public/assets/css/style.css">
</head>
<body>
<header>
    <img src="../public/assets/img/doranco_image.png" alt="logo doranco" />
</header>
<main>
    <form action="" method="post">
        <?php if (!empty($login_err)): ?>
            <div class="error"><?php echo htmlspecialchars($login_err); ?></div>
        <?php endif; ?>

        <div>
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="<?php echo htmlspecialchars($email); ?>"
                required>
            <small class="error"><?php echo htmlspecialchars($email_err); ?></small>
        </div>

        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
            <small class="error"><?php echo htmlspecialchars($password_err); ?></small>
        </div>

        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <button type="submit">Se Connecter</button>
    </form>
    <?php require_once "footer.php";?>
</main>
</body>
</html>


