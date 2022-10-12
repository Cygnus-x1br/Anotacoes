<?php

namespace App\Controllers;

use stdClass;
use MF\Controller\Action;
use MF\Model\Container;
use App\Models\Produto;
use App\Models\Info;
//use App\Connection;

class IndexController extends Action
{

    public function index()
    {
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
