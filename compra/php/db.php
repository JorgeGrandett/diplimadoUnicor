<?php
class dataBase {

    private $_connection;
    private static $_instance;
    private $servername = "localhost";
    private $username = "userVentas";
    private $password = "userVentas";
    private $database = "ventas";
    private $port = "3307";

    private function __construct() {
        $this->_connection = new mysqli($this->servername, $this->username, $this->password, $this->database, $this->port);
        if ($this->_connection->connect_errno) {
            echo ("Fallo al conectar a MySQL: "  .$this->_connection->connect_errno);
        }
    }

    public static function getInstance(){
        if(!self::$_instance) { 
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getConnection() {
        return $this->_connection;
    }

    function buscarProductos ($sql = "*") {
        $mysqli = $this->getConnection();
        $query = "SELECT ".$sql." FROM `productos`";
        $res = $mysqli->query($query);

        $arreglo = array();

        if($res) {
            while($row = $res->fetch_array(MYSQLI_ASSOC)){
                $arreglo[] = $row;
            }
        }
        
        return $arreglo;
    }

    public function generarPedido ($cant1, $cant2, $cant3, $cant4, $cant5, $cant6, $cant7, $base, $iva, $total, $cliente) {
        $mysqli = $this->getConnection();

        $query = "INSERT INTO `pedidos`(`producto1`, `producto2`, `producto3`, `producto4`, `producto5`, `producto6`, `producto7`, `base`, `iva`, `total`, `cliente`) VALUES ('".$cant1."', '".$cant2."', '".$cant3."', '".$cant4."', '".$cant5."', '".$cant6."', '".$cant7."', '".$base."', '".$iva."', '".$total."', '".$cliente."');";
        if (mysqli_query($mysqli, $query)) {
            $mensaje = ("Pedido registrado con exito");
        }
        else {
            $mensaje = ("Error al tratar de registrar el pedido");
        }

        return $mensaje;
    }
   
}

?>