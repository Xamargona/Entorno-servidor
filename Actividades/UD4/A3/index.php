<?php
    if (isset($_GET['accion'])) {
        if ($_GET['accion'] == 'editar') {
            $formulario = 'editar';
        }
        if ($_GET['accion'] == 'borrar') {
        }
    } else {
        $formulario = 'crear';
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
        // Formularios 
        if ($formulario == 'crear') {
            ?>
            <form action="#" method="post">
            <h2>Añade un nuevo grupo</h2>
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
                    <input type="submit" value="Añadir">
                </span>
            </form>
            <?php
        } elseif ($formulario == 'editar') {
            require 'includes/dsn.inc.php';
            $resultado = $conexion->query('SELECT * FROM grupos WHERE codigo = '.$_GET['codigo']);
            $grupo = $resultado->fetch();
            ?>
            <form action="#" method="post">
            <h2>Edita el grupo <?=$grupo['nombre']??""?></h2>
                <span>    
                <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" placeholder="Nombre del grupo" id="nombre" value="<?=$grupo['nombre']??""?>"><br>
                </span>
                <span>
                    <label for="genero">Género:</label>
                    <input type="text" name="genero" placeholder="Género" id="genero" value="<?=$grupo['genero']??""?>"><br>
                </span>
                <span>
                    <label for="pais">País:</label>
                    <input type="text" name="pais" placeholder="País" id="pais" value="<?=$grupo['pais']??""?>"><br>
                </span>
                <span>
                    <label for="inicio">Año de inicio:</label>
                    <input type="number" name="inicio" placeholder="Año de inicio" id="inicio" value="<?=$grupo['inicio']??""?>"><br>
                </span>
                <span>
                    <input type="submit" value="Añadir">
                    <input type="reset" value="Cancelar">
                </span>
            </form>
            <?php
            unset($conexion);
            unset($resultado);
        }
    ?>
</body>
</html>