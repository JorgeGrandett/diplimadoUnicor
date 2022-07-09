<?php
    session_start();

    if (!isset($_SESSION['usuario']) || (($_SESSION['usuario'][1] < 1) || ($_SESSION['usuario'][1] >= 3)) ) {
        print ("<script>location.href = './iniciosecion.html';alert('Usted no tiene permisos para ver esta pagina.');</script>");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/mejorarSuscripcion.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <title>MEJORAR SUSCRIPCION</title>
</head>
<body>
    <div>
        <h2>Mejorar Suscripcion</h2>
    </div>
    <form action="../php/usuarios.php" method="post">
        <div><input type="text" name="nombre" id="" required placeholder="Nombres"></div>
        <div><input type="text" name="apellido" id="" required placeholder="Apellidos"></div>
        <div><input type="number" name="cedula" id="" required placeholder="Numero de cedula" maxlength="10" oninput="maxiLength(this)"></div>
        <div><input type="text" name="direccion" id="" required placeholder="Direccion de residencia"></div>
        <div><label for="monto">Monto a pagar:</label><input type="number" name="monto" id="monto" readonly required value="100000"></div>
        <div class="divMetodos">
            <label for="divMetodos">Metodo de pago</label>
            <div class="divdivMetodos">
                <div id="divMetodos">
                    <img src="../assets/img/visaLogo.png" alt="visalogo">
                    <input type="radio" name="medioPago" id="" value="Visa">
                </div>
                <div>
                    <img src="../assets/img/mastercardLogo.png" alt="mastercardlogo">
                    <input type="radio" name="medioPago" id="" value="MasterCard">
                </div>
                <div>
                    <img src="../assets/img/pseLogo.jpg" alt="pselogo">
                    <input type="radio" name="medioPago" id="" value="PSE">
                </div>
                <div>
                    <img src="../assets/img/paypalLogo.png" alt="paypallogo">
                    <input type="radio" name="medioPago" id="" value="PayPal">
                </div>
            </div>
        </div>
        <div class="contCheck">
            <input type="checkbox" name="" id="">
            <p>¿Acepta los <a href="#">Terminos y Condiciones?</a></p>
        </div>
        <div class="botondiv">
            <input type="submit" name="mejorar" value="Mejorar">
         </div>
    </form>
    <div class="redi"><p><a href="./menupeliculas.php">Regresar</a> al menu de peliculas.</p></div>
    <script src="../js/logic.js"></script>
</body>
</html>