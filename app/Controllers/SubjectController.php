<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class SubjectController extends Action
{
    public function list_subjects()
    {
        SigninController::validaAutenticacao();
        $subjects = Container::getModel('subjects');
        $list_subjects = $subjects->getAllSubjects();
        $this->viewData->listagem_assuntos = $list_subjects;

        $this->render('list_subjects');
    }

    public function set_subject()
    {
        SigninController::validaAutenticacao();
        if (!empty($_FILES)) {
            $file_save = $this->upload_file();
        }
        $subjects = Container::getModel('subjects');
        $subjects->__set('subject', $_POST['subject']);
        $subjects->__set('subject_image', $file_save);
        $subjects->addSubject();

        header('Location: list_subjects');
    }

    public function save_subject()
    {
        if (!empty($_POST['subject'])) {
            $this->set_subject();
        };
    }

    public function add_subject()
    {
        $this->render('add_subject');
    }

    public function edit_subject()
    {
        $subject = Container::getModel('subjects');
        $subject->__set('idsubject', $_GET['id']);
        $subject_edit = $subject->getSubject();

        $this->viewData->subject = $subject_edit;

        $this->render('add_subject');
    }

    public function upload_file()
    {
        $file = $_FILES['upload_file'];
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
        $save_file = $path . $_POST['subject'] . '_image' . '.' . $extensao;
        $teste = move_uploaded_file($tmp_file, $save_file);
        if ($teste == 1) {
            return $save_file;
        }
    }
}
