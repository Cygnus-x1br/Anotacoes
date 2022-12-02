<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class CurseController extends Action
{
    public function list_curses()
    {
        SigninController::validaAutenticacao();
        $this->subjects();
        $curses = Container::getModel('curses');
        $list_curses = $curses->getAllCurses();
        $this->viewData->list_curses = $list_curses;
        $this->schools();

        $this->render('list_curses');
    }
    public function list_selected_curses()
    {
        if ($_POST['id_subject'] === '') {
            header('Location: list_curses');
        }
        SigninController::validaAutenticacao();
        $this->subjects();
        $curses = Container::getModel('curses');
        $curses->__set('id_subject', $_POST['id_subject']);
        $list_curses = $curses->getSelectedCurses();
        $this->viewData->list_curses = $list_curses;
        $this->schools();

        $this->render('list_curses');
    }

    public function set_curse($edit = '')
    {
        SigninController::validaAutenticacao();

        $curses = Container::getModel('curses');

        $curses->__set('curse_title', $_POST['curse_title']);
        $curses->__set('curse_description', $_POST['curse_description']);
        $curses->__set('id_school', $_POST['id_school']);
        $curses->__set('review', $_POST['review']);
        $curses->__set('id_subject', $_POST['id_subject']);
        if ($edit == 'edit') {
            $curses->__set('idcurse', $_POST['idcurse']);
            $curses->editCurse();
        } else {
            $curses->addCurse();
        }

        header('Location: list_curses');
    }

    public function save_curse()
    {
        if (!empty($_POST['curse_title'])) {
            $this->set_curse();
        };
    }

    public function change_curse()
    {
        if (!empty($_POST['curse_title'])) {
            $this->set_curse('edit');
        };
    }

    public function add_curse()

    {
        $this->schools();
        $this->subjects();
        $this->render('add_curse', 'text_layout');
    }

    public function edit_curse()
    {
        $curse = Container::getModel('curses');
        $curse->__set('idcurse', $_GET['id']);
        $curse_edit = $curse->getCurse();
        $this->viewData->curse = $curse_edit;

        $this->schools();
        $this->subjects();
        $this->render('add_curse', 'text_layout');
    }
    public function delete_curse()
    {
        $curse = Container::getModel('curses');
        $curse->__set('idcurse', $_GET['id']);
        $curse->deleteCurse();

        header('Location: list_curses');
    }



    private function subjects()
    {
        $subjects = Container::getModel('subjects');
        $this->viewData->listagem_assuntos = $subjects->getAllSubjects();
        return $this->viewData->listagem_assuntos;
    }
    private function schools()
    {
        $schools = Container::getModel('schools');
        $this->viewData->schools_list = $schools->getAllSchools();
        return $this->viewData->schools_list;
    }

    // public function upload_file()
    // {
    //     $file = $_FILES['school_logo'];
    //     $ext = explode('.', $file['name']);
    //     $extensao = end($ext);
    //     $allowedTypes = [
    //         'image/gif',
    //         'image/jpg',
    //         'image/jpeg',
    //         'image/png',
    //     ];
    //     if (!in_array($file['type'], $allowedTypes)) {
    //         header('Location: add_subject?file_type=error');
    //         exit;
    //     }
    //     $tmp_file = $file['tmp_name'];
    //     $path = './img/';
    //     $save_file = $path . $_POST['school_name'] . '_image' . '.' . $extensao;
    //     $teste = move_uploaded_file($tmp_file, $save_file);
    //     if ($teste == 1) {
    //         return $save_file;
    //     } else {
    //         return '';
    //     }
    // }
}
