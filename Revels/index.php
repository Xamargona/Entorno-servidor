<?php
// DUDAS: El user ha de ser diferenciado por mayus y minus??
// He de mostrar que el usuario esta ya registrado si falla en otro campo?
    /*
        Tres estilos de página principal:
        USUARIOS NO REGISTRADOS
        - Se muestra un mensaje de bienvenida y un formulario de REGISTRO
        USUARIOS REGISTRADOS CON PUBLICACIONES
        - Se muestra un feed con las publicaciones de los usuarios que sigue y las suyas propias en orden cronológico, estás llevan un enlace a la página 'revel.php'
        USUARIOS REGISTRADOS SIN PUBLICACIONES
        - Se muestra un mensaje y un formulario para añadir un revel que enviará la información a 'new.php'
    */

    // Iniciamos la sesión y comporbamos si existe el user o el token
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
            } elseif (!preg_match('/^[0-9a-zA-ZñÑ\s]{1,20}$/',$_POST['usuario'])) {
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
            } elseif (!preg_match('/^[0-9a-zA-ZñÑ\s]{1,20}$/',$_POST['contrasena'])) {
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

                // Enriptamos la contraseña e inicializamos el token commo null
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
            ?>
                <aside>

                </aside>
                
            <?php
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