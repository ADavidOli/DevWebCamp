<?php

namespace Controllers;
use Classes\Email;
use Model\Usuario;
use MVC\Router;

class RegalosController{

    public static function index (Router $router){

        $router->render('admin/regalos/index',[
            'titulo'=> 'Regalos',
        ]);
    }

}