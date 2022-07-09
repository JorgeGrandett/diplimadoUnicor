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
    <title>Document</title>
</head>
<body>
    <div>
        <h2>Mejorar Suscripcion</h2>
    </div>
    <form action="../php/usuarios.php" method="post">
        <div><input type="text" name="nombre" id="" required placeholder="Nombres"></div>
        <div><input type="text" name="apellido" id="" required placeholder="Apellidos"></div>
        <div><input type="number" name="cedula" id="" required placeholder="Numero de cedula"></div>
        <div><input type="text" name="direccion" id="" required placeholder="Direccion de residencia"></div>
        <div><label for="monto">Monto a pagar:</label><input type="number" name="monto" id="monto" readonly required value="100000"></div>
        <div>
            <label for="divMetodos">Metodo de pago</label>
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
        <div>
            <input type="checkbox" name="" id="">
            <p>¿Acepta los <a href="#">Terminos y Condiciones?</a></p>
        </div>
        <div class="botondiv">
            <input type="submit" name="mejorar" value="Mejorar">
         </div>
    </form>
    <div><p><a href="./menupeliculas.php">Regresar</a> al menu de peliculas.</p></div>
</body>
</html>