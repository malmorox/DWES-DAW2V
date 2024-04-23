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

        if (empty($fecha)) {
            $errores['fecha'] = 'El campo fecha es obligatorio';
        }

        if (empty($lugar)) {
            $errores['lugar'] = 'El campo lugar es obligatorio';
        }

        if (empty($foto['name'])) {
            $errores['foto'] = 'El campo foto es obligatorio';
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
</head>
<body>
    
    <h2> Listado de acciones registradas </h2>
    <button onclick="mostrarFormulario()">Registrar Acción</button>
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
            <label for="fecha"> Fecha: </label>
            <input type="date" name="fecha"> <br>
            
            <label for="lugar"> Lugar: </label>
            <input type="text" name="lugar"> <br>
            
            <label for="nombre"> Nombre: </label> <br>
            <input type="text" name="nombre"><br>
            
            <label for="descripcion"> Descripción (opcional): </label> <br>
            <textarea name="descripcion" rows="4" cols="50"> </textarea> <br>
            
            <label for="foto"> Foto: </label>
            <input type="file" name="foto" required><br>
            
            <input type="submit" name="registrar" value="REGISTRAR ACCIÓN">
        </form>
    </div>
</body>
</html>