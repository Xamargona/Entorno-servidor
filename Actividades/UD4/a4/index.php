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
            $error['nombre'] = '<p id="error">El campo nombre está vacío</p>';
        } elseif (!preg_match('/^[a-zA-ZñÑ\s]{1,50}$/',$_POST['nombre'])) {
            $error['nombre'] = '<p id="error">El nombre introducido no es válido.</p>';
            $errores = true;
        }
        // Genero
        if (empty($_POST['genero'])) {
            $errores = true;
            $error['genero'] = '<p id="error">El campo género está vacío</p>';
        } elseif (!preg_match('/^[a-zA-ZñÑ\s]{1,20}$/',$_POST['genero'])) {
            $error['genero'] = '<p id="error">El género introducido no es válido.</p>';
            $errores = true;
        }
        // País
        if (empty($_POST['pais'])) {
            $errores = true;
            $error['pais'] = '<p id="error">El campo país está vacío</p>';
        } elseif (!preg_match('/^[a-zA-ZñÑ\s]{1,20}$/',$_POST['pais'])) {
            $error['pais'] = '<p id="error">El país introducido no es válido.</p>';
            $errores = true;
        }
        // Inicio
        if (empty($_POST['inicio'])) {
            $errores = true;
            $error['inicio'] = '<p id="error">El campo inicio está vacío</p>';
        } elseif (!preg_match('/^[0-9]{1,11}/',$_POST['inicio'])) {
            $error['inicio'] = '<p id="error">La fecha de inicio introducida no es válida.</p>';
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
                $consulta = $conexion->prepare('UPDATE grupos SET nombre = :nombre, genero = :genero, pais = :pais, inicio = :inicio WHERE codigo = '.($_POST['codigo']).';');
                // Convertimos el valor edl formulario en el del grupo a editar
                $consulta->bindParam(':nombre', $_POST['nombre']);
                $consulta->bindParam(':genero', $_POST['genero']);
                $consulta->bindParam(':pais', $_POST['pais']);
                $consulta->bindParam(':inicio', $_POST['inicio']);
                $consulta->execute();
                unset($conexion);
                header('Location: index.php');
            }
        }
        if ($_GET['accion'] == 'borrar') {
            $formulario = 'eliminar';
                // Confirmamos borrado con segunda variable
                if (isset($_GET['opcion'])){
                    if ($_GET['opcion'] === 'eliminarDefinitivamente') {
                        // Conecta a la base de datos
                        require 'includes/dsn.inc.php';
                        // Preparamos la consulta para posteriormente eliminar el grupo
                        $consulta = $conexion->prepare('DELETE FROM grupos WHERE codigo = '.($_GET['codigo']).';');
                        $consulta->execute();
                        unset($conexion);
                        header('Location: index.php');
                    } else {
                        header('Location: index.php');
                    }
                }
        }
    } else {
        $formulario = 'crear';
        if (!$errores) {
            // Conecta a la base de datos
            require 'includes/dsn.inc.php';
            // Preparamos la consulta para posteriormente insertar los valores
            $consulta = $conexion->prepare('INSERT INTO grupos (nombre, genero, pais, inicio) VALUES (?,?,?,?);');
            $consulta->bindParam(1, $_POST['nombre']);
            $consulta->bindParam(2, $_POST['genero']);
            $consulta->bindParam(3, $_POST['pais']);
            $consulta->bindParam(4, $_POST['inicio']);
            $consulta->execute();
            unset($conexion);
            header('Location: index.php');
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
        // Comprobamos si el usuario esta eliminando un grupo y si es asi mostramos un mensaje de confirmación
        if ($formulario == 'eliminar') {
            require 'includes/dsn.inc.php';
            $resultado = $conexion->query('SELECT * FROM grupos WHERE codigo = '.$_GET['codigo']);
            $grupo = $resultado->fetch();
            unset($conexion);
            unset($resultado);
            ?>
            <div class="alineado">
                <div class="contenedor_aviso">
                    <input type="hidden" name="codigo" value="<?$grupo['codigo']?>">
                    <h3 id="warning">¿Estás seguro de que quieres eliminar el grupo <?=$grupo['nombre']?>?</h3>
                    <a href="index.php?codigo=<?=$grupo['codigo']?>&accion=borrar&opcion=eliminarDefinitivamente">Eliminar</a>
                    <a href="index.php?codigo=<?=$grupo['codigo']?>&accion=borrar&opcion=cancelar">Cancelar</a>
                </div>
            </div>
            <?php
        }
    ?>
    <!-- Título de la sección -->
    <div id="caja_titulo">
        <img src="imagenes/disco.png" alt="disco">
        <h2 class="titulo_seccion">Grupos</h2>
    </div>

    <ol>
        <?php
            // Lista con cada grupo
            require 'includes/dsn.inc.php';
            $resultado = $conexion->query('SELECT * FROM grupos');
            // Se muestran los datos de los grupos 
            // Mandamos el codigo del grupo mediante codigogrupo
            while ($grupo = $resultado->fetch()) {
                echo '<li>';
                    echo '<a id="grupos" href="grupo.php?codigogrupo='.$grupo['codigo'].'">'.$grupo['nombre'].'</a>';
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

        if ($formulario == 'editar') {
            echo '<form action="#" method="post">';
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

        } elseif ($formulario == 'crear') {
            echo '<form action="#" method="post">';
            echo '<h2>Añade un nuevo grupo</h2>';
        }

        if ($formulario != 'eliminar') {
        ?>
            <span>      
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" placeholder="Nombre del grupo" id="nombre" value="<?=$_POST['nombre']??""?>"><br>
            </span>
            <?php if (isset($error['nombre'])) echo $error['nombre'];?>
            <span>
                <label for="genero">Género</label>
                <input type="text" name="genero" placeholder="Género" id="genero" value="<?=$_POST['genero']??""?>"><br>
            </span>
            <?php if (isset($error['genero'])) echo $error['genero'];?>
            <span>
                <label for="pais">País</label>
                <input type="text" name="pais" placeholder="País" id="pais" value="<?=$_POST['pais']??""?>"><br>
            </span>
            <?php if (isset($error['pais'])) echo $error['pais'];?>
            <span>
                <label for="inicio">Año de inicio</label>
                <input type="number" name="inicio" placeholder="Año de inicio" id="inicio" value="<?=$_POST['inicio']??""?>"><br>
            </span>
            <?php if (isset($error['inicio'])) echo $error['inicio'];?>
            <span>
            <?php
                if ($formulario == 'editar') {
                    echo '<input type="hidden" name="codigo" value="'.($grupo['codigo']).'">';
                    echo '<input type="submit" name="confirmar" value="Confirmar">';
                    echo '<a href="index.php" class="inputamongus">Cancelar</a>';
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