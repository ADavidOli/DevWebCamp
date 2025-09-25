<?php

namespace Controllers;
use Classes\Email;
use Model\Usuario;
use MVC\Router;

class EventosController{

    public static function index (Router $router){

        $router->render('admin/eventos/index',[
            'titulo'=> 'Eventos',
        ]);
    }

}