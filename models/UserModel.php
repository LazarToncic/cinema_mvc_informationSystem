<?php

namespace app\models;

use app\core\DbModel;

class UserModel extends DbModel
{
    public string $user_id;
    public string $email;
    public string $password;
    public string $name;
    public string $last_name;
    public string $gender;
    public $age;

    public function table(): string
    {
        return "user";
    }

    public function attributes(): array
    {
        return [
            "email",
            "password",
            "name",
            "last_name",
            "gender",
            "age"
        ];
    }

    public function rules(): array
    {
        return [];
    }
}