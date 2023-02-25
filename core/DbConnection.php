<?php

namespace app\core;

use mysqli;

class DbConnection
{
    public function conn(): mysqli
    {
        $sql = new mysqli("localhost", "root", "", "mvc_cinema_is");

        return $sql;
    }
}