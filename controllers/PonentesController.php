<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Classes\Paginacion;
use Model\ponente;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController
{

    public static function index(Router $router)
    {
        // paginacion de ponentes.
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);
        if(!$pagina_actual || $pagina_actual<1){
            header('Location: /admin/ponentes?page=1');
        }
        $registros_pagina = 6;
        $total = ponente::count();
        $paginacion = new Paginacion($pagina_actual, $registros_pagina, $total);
        $offset = $paginacion->offset();
        if($paginacion->totalPaginas()<$pagina_actual){
            header('Location: /admin/ponentes?page=1');
        }
        //mostrar datos
        $alertas = [];
        // metodo en active record para paginar.
        $ponentes = ponente::paginar($registros_pagina, $offset);
        if (!is_admin()) {
            header('Location: /login');
        }

        $router->render('admin/ponentes/index', [
            'titulo' => 'ponentes / conferencistas',
            'ponentes' => $ponentes,
            'alertas' => $alertas,
            'paginacion'=> $paginacion->paginacion(),
        ]);
    }
    //metodo para crear ponentes.
    public static function crear(Router $router)
    {
        if (!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        $ponente = new ponente();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 1.-leer si tenemos una imagen
            // debuguear($_FILES); UTILIZA LA VARIABLE GLOBAL FILES PARA PODER LOS ARCHIVOS subidos
            if (!empty($_FILES['imagen']['tmp_name'])) {
                // primero instanciamos nuestra ruta de imagenes.
                $carpetaImagenes = '../public/img/speakers';
                // crear la ruta de la carpeta si no existe.
                if (!is_dir($carpetaImagenes)) {
                    // mkdir, funcion de creacion de archiv, se le especifica los permisos y la forma recursiva.
                    mkdir($carpetaImagenes, 0777, true);
                }
                // creamos nuestra ruta tmp para pasarle a interventionImagen.
                $tmp = $_FILES['imagen']['tmp_name'];
                // esto nos crea las imagenes y aparte nos da un formato de tamaño como de terminacion, segun la imagen
                $imagen_png = Image::make($tmp)->fit(800, 800)->encode('png', 80);
                $imagen_webp = Image::make($tmp)->fit(800, 800)->encode('webp', 80);

                // creamos el nombre de la imagen UNICO. md5 se usa para crear caracteres aleatorios, así evitamos el error de mismo nombre
                // uniqid nos ayuda a que no sea una cadena diferente cada vez que cargue.
                // rand no ayuda a dar valores random y que no se repite, true es para dar valores más unicos
                $nombre_imagen = md5(uniqid(rand(), true));

                // tomamos del post la imagen Y le asignamos  nuestro nombre_imagen para pasar la validacion y guardarlo en la BD.
                $_POST['imagen'] = $nombre_imagen;
                // ahora sí, podemos guardar imagen.

            } //en caso de que no haya imagen, se genera siempre
            // 1.1 manejamos nuesros arreglos en redes sociales.
            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);
            // 2.- sincronizamos nuestros datos
            $ponente->sincronizar($_POST);

            // 3.- VALIDAR.
            $alertas = $ponente->validar();
            // 4.- guardar todo el registro en la memoria del servidor y en la BD.
            if (empty($alertas)) {
                //4.1 guardar ruta de las imagenes en la memoria del servidor
                $imagen_png->save($carpetaImagenes . '/' . $nombre_imagen . ".png");
                $imagen_webp->save($carpetaImagenes . '/' . $nombre_imagen . ".webp");

                // 4.2 guardar en la base de datos.
                $resultado = $ponente->guardar();
                if ($resultado) {
                    header('Location: /admin/ponentes');
                }
            }
        }
        $redes = json_decode($ponente->redes);

        $router->render('admin/ponentes/crear', [
            'titulo' => 'Registrar ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => $redes,
        ]);
    }

    public static function editar(Router $router)
    {
        if (!is_admin()) {
            header('Location: /login');
        }
        $alertas = [];
        $id = $_GET['id'];
        // nos aseguramos que la id siempre sea un numero entero
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /admin/ponentes');
        }
        $ponente = ponente::find($id);
        if (!$ponente) {
            header('Location: /admin/ponentes');
        }

        // para actualizar la imagen primero tenemos que obtener la imagen, luego borrarla y luego subirla.
        // creamos una variable temporal para poder comparar la imagen actual
        $ponente->imagen_actual = $ponente->imagen;

        // tomar el string a objeto con json.
        $redes = json_decode($ponente->redes);

        // actualizar.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // PRIMERO checamos si hay una nueva imagen.
            if (!empty($_FILES['imagen']['tmp_name'])) {
                $carpetaImagenes = '../public/img/speakers';

                if (!is_dir($carpetaImagenes)) {
                    mkdir($carpetaImagenes, 0777, true);
                }

                $tmp = $_FILES['imagen']['tmp_name'];
                $imagen_png = Image::make($tmp)->fit(800, 800)->encode('png', 80);
                $imagen_webp = Image::make($tmp)->fit(800, 800)->encode('webp', 80);
                $nombre_imagen = md5(uniqid(rand(), true));
                $_POST['imagen'] = $nombre_imagen;
            } else {
                // en caso de que no haya.
                $_POST['imagen'] = $ponente->imagen_actual;
            }
            //hacemos el arreglo a un string
            $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);
            // eso nos permite sincronizar los datos.
            $ponente->sincronizar($_POST);
            $alertas = $ponente->validar();
            if (empty($alertas)) {
                // si las alertas está vacias, checamos si hay un nombre imagen
                if (isset($nombre_imagen)) {
                    $imagen_png->save($carpetaImagenes . '/' . $nombre_imagen . ".png");
                    $imagen_webp->save($carpetaImagenes . '/' . $nombre_imagen . ".webp");
                }

                $resultado = $ponente->guardar();

                if ($resultado) {
                    header('Location: /admin/ponentes');
                }
            }
        }
        $router->render('admin/ponentes/editar', [
            'redes' => $redes,
            'alertas' => $alertas,
            'titulo' => 'Actualizar ponente',
            'ponente' => $ponente,
        ]);
    }

    public static function eliminar()
    {

        if (!is_admin()) {
            header('Location: /login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $ponente = ponente::find($id);

            if (!isset($ponente)) {
                header('Location: /admin/ponentes');
            }

            $resultado = $ponente->eliminar();

            if ($resultado) {
                header('Location: /admin/ponentes');
            }
        }
    }
}
