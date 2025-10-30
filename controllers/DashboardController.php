<?php

namespace Controllers;
use Classes\Email;
use Model\Eventos;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

class DashboardController{

    public static function index (Router $router){
        // obtener ultimos registros
        $registros = Registro::get(5);

        foreach ($registros as $registro){
            $registro->usuario = Usuario::find($registro->usuario_id);
        }

        //calcular los ingresos.
        $virtuales = Registro::count('paquete_id',2);
        $presenciales = Registro::count('paquete_id',1);

        $ingresos = ($virtuales * 46.41) + ($presenciales * 189.54);
        // obtener eventos con más y menos lugares disponibles.
        $menos_lugares = Eventos::ordenarLimite('disponibles', 'ASC', 5);
        $mas_lugares = Eventos::ordenarLimite('disponibles', 'DESC', 5);

        $router->render('admin/dashboard/index',[
            'titulo'=> 'panel de administracion',
            'registros'=>$registros,
            'ingresos' => $ingresos,
            'menos' => $menos_lugares,
            'mas'=> $mas_lugares,
        ]);
    }

}