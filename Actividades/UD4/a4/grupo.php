<?php
    // Comprobación de errores:
    $errores = true;
    if (!empty($_POST)) {
        $errores = false;
        foreach ($_POST as $campo => $info) {
            $info = trim($info);
        }
        // titulo
        if (empty($_POST['titulo'])) {
            $errores = true;
            $error['titulo'] = '<p>El campo titulo está vacío</p>';
        } elseif (!preg_match('/^[a-zA-ZñÑ\s]{1,50}$/',$_POST['titulo'])) {
            $error['titulo'] = '<p>El titulo introducido no es válido.</p>';
            $errores = true;
        }
        // anyo
        if (empty($_POST['anyo'])) {
            $errores = true;
            $error['anyo'] = '<p>El campo género está vacío</p>';
        } elseif (!preg_match('/^[a-zA-ZñÑ\s]{1,20}$/',$_POST['anyo'])) {
            $error['anyo'] = '<p>El género introducido no es válido.</p>';
            $errores = true;
        }
        // País
        if (empty($_POST['formato'])) {
            $errores = true;
            $error['formato'] = '<p>El campo país está vacío</p>';
        } elseif (!preg_match('/^[a-zA-ZñÑ\s]{1,20}$/',$_POST['formato'])) {
            $error['formato'] = '<p>El país introducido no es válido.</p>';
            $errores = true;
        }
        // precio
        if (empty($_POST['precio'])) {
            $errores = true;
            $error['precio'] = '<p>El campo precio está vacío</p>';
        } elseif (!preg_match('/^[0-9]{1,11}/',$_POST['precio'])) {
            $error['precio'] = '<p>La fecha de precio introducida no es válida.</p>';
            $errores = true;
        }
    }
    // Comprobamos el camino a seguir del usuario: Editar, eliminar o añadir
    if (isset($_GET['accion'])) {
        if ($_GET['accion'] == 'editar') {
            $formulario = 'editar';
            if (!$errores) {
                // Conecta a la base de datos
                require 'includes/dsn.inc.php';
                // Preparamos la consulta para posteriormente actualizar los valores
                $consulta = $conexion->prepare('UPDATE albumes SET titulo = :titulo, grupo = :grupo, anyo = :anyo, formato = :formato, precio = :precio WHERE codigo = '.($_POST['codigo']).';');
                // Convertimos el valor edl formulario en el del grupo a editar
                $consulta->bindParam(':titulo', $_POST['titulo']);
                $consulta->bindParam(':grupo', $_POST['grupo']);
                $consulta->bindParam(':anyo', $_POST['anyo']);
                $consulta->bindParam(':formato', $_POST['formato']);
                $consulta->bindParam(':precio', $_POST['precio']);
                $consulta->execute();
                unset($conexion);
                header('Location: grupo.php');
            }
        }
        if ($_GET['accion'] == 'borrar') {
            $formulario = 'eliminar';
                // Confirmamos borrado con segunda variable
                if (isset($_GET['opcion'])){
                    if ($_GET['opcion'] === 'eliminarDefinitivamente') {
                        // Conecta a la base de datos
                        require 'includes/dsn.inc.php';
                        var_dump($_GET['codigo']);
                        // Preparamos la consulta para posteriormente eliminar el grupo
                        $consulta = $conexion->prepare('DELETE FROM albumes WHERE codigo = '.($_GET['codigo']).';');
                        $consulta->execute();
                        unset($conexion);
                        header('Location: grupo.php');
                    } else {
                        header('Location: grupo.php');
                    }
                }
        }
    } else {
        $formulario = 'crear';
        if (!$errores) {
            // Conecta a la base de datos
            require 'includes/dsn.inc.php';
            // Preparamos la consulta para posteriormente insertar los valores
            $consulta = $conexion->prepare('INSERT INTO albumes (titulo, grupo, anyo, formato, precio) VALUES (?,?,?,?,?);');
            $consulta->bindParam(1, $_POST['titulo']);
            $consulta->bindParam(2, $_POST['grupo']);
            $consulta->bindParam(3, $_POST['anyo']);
            $consulta->bindParam(4, $_POST['formato']);
            $consulta->bindParam(5, $_POST['precio']);
            $consulta->execute();
            unset($conexion);
            header('Location: grupo.php');
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

    <?php
        include 'includes/header.inc.php';
        if ($formulario == 'eliminar') {
            require 'includes/dsn.inc.php';
            $resultado = $conexion->query('SELECT * FROM albumes WHERE codigo = '.$_GET['codigo']);
            $grupo = $resultado->fetch();
            unset($conexion);
            unset($resultado);
            ?>
            <div class="alineado">
                <div class="contenedor_aviso">
                <input type="hidden" name="codigo" value="<?$grupo['codigo']?>">
                <h3 id="warning">¿Estás seguro de que quieres eliminar el grupo <?=$grupo['titulo']?>?</h3>
                <a href="grupo.php?codigo=<?=$grupo['codigo']?>&accion=borrar&opcion=eliminarDefinitivamente">Eliminar</a>
                <a href="grupo.php?codigo=<?=$grupo['codigo']?>&accion=borrar&opcion=cancelar">Cancelar</a>
            </div>
            </div>

            <?php
        }
    ?>
    <div id="caja_titulo">
        <img src="imagenes/disco.png" alt="disco">
        <h2 class="titulo_seccion">Albumes</h2>
    </div>

    <ol>
        <?php
            require 'includes/dsn.inc.php';
            $resultado = $conexion->query('SELECT * FROM albumes WHERE grupo = '.$_GET['codigo']);
            // Se muestran los datos de los albumes 
            while ($album = $resultado->fetch()) {
                echo '<li>';
                    echo '<a id="albumes" href="album.php?codigo='.$album['codigo'].'">'.$album['titulo'].'</a>';
                    echo '<div>'.$album['anyo'].' | '.$album['formato'].' | '.$album['fechacompra'].' | '.$album['precio'].'</div>';
                    echo '<a href="grupo.php?codigo='.$album['codigo'].'&accion=editar"><img src="imagenes/lapiz.png" alt="editar"></a>';
                    echo '<a href="grupo.php?codigo='.$album['codigo'].'&accion=borrar"><img src="imagenes/papelera.png" alt="borrar"></a>';
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

        if ($formulario == 'editar') {
            echo '<form action="#" method="post">';
            require 'includes/dsn.inc.php';
            $resultado = $conexion->query('SELECT * FROM albumes WHERE codigo = '.$_GET['codigo']);
            $album = $resultado->fetch();
            unset($conexion);
            unset($resultado);
            echo '<h2>Edita el grupo '.($album['titulo']??"").'</h2>';
            $_POST['titulo'] = $album['titulo']??"";
            $_POST['grupo'] = $album['grupo']??"";
            $_POST['anyo'] = $album['anyo']??"";
            $_POST['formato'] = $album['formato']??"";
            $_POST['precio'] = $album['precio']??"";

        } elseif ($formulario == 'crear') {
            echo '<form action="#" method="post">';
            echo '<h2>Añade un nuevo album</h2>';
        }

        if ($formulario != 'eliminar') {
        ?>
            <span>      
                <label for="titulo">titulo</label>
                <input type="text" name="titulo" placeholder="titulo del album" id="titulo" value="<?=$_POST['titulo']??""?>"><br>
            </span>
            <?php if (isset($error['titulo'])) echo $error['titulo'];?>
            <span>
                <label for="anyo">Año</label>
                <input type="text" name="anyo" placeholder="Género" id="anyo" value="<?=$_POST['anyo']??""?>"><br>
            </span>
            <?php if (isset($error['anyo'])) echo $error['anyo'];?>
            <span>
                <label for="formato">Formato</label>
                <input type="text" name="formato" placeholder="País" id="formato" value="<?=$_POST['formato']??""?>"><br>
            </span>
            <?php if (isset($error['formato'])) echo $error['formato'];?>
            <span>
                <label for="precio">Precio</label>
                <input type="number" name="precio" placeholder="Año de precio" id="precio" value="<?=$_POST['precio']??""?>"><br>
            </span>
            <?php if (isset($error['precio'])) echo $error['precio'];?>
            <span>
            <?php
                if ($formulario == 'editar') {
                    echo '<input type="hidden" name="codigo" value="'.($album['codigo']).'">';
                    echo '<input type="submit" name="confirmar" value="Confirmar">';
                    echo '<input type="reset" name="cancelar" value="Cancelar">';
                } else {
                    echo '<input type="submit" name="añadir" value="Añadir">';
                }
            ?>
            </span>
        <?php
        }
        ?>
</body>
</html>