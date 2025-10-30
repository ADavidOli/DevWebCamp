<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;
use Model\Registro;
use Classes\Paginacion;
use Model\Paquete;

class RegistradosController
{

    public static function index(Router $router)
    {
        // paginacion de ponentes.
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/registrados?page=1');
        }
        $registros_pagina = 7;
        $total = Registro::count();
        $paginacion = new Paginacion($pagina_actual, $registros_pagina, $total);
        $offset = $paginacion->offset();
        if ($paginacion->totalPaginas() < $pagina_actual) {
            header('Location: /admin/registrados?page=1');
        }
        //mostrar datos
        $alertas = [];
        // metodo en active record para paginar.
        $registros = Registro::paginar($registros_pagina, $offset);
        if (!is_admin()) {
            header('Location: /login');
        }

        foreach ($registros as $registro){
            $registro->usuario = Usuario::find($registro->usuario_id);
            $registro->paquete = Paquete::find($registro->paquete_id);
        }

        
        $router->render('admin/registrados/index', [
            'titulo' => 'Registros',
            'registros' => $registros,
            'paginacion' => $paginacion->paginacion(),
        ]);
    }
}
