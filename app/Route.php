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
        $routes['edit_note'] = array(
            'route' => '/edit_note',
            'controller' => 'NoteController',
            'action' => 'edit_note'
        );
        $routes['save_note'] = array(
            'route' => '/save_note',
            'controller' => 'NoteController',
            'action' => 'save_note'
        );
        $routes['change_note'] = array(
            'route' => '/change_note',
            'controller' => 'NoteController',
            'action' => 'change_note'
        );
        $routes['delete_note'] = array(
            'route' => '/delete_note',
            'controller' => 'NoteController',
            'action' => 'delete_note'
        );
        $routes['list_notes'] = array(
            'route' => '/list_notes',
            'controller' => 'NoteController',
            'action' => 'list_notes'
        );

        $routes['add_subject'] = array(
            'route' => '/add_subject',
            'controller' => 'SubjectController',
            'action' => 'add_subject'
        );
        $routes['edit_subject'] = array(
            'route' => '/edit_subject',
            'controller' => 'SubjectController',
            'action' => 'edit_subject'
        );
        $routes['save_subject'] = array(
            'route' => '/save_subject',
            'controller' => 'SubjectController',
            'action' => 'save_subject'
        );
        $routes['change_subject'] = array(
            'route' => '/change_subject',
            'controller' => 'SubjectController',
            'action' => 'change_subject'
        );
        $routes['delete_subject'] = array(
            'route' => '/delete_subject',
            'controller' => 'SubjectController',
            'action' => 'delete_subject'
        );
        $routes['list_subjects'] = array(
            'route' => '/list_subjects',
            'controller' => 'SubjectController',
            'action' => 'list_subjects'
        );


        $this->setRoutes($routes);
    }
}
