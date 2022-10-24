<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class SubtitleController extends Action
{
    public function list_subtitles()
    {
        SigninController::validaAutenticacao();

        $subtitles = Container::getModel('subtitles');
        $subtitles->__set('id_curse', $_GET['id']);
        $subtitle = $subtitles->getAllSubtitles();
        $this->viewData->list_subtitles = $subtitle;
        $this->curse();

        $this->render('list_subtitles');
    }

    public function set_subtitle($edit = '')
    {
        SigninController::validaAutenticacao();

        $subtitle = Container::getModel('subtitles');
        $subtitle->__set('subtitle_number', $_POST['subtitle_number']);
        $subtitle->__set('subtitle', $_POST['subtitle']);
        $subtitle->__set('subtitle_description', $_POST['subtitle_description']);
        $subtitle->__set('id_curse', $_POST['id_curse']);
        $subtitle->__set('id_subject', $_POST['id_subject']);
        if ($edit == 'edit') {
            $subtitle->__set('idsubtitle', $_POST['idsubtitle']);
            $subtitle->editSubtitle();
        } else {
            $subtitle->addSubtitle();
        }

        header('Location: list_subtitles?id=' . $_POST['id_curse']);
    }

    public function save_subtitle()
    {
        if (!empty($_POST['subtitle'])) {
            $this->set_subtitle();
        };
    }

    public function change_subtitle()
    {
        if (!empty($_POST['subtitle'])) {
            $this->set_subtitle('edit');
        };
    }

    public function add_subtitle()

    {
        $this->curse();
        $this->subjects();
        $this->render('add_subtitle', 'text_layout');
    }

    public function edit_subtitle()
    {
        $subtitle = Container::getModel('subtitles');
        $subtitle->__set('idsubtitle', $_GET['subtitle']);
        $subtitle_edit = $subtitle->getSubtitle();
        $this->viewData->subtitle = $subtitle_edit;

        $this->curse();
        $this->subjects();
        $this->render('add_subtitle', 'text_layout');
    }
    public function delete_subtitle()
    {
        $curse = Container::getModel('subtitles');
        $curse->__set('idsubtitle', $_GET['id']);
        $curse->deleteSubtitle();

        header('Location: list_subtitles');
    }

    private function subjects()
    {
        $subjects = Container::getModel('subjects');
        $this->viewData->listagem_assuntos = $subjects->getAllSubjects();
        return $this->viewData->listagem_assuntos;
    }
    private function curses()
    {
        $curses = Container::getModel('curses');
        $this->viewData->curses_list = $curses->getAllCurses();
        return $this->viewData->curses_list;
    }
    private function curse()
    {
        $curse = Container::getModel('curses');
        $curse->__set('idcurse', $_GET['id']);
        $this->viewData->curse = $curse->getCurse();
        return $this->viewData->curse;
    }
}
