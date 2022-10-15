<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class UserController extends Action
{

    public function add_user()
    {
        $this->render('add_user');
    }

    public function list_user()
    {
        SigninController::validaAutenticacao();
        $users = Container::getModel('user');
        $list_users = $users->getAllUsers();

        $this->viewData->listagem_usuarios = $list_users;

        $this->render('list_user');
    }
}
