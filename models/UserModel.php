<?php

namespace Models;

use DateTime;

class User
{

    private $id;
    private $last_name;
    private $first_name;
    private $date_of_birth;

    private $email;

    private $profil_picture;

    private $password;

    private $is_active;

    private $deleted_at;

    public function __construct(int $id, string $last_name, string $first_name, DateTime $date_of_birth, string $email, string $profil_picture, string $password, bool $is_active, DateTime $deleted_at)
    {
        $this->id = $id;
        $this->last_name = $last_name;
        $this->first_name = $first_name;
        $this->date_of_birth = $date_of_birth;
        $this->email = $email;
        $this->profil_picture = $profil_picture;
        $this->password = $password;
        $this->is_active = $is_active;
        $this->deleted_at = $deleted_at;
    }

    public function getId() {
        return $this->id;
    }

    public function register() {

    }
}
