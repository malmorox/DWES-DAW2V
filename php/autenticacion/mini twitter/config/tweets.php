<?php

    require_once 'conexion.php';

    function publicarTweet($tweet, $id_usuario) {
        $db = conexion();
        $consulta = $db->prepare("INSERT INTO tweets (id_usuario, mensaje, fecha_hora) VALUES (:id_usuario, :mensaje, NOW())");
        $consulta->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $consulta->bindParam(':mensaje', $mensaje, PDO::PARAM_STR);
        $resultado = $consulta->execute();

        return $resultado;
    }

    function mostrarTweets($id_usuario = null) {
        $db = conexion();
        if ($id_usuario !== null) {
            $consulta = $db->prepare("SELECT * FROM tweets WHERE id_usuario = :id_usuario ORDER BY fecha_hora DESC");
            $consulta->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        } else {
            $consulta = $db->prepare("SELECT * FROM tweets ORDER BY fecha_hora DESC");
        }
        $consulta->execute();
        $mensajes = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $mensajes;
    }

?>