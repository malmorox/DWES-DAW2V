<?php

class Equipo {
    public $nombre;
    public $jugadores;

    public function __construct($nombre) {
        $this->nombre = $nombre;
        $this->jugadores = [];
    }

    public function agregarJugador($jugador) {
        $this->jugadores[] = $jugador;
    }

    public function mostrarInformacionEquipo() {
        echo "Equipo: {$this->nombre}\n";
        echo "Jugadores:\n";
        foreach ($this->jugadores as $jugador) {
            $jugador->mostrarInformacionJugador();
        }
    }
}
?>