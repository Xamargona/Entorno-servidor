<?php
    // En esta página web se muestran los revels tras ser creado y los que reciba por su id
    // Cuenta con un formulario a comment.php donde se validan los datos y redirige de nuevo al revel
    // Comprobamos que el usuario está logueado y si ha recibido una id de revel
    session_start();
    if (!isset($_SESSION['user']) || !isset($_GET['revelid'])) {
        header('Location: index.php');
    }
    // Comprobamos que el revel existe
    include_once 'includes/dsn.inc.php';
    $consulta = $conexion->prepare('SELECT * FROM revels WHERE id = ?');
    $consulta->bindParam(1, $_GET['revelid']);
    $consulta->execute();
    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    if (!$resultado) {
        unset($conexion);
        unset($consulta);
        header('Location: index.php');
    }
    // Comprobamos si se recibe la opcion eliminar por GET
    if (isset($_GET['accion'])) {
        if ($_GET['accion']=='eliminar') {
            // Eliminamos los comentarios del revel
            $consulta = $conexion->prepare('DELETE FROM comments WHERE revelid = ?');
            $consulta->bindParam(1, $_GET['revelid']);
            $consulta->execute();
            // Eliminamos el revel
            $consulta = $conexion->prepare('DELETE FROM revels WHERE id = ?');
            $consulta->bindParam(1, $_GET['revelid']);
            $consulta->execute();
            unset($conexion);
            unset($consulta);
            // Redirigimos a la página principal
            header('Location: index.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revel - Javier Martínez González</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once 'includes/header.inc.php';
        // Conectamos con la base de datos y mostramos el revel
        include_once 'includes/dsn.inc.php';
        $consulta = $conexion->prepare('SELECT * FROM revels WHERE id = ?');
        $consulta->bindParam(1, $_GET['revelid']);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        if ($resultado) {
            echo '<section class="revel">';
            echo '<div class="cajaRevel">';
            // Obtenemos el nombre de usuario de quien publica el revel
            $consulta = $conexion->prepare('SELECT usuario FROM users WHERE id = ?');
            $consulta->bindParam(1, $resultado['userid']);
            $consulta->execute();
            $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
            // Mostramos el revel
            echo '<h1>' . $usuario['usuario'] . '</h1>';
            echo '<p>' . $resultado['texto'] . '</p>';
            echo '<p>' . $resultado['fecha'] . '</p>';
            // Si el revel es del usuario, mostramos la opción de eliminarlo
            if ($resultado['userid'] == $_SESSION['id']) {
                echo '<a href="revel.php?revelid=' . $resultado['id'] . '&accion=eliminar">Eliminar</a>';
            }

            echo '</div>';
            // Mostramos los comentarios
            $consulta = $conexion->prepare('SELECT * FROM comments WHERE revelid = ?');
            $consulta->bindParam(1, $_GET['revelid']);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            if ($resultado) {
                echo '<ul class="cajaComentarios">';
                // Si existen comentarios, los mostramos
                foreach ($resultado as $comentario) {
                    $consulta = $conexion->prepare('SELECT usuario FROM users WHERE id = ?');
                    $consulta->bindParam(1, $comentario['userid']);
                    $consulta->execute();
                    $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
                    echo '<li>';
                    echo '<h3>' . $usuario['usuario'] . '</h3>';
                    echo '<p>' . $comentario['texto'] . '</p>';
                    echo '<p>' . $comentario['fecha'] . '</p>';
                    echo '</li>';
                }
                echo '</ul>';
            unset($conexion);
            unset($consulta);
            } else {
                unset($conexion);
                unset($consulta);
                echo '<p>Todavía no hay comentarios ¡se el primero en comentar!</p>';
            }
            echo '</section>';
            // Mostramos el formulario de comentarios
            ?>
            <form action="comment.php" method="post" class="formComments">
                <h2>Publica tu comentario</h2>
                <input type="hidden" name="revelid" value="<?php echo $_GET['revelid']; ?>">
                <textarea name="texto" id="texto" cols="35" rows="1" placeholder="¡Cuéntanos!" value="<?=$_POST['texto']??""?>" required></textarea><br>
                <?php if (isset($error['texto'])) { echo $error['texto']; } ?>
                <input type="submit" value="Comentar">
            </form>
            <?php
        }
    ?>
</body>
</html>