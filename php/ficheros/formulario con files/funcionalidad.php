<?php

    require 'conexion.php';

    define("ACCIONES_POR_PAGINA", 3);

    $conteo = $db->query("SELECT COUNT(*) FROM acciones");
    $totalAcciones = $conteo->fetch();

    $numeroPaginas = ceil($totalAcciones[0] / ACCIONES_POR_PAGINA);
    $primerElementoPagina = (isset($_GET['pagina']) && is_numeric($_GET['pagina'])) ? $_GET['pagina'] - 1 * ACCIONES_POR_PAGINA : 1;

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
        global $db;
        global $primerElementoPagina;
        $select = "SELECT * FROM acciones";
        if ($orden === 'ascendente') {
            $select .= " ORDER BY fecha ASC";
        } elseif ($orden === 'descendente') {
            $select .= " ORDER BY fecha DESC";
        }
        $select .= " LIMIT :offset, :limite";
        //$select .= " LIMIT :limit OFFSET :offset";
        $consulta = $db->prepare($select);
        $consulta->bindValue(':limite', ACCIONES_POR_PAGINA, PDO::PARAM_INT);
        $consulta->bindValue(':offset', $primerElementoPagina, PDO::PARAM_INT);
        $consulta->execute();
        $acciones = $consulta->fetchAll(PDO::FETCH_ASSOC);
    
        return $acciones;
    }

?>