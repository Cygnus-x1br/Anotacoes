<?php

namespace App\Models;

use MF\Model\Model;

class Schools extends Model
{
    private $idschool;
    private $school_name;
    private $school_link;
    private $school_logo;

    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function getAllSchools()
    {
        $schools = "SELECT * FROM tb_schools ORDER BY school_name ASC";
        $stmt = $this->db->prepare($schools);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getSchool()
    {
        $school = "SELECT * FROM tb_schools WHERE IDSCHOOL=:idschool";
        $stmt = $this->db->prepare($school);
        $stmt->bindValue(':idschool', $this->__get('idschool'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function addSchool()
    {
        $school = "INSERT INTO tb_schools(school_name, school_link, school_logo) VALUES(:school_name, :school_link, :school_logo)";
        $stmt = $this->db->prepare($school);
        $stmt->bindValue(':school_name', $this->__get('school_name'));
        $stmt->bindValue(':school_link', $this->__get('school_link'));
        $stmt->bindValue(':school_logo', $this->__get('school_logo'));
        $stmt->execute();

        return $this;
    }
    public function editSchool()
    {
        $school = "UPDATE tb_schools SET school_name=:school_name, school_link=:school_link, school_logo=:school_logo WHERE IDSCHOOL = :idschool";
        $stmt = $this->db->prepare($school);
        $stmt->bindValue(':idschool', $this->__get('idschool'));
        $stmt->bindValue(':school_name', $this->__get('school_name'));
        $stmt->bindValue(':school_link', $this->__get('school_link'));
        $stmt->bindValue(':school_logo', $this->__get('school_logo'));
        $stmt->execute();

        return $this;
    }
    public function deleteSchool()
    {
        $school = "DELETE FROM tb_schools WHERE IDSCHOOL=:idschool";
        $stmt = $this->db->prepare($school);
        $stmt->bindValue(':idschool', $this->__get('idschool'));

        $stmt->execute();

        return $this;
    }
}
