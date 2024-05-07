<?php

    require_once 'GestorDatos.php';

    class GestorBasadoEnFichero extends GestorDatos {
        public $formato_archivo;
        public $modo_acceso;
        
        public function __construct($nombre, $descripcion, $formato_archivo, $modo_acceso) {
            parent::__construct($nombre, $descripcion);
            $this->formato_archivo = $formato_archivo;
            $this->modo_acceso = $modo_acceso;
        }

        public function obtenerDetalle() {
            return "Formato del archivo: {$this->formato_archivo}\n 
                Modo de acceso: {$this->modo_acceso}";
        }
    }

?>