<?php
    require_once "funcionalidad.php";

    $errores = [];

    $flores = obtenerFlores();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : null;
        $fecha = isset($_POST["fecha"]) ? $_POST["fecha"] : null;
        $flor_id = isset($_POST["flor"]) ? $_POST["flor"] : null;
        $cantidad = isset($_POST["cantidad"]) ? $_POST["cantidad"] : null;

        if (empty($nombre)) {
            $errores["nombre"] = "Debe tener nombre";
        }

        if (empty($fecha)) {
            $errores["fecha"] = "Debe tener fecha";
        } else {
            if ($fecha < date("Y-m-d")) {
                $errores["fecha"] = "Debe ser posterior a hoy";
            }
        }

        if (empty($flor_id)) {
            $errores["flor"] = "Debes selecionar una flor";
        }

        if (empty($cantidad)) {
            $errores["cantidad"] = "Debe tener cantidad";
        } else {
            $flor_stock = obtenerFlorPorId($flor_id)["stock"];
            if ($flor_stock < $cantidad) {
                $errores["cantidad"] = "No hay stock";
            }
        }

        if (empty($errores)) {
            insertarPedido($flor_id, $fecha, $cantidad);
            actualizarStock($flor_id, $cantidad);

            header("Location: exito.php");
            die();
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir nuevo pedido</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    
    <form action="" method="post">
        <label for="nombre">Nombre:</label> <br>
        <input type="text" name="nombre"> <br>
        <?php if (isset($errores["nombre"])): ?>
            <span class="error"><?= $errores["nombre"] ?></span>
        <?php endif; ?> <br>

        <label for="fecha">Fecha:</label> <br>
        <input type="date" name="fecha"> <br>
        <?php if (isset($errores["fecha"])): ?>
            <span class="error"><?= $errores["fecha"] ?></span>
        <?php endif; ?> <br>

        <label for="flor">Flor:</label> <br>
        <select name="flor">
            <option selected disabled> Seleccione una flor </option>
            <?php foreach ($flores as $flor): ?>
                <option value="<?= $flor["id"] ?>" <?= isset($flor_id) && $flor_id == $flor["id"] ? 'selected' : '' ?>>
                    <?= $flor["nombre"] ?> (<?= $flor["stock"] ?>)
                </option>
            <?php endforeach; ?>
        </select> <br>
        <?php if (isset($errores["flor"])): ?>
            <span class="error"><?= $errores["flor"] ?></span>
        <?php endif; ?> <br>

        <label for="cantidad">Cantidad:</label> <br>
        <input type="number" name="cantidad" value="<?= isset($cantidad) ? $cantidad : '' ?>">
        <?php if (isset($errores["cantidad"])): ?>
            <span class="error"><?= $errores["cantidad"] ?></span>
        <?php endif; ?> <br>

        <input type="submit" value="Enviar">
    </form>

</body>
</html>