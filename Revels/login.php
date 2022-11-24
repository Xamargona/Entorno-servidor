<?php
    // Iniciamos la sesión y comporbamos si existe el user
    session_start();

    // Comprobamos si existe el usuario, en caso de que no exista, establecemos la verificación de errores del formulario de login, en caso contrario lo redirigimos

    if(isset($_SESSION['user']) && isset($_SESSION['id'])) {
        header('Location: index.php');
    }

    if (!isset($_SESSION['user'])) {
        // VERIFICACIÓN DE ERRORES DEL FORMULARIO DE REGISTRO
        $errores = false;
        // Comprobamos si se han introducido datos en el formulario de registro
        if (!empty($_POST)) {
            // Eliminamos los espacios en blanco de los campos del formulario
            foreach ($_POST as $input => $info) {
                $info = trim($info);
            }
            // Comprobamos si hay error en los campos del formulario y mostramos un error genérico

            // Nombre de usuario
            if (empty($_POST['usuario'])) {
                $errores = true;
            } elseif (!preg_match('/^[0-9a-zA-ZñÑ\s]{1,20}$/',$_POST['usuario'])) {
                $errores = true;
            }

            // Contraseña   
            if (empty($_POST['contrasena'])) {
                $errores = true;
            } elseif (!preg_match('/^[0-9a-zA-ZñÑ\s]{1,20}$/',$_POST['contrasena'])) {
                $errores = true;
            }

            // En caso de 0 errores comprobamos que el usuario y el email no existan en la base de datos

            if (!$errores) {
                // Conectamos con la base de datos y realizamos la existencia de usuario y email
                include_once 'includes/dsn.inc.php';

                // Validación de usuario
                $consulta = $conexion->prepare('SELECT * FROM users WHERE usuario = :usuario');
                $consulta->bindParam(':usuario', $_POST['usuario']); 
                $consulta->execute();
                $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                if ($resultado) {
                    $validarContrasenya = true;
                } else {
                    // Validación de email
                    $consulta = $conexion->prepare('SELECT * FROM users WHERE email = :usuario');
                    $consulta->bindParam(':usuario', $_POST['usuario']); 
                    $consulta->execute();
                    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                    if ($resultado) {
                        $validarContrasenya = true;
                    } else {
                        $validarContrasenya = false;
                    }
                }
                // Validación de contraseña
                if ($validarContrasenya) {
                    $consulta = $conexion->prepare('SELECT contrasenya FROM users WHERE usuario = :usuario OR email = :email');
                    $consulta->bindParam(':usuario', $_POST['usuario']);
                    $consulta->bindParam(':email', $_POST['usuario']);
                    $consulta->execute();
                    $contrasenya = $consulta->fetch();
                    $contrasenyaBBDD = $contrasenya['contrasenya'];
                    if (password_verify($_POST['contrasena'], $contrasenyaBBDD)) {         
                        // Creamos la sesión junto a sus parámtros y redirigimos
                        $consulta = $conexion->prepare('SELECT id FROM users WHERE usuario = :usuario OR email = :email');
                        $consulta->bindParam(':usuario', $_POST['usuario']);
                        $consulta->bindParam(':email', $_POST['usuario']);
                        $consulta->execute();
                        $id = $consulta->fetch();
                        $_SESSION['id'] = $id['id'];
                        $consulta = $conexion->prepare('SELECT usuario FROM users WHERE id = :id');
                        $consulta->bindParam(':id', $_SESSION['id']);
                        $consulta->execute();
                        $usuario = $consulta->fetch();
                        $_SESSION['user'] = $usuario['usuario'];
                        unset($conexion);
                        unset($consulta);
                        // Redirigimos a la página principal
                        header('Location: index.php');
                    }
                }
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
    <title>Revels LogIn - Javier Martínez González</title>
</head>
<body>
    <?php
        include_once 'includes/header.inc.php';
    ?>
    <form action="#" method="POST" enctype="multipart/form-data" class="formRegistro">
        <h3>Inicia sesión</h3>
        <span>
            <label for="usuario">Nombre</label>
            <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario o email" value="<?=$_POST['usuario']??""?>" required>
            <?php if (isset($error['usuario'])) { echo $error['usuario']; } ?>
        </span>
        <span>
            <label for="contrasena">Contraseña</label>
            <input type="password" name="contrasena" id="contrasena" require>
        </span>
        <input type="submit" value="Iniciar sesión">
        <?php if ($errores) { echo '<p id="error">Uno o más campos són erróneos</p>'; }?>
    </form>
</body>
</html>