<?php

namespace DB;

use Exception;
use PDO;
use RuntimeException;

class DB
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db = 'test';

    /**
     * @return PDO
     */
    public function connect()
    {
        try {
            $host = $this->host;
            $db = $this->db;

            $connect = new PDO('mysql:host='.$host.';dbname='.$db, $this->username, $this->password);

            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $connect;
        } catch (Exception $exception) {
            echo $exception->getMessage();
//            throw new RuntimeException($exception->getMessage(), 500);
        }
    }
}