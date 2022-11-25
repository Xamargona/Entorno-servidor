<?php
    // Se verifican los comentarios y se redirige a revel.php
    if (!empty($_POST)) {
        // Validamos los datos
        if (empty($_POST['texto'])) {
            $error['texto'] = '<p id="error">El comentario no puede estar vacío.</p>';
        }
        if (strlen($_POST['texto']) > 255) {
            $error['texto'] = '<p id="error">El comentario no puede tener más de 255 caracteres.</p>';
        }
        if (isset($error)) {
            // Si hay errores se redirige a revel.php
            header('Location: revel.php?revelid='.$_POST['revelid']);
        } else {
            // Conectamos con la base de datos y registramos el comentario
            include_once 'includes/dsn.inc.php';
            $consulta = $conexion->prepare('INSERT INTO comments (userid, revelid, texto, fecha) VALUES (?, ?, ?, ?)');
            $consulta->bindParam(1, $_SESSION['id']);
            $consulta->bindParam(2, $_GET['revelid']);
            $consulta->bindParam(3, $_POST['texto']);
            $consulta->bindParam(4, date('Y-m-d H:i:s'));
            $consulta->execute();
            unset($conexion);
            unset($consulta);
            // Redirigimos a la página del revel
            header('Location: revel.php?revelid=' . $_GET['revelid']);
        }
    }
?>