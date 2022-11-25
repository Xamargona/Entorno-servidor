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
        header('Location: index.php');
    }

    // Comprobamos que el usuario es el creador del revel
    if ($_SESSION['id'] != $resultado['userid']) {
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revel - Javier Martínez González</title>
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
            // Mostramos el revel
            echo '<h1>' . $_SESSION['user'] . '</h1>';
            echo '<p>' . $resultado['texto'] . '</p>';
            echo '<p>' . $resultado['fecha'] . '</p>';
            // Mostramos los comentarios
            $consulta = $conexion->prepare('SELECT * FROM comments WHERE revelid = ?');
            $consulta->bindParam(1, $_GET['revelid']);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            if ($resultado) {
                // Si existen comentarios, los mostramos
                foreach ($resultado as $comentario) {
                    echo '<p>' . $comentario['contenido'] . '</p>';
                    echo '<p>' . $comentario['fecha'] . '</p>';
                    echo '<p>' . $comentario['usuario'] . '</p>';
                }
            } else {
                echo '<p>Todavía no hay comentarios ¡se el primero en comentar!</p>';
            }
            // Mostramos el formulario de comentarios
            ?>
            <form action="comment.php" method="post" class="formComments">
                <input type="hidden" name="revelid" value="<?php echo $_GET['revelid']; ?>">
                <textarea name="texto" id="texto" cols="30" rows="10" placeholder="¡Cuéntanos!" value="<?=$_POST['texto']??""?>" required></textarea>
                <?php if (isset($error['texto'])) { echo $error['texto']; } ?>
                <input type="submit" value="Comentar">
            </form>
            <?php
        } else {
            // Si no existe el revel, redirigimos a la página principal
            header('Location: index.php');
        }
    ?>
</body>
</html>