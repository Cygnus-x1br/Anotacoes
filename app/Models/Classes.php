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
    private $class_path;
    private $class_image_path;
    private $id_user;

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
        $class = "SELECT * FROM tb_classes WHERE IDCLASS=:idclass";
        $stmt = $this->db->prepare($class);
        $stmt->bindValue(':idclass', $this->__get('idclass'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Ajustar esses métodos

    public function addCurse()
    {
        $curse = "INSERT INTO tb_classes(class_number, class_title, class_notes, see_again, ID_CURSE, ID_SUBJECT, class_path, class_image_path, ID_USER) VALUES(:class_number, :class_title, :class_notes, :see_again, :ID_CURSE, :ID_SUBJECT, :class_path, :class_image_path, :ID_USER)";
        $stmt = $this->db->prepare($curse);
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

    public function editCurse()
    {
        $curse = "UPDATE tb_curses SET curse_title=:curse_title, curse_description=:curse_description, id_school=:id_school WHERE IDCURSE = :idcurse";
        $stmt = $this->db->prepare($curse);
        $stmt->bindValue(':idcurse', $this->__get('idcurse'));
        $stmt->bindValue(':curse_title', $this->__get('curse_title'));
        $stmt->bindValue(':curse_description', $this->__get('curse_description'));
        $stmt->bindValue(':id_school', $this->__get('id_school'));
        $stmt->execute();
        $curse_subject = "UPDATE tba_curse_subject SET id_subject=:id_subject WHERE ID_CURSE=:idcurse";
        $stmt = $this->db->prepare($curse_subject);
        $stmt->bindValue(':idcurse', $this->__get('idcurse'));
        $stmt->bindValue('id_subject', $this->__get('id_subject'));
        $stmt->execute();

        return $this;
    }
    public function deleteCurse()
    {
        $curse_subject = "DELETE FROM tba_curse_subject WHERE ID_CURSE=:idcurse";
        $stmt = $this->db->prepare($curse_subject);
        $stmt->bindValue(':idcurse', $this->__get('idcurse'));
        $stmt->execute();
        $curse = "DELETE FROM tb_curses WHERE IDCURSE=:idcurse";
        $stmt = $this->db->prepare($curse);
        $stmt->bindValue(':idcurse', $this->__get('idcurse'));
        $stmt->execute();

        return $this;
    }
}
