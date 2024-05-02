<?php

    require_once 'conexion.php';

    function obtenerInformacionDelUsuario($usuario) {
        $db = conexion();
        $consulta = $db->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
        $consulta->bindValue(':usuario', $usuario, PDO::PARAM_STR);
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        return $usuario;
    }

    function editarInfoUsuario($nuevo_valor, $tipo_info, $id_usuario) {
        $db = conexion();
        $consulta = null;
        $resultado = false;

        switch ($tipo_info) {
            case 'nombre':
                $consulta = $db->prepare("UPDATE usuarios SET usuario = :nuevo_valor WHERE id = :id_usuario");
                break;
            case 'biografia':
                $consulta = $db->prepare("UPDATE usuarios SET biografia = :nuevo_valor WHERE id = :id_usuario");
                break;
            case 'foto_perfil':
                $consulta = $db->prepare("UPDATE usuarios SET foto_perfil = :nuevo_valor WHERE id = :id_usuario");
                break;
            default:
                return $resultado;
        }

        if ($consulta) {
            $consulta->bindParam(':nuevo_valor', $nuevo_valor, PDO::PARAM_STR);
            $consulta->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $resultado = $consulta->execute();
        }

        return $resultado;
    }

?>