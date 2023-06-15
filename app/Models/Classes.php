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
    private $id_subtitle;

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
        $classes = "SELECT *,
         c.curse_title as curse,
          c.IDCURSE as idcurse,
           s.subtitle as subtitle,
            s.subtitle_number
             as subtitle_number
            FROM tb_classes as cl
            INNER JOIN tb_curses as c ON c.IDCURSE = cl.ID_CURSE
            LEFT JOIN tb_curse_subtitle as s ON cl.ID_SUBTITLE = s.IDSUBTITLE
            WHERE cl.ID_CURSE=:id_curse
            ORDER BY subtitle_number ASC, class_number ASC";
        $stmt = $this->db->prepare($classes);
        $stmt->bindValue(':id_curse', $this->__get('id_curse'));

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getLastClasses()
    {
        $classes = "SELECT *, c.curse_title as curse, c.IDCURSE as idcurse
         FROM tb_classes
          INNER JOIN tb_curses as c ON IDCURSE = ID_CURSE
           ORDER BY IDCLASS DESC LIMIT 3";
        $stmt = $this->db->prepare($classes);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getClass()
    {
        $class = "SELECT *, c.curse_title as curse, c.IDCURSE as idcurse
         FROM tb_classes
          INNER JOIN tb_curses as c ON IDCURSE = ID_CURSE
           WHERE IDCLASS=:idclass";
        $stmt = $this->db->prepare($class);
        $stmt->bindValue(':idclass', $this->__get('idclass'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getBackClass()
    {
        $back = "SELECT IDCLASS, class_number 
        FROM tb_classes 
        WHERE ID_CURSE = :id_curse AND class_number < :class_number 
        ORDER BY class_number DESC LIMIT 1";
        $stmt = $this->db->prepare($back);
        $stmt->bindValue(':id_curse', $this->__get('id_curse'));
        $stmt->bindValue(':class_number', $this->__get('class_number'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    public function getNextClass()
    {
        $next = "SELECT IDCLASS, class_number 
        FROM tb_classes 
        WHERE ID_CURSE = :id_curse AND class_number > :class_number 
        ORDER BY class_number ASC LIMIT 1";
        $stmt = $this->db->prepare($next);
        $stmt->bindValue(':id_curse', $this->__get('id_curse'));
        $stmt->bindValue(':class_number', $this->__get('class_number'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function addClass()
    {
        $class = "INSERT INTO tb_classes(
            class_number,
             class_title,
              class_notes,
               see_again,
                ID_CURSE,
                 ID_SUBJECT,
                  class_path,
                   class_image_path,
                    ID_USER,
                     include_date,
                      ID_SUBTITLE)
             VALUES(:class_number,
              :class_title,
               :class_notes,
                :see_again,
                 :ID_CURSE,
                  :ID_SUBJECT,
                   :class_path,
                    :class_image_path,
                     :ID_USER,
                      NOW(),
                       :id_subtitle)";
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
        $stmt->bindValue(':id_subtitle', $this->__get('id_subtitle'));
        $stmt->execute();

        return $this;
    }

    public function editClass()
    {
        $class = "UPDATE tb_classes
         SET class_number=:class_number,
          class_title=:class_title,
           class_notes=:class_notes,
            see_again=:see_again,
             ID_SUBJECT=:id_subject,
              class_path=:class_path,
               class_image_path=:class_image_path,
                ID_USER=:id_user,
                 ID_SUBTITLE=:id_subtitle
         WHERE IDCLASS = :idclass";
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
        $stmt->bindValue(':id_subtitle', $this->__get('id_subtitle'));

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

    public function searchClasses()
    {

        $searchClasses = "SELECT cl.IDCLASS as idclass, cl.class_title, cl.class_notes, cr.IDCURSE as idcurse, cr.curse_title as curse
        FROM tb_classes as cl
        INNER JOIN tb_curses as cr ON cr.IDCURSE = cl.ID_CURSE
        WHERE cl.class_title LIKE :search_word
        OR cl.class_notes LIKE :search_word";
        $stmt = $this->db->prepare($searchClasses);

        $stmt->bindValue(':search_word', '%' . $this->__get('search_word') . '%');
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
