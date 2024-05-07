<?php

    require_once 'GestorDatos.php';

    class GestorRelacional extends GestorDatos {
        public $sistemas_operativos_soportados;
        public $version;
        public $soporte_transacciones;
        
        public function __construct($nombre, $descripcion, $sistemas_operativos_soportados, $version, $soporte_transacciones) {
            parent::__construct($nombre, $descripcion);
            $this->sistemas_operativos_soportados = $sistemas_operativos_soportados;
            $this->version = $version;
            $this->soporte_transacciones = $soporte_transacciones;
        }

        public function obtenerDetalle() {
            $soporte_transacciones_cadena = $this->soporte_transacciones ? "Sí" : "No";
            return "Sistemas operativos soportados: {$this->sistemas_operativos_soportados}\n 
                Versión: {$this->version}\n 
                Soporte de transacciones: {$soporte_transacciones_cadena}";
        }
    }

?>