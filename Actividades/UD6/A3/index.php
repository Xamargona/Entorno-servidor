<?php
    // Creamos la sesión
    session_start();
    // Creamos una variable en la sesión que representará el carrito
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }
    // Comprobamos si el usuario ha decidido añadir o eliminar productos
    if (isset($_GET['accion'])) {
        
        // Si la acción es añadir revisamo si existe o no y lo creamos / sumamos
        if ($_GET['accion'] == 'anyadir' && isset( $_SESSION['carrito'][$_GET['codigo']] )) {
            $_SESSION['carrito'][$_GET['codigo']]['cantidad'] = $_SESSION['carrito'][$_GET['codigo']]['cantidad'] + 1;
        } else if ($_GET['accion'] == 'anyadir' && !isset( $_SESSION['carrito'][$_GET['codigo']] )) {
            $_SESSION['carrito'][$_GET['codigo']]['cantidad'] = 1;
        }
        // Si la acción es restar revisamos la cantidad de productos y si es 0 lo eliminamos
        if ($_GET['accion'] == 'restar' && isset( $_SESSION['carrito'][$_GET['codigo']] )) {
            if ($_SESSION['carrito'][$_GET['codigo']]['cantidad'] == 1) {
                unset($_SESSION['carrito'][$_GET['codigo']]);
            } else {
                $_SESSION['carrito'][$_GET['codigo']]['cantidad'] = $_SESSION['carrito'][$_GET['codigo']]['cantidad'] - 1;
            }
        }
        // Si la acción es eliminar lo eliminamos
        if ($_GET['accion'] == 'eliminar' && isset( $_SESSION['carrito'][$_GET['codigo']] )) {
            unset($_SESSION['carrito'][$_GET['codigo']]);
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MerchaShop - Javier Martínez González</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once 'includes/header.inc.php';
    ?>
    <nav>
        <a href="index.php">Principal</a>
        <a href="carrito.php">
            <img src="img/carrito.png" alt="carrito">[ <?= count($_SESSION['carrito']) ?> ]
        </a>
    </nav>
    <?php
        // Muestra de objetos de la tienda
        //Iniciamos la conexión con la base de datos y mostramos cada producto 
        include 'includes/dsn.inc.php';
        $resultado = $conexion->query('SELECT * FROM productos');
        echo '<ul class="lista" >';
        while($productos = $resultado->fetch()) {
            echo '<li>
                    <div id="cajaproducto">
                        <img id="imgproducto" src="img/'.$productos['imagen'].'" alt="'.$productos['nombre'].'">
                        <h3>'.$productos['nombre'].'</h3>
                        <p>'.$productos['categoria'].'</p>
                        <p>'.$productos['precio'].'€</p>
                    </div>
                    <div id="cajaopciones">
                        <a href="index.php?accion=anyadir&codigo='.$productos['codigo'].'" id="opciones"><img src="img/mas.png" alt="mas"></a>
                        <a href="index.php?accion=restar&codigo='.$productos['codigo'].'" id="opciones"><img src="img/menos.png" alt="menos"></a>
                        <a href="index.php?accion=eliminar&codigo='.$productos['codigo'].'" id="opciones"><img src="img/papelera.png" alt="papelera"></a>
                    </div>';
            echo '</li>';
        }
        unset($conexion);
        unset($resultado);
    ?>
    </ul>
</body>
</html>