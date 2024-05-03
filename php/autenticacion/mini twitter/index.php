<?php

    require_once 'config/usuario.php';
    require_once 'config/tweets.php';
    require_once 'Tweet.php';

    session_start();

    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit();
    }

    $usuario = obtenerInformacionDelUsuario($_SESSION['usuario']);
    $todos_tweets = mostrarTweets();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["postear"])) {
        $tweet = isset($_POST["tweet"]) ? trim($_POST["tweet"]) : null;

        if (!empty($tweet)) {
            publicarTweet($tweet, $usuario['id']);
        
            header("Location: index.php");
            exit();
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Inicio </title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header> 
        <h1> Inicio </h1>
        <a href="perfil.php">
            <div>
                <div class="foto-usuario-header">
                    <img src="<?= $usuario['foto_perfil']; ?>" alt="Foto de perfil de <?= "@" . $usuario['usuario']; ?>">
                </div>
                <span id="nombre-usuario-header"> <?= "@" . $usuario['usuario']; ?></span>
            </div>
        </a>
    </header> 
    <form action="index.php" method="post">
        <label for="tweet"> Nuevo tweet: </label><br>
        <textarea name="tweet" maxlength="200" rows="4" cols="50"></textarea><br>

        <input type="submit" name="postear" value="POSTEAR">
    </form>
    
    <hr>
    <h2> Todos los tweets: </h2>
    <?php if (!empty($todos_tweets)): ?>
        <div>
            <?php foreach ($todos_tweets as $info_tweet): ?>
                <?php $tweet = new Tweet($info_tweet['nombre_usuario'], $info_tweet['foto_usuario'], $info_tweet['tweet'], $info_tweet['fecha_hora']); ?>
                <?= $tweet; ?>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p> No hay tweets todavía. </p>
    <?php endif; ?>
</body>
</html>