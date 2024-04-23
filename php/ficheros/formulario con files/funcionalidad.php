<?php

    require_once 'conexion.php';

    function insertarAccion($fecha, $lugar, $nombre, $descripcion, $foto) {
        $db = conexion();
        $sql = "INSERT INTO acciones (fecha, lugar, nombre, descripcion, foto) VALUES (:fecha, :lugar, :nombre, :descripcion, :foto)";
        $consulta = $db->prepare($sql);
        $consulta->bindParam(':fecha', $fecha);
        $consulta->bindParam(':lugar', $lugar);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':foto', $foto);
        $consulta->execute();
    }

    function listadoAcciones($orden = null) {
        $db = conexion();
        $select = "SELECT * FROM acciones";
        if ($orden === 'ascendente') {
            $select .= " ORDER BY fecha ASC";
        } elseif ($orden === 'descendente') {
            $select .= " ORDER BY fecha DESC";
        }
        $consulta = $db->prepare($sql);
        $consulta->execute();
        $acciones = $consulta->fetchAll(PDO::FETCH_ASSOC);
    
        return $acciones;
    }

?>