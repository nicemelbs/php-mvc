<?php

namespace app\core\db;

use app\core\Application;
use app\core\Model;
use PDOStatement;

abstract class DbModel extends Model
{
    abstract public function tableName();

    private static function prepare(string $query)
    {
        return Application::$app->db->pdo->prepare($query);
    }


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
        return true;
    }

    public function isUnique($attribute, $value): bool
    {
        $tableName = static::tableName();
        $query = "SELECT * FROM $tableName WHERE $attribute = :$attribute";
        $statement = self::prepare($query);
        $statement->bindValue(':' . $attribute, $value);
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return empty($result);
    }

    //find one record with attribute values
    public static function findOne(array $attributes): ?self
    {
        $statement = self::prepareStatement($attributes);
        $statement->execute();
        $object = $statement->fetchObject(static::class);

        if ($object === false) return null;
        return $object;
    }

    //find all records with attribute values
    public static function findAll(array $attributes): array
    {
        $statement = self::prepareStatement($attributes);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    protected static function prepareStatement(array $attributes): PDOStatement
    {
        $tableName = static::tableName();
        $query = "SELECT * FROM $tableName WHERE ";
        $query .= implode(' AND ', array_map(function ($attribute) {
            return "$attribute = :$attribute";
        }, array_keys($attributes)));
        $statement = self::prepare($query);
        foreach ($attributes as $param => $value) {
            $statement->bindValue(':' . $param, $value);
        }
        return $statement;
    }

}