<?php
    if (isset($_COOKIE['token'])) {
        header('Location: index.php');
    }
    // Creamos la sesión
    ini_set('session.cache_expire', 10);
    session_start();
    if (isset($_SESSION['usuario'])) {
        header('Location: index.php');
    }

    include 'includes/idiomas.inc.php';
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
        // Muestra de objetos de la tienda
        //Iniciamos la conexión con la base de datos y mostramos cada producto 
        include_once 'includes/dsn.inc.php';
        $resultado = $conexion->query('SELECT * FROM productos WHERE oferta != 0');
        echo '<ul class="lista" >';
        while ($productos = $resultado->fetch()) {
            echo '<li>
                    <div id="cajaproducto">
                        <img id="imgproducto" src="img/'.$productos['imagen'].'" alt="'.$productos['nombre'].'">
                        <h3>'.$productos['nombre'].'</h3>
                        <p>'.$productos['categoria'].'</p>
                        <p>'.round(($productos['precio']*$message['valordivisa']),2).$message['divisa'].' --> '.round((($productos['precio']*$message['valordivisa'])-(($productos['precio']*$message['valordivisa'])/100*$productos['oferta'])), 2).$message['divisa'].'</p>
                        <p>'.$productos['oferta'].'% '.$message['descuento'].'</p>
                        <p>
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
?>
</body>
</html>