<?php 
namespace Classes;


class Paginacion{

    public $pagina_actual;
    public $registros_pagina;
    public $total;

    public function __construct($pagina_actual = 1, $registros_pagina = 10, $total = 0){
        $this->pagina_actual = (int) $pagina_actual;
        $this->registros_pagina = (int) $registros_pagina;
        $this->total = (int) $total;
    }
  
    public function offset(){
        return $this->registros_pagina * ($this->pagina_actual - 1);
    }

    public function totalPaginas(){
        return ceil($this->total / $this->registros_pagina );
    }

    public function paginaAnterior(){
        $anterior = $this->pagina_actual - 1;
        return ($anterior > 0) ? $anterior : false;
    }

    public function paginaSiguiente(){
        $siguiente = $this->pagina_actual + 1;
        return $siguiente <= $this->totalPaginas() ? $siguiente : false;
    }

    public function enlace_anterior(){
         $html='';
        if($this->paginaAnterior()){
            $html .= "<a class=\"paginacion__enlace panigacion__enlace--texto\" href=\"?page={$this->paginaAnterior()} \"> Anterior &laquo;</a>";
        }
        return $html;
    }
    public function enlace_siguiente(){
        $html='';
        if($this->paginaSiguiente()){
            $html .= "<a class=\"paginacion__enlace panigacion__enlace--texto\" href=\"?page={$this->paginaSiguiente()} \"> Siguiente &raquo;</a>";
        }
        return $html;
    }
    public function paginacion(){
        $html ='';
        if($this->total > 1){
            $html .= '<div class="paginacion">';
            $html .= $this->enlace_anterior();
            $html .= $this->enlace_siguiente();
            $html .= '</div>';
        }
        return $html;
    }
}