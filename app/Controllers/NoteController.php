<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;
use App\Controllers\SubjectController;

class NoteController extends Action
{
    public function list_notes()
    {
        SigninController::validaAutenticacao();
        $notes = Container::getModel('notes');
        $list_notes = $notes->getAllNotes();
        $this->subjects();
        $this->viewData->listagem_anotacoes = $list_notes;

        $this->render('list_notes');
    }

    public function set_note($edit = '')
    {
        SigninController::validaAutenticacao();
        $notes = Container::getModel('notes');
        $notes->__set('id_subject', $_POST['id_subject']);
        $notes->__set('note_title', $_POST['note_title']);
        $notes->__set('type_of_note', $_POST['type_of_note']);
        $notes->__set('note', $_POST['note']);
        if ($edit == 'edit') {
            $notes->__set('idnote', $_POST['idnote']);
            $notes->editNote();
        } else {
            $notes->addNote();
        }

        header('Location: list_notes');
    }

    public function save_note()
    {
        if (!empty($_POST['note'])) {
            $this->set_note();
        };
    }
    public function change_note()
    {
        if (!empty($_POST['note'])) {
            $this->set_note('edit');
        };
    }

    public function add_note()
    {
        $this->subjects();
        $this->render('add_note', 'text_layout');
    }
    public function edit_note()
    {
        $this->subjects();
        $notes = Container::getModel('notes');
        $notes->__set('idnote', $_GET['id']);
        $note_edit = $notes->getNote();

        $this->viewData->note = $note_edit;

        $this->render('add_note', 'text_layout');
    }

    public function delete_note()
    {
        $subject = Container::getModel('notes');
        $subject->__set('idnote', $_GET['id']);
        $subject->deleteNote();

        header('Location: list_notes');
    }

    private function subjects()
    {
        $subjects = Container::getModel('subjects');
        $this->viewData->listagem_assuntos = $subjects->getAllSubjects();
        return $this->viewData->listagem_assuntos;
    }
}
