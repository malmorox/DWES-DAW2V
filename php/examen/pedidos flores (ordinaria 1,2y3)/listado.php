<?php
    require_once "funcionalidad.php";

    $pedidos = obtenerPedidos();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <!-- listado con paginación de siguiente de los pedidos: id, dirección, fecha, unidades -->
    
    <div id="contenedor">
    <h1>Listado de pedidos</h1>    
    <table>
        <tr>
            <th>Id</th>
            <th>Dirección</th>
            <th>Fecha</th>
            <th>Unidades</th>
        </tr>
        <?php foreach($pedidos as $pedido): ?>
            <tr>
                <td> <?= $pedido["id"] ?> </td>
                <td> <?= $pedido["direccion"] ?> </td>
                <td> <?= $pedido["fecha"] ?> </td>
                <td> <?= obtenerFlorPorId($pedido["flor_id"])["nombre"] ?> x<?=$pedido["unidades"]?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <!-- paginación -->
    <a href="listado.html">Siguiente</a>

    </div>
</body>
</html>