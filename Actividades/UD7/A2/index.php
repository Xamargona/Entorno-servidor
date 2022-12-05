<?php
    // Creamos la sesión
    ini_set('session.cache_expire', 10);
    session_start();
    
    include 'includes/idiomas.inc.php';
    // Comprobamos si el usuario está logueado
    if (isset($_SESSION['usuario'])) {
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
    <?php
        // Si los usuarios están logueados mostramos al tienda o por el contrario un formulario
        if (isset($_SESSION['usuario'])) {
            // Muestra de objetos de la tienda
            //Iniciamos la conexión con la base de datos y mostramos cada producto 
            include_once 'includes/dsn.inc.php';
            $resultado = $conexion->query('SELECT * FROM productos');
            echo '<ul class="lista" >';
            while ($productos = $resultado->fetch()) {
                echo '<li>
                        <div id="cajaproducto">
                            <img id="imgproducto" src="img/'.$productos['imagen'].'" alt="'.$productos['nombre'].'">
                            <h3>'.$productos['nombre'].'</h3>
                            <p>'.$productos['categoria'].'</p>
                            <p>'.round(($productos['precio']*$message['valordivisa']),2).$message['divisa'].'</p>
                        </div>
                        <div id="cajaopciones">
                            <a href="index.php?accion=anyadir&codigo='.$productos['codigo'].'" id="opciones"><img src="img/mas.png" alt="mas"></a>
                            <a href="index.php?accion=restar&codigo='.$productos['codigo'].'" id="opciones"><img src="img/menos.png" alt="menos"></a>
                            <a href="index.php?accion=eliminar&codigo='.$productos['codigo'].'" id="opciones"><img src="img/papelera.png" alt="papelera"></a>
                        </div>';
                echo '</li>';
            }
            echo '</ul>';
            unset($conexion);
            unset($resultado);
        } else {
            ?>
                <form action="registro.php" id="registro" method="post" enctype="multipart/form-data">
                <h2><?=$message['registro.titulo']?></h2>   
                <span>
                        <label for="usuario"><?=$message['registro.usuario']?></label>
                        <input type="text" name="usuario" id="usuario">
                    </span>
                    <span>
                        <label for="contrasena"><?=$message['registro.contrasena']?></label>
                        <input type="password" name="contrasena" id="contrasena">
                    </span>
                    <span>
                        <label for="email"><?=$message['registro.email']?></label>
                        <input type="text" name="email" id="email">
                    </span>
                    <input type="submit" value="<?=$message['registro.enviar']?>">
                </form>
                <span id="enlacelogincaja">
                    <a href="login.php" id="enlacelogin">Log In</a>
                </span>
                <span id="enlaceofertacaja">
                    <a href="ofertas.php" id="oferta"><img id="oferta" src="img/<?=$message['enlaceoferta']?>" alt="ofertas"></a>  
                </span>
            <?php
        }
    ?>
</body>
</html>