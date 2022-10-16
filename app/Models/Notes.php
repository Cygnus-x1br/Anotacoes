<?php

namespace App\Models;

use MF\Model\Model;

class Notes extends Model
{
    private $idnote;
    private $id_subject;
    private $note_title;
    private $type_of_note;
    private $note;
    private $note_date;

    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function getAllNotes()
    {
        $notes = "SELECT * FROM tb_notes";
        $stmt = $this->db->prepare($notes);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getNote()
    {
        $note = "SELECT * FROM tb_notes WHERE IDNOTE=:idnote";
        $stmt = $this->db->prepare($note);
        $stmt->bindValue(':idnote', $this->__get('idnote'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function addNote()
    {
        $note = "INSERT INTO tb_notes(ID_SUBJECT, note_title, type_of_note, note, note_date) VALUES(:id_subject, :note_title, :type_of_note, :note, NOW())";
        $stmt = $this->db->prepare($note);
        $stmt->bindValue(':id_subject', $this->__get('id_subject'));
        $stmt->bindValue(':note_title', $this->__get('note_title'));
        $stmt->bindValue(':type_of_note', $this->__get('type_of_note'));
        $stmt->bindValue(':note', $this->__get('note'));
        $stmt->execute();

        return $this;
    }

    public function getLastTexts()
    {
        $notes = "SELECT * FROM tb_notes LIMIT 3";
        $stmt = $this->db->prepare($notes);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
