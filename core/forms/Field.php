<?php

namespace app\core\forms;

use app\core\Model;

class Field
{
    public Model $model;
    public string $attribute;
    public string $type;
    public const TYPE_TEXT = 'text';
    public const TYPE_NUMBER = 'number';
    public const TYPE_EMAIL = 'email';
    public const TYPE_PASSWORD = 'password';

    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = self::TYPE_TEXT;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function __toString()
    {
        return sprintf('
            <div class="form-group">
                <label for="%s">%s</label>
                <input type="%s" class="form-control %s" id="%s" name="%s" value="%s">
            </div>
        <div class="invalid-feedback d-block">%s</div>',
            $this->attribute,
            $this->model->labels()[$this->attribute] ?? $this->attribute,
            $this->type,
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->attribute,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->getFirstError($this->attribute)
        );
    }
}