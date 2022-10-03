<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<link rel="stylesheet" href="css/stylesheet.css">

</head>
<body>
<h1>a</h1>
    
    <?php

        /* Eliminar caché */

        include_once("cache.php");
        noCachePHP();

        /* Importar y mezclar array de cartas */

        include("cartas.inc.php");

        shuffle($cartas);

        $numJugadores = 2;

        /*
            jugadores --> j1[nombre, mano[]], j2[nombre, mano[]]
        */

        $nombreJugadores = ["Juan", "Pepe"];

        for ($i=0; $i < $numJugadores; $i++) { 
            for ($j=0; $j < 10; $j++) { 
                $mano[] = array_pop($cartas);
            }
            $jugadores[] = ["nombre" => $nombreJugadores[$i], "mano" => $mano];
            unset($mano);
        }
        /*
        for ($i=0; $i < 10; $i++) { 
                $manoJ1[] = array_pop($cartas);
                $manoJ2[] = array_pop($cartas);
        }
        */

        echo '<section>';

        foreach ($jugadores as $jugador) {
            echo '<article class="jugador"><h2>Jugador: '.$jugador["nombre"].'</h2>';
            echo '<div class="mano">';
            foreach ($jugador["mano"] as $carta) {
                echo '<img src="baraja/'.$carta["imagen"].'" alt="'. $carta["valor"] .' de '. $carta["palo"].'">';
            }
            echo '</div></article>';
        }

        echo '</section>';

    ?>
</body>
</html>