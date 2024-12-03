<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class ClassController extends Action
{
    public function list_classes()
    {
        SigninController::validaAutenticacao();
        $classes = Container::getModel('classes');
        $classes->__set('id_curse', $_GET['id']);
        $list_classes = $classes->getAllClassesFromCurse();

        $this->viewData->list_classes = $list_classes;
        $this->curse();
        $this->subjects();
        $curse_id = $this->viewData->curse['IDCURSE'];
        $this->school($this->viewData->curse['ID_SCHOOL']);
        $this->subtitles($curse_id);
        $this->render('list_classes');
    }

    public function view_classes()
    {
        SigninController::validaAutenticacao();
        $classes = Container::getModel('classes');
        $classes->__set('id_curse', $_GET['id']);
        $list_classes = $classes->getAllClassesFromCurse();

        $this->viewData->list_classes = $list_classes;
        $this->curse();
        $this->school($this->viewData->curse['ID_SCHOOL']);
        $this->subjects();
        $curse_id = $this->viewData->curse['IDCURSE'];
        $this->subtitles($curse_id);
        $this->render('view_classes');
    }
    public function view_class()
    {
        SigninController::validaAutenticacao();
        $classes = Container::getModel('classes');
        $classes->__set('idclass', $_GET['class']);
        $list_class = $classes->getClass();
        $classes->__set('id_curse', $list_class['ID_CURSE']);
        $classes->__set('class_number', $list_class['class_number']);
        $back_class = $classes->getBackClass();
        $next_class = $classes->getNextClass();
        $this->viewData->list_class = $list_class;
        $this->viewData->back_class = $back_class;
        $this->viewData->next_class = $next_class;
        $this->curse();
        $this->school($this->viewData->curse['ID_SCHOOL']);
        $this->subjects();
        $this->render('view_class');
    }

    public function set_class($edit = '')
    {
        SigninController::validaAutenticacao();

        $class = Container::getModel('classes');

        if (($_FILES['class_image_path']['size'] !== 0)) {
            $file_save = $this->upload_file();
            $class->__set('class_image_path', $file_save);
        } else if ($edit == 'edit' && ($_FILES['class_image_path']['size'] == 0)) {
            $class->__set('class_image_path', $_POST['class_image_path']);
        }
        $class->__set('class_number', $_POST['class_number']);
        $class->__set('class_title', $_POST['class_title']);
        $class->__set('class_notes', $_POST['class_notes']);
        $class->__set('see_again', !empty($_POST['see_again']) ?? 0);
        $class->__set('id_curse', $_POST['id_curse']);
        $class->__set('id_subject', $_POST['id_subject']);
        $class->__set('class_path', $_POST['class_path']);
        $class->__set('id_user', $_SESSION['id']);
        $class->__set('id_subtitle', $_POST['id_subtitle']);
        if ($edit == 'edit') {
            $class->__set('idclass', $_POST['idclass']);
            $class->editClass();
        } else {
            $class->addClass();
        }

        header('Location: list_classes?id=' . $_POST['id_curse']);
    }

    public function save_class()
    {
        if (!empty($_POST['class_title'])) {
            $this->set_class();
        }
    }

    public function change_class()
    {
        if (!empty($_POST['class_title'])) {
            $this->set_class('edit');
        }
    }

    public function add_class()
    {
        $this->curse();
        $school_id = $this->viewData->curse['ID_SCHOOL'];
        $this->school($school_id);
        $this->subjects();
        $curse_id = $this->viewData->curse['IDCURSE'];
        $this->subtitles($curse_id);
        $this->render('add_class', 'text_layout');
    }

    public function edit_class()
    {
        $this->curse();
        $school_id = $this->viewData->curse['ID_SCHOOL'];
        $this->school($school_id);
        $this->subjects();
        $curse_id = $this->viewData->curse['IDCURSE'];
        $this->subtitles($curse_id);
        $class = Container::getModel('classes');
        $class->__set('idclass', $_GET['class']);
        $class_edit = $class->getClass();
        $this->viewData->class = $class_edit;
        // $this->schools();
        $this->render('add_class', 'text_layout');
    }
    public function delete_class()
    {
        $class = Container::getModel('classes');
        $class->__set('idclass', $_GET['class']);
        $class->deleteClass();

        header('Location: list_classes?id=' . $_GET['id']);
    }

    private function subjects()
    {
        $subjects = Container::getModel('subjects');
        $this->viewData->listagem_assuntos = $subjects->getAllSubjects();
        return $this->viewData->listagem_assuntos;
    }

    private function school($school_id)
    {
        $school = Container::getModel('schools');
        $school->__set('idschool', $school_id);
        $this->viewData->school = $school->getSchool();
        return $this->viewData->school;
    }
    private function curse()
    {
        $curse = Container::getModel('curses');
        $curse->__set('idcurse', $_GET['id']);
        $this->viewData->curse = $curse->getCurse();
        return $this->viewData->curse;
    }
    private function subtitles($curse)
    {
        $subtitle = Container::getModel('subtitles');
        $subtitle->__set('id_curse', $curse);
        $this->viewData->subtitles = $subtitle->getAllSubtitles();
        return $this->viewData->subtitles;
    }

    private function upload_file()
    {
        $file = $_FILES['class_image_path'];
        $ext = explode('.', $file['name']);
        $extensao = end($ext);
        $allowedTypes = [
            'image/gif',
            'image/jpg',
            'image/jpeg',
            'image/png',
        ];
        if (!in_array($file['type'], $allowedTypes)) {
            header('Location: add_subject?file_type=error');
            exit;
        }

        $tmp_file = $file['tmp_name'];
        $path = './img/';
        $save_file = $path . 'curso' . $_POST['id_curse'] . 'aula' . $_POST['id_subtitle'] . '_' . $_POST['class_number'] . '_image' . '.' . $extensao;
        $teste = move_uploaded_file($tmp_file, $save_file);
        if ($teste == 1) {
            return $save_file;
        } else {
            return '';
        }
    }
}
