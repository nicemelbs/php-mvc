<?php

namespace app\models;

use app\core\db\DbModel;

class Post extends DbModel
{

    public string $title;
    public string $body;
    public string $user_id;


    public static function tableName()
    {
        return 'posts';
    }

    public function rules(): array
    {
        return [];
    }

    public function getUser(): User
    {
        return User::findById($this->user_id);
    }
}