<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 5</title>
</head>
<body>
    <?php
        $numeros = [546,2,1,13,8,1069,69,70,15,14];
        echo '<p>Desordenado</p>';
        foreach ($numeros as $num) {
            echo '<p>'.$num.'</p>';
        }
        
        for ($i=0; $i < count($numeros); $i++) { 
            $posicionMenor = $i;
            for ($j=$i; $j < count($numeros); $j++) { 
                if ($numeros[$j] < $numeros[$posicionMenor]) {
                    $posicionMenor = $j;
                }
            }
            $aux = $numeros[$posicionMenor];
            $numeros[$posicionMenor] = $numeros[$i];
            $numeros[$i] = $aux; 
        }

        echo '<p>Ordenado</p>';
        foreach ($numeros as $num) {
            echo '<p>'.$num.'</p>';
        }
    ?>
</body>
</html>