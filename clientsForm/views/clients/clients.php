<?php
    require ("../../model.php");
    $DB = new dataBase;
    $conection = $DB->conectar($servername, $username, $password, $database, $port);

    $clientes = new crudClientes;
    
    $auxres = $clientes->viewClientes("*", $conection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
    <title>VISTA CLIENTES</title>
</head>
<body>
    <div>
        <h2>Listado de Clientes</h2>
    </div>
    <?php
        $cantRes = mysqli_num_rows ($auxres);
        print ("<table>
        <tr>
            <th>Nombre</th>
            <th>Cedula</th>
            <th>Direccion</th>
            <th>Telefono</th>
            <th>Contraseña</th>
        </tr>");

        for ($i = 0; $i < $cantRes; $i++) {
            $fila = mysqli_fetch_array ($auxres);
            print ("<tr> <td>$fila[1]</td> <td>$fila[2]</td> <td>$fila[3]</td> <td>$fila[4]</td> <td>$fila[5]</td> </tr>");
        }
        print ("</table>");
    ?>
    <a href="../../index.html">Registrar cliente</a>
</body>
</html>