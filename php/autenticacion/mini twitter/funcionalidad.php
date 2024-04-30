<?php

    require_once 'conexion.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    function registrarUsuario($usuario, $contrasena, $email) {
        $db = conexion();
        $contrasena_hasheada = password_hash($contrasena, PASSWORD_DEFAULT);
        $consulta = $db->prepare("INSERT INTO usuarios (usuario, contrasena) VALUES (:usuario, :contrasena)");
        $consulta->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $consulta->bindParam(':contrasena', $contrasena_hasheada, PDO::PARAM_STR);
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

    function publicarTweet($id_usuario, $mensaje) {
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

    function validarCorreo($email) {
        $db = conexion();
        $consulta = $db->prepare("SELECT * FROM usuarios WHERE email = :email");
        $consulta->bindParam(':email', $email, PDO::PARAM_STR);
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
        // Si existe el usuario asociado con ese correo retorna true, sino false
        if ($usuario) {
            return true;
        }
    
        return false;
    }

    function enviarCorreoRecuperacion($email) {
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'meteordatagestion@gmail.com';
            $mail->Password = 'Meteor.12345';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('meteordatagestion@gmail.com', 'Marcos Almorox');
            $mail->addAddress($email, 'Ejemplo');
            $mail->Subject = 'Recuperación de contraseña';
            $mail->Body = "Haz click en el siguiente enlace para recuperar tu contraseña: http://localhost/twitter/resetear_contra.php";

            $mail->send();
            return true;
        } catch (Exception) {
            return false;
        }
    }

    function resetearContrasena($token, $nueva_contrasena) {
        $db = conexion();
        $contrasena_hasheada = password_hash($nueva_contrasena, PASSWORD_DEFAULT);
        $consulta = $db->prepare("UPDATE usuarios SET contrasena = :contrasena WHERE token = :token");
        $consulta->bindParam(':contrasena', $contrasena_hasheada, PDO::PARAM_STR);
        $consulta->bindParam(':token', $token, PDO::PARAM_STR);
        $resultado = $consulta->execute();
    
        return $resultado;
    }

?>