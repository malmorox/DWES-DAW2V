<?php
require_once 'Jugador.php';
require_once 'Equipo.php';
require_once 'Partido.php';

// Creamos los jugadores
$jugador1 = new Jugador("Messi", "Delantero");
$jugador2 = new Jugador("Ronaldo", "Delantero");
$jugador3 = new Jugador("Neymar", "Delantero");

// Creamos los equipos y añadimos los jugadores
$equipo1 = new Equipo("Barcelona");
$equipo1->agregarJugador($jugador1);
$equipo1->agregarJugador($jugador3);

$equipo2 = new Equipo("Real Madrid");
$equipo2->agregarJugador($jugador2);

// Creamos el partido
$partido = new Partido($equipo1, $equipo2, "2024-03-13");

// Mostramos información del partido
$partido->mostrarInformacionPartido();
?>