<?php

$nombre_importado = isset($_GET['nombre']) ? urldecode($_GET['nombre']) : '';
$suscripcion_importada = isset($_GET['suscripcion']) ? urldecode($_GET['suscripcion']) : '';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Pedido exitoso </title>
</head>
<body>
    <h5> Pedido exitoso </h5>
    <p> Gracias por hacer posible esto <?php echo $nombre_importado ?> </p>
</body>
</html>
