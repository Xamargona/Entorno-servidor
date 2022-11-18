<?php
    // Creamos la sesión
    ini_set('session.cache_expire', 10);
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito - Javier Martínez González</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once 'includes/header.inc.php';

        // Muestra de objetos del carrito
        include 'includes/dsn.inc.php';
        $precio = 0;
        foreach ($_SESSION['carrito'] as $producto => $cantidad) {
            $resultado = $conexion->query('SELECT * FROM productos WHERE codigo = '.$producto);
            $productos = $resultado->fetch();
            $precioproducto = 0;
            $precioproducto = $productos['precio'];
            if ($productos['oferta'] != 0) {
                $precioproducto = $productos['precio']-($productos['precio']/100*$productos['oferta']);
                $precioproducto = round($precioproducto, 2);
            }
            echo '<div id="carritoproducto">
                    <img id="imgcesta" src="img/'.$productos['imagen'].'" alt="'.$productos['nombre'].'">
                    <p>'.$productos['nombre'].' - '.$cantidad['cantidad'].' unidades: '.$precioproducto.'€/unidad</p>
                </div>';
            $precio += ($precioproducto * $cantidad['cantidad']);
        }
        echo '<p>Precio total: '.$precio.'€</p>';
        unset($conexion);
        unset($resultado);
    ?>
</body>
</html>