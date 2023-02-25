<?php

namespace app\core;

abstract class Model
{
    public const RULE_EMAIL = 'email';
    public const RULE_EMAIL_UNIQUE = 'emailUnique';
    public const RULE_REQUIRED = 'required';
    public const RULE_MATCH = 'match';

    public $errors;

    abstract public function rules(): array;

    public function validate() {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};

            foreach ($rules as $rule) {
                if ($rule === self::RULE_REQUIRED && !$value) {
                    $this->addErrors($attribute, $rule);
                }

                if ($rule === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addErrors($attribute, $rule);
                }
            }
       }
    }

    public function addErrors($attribute, $rule) {
        $message = $this->errorMessage()[$rule];
        return $this->errors[$attribute][] = $message;
    }

    public function errorMessage() {
        return [
            self::RULE_REQUIRED => "This field is required",
            self::RULE_EMAIL => "This field must be valid email format",
            self::RULE_EMAIL_UNIQUE => "Email already exists",
            self::RULE_MATCH => "This filed must be same as {match}"
        ];
    }

    public function mapData($data) {
        if ($data !== null) {
            foreach ($data as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->{$key} = $value;
                }
            }
        }
    }
}