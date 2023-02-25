<?php

namespace app\models;

use app\core\DbModel;

class ReservationModel extends DbModel
{
    public $reservation_id;
    public $total_price;
    public $data_created;
    public $user_id;

    public function orders($priceFrom, $priceTo, $dateFrom, $dateTo) {
        $priceFrom = $priceFrom == "" ? 0 : $priceFrom;
        $priceTo = $priceTo == "" ? 1000000 : $priceTo;

        $dateFrom = $dateFrom == "" ? "2022-01-01" : $dateFrom;
        $dateTo = $dateTo == "" ? date('Y-m-d') : $dateTo;

        $sqlString = "SELECT data_created, sum(total_price) as `total_price` from reservation
                      WHERE total_price > $priceFrom AND total_price < $priceTo AND data_created between '$dateFrom' AND '$dateTo' group by data_created";

        $dbResult = $this->db->conn()->query($sqlString);

        $resultArray = [];

        while($result = $dbResult->fetch_assoc()) {
            $resultArray[] = $result;
        }

        return $resultArray;
    }

    public function table(): string
    {
        return "reservation";
    }

    public function attributes(): array
    {
        return [
            "total_price",
            "data_created",
            "user_id"
        ];
    }

    public function rules(): array
    {
        return [];
    }
}