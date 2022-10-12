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
        $routes['sobre_nos'] = array(
            'route' => '/sobre_nos',
            'controller' => 'IndexController',
            'action' => 'sobreNos'
        );


        $this->setRoutes($routes);
    }
}
