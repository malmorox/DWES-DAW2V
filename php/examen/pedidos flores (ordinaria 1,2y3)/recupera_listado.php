<?php
    require_once "funcionalidad.php";

    $tokens = obtenerTokens();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de recuperación</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <!-- listado de enlaces para recuperar contraseña con varios tokens -->
    <div id="contenedor">
    <h1>Recuperar contraseña</h1>
    <ul>
        <?php foreach($tokens as $indice => $token): ?>
            <li><a href="recupera.php?token=<?= $token["token"] ?>"> Recuperar contraseña <?= $indice + 1 ?> </a></li>
        <?php endforeach; ?>
    </ul>
    </div>
    
</body>
</html>