<?php

    require_once 'conexion.php';

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

    function editarNombreUsuario($nuevo_nombreusuario, $usuario) {
        $db = conexion();
        $consulta = $db->prepare("UPDATE usuarios SET telefono = :nuevoTelefono WHERE id = :idCliente");
        $consulta->bindParam(':nuevoTelefono', $nuevo_nombreusuario, PDO::PARAM_STR);
        $consulta->bindParam(':idCliente', $usuario, PDO::PARAM_INT);
        $resultado = $consulta->execute();
        // Retorna true si hace el update y false si no lo hace
        return $resultado;
    }


?>