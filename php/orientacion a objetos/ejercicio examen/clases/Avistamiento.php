<?php

    class Avistamiento {
        private $localizacion;
        private $fecha;
        private $hora;
        private $notas;
        private $objetoOVNI;

        public function pintarHTML() {
            return 
            "<p>Localización: $this->localizacion</p>
            <p>Fecha: $this->fecha</p>
            <p>Hora: $this->hora</p>
            <p>Notas: $this->notas</p>"
            . $this->objetoOVNI->pintarHTML();
        }

        public function cargarInfo($info) {
            $data = explode(';', $info);
            $this->localizacion = $data[0];
            $this->fecha = $data[1];
            $this->hora = $data[2];
            $this->notas = $data[3];

            switch ($data[4]) {
                case 'disco':
                    $this->objetoOVNI = new DiscoVolador();
                    break;
                case 'cigarro':
                    $this->objetoOVNI = new Cigarro();
                    break;
                default:
                    $this->objetoOVNI = new LuzMisteriosa();
                    break;
            }

            $this->objetoOVNI->cargarInfo($info);
        }
    }

?>