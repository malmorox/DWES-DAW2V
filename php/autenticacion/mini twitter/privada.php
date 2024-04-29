<?php

    require_once 'funcionalidad.php';

    $todos_tweets = mostrarTweets();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["tweet"])) {
        $tweet = $_POST["tweet"];
        
        publicarTweet($tweet);
        
        header("Location: {$_SERVER['REQUEST_URI']}");
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
    </header> 
    <form action="privada.php" method="post">
        <label for="tweet">Nuevo Tweet:</label><br>
        <textarea name="tweet" id="tweet" rows="4" cols="50"></textarea><br>
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
        <p>No hay tweets anteriores.</p>
    <?php endif; ?>
</body>
</html>