<?php

    $nombre = isset($_GET['nombre']) ? urldecode($_GET['nombre']) : header('Location: form.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> Bienvenido, <?= $nombre ?> </h1>
</body>
</html>