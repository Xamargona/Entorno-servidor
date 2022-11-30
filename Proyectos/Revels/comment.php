<?php
    // Se inicia la sesion y se comprueba si existe el usuario
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: index.php');
    }
    // Se verifican los comentarios y se redirige a revel.php
    if (!empty($_POST)) {
        // Validamos los datos
        if (empty($_POST['texto'])) {
            $error['texto'] = '<p id="errorComment">El comentario no puede estar vacío.</p>';
        }
        if (strlen($_POST['texto']) > 255) {
            $error['texto'] = '<p id="errorComment">El comentario no puede tener más de 255 caracteres.</p>';
        }
        if (!isset($error)) {
            // Conectamos con la base de datos y registramos el comentario
            include_once 'includes/dsn.inc.php';
            $consulta = $conexion->prepare('INSERT INTO comments (userid, revelid, texto) VALUES (?, ?, ?)');
            $consulta->bindParam(1, $_SESSION['id']);
            $consulta->bindParam(2, $_POST['revelid']);
            $consulta->bindParam(3, $_POST['texto']);
            $consulta->execute();
            unset($conexion);
            unset($consulta);
            // Redirigimos a la página del revel
            header('Location: revel.php?revelid=' . $_POST['revelid']);
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments Revels - Javier Martínez González</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once 'includes/header.inc.php';
        echo $error['texto'];
    ?>
</body>
</html>