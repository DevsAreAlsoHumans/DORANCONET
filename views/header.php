<?php
session_start();
var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doranconet</title>
    <link rel="stylesheet" type="text/css" href="..\public\assets\css\header.css" />
    <link rel="stylesheet" href="../public/assets/css/login.css">
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <link rel="stylesheet" href="../public\assets/css/footer.css">
    <link rel="stylesheet" href="..\public\assets\css\register.css">
</head>


<body>
    <nav>
        <div class="menu">
            <ul class="menu">
                <li class="image">
                    <a href="view_posts.php"><img src="..\images\doranco-white.png" alt=""></a>
                    <ul class="sub-menu">
                    </ul>
                </li>
            </ul>

            <ul class="menu">
                <?php
                if (!empty($_SESSION["user"])) {
                ?>

                    <li class="menu-item">
                        <a href="create_post">Post</a>
                    </li>
                    <li class="menu-item">
                        <a href="logout">Log Out</a>
                        <ul class="sub-menu">
                        </ul>
                    </li>
                <?php
                } else {
                ?>
                    <li class="menu-item">
                        <a href="login">Login</a>
                        <ul class="sub-menu">
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="register">Register</a>
                        <ul class="sub-menu">
                        </ul>
                    </li>
                <?php
                }
                ?>
            </ul>   
        </div>
    </nav>
    </div>