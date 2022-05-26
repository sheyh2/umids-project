<?php

namespace DB\Models;

require '../DB/DB.php';

use DB\DB;

class Salary extends DB
{
    public function insert(array $data)
    {
        $sql = 'INSERT INTO 
    salaries(
                employee,
                price1,
                price2,
                price3,
                price4,
                price5,
                price6,
                price7,
                price8,
                price9,
                price10,
                price11,
                price12,
                total
             ) VALUES (
                :employee,
                :price1,
                :price2,
                :price3,
                :price4,
                :price5,
                :price6,
                :price7,
                :price8,
                :price9,
                :price10,
                :price11,
                :price12,
                :total 
             )';
        $statement = $this->connect()->prepare($sql);

        foreach ($data as $row) {
            $statement->execute($row);
        }

        return true;
    }
}