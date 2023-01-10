<?php
    $numero = rand(1,3);
    switch ($numero) {
        case 1:
            $url = "https://names.drycodes.com/1?nameOptions=girl_names";
            break;
        case 2:
            $url = "https://names.drycodes.com/1?nameOptions=boy_names";
            break;
        case 3:
            $url = "https://names.drycodes.com/1?nameOptions=presidents";
            break;
    }
    $json = file_get_contents($url);
    $nombreMon = json_decode($json, true);
    
    $urlPlanera = "https://names.drycodes.com/1?nameOptions=planets";
    $jsonPlaneta = file_get_contents($urlPlanera);
    $nombrePlaneta = json_decode($jsonPlaneta, true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random API - Javier Martínez González</title>
    <style>
        body{
            background-image: url("https://app.pixelencounter.com/api/basic/planets?frame=1&width=1920&height=1080");
            background-repeat: no-repeat;
            height: 100vh;
            background-size: cover;
        }
        .estrella{
            position: absolute;
            top: -26%;
            left: -20%;
            transform: scale(.5);
        }
        .monstruo{
            position: absolute;
            top: 5%;
            left: 75%;
        }

        h2 {
            position: absolute;
            top: 5%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-family: 'Courier New', Courier, monospace;
            text-decoration: underline;
        }

        h2:hover {
            color: #ff0000;
            font-size: 1.5em;
            transition: 0.5s;
        }

        div {
            position: absolute;
            top: 50%;
            left: 1%;
            text-align: center;
            color: white;
            font-family: 'Courier New', Courier, monospace;
        }
    </style>
<body>
    <a href="usoapiJavier.php"><h2>Genera un planeta, estrella y habitante aleatorio</h2></a>
    <img class="monstruo" src="https://app.pixelencounter.com/api/basic/monsters/random/png?size=400"" alt="Monstruo">
    <!--  En teoría la estrella debería cambiar pero a veces se ralla un poco y cambia 1 a las mil y otras desaparece -->
    <img class="estrella" src="https://app.pixelencounter.com/api/basic/stars?frame=1&width=1920&height=1080&disableBackground=true&disableStars=true" alt="estrella">
    <div>
        <h3>Nombre en clave planeta: <?=$nombrePlaneta[0]?></h3>
        <h3>Planeta habitado por criatura en clave: <?=$nombreMon[0]?></h3>
    </div>
</body>
</html>