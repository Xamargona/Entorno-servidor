<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 10 - Blackjack</title>
    <link rel="stylesheet" href="css/stylesheet.css">
</head>
<body>

    <h1 class="titulo">Blackjack</h1>
    
    <?php

        include("cabecera.inc.php");    

        /* Eliminar caché */

        include_once("cache.php");
        noCachePHP();

        /* Importar y mezclar array de cartas */

        include("cartas.inc.php");

        shuffle($cartas);

        /* Cantidad de cartas, jugadores y nombres de lo jugadores */

        $nombresJugadores = ["Banca", "Juan", "Pepe", "Loli", "Jonathan", "Luisma"];

        $cartasARepartir = 2;

        /* 
            1º Se reparten dos cartas y se calcula el valor del AS (usamos un auxiliar para dar valor a J Q K)
            2ª Si el valor total de los puntos es menor que 14 robamos una carta y repetimos el proceso
            3º Guardamos las cartas y el total de puntos
        */

        for ($i=0; $i < count($nombresJugadores); $i++) { 

            for ($j=0; $j < $cartasARepartir; $j++) { 
                $mano[] = array_pop($cartas);
            }

            $puntos = 0;
            while ($puntos < 14) {
                $puntos = 0; 
                for ($k=0; $k < count($mano); $k++) { 
                    $aux = $mano[$k]["valor"];
                    if ($aux == 1 && ($puntos + 11)<22) {
                        $aux = 11;
                    } elseif ($aux == "J" || $aux == "Q" || $aux == "K") {
                        $aux = 10;
                    }
                    $puntos = $puntos + $aux;
                }
                if ($puntos < 14) {
                    $mano[] = array_pop($cartas);
                }
            }

            $jugadores[] = ["nombre" => $nombresJugadores[$i], "mano" => $mano, "puntos" => $puntos];
            unset($mano);
        }

        /* Creación de contenido HTML y mostrar las manos de los jugadores */


        /* Creo 1 espacio especial para la banca y a continuación para los jugadores */

        /* Banca */
        echo '<section><article class="banca"><h2>Jugador 0: '.$jugadores[0]["nombre"].'</h2>';
        echo '<div class="mano">';
        foreach ($jugadores[0]["mano"] as $carta) {
            echo '<img src="baraja/'.$carta["imagen"].'" alt="'. $carta["valor"] .' de '. $carta["palo"].'">';
        }
        echo '</div><p>Puntos: '.$jugadores[0]["puntos"].'</p></article>';

        $puntosBanca = $jugadores[0]["puntos"];
        $aux = 1;

        /* Jugadores */

        echo '<article class="jugadores">';
        
        foreach ($jugadores as $jugador) {
        
            /* Nos saltamos la posición de la banca */
            if ($jugador["nombre"] == "Banca" && $jugador["puntos"] == $puntosBanca) {
                continue;
            }
            /* Mostramos las cartas y comparamos la puntuación con la banca para determinar el resultado */
            echo '<div class="jugadorBJ"><h2>Jugador '.$aux.': '.$jugador["nombre"].'</h2>';
            foreach ($jugador["mano"] as $carta) {
                echo '<img src="baraja/'.$carta["imagen"].'" alt="'. $carta["valor"] .' de '. $carta["palo"].'">';
            }

            echo '<p>Puntos: '.$jugador["puntos"];
            if ($jugador["puntos"] == 21 || ($jugador["puntos"] < 21 && $jugador["puntos"] > $puntosBanca) || ($jugador["puntos"] < $puntosBanca && $puntosBanca > 21)) {
                echo ' - ¡GANA!</p>';
            } elseif ($jugador["puntos"] == $puntosBanca && $jugador["puntos"] < 21) {
                echo ' - ¡EMPATE!</p>';
            } else {
                echo ' - ¡PIERDE!</p>';
            }
            echo '</div>';

            $aux++;
        }
        echo '</article></section>';
        
    ?>

</body>
</html>