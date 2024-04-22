<?php

    require_once 'funcionalidad.php';

    $errores = [];

    session_start();

    if (!isset($_SESSION['usuario'])) {
        header("Location: index.php");
        exit();
    }

    $usuario = obtenerInformacionDelUsuario($_SESSION['usuario']);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nuevo_nombre_usuario = isset($_POST['nuevo_nombre_usuario']) ? $_POST['nuevo_nombre_usuario'] : null;
    
        if (($nuevo_nombre_usuario !== $usuario['usuario']) || (strtolower($nuevo_nombre_usuario) !== strtolower($usuario['usuario']))) {
            $exito = editarNombreUsuario($nuevo_nombre_usuario, $usuario['id']);
            if ($exito) {
                $_SESSION['usuario'] = $nuevo_nombre_usuario;
            } else {
                $errores['nuevo_nombre'] = "Error al actualizar el nombre de usuario.";
            }
        } else {
            $errores['nuevo_nombre'] = "El nuevo nombre no debe ser igual al actual";
        }
    }

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Perfil de usuario </title>
    <style>
        .exito { color: #43CA57; }
        .error { color: red; }
        .aviso { color: #FFB900; }
    </style>
</head>
<body>
    <h1> ¡Bienvenido, <?= $usuario['usuario']; ?>! </h1>
    <p> Tu correo electrónico: <strong> <?= $usuario['email']; ?> </strong> </p>
    <h3> Editar perfil </h3>
    <?php if ($exito): ?>
        <span class="exito"> ¡El nombre de usuario se ha actualizado correctamente! </span> <br> <br>
    <?php endif; ?>
    <form action="perfil.php" method="post">
        <label for="nuevo_nombre_usuario"> Nuevo nombre de usuario: </label> <br>
        <input type="text" name="nuevo_nombre_usuario" value> <br>
        <?php if (empty($nuevo_nombre_usuario)): ?>
            <span class="aviso"> Si no introduces nada se mantendrá tu nombre actual </span> <br>
        <?php elseif (isset($errores['nuevo_nombre'])): ?>
            <span class="error"> <?= $errores['nuevo_nombre'] ?> </span> <br>
        <?php endif; ?> <br>

        <input type="submit" value="GUARDAR CAMBIOS">
    </form>
    <a href="logout.php"> Cerrar sesión </a>
</body>
</html>