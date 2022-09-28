<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 2</title>
</head>
<body>
    <?php

        # Creación de la lista con secciones
        echo '<ul>';
        for ($i=1; $i < 6; $i++) { 
            echo '<li><a href="#sec'.$i.'">sección '.$i.'</a></li>';
        }
        echo '</ul>';

        # Creación de secciones

        echo '<section>';

        # Sección 1 - Negativo / Positivo

        echo '<article id="sec1">';

        $num = mt_rand(-500,500);
        echo '<h1><strong>Negativo - Cero - Positivo</strong></h1>';
        if ($num < 0) {
            echo 'El número '.$num.' es negativo';
        } elseif ($num == 0) {
            echo 'El número es'.$num;
        } elseif ($num > 0) {
            echo 'El número '.$num.' es positivo';
        }
    
        echo '</article>';

        # Sección 2 - Nota

        echo '<article id="sec2">';

        $num = mt_rand(-1,10);
        echo '<h1><strong>Nota</strong></h1>';
        switch ($num) {
            case 0:
                echo 'La nota media es de: '.$num.', insuficiente';
                break;
            case 1:
                echo 'La nota media es de: '.$num.', insuficiente';
                break;
            case 2:
                echo 'La nota media es de: '.$num.', insuficiente';
                break;
            case 3:
                echo 'La nota media es de: '.$num.', necesita mejorar';
                break;
            case 4:
                echo 'La nota media es de: '.$num.', necesita mejorar';
                break;
            case 5:
                echo 'La nota media es de: '.$num.', aprobado justo';
                break; 
            case 6:
                echo 'La nota media es de: '.$num.', aprobado';
                break; 
            case 7:
                echo 'La nota media es de: '.$num.', notable bajo';
                break;   
            case 8:
                echo 'La nota media es de: '.$num.', notable';
                break;
            case 9:
                echo 'La nota media es de: '.$num.', sobresaliente';
                break;
            case 10:
                echo 'La nota media es de: '.$num.', sobresaliente';
                break;           
            default:
            echo 'Valor no válido';
            break;
        }

        echo '</article>';

        # Sección 3 - Tabla de multiplicar

        echo '<article id="sec3">';

        $num = mt_rand(-20,20);
        echo '<style>table, th, td {border:1px solid black;}</style>';
        echo '<h1><strong>Tabla de multiplicar del '.$num.'</strong></h1>';
        echo '<table>';
        for ($i=0; $i < 20; $i++) { 
            echo '<tr>';
            echo '<td>'.$i.'</td>';
            echo '<td>'.$i*$num.'</td>';
            echo '</tr>';
        }
        echo '</table>';

        echo '</article>';

        # Sección 4 - Tabla

        echo '<article id="sec4">';

        $num1 = mt_rand(1,10);
        $num2 = mt_rand(1,10);
        echo '<style>table, th, td {border:1px solid black;}</style>';
        echo '<h1><strong>Tabla de '.$num1.' filas y '.$num2.' columnas</strong></h1>';
        echo '<table>';
        for ($i=0; $i < $num1; $i++) { 
            echo '<tr>';
            for ($j=0; $j < $num2; $j++) { 
                echo '<td>'.$i.'x'.$j.'</td>';
            }
            echo '</tr>';
        }
        echo '</table>';

        echo '</article>';

        # Sección 5 - Tabla

        echo '<article id="sec5">';

        $valorTotal = mt_rand(0,5000);
        echo '<h1><strong>Cálculo del cambio</strong></h1>';
        echo '<p>Total a devolver: '.$valorTotal.'</p>';

        $cociente = intval($valorTotal/500);
        $valorTotal = $valorTotal - (500*$cociente);
        echo '<p>'.$cociente.' billetes de 500</p>';

        $cociente = intval($valorTotal/200);
        $valorTotal = $valorTotal - (200*$cociente);
        echo '<p>'.$cociente.' billetes de 200</p>';

        $cociente = intval($valorTotal/100);
        $valorTotal = $valorTotal - (100*$cociente);
        echo '<p>'.$cociente.' billetes de 100</p>';

        $cociente = intval($valorTotal/50);
        $valorTotal = $valorTotal - (50*$cociente);
        echo '<p>'.$cociente.' billetes de 50</p>';

        $cociente = intval($valorTotal/20);
        $valorTotal = $valorTotal - (20*$cociente);
        echo '<p>'.$cociente.' billetes de 20</p>';

        $cociente = intval($valorTotal/10);
        $valorTotal = $valorTotal - (10*$cociente);
        echo '<p>'.$cociente.' billetes de 10</p>';

        $cociente = intval($valorTotal/5);
        $valorTotal = $valorTotal - (5*$cociente);
        echo '<p>'.$cociente.' billetes de 5</p>';

        $cociente = intval($valorTotal/2);
        $valorTotal = $valorTotal - (2*$cociente);
        echo '<p>'.$cociente.' monedas de 2</p>';

        $cociente = intval($valorTotal/1);
        $valorTotal = $valorTotal - (1*$cociente);
        echo '<p>'.$cociente.' monedas de 1</p>';

        echo '</article>';

        echo '</section>';
    ?>
</body>
</html>