<?php

abstract class Alerta {
    public $titulo;
    public $mensaje;

    public function __construct($titulo, $mensaje) {
        $this->titulo = $titulo;
        $this->mensaje = $mensaje;
    }
        
    abstract public function mostrar();
}

?>