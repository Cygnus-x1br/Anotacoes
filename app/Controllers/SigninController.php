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
        $this->setHtmlData->signed = 'enabled';
        $this->render('signin', 'signin_layout');
    }

    public function authenticate()
    {
        // print_r($_POST);
        if (empty($_POST)) {
            echo 'Digite um nome de usuário válido';
            die();
        };
        $user = Container::getModel('User');
        $user->__set('username', $_POST('username'));
        $user->__set('passwd', $_POST('passwd'));
        $user->login();

        if ($user->__get('username') && $user->__get('userid')) {
            session_start();
            $_SESSION['id'] = $user['userid'];
            $_SESSION['nome'] = $user['user_name'];
            $_SESSION['permissao'] = $user['permission'];

            $this->setHtmlData->signed = 'enabled';
            header('Location: /');
        } else {
            echo 'Usuário Inválido';
        }
    }
}
