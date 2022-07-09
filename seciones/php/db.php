<?php

class dataBase {

    private $_connection;
    private $servername = "localhost";
    private $username = "";
    private $password = "";
    private $database = "tiendapeliculas";
    private $port = "3307";

    public function __construct($user,  $password) {
        $this->username = $user;
        $this->password = $password;

        $this->_connection = new mysqli($this->servername, $this->username, $this->password, $this->database, $this->port);
        if ($this->_connection->connect_errno) {
            echo ("Fallo al conectar a MySQL: "  .$this->_connection->connect_errno);
        }
    }

    public function getConnection() {
        return $this->_connection;
    }

    public function crearUsuario ($nombres, $apellidos, $cedula, $correo, $nacimiento, $telefono, $usuario, $contraseña) {
        $mysqli = $this->getConnection();

        $mensaje = ("Error al tratar de registrar el usuario.");

        $query0 = "SELECT * FROM `clientes` WHERE (`cedula`='".$cedula."') OR (`usuario`='".$usuario."');";
        $res = $mysqli->query($query0);

        if(mysqli_num_rows($res) == 1) {
            $mensaje = ("El usuario que desea registrar ya se encuetra en la DB");
            return $mensaje;
        }

        $query = "INSERT INTO `clientes` (`nombres`, `apellidos`, `cedula`, `membresia`, `telefono`, `nacimiento`, `correo`, `usuario`, `contrasena`) VALUES ('".$nombres."', '".$apellidos."', '".$cedula."', '1', '".$telefono."', '".$nacimiento."', '".$correo."', '".$usuario."', '".$contraseña."');";
        if (mysqli_query($mysqli, $query)) {
            $mensaje = ("Usuario registrado con exito.");
            return $mensaje;
        }

        return $mensaje;
    }

    public function buscarUsuario ($usuario, $contraseña) {
        $mysqli = $this->getConnection();

        $query = "SELECT * FROM `clientes` WHERE `usuario`='".$usuario."' AND `contrasena`='".$contraseña."';";
        $res = $mysqli->query($query);

        $arreglo = array();

        if($res) {
            while($row = $res->fetch_array(MYSQLI_ASSOC)){
                $arreglo[] = $row;
            }
        }
        
        return $arreglo;
    }

    function buscarUsuarios ($rango) {
        $mysqli = $this->getConnection();
        $query = "SELECT * FROM `clientes` WHERE membresia < ".$rango.";";
        $res = $mysqli->query($query);

        $arreglo = array();

        if($res) {
            while($row = $res->fetch_array(MYSQLI_ASSOC)){
                $arreglo[] = $row;
            }
        }
        
        return $arreglo;
    }

    public function buscarPeliculas ($membresia) {
        $mysqli = $this->getConnection();

        $query = "SELECT * FROM `peliculas` WHERE `minrango`<='".$membresia."';";
        $res = $mysqli->query($query);

        $arreglo = array();

        if($res) {
            while($row = $res->fetch_array(MYSQLI_ASSOC)){
                $arreglo[] = $row;
            }
        }
        
        return $arreglo;
    }

    public function eliminarUsuario ($id) {
        $mysqli = $this->getConnection();

        $query = "DELETE FROM `clientes` WHERE `id`='".$id."';";
        $res = $mysqli->query($query);

        if($res) {
            return "Usuario eliminado satisfactoriamente";
        }

        return "Error al tratar de eliminar al usuario";  
    }

    public function modificarUsuario ($id, $nombres, $apellidos, $cedula, $membresia, $usuario, $contrasena) {
        $mysqli = $this->getConnection();

        $query = "UPDATE `clientes` SET `nombres`='".$nombres."',`apellidos`='".$apellidos."',`cedula`='".$cedula."',`membresia`='".$membresia."',`usuario`='".$usuario."',`contrasena`='".$contrasena."' WHERE id=".$id.";";
        $res = $mysqli->query($query);

        if($res) {
            return "Usuario modificado satisfactoriamente";
        }

        return "Error al tratar de modificar el usuario";  
    }

    public function actualizarMembresia ($monto, $fechaCompra, $nombres, $apellidos, $medioPago, $confimacionPago, $cedula, $direccion, $menbresiaA, $idUser) {
        $mysqli = $this->getConnection();

        try {
            $mysqli->begin_transaction();

            $mysqli->query("UPDATE `clientes` SET `membresia`='".($menbresiaA+1)."' WHERE id=".$idUser.";");
            $mysqli->query("INSERT INTO `factura`(`monto`, `fechaCompra`, `nombre`, `apellido`, `medioPago`, `confimacionPago`, `cedula`, `direccion`) VALUES ('".$monto."', '".$fechaCompra."', '".$nombres."', '".$apellidos."', '".$medioPago."', '".$confimacionPago."', '".$cedula."', '".$direccion."');");
            $auxId = $mysqli->insert_id;
            $mysqli->query("INSERT INTO `suscripciones`(`idCliente`, `idFactura`, `fechaCompra`) VALUES ('".$idUser."','".$auxId."','".$fechaCompra."');");

            $mysqli->commit();
        } catch (Exception $e) {
            $mysqli->rollback();
            return false;
        }
        return true;
    }
}

function getObj ($rol) {
    if($rol >= 1 && $rol <= 3) {
        return new dataBase("userpeliculasbasico", "contrasenauserpeliculasbasico");
    }
    else if ($rol == 4) {
        return new dataBase("userpeliculasadmin", "contrasenauserpeliculasadmin");
    }
    else if ($rol == 5) {
        return new dataBase("tiendapeliculas", "contrasenatiendapeliculas");
    }
    else {
        return new dataBase("userpeliculasinicial", "contrasenauserpeliculasinicial");
    }
}