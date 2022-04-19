<?php

namespace app\models;

use app\core\Model;

class ContactForm extends Model
{
    public string $subject = '';
    public string $email = '';
    public string $body = '';


    public function rules(): array
    {
        return [
            'subject' => [SELF::RULE_REQUIRED],
            'email' => [SELF::RULE_REQUIRED, SELF::RULE_EMAIL],
            'body' => [SELF::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'subject' => 'Subject',
            'email' => 'Email',
            'body' => 'Body',
            'button' => 'Send',
        ];
    }

    public function send()
    {
        //TODO: send email
        return true;
    }
}