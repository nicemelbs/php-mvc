<?php

namespace app\models;

use app\core\Model;

class UserModel extends Model
{
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';

    public function register()
    {
        //TODO: add logic
        return true;
    }

    public function rules(): array
    {
        return [
            //doesn't make sense in the real world to limit the length of the firstname
            //but it's a good example of how to use the validation rules
            'firstname' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 10]],

            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'passwordConfirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }


}