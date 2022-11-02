<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class SigninController extends Action
{

    public function signin()
    {
        $this->setHtmlData->signed = 'enabled';
        $this->render('signin', 'signin_layout');
    }

    public function authenticate()
    {
        //print_r($_POST);
        if (empty($_POST['username']) || empty($_POST['passwd'])) {
            echo 'Digite um nome de usuário válido';
            die();
        };
        $user = Container::getModel('users');
        $user->__set('username', $_POST['username']);
        $user->__set('passwd', $_POST['passwd']);
        $user->login();

        if ($user->__get('iduser') && $user->__get('username')) {
            
            session_start();
            $_SESSION['id'] = $user->__get('iduser');
            $_SESSION['nome'] = $user->__get('user_name');
            $_SESSION['permissao'] = $user->__get('permission');

            $this->setHtmlData->signed = 'enabled';
            header('Location: /');
        } else {
            echo 'Usuário Inválido';
        }
    }
    public function log_out()
    {
        session_start();
        unset($_SESSION["id"]);
        unset($_SESSION["nome"]);
        unset($_SESSION['permissao']);
        header("location: /");
    }

    public static function validaAutenticacao()
    {
        session_start();
        if (!$_SESSION['id'] || !$_SESSION['nome']) {
            header('Location: signin?login=error');
            die();
        }
    }
}
