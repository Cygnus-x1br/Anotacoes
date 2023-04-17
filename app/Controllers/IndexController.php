<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action
{
    public function index()
    {
        session_start();
        if (!isset($_SESSION['id'])) {
            $this->setHtmlData->signed = 'disabled';
        }
        $last_texts = Container::getModel('notes');
        $show_last = $last_texts->getLastTexts();
        $this->viewData->ultimas_notas = $show_last;

        $subject = Container::getModel('subjects');
        $subjects = $subject->getAllSubjects();
        $this->viewData->subjects = $subjects;

        $classes = Container::getModel('classes');
        $lastClasses = $classes->getLastClasses();
        $this->viewData->classes = $lastClasses;

        $curses = Container::getModel('curses');
        $reviewCurses = $curses->getReviewCurses();
        $this->viewData->reviewCurses = $reviewCurses;

        $this->render('index');
    }

    public function view_note()
    {
        session_start();
        if (!$_SESSION['id']) {
            $this->setHtmlData->signed = 'disabled';
        }
        if (isset($_GET['page']) && $_GET['page'] == 'viewAll') {
            $this->setHtmlData->return = 'view_all_notes';
        } else {
            $this->setHtmlData->return = '/';
        }
        $view_note = Container::getModel('notes');
        $view_note->__set('idnote', $_GET['id']);
        $show_note = $view_note->getNote();
        $this->viewData->note = $show_note;
        $subject = Container::getModel('subjects');
        $subjects = $subject->getAllSubjects();
        $this->viewData->subjects = $subjects;

        $this->render('view_note');
    }

    public function view_all_notes()
    {
        session_start();
        if (!$_SESSION['id']) {
            $this->setHtmlData->signed = 'disabled';
        }
        $view_notes = Container::getModel('notes');
        $show_notes = $view_notes->getAllNotes();
        $this->viewData->notes = $show_notes;
        $subject = Container::getModel('subjects');
        $subjects = $subject->getAllSubjects();
        $this->viewData->subjects = $subjects;

        $this->render('view_all_notes');
    }
    public function view_all_curses()
    {
        session_start();
        if (!$_SESSION['id']) {
            $this->setHtmlData->signed = 'disabled';
        }
        $viewCurses = Container::getModel('curses');
        $showCurses = $viewCurses->getAllCurses();
        $this->viewData->curses = $showCurses;
        $school = Container::getModel('schools');
        $schools = $school->getAllSchools();
        $this->viewData->schools = $schools;
        $subject = Container::getModel('subjects');
        $subjects = $subject->getAllSubjects();
        $this->viewData->subjects = $subjects;

        $this->render('view_all_curses');
    }

    public function search()
    {
        $searchCurse = Container::getModel('classes');
        $searchCurse->__set('search_word', $_POST['search_word']);
        $resultCurse = $searchCurse->searchClasses();
        $this->viewData->searchResult = $resultCurse;

        $this->render('search');
    }
}
