<?php

    require_once 'funcionalidad.php';

    $errores = [];

    $acciones = listadoAcciones('descendente');

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar'])) {
        $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null;
        $lugar = isset($_POST['lugar']) ? $_POST['lugar'] : null;
        $nombre = isset($_POST['nombre'])   ? $_POST['nombre'] : "Anónimo";
        $descripcion = $_POST['descripcion'] ;
        $foto = $_FILES['foto'];

        $fecha_actual = date('Y-m-d');
        if (empty($fecha)) {
            $errores['fecha'] = 'El campo fecha es obligatorio';
        } elseif ($fecha < $fecha_actual) {
            $errores['fecha'] = 'La fecha debe ser hoy o en el futuro';
        }

        if (empty($lugar)) {
            $errores['lugar'] = 'El campo lugar es obligatorio';
        }

        if ($foto['error'] !== UPLOAD_ERR_OK) {
            $errores['foto'] = 'Error al subir la foto';
        } elseif ($foto['type'] !== 'image/jpeg') {
            $errores['foto'] = 'El archivo debe ser una imagen JPG';
        }

        if (empty($errores)) {
            $ruta = 'fotos/' . $foto['name'];
            move_uploaded_file($foto['tmp_name'], $ruta);
            echo 'Registro exitoso';
        }
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Día de la tierra </title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header class="header">
        <h1> Listado de acciones registradas </h1>
        <button id="boton-form"> Registrar acción </button>
    </header>
    <table>
        <tr>
            <th> Fecha </th>
            <th> Lugar </th>
            <th> Nombre </th>
            <th> Descripción </th>
            <th> Foto </th>
        </tr>
        <?php foreach($acciones as $accion):?>
            <tr>
                <td> <?= $accion['fecha'];?> </td>
                <td> <?= $accion['lugar'];?> </td>
                <td> <?= $accion['nombre'];?> </td>
                <td> <?= $accion['descripcion'];?> </td>
                <td> <img src="<?= $accion['foto'];?>"> </td>
            </tr>
        <?php endforeach;?>
    </table>

    <div class="popup" id="formularioPopup">
        <h2> Registro de acciones ambientales </h2>
        <form action="form.php" method="post" enctype="multipart/form-data">
            <label for="fecha"> Fecha: </label> <br>
            <input type="date" name="fecha"> <br>
            <?php if (isset($errores['fecha'])): ?>
                <span class="error"> <?= $errores['fecha'];?> </span> 
            <?php endif;?> <br>

            <label for="lugar"> Lugar: </label> <br>
            <input type="text" name="lugar"> <br>
            <?php if (isset($errores['lugar'])): ?>
                <span class="error"> <?= $errores['lugar'];?> </span>
            <?php endif;?> <br>
            
            <label for="nombre"> Nombre <span class="info"> (opcional) </span>: </label> <br>
            <input type="text" name="nombre"> <br> <br>
            
            <label for="descripcion"> Descripción <span class="info"> (opcional) </span>: </label> <br>
            <textarea name="descripcion" rows="4" cols="30"> </textarea> <br> <br>
            
            <label for="foto"> Foto: </label>
            <input type="file" name="foto" required> <br>
            <?php if (isset($errores['foto'])): ?>
                <span class="error"> <?= $errores['foto'];?> </span>
            <?php endif;?> <br>
            
            <input type="submit" name="registrar" value="REGISTRAR ACCIÓN">
        </form>
    </div>
    <script src="js/scripts.js"></script>
</body>
</html>