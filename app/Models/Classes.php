<?php

namespace App\Models;

use MF\Model\Model;

class Classes extends Model
{
    private $idclass;
    private $class_number;
    private $class_title;
    private $class_notes;
    private $see_again;
    private $id_curse;
    private $id_subject;
    private $class_path = '';
    private $class_image_path = '';
    private $id_user;
    private $include_date;

    public function __get($atribute)
    {
        return $this->$atribute;
    }

    public function __set($atribute, $value)
    {
        $this->$atribute = $value;
    }

    public function getAllClasses()
    {
        $classes = "SELECT * FROM tb_classes ORDER BY class_number ASC";
        $stmt = $this->db->prepare($classes);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getAllClassesFromCurse()
    {
        $classes = "SELECT *, c.curse_title as curse, c.IDCURSE as idcurse FROM tb_classes INNER JOIN tb_curses as c ON IDCURSE = ID_CURSE WHERE ID_CURSE=:id_curse ORDER BY class_number ASC";
        $stmt = $this->db->prepare($classes);
        $stmt->bindValue(':id_curse', $this->__get('id_curse'));

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getClass()
    {
        $class = "SELECT *, c.curse_title as curse, c.IDCURSE as idcurse FROM tb_classes INNER JOIN tb_curses as c ON IDCURSE = ID_CURSE WHERE IDCLASS=:idclass";
        $stmt = $this->db->prepare($class);
        $stmt->bindValue(':idclass', $this->__get('idclass'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Ajustar esses métodos

    public function addClass()
    {
        $class = "INSERT INTO tb_classes(class_number, class_title, class_notes, see_again, ID_CURSE, ID_SUBJECT, class_path, class_image_path, ID_USER, include_date) VALUES(:class_number, :class_title, :class_notes, :see_again, :ID_CURSE, :ID_SUBJECT, :class_path, :class_image_path, :ID_USER, NOW())";
        $stmt = $this->db->prepare($class);
        $stmt->bindValue(':class_number', $this->__get('class_number'));
        $stmt->bindValue(':class_title', $this->__get('class_title'));
        $stmt->bindValue(':class_notes', $this->__get('class_notes'));
        $stmt->bindValue(':see_again', $this->__get('see_again'));
        $stmt->bindValue(':ID_CURSE', $this->__get('id_curse'));
        $stmt->bindValue(':ID_SUBJECT', $this->__get('id_subject'));
        $stmt->bindValue(':class_path', $this->__get('class_path'));
        $stmt->bindValue(':class_image_path', $this->__get('class_image_path'));
        $stmt->bindValue(':ID_USER', $this->__get('id_user'));
        $stmt->execute();

        return $this;
    }

    public function editClass()
    {
        $class = "UPDATE tb_classes SET class_number=:class_number, class_title=:class_title, class_notes=:class_notes, see_again=:see_again, ID_SUBJECT=:id_subject, class_path=:class_path, class_image_path=:class_image_path, ID_USER=:id_user WHERE IDCLASS = :idclass";
        $stmt = $this->db->prepare($class);
        $stmt->bindValue(':class_number', $this->__get('class_number'));
        $stmt->bindValue(':class_title', $this->__get('class_title'));
        $stmt->bindValue(':class_notes', $this->__get('class_notes'));
        $stmt->bindValue(':see_again', $this->__get('see_again'));
        $stmt->bindValue(':idclass', $this->__get('idclass'));
        $stmt->bindValue(':id_subject', $this->__get('id_subject'));
        $stmt->bindValue(':class_path', $this->__get('class_path'));
        $stmt->bindValue(':class_image_path', $this->__get('class_image_path'));
        $stmt->bindValue(':id_user', $this->__get('id_user'));
        $stmt->execute();

        return $this;
    }
    public function deleteClass()
    {
        $class = "DELETE FROM tb_classes WHERE IDCLASS=:idclass";
        $stmt = $this->db->prepare($class);
        $stmt->bindValue(':idclass', $this->__get('idclass'));
        $stmt->execute();

        return $this;
    }
}
