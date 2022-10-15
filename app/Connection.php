<?php

namespace App;

class Connection
{

    public static function getDB()
    {
        try {
            $conn = new \PDO("mysql:host=192.168.0.183;dbname=personal_notes;charset=utf8", "root", "");
            //echo 'Connected...';
            return $conn;
        } catch (\PDOException $err) {
            echo $err->getMessage();
        }
    }
}
