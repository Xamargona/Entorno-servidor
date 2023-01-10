<?php
    // Sacamos la información de TODOS los perosnajes de la API

    // Los personajes se organizan en páginas
    $api = 'https://rickandmortyapi.com/api/character';
    $json = file_get_contents($api);
    $datos = json_decode($json, true);
    $paginas = $datos['info']['pages'];

    // Comprobamos si recibimos información por GET
    if (isset($_GET['buscar']) && !empty($_GET['buscar'])) {
        $api = 'https://rickandmortyapi.com/api/character/?page=';
        $personajes = [];
        for ($i=1; $i <= $paginas; $i++) { 
            // Sacamos la información de cada página
            $json = file_get_contents($api.$i);
            $datos = json_decode($json, true);
            // Guardamos los datos de cada personaje
            foreach ($datos['results'] as $personaje) {
                if (strpos($personaje['name'], $_GET['buscar']) !== false) {
                    $personajes[] = $personaje;
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Api Rick & Morty - Javier Martinez González</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once 'includes/header.inc.php';
        if (isset($personajes)) {
            echo '<main>';
            foreach ($personajes as $personaje) {
                echo '<div>';
                    echo '<a href="personaje.php?url='.$personaje['url'].'"><h2>'.$personaje['name'].'</h2>';
                    echo '<img src='.$personaje['image'].' alt='.$personaje['name'].'><a/>';
                echo '</div>';
            }
            echo '</main>';
        }
    ?>
</body>
</html>
<!--
    En una primera instancia quería acceder a la información de la api sacando solo lo que necesitaba
    Sin embargo, el filtro de personajes NO acepta espacios en la url así que solo puedes buscar por cadenas simples
-->
<!--
< ?php
    // Si recibimos informacion por get, ya sea por el enlace o el formulario, sacamos el contenido de la api
    if (isset($_GET['buscar']) && !empty($_GET['buscar'])) {
        $buscar = $_GET['buscar'];
        $url = 'https://rickandmortyapi.com/api/character/?name='.$buscar.'';
        $json = file_get_contents($url);
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Api Rick & Morty - Javier Martinez González</title>
</head>
<body>
    < ?php
        include_once 'includes/header.inc.php';
        if (isset($json)) {
            $datos = json_decode($json, true);
            if (isset($datos['results'])) {
                foreach ($datos['results'] as $personaje) {
                    echo '<div>';
                        echo '<a href="personaje.php?url='.$personaje['url'].'"><h2>'.$personaje['name'].'</h2><a/>';
                        echo '<img src='.$personaje['image'].' alt='.$personaje['name'].'>';
                    echo '</div>';
                }
            }
        }
    ?>
</body>
</html>
-->