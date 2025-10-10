<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Categorias;
use Model\Dias;
use Model\Eventos;
use Model\Horas;
use Model\ponente;
use MVC\Router;

class EventosController
{

    public static function index(Router $router)
    {
        if (!is_admin()) {
            header('Location: /login');
        }

        // agregamos paginacion
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        if (!$pagina_actual || $pagina_actual < 1) {
            header('Location: /admin/eventos?page=1');
        }
        $por_pagina = 10;
        $total = Eventos::count();
        $paginacion = new Paginacion($pagina_actual, $por_pagina, $total);
        // obtener los eventos paginados.
        $eventos = Eventos::paginar($por_pagina, $paginacion->offset());

        foreach ($eventos as $evento) {
            // le asignamos una nueva llave a la categoria de los eventos y buscamos de acuerdo al id
            $evento->categoria = Categorias::find($evento->categoria_id);
            $evento->dia = Dias::find($evento->dia_id);
            $evento->hora = Horas::find($evento->hora_id);
            $evento->ponente = ponente::find($evento->ponente_id);
        }
        $router->render('admin/eventos/index', [
            'titulo' => 'conferencias y workshops',
            'eventos' => $eventos,
            'paginacion' => $paginacion->paginacion(),
        ]);
    }

    public static function  crear(Router $router)
    {
        if (!is_admin()) {
            header('Location: /login');
        }
        $alertas = [];
        // obteniendo las categorias.
        $categorias = Categorias::all('ASC');
        $dias = Dias::all('ASC');
        $horas = Horas::all('ASC');
        $evento = new Eventos();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $evento->sincronizar($_POST);
            $alertas = $evento->validar();
            if (empty($alertas)) {
                $resultado = $evento->guardar();
                if ($resultado) {
                    header('Location: /admin/eventos');
                }
            }
        }

        $router->render('admin/eventos/crear', [
            'titulo' => 'crear eventos',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => $evento,
        ]);
    }

    public static function editar(Router $router)
    {
        if (!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            header('Location: /admin/eventos');
        }


        $categorias = Categorias::all('ASC');
        $dias = Dias::all('ASC');
        $horas = Horas::all('ASC');
        $evento = new Eventos();

        $evento = Eventos::find($id);
        if (!$evento) {
            header('Location: /admin/eventos');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $evento->sincronizar($_POST);
            $alertas = $evento->validar();
            if (empty($alertas)) {
                $resultado = $evento->guardar();
                if ($resultado) {
                    header('Location: /admin/eventos');
                }
            }
        }



        $router->render('admin/eventos/editar', [
            'titulo' => 'editar eventos',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => $evento,
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_admin()) {
                header('Location: /login');
            }
            $id = $_POST['id'];
            $evento = Eventos::find($id);

            if (!isset($ponente)) {
                header('Location: /admin/ponentes');
            }

            $resultado = $evento->eliminar();

            if ($resultado) {
                header('Location: /admin/eventos');
            }
        }
    }
}
