<?php

    class GestorBasadoEnFichero extends GestorDatos {
        public $formatoArchivo;
        public $modoAcceso;
        
        public function mostrar() {
            echo "<script> alert('{$this->titulo}: {$this->mensaje}'); </script>";
        }
    }

?>