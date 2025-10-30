<?php

namespace Controllers;

use MVC\Router;
use Model\Paquete;
use Model\Usuario;
use Model\Registro;

class registroController
{
    public static function crear(Router $router)
    {

        if (!is_auth()) {
            header('Location: /');
        }
        // verificar si el usuario ya esta registrado.
        $registro = Registro::where('usuario_id', $_SESSION['id']);
        if (isset($registro) && $registro->paquete_id === '3') {
            header('Location: /boleto?id=' . urlencode($registro->token));
        }

        $router->render('registro/crear', [
            'titulo' => 'Finalizar registro'
        ]);
    }

    public static function gratis(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_auth()) {
                header('Location: /login');
            }
            $registro = Registro::where('usuario_id', $_SESSION['id']);
            if (isset($registro) && $registro->paquete_id === '3') {
                header('Location: /boleto?id=' . urlencode($registro->token));
            }

            // generamos un token con una cantidad de 8 caracteres
            $token = substr(md5(uniqid(rand(), true)), 0, 8);

            $datos = array(
                'paquete_id' => 3,
                'pago_id' => '',
                'token' => $token,
                'usuario_id' => $_SESSION['id'],
            );

            $registro = new Registro($datos);
            $resultado = $registro->guardar();
            if ($resultado) {
                header('Location: /boleto?id=' . urlencode($registro->token));
            }
        }
    }

    public static function boleto(Router $router)
    {
        // validar url
        $id = $_GET['id'];

        if (!$id || !strlen($id) === 8) {
            header('Location: /');
        }
        // buscar id en la base de datos.
        $registro = Registro::where('token', $id);
        if (!$registro) {
            header('Location: /');
        }
        // llenar las tablas de referencia
        $registro->usuario = Usuario::find($registro->usuario_id);
        $registro->paquete = Paquete::find($registro->paquete_id);



        $router->render('registro/boleto', [
            'titulo' => 'Asistencia a DevWebCamp',
            'registro' => $registro,

        ]);
    }
}
