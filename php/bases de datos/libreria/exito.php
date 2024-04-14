<?php
    if (!isset($_GET["libro"]) || !isset($_GET["cliente"]) || !isset($_GET["fecha"])) {
        header("Location: index.php");
    } else {
        $libro_prestamo = isset($_GET["libro"]) ? urldecode($_GET["libro"]) : "ERROR";
        $cliente_prestamo = isset($_GET["cliente"]) ? urldecode($_GET["cliente"]) : "ERROR";
        $fecha_prestamo = isset($_GET["fecha"]) ? date('d/m/Y', strtotime(urldecode($_GET["fecha"]))) : "ERROR";
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Éxito </title>
</head>
<body>
    <h2> ¡Prestamo exitoso! </h2>
    <p> El libro '<?= $libro_prestamo ?>' ha sido prestado a <?= $cliente_prestamo ?> el <?= $fecha_prestamo ?> </p>
</body>
</html>