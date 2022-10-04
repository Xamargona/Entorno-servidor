<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Actividad 10: 21 - Javier Martínez</title>
<link rel="stylesheet" href="css/stylesheet.css">
</head>
<body>
<h1>Juego 21</h1>
    
    <?php

        /* Eliminar caché */

        include_once("cache.php");
        noCachePHP();

        /* Importar y mezclar array de cartas */

        include("cartas.inc.php");

        shuffle($cartas);

        /* Cantidad de cartas, jugadores y nombres de lo jugadores */

        $nombresJugadores = ["Banca", "Juan", "Pepe", "Loli", "Jonathan", "Luisma"];

        $cartasARepartir = 2;

        for ($i=0; $i < count($nombresJugadores); $i++) { 
            for ($j=0; $j < $cartasARepartir; $j++) { 
                $mano[] = array_pop($cartas);
            }
            $jugadores[] = ["nombre" => $nombresJugadores[$i], "mano" => $mano];
            unset($mano);
        }

        /* Creación de contenido HTML y mostrar las manos de los jugadores */

        echo '<section>';

        $aux = 1;

        /* Creo 1 espacio especial para la banca, el resto albergan hasta 3 jugadores como máximo */

        foreach ($jugadores as $jugador) {
            echo '<article class="jugador"><h2>Jugador '.$aux.': '.$jugador["nombre"].'</h2>';
            echo '<div class="mano">';
            foreach ($jugador["mano"] as $carta) {
                echo '<img src="baraja/'.$carta["imagen"].'" alt="'. $carta["valor"] .' de '. $carta["palo"].'">';
            }
            echo '</div></article>';
            $aux++;
        }

        $aux = 0;

        echo '</section>';

        /* Puntuaciones */

        /* Cálculo de puntuaciones */

        $puntuacionJ1 = 0;
        $puntuacionJ2 = 0;

        for ($i=0; $i < $cartasARepartir; $i++) { 

            $puntosCartaJ1 = $jugadores[0]["mano"][$i]["valor"];
            $puntosCartaJ2 = $jugadores[1]["mano"][$i]["valor"];

            if ($puntosCartaJ1 == "J") {
                $puntosCartaJ1 = 11;
            } elseif ($puntosCartaJ1 == "Q") {
                $puntosCartaJ1 = 12;
            } elseif ($puntosCartaJ1 == "K") {
                $puntosCartaJ1 == 13;
            }

            if ($puntosCartaJ2 == "J") {
                $puntosCartaJ2 = 11;
            } elseif ($puntosCartaJ2 == "Q") {
                $puntosCartaJ2 = 12;
            } elseif ($puntosCartaJ2 == "K") {
                $puntosCartaJ2 == 13;
            }

            if ($puntosCartaJ1 == $puntosCartaJ2) {
                $puntuacionJ1++;
                $puntuacionJ2++;
            } elseif ($puntosCartaJ1 > $puntosCartaJ2) {
                $puntuacionJ1 = $puntuacionJ1 + 2;
            } elseif ($puntosCartaJ2 > $puntosCartaJ1) {
                $puntuacionJ2 = $puntuacionJ2 + 2;
            } 
        }

        /* Muestra de las puntuaciones */

        echo '<section><h1>Resultado de la partida:</h1>';

        echo '<p>'.$nombresJugadores[0].': '.$puntuacionJ1.'</p>';
        echo '<p>'.$nombresJugadores[1].': '.$puntuacionJ2.'</p>';

        if ($puntuacionJ1 > $puntuacionJ2) {
            echo '<p>Ganador: '.$nombresJugadores[0].'</p>';
        } else if ($puntuacionJ1 < $puntuacionJ2) {
            echo '<p>Ganador: '.$nombresJugadores[1].'</p>';
        } else {
            echo '<p>Empate</p>';
        }
        echo '</section>';



        
    ?>

</body>
</html>