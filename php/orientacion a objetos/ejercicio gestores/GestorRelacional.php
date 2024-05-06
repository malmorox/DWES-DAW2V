<?php

    class GestorRelacional extends GestorDatos {
        public $sistemasOperativosSoportados;
        public $version;
        public $soporteTransacciones;
        
        public function __construct($nombre, $descripcion, $sistemasOperativosSoportados, $version, $soporteTransacciones) {
            parent::__construct($nombre, $descripcion);
            $this->sistemasOperativosSoportados = $sistemasOperativosSoportados;
        }
    }

?>