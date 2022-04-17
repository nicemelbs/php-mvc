<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';

    public array $errors = [];

    //Should be called with data = request->getBody()
    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function validate(): bool
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;

                if (is_array($rule)) {
                    $ruleName = $rule[0];
                }

                if ($ruleName === self::RULE_REQUIRED && empty($value)) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }

                //$value being an empty string is redundant for length validation
                if ($ruleName === self::RULE_EMAIL && !empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }

                //rule[1] is the value of the rule
                //$value being an empty string is redundant for length validation
                if ($ruleName === self::RULE_MIN && !empty($value) && strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }

                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }

                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addError($attribute, self::RULE_MATCH);
                }
            }

        }

        return empty($this->errors);
    }

    //adds error to $errors array
    protected function addError($attribute, $rule, $params = [])
    {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'Email is not valid',
            self::RULE_MIN => 'Must be {min} characters or more',
            self::RULE_MAX => 'Must be {max} characters or fewer',
            self::RULE_MATCH => 'Values do not match',
            self::RULE_UNIQUE => 'Value is not unique',
        ];
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? '';
    }


    abstract public function rules(): array;

    private function isUnique(int $attribute, $value): bool
    {
        return true;
    }

    public function hasError($attribute): bool
    {
        return isset($this->errors[$attribute]);
    }
}