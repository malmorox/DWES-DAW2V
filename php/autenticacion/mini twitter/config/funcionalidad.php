<?php

    require_once 'conexion.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php';

    define("NUMERO_CARACTERES_TOKEN", 16);

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
            $mail->SMTPAuth = false;
            $mail->Username = 'malmoroxcabrera@educa.madrid.org';
            $mail->Password = 'Almoroxii1133';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $token = bin2hex(openssl_random_pseudo_bytes(NUMERO_CARACTERES_TOKEN));

            if (insertarTokenBD($token, $email)) {
                $mail->setFrom('malmoroxcabrera@educa.madrid.org', 'Mini Twitter');
                $mail->addAddress($email, 'Marcos Almorox');
                $mail->Subject = 'Recuperación de contraseña';
                $mail->Body = "Haz click en el siguiente enlace para recuperar tu contraseña: http://localhost/twitter/resetear_contra.php?token=$token";

                $mail->send();
                return true;
            } else {
                return false;
            }
        } catch (Exception) {
            return false;
        }
    }

    function insertarTokenBD($token, $email) {
        $db = conexion();
        $consultaIdUsuario = $db->prepare("SELECT id_usuario FROM usuarios WHERE email = :email");
        $consultaIdUsuario->bindParam(':email', $email, PDO::PARAM_STR);
        $consultaIdUsuario->execute();
        $id_usuario = $consultaIdUsuario->fetchColumn();

        $consultaToken = $db->prepare("INSERT INTO tokens (token, id_usuario) VALUES (:token, :id_usuario)");
        $consultaToken->bindParam(':token', $token, PDO::PARAM_STR);
        $consultaToken->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $resultado = $consultaToken->execute();
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

    function resetearContrasena($token, $nueva_contrasena) {
        $db = conexion();
        $consultaIdUsuario = $db->prepare("SELECT id_usuario FROM tokens WHERE token = :token");
        $consultaIdUsuario->bindParam(':token', $token, PDO::PARAM_STR);
        $consultaIdUsuario->execute();
        $id_usuario = $consultaIdUsuario->fetchColumn();

        $nueva_contrasena_hasheada = password_hash($nueva_contrasena, PASSWORD_DEFAULT);

        $consultaNuevaContrasena = $db->prepare("UPDATE usuarios SET contrasena = :nueva_contrasena WHERE token = :token");
        $consultaNuevaContrasena->bindParam(':nueva_contrasena', $nueva_contrasena_hasheada, PDO::PARAM_STR);
        $consultaNuevaContrasena->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $resultado = $consultaNuevaContrasena->execute();

        // Eliminamos el token después de actualizar la contraseña
        if ($resultado) {
            $consultaEliminarToken = $db->prepare("DELETE FROM tokens WHERE token = :token");
            $consultaEliminarToken->bindParam(':token', $token, PDO::PARAM_STR);
            $consultaEliminarToken->execute();
        }
    
        return $resultado;
    }

?>