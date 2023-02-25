<?php

namespace app\models;

use app\core\DbModel;

class ReservationItemModel extends DbModel
{
    public $reservation_item_id;
    public $movie_id;
    public $reservation_id;
    public $price;
    public $quantity;

    public function table(): string
    {
        return "reservation_item";
    }

    public function attributes(): array
    {
        return [
            "movie_id",
            "reservation_id",
            "price",
            "quantity"
        ];
    }

    public function rules(): array
    {
        return [];
    }
}