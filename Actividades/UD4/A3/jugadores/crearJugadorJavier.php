<?php
    $errores = true;
    // Utilizamos un if y for each para asegurarnos de la existencia del formulario y eliminar espacios en blanco
    if (!empty($_POST)) {
        foreach ($_POST as $campo => $info) {
            $info = trim($info);
        }
        $errores = false;
        if (empty($_POST['nick'])) {
            $error['nick'] = '<p>El campo nick está vacío</p>';
            $errores = true;
            //nick de solo letras y numeros, 3 o más caracteres
        } elseif (!preg_match('/^[a-zA-Z0-9]{3}/',$_POST['nick'])) {
            $error['nick'] = '<p>El nick introducido no es válido.</p>';
            $errores = true;
        }
        
        if (empty($_POST['pais'])) {
            $errores = true;
            $error['pais'] = '<p>El campo pais está vacío</p>';

            //pais de solo letras, 3 o más caracteres
        } elseif (!preg_match('/^[a-zA-Z]{3}/',$_POST['pais'])) {
            $error['pais'] = '<p>El pais introducido no es válido.</p>';
            $errores = true;
        }

        if (empty($_POST['mail'])) {
            $errores = true;
            $error['mail'] = '<p>El campo mail está vacío</p>';
            // Formato mail alfanumerico + @alfanumerico + . 3 caracteres
        } elseif (!preg_match('/^[a-z_.0-9]+@[a-z]+.[a-z]{2,3}/',$_POST['mail'])) {
            $error['mail'] = '<p>El mail introducido no es válido.</p>';
            $errores = true;
        }

        if (empty($_POST['fecha_nacimiento'])) {
            $errores = true;
            $error['fecha_nacimiento'] = '<p>El campo fecha de nacimiento está vacío</p>';

            // dd/mm/año
        } elseif (!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/',$_POST['fecha_nacimiento'])) {
            $error['fecha_nacimiento'] = '<p>La fecha de nacimiento introducida no es válida.</p>';
            $errores = true;
        }

        if (empty($_POST['monedas'])) {
            $errores = true;
            $error['monedas'] = '<p>El campo monedas está vacío</p>';

            //monedas de solo numeros, 1 o más caracteres
        } elseif (!preg_match('/^[0-9]{1,}/',$_POST['monedas'])) {
            $error['monedas'] = '<p>Las monedas introducidas no son válidas.</p>';
            $errores = true;
        }
    }

    if (!$errores) {
        // Conecta a la base de datos
        $dsn = 'mysql:host=localhost;port=3306;dbname=dungeonsanddragons';
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        $user = 'dad';
        $pass = 'd20';
        try {
            $conexion = new PDO($dsn, $user, $pass, $opciones);
        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Javier Martínez</title>
    <style>
        label, input , p{
            margin: 10px;
        }
        p {
            color: red;
        }
    </style>
</head>
<body>
    <?php
        if ($errores) {
            // Generamos formulario HTML y mostramos los errores
            ?>
            <form action="#" method="post" enctype="multipart/form-data">
                <label for="nick">Nick:</label><br>
                <input type="text" name="nick" id="nick" placeholder="Nick" value="<?=$_POST['nick']??""?>"><br>
                <?php
                    if (isset($error['nick'])) {
                        echo $error['nick'];
                    }
                ?>
                <label for="mail">Mail:</label><br>
                <input type="text" name="mail" id="mail" placeholder="Mail" value="<?=$_POST['mail']??""?>"><br>
                <?php
                    if (isset($error['mail'])) {
                        echo $error['mail'];
                    }
                ?>
                <label for="pais">País:</label><br>
                <input type="text" name="pais" id="pais" placeholder="País" value="<?=$_POST['pais']??""?>"><br>
                <?php
                    if (isset($error['pais'])) {
                        echo $error['pais'];
                    }
                ?>
                <label for="fecha_nacimiento">Fecha de nacimiento:</label><br>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="Fecha de nacimiento" value="<?=$_POST['fecha_nacimiento']??""?>"><br>
                <?php
                    if (isset($error['fecha_nacimiento'])) {
                        echo $error['fecha_nacimiento'];
                    }
                ?>
                <label for="monedas">Monedas:</label><br>
                <input type="number" name="monedas" id="monedas" placeholder="Monedas" value="<?=$_POST['monedas']??""?>"><br>
                <?php
                    if (isset($error['monedas'])) {
                        echo $error['monedas'];
                    }
                ?>
                <input type="submit" value="enviar">
            </form>
            <?php
        }
    ?>
</body>
</html>