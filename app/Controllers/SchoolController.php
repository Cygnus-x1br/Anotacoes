<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class SchoolController extends Action
{
    public function list_schools()
    {
        SigninController::validaAutenticacao();
        $schools = Container::getModel('schools');
        $list_schools = $schools->getAllSchools();
        $this->viewData->list_schools = $list_schools;

        $this->render('list_schools');
    }

    public function set_school($edit = '')
    {
        SigninController::validaAutenticacao();

        $schools = Container::getModel('schools');
        if (($_FILES['school_logo']['size'] !== 0)) {
            $file_save = $this->upload_file();
            $schools->__set('school_logo', $file_save);
        } else if ($edit == 'edit' && ($_FILES['school_logo']['size'] == 0)) {
            $schools->__set('school_logo', $_POST['school_logo']);
        }

        $schools->__set('school_name', $_POST['school_name']);
        $schools->__set('school_link', $_POST['school_link']);
        if ($edit == 'edit') {
            $schools->__set('idschool', $_POST['idschool']);
            $schools->editSchool();
        } else {
            $schools->addSchool();
        }

        header('Location: list_schools');
    }

    public function save_school()
    {
        if (!empty($_POST['school_name'])) {
            $this->set_school();
        };
    }

    public function change_school()
    {
        if (!empty($_POST['school_name'])) {
            $this->set_school('edit');
        };
    }

    public function add_school()
    {
        $this->render('add_school');
    }

    public function edit_school()
    {
        $school = Container::getModel('schools');
        $school->__set('idschool', $_GET['id']);
        $school_edit = $school->getSchool();

        $this->viewData->school = $school_edit;

        $this->render('add_school');
    }
    public function delete_school()
    {
        $subject = Container::getModel('schools');
        $subject->__set('idschool', $_GET['id']);
        $subject->deleteSchool();

        header('Location: list_schools');
    }

    public function upload_file()
    {
        $file = $_FILES['school_logo'];
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
        $save_file = $path . $_POST['school_name'] . '_image' . '.' . $extensao;
        $teste = move_uploaded_file($tmp_file, $save_file);
        if ($teste == 1) {
            return $save_file;
        } else {
            return '';
        }
    }
}
