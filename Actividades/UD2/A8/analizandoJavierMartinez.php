<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 8</title>
</head>
<body>
    <?php
        
        $cadena = "Un programador es la persona considerada experta en ser capaz de sacar, despues de innumerables tecleos, una serie infinita de respuestas incomprensibles calculadas con precision micrometrica a partir de vagas asunciones basadas en discutibles cifras tomadas de documentos inconcluyentes y llevados a cabo con instrumentos de escasa precision, por personas de fiabilidad dudosa y cuestionable mentalidad con el proposito declarado de molestar y confundir al desesperado e indefenso departamento que tuvo la mala fortuna de pedir la informacion en primer lugar.";

        echo '<h2>Texto invertido</h2>';
        echo strrev($cadena);

        echo '<h2>Posición de la palabra "cifras"</h2>';
        echo strrpos($cadena, 'cifras');

        echo '<h2>Texto invertido</h2>';
        echo explode('cabo', $cadena)[1];

        echo '<h2>Apariciones de la palabra "de"</h2>';
        echo substr_count($cadena, 'de');

    ?>
</body>
</html>