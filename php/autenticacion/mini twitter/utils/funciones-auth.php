<?php

    require_once 'init.php';

    /**
     * Define una constante para settear el tiempo de expiración de una cookie en una fecha pasada para que se elimine
     */
    define('TIEMPO_EXPIRACION_COOKIE_NEGATIVO', time() - 3600);

    /**
     * Función para iniciar sesión verificando las credenciales del usuario en la base de datos
     *
     * Con password_verify() comprobamos que una contraseña introducida coincida con su el hash de la contraseña almacenada en la base de datos
     * 
     * @param string $nombre El nombre de usuario que se introduce en el formulario
     * @param string $contrasena La contraseña del usuario que se introduce en el formulario
     * @return bool Retorna true si las credenciales son válidas, sino false
     */
    function iniciarSesion($tabla = 'usuarios', $nombre, $contrasena) {
        global $db;

        $select = "SELECT * FROM $tabla WHERE nombre = :nombre";
        $db->ejecuta($select, $nombre);
        $usuario = $db->obtenDatos();

        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            return true;
        }

        return false;
    }

    /**
     * Función para registrar un nuevo usuario en la base de datos
     *
     * @param string $query La consulta SQL personalizada para la inserción
     * @param mixed ...$parametros Los parámetros que se pasan a la consulta, incluyendo la contraseña que debe ser hasheada
     * @return bool Retorna true si el usuario fue registrado exitosamente, si no false
     */
    function registrarUsuario($query, ...$parametros) {
        global $db;

        $contrasena_index = 1;

        $contrasena_hasheada = password_hash($parametros[$contrasena_index], PASSWORD_DEFAULT);
        $db->ejecuta($query, $parametros);

        // Retorna true si hace el insert y false si no lo hace
        return $db->getExecuted();
    }
    
    /**
     * Función para destruir una cookie por su nombre
     *
     * @param string $nombre_cookie El nombre de la cookie que se va a destruir
     */
    function destruirCookie($nombre_cookie) {
        unset($_COOKIE[$nombre_cookie]);
        setcookie($nombre_cookie, '', TIEMPO_EXPIRACION_COOKIE_NEGATIVO, '/');
    }

    /**
     * Función para marcar un token como consumido en la base de datos
     *
     * @param string $token El token que se va a marcar como consumido
     */
    function consumirTokenBD($token) {
        global $db;

        $update = "UPDATE tokens SET consumido = 1 WHERE token = :token";
        $db->ejecuta($update, $token);
    }

    /**
     * Función para buscar el ID de un usuario asociado a un token que pasamos por parametro
     *
     * @param string $token El token a buscar
     * @return int|null Retorna el ID de usuario si se encuentra, si no null.
     */
    function buscarIdUsuarioPorToken($token) {
        global $db;

        $select = "SELECT * FROM tokens WHERE token = :token";
        $db->ejecuta($sql, $token);
        $token = $db->obtenDatos();
    
        return $token['id_usuario'];
    }

    /**
     * Función para restablecer la contraseña de un usuario utilizando un token
     *
     * @param string $token El token asociado a la solicitud de restablecimiento de contraseña.
     * @param string $nueva_contrasena La nueva contraseña del usuario.
     * @return bool Retorna true si la contraseña se restableció correctamente, si no false.
     */
    function resetearContrasena($token, $nueva_contrasena) {
        global $db;
        
        $id_usuario = buscarIdUsuarioPorToken($token);
        $nueva_contrasena_hasheada = password_hash($nueva_contrasena, PASSWORD_DEFAULT);
        
        $update = "UPDATE usuarios SET contrasena = :nueva_contrasena WHERE id = :id_usuario";
        $db->ejecuta($update, [$nueva_contrasena_hasheada, $id_usuario]);

        return $db->getExecuted();
    }

    /**
    * Redirige a una página con parámetros de cadena de consulta construidos dinámicamente si se los pasamos
    *
    * @param string $pagina La URL de la página a la que se redirige
    * @param array $parametros Un array asociativo de parámetros donde cada clave es el nombre del parámetro y el valor es su contenido
    */
    function redirigir($pagina, $parametros = []) {
        if (!empty($parametros)) {
            $cadena_query = http_build_query($parametros);
            $url = $pagina . '?' . $cadena_query;
        } else {
            $url = $pagina;
        }
        
        header("Location: $url");
        die();
    }

?>