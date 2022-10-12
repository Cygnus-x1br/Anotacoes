<?php

namespace App;

class Connection
{

    public static function getDB()
    {
        try {
            $conn = new \PDO("mysql:host=localhost;dbname=mvc;charset=utf8", "root", "");
            //echo 'Connected...';
            return $conn;
        } catch (\PDOException $err) {
            echo $err->getMessage();
        }
    }
}
