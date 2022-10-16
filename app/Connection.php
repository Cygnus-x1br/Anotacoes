<?php

namespace App;

class Connection
{

    public static function getDB()
    {
        try {
            // $conn = new \PDO("mysql:host=192.168.0.183;dbname=personal_notes;charset=utf8", "root", "");
            $conn = new \PDO("mysql:host=192.168.0.169;dbname=personal_notes;charset=utf8", "root", "aczf0704");
            //echo 'Connected...';
            return $conn;
        } catch (\PDOException $err) {
            echo $err->getMessage();
        }
    }
}
