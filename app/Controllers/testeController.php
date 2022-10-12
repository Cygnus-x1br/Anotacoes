<?php

namespace App\Controllers;

use stdClass;
use MF\Controller\Action;
use MF\Model\Container;
use App\Models\Produto;
use App\Models\Info;
//use App\Connection;

class TesteController extends Action
{

    public function casa()
    {

        //$conn = Connection::getDB();
        //$produto = new Produto($conn);

        // $produto = Container::getModel('Produto');
        // $produtos = $produto->getProdutos();

        // $this->viewData->dados = $produtos;

        $this->render('casa', 'layout1');
    }
}
