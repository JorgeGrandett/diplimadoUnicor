<?php
    $nombre = $_POST["nombre"];
    $nacimiento = $_POST["nacimiento"];
    $sexo = $_POST["sexo"];

    function calEdad ($fecha) {
        $nace = new DateTime($fecha);
        $hoy = new DateTime("now");
        $axu = $hoy->diff($nace);
        return $axu->format('%y');
    }
    $edad = calEdad($nacimiento);
    echo($edad."<br>");
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accion</title>
    </head>
    <body>
        <?php
            echo ($nombre."<br>". $nacimiento."<br>". $sexo."<br>");

            if($edad < 18 && (strcmp ($sexo , "Femenino" ) == 0)) {
                print("La persona es de sexo femenino y menor de edad");
            }

            if($edad >= 18 && (strcmp ($sexo , "Masculino" ) == 0)) {
                print("La persona es de sexo masculino y mayor de edad");
            }
        ?>
        <button><a href="index.html">Atras</a></button>
    </body>
    </html>