<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;
use App\Controllers\SubjectController;

class NoteController extends Action
{
    public function add_note()
    {
        // $subjects = Container::getModel('subjects');
        // $this->viewData->listagem_assuntos = $subjects->getAllSubjects();
        $this->subjects();
        $this->render('add_note', 'text_layout');
    }

    private function subjects()
    {
        $subjects = Container::getModel('subjects');
        $this->viewData->listagem_assuntos = $subjects->getAllSubjects();
        return $this->viewData->listagem_assuntos;
    }

    public function set_note()
    {
        SigninController::validaAutenticacao();
        $notes = Container::getModel('notes');
        $notes->__set('id_subject', $_POST['id_subject']);
        $notes->__set('note_title', $_POST['note_title']);
        $notes->__set('type_of_note', $_POST['type_of_note']);
        $notes->__set('note', $_POST['note']);
        $notes->addNote();

        header('Location: list_note');
    }

    public function save_note()
    {
        // print_r($_POST);
        if (!empty($_POST['note'])) {
            $this->set_note();
        };
    }
    public function list_note()
    {
        SigninController::validaAutenticacao();
        $notes = Container::getModel('notes');
        $list_notes = $notes->getAllNotes();
        $this->subjects();
        $this->viewData->listagem_anotacoes = $list_notes;


        $this->render('list_note');
    }
}
