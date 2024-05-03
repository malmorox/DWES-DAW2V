<?php

    class Tweet {
        private $contenido;
        private $idUsuario;
        private $fechaHora;
    
        public function __construct($contenido, $idUsuario) {
            $this->contenido = $contenido;
            $this->idUsuario = $idUsuario;
            $this->fechaHora = date('Y-m-d H:i:s');
        }
    
        public function getContenido() {
            return $this->contenido;
        }
    }

?>