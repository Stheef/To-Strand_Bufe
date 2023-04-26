<?php

namespace App\Lib;

class Database
{
    public function getConnection()
    {
        try {
            $dsn = "mysql:host=127.0.0.1;dbname=to-strand_bufe;charset=utf8;port:3306";
            $user = "root";
            $password = "";
            $conn = new \PDO($dsn, $user, $password);
        } catch (\PDOException $ex) {
            var_dump($ex);
        }
        return $conn;
    }
}
