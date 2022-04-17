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

    public function register()
    {
        //TODO: add logic
        return true;
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, ['min' => 8]]],
            'passwordConfirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, ['match' => 'password']]],
        ];
    }


}