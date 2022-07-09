<?php
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];

    function redireccion ($user, $pass) {
        if((strcmp ($user , "diplomado" ) == 0) && (strcmp ($pass , "unicor" ) == 0)) {
            header("Location: http://localhost/Diplomado/FormularioBasico/formulariologin/resultado.php");
        }
        else {
            header("Location: http://localhost/Diplomado/FormularioBasico/formulariologin/index.html");
        }
    }
    
    redireccion($usuario, $contraseña);
?>