<?php

namespace App\Controllers;

use stdClass;
use MF\Controller\Action;
use MF\Model\Container;
use App\Models\Produto;
use App\Models\Info;
//use App\Connection;

class SigninController extends Action
{

    public function signin()
    {
        $this->render('signin', 'signin_layout');
    }
}
