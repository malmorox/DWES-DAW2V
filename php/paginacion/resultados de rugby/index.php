<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Perfil de usuario </title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <h1> ¡Bienvenido, @<?= $usuario['usuario']; ?>! </h1>
    <p> Tu correo electrónico: <strong> <?= $usuario['email']; ?> </strong> </p>
    <h3> Editar perfil </h3>
    <?php if ($cambio_exitoso): ?>
        <span class="exito"> ¡El nombre de usuario se ha actualizado correctamente! </span> <br> <br>
    <?php endif; ?>
    <form action="perfil.php" method="post">
        <label for="nuevo_nombre_usuario"> Nuevo nombre de usuario: </label> <br>
        <input type="text" name="nuevo_nombre_usuario" value> <br>
        <?php if (isset($_POST['guardar']) == "POST" && empty($nuevo_nombre_usuario)): ?>
            <span class="aviso"> Si no introduces nada se mantendrá tu nombre actual </span> <br>
        <?php elseif (isset($errores['nuevo_nombre'])): ?>
            <span class="error"> <?= $errores['nuevo_nombre'] ?> </span> <br>
        <?php endif; ?> <br>

        <input type="submit" name="guardar" value="GUARDAR CAMBIOS">
    </form>
    <a href="logout.php"> Cerrar sesión </a>
    <script src="js/script.js"></script>
</body>
</html>