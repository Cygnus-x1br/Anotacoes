<?php

namespace App\Models;

use MF\Model\Model;

class Curses extends Model
{
    private $idcurse;
    private $curse_title;
    private $curse_description;
    private $id_school;
    private $id_curse;
    private $id_subject;

    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function getAllCurses()
    {
        $curses = "SELECT *, s.ID_SUBJECT as subject
         FROM tb_curses
         INNER JOIN tba_curse_subject as s ON ID_CURSE=IDCURSE
          ORDER BY curse_title ASC";
        $stmt = $this->db->prepare($curses);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getCurse()
    {
        $curse = "SELECT *, s.ID_SUBJECT
         FROM tb_curses
         INNER JOIN tba_curse_subject as s ON ID_CURSE=IDCURSE
          WHERE IDCURSE=:idcurse";
        $stmt = $this->db->prepare($curse);
        $stmt->bindValue(':idcurse', $this->__get('idcurse'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function addCurse()
    {
        $curse = "INSERT INTO tb_curses(
            curse_title,
             curse_description,
              id_school)
         VALUES(:curse_title,
          :curse_description,
           :id_school)";
        $stmt = $this->db->prepare($curse);
        $stmt->bindValue(':curse_title', $this->__get('curse_title'));
        $stmt->bindValue(':curse_description', $this->__get('curse_description'));
        $stmt->bindValue(':id_school', $this->__get('id_school'));
        $stmt->execute();
        $curseSelect = "SELECT IDCURSE
         FROM tb_curses
          WHERE curse_title = :curse_title";
        $stmt = $this->db->prepare($curseSelect);
        $stmt->bindValue('curse_title', $this->__get('curse_title'));
        $stmt->execute();
        $id_curse = $stmt->fetch(\PDO::FETCH_ASSOC);
        $curseSubject = "INSERT INTO tba_curse_subject(
            id_curse,
             id_subject)
              VALUES(:id_curse,
               :id_subject)";
        $stmt = $this->db->prepare($curseSubject);
        $stmt->bindValue(':id_curse', $id_curse['IDCURSE']);
        $stmt->bindValue('id_subject', $this->__get('id_subject'));
        $stmt->execute();

        return $this;
    }

    public function editCurse()
    {
        $curse = "UPDATE tb_curses
         SET curse_title=:curse_title,
          curse_description=:curse_description,
           id_school=:id_school
          WHERE IDCURSE = :idcurse";
        $stmt = $this->db->prepare($curse);
        $stmt->bindValue(':idcurse', $this->__get('idcurse'));
        $stmt->bindValue(':curse_title', $this->__get('curse_title'));
        $stmt->bindValue(':curse_description', $this->__get('curse_description'));
        $stmt->bindValue(':id_school', $this->__get('id_school'));
        $stmt->execute();
        $curseSubject = "UPDATE tba_curse_subject SET id_subject=:id_subject WHERE ID_CURSE=:idcurse";
        $stmt = $this->db->prepare($curseSubject);
        $stmt->bindValue(':idcurse', $this->__get('idcurse'));
        $stmt->bindValue('id_subject', $this->__get('id_subject'));
        $stmt->execute();

        return $this;
    }
    public function deleteCurse()
    {
        $curseSubject = "DELETE FROM tba_curse_subject
         WHERE ID_CURSE=:idcurse";
        $stmt = $this->db->prepare($curseSubject);
        $stmt->bindValue(':idcurse', $this->__get('idcurse'));
        $stmt->execute();
        $curse = "DELETE FROM tb_curses WHERE IDCURSE=:idcurse";
        $stmt = $this->db->prepare($curse);
        $stmt->bindValue(':idcurse', $this->__get('idcurse'));
        $stmt->execute();

        return $this;
    }

    public function curseSubject()
    {
        $curseSubject = "SELECT * FROM tba_curse_subject
         WHERE ID_CURSE=:idcurse";
        $stmt = $this->db->prepare($curseSubject);
        $stmt->bindValue(':idcurse', $this->__get['idcurse']);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
