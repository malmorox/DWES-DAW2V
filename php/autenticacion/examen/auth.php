<?php
    require_once "funcionalidad.php";
    
    if(isset($_GET["token"]) && !empty($_GET["token"])){
        $token_proporcionado = obtenerDatosTokenProporcionado($_GET["token"]);
        
        if($token_proporcionado["consumido"] == 1){
        //if($token_proporcionado["consumido"]){
            $email_usuario_token_proporcionado = obtenerEmailUsuarioTokenProporcionado($token_proporcionado["id_user_consumido"]);

            $_SESSION["emailUsuario"] = $email_usuario_token_proporcionado;
            header("Location: privada.php");
            die();
        
        } else if($token_proporcionado["consumido"] == 0){
        //} else if(!$token_proporcionado["consumido"]){
            if(isset($_POST["submit"]) && !empty($_POST["email"])){
                registrarUsuario($_POST["email"]);
                $id_usuario_generador_tokens = obtenerIdUsuarioAtravesEmailProporcionado($_POST["email"]);
                consumirToken($token_proporcionado["id"], $id_usuario_generador_tokens);

                for($i = 0; $i < NUMERO_DE_TOKENS_A_CREAR_AL_CONSUMIR_UN_TOKEN; $i++){
                    $token = bin2hex(openssl_random_pseudo_bytes(NUMERO_DE_CARACTERES_TOKEN));
                    insertarTokens($token, $id_usuario_generador_tokens);
                }

                $_SESSION["emailUsuario"] = $_POST["email"];
                header("Location: privada.php");
                die();
            }
        }
    } else {
        header("Location: index.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Autentificación </title>
</head>
<body>
    <h1>Verifica token y registra al usuario</h1>
    <form action="" method="post">
        <input type="email" name="email" id="">
        <input type="hidden" name="token">
        <input type="submit" name="submit" value="Registrar">
    </form>
</body>
</html>