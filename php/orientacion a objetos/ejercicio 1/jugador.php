<?php

class Jugador {
    public $nombre;
    public $posicion;

    public function __construct($nombre, $posicion) {
        $this->nombre = $nombre;
        $this->posicion = $posicion;
    }

    public function mostrarInformacionJugador() {
        echo "Nombre: {$this->nombre}, Posición: {$this->posicion}\n";
    }
}
?>