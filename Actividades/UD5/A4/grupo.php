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
        // Año
        if (empty($_POST['anyo'])) {
            $errores = true;
            $error['anyo'] = '<p id="error">El campo año está vacío</p>';
        } elseif (!preg_match('/^[0-9]{4}$/',$_POST['anyo'])) {
            $error['anyo'] = '<p id="error">El año introducido no es válido.</p>';
            $errores = true;
        }
        // formato
        $formatos = array('cd', 'vinilo', 'dvd', 'mp3');
        if (empty($_POST['formato'])) {
            $errores = true;
            $error['formato'] = '<p id="error">El campo formato está vacío</p>';
        } elseif (!in_array($_POST['formato'], $formatos)) {
            $error['formato'] = '<p id="error">El formato introducido no es válido.</p>';
            $errores = true;
        }
        // Fechacompra
        if (empty($_POST['fechacompra'])) {
            $errores = true;
            $error['fechacompra'] = '<p id="error">El campo fecha de compra está vacío</p>';
        } elseif (!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/',$_POST['fechacompra'])) {
            $error['fechacompra'] = '<p id="error">La fecha de compra introducida no es válida.</p>';
            $errores = true;
        }
        // Precio
        if (empty($_POST['precio'])) {
            $errores = true;
            $error['precio'] = '<p id="error">El campo precio está vacío</p>';
        } elseif (!preg_match('/^[0-9]{1,5}+(\.[0-9]{0,2})?$/',$_POST['precio'])) {
            $error['precio'] = '<p id="error">El precio introducido no es válido.</p>';
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
                $consulta = $conexion->prepare('UPDATE albumes SET titulo = :titulo, grupo = :grupo, anyo = :anyo, formato = :formato, fechacompra = :fechacompra, precio = :precio WHERE codigo = '.($_POST['codigo']).';');
                // Convertimos el valor edl formulario en el del album a editar
                $consulta->bindParam(':titulo', $_POST['titulo']);
                $consulta->bindParam(':grupo', $_POST['codigogrupo']);
                $consulta->bindParam(':anyo', $_POST['anyo']);
                $consulta->bindParam(':formato', $_POST['formato']);
                $consulta->bindParam(':fechacompra', $_POST['fechacompra']);
                $consulta->bindParam(':precio', $_POST['precio']);
                $consulta->execute();
                unset($conexion);
                header('Location: grupo.php?codigogrupo='.$_GET['codigogrupo']);
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
                        $consulta = $conexion->prepare('DELETE FROM albumes WHERE codigo = '.($_GET['codigo']).';');
                        $consulta->execute();
                        unset($conexion);
                        var_dump($_GET['codigogrupo']);
                        header('Location: grupo.php?codigogrupo='.$_GET['codigogrupo']);
                    } else {
                        header('Location: grupo.php?codigogrupo='.$_GET['codigogrupo']);
                    }
                }
        }
    } else {
        $formulario = 'crear';
        if (!$errores) {
            // Conecta a la base de datos
            require 'includes/dsn.inc.php';
            // Preparamos la consulta para posteriormente insertar los valores
            $consulta = $conexion->prepare('INSERT INTO albumes (titulo, grupo, anyo, formato, fechacompra, precio) VALUES (?,?,?,?,?,?);');
            $consulta->bindParam(1, $_POST['titulo']);
            $consulta->bindParam(2, $_POST['codigogrupo']);
            $consulta->bindParam(3, $_POST['anyo']);
            $consulta->bindParam(4, $_POST['formato']);
            $consulta->bindParam(5, $_POST['fechacompra']);
            $consulta->bindParam(6, $_POST['precio']);
            $consulta->execute();
            unset($conexion);
            header('Location: grupo.php?codigogrupo='.$_GET['codigogrupo']);
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
            $album = $resultado->fetch();
            unset($conexion);
            unset($resultado);
            ?>
            <div class="alineado">
                <div class="contenedor_aviso">
                <input type="hidden" name="codigo" value="<?$album['codigo']?>">
                <h3 id="warning">¿Estás seguro de que quieres eliminar el album <?=$album['titulo']?>?</h3>
                <a href="grupo.php?codigogrupo=<?=$_GET['codigogrupo']?>&codigo=<?=$album['codigo']?>&accion=borrar&opcion=eliminarDefinitivamente">Eliminar</a>
                <a href="grupo.php?codigogrupo=<?=$album['grupo']?>&accion=borrar&opcion=cancelar">Cancelar</a>
                </div>
            </div>

            <?php
        }
    ?>
    <div id="caja_titulo">
        <?php
            require 'includes/dsn.inc.php';
            // Recibo la variable codigogrupo con la que muestro el titulo del mismo
            if(!isset($_GET['codigogrupo'])) {
                $_GET['codigogrupo'] = $_POST['codigogrupo'];
            }
            $resultado = $conexion->query('SELECT nombre FROM grupos WHERE codigo = '.$_GET['codigogrupo']);
            $grupo = $resultado->fetch();
            unset($conexion);
            unset($resultado);
        ?>
        <img src="imagenes/disco.png" alt="disco">
        <a href="index.php"><h2 class="titulo_seccion">Albumes de <?=$grupo['nombre']?></h2></a>
    </div>

    <ol>
        <?php
            require 'includes/dsn.inc.php';
            // Obtengo los albumes a partir del código del grupo recibido
            if(!isset($_GET['codigogrupo'])) {
                $_GET['codigogrupo'] = $_POST['codigogrupo'];
            }
            $resultado = $conexion->query('SELECT * FROM albumes WHERE grupo = '.$_GET['codigogrupo']);
            // Se muestran los datos de los albumes 
            while ($album = $resultado->fetch()) {
                echo '<li>';
                    echo '<a id="albumes" href="album.php?codigoalbum='.$album['codigo'].'">'.$album['titulo'].'</a>';
                    echo '<div>'.$album['anyo'].' | '.$album['formato'].' | '.$album['fechacompra'].' | '.$album['precio'].'</div>';
                    echo '<a href="grupo.php?codigo='.$album['codigo'].'&accion=editar&codigogrupo='.$album['grupo'].'"><img src="imagenes/lapiz.png" alt="editar"></a>';
                    echo '<a href="grupo.php?codigo='.$album['codigo'].'&accion=borrar&codigogrupo='.$album['grupo'].'"><img src="imagenes/papelera.png" alt="borrar"></a>';
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
            echo '<h2>Edita el album '.($album['titulo']??"").'</h2>';
            $_POST['titulo'] = $album['titulo']??"";
            $_POST['anyo'] = $album['anyo']??"";
            $_POST['formato'] = $album['formato']??"";
            $_POST['fechacompra'] = $album['fechacompra']??"";
            $_POST['precio'] = $album['precio']??"";
            if(!isset($_GET['codigogrupo'])) {
                $_GET['codigogrupo'] = $_POST['codigogrupo'];
            }
            $_POST['codigogrupo'] = $_GET['codigogrupo'];
        } elseif ($formulario == 'crear') {
            echo '<form action="#" method="post">';
            echo '<h2>Añade un nuevo album</h2>';
            if(!isset($_GET['codigogrupo'])) {
                $_GET['codigogrupo'] = $_POST['codigogrupo'];
            }
            $_POST['codigogrupo'] = $_GET['codigogrupo'];
        }

        if ($formulario != 'eliminar') {
        ?>
            <span>      
                <label for="titulo">Título</label>
                <input type="text" name="titulo" placeholder="Título del album" id="titulo" value="<?=$_POST['titulo']??""?>"><br>
            </span>
            <?php if (isset($error['titulo'])) echo $error['titulo'];?>
            <span>
                <label for="anyo">Año</label>
                <input type="number" name="anyo" placeholder="Año" id="anyo" value="<?=$_POST['anyo']??""?>"><br>
            </span>
            <?php if (isset($error['anyo'])) echo $error['anyo'];?>
            <span>
                <label for="formato">Formato</label>
                <input type="text" name="formato" placeholder="Formato" id="formato" value="<?=$_POST['formato']??""?>"><br>
            </span>
            <?php if (isset($error['formato'])) echo $error['formato'];?>
            <span>
                <label for="fechacompra">Fecha de compra</label>
                <input type="date" name="fechacompra" placeholder="Fecha de compra" id="fechacompra" value="<?=$_POST['fechacompra']??""?>"><br>
            </span>
            <?php if (isset($error['fechacompra'])) echo $error['fechacompra'];?>
            <span>
                <label for="precio">Precio</label>
                <input type="text" name="precio" placeholder="Precio" id="precio" value="<?=$_POST['precio']??""?>"><br>
            </span>
            <?php if (isset($error['precio'])) echo $error['precio'];?>
            <span>
                <input type="hidden" name="codigogrupo" id="codigogrupo" value="<?=$_GET['codigogrupo']?>">
            <?php
                if ($formulario == 'editar') {
                    echo '<input type="hidden" name="codigo" value="'.($album['codigo']).'">';
                    echo '<input type="submit" name="confirmar" value="Confirmar">';
                    echo '<a href="grupo.php?codigogrupo='.$_POST['codigogrupo'].'" class="inputamongus">Cancelar</a>';
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