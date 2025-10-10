<?php
namespace Controllers;

use Model\ponente;

class ApiPonentesController {
    public static function index(){

        $ponentes = ponente::all();
        echo json_encode($ponentes);
    }

    public static function ponente(){
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id || $id<1){
            echo json_encode([]);
            return;
        }

        $ponente = ponente::find($id);
        echo json_encode($ponente, JSON_UNESCAPED_SLASHES);
    }
}