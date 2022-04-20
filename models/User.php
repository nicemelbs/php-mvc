<?php

namespace app\models;

class User extends UserModel
{

    public static function findById(string $user_id): ?User
    {
        return self::findOne(['id' => $user_id]);
    }

    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getPosts(): array
    {
        return Post::findAll(['user_id' => $this->{$this->primaryKey()}]);
    }

    public function getPostById(int $id): Post
    {
        return Post::findOne(['id' => $id]);
    }

}