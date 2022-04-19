<?php

namespace app\core;

abstract class DbModel extends Model
{

    private static function prepare(string $query)
    {
        return Application::$app->db->pdo->prepare($query);
    }

    abstract public function tableName(): string;

    abstract public function attributes(): array;

    abstract public function primaryKey(): string;

    //save data to database
    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();

        $params = array_map(function ($attribute) {
            return ':' . $attribute;
        }, $attributes);

        $query = "INSERT INTO $tableName (";
        $query .= implode(',', $attributes);
        $query .= ') VALUES (';
        $query .= implode(',', $params);
        $query .= ')';

        $statement = self::prepare($query);

        foreach ($attributes as $attribute) {
            $statement->bindValue(':' . $attribute, $this->{$attribute});

        }

        $statement->execute();
    }
}