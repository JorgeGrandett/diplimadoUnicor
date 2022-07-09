<?php

$servername = "localhost";
$username = "userVentas";
$password = "userVentas";
$database = "ventas";
$port = "3307";

class dataBase {

    function conectar ($servername, $username, $password, $database, $port) {
        $mysqli = new mysqli($servername, $username, $password, $database, $port);
        if ($mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            return;
        }
        return $mysqli;
    }
}

class crudClientes {

    function createClientes ($nombre, $cedula, $direccion, $telefono, $contrasena, $conection) {
        $mensaje = "";

        $sql = "SELECT * FROM `clientes` WHERE `cedula`=".$cedula."";
        $result = mysqli_query($conection, $sql);

        if(mysqli_num_rows ($result) == 1) {
            $mensaje = "El usuario que desea registrar ya se encuetra en la DB";
            return $mensaje;
        }

        $query = "INSERT INTO `clientes` (`nombre`, `cedula`, `direccion`, `telefono`, `password`) VALUES ('".$nombre."', '".$cedula."', '".$direccion."', '".$telefono."', '".$contrasena."');";
        if (mysqli_query($conection, $query)) {
            $mensaje = ("Cliente $nombre registrado(a) con exito");
        }
        else {
            $mensaje = ("Error al tratar de registrar el cliente");
        }
        
        mysqli_close($conection);
        return $mensaje;
    }

    function updateClientes ($conection) {
        
    }

    function deleteClientes ($conection) {
        
    }

    function viewClientes ($SQL = "*", $conection) {
        $query = "SELECT ".$SQL." FROM `clientes`;";
        $res = mysqli_query($conection, $query);
        mysqli_close($conection);
        return $res;
    }
}
?>

