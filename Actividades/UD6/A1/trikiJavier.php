<?php
    // Cuando recibimos que el usuario ha aceptado las cookies la creamos.
    if (count($_GET) > 0 && isset($_GET['aceptar'])) {
        setcookie('Galleta', 'cookie', time() + 60, $httponly=true);
        //header location
        header('Location: trikiJavier.php');
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookies - Javier Martínez González</title>
</head>
<body>
    <?php
        // Si no existe la cookie le mostramos la opción de aceptarla.
        if (!isset($_COOKIE['Galleta'])) {
            echo "<p>Esta página utiliza cookies, acéptelas.</p>";
            echo '<a href="trikiJavier.php?aceptar=1">Aceptar</a>';
        } else {
            // Si existe la cookie, mostramos el mensaje de que existe.
            echo "<p>¡Las cookies existen!</p>";
        }
    ?>
    <p></p>
</body>
</html>