<?php

namespace app\core;

abstract class Model
{

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

    abstract public function validate();

}