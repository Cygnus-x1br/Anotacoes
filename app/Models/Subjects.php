<?php

namespace App\Models;

use MF\Model\Model;

class Subjects extends Model
{
    private $idsubject;
    private $subject;

    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function getAllSubjects()
    {
        $subjects = "SELECT * FROM tb_subject";
        $stmt = $this->db->prepare($subjects);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getSubject()
    {
        $subjects = "SELECT * FROM tb_subject WHERE IDSUBJECT=:idsubject";
        $stmt = $this->db->prepare($subjects);
        $stmt->bindValue(':idsubject', $this->__get('idsubject'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function addSubject()
    {
        $subject = "INSERT INTO tb_subject(subject) VALUES(:subject)";
        $stmt = $this->db->prepare($subject);
        $stmt->bindValue(':subject', $this->__get('subject'));
        $stmt->execute();

        return $this;
    }
}
