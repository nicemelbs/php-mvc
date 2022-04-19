<?php

namespace app\models;

abstract class UserModel extends \app\core\DbModel
{
    abstract public function getDisplayName(): string;
}