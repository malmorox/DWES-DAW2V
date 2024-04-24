<?php

$db = DBConnect::getInstance();
$conn = $db->getConnection();

$errorList = [];
$generos = [];
$autentificacion = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar'])) {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $suscripcion = $_POST['suscripcion'];
    $generos = $_POST[''];

    if (empty($nombre)  ){
        $autentificacion = false;
        if (empty($nombre)) {
            $errorList['nombre'] = "*El campo de nombre no debe estar vacio";
        }
        if (empty($direccion)) {
            $errorList['direccion'] = "*El campo de direccion no deber estar vacio";
        }
        if ($generos.count()<1) {
            $errorList['generos'] = "*Debe haber al menos un genero";
        }
    } else {
        $autentificacion = true;
    }

    if ($autentificacion === true) {
        $query = "INSERT INTO clientes(nombre, direccion, suscripcion) VALUES (:nombre, :direccion, :suscripcion)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':suscripcion', $suscripcion);
        $stmt->execute();
        $db->closeConnection();
        header("Location: exito.php?nombre=" . urlencode($nombre) . "&suscripcion=" . urlencode($suscripcion));
        exit();
    }
}

?>
