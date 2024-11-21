<?php

use Models\User;

class UserController
{

    public function register()
    {
        try {
            $user = new User(
                0,
                $_POST["first_name"],
                $_POST["last_name"],
                $_POST["trip-start"],
                $_POST["email"],
                $_POST["password"],
                $_POST["profile_picture"],
                true,
                new DateTime,
            );

            $result =  $user->register();
        } catch (Exception $e) {

            $e->getMessage();
        }
    }
}
