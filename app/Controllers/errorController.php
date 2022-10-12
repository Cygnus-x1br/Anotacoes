<?php

namespace App\Controllers;

use stdClass;
use MF\Controller\Action;
use MF\Model\Container;
use App\Models\Produto;
use App\Models\Info;
//use App\Connection;

class ErrorController extends Action
{
    public function erro()
    {
        $this->render('erro', 'layout3');
    }
}
