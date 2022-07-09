<?php
    
    class controladorVenta {

        private $DB;
        private static $_instance;

        private function __construct() {
            require ("db.php");

            $this->DB = dataBase::getInstance();
        }

        public static function getInstance(){
            if(!self::$_instance) { 
                self::$_instance = new self();
            }
            return self::$_instance;
        }
    
        public function cargarDatos () {
            $auxres = $this->DB->buscarProductos();
            if(sizeof($auxres) != 0) {
                return $auxres;
            }
            return "la pagina no tiene productos que mostrar";
        }

        public function guardarDatos($datos) {
            $auxres = "Agrege al menos un producto";

            if(sizeof($datos) > 0) {
                if($datos["base"] != "" || $datos["iva"] != "" || $datos["total"] != ""){
                    $auxres = $this->DB->generarPedido($datos["cant1"], $datos["cant2"], $datos["cant3"], $datos["cant4"], $datos["cant5"], $datos["cant6"], $datos["cant7"], $datos["base"], $datos["iva"], $datos["total"], rand(0,20));
                }
                print ("<script>location.href = '../index.php';alert('$auxres');</script>");
            }
        }
    }

    $controlador = controladorVenta::getInstance();

    if($_POST) {
        $controlador -> guardarDatos($_POST);
    }
?>