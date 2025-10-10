<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\ApiEventosController;
use Controllers\ApiPonentesController;
use MVC\Router;
use Controllers\AuthController;
use Controllers\DashboardController;
use Controllers\EventosController;
use Controllers\paginascontroller;
use Controllers\PonentesController;
use Controllers\RegalosController;
use Controllers\RegistradosController;
use Model\Eventos;

$router = new Router();


// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/recuperar', [AuthController::class, 'reestablecer']);
$router->post('/recuperar', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);

// RUTAS PARA ADMINISTRADOR.
$router->get('/admin/dashboard',[DashboardController::class, 'index']);

//ponentes
$router->get('/admin/ponentes',[PonentesController::class, 'index']);
$router->get('/admin/ponentes/crear',[PonentesController::class, 'crear']);
$router->post('/admin/ponentes/crear',[PonentesController::class, 'crear']);
$router->get('/admin/ponentes/editar',[PonentesController::class, 'editar']);
$router->post('/admin/ponentes/editar',[PonentesController::class, 'editar']);
$router->post('/admin/ponentes/eliminar',[PonentesController::class, 'eliminar']);
$router->get('/admin/ponentes/search',[PonentesController::class, 'search']);
// eventos
$router->get('/admin/eventos',[EventosController::class, 'index']);
$router->get('/admin/eventos/crear',[EventosController::class, 'crear']);
$router->post('/admin/eventos/crear',[EventosController::class, 'crear']);
$router->get('/admin/eventos/editar',[EventosController::class, 'editar']);
$router->post('/admin/eventos/editar',[EventosController::class, 'editar']);
$router->post('/admin/eventos/eliminar',[EventosController::class, 'eliminar']);
$router->get('/admin/registrados',[RegistradosController::class, 'index']);
$router->get('/admin/regalos',[RegalosController::class, 'index']);


// api
$router->get('/api/eventos-horario',[ApiEventosController::class, 'index']);
$router->get('/api/ponentes',[ApiPonentesController::class, 'index']);
$router->get('/api/ponente',[ApiPonentesController::class, 'ponente']);


// area publica.
$router->get('/',[paginascontroller::class, 'index']);
$router->get('/devwebcamp',[paginascontroller::class, 'evento']);
$router->get('/paquetes',[paginascontroller::class, 'paquetes']);
$router->get('/workshops-conferencias',[paginascontroller::class, 'conferencias']);
$router->get('/404', [paginascontroller::class, 'fallo']);

//redireccionamienot de paginas.



$router->comprobarRutas();