<?php 
include "../controllers/PostController.php";
include "../models/PostModel.php"; 
?>
<link rel="stylesheet" href="../public/assets/css/style.css">

<?php
/*
$array = array(
    "first_name" => "Killian",
    "last_name" => "foot",
    "content" => "test content",
    "image_path" => "../public/assets/img/Memoji.jpg",
    "likes" => "30k",
    "created_at" => "20-06-23",
);
$array2 = array(
    "first_name" => "Killian",
    "last_name" => "foot",
    "content" => "test content",
    "image_path" => "../public/assets/img/Memoji.jpg",
    "likes" => "30k",
    "created_at" => "20-06-23",
);

$posts = array(
    $array,
    $array2
)
*/
?>

<div class="posts">
    <?php
    foreach ($posts as $post) {
        echo "<div class='post'>";
        echo "<div class='name_user'> <p>" . htmlspecialchars($post["first_name"]) . " " . htmlspecialchars($post["last_name"]) . "</p> </div>";
        echo "<div class='post_content'> <p>" . htmlspecialchars($post["content"]) . "</p> </div>";
        echo "<img class='post_image' src='" . htmlspecialchars($post["image_path"]) . "'>";
        echo "<div class='post_likes'> <p>" . "<img class='heart_likes' src=../public/assets/img/heart.svg> " . htmlspecialchars($post["likes"]) . "</p> </div>";
        echo "<div class='post_created_at'> <p>" . "<img class='calendar' src=../public/assets/img/calendar.svg> " . htmlspecialchars($post["created_at"]) . "</p> </div>";
        echo "</div>";
    }
    ?>
</div>