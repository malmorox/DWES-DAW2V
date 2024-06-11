<?php

    class DiscoVolador extends OVNI {
        private $radio;

        /*public function __construct($velocidad, $camuflaje, $radio) {
            parent::__construct($velocidad, $camuflaje);
            $this->radio = $radio;
        }*/

        public function pintarHTML() {
            return 
            "<h2>Disco Volador</h2>
            <p>Velocidad: $this->velocidad</p>
            <p>Camuflaje: $this->camuflaje</p>
            <p>Radio: $this->radio</p>";
        }

        public function cargarInfo($info) {
            $data = explode(';', $info);
            $this->velocidad = $data[5];
            $this->camuflaje = $data[6];
            $this->radio = $data[7];
        }
    }

?>