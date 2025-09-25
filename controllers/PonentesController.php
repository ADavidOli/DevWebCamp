<?php

namespace Controllers;
use MVC\Router;
use Classes\Email;
use Model\ponente;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController{

    public static function index (Router $router){

        $alertas =[];
        $ponentes = ponente::all();
        debuguear($ponentes);


        $router->render('admin/ponentes/index',[
            'ponentes' => $ponentes,
            'alertas' => $alertas,
            'titulo'=> 'ponentes / conferencistas',
        ]);
    } 
    //metodo para crear ponentes.
    public static function crear(Router $router){
        $alertas = [];
        $ponente = new ponente();
        if($_SERVER['REQUEST_METHOD']==='POST'){
            // 1.-leer si tenemos una imagen
            // debuguear($_FILES); UTILIZA LA VARIABLE GLOBAL FILES PARA PODER LOS ARCHIVOS subidos
            if(!empty($_FILES['imagen']['tmp_name'])){
                // primero instanciamos nuestra ruta de imagenes.
                $carpetaImagenes = '../public/img/speakers';
                // crear la ruta de la carpeta si no existe.
                if(!is_dir($carpetaImagenes)){
                    // mkdir, funcion de creacion de archiv, se le especifica los permisos y la forma recursiva.
                    mkdir($carpetaImagenes,0777, true);
                }
                // creamos nuestra ruta tmp para pasarle a interventionImagen.
                $tmp = $_FILES['imagen']['tmp_name'];
                // esto nos crea las imagenes y aparte nos da un formato de tamaño como de terminacion, segun la imagen
                $imagen_png = Image::make($tmp)->fit(800,800)->encode('png',80);  
                $imagen_webp = Image::make($tmp)->fit(800,800)->encode('webp',80);  
                
                // creamos el nombre de la imagen UNICO. md5 se usa para crear caracteres aleatorios, así evitamos el error de mismo nombre
                // uniqid nos ayuda a que no sea una cadena diferente cada vez que cargue.
                // rand no ayuda a dar valores random y que no se repite, true es para dar valores más unicos
                $nombre_imagen = md5(uniqid(rand(), true));

                // tomamos del post la imagen Y le asignamos  nuestro nombre_imagen para pasar la validacion y guardarlo en la BD.
                $_POST['imagen'] = $nombre_imagen;
                // ahora sí, podemos guardar imagen.

            }//en caso de que no haya imagen, se genera siempre
            // 1.1 manejamos nuesros arreglos en redes sociales.
                $_POST['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);
            // 2.- sincronizamos nuestros datos
            $ponente->sincronizar($_POST);

            // 3.- VALIDAR.
            $alertas = $ponente->validar();
            // 4.- guardar todo el registro en la memoria del servidor y en la BD.
            if(empty($alertas)){
                //4.1 guardar ruta de las imagenes en la memoria del servidor
                $imagen_png->save($carpetaImagenes . '/' .$nombre_imagen . ".png");
                $imagen_webp->save($carpetaImagenes . '/' .$nombre_imagen . ".webp");

                // 4.2 guardar en la base de datos.
                $resultado = $ponente->guardar();
                if($resultado){
                    header('Location: /admin/ponentes');
                }

            }
            
        }

        $router->render('admin/ponentes/crear',[
            'titulo'=>'Registrar ponente',
            'alertas'=> $alertas,
            'ponente' => $ponente,
        ]);
    }

}