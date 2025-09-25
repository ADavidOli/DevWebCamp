<?php

namespace Controllers;
use Classes\Email;
use Model\Usuario;
use MVC\Router;

class DashboardController{

    public static function index (Router $router){

        $router->render('admin/dashboard/index',[
            'titulo'=> 'panel de administracion',
        ]);
    }

}