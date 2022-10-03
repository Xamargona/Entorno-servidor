<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Probando funciones</title>
</head>
<body>
    <?php
        include ("funcionesDavidSanchez.inc.php");
        echo suma(20,25).'<br>';
        echo resta(12,20).'<br>';
        echo multiplicacion(5,5).'<br>';
        echo division(20,0).'<br>';
        echo division(20,4).'<br>';
        echo comparaDosEnteros(0,15).'<br>';
        echo comparaDosEnteros(8,8).'<br>';
        echo esPar(8,8).'<br>';
        echo esPar(3,2).'<br>';

    ?>
</body>
</html>