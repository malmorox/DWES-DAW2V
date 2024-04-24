<?php

    require_once 'conexion.php';

    function insertarAccion($fecha, $lugar, $nombre, $descripcion, $foto) {
        $insert = "INSERT INTO acciones (fecha, lugar, nombre, descripcion, foto) VALUES (:fecha, :lugar, :nombre, :descripcion, :foto)";
        $consulta = $db->prepare($insert);
        $consulta->bindParam(':fecha', $fecha);
        $consulta->bindParam(':lugar', $lugar);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':foto', $foto);
        $consulta->execute();
    }

    function listadoAcciones($orden = null) {
        $select = "SELECT * FROM acciones";
        if ($orden === 'ascendente') {
            $select .= " ORDER BY fecha ASC";
        } elseif ($orden === 'descendente') {
            $select .= " ORDER BY fecha DESC";
        }
        $consulta = $db->prepare($select);
        $consulta->execute();
        $acciones = $consulta->fetchAll(PDO::FETCH_ASSOC);
    
        return $acciones;
    }

    function validarFoto($foto) {
        $errores = [];
        if ($foto['error'] !== UPLOAD_ERR_OK) {
            $errores['foto'] = 'Error al subir la foto';
        } elseif ($foto['type'] !== 'image/jpeg') {
            $errores['foto'] = 'El archivo debe ser una imagen JPG';
        }
        return $errores;
    }

?>