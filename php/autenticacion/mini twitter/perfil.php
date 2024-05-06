<?php

    require_once 'config/usuario.php';
    require_once 'config/tweets.php';
    require_once 'Tweet.php';

    $errores = [];

    session_start();

    if (!isset($_SESSION['usuario'])) {
        header("Location: index.php");
        exit();
    }

    $usuario = obtenerInformacionDelUsuario($_SESSION['usuario']);
    $tweets_usuario = mostrarTweets($usuario['id']);
    $cambio_exitoso = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nuevo_nombre_usuario = isset($_POST['nuevo_nombre_usuario']) ? trim($_POST['nuevo_nombre_usuario']) : null;
        $nueva_biografia_usuario = isset($_POST['nueva_biografia_usuario']) ? trim($_POST['nueva_biografia_usuario']) : null;
        
        if (!empty($nuevo_nombre_usuario)) {
            if (($nuevo_nombre_usuario !== $usuario['usuario']) && (strtolower($nuevo_nombre_usuario) !== strtolower($usuario['usuario']))) {
                $cambio_exitoso = editarInfoUsuario($nuevo_nombre_usuario, 'nombre', $usuario['id']);
                if ($cambio_exitoso) {
                    $_SESSION['usuario'] = $nuevo_nombre_usuario;
                } else {
                    $errores['nuevo_nombre'] = "Error al actualizar el nombre de usuario.";
                }
            } else {
                $errores['nuevo_nombre'] = "El nuevo nombre no debe ser igual al actual";
            }
        }

        if (isset($_FILES['nueva_foto_perfil']) && $_FILES['nueva_foto_perfil']['error'] === UPLOAD_ERR_OK) {
            $cambio_exitoso = editarInfoUsuario($ruta_nueva_foto_perfil, 'foto_perfil', $usuario['id']);
            if ($cambio_exitoso) {
                $usuario['foto_perfil'] = $ruta_nueva_foto_perfil;
            } else {
                $errores['nueva_foto_perfil'] = "Error al actualizar la foto de perfil.";
            }
        }
    }

?> 
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
    <form action="perfil.php" method="post" enctype="multipart/form-data">
        <input type="file" name="nueva_foto_perfil"> <br>

        <label for="nuevo_nombre_usuario"> Nuevo nombre de usuario: </label> <br>
        <input type="text" name="nuevo_nombre_usuario" value="<?= $usuario['usuario'] ?>"> <br>
        <?php if (isset($_POST['guardar']) == "POST" && empty($nuevo_nombre_usuario)): ?>
            <span class="aviso"> Si no introduces nada se mantendrá tu nombre actual </span> <br>
        <?php elseif (isset($errores['nuevo_nombre'])): ?>
            <span class="error"> <?= $errores['nuevo_nombre'] ?> </span> <br>
        <?php endif; ?> <br>

        <label for="nueva_biografia_usuario"> Nueva biografía: </label> <br>
        <textarea name="nueva_biografia_usuario"> <?= $usuario['biografia'] ?> </textarea> <br>

        <input type="submit" name="guardar" value="GUARDAR CAMBIOS">
    </form>

    <hr>
    <h2> Tus tweets: </h2>
    <?php if (!empty($tweets_usuario)): ?>
        <div>
            <?php foreach ($tweets_usuario as $info_tweet): ?>
                <?php $tweet = new Tweet($info_tweet['nombre_usuario'], $info_tweet['foto_usuario'], $info_tweet['tweet'], $info_tweet['fecha_hora']); ?>
                <?= $tweet; ?>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p> No has publicado ningún tweet todavía. </p>
    <?php endif; ?>

    <a href="logout.php"> Cerrar sesión </a>
    <script src="js/script.js"></script>
</body>
</html>