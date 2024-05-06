<?php

    class GestorNoRelacional extends GestorDatos {
        public $tipoModeloDatos;
        
        public function mostrar() {
            echo "<script> alert('{$this->titulo}: {$this->mensaje}'); </script>";
        }
    }

?>