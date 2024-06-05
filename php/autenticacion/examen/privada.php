<?php
    require_once "funcionalidad.php";

    if (!isset($_SESSION["emailUsuario"])) {
        header("Location: index.php");
        die();
    } else {
        $email_usuario_loggeado = $_SESSION["emailUsuario"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Página privada </title>
</head>
<body>
    <h1>Bienvenido</h1>
    <h2>Hola <?= $email_usuario_loggeado ?></h2>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>