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
        // Realizamos una consulta a la base de datos para obtener los datos de los jugadores y lo mostramos en formato tabla para una mejor visualización
        $resultado = $conexion->query('SELECT * FROM canciones WHERE album = '.$_GET['codigo']);
        // Mostremos los datos de los grupos en una tabla

    ?>
</body>
</html>