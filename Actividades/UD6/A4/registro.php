<?php
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
            $error['usuario'] = '<p id="error">El campo usuario está vacío</p>';
        } elseif (!preg_match('/^[0-9a-zA-ZñÑ\s]{1,20}$/',$_POST['usuario'])) {
            $error['usuario'] = '<p id="error">El usuario introducido no es válido.</p>';
            $errores = true;
        }
        // Contraseña
        if (empty($_POST['contrasena'])) {
            $errores = true;
            $error['contrasena'] = '<p id="error">El campo contraseña está vacío</p>';
        } elseif (!preg_match('/^[0-9a-zA-ZñÑ\s]{1,255}$/',$_POST['contrasena'])) {
            $error['contrasena'] = '<p id="error">La contraseña introducida no es válido.</p>';
            $errores = true;
        }
        // Email
        if (empty($_POST['email'])) {
            $errores = true;
            $error['email'] = '<p id="error">El campo email está vacío</p>';
            // Formato email alfanumerico + @alfanumerico + . 3 caracteres
        } elseif (!preg_match('/^[0-9a-zA-ZñÑ\s]{1,80}$/',$_POST['email'])) {
            $error['email'] = '<p id="error">El email introducido no es válido.</p>';
            $errores = true;
        }
    }
    if (!$errores) {
        include_once 'includes/dsn.inc.php';
        // si el usuario existe mostramos error
        $resultado = $conexion->query('SELECT * FROM usuarios WHERE usuario = "'.$_POST['usuario'].'"');
        $usuarios = $resultado->fetch();
        if ($usuarios) {
            $error['usuario'] = '<p id="error">El usuario introducido ya existe.</p>';
            $errores = true;
        }
        // si el email existe mostramos error
        $resultado = $conexion->query('SELECT * FROM usuarios WHERE email = "'.$_POST['email'].'"');
        $usuarios = $resultado->fetch();
        // si no hay errores hacemos el insert y redirigimos
        if ($usuarios) {
            $error['email'] = '<p id="error">El email introducido ya existe.</p>';
            $errores = true;
        }
        // si no existe el usuario y el email, insertar en la base de datos
        if (!$errores) {
            $consulta = $conexion->prepare('INSERT INTO usuarios (usuario, contrasenya, email, rol) VALUES (?, ?, ?, ?)');
            $consulta->bindParam(1, $_POST['usuario']);
            $contrasenyaEncriptada = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
            $consulta->bindParam(2, $contrasenyaEncriptada);
            $consulta->bindParam(3, $_POST['email']);
            $rol = 'cliente';
            $consulta->bindParam(4, $rol);
            $consulta->execute();
            header('Location: index.php');
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
    <title>Registro - Javier Martínez González</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        if ($errores) {
            include_once 'includes/header.inc.php';
            echo '<h3>No se ha podido registrar por los siguientes errores:</h3>';
            foreach ($error as $campo => $info) {
                echo $info;
            }
        }
    ?>
</body>
</html>