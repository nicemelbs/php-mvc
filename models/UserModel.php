<?php

namespace app\models;

abstract class UserModel extends \app\core\db\DbModel
{
    abstract public function getDisplayName(): string;
}