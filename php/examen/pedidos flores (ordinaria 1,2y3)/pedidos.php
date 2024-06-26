<?php
    require_once "funcionalidad.php";

    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php");
        exit();
    }

    $resultados_por_pagina  = 6;
    $total_pedidos = contarPedidos();
    $total_paginas = ceil($total_pedidos / $resultados_por_pagina );

    $pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $offset = ($pagina_actual - 1) * $resultados_por_pagina ;


    $pedidos = obtenerPedidos($resultados_por_pagina , $offset);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de pedidos</title>
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
    <div class="paginacion">
        <?php if($pagina_actual > 1): ?>
            <a href="?pagina=<?= $pagina_actual - 1 ?>">Anterior</a>
        <?php endif; ?>

        <?php for($i = 1; $i <= $total_paginas; $i++): ?>
            <a href="?pagina=<?= $i ?>"><?= $i ?></a>
        <?php endfor; ?>

        <?php if($pagina_actual < $total_paginas): ?>
            <a href="?pagina=<?= $pagina_actual + 1 ?>">Siguiente</a>
        <?php endif; ?>
        </div>
    </div>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>