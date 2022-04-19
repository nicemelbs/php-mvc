<?php

namespace app\core;

abstract class DbModel extends Model
{
    static string $tableName;

    private static function prepare(string $query)
    {
        return Application::$app->db->pdo->prepare($query);
    }

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
        return true;
    }

    public function isUnique($attribute, $value): bool
    {
        $tableName = static::$tableName;
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
        $tableName = static::$tableName;
        $query = "SELECT * FROM $tableName WHERE ";
        $query .= implode(' AND ', array_map(function ($attribute) {
            return "$attribute = :$attribute";
        }, array_keys($attributes)));
        $statement = self::prepare($query);
        foreach ($attributes as $attribute => $value) {
            $statement->bindValue(':' . $attribute, $value);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }


}