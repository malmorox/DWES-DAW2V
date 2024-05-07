<?php

    require_once 'GestorDatos.php';
    require_once 'HTMLRendererTrait.php';

    class GestorNoRelacional extends GestorDatos {
        public $tipo_modelo_datos;
        
        public function __construct($nombre, $descripcion, $tipo_modelo_datos) {
            parent::__construct($nombre, $descripcion);
            $this->tipo_modelo_datos = $tipo_modelo_datos;
        }

        public function obtenerDetalle() {
            return "Tipo de modelo de datos: {$this->tipo_modelo_datos}";
        }

        use HTMLRenderer;
    }

?>