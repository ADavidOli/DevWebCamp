<?php

namespace Controllers;

use Model\Dias;
use MVC\Router;
use Model\Horas;
use Model\Eventos;
use Model\ponente;
use Model\Categorias;

class paginascontroller
{

    public static function index(Router $router)
    {

        $router->render('/paginas/index', [
            'titulo' => 'inicio',
        ]);
    }


    public static function evento(Router $router)
    {

        $router->render('/paginas/DevWebCamp', [
            'titulo' => 'sobre DevWebCamp',
        ]);
    }
    public static function paquetes(Router $router)
    {

        $router->render('/paginas/paquetes', [
            'titulo' => 'paquetes',
        ]);
    }
    public static function conferencias(Router $router)
    {
        // ordenar los eventos de una forma asc a traves de la columnda
        $eventos = Eventos::ordenar('hora_id', 'ASC');
        $eventos_formateado = [];
        foreach ($eventos as $evento) {
            // le agregamos un subobjeto a nuestro objeto de evento.
            // este tendra los datos de acuerdo cada indice creado
            // categoria, dia, hora, ponente.
            // cada uno tendra los datos ya buscados de acuerdoa  su id.
            $evento->categoria = Categorias::find($evento->categoria_id);
            $evento->dia = Dias::find($evento->dia_id);
            $evento->hora = Horas::find($evento->hora_id);
            $evento->ponente = ponente::find($evento->ponente_id);

            // así podemos enlazar datos dentro de un nuevo arreglo con un for each
            if ($evento->dia_id === "1" && $evento->categoria_id === "1") {
                $eventos_formateado['conferencias_v'][] = $evento;
            }
            if ($evento->dia_id === "2" && $evento->categoria_id === "1") {
                $eventos_formateado['conferencias_s'][] = $evento;
            }
            if ($evento->dia_id === "1" && $evento->categoria_id === "2") {
                $eventos_formateado['workshops_v'][] = $evento;
            }
            if ($evento->dia_id === "2" && $evento->categoria_id === "2") {
                $eventos_formateado['workshops_s'][] = $evento;
            }
        }

        $router->render('/paginas/conferencias', [
            'titulo' => 'workshops & conferencias',
            'eventos' => $eventos_formateado,
        ]);
    }
}
