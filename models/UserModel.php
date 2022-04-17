<?php

namespace app\models;

use app\core\Model;

class UserModel extends Model
{
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;
    public string $passwordConfirm;

    public function validate()
    {
        // TODO: Implement validate() method.
    }

    public function register()
    {
        echo "Creating new user";

    }
}