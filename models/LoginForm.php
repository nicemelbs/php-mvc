<?php

namespace app\models;

use app\core\Model;

class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function login()
    {
        $user = User::findOne(['email' => $this->email]);

        if (!$user || password_verify($this->password, $user->password) === false) {
            $this->addError('email', 'Wrong login or password');
            $this->addError('password', '');
            return false;
        }

//        return Application::$app->login($user);
        return $user;
    }

    public function labels(): array
    {
        return [
            'email' => 'Email',
            'password' => 'Password'
        ];
    }

}