<?php
session_start();

if(!empty($_SESSION)){
    require "./views/view_posts.php";
} else {
    require "./views/login.php";
}