<?php
    // Comprobación de errores:
    $errores = true;
    if (!empty($_POST)) {
        $errores = false;
        foreach ($_POST as $campo => $info) {
            $info = trim($info);
        }
        // Título
        if (empty($_POST['titulo'])) {
            $errores = true;
            $error['titulo'] = '<p id="error">El campo titulo está vacío</p>';
        } elseif (!preg_match('/^[0-9a-zA-ZñÑ\s+]{1,50}$/',$_POST['titulo'])) {
            $error['titulo'] = '<p id="error">El titulo introducido no es válido.</p>';
            $errores = true;
        }
        // Duración
        if (empty($_POST['duracion'])) {
            $errores = true;
            $error['duracion'] = '<p id="error">El campo duración está vacío</p>';
        } elseif (!preg_match('/^[0-9]{1,8}$/',$_POST['duracion'])) {
            $error['duracion'] = '<p id="error">La duración introducida no es válida.</p>';
            $errores = true;
        }
    }
    // Comprobamos el camino a seguir del usuario: Editar, eliminar o añadir
    if (isset($_GET['accion'])) {
        if ($_GET['accion'] == 'editar') {
            $formulario = 'editar';
            if (!$errores) {
                var_dump($_POST);

                // Conecta a la base de datos
                require 'includes/dsn.inc.php';
                // Preparamos la consulta para posteriormente actualizar los valores
                $consulta = $conexion->prepare('UPDATE canciones SET titulo = :titulo, album = :album, duracion = :duracion, posicion = :posicion WHERE codigo = '.($_POST['codigo']).';');
                // Convertimos el valor edl formulario en el del album a editar
                $consulta->bindParam(':titulo', $_POST['titulo']);
                $consulta->bindParam(':album', $_POST['codigoalbum']);
                $consulta->bindParam(':duracion', $_POST['duracion']);
                $consulta->bindParam(':posicion', $_POST['posicion']);
                $consulta->execute();
                unset($conexion);
                header('Location: album.php?codigoalbum='.$_GET['codigoalbum']);
            }
        }
        if ($_GET['accion'] == 'borrar') {
            $formulario = 'eliminar';
                // Confirmamos borrado con segunda variable
                if (isset($_GET['opcion'])){
                    if ($_GET['opcion'] === 'eliminarDefinitivamente') {
                        // Conecta a la base de datos
                        require 'includes/dsn.inc.php';
                        // Preparamos la consulta para posteriormente eliminar el album
                        $consulta = $conexion->prepare('DELETE FROM canciones WHERE codigo = '.($_GET['codigo']).';');
                        $consulta->execute();
                        unset($conexion);
                        var_dump($_GET['codigoalbum']);
                        header('Location: album.php?codigoalbum='.$_GET['codigoalbum']);
                    } else {
                        header('Location: album.php?codigoalbum='.$_GET['codigoalbum']);
                    }
                }
        }
    } else {
        $formulario = 'crear';
        if (!$errores) {
            // Conecta a la base de datos
            require 'includes/dsn.inc.php';
            // Preparamos la consulta para posteriormente insertar los valores
            $consulta = $conexion->prepare('INSERT INTO canciones (titulo, album, duracion, posicion) VALUES (?,?,?,0);');
            $consulta->bindParam(1, $_POST['titulo']);
            $consulta->bindParam(2, $_POST['codigoalbum']);
            $consulta->bindParam(3, $_POST['duracion']);
            $consulta->execute();
            unset($conexion);
            header('Location: album.php?codigoalbum='.$_GET['codigoalbum']);
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
            $resultado = $conexion->query('SELECT * FROM canciones WHERE codigo = '.$_GET['codigo']);
            $cancion = $resultado->fetch();
            unset($conexion);
            unset($resultado);
            ?>
            <div class="alineado">
                <div class="contenedor_aviso">
                <input type="hidden" name="codigo" value="<?$cancion['codigo']?>">
                <h3 id="warning">¿Estás seguro de que quieres eliminar la canción <?=$cancion['titulo']?>?</h3>
                <a href="album.php?codigoalbum=<?=$_GET['codigoalbum']?>&codigo=<?=$cancion['codigo']?>&accion=borrar&opcion=eliminarDefinitivamente">Eliminar</a>
                <a href="album.php?codigoalbum=<?=$cancion['album']?>&accion=borrar&opcion=cancelar">Cancelar</a>
                </div>
            </div>

            <?php
        }
    ?>
    <div id="caja_titulo">
        <?php
            require 'includes/dsn.inc.php';
            // Recibo la variable codigoalbum con la que muestro el titulo del mismo
            if(!isset($_GET['codigoalbum'])) {
                $_GET['codigoalbum'] = $_POST['codigoalbum'];
            }
            $resultado = $conexion->query('SELECT titulo FROM albumes WHERE codigo = '.$_GET['codigoalbum']);
            $album = $resultado->fetch();
            $resultado = $conexion->query('SELECT grupo FROM albumes WHERE codigo = '.$_GET['codigoalbum']);
            $grupo = $resultado->fetch();
            unset($conexion);
            unset($resultado);
        ?>
        <img src="imagenes/disco.png" alt="disco">
        <a href="grupo.php?codigogrupo=<?=$grupo['grupo']?>"><h2 class="titulo_seccion">Canciones de <?=$album['titulo']?></h2></a>
    </div>

    <table>
        <?php
            require 'includes/dsn.inc.php';
            // Obtengo los albumes a partir del código del album recibido
            if(!isset($_GET['codigoalbum'])) {
                $_GET['codigoalbum'] = $_POST['codigoalbum'];
            }
            $resultado = $conexion->query('SELECT * FROM canciones WHERE album = '.$_GET['codigoalbum']);
            // Se muestran los datos de los albumes 
            while ($cancion = $resultado->fetch()) {
                $min = floor($cancion['duracion']/60);
                $seg = $cancion['duracion']%60;
                if ($seg < 10) {
                    $seg = '0'.$seg;
                }
                echo '<tr>';
                    echo '<td>'.$cancion['titulo'].'</td>';
                    echo '<td>'.$min.':'.$seg.'</td>';
                    echo '<td>';
                    echo '<a href="album.php?codigo='.$cancion['codigo'].'&accion=editar&codigoalbum='.$cancion['album'].'"><img src="imagenes/lapiz.png" alt="editar"></a>';
                    echo '<a href="album.php?codigo='.$cancion['codigo'].'&accion=borrar&codigoalbum='.$cancion['album'].'"><img src="imagenes/papelera.png" alt="borrar"></a>';
                echo '</td></tr>';
            }
            unset($conexion);
            unset($resultado);
        ?>
    </table>
    <?php
        // Formularios: 
        // Mantenemos un plantilla de formulario inicial
        // Cuando se active el formulario "editar" el input añadir se sustituye por un input confirmar y cancelar y se añade el input codigo

        if ($formulario == 'editar') {
            echo '<form action="#" method="post">';
            require 'includes/dsn.inc.php';
            $resultado = $conexion->query('SELECT * FROM canciones WHERE codigo = '.$_GET['codigo']);
            $cancion = $resultado->fetch();
            unset($conexion);
            unset($resultado);
            echo '<h2>Edita la cancion '.($cancion['titulo']??"").'</h2>';
            $_POST['titulo'] = $cancion['titulo']??"";
            $_POST['codigoalbum'] = $cancion['album']??"";
            $_POST['duracion'] = $cancion['duracion']??"";
            $_POST['posicion'] = $cancion['posicion']??"";
            if(!isset($_GET['codigoalbum'])) {
                $_GET['codigoalbum'] = $_POST['codigoalbum'];
            }
            $_POST['codigoalbum'] = $_GET['codigoalbum'];
        } elseif ($formulario == 'crear') {
            echo '<form action="#" method="post">';
            echo '<h2>Añade una nueva canción</h2>';
            if(!isset($_GET['codigoalbum'])) {
                $_GET['codigoalbum'] = $_POST['codigoalbum'];
            }
            $_POST['codigoalbum'] = $_GET['codigoalbum'];
        }

        if ($formulario != 'eliminar') {
        ?>
            <span>      
                <label for="titulo">Título</label>
                <input type="text" name="titulo" placeholder="Título de la canción" id="titulo" value="<?=$_POST['titulo']??""?>"><br>
            </span>
            <?php if (isset($error['titulo'])) echo $error['titulo'];?>
            <span>
                <label for="duracion">Duración</label>
                <input type="number" name="duracion" placeholder="Duración" id="duracion" value="<?=$_POST['duracion']??""?>"><br>
            </span>
            <?php if (isset($error['duracion'])) echo $error['duracion'];?>
            <span>
                <input type="hidden" name="codigoalbum" id="codigoalbum" value="<?=$_GET['codigoalbum']?>">
                <input type="hidden" name="posicion" id="posicion" value="<?=$_POST['posicion']??""?>">
            <?php
                if ($formulario == 'editar') {
                    echo '<input type="hidden" name="codigo" value="'.($cancion['codigo']).'">';
                    echo '<input type="submit" name="confirmar" value="Confirmar">';
                    echo '<a href="album.php?codigoalbum='.$_POST['codigoalbum'].'" class="inputamongus">Cancelar</a>';
                } else {
                    echo '<input type="submit" name="añadir" value="Añadir">';
                }
            ?>
            </span>
        </form>
        <br>
        <?php
        }
        ?>
</body>
</html>