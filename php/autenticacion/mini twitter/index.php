<?php

    require_once 'config/funcionalidad.php';
    session_start();

    $usuario = obtenerInformacionDelUsuario($_SESSION['usuario']);
    $todos_tweets = mostrarTweets();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["tweet"])) {
        $tweet = $_POST["tweet"];
        
        publicarTweet($tweet);
        
        header("Location: index.php");
        exit();
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
                <span id=""> <?= "@" . $usuario['usuario']; ?></span>
                <div class="">
                    <img src="<?= $usuario['foto_perfil']; ?>" alt="">
                </div>
            </div>
        </a>
    </header> 
    <form action="index.php" method="post">
        <label for="tweet">Nuevo Tweet:</label><br>
        <textarea name="tweet" maxlength="200" rows="4" cols="50"></textarea><br>
        <input type="submit" name="postear" value="POSTEAR">
    </form>
    
    <hr>
    <h2>Tweets anteriores:</h2>
    <?php if (!empty($todos_tweets)): ?>
        <ul>
            <?php foreach ($todos_tweets as $tweet): ?>
                <li><?php echo $tweet; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p> No hay tweets todavía. </p>
    <?php endif; ?>
</body>
</html>