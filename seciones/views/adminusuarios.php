<?php
    session_start();

    if (!isset($_SESSION['usuario']) || ($_SESSION['usuario'][1] < 4)) {
        print ("<script>location.href = './menupeliculas.php';alert('Usted no tiene permisos para ver esta pagina.');</script>");
        die();
    }

    require ("../php/usuarios.php");

    $auxres = $controlador->cargarUsuarios($_SESSION['usuario'][1]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/adminusuarios.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <title>ADMINISTRACION DE USUARIOS</title>
</head>
<body>
    <nav>
        <div class="izq">
            <h2>Adminstracion de Cuentas de Usuario</h2>
        </div>
        <div class="der">
            <a href="./menupeliculas.php">Menu de Peliculas</a>
            <a href="../php/cerrarsesion.php">Cerrar sesion</a>
        </div>
    </nav>
    <div class="titulos">
        <h2>Nombres</h2>
        <h2>Apellidos</h2>
        <h2>Cedula</h2>
        <h2>&nbsp;&nbsp;Nivel de Acceso</h2>
        <h2>Usuario</h2>
        <h2>Contraseña</h2>
        <h2>Opciones</h2>
    </div>
    <?php
        for ($i = 0; $i < sizeof($auxres); $i++) { 
            print ("<form action='../php/usuarios.php' method='POST'>
                    <div class='ids'>
                        <input type='text' name='id' id='' value='".$auxres[$i]['id']."' required hidden>
                    </div>
                    <div>
                        <input type='text' name='nombres' id='' value='".$auxres[$i]['nombres']."' required>
                    </div>
                    <div>
                        <input type='text' name='apellidos' id='' value='".$auxres[$i]['apellidos']."' required>
                    </div>
                    <div>
                        <input type='number' name='cedula' id='' value='".$auxres[$i]['cedula']."' maxlength='10' oninput='maxiLength(this)' required>
                    </div>
                    <div>
                        <input type='text' name='membresia' id='' value='".$auxres[$i]['membresia']."' maxlength='1' oninput='maxiLength(this)' required>
                    </div>
                    <div>
                        <input type='text' name='usuario' id='' value='".$auxres[$i]['usuario']."' required>
                    </div>
                    <div>
                        <input type='text' name='contrasena' id='' value='".$auxres[$i]['contrasena']."' required>
                    </div>
                    <div class='botones'>
                        <input type='submit' name='eliminar' value='Eliminar Usuario'>
                        <input type='submit' name='modificar' value='Guardar Modificaciones'>
                    </div>
                </form>");
        }     
    ?>
    <script src="../js/logic.js"></script>
</body>
</html>