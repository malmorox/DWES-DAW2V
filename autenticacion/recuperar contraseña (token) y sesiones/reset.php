<?php
    require_once "conexion.php";

    $token = $_GET["token"] ?? null;
    $nuevaContrasena = $_POST["nueva-contrasena"] ?? null;

    if ($token && $nuevaContrasena) {
        if (restablecerContrasena($token, $nuevaContrasena)) {
            header("Location: exito-reset.php");
            exit;
        } else {
            header("Location: reset_error.php");
            exit;
        }
    } else {
        header("Location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer contraseña</title>
</head>
<body>
    <h2>Restablecer contraseña</h2>
    <form action="reset_process.php" method="post">
        <label for="nueva-contrasena">Nueva contraseña:</label>
        <input type="password" id="nueva-contrasena" name="nueva-contrasena" required>
        <input type="submit" value="Restablecer contraseña">
    </form>
</body>
</html>