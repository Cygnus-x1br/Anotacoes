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
        $this->render('index', 'layout');
    }

    public function sobreNos()
    {
        //$conn = Connection::getDB();
        //$info = new Info($conn);

        $info = Container::getModel('Info');
        $infos = $info->getInfo();

        $this->viewData->dados = $infos;
        //$this->viewData->dados = array('Notebook', 'Smartphone');
        $this->render('sobreNos', 'layout2');
    }
}
