<?php
    define ("DB_DATA", "mysql:host=localhost;dbname=practicando");
    define ("USERNAME", "malmorox");
    define ("PASSWORD" , "1234");
    
    function conectarDB() {
        try {
            $conexion = new PDO(DB_DATA, USERNAME, PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            return null;
        }
    }

    function iniciarSesion($usuario, $contrasena) {
        $conexion = conectarDB();
        if ($conexion) {
            $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
            $consulta->bindValue(':usuario', $usuario, PDO::PARAM_STR);
            $consulta->execute();
            $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
        
            if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
                return true;
            }
        }
        return false;
    }

    function buscarUsuarioPorEmail($email) {
        $conexion = conectarDB();
        if ($conexion) {
            try {
                $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE email = :email");
                $consulta->bindValue(':email', $email, PDO::PARAM_STR);
                $consulta->execute();
                return $consulta->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return null;
            }
        }
    }

    function insertarTokenUsuario($email, $token) {
        $conexion = conectarDB();
        if ($conexion) {
            try {
                $consulta = $conexion->prepare("INSERT INTO tokens (email_usuario, token, fecha_expiracion) VALUES (:email, :token, DATE_ADD(NOW(), INTERVAL 1 DAY))");
                $consulta->bindValue(':email', $email, PDO::PARAM_STR);
                $consulta->bindValue(':token', $token, PDO::PARAM_STR);
                $consulta->execute();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    function restablecerContrasena($token, $nuevaContrasena) {
        $conexion = conectarDB();
        if ($conexion) {
            $select = $conexion->prepare("SELECT email_usuario FROM tokens WHERE token = :token");
            $select->bindValue(':token', $token, PDO::PARAM_STR);
            $select->execute();
            $email_usuario = $select->fetchColumn();
    
            if ($usuario) {
                $update = $conexion->prepare("UPDATE usuarios SET contrasena = :contrasena WHERE email = :email");
                $update->bindValue(':contrasena', password_hash($nuevaContrasena, PASSWORD_DEFAULT), PDO::PARAM_STR);
                $update->bindValue(':email', $email_usuario, PDO::PARAM_STR);
                $update->execute();
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
?>