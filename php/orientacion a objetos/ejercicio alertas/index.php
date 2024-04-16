<?php

    define('NUMERO_ALERTAS_ALEATORIAS', 10);

    spl_autoload_register(function ($nombre_clase) {
        include 'clases/' . $nombre_clase . '.php';
    });

    $tipos_alerta = ['AlertaWarning', 'AlertaError', 'AlertaAlarma'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Alertas con POO </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <?php
        for ($i = 0; $i < NUMERO_ALERTAS_ALEATORIAS; $i++) {
            $tipo_alerta = $tipos_alerta[array_rand($tipos_alerta)];
            $titulo = "Título de la alerta nº" . ($i + 1);
            $mensaje = "Mensaje de la alerta nº" . ($i + 1);
            
            $alerta = new $tipo_alerta($titulo, $mensaje);

            $alerta->mostrar();
        }
    ?>
</body>
</html>
