<?php

namespace app\models;

class User extends UserModel
{


    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getPosts(): array
    {
        return Post::findAll(['user_id' => $this->{$this->primaryKey()}]);
    }

    /**
     * @static
     */
    public function getPostById(int $id): Post
    {
        return Post::findOne(['id' => $id]);
    }

}