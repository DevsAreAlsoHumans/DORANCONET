<?php 
include "../controllers/PostController.php";
include "../models/PostModel.php"; 
?>
<link rel="stylesheet" href="../public/assets/css/view_posts.css">

<div class="posts">
    <?php
    if (isset($posts)) {
        foreach ($posts as $post) {
            echo "<div class='post'>";
            echo "<div class='name_user'> <p>" . htmlspecialchars($post["first_name"]) . " " . htmlspecialchars($post["last_name"]) . "</p> </div>";
            echo "<div class='post_content'> <p>" . htmlspecialchars($post["content"]) . "</p> </div>";
            echo "<img class='post_image' src='" . htmlspecialchars($post["image_path"]) . "'>";
            echo "<div class='post_likes'> <p>" . "<img class='heart_likes' src=../public/assets/img/heart.svg> " . htmlspecialchars($post["likes"]) . "</p> </div>";
            echo "<div class='post_created_at'> <p>" . "<img class='calendar' src=../public/assets/img/calendar.svg> " . htmlspecialchars($post["created_at"]) . "</p> </div>";
            echo "</div>";
        }
    } else {
        echo "Aucun post publié";
    }
    ?>
</div>
