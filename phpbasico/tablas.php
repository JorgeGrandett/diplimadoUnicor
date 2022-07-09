<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        function tablas () {
            for ($i = 1; $i < 10; $i++){
                echo ("<div><h3>Tabla del $i</h3>");
                for ($j = 1; $j <= 10; $j++) {
                    echo ("<h4>$i * $j =". $i*$j ."</h4>");
                }
                echo ("</div>");
            }
        } 
        tablas(); 
    ?>
</body>
</html>
<style>
    body {
        display: flex;
        justify-content: space-around;
    }
</style>