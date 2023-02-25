<?php

namespace app\models;

use app\core\DbModel;

class CartModel extends DbModel
{
    public array $cart_items = [];
    public $total_price;

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