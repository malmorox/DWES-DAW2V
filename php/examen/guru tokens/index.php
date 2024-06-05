<?php
    require_once "funcionalidad.php";

    if (isset($_SESSION["emailUsuario"])) {
        header("Location: privada.php");
        die();
    }

    $listado_tokens = obtenerTokens();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Inicio </title>
</head>
<body>
    <h1>
        Listado de enlaces de autentificación
    </h1>
    <ul>
        <?php foreach($listado_tokens as $indice => $token): ?>
            <li> <a href="auth.php?token=<?= $token["token"] ?>"> Inicio de sesión <?= $indice + 1 ?> </a> </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>