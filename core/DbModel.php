<?php

namespace app\core;

abstract class DbModel extends Model
{

    abstract public function tableName(): string;

    abstract public function attributes(): array;

    abstract public function primaryKey(): string;

    //save data to database
    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();

        foreach ($attributes as $key => $value) {
            $attributes[$key] = "'$value'";
        }

        $query = "INSERT INTO $tableName (";
        $query .= implode(', ', array_keys($attributes));
        $query .= ") VALUES (";

        $query .= implode(',', array_values($attributes));
        $query .= ')';

        $db = Application::$app->db;

        //TODO: handle errors
        $db->pdo->exec($query);

    }
}