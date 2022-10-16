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
        $routes['log_out'] = array(
            'route' => '/log_out',
            'controller' => 'SigninController',
            'action' => 'log_out'
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
        $routes['list_user'] = array(
            'route' => '/list_user',
            'controller' => 'UserController',
            'action' => 'list_user'
        );
        $routes['add_note'] = array(
            'route' => '/add_note',
            'controller' => 'NoteController',
            'action' => 'add_note'
        );
        $routes['save_note'] = array(
            'route' => '/save_note',
            'controller' => 'NoteController',
            'action' => 'save_note'
        );
        $routes['list_note'] = array(
            'route' => '/list_note',
            'controller' => 'NoteController',
            'action' => 'list_note'
        );
        $routes['add_subject'] = array(
            'route' => '/add_subject',
            'controller' => 'SubjectController',
            'action' => 'add_subject'
        );
        $routes['save_subject'] = array(
            'route' => '/save_subject',
            'controller' => 'SubjectController',
            'action' => 'save_subject'
        );
        $routes['list_subjects'] = array(
            'route' => '/list_subjects',
            'controller' => 'SubjectController',
            'action' => 'list_subjects'
        );


        $this->setRoutes($routes);
    }
}
