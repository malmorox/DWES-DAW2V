<?php

class Partido {
    public $equipoLocal;
    public $equipoVisitante;
    public $fecha;

    public function __construct($equipoLocal, $equipoVisitante, $fecha) {
        $this->equipoLocal = $equipoLocal;
        $this->equipoVisitante = $equipoVisitante;
        $this->fecha = $fecha;
    }

    public function mostrarInformacionPartido() {
        echo "Fecha del Partido: {$this->fecha}\n";
        echo "Equipo Local: {$this->equipoLocal->nombre}\n";
        echo "Equipo Visitante: {$this->equipoVisitante->nombre}\n";
    }
}
?>