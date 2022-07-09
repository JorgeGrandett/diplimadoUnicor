<?php
    require ("model.php");

    $DB = new dataBase;
    $conection = $DB->conectar($servername, $username, $password, $database, $port);

    $clientes = new crudClientes;

    $nombre = $_POST["nombre"];
    $cedula = $_POST["cedula"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $contrasena = $_POST["password"];

    function createCliente ($nombre, $cedula, $direccion, $telefono, $contrasena, $clientes, $conection) {
        $auxres = $clientes->createClientes($nombre, $cedula, $direccion, $telefono, $contrasena, $conection);
        print ("<script>location.href = './index.html';alert('$auxres');</script>");
    }

    createCliente ($nombre, $cedula, $direccion, $telefono, $contrasena, $clientes, $conection);
?>