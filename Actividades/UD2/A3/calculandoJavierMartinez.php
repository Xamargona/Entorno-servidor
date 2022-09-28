<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 3</title>
</head>
<body>
    
    <section>
        <h1>Calculando</h1>
        <?php
            $num1 = rand(1,50);
            $num2 = rand(1,50);
            echo '<h2>Suma</h2>';
            echo $num1.' + '.$num2.' = '.$num1+$num2;
            echo '<h2>Resta</h2>';
            echo $num1.' - '.$num2.' = '.$num1-$num2;
            echo '<h2>Multiplicación</h2>';
            echo $num1.' x '.$num2.' = '.$num1*$num2;
            echo '<h2>División</h2>';
            echo $num1.' / '.$num2.' = '.$num1/$num2;
            echo '<h2>Módulo</h2>';
            echo $num1.' % '.$num2.' = '.$num1%$num2;
            echo '<h2>Mayor, menor o igual</h2>';
            if ($num1 > $num2) {
                echo $num1.' es mayor que '.$num2;
            } elseif ($num1 < $num2) {
                echo $num2.' es mayor que '.$num1;
            } else {
                echo $num1.' y '.$num2.' son iguales';
            }
            echo '<h2>Par o impar</h2>';
            if ($num1%2 == 0) {
                echo $num1.' es par y ';
            } else {
                echo $num1.' es impar y ';
            }
            if ($num2%2 == 0) {
                echo $num2.' es par';
            } else {
                echo $num2.' es impar';
            }
        ?>
    </section>

</body>
</html>