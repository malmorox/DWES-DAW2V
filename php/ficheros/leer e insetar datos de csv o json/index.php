<?php

    require_once 'funcionalidad.php';

    $errores = [];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $mote = isset($_POST['mote']) ? trim($_POST['mote']) : null;
        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
        $departamento = isset($_POST['departamento']) ? trim($_POST['departamento']) : null;
        $almacenar = isset($_POST['almacenar']) ? $_POST['almacenar'] : null;

        if(empty($mote)){
            $errores['mote'] = 'Debe introducir un mote';
        }

        if(empty($nombre)){
            $errores['nombre'] = 'Debe introducir un nombre';
        }

        if(empty($departamento)){
            $errores['departamento'] = 'Debe introducir un departamento';
        }

        if(empty($almacenar)){
            $errores['almacenar'] = 'Es obligatorio seleccionar un metodo de almacenamiento';
        }

        if(empty($errores)){
            $empleado = [
                'mote' => $mote,
                'nombre' => $nombre,
                'departamento' => $departamento
            ];

            if($almacenar == 'csv' || $almacenar == 'ambos'){
                guardarEnCSV($empleado);
            }

            if($almacenar == 'json' || $almacenar == 'ambos'){
                guardarEnJSON($empleado);
            }
        }
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Datos de los empleados </title>
</head>
<body>
    <h2> Registro de empleados: </h2>
    <form action="index.php" method="post">
        <label for="mote"> Mote: </label> <br>
        <input type="text" name="mote"> <br>

        <label for="nombre"> Nombre: </label> <br>
        <input type="text" name="nombre"> <br>
        
        <label for="departamento"> Departamento: </label> <br>
        <input type="text" name="departamento"> <br>

        <label for="almacenar"> Metodo de almacenamiento: </label>
        <select name="almacenar">
            <option disabled selected> Selecciona uno </option>
            <option value="csv"> CSV </option>
            <option value="json"> JSON </option>
            <option value="ambos"> Ambos </option>
        </select><br><br>
        
        <button type="submit" name="registrar"> Guardar </button>
    </form>

    <h3> Listado de empleados desde CSV: </h3>
    <table border>
        <tr>
            <th> Mote </th>
            <th> Nombre </th>
            <th> Departamento </th>
        </tr>
        <?php mostrarDesdeCSV(); ?>
    </table>

    <h3> Listado de empleados desde JSON: </h3>
    <table border>
        <tr>
            <th> Mote </th>
            <th> Nombre </th>
            <th> Departamento </th>
        </tr>
        <?php mostrarDesdeJSON(); ?>
    </table>
</html>