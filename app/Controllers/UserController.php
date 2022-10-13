<?php

namespace App\Controllers;

use stdClass;
use MF\Controller\Action;
use MF\Model\Container;
use App\Models\Produto;
use App\Models\Info;
//use App\Connection;

class UserController extends Action
{

    public function add_user()
    {
        $this->render('add_user', 'layout');
    }
}
