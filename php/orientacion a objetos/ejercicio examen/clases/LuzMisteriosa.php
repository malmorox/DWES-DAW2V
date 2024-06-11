<?php

    class LuzMisteriosa extends OVNI {
        private $duracion;

        /*public function __construct($velocidad, $camuflaje, $duracion) {
            parent::__construct($velocidad, $camuflaje);
            $this->duracion = $duracion;
        }*/

        public function pintarHTML() {
            return 
            "<h2>Luz misteriosa</h2>
            <p>Velocidad: $this->velocidad</p>
            <p>Camuflaje: $this->camuflaje</p>
            <p>Duracion: $this->duracion</p>";
        }

        public function cargarInfo($info) {
            $data = explode(';', $info);
            $this->velocidad = $data[5];
            $this->camuflaje = $data[6];
            $this->duracion = $data[7];
        }
    }

?>