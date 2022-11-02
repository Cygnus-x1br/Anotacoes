<?php

namespace App;

class Connection
{

    public static function getDB()
    {
        try {
            // $conn = new \PDO("mysql:host=192.168.0.183;dbname=personal_notes;charset=utf8", "root", "aczf0704");
            // $conn = new \PDO("mysql:host=192.168.0.169;dbname=personal_notes;charset=utf8", "root", "aczf0704");
            // $conn = new \PDO("mysql:host=189.55.192.184;dbname=personal_notes;charset=utf8", "jean", "@Czf0704");
            $conn = new \PDO("mysql:host=jmarc.com.br;dbname=jean_notes;charset=utf8", "jean_jean", "@Czf0704");
            //echo 'Connected...';
            return $conn;
        } catch (\PDOException $err) {
            echo $err->getMessage();
        }
    }
}
