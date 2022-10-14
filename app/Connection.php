<?php

namespace App;

class Connection
{

    public static function getDB()
    {
        try {
            $conn = new \PDO("mysql:host=127.0.0.1;dbname=personal_notes;charset=utf8", "root", "");
            //echo 'Connected...';
            return $conn;
        } catch (\PDOException $err) {
            echo $err->getMessage();
        }
    }
}
