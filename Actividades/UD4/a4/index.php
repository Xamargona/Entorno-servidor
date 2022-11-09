<?php
    // Comprobación de errores:
    $errores = true;
    if (!empty($_POST)) {
        $errores = false;
        foreach ($_POST as $campo => $info) {
            $info = trim($info);
        }
        // Nombre
        if (empty($_POST['nombre'])) {
            $errores = true;
            $error['nombre'] = '<p>El campo nombre está vacío</p>';
        } elseif (!preg_match('/^[a-zA-Z]{1,50}$/',$_POST['nombre'])) {
            $error['nombre'] = '<p>El nombre introducido no es válido.</p>';
            $errores = true;
        }
        // Genero
        if (empty($_POST['genero'])) {
            $errores = true;
            $error['genero'] = '<p>El campo género está vacío</p>';
        } elseif (!preg_match('/^[a-zA-Z]{1,50}$/',$_POST['genero'])) {
            $error['genero'] = '<p>El género introducido no es válido.</p>';
            $errores = true;
        }
        // País
        if (empty($_POST['pais'])) {
            $errores = true;
            $error['pais'] = '<p>El campo país está vacío</p>';
        } elseif (!preg_match('/^[a-zA-Z]{1,20}$/',$_POST['pais'])) {
            $error['pais'] = '<p>El país introducido no es válido.</p>';
            $errores = true;
        }
        // Inicio
        if (empty($_POST['inicio'])) {
            $errores = true;
            $error['inicio'] = '<p>El campo inicio está vacío</p>';
        } elseif (!preg_match('/^[0-9]{11}$/',$_POST['inicio'])) {
            $error['inicio'] = '<p>La fecha de inicio introducida no es válida.</p>';
            $errores = true;
        }
    }
    
    if (isset($_GET['accion'])) {
        if ($_GET['accion'] == 'editar') {
            $formulario = 'editar';
        }
        if ($_GET['accion'] == 'borrar') {
        }
    } else {
        $formulario = 'crear';
        if (!$errores) {
            // Conecta a la base de datos
            require 'includes/dsn.inc.php';
            // Preparamos la consulta para posteriormente insertar los valroes
            $consulta = $conexion->prepare("INSERT INTO jugadores (nick, mail, pais, fechanacimiento, monedas) VALUES (?,?,?,?,?);");
            $consulta->bindParam(1, $_POST['nick']);
            $consulta->bindParam(2, $_POST['mail']);
            $consulta->bindParam(3, $_POST['pais']);
            $consulta->bindParam(4, $_POST['fecha_nacimiento']);
            $consulta->bindParam(5, $_POST['monedas']);
            $consulta->execute();
            header("Location: jugadoresJavier.php");
        }

    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discografía - Javier Martínez</title>
    <link rel="stylesheet" href="css/stylesheet.css">
</head>
<body>
    <!--Hacer cabecera-->
    <h1>Discografía</h1>
    <h2>Grupos:</h2>
    <ol>
        <?php
            require 'includes/dsn.inc.php';
            $resultado = $conexion->query('SELECT * FROM grupos');
            // Se muestran los datos de los grupos 
            while ($grupo = $resultado->fetch()) {
                echo '<li>';
                    echo '<a href="grupo.php?codigo='.$grupo['codigo'].'">'.$grupo['nombre'].'</a>';
                    echo '<a href="index.php?codigo='.$grupo['codigo'].'&accion=editar"><img src="imagenes/lapiz.png" alt="editar"></a>';
                    echo '<a href="index.php?codigo='.$grupo['codigo'].'&accion=borrar"><img src="imagenes/papelera.png" alt="borrar"></a>';
                echo '</li>';
            }
            unset($conexion);
            unset($resultado);
        ?>
    </ol>
    <?php
        // Formularios: 
        // Mantenemos un plantilla de formulario inicial
        // Cuando se active el formulario "editar" el input añadir se sustituye por un input confirmar y cancelar y se añade el input codigo

        echo '<form action="#" method="post">';
        if ($formulario == 'editar') {
            require 'includes/dsn.inc.php';
            $resultado = $conexion->query('SELECT * FROM grupos WHERE codigo = '.$_GET['codigo']);
            $grupo = $resultado->fetch();
            unset($conexion);
            unset($resultado);
            echo '<h2>Edita el grupo '.($grupo['nombre']??"").'</h2>';
            $_POST['nombre'] = $grupo['nombre']??"";
            $_POST['genero'] = $grupo['genero']??"";
            $_POST['pais'] = $grupo['pais']??"";
            $_POST['inicio'] = $grupo['inicio']??"";
        } else {
            echo '<h2>Añade un nuevo grupo</h2>';
        }

        ?>
        <span>    
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" placeholder="Nombre del grupo" id="nombre" value="<?=$_POST['nombre']??""?>"><br>
        </span>
        <span>
            <label for="genero">Género:</label>
            <input type="text" name="genero" placeholder="Género" id="genero" value="<?=$_POST['genero']??""?>"><br>
        </span>
        <span>
            <label for="pais">País:</label>
            <input type="text" name="pais" placeholder="País" id="pais" value="<?=$_POST['pais']??""?>"><br>
        </span>
        <span>
            <label for="inicio">Año de inicio:</label>
            <input type="number" name="inicio" placeholder="Año de inicio" id="inicio" value="<?=$_POST['inicio']??""?>"><br>
        </span>
        <span>
        <?php
            if ($formulario == 'editar') {
                echo '<input type="hidden" name="codigo" value="">';
                echo '<input type="submit" name="confirmar" value="Confirmar">';
                echo '<input type="reset" name="cancelar" value="Cancelar">';
            } else {
                echo '<input type="submit" name="añadir" value="Añadir">';
            }
        ?>
        </span>
</body>
</html>