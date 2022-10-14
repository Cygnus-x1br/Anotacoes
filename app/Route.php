<?php


namespace App;

class Route extends \MF\Init\Bootstrap
{
    public function initRoutes()
    {
        $routes['home'] = array(
            'route' => '/',
            'controller' => 'IndexController',
            'action' => 'index'
        );
        $routes['signin'] = array(
            'route' => '/signin',
            'controller' => 'SigninController',
            'action' => 'signin'
        );
        $routes['authenticate'] = array(
            'route' => '/authenticate',
            'controller' => 'SigninController',
            'action' => 'authenticate'
        );
        $routes['add_user'] = array(
            'route' => '/add_user',
            'controller' => 'UserController',
            'action' => 'add_user'
        );


        $this->setRoutes($routes);
    }
}
