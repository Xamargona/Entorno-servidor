<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Javier Martínez González</title>
</head>
<body>
    <?php
        // Convierto el contenido de la carpeta en un array a recorrer posteriormente
        // Envio al archivo marcaJavier.php una imagen mediante get: 
        // '?variable=datoAEnviar'
        $imagenes = scandir('img');
        foreach ($imagenes as $imagen) {
            if ($imagen != 'marca.png' && $imagen != '.' && $imagen != '..') {
                echo '<img src="marcaJavier.php?img='.$imagen.'" alt="anime">';
            }
        }
    ?>
</body>
</html>