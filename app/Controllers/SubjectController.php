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
        $subjects = Container::getModel('subjects');
        $subjects->__set('subject', $_POST['subject']);
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
}
