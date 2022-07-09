<?php
    class controladorUsuarios {

        private $DB;
        private static $_instance;

        private function __construct() {
            require ("db.php");
            $this->changeDBUser();
        }

        private function changeDBUser ($bol = false) {
            if(!isset($_SESSION)) { 
                session_start();
            }

            if ($bol == false) {
                if(isset($_SESSION['usuario'][1])) {
                    $this->DB = getObj($_SESSION['usuario'][1]);
                }
                else {
                    $this->DB = getObj(0);
                }
            }
            else {
                $this->DB = getObj(5);
            }
        }

        public static function getInstance(){
            if(!self::$_instance) { 
                self::$_instance = new self();
            }
            return self::$_instance;
        }
    
        public function crearUsuario ($datos) {
            $auxres = "Fallo al crear el usuario";
            if (sizeof($datos) > 0)  {
                $this->changeDBUser(false);
                $auxres = $this->DB->crearUsuario($datos["nombres"], $datos["apellidos"], $datos["cedula"], $datos["correo"], $datos["nacimiento"], $datos["telefono"], $datos["usuario"], $datos["contraseña"]);
                print ("<script>location.href = '../index.html';alert('$auxres');</script>");
            }
        }

        public function iniciarSecion ($datos) {
            if (sizeof($datos) > 0)  {
                $this->changeDBUser(false);

                $auxres = $this->DB->buscarUsuario($datos["usuario"], $datos["contraseña"]);
                
                session_destroy();
                session_start(); 
                if(sizeof($auxres[0]) != 0) {
                    
                    $_SESSION['usuario'][0] = $auxres[0]['nombres'];
                    $_SESSION['usuario'][1] = $auxres[0]['membresia'];
                    $_SESSION['usuario'][2] = $auxres[0]['id'];
                    print ("<script>location.href = '../views/menupeliculas.php';</script>");
                }
                else {
                    session_destroy();
                    print ("<script>location.href = '../views/iniciosecion.html';alert('Datos incorrectos');</script>");
                }
            }
        }

        public function cargarUsuarios ($rango) {
            $this->changeDBUser(false);
            $auxres = $this->DB->buscarUsuarios($rango);
            return $auxres;
        }

        public function modificarUsuario ($datos) {
            if($datos["membresia"] >= 5) {
                return  print ("<script>location.href = '../views/adminusuarios.php';alert('Accion no permitida');</script>");
            }
            $this->changeDBUser(false);
            $auxres = $this->DB->modificarUsuario($datos["id"], $datos["nombres"], $datos["apellidos"], $datos["cedula"], $datos["membresia"], $datos["usuario"], $datos["contrasena"]);
            print ("<script>location.href = '../views/adminusuarios.php';alert('".$auxres."');</script>");
        }

        public function eliminarUsuario ($datos) {
            $this->changeDBUser(false);
            $auxres = $this->DB->eliminarUsuario($datos["id"]);
            print ("<script>location.href = '../views/adminusuarios.php';alert('".$auxres."');</script>");
        }

        public function mejorarUsuario ($datos) {
            $this->changeDBUser(true);
            date_default_timezone_set('UTC');
            $auxres = $this->DB->actualizarMembresia($datos["monto"], date('Y-m-d'), $datos["nombre"], $datos["apellido"], $datos["medioPago"], "Pagado", $datos["cedula"], $datos["direccion"], $_SESSION['usuario'][1], $_SESSION['usuario'][2]);
            if($auxres == true) {
                print ("<script>location.href = './cerrarsesion.php';alert('Membresia actualizada con exito');</script>");
            }
            else {
                print ("<script>location.href = '../views/mejorarSuscripcion.php';alert('Error al tratar de actualizar su membresia');</script>");
            }
            
        }

    }

    $controlador = controladorUsuarios::getInstance();

    if($_POST) {
        if (isset($_POST['registrar'])) {
            $controlador -> crearUsuario($_POST);
        }
        else if (isset($_POST['iniciar'])) {
            $controlador -> iniciarSecion($_POST);
        }
        else if (isset($_POST['eliminar'])) {
            $controlador -> eliminarUsuario($_POST);
        }
        else if (isset($_POST['modificar'])) {
            $controlador -> modificarUsuario($_POST);
        }
        else if (isset($_POST['mejorar'])) {
            $controlador -> mejorarUsuario($_POST);
        }
        
    }
?>