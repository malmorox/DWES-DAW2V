<?php

    abstract class GestorDatos {
        public $nombre;
        public $descripcion;
    
        public function __construct($nombre, $descripcion) {
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
        }
            
        abstract public function obtenerDetalle();
    }

?>