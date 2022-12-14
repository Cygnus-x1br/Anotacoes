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
        $routes['view_all_notes'] = array(
            'route' => '/view_all_notes',
            'controller' => 'IndexController',
            'action' => 'view_all_notes'
        );
        $routes['view_note'] = array(
            'route' => '/view_note',
            'controller' => 'IndexController',
            'action' => 'view_note'
        );
        $routes['list_notes'] = array(
            'route' => '/list_notes',
            'controller' => 'IndexController',
            'action' => 'list_notes'
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

        $routes['add_school'] = array(
            'route' => '/add_school',
            'controller' => 'SchoolController',
            'action' => 'add_school'
        );
        $routes['edit_school'] = array(
            'route' => '/edit_school',
            'controller' => 'SchoolController',
            'action' => 'edit_school'
        );
        $routes['save_school'] = array(
            'route' => '/save_school',
            'controller' => 'SchoolController',
            'action' => 'save_school'
        );
        $routes['change_school'] = array(
            'route' => '/change_school',
            'controller' => 'SchoolController',
            'action' => 'change_school'
        );
        $routes['delete_school'] = array(
            'route' => '/delete_school',
            'controller' => 'SchoolController',
            'action' => 'delete_school'
        );
        $routes['list_schools'] = array(
            'route' => '/list_schools',
            'controller' => 'SchoolController',
            'action' => 'list_schools'
        );

        $routes['add_curse'] = array(
            'route' => '/add_curse',
            'controller' => 'CurseController',
            'action' => 'add_curse'
        );
        $routes['edit_curse'] = array(
            'route' => '/edit_curse',
            'controller' => 'CurseController',
            'action' => 'edit_curse'
        );
        $routes['save_curse'] = array(
            'route' => '/save_curse',
            'controller' => 'CurseController',
            'action' => 'save_curse'
        );
        $routes['change_curse'] = array(
            'route' => '/change_curse',
            'controller' => 'CurseController',
            'action' => 'change_curse'
        );
        $routes['delete_curse'] = array(
            'route' => '/delete_curse',
            'controller' => 'CurseController',
            'action' => 'delete_curse'
        );
        $routes['list_curses'] = array(
            'route' => '/list_curses',
            'controller' => 'CurseController',
            'action' => 'list_curses'
        );

        $routes['add_subtitle'] = array(
            'route' => '/add_subtitle',
            'controller' => 'SubtitleController',
            'action' => 'add_subtitle'
        );
        $routes['edit_subtitle'] = array(
            'route' => '/edit_subtitle',
            'controller' => 'SubtitleController',
            'action' => 'edit_subtitle'
        );
        $routes['save_subtitle'] = array(
            'route' => '/save_subtitle',
            'controller' => 'SubtitleController',
            'action' => 'save_subtitle'
        );
        $routes['change_subtitle'] = array(
            'route' => '/change_subtitle',
            'controller' => 'SubtitleController',
            'action' => 'change_subtitle'
        );
        $routes['delete_subtitle'] = array(
            'route' => '/delete_subtitle',
            'controller' => 'SubtitleController',
            'action' => 'delete_subtitle'
        );
        $routes['list_subtitles'] = array(
            'route' => '/list_subtitles',
            'controller' => 'SubtitleController',
            'action' => 'list_subtitles'
        );

        $routes['add_class'] = array(
            'route' => '/add_class',
            'controller' => 'ClassController',
            'action' => 'add_class'
        );
        $routes['edit_class'] = array(
            'route' => '/edit_class',
            'controller' => 'ClassController',
            'action' => 'edit_class'
        );
        $routes['save_class'] = array(
            'route' => '/save_class',
            'controller' => 'ClassController',
            'action' => 'save_class'
        );
        $routes['change_class'] = array(
            'route' => '/change_class',
            'controller' => 'ClassController',
            'action' => 'change_class'
        );
        $routes['delete_class'] = array(
            'route' => '/delete_class',
            'controller' => 'ClassController',
            'action' => 'delete_class'
        );
        $routes['list_classes'] = array(
            'route' => '/list_classes',
            'controller' => 'ClassController',
            'action' => 'list_classes'
        );
        $routes['view_classes'] = array(
            'route' => '/view_classes',
            'controller' => 'ClassController',
            'action' => 'view_classes'
        );
        $routes['view_class'] = array(
            'route' => '/view_class',
            'controller' => 'ClassController',
            'action' => 'view_class'
        );


        $this->setRoutes($routes);
    }
}
