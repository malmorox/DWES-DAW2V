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

?>