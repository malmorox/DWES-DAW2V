<?php 
    $nombre = urldecode($_GET['nombre']);
    $direccion = urldecode($_GET['direccion']);
    $platos = urldecode($_GET['platos']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Éxito </title>
</head>
<body>
    <h2> ¡Muy buenas, <?= $nombre ?>! </h2>
    <h4> Tu pedido de <?= $platos ?> platos se ha enviado correctamente a tu dirección (<?= $direccion ?>) </h4>
</body>
</html>