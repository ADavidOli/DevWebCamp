<?php
namespace Controllers;

use Model\ponente;

class ApiPonentesController {
    public static function index(){

        $ponentes = ponente::all();
        echo json_encode($ponentes);
    }
}