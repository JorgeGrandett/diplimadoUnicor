<?php  
    class controladorPeliculas {

        private $DB;
        private static $_instance;

        private function __construct() {
            require ("db.php");
            $this->changeDBUser();
        }

        private function changeDBUser () {
            if(!isset($_SESSION)) { 
                session_start();
            }

            if(isset($_SESSION['usuario'][1])) {
                $this->DB = getObj($_SESSION['usuario'][1]);
            }
            else {
                $this->DB = getObj(0);
            }
        }

        public static function getInstance(){
            if(!self::$_instance) { 
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function cargarPeliculas ($membresia) {
            $this->changeDBUser();
            $auxres = $this->DB->buscarPeliculas($membresia);
            if(sizeof($auxres) != 0) {
                return $auxres;
            }
            return "la pagina no tiene peliculas que mostrar";
        }
    }

    $controlador = controladorPeliculas::getInstance(); 
?>