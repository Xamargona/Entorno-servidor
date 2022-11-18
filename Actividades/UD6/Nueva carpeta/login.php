<?php
    // Comprobamos si existe la sesión usuario o el token y si es así redirigimos a Index.php
    if (isset($_SESSION['usuario']) || isset($_COOKIE['token'])) {
        header('Location: index.php');
    }

    // Creamos la sesión
    ini_set('session.cache_expire', 10);
    session_start();

    $errores = true;
    if (!empty($_POST)) {
        $errores = false;
        foreach ($_POST as $campo => $info) {
            $info = trim($info);
        }
        // Nombre
        if (empty($_POST['usuario'])) {
            $errores = true;
            $error = true;
        } elseif (!preg_match('/^[0-9a-zA-ZñÑ\s]{1,20}$/',$_POST['usuario'])) {
            $error = true;
            $errores = true;
        }
        // Contraseña
        if (empty($_POST['contrasena'])) {
            $errores = true;
            $error = true;
        } elseif (!preg_match('/^[0-9a-zA-ZñÑ\s]{1,255}$/',$_POST['contrasena'])) {
            $error = true;
            $errores = true;
        }
        // Email
        if (empty($_POST['email'])) {
            $errores = true;
            $error = true;
            // Formato email alfanumerico + @alfanumerico + . 3 caracteres
        } elseif (!preg_match('/^[a-z_.0-9]+@[a-z]+.[a-z]{2,3}/',$_POST['email'])) {
            $error = true;
            $errores = true;
        }
    }
    if (!$errores) {
        include_once 'includes/dsn.inc.php';
        // Verificamos si el usuario o mail existe
        $resultado = $conexion->query('SELECT * FROM usuarios WHERE usuario = "'.$_POST['usuario'].'"');
        $usuarios = $resultado->fetch();
        $resultado = $conexion->query('SELECT * FROM usuarios WHERE email = "'.$_POST['usuario'].'"');
        $emails = $resultado->fetch();
        if ($usuarios || $emails) {
            // Comprobamos que la contraseña sea correcta
            if ($usuarios) {
                $resultado = $conexion->query('SELECT contrasenya FROM usuarios WHERE usuario = "'.$_POST['usuario'].'"');
            } elseif ($emails) {
                $resultado = $conexion->query('SELECT contrasenya FROM usuarios WHERE email = "'.$_POST['usuario'].'"');
            }
            $contrasenya = $resultado->fetch();
            $contrasenyaEncriptada = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
            if (password_verify($contrasenyaEncriptada, $contrasenya)) {
                // Guardamos la información en la sesión y creamos el token
                if ($usuarios) {
                    $resultado = $conexion->query('SELECT * FROM usuarios WHERE usuario = "'.$_POST['usuario'].'"');
                } elseif ($emails) {
                    $resultado = $conexion->query('SELECT * FROM usuarios WHERE email = "'.$_POST['usuario'].'"');
                }
                $datos = $resultado->fetch();
                $_SESSION['usuario'] = $datos['usuario'];
                $_SESSION['rol'] = $datos['rol'];
                // Creamos y guardamos el token
                if ($_POST['recordar']) {
                    $token = bin2hex(random_bytes(90));
                    setcookie('token', $token, time() + 60 * 60 * 24 * 365);
                    $conexion->query('UPDATE usuarios SET token = $token WHERE usuario ="'.$datos["usuario"].'"');
                }
                header('Location: index.php');
            }
        } else {
            $errores = true;
            $error = true;
        }

        // si no existe el usuario y el email, insertaren la base de datos
        unset($conexion);
        unset($resultado);
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Javier Martínez González</title>
</head>
<body>
    // crea un formulario de login
    <form action="login.php" method="post">
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id="usuario">
        <label for="contrasena">Contraseña</label>
        <input type="password" name="contrasena" id="contrasena">
        <label for="recordar">Recordar en el equipo</label>
        <input type="checkbox" name="recordar" id="recordar">
        <input type="submit" value="Entrar">
        <?php if ($error) { echo '<p id="error">Uno o más campos són erróneos</p>'; }?>
    </form>
</body>
</html>