<?php
namespace Model;

class Dias extends ActiveRecord{
    // nota, cuando se toma ya de datos crudos de una base de datos.
    // no es necesario crear el contructor.
    public static $tabla = 'dias';
    public static $columnasDB = ['id', 'nombre'];

    public $id;
    public $nombre;

}