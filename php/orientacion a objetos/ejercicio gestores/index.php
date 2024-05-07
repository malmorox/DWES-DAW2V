<?php

    spl_autoload_register(function ($nombre_clase) {
        include 'clases/' . $nombre_clase . '.php';
    });

    $gestores = [];

    $gestor_relacional = new GestorRelacional("MySQL", "Gestor de base de datos relacional", "Windows, Linux, macOS", "8.0", true);
    $gestor_no_relacional = new GestorNoRelacional("MongoDB", "Gestor de base de datos no relacional", "Documentos");
    $gestor_basado_en_fichero = new GestorBasadoEnFichero("Archivo CSV", "Gestor de base de datos basado en fichero", "CSV", "Lectura");
    
    $gestores = [$gestor_relacional, $gestor_no_relacional, $gestor_basado_en_fichero];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Gestores de bases de datos </title>
</head>
<body>
    <h1> Listado de gestores de bases de datos </h1>
    <ul>
        <?php foreach ($gestores as $gestor): ?>
            <li> <?= $gestor->renderHTML() ?> </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>