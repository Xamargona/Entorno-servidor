<?php
    require_once 'includes/dsn.inc.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discografía - Javier Martínez</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <?php
        // Creamos una conexión a la base de datos en canciones seleccionando en función del código recibido
        $resultado = $conexion->query('SELECT * FROM canciones WHERE album = '.$_GET['codigo']);
        // Mostremos los datos de los grupos en una lista
        echo '<table>';
        while ($album = $resultado->fetch()) {
            echo '<li>';
            echo '<a href="album.php?codigo='.$album['codigo'].'">'.$album['titulo'].'</a>';
            echo ': '.$album['anyo'].' '. $album['formato'].' '.$album['fechacompra'].' '.$album['precio'];
            echo '</li>';
        }
        echo '</table>';
    ?>
</body>
</html>