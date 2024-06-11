<?php

    class Cigarro extends OVNI {
        private $longitud;

        /*public function __construct($velocidad, $camuflaje, $longitud) {
            parent::__construct($velocidad, $camuflaje);
            $this->longitud = $longitud;
        }*/

        public function pintarHTML() {
            return 
            "<h2>Cigarro</h2>
            <p>Velocidad: $this->velocidad</p>
            <p>Camuflaje: $this->camuflaje</p>
            <p>Longitud: $this->longitud</p>";
        }

        public function cargarInfo($info) {
            $data = explode(';', $info);
            $this->velocidad = $data[5];
            $this->camuflaje = $data[6];
            $this->longitud = $data[7];
        }
    }

?>