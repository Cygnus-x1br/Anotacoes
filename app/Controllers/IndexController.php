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
        $this->render('index');
    }
}
