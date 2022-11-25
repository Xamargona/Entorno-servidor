<?php
    // En esta página web se crean los revels por medio de un formulario y redirige a revel.php si todo es correcto
    // Comprobamos que el usuario está logueado
    session_start();

    if (!isset($_SESSION['user'])) {
        header('Location: index.php');
    }

    if (isset($_SESSION['user']) && !empty($_POST)) {
        // VERIFICACIÓN DE ERRORES DEL FORMULARIO DE NEW REVEL

        // Comprobamos si se han introducido datos en el formulario de registro
        // Eliminamos los espacios en blanco de los campos del formulario
        foreach ($_POST as $input => $info) {
            $info = trim($info);
        }
        // Comprobamos si hay error en la entrada del formulario

        if (empty($_POST['texto'])) {
            $error['texto'] = '<p id="error">¡No puedes publicar un Revel vacío!</p>';
        } elseif (strlen($_POST['texto']) > 255) {
            $error['texto'] = '<p id="error">El Revel no puede tener más de 255 carácteres.</p>';
        }
        // En caso de 0 errores comprobamos que el usuario y el email no existan en la base de datos

        // En caso de que todos los datos sean correctos conectamos con la base de datos y registramos al usuario

        if (!isset($error)) {
            // Conectamos con la base de datos y creamos el revel
            include_once 'includes/dsn.inc.php';
            $consulta = $conexion->prepare('INSERT INTO revels (userid, texto) VALUES (?, ?)');
            $consulta->bindParam(1, $_SESSION['id']);
            $consulta->bindParam(2, $_POST['texto']);
            $consulta->execute();
            $revelid = $conexion->lastInsertId();
            unset($conexion);
            unset($consulta);
            // Redirigimos a la página principal
            header('Location: revel.php?revelid='.$revelid);
        }
        unset($conexion);
        unset($consulta);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Revel Page - Javier Martínez González</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once 'includes/header.inc.php';
    ?>
    <section class="newRevel">
        <form action="#" method="POST" enctype="multipart/form-data" class="formNewRevel">
            <h3>Crea un nuevo Revel</h3>
            <label for="texto">Escribe al mundo lo que quieres compartir</label><br>
            <textarea name="texto" id="texto" cols="60" rows="5" placeholder="Cuéntale al mundo que está pasando con hasta 255 carácteres :)" value="<?=$_POST['texto']??""?>" required></textarea>
            <?php if (isset($error['texto'])) { echo $error['texto']; } ?><br>
            <input type="submit" value="Revelar">
        </form>
    </section>
</body>
</html>