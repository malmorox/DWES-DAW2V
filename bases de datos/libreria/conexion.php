<?php
    include 'procesar.php';

    define ("DB_DATA", "mysql:host=localhost;dbname=examen");
    define ("USERNAME", "examen");
    define ("PASSWORD" , "examen");
    
    function conexion() {
        try {
            $db = new PDO(DB_DATA, USERNAME, PASSWORD);
            return $db;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function listadoLibros() {
        $db = conexion();
        $consulta = $db->prepare("select * from libros");
        $consulta->execute();
        $libros = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $libros;
    }

    function idLibroPorNombre($nombrelibro) {
        $db = conexion();
        $consulta = $db->prepare("select id from libros where nombre = :nombrecliente");
        $consulta->bindParam(':nombrecliente', $nombrecliente);
        $consulta->execute();
        $idcliente = $consulta->fetch(PDO::FETCH_ASSOC);

        return $idcliente;
    }

    function listadoClientes() {
        $db = conexion();
        $consulta = $db->prepare("select * from clientes");
        $consulta->execute();
        $clientes = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $clientes;
    }

    function idClientePorNombre($nombrecliente) {
        $db = conexion();
        $consulta = $db->prepare("select id from clientes where nombre = :nombrecliente");
        $consulta->bindParam(':nombrecliente', $nombrecliente);
        $consulta->execute();
        $idcliente = $consulta->fetch(PDO::FETCH_ASSOC);

        return $idcliente;
    }

    function actualizarTelefonoCliente($nuevotelefono, $nombrecliente) {
        $db = conexion();
        $idcliente = idClientePorNombre($nombrecliente);
        $consulta = $db->prepare("UPDATE clientes SET telefono = :nuevoTelefono WHERE id = :idCliente");
        $consulta->bindParam(':nuevoTelefono', $nuevoTelefono, PDO::PARAM_STR);
        $consulta->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $resultado;
    }

    function insertarPrestamo($nombrelibro, $nombrecliente, $fechaprestamo) {
        $db = conexion();
        $idcliente = idClientePorNombre($nombrecliente);
        $idlibro = idLibroPorNombre($nombrelibro);
        $consulta = $db->prepare("insert into prestamos (id_libro, id_cliente, fecha_prestamo) values (:idlibro, :idcliente, :fechaprestamo)");
        $consulta->bindParam(':idlibro', $idlibro);
        $consulta->bindParam(':idcliente', $idcliente);
        $consulta->bindParam(':fechaprestamo', $fechaprestamo);   
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $resultado;
    }
?>