<?php
    // En esta página se ha de acceder a través de la cabecera con la información que se recibe

    // Iniciamos la sesión
    // Comprobamos si existe el usuario
    // Se comprueba que se ha recibido información del formulario de busqueda

    session_start();
    if (!isset($_SESSION['user']) || !isset($_GET['search'])) {
        header('Location: index.php');
    }

    if (isset($_GET['accion'])) {
        if ($_GET['accion']=='follow'){
            // Conectamos con la base de datos y registramos el comentario
            include_once 'includes/dsn.inc.php';
            $consulta = $conexion->prepare('INSERT INTO follows (userid, userfollowed) VALUES (?, ?)');
            $consulta->bindParam(1, $_SESSION['id']);
            $consulta->bindParam(2, $_GET['userid']);
            $consulta->execute();
            unset($conexion);
            unset($consulta);
            // Redirigimos a la página del revel
            header('Location: results.php?search=' . $_GET['search']);
        } elseif ($_GET['accion']=='unfollow'){
            // Conectamos con la base de datos y registramos el comentario
            include_once 'includes/dsn.inc.php';
            $consulta = $conexion->prepare('DELETE FROM follows WHERE userid = ? AND userfollowed = ?');
            $consulta->bindParam(1, $_SESSION['id']);
            $consulta->bindParam(2, $_GET['userid']);
            $consulta->execute();
            unset($conexion);
            unset($consulta);
            // Redirigimos a la página del revel
            header('Location: results.php?search=' . $_GET['search']);
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results - Javier Martínez González</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once 'includes/header.inc.php';
        if (isset($_GET['search'])) {
            // Se conecta con la base de datos
            include_once 'includes/dsn.inc.php';
            // Se prepara la consulta
            $consulta = $conexion->prepare('SELECT * FROM users WHERE usuario LIKE ? AND id != ?');
            $busqueda = '%' . $_GET['search'] . '%';
            $consulta->bindParam(1, $busqueda);
            $consulta->bindParam(2, $_SESSION['id']);
            $consulta->execute();
            // Se comprueba si hay usuarios
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            if ($resultado) {
                // Se muestran los usuarios con un enlace a seguir o dejar de seguir
                echo '<section class="muestraUsuarios">';
                foreach ($resultado as $usuario) {
                    echo '<div>';
                    echo '<h3>' . $usuario['usuario'] . '</h3>';
                    // Se comprueba si el usuario ya sigue al usuario mostrado
                    $consulta = $conexion->prepare('SELECT * FROM follows WHERE userid = ? AND userfollowed = ?');
                    $consulta->bindParam(1, $_SESSION['id']);
                    $consulta->bindParam(2, $usuario['id']);
                    $consulta->execute();
                    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                    if ($resultado) {
                        // Si ya sigue al usuario, se muestra un enlace para dejar de seguir
                        echo '<a href="results.php?userid=' . $usuario['id'] . '&accion=unfollow&search='.$_GET['search'].'">Dejar de seguir</a>';
                    } else {
                        // Si no sigue al usuario, se muestra un enlace para seguir
                        echo '<a href="results.php?userid=' . $usuario['id'] . '&accion=follow&search='.$_GET['search'].'">Seguir</a>';
                    }
                    echo '</div>';
                }
                echo '</section>';
            } else {
                // Si no hay resultados
                echo '<p class="notfound">No se han econtrado usuarios</p>';
            }
        }
    ?>
</body>
</html>