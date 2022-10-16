<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action
{
    public function index()
    {
        session_start();
        if (!$_SESSION['id']) {
            $this->setHtmlData->signed = 'disabled';
        }
        $last_texts = Container::getModel('notes');
        $show_last = $last_texts->getLastTexts();
        $this->viewData->ultimas_notas = $show_last;
        $subject = Container::getModel('subjects');
        $subjects = $subject->getAllSubjects();
        $this->viewData->subjects = $subjects;


        $this->render('index');
    }
}
