<?php

    define('FICHERO_CSV_AVISTAMIENTOS', 'avistamientos.csv');

    spl_autoload_register(function ($nombre_clase) {
        include 'clases/' . $nombre_clase . '.php';
    });

    $avistamientos = [];
    $archivo = fopen(FICHERO_CSV_AVISTAMIENTOS, 'r');

    // Esto omite la primera línea del archivo
    fgets($archivo);

    //read($archivo) array de arrays
    //file($archivo) array de strings (cadenas del csv) usar count en el for

    while (($linea = fgets($archivo)) !== false) {
        //$data = explode(';', $linea);
        $avistamiento = new Avistamiento();
        $avistamiento->cargarInfo($linea);
        $avistamientos[] = $avistamiento;
    }
    fclose($archivo);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Avistamientos examen </title>
</head>
<body>
    <h1> Listado de avistamientos </h1>
    <ul>
        <?php foreach ($avistamientos as $avistamiento): ?>
            <li> <?= $avistamiento->pintarHTML(); ?> </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>