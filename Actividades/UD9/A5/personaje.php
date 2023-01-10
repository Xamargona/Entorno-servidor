<?php
    // Comprobamos si recibimos información por GET
    if (isset($_GET['url']) && !empty($_GET['url'])) {
        $url = $_GET['url'];
    }
    $json = file_get_contents($url);
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
        // Mostramos los datos recibidos
        include_once 'includes/header.inc.php';
        if (isset($json)) {
            $datos = json_decode($json, true);
            echo '<div class="personaje">';
                echo '<h2>'.$datos['name'].'</h2>';
                echo '<img src='.$datos['image'].' alt='.$datos['name'].'>';
                echo '<p>Estado: '.$datos['status'].'</p>';
                echo '<p>Especie: '.$datos['species'].'</p>';
                echo '<p>Genero: '.$datos['gender'].'</p>';
                echo '<p>Origen: '.$datos['origin']['name'].'</p>';
            echo '</div>';
        }
    ?>
</body>
</html>