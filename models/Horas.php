<?php
namespace Model;

class Horas extends ActiveRecord{

    public static $tabla = 'horas';
    public static $columnasDB = ['id', 'hora'];

    public $id;
    public $hora;

}