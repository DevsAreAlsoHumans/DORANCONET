<?php

namespace Models;

use DateTime;

class User
{

    private $pdo;
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

        $this->pdo = getDatabaseConnection();

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
    public function getLastName() {
        return $this->last_name;
    }

    public function getFirstName() {   
        return $this->first_name;
    }

    public function getDateOfBirth() {
        return $this->date_of_birth;    
    }

    public function getEmail() {
        return $this->email;    
    }

    public function getProfilPicture() { 
        return $this->profil_picture;
    }   

    public function getPassword() {
        return $this->password;
    }

    public function isActive() { 
        return $this->is_active;
    }   

    public function isDeleted() {
        return $this->deleted_at;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setLastName($last_name) {
        $this->last_name = $last_name;
    }

    public function setFirstName($first_name) {
        $this->first_name = $first_name;
    }

    public function setDateOfBirth($date_of_birth) {    
        $this->date_of_birth = $date_of_birth;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setProfilPicture($profil_picture) {
        $this->profil_picture = $profil_picture;
    }

    public function setPassword($password) {
        $this->password = $password;   
    }

    public function setIsActive($is_active) {
        $this->is_active = $is_active;
    }

    public function setDeletedAt($deleted_at) {
        $this->deleted_at = $deleted_at;
    }




    public function register() {

        require('connect.php');


        $query = "INSERT INTO 'users' (last_name, first_name, date_of_birth, email, profil_picture, password) VALUES ('$last_name', '$$first_name', '$date_of_birth', '$email', '$profil_picture','$password') ";
    }
}
