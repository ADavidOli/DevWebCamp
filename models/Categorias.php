<?php
namespace Model;

class Categorias extends ActiveRecord{

    public static $tabla = 'categorias';
    public static $columnasDB = ['id', 'nombre'];

    public $id;
    public $nombre;
      
}