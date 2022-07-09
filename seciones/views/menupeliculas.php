<?php
    session_start();

    if (!isset($_SESSION['usuario'])) {
        print ("<script>location.href = './iniciosecion.html';alert('Usted no tiene permisos para ver esta pagina.');</script>");
        die();
    }

    require ("../php/peliculas.php");

    $auxres = $controlador->cargarPeliculas($_SESSION['usuario'][1]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/menupeliculas.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <title>MENU DE PELICULAS</title>
</head>
<body>
    <nav>
        <div class="izq">
            <h2>Peliculas en Cartelera</h2>
        </div>
        <div class="der">
        <?php
            if($_SESSION['usuario'][1] >= 4) {
                print ("<a href='adminusuarios.php'>Administrar usuarios</a>");
            }
            else if ($_SESSION['usuario'][1] >= 1 || $_SESSION['usuario'][1] < 3) {
                print ("<a href='mejorarSuscripcion.php'>Mejorar Suscripcion</a>");
            }
        ?>
        <a href="../php/cerrarsesion.php">Cerrar sesion</a>
        </div>
    </nav>
    
    <main>
        <?php
            if(sizeof($auxres) > 0) {
                for ($i = 0; $i < sizeof($auxres); $i++) { 
                    print("<div class='carta'>
                        <h2>".$auxres[$i]["nombre"]."</h2>
                        <img src='".$auxres[$i]["caratula"]."' alt='imagenCartelera'>
                        <p>".$auxres[$i]["descripcion"]."</p>
                    </div>");
                }
            }
        ?>
    </main>
</body>
</html>