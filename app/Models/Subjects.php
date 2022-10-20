<?php

namespace App\Models;

use MF\Model\Model;

class Subjects extends Model
{
    private $idsubject;
    private $subject;
    private $subject_image;
    private $subject_link;

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

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function addSubject()
    {
        $subject = "INSERT INTO tb_subject(subject, subject_image, subject_link) VALUES(:subject, :subject_image, :subject_link)";
        $stmt = $this->db->prepare($subject);
        $stmt->bindValue(':subject', $this->__get('subject'));
        $stmt->bindValue(':subject_image', $this->__get('subject_image'));
        $stmt->bindValue(':subject_link', $this->__get('subject_link'));
        $stmt->execute();

        return $this;
    }
    public function editSubject()
    {
        $subject = "UPDATE tb_subject SET subject=:subject, subject_image=:subject_image, subject_link=:subject_link WHERE IDSUBJECT=:idsubject";
        $stmt = $this->db->prepare($subject);
        $stmt->bindValue(':idsubject', $this->__get('idsubject'));
        $stmt->bindValue(':subject', $this->__get('subject'));
        $stmt->bindValue(':subject_image', $this->__get('subject_image'));
        $stmt->bindValue(':subject_link', $this->__get('subject_link'));
        $stmt->execute();

        return $this;
    }
    public function deleteSubject()
    {
        $subject = "DELETE FROM tb_subject WHERE IDSUBJECT=:idsubject";
        $stmt = $this->db->prepare($subject);
        $stmt->bindValue(':idsubject', $this->__get('idsubject'));
        $stmt->execute();

        return $this;
    }
}
