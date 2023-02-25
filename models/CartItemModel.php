<?php

namespace app\models;

use app\core\DbModel;

class CartItemModel extends DbModel
{
    public $movie_id;
    public $name;
    public $price;
    public $image_url;
    public $quantity;

    public function table(): string
    {
        return "";
    }

    public function attributes(): array
    {
        return [];
    }

    public function rules(): array
    {
        return [];
    }
}