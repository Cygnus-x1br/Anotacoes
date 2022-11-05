<?php

namespace App\Models;

use MF\Model\Model;

class Subtitles extends Model
{
    private $idsubtitle;
    private $subtitle_number;
    private $subtitle;
    private $subtitle_description;
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

    public function getAllSubtitles()
    {
        $subtitles = "SELECT * FROM tb_curse_subtitle WHERE ID_CURSE = :id_curse ORDER BY subtitle_number ASC";
        $stmt = $this->db->prepare($subtitles);
        $stmt->bindValue(':id_curse', $this->__get('id_curse'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getSubtitle()
    {
        $subtitle = "SELECT * FROM tb_curse_subtitle WHERE IDSUBTITLE=:idsubtitle";
        $stmt = $this->db->prepare($subtitle);
        $stmt->bindValue(':idsubtitle', $this->__get('idsubtitle'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function addSubtitle()
    {
        $subtitle = "INSERT INTO tb_curse_subtitle(subtitle_number,
         subtitle,
          subtitle_description,
           ID_CURSE,
            ID_SUBJECT)
         VALUES(:subtitle_number, :subtitle, :subtitle_description, :id_curse, :id_subject)";
        $stmt = $this->db->prepare($subtitle);
        $stmt->bindValue(':subtitle_number', $this->__get('subtitle_number'));
        $stmt->bindValue(':subtitle', $this->__get('subtitle'));
        $stmt->bindValue(':subtitle_description', $this->__get('subtitle_description'));
        $stmt->bindValue(':id_curse', $this->__get('id_curse'));
        $stmt->bindValue(':id_subject', $this->__get('id_subject'));
        $stmt->execute();

        return $this;
    }

    public function editSubtitle()
    {
        $subtitle = "UPDATE tb_curse_subtitle
         SET subtitle_number=:subtitle_number,
          subtitle=:subtitle,
           subtitle_description=:subtitle_description,
            id_subject=:id_subject
             WHERE IDSUBTITLE = :idsubtitle";
        $stmt = $this->db->prepare($subtitle);
        $stmt->bindValue(':idsubtitle', $this->__get('idsubtitle'));
        $stmt->bindValue(':subtitle_number', $this->__get('subtitle_number'));
        $stmt->bindValue(':subtitle', $this->__get('subtitle'));
        $stmt->bindValue(':subtitle_description', $this->__get('subtitle_description'));
        $stmt->bindValue(':id_subject', $this->__get('id_subject'));
        $stmt->execute();

        return $this;
    }

    public function deleteSubtitle()
    {
        $subtitle = "DELETE FROM tb_curse_subtitle WHERE IDSUBTITLE = :idsubtitle";
        $stmt = $this->db->prepare($subtitle);
        $stmt->bindValue(':idsubtitle', $this->__get('idsubtitle'));
        $stmt->execute();

        return $this;
    }
}
