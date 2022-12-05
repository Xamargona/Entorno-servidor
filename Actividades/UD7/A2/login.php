<?php
    // Comprobamos si existe la sesión usuario o el token y si es así redirigimos a Index.php
    if (isset($_SESSION['usuario']) || isset($_COOKIE['token'])) {
        header('Location: index.php');
    }

    // Creamos la sesión
    ini_set('session.cache_expire', 10);
    session_start();
    include 'includes/idiomas.inc.php';
    $errores = true;
    $error = false;
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
    }
    if (!$errores) {
        include_once 'includes/dsn.inc.php';
        // Verificamos si el usuario o mail existe
        $resultado = $conexion->prepare('SELECT * FROM usuarios WHERE usuario = :usuario');
        $resultado->bindParam(':usuario', $_POST['usuario']);
        $resultado->execute();
        $usuarios = $resultado->fetch();
        if ($usuarios) {
            $aux = true;
        } else {
            $aux = false;
            $resultado = $conexion->prepare('SELECT * FROM usuarios WHERE email = :email');
            $resultado->bindParam(':email', $_POST['usuario']);
            $resultado->execute();
            $emails = $resultado->fetch();
            if ($emails) {
                $aux = true;
            }
        }
        if ($aux) {
            // Comprobamos que la contraseña sea correcta
            $resultado = $conexion->prepare('SELECT contrasenya FROM usuarios WHERE usuario = :usuario OR email = :email');
            $resultado->bindParam(':usuario', $_POST['usuario']);
            $resultado->bindParam(':email', $_POST['usuario']);
            $resultado->execute();
            $contrasenya = $resultado->fetch();
            $contrasenyaBBDD = $contrasenya['contrasenya'];
            if (password_verify($_POST['contrasena'], $contrasenyaBBDD)) {
                // Guardamos la información en la sesión y creamos el token
                if ($usuarios) {
                    $resultado = $conexion->prepare('SELECT * FROM usuarios WHERE usuario = :usuario');
                    $resultado->bindParam(':usuario', $_POST['usuario']);
                    $resultado->execute();
                } elseif ($emails) {
                    $resultado = $conexion->query('SELECT * FROM usuarios WHERE email = :email');
                    $resultado->bindParam(':email', $_POST['usuario']);
                    $resultado->execute();
                }
                $datos = $resultado->fetch();
                $_SESSION['usuario'] = $datos['usuario'];
                $_SESSION['rol'] = $datos['rol'];
                // Creamos y guardamos el token
                if ($_POST['recordar'] == 'on') {
                    $token = bin2hex(random_bytes(90));
                    setcookie('token', $token, time() + 60 * 60 * 24 * 365);
                    // update del token en la base de datos
                    $update = $conexion->prepare('UPDATE usuarios SET token = :token WHERE usuario = :usuario OR email = :email');
                    $update->bindParam(':token', $token);
                    $update->bindParam(':usuario', $_POST['usuario']);
                    $update->bindParam(':email', $_POST['usuario']);
                    $update->execute();
                }
                unset($conexion);
                unset($resultado);
                header('Location: index.php');
            }
        } else {
            $errores = true;
            $error = true;
        }
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
    <link rel="stylesheet" href="css/style.css">
</head>
    <?php
        include_once 'includes/header.inc.php';
    ?>
<body>
    <form action="login.php" method="post" id="login">
        <h2><?=$message['login.titulo']?></h2>   
        <label for="usuario"><?=$message['login.usuario']?></label>
        <input type="text" name="usuario" id="usuario">
        <label for="contrasena"><?=$message['login.contrasena']?></label>
        <input type="password" name="contrasena" id="contrasena">
        <label for="recordar"><?=$message['login.recordar']?></label>
        <input type="checkbox" name="recordar" id="recordar">
        <input type="submit" value="<?=$message['login.enviar']?>">
        <?php if ($error) { echo '<p id="error">'.$message['login.error'].'</p>'; }?>
    </form>
</body>
</html>