<?php

    require_once 'conexion.php';

    define("NUMERO_CARACTERES_TOKEN", 16);

    function insertarTokenBD($token, $email) {
        $db = conexion();
        $consultaIdUsuario = $db->prepare("SELECT id FROM usuarios WHERE email = :email");
        $consultaIdUsuario->bindParam(':email', $email, PDO::PARAM_STR);
        $consultaIdUsuario->execute();
        $id_usuario = $consultaIdUsuario->fetchColumn();

        $consultaToken = $db->prepare("INSERT INTO tokens (token, id_usuario) VALUES (:token, :id_usuario)");
        $consultaToken->bindParam(':token', $token, PDO::PARAM_STR);
        $consultaToken->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $resultado = $consultaToken->execute();

        if ($resultado) {
            return true;
        } else {
            return false;
        }
    }

    function validarTokenReseteo($token) {
        $db = conexion();
        $consulta = $db->prepare("SELECT * FROM tokens WHERE token = :token");
        $consulta->bindParam(':token', $token, PDO::PARAM_STR);
        $consulta->execute();
        $token = $consulta->fetch(PDO::FETCH_ASSOC);
        // Si existe token retornará true, sino false
        if ($token) {
            return true;
        }

        return false;
    }

?>