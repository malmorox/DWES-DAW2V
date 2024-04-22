<?php

    require_once 'conexion.php';

    function registrarUsuario($usuario, $contrasena, $email) {
        $db = conexion();
        $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
        $consulta = $db->prepare("INSERT INTO usuarios (usuario, contrasena) VALUES (:usuario, :contrasena)");
        $consulta->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $consulta->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
        $consulta->bindParam(':email', $email, PDO::PARAM_STR);
        $resultado = $consulta->execute();
        // Retorna true si hace el insert y false si no lo hace
        return $resultado;
    }

    function iniciarSesion($usuario, $contrasena) {
        $db = conexion();
        $consulta = $db->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
        $consulta->bindValue(':usuario', $usuario, PDO::PARAM_STR);
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
    
        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            return true;
        }
    
        return false;
    }

    function obtenerInformacionDelUsuario($usuario) {
        $db = conexion();
        $consulta = $db->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
        $consulta->bindValue(':usuario', $usuario, PDO::PARAM_STR);
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
    
        return $usuario;
    }
    

    function editarNombreUsuario($nuevo_nombreusuario, $id_usuario) {
        $db = conexion();
        $consulta = $db->prepare("UPDATE usuarios SET usuario = :nuevo_nombreusuario WHERE id = :id_usuario");
        $consulta->bindParam(':nuevo_nombreusuario', $nuevo_nombreusuario, PDO::PARAM_STR);
        $consulta->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $resultado = $consulta->execute();
        // Retorna true si hace el update y false si no lo hace
        return $resultado;
    }


?>