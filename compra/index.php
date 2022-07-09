<?php
    require("./php/controller.php");
    $auxres = $controlador->cargarDatos();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <title>MEKATOS J&J</title>
</head>
<body>
    <div>
        <h2>Compra de Mekatos</h2>
    </div>

    <form action="./php/controller.php" method="post" id="formulario">
        <div>
            <h2>Detalles de la compra</h2>
        </div>
        <?php
            print ("<table id='tabla1'> <tr> <th>Referencia</th> <th>Descripcion</th> <th>Precio</th> <th>Cantidad</th> <th>Importe</th> <th></th> </tr>");
            
            for ($i = 0; $i < sizeof($auxres); $i++) {
                print ("<tr>
                <td> <input type='text' id='refe".$auxres[$i]["ref"]."' value='".$auxres[$i]["ref"]."' readonly> </td>
                <td> <input type='text' id='desc".$auxres[$i]["ref"]."' value='".$auxres[$i]["descripcion"]."' readonly> </td>
                <td> <input type='text' id='prec".$auxres[$i]["ref"]."' value='".$auxres[$i]["precio"]."' readonly> </td>
                <td> <input type='text' id='cant".$auxres[$i]["ref"]."' value='0' name='cant".$auxres[$i]["ref"]."' readonly> </td>
                <td> <input type='text' id='impo".$auxres[$i]["ref"]."' value='0' readonly> </td>
                <td> 
                    <input type='button' onclick='sumar(".$auxres[$i]["ref"].")' value='+'>
                    <input type='button' onclick='restar(".$auxres[$i]["ref"].")' value='-'>
                </td>
                </tr>");
            }
            print ("</table>");
        ?>
        <table id="tabla2">
            <tr> <td>Base</td> <td><input type="text" id="base" name="base" readonly></td> </tr>
            <tr> <td>IVA</td> <td><input type="text" id="iva" name="iva" readonly></td> </tr>
            <tr> <td>Total</td> <td><input type="text" id="total" name="total" readonly></td></tr>
        </table>
        <div class="subir">
            <input type="submit" value="Comprar">
        </div>
    </form>
    <script src="./js/logic.js"></script>
</body>
</html>