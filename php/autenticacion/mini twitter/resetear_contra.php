<?php

    $errores = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nueva_contrasena = isset($_POST['nueva_contrasena']) ? trim($_POST['nueva_contrasena']) : null;
        $confirmar_nueva_contrasena = isset($_POST['confirmar_nueva_contrasena']) ? trim($_POST['confirmar_nueva_contrasena']) : null;

        if (empty($nueva_contrasena)) {
            $errores['nueva_contrasena'] = "Debes introducir una nueva contraseña";
        } 

        if (empty($confirmar_nueva_contrasena)) {
            $errores['confirmar_nueva_contrasena'] = "Debes confirmar la contraseña";
        } elseif (!empty($contrasena) && $contrasena !== $confirmar_contrasena) {
            $errores['confirmar_nueva_contrasena'] = "Las contraseñas deben coincidir";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Recuperar la contraseña </title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <h2> Restablece tu contraseña </h2>
    <form action="reset_password_process.php" method="post">
        <input type="hidden" name="token" value="<?= $_GET['token']; ?>">

        <label for="nueva_contrasena"> Nueva contraseña: </label> <br>
        <input type="password" name="nueva_contrasena"> <br>

        <label for="confirmar_nueva_contrasena"> Confirma la contraseña: </label> <br>
        <input type="password" name="confirmar_nueva_contrasena"><br>

        <input type="submit" name="resetear" value="RESTABLECER">
    </form>
</body>
</html>