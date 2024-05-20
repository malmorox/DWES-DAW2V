<?php

    require_once 'init.php';

    if (isset($_COOKIE['recuerdame'])) {
        $token = $_COOKIE['recuerdame'];

        $id_usuario = buscarIdUsuarioPorToken(substr($token, 0, -1));

        if ($id_usuario !== null) {
            $_SESSION['usuario'] = obtenerNombreUsuario($id_usuario);
        }
    }

    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit();
    } else {
        $usuario = $_SESSION['usuario'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Inicio </title>
</head>
<body>
    <h1> Bienvenido <?= $usuario; ?> </h1>
    <a href="logout.php"> Cerrar sesión </a>
</body>
</html>