<?php
    /*
        Tres estilos de página principal:
        USUARIOS NO REGISTRADOS
        - Se muestra un mensaje de bienvenida y un formulario de REGISTRO
        USUARIOS REGISTRADOS CON PUBLICACIONES
        - Se muestra un feed con las publicaciones de los usuarios que sigue y las suyas propias en orden cronológico, estás llevan un enlace a la página 'revel.php'
        USUARIOS REGISTRADOS SIN PUBLICACIONES
        - Se muestra un mensaje y un formulario para añadir un revel que enviará la información a 'new.php'
    */

    // Iniciamos la sesión y comporbamos si existe el user
    session_start();
    // Comprobamos si existe el usuario, en caso de que no exista, establecemos la verificación de errores del formulario de registro
    if (!isset($_SESSION['user'])) {

        // VERIFICACIÓN DE ERRORES DEL FORMULARIO DE REGISTRO

        // Comprobamos si se han introducido datos en el formulario de registro
        if (!empty($_POST)) {
            // Eliminamos los espacios en blanco de los campos del formulario
            foreach ($_POST as $input => $info) {
                $info = trim($info);
            }
            // Comprobamos si hay error en los campos del formulario

            // Nombre de usuario
            if (empty($_POST['usuario'])) {
                $error['usuario'] = '<p id="error">El campo usuario está vacío</p>';
            } elseif (!preg_match('/^[0-9a-zA-ZñÑ\s]{1,20}$/', $_POST['usuario'])) {
                $error['usuario'] = '<p id="error">El usuario introducido no es válido.</p>';
            }

            // Correo electrónico
            if (empty($_POST['email'])) {
                $error['email'] = '<p id="error">El campo email está vacío</p>';
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $error['email'] = '<p id="error">El email introducido no es válido.</p>';
            }

            // Contraseña   
            if (empty($_POST['contrasena'])) {
                $error['contrasena'] = '<p id="error">El campo contraseña está vacío</p>';
            } elseif (!preg_match('/^[0-9a-zA-ZñÑ\s]{1,20}$/', $_POST['contrasena'])) {
                $error['contrasena'] = '<p id="error">La contraseña introducida no es válida.</p>';
            }

            // En caso de 0 errores comprobamos que el usuario y el email no existan en la base de datos

            if (!isset($error)) {
                // Conectamos con la base de datos y realizamos la existencia de usuario y email
                include_once 'includes/dsn.inc.php';

                // Validación de usuario
                $consulta = $conexion->prepare('SELECT * FROM users WHERE usuario = :usuario');
                $consulta->bindParam(':usuario', $_POST['usuario']); 
                $consulta->execute();
                $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                if ($resultado) {
                    $error['usuario'] = '<p id="error">El usuario introducido ya existe.</p>';
                }

                // Validación de email
                $consulta = $conexion->prepare('SELECT * FROM users WHERE email = :email');
                $consulta->bindParam(':email', $_POST['email']);
                $consulta->execute();
                $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                if ($resultado) {
                    $error['email'] = '<p id="error">El email introducido ya existe.</p>';
                }
            }

            // En caso de que todos los datos sean correctos conectamos con la base de datos y registramos al usuario

            if (!isset($error)) {
                // Conectamos con la base de datos y registramos al usuario
                include_once 'includes/dsn.inc.php';

                // Creamos el usuario

                // Enriptamos la contraseña
                $contrasenaEncriptada = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
                //Insertamos los datos en la base de datos
                $consulta = $conexion->prepare('INSERT INTO users (usuario, contrasenya, email) VALUES (?, ?, ?)');
                $consulta->bindParam(1, $_POST['usuario']);
                $consulta->bindParam(2, $contrasenaEncriptada);
                $consulta->bindParam(3, $_POST['email']);
                $consulta->execute();

                // Creamos la sesión del usuario
                $_SESSION['user'] = $_POST['usuario'];
                $_SESSION['id'] = $conexion->lastInsertId();
                unset($conexion);
                unset($consulta);
                // Redirigimos a la página principal
                header('Location: index.php');
            }
            unset($conexion);
            unset($consulta);
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revels Main Page - Javier Martínez González</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include 'includes/header.inc.php';
        if (isset($_SESSION['user'])) {
            // Si existe el usuario, mostramos el feed o el formulario de nuevo revel
            include_once 'includes/dsn.inc.php';
            $consulta = $conexion->prepare('SELECT * FROM follows WHERE userid = :userid');
            $consulta->bindParam(':userid', $_SESSION['id']);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo '<aside class="seguidos">';
            echo '<h2>Seguidos</h2>';
            echo '<ul>';
            // Mostramos los seguidos
            foreach ($resultado as $user) {
                // Por cada resultado obtenemos sacamos el id del user followed
                $consulta = $conexion->prepare('SELECT usuario FROM users WHERE id = :userid');
                $consulta->bindParam(':userid', $user['userfollowed']);
                $consulta->execute();
                $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                echo '<li>'.$resultado['usuario'].'</li>';
            }
            // si no se sigue a nadie lo indicamos
            if (empty($resultado)) {
                echo '<li>Todavía no sigues a nadie</li>';
            }
            echo  '</aside>';
            // Mostramos el feed
            echo '<section class="main">';
            echo '<h2>Feed</h2>';
            echo '<ul>';    

            // Seleccionamos los revels de los usuarios seguidos y del propio usuario ordenados por fecha
            $consulta = $conexion->prepare('SELECT * FROM revels WHERE userid IN (SELECT userfollowed FROM follows WHERE userid = :userid) OR userid = :id ORDER BY fecha DESC');
            $consulta->bindParam(':userid', $_SESSION['id']);
            $consulta->bindParam(':id', $_SESSION['id']);
            $consulta->execute();
            $revels = $consulta->fetchAll(PDO::FETCH_ASSOC);
            // Mostramos los revels
            foreach ($revels as $revel) {
                // Por cada resultado obtenemos sacamos el nombre de usuario
                $consulta = $conexion->prepare('SELECT usuario FROM users WHERE id = :userid');
                $consulta->bindParam(':userid', $revel['userid']);
                $consulta->execute();
                $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                // Sacamos la cantidad de comentarios del revel
                $consulta = $conexion->prepare('SELECT COUNT(*) FROM comments WHERE revelid = :revelid');
                $consulta->bindParam(':revelid', $revel['id']);
                $consulta->execute();
                $comentarios = $consulta->fetch(PDO::FETCH_ASSOC);
                // Mostramos la cantidad de comentarios
                echo '<li><a href="revel.php?revelid='.$revel['id'].'">'.$resultado['usuario'].'<p>'.$revel['texto'].'</p>'.$revel['fecha'].' - '.$comentarios['COUNT(*)'].' comentarios</a></li>';
            }
            echo '</ul>';
            echo '</section>';
            unset($conexion);
            unset($consulta);
        } else {
            // Si no existe el usuario, mostramos el formulario de registro
            ?>
            <form action="#" method="POST" enctype="multipart/form-data" class="formRegistro">
                <h3>¿Aún no formas parte de Reveles?</h3>
                <h2>¡Regístrate!</h2>
                <span>
                    <label for="usuario">Nombre</label>
                    <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario" value="<?=$_POST['usuario']??""?>" required>
                    <?php if (isset($error['usuario'])) { echo $error['usuario']; } ?>
                </span>
                <span>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email" value="<?=$_POST['email']??""?>" required>
                    <?php if (isset($error['email'])) { echo $error['email']; } ?>
                </span>
                <span>
                    <label for="contrasena">Contraseña</label>
                    <input type="password" name="contrasena" id="contrasena" require>
                </span>
                <input type="submit" value="Registrarme">
            </form>
            <?php
        }
    ?>
</body>
</html>