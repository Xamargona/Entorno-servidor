<?php
    $errores = true;
    if (!empty($_POST)) {
        foreach ($_POST as $campo => $info) {
            $info = trim($info);
        }
        $errores = false;
        if (empty($_POST['usuario'])) {
            $error['usuario'] = '<p>El campo usuario está vacío</p>';
            $errores = true;
            //Usuario de solo letras, 3 o más caracteres
        } elseif (!preg_match('/^[a-zA-Z]{3}/',$_POST['usuario'])) {
            $error['usuario'] = '<p>El usuario introducido no es válido.</p>';
            $errores = true;
        }
        
        if (empty($_POST['nombre'])) {
            $errores = true;
            $error['nombre'] = '<p>El campo nombre está vacío</p>';

            //Nombre de solo letras, 3 o más caracteres
        } elseif (!preg_match('/^[a-zA-Z]{3}/',$_POST['nombre'])) {
            $error['nombre'] = '<p>El nombre introducido no es válido.</p>';
            $errores = true;
        }

        if (empty($_POST['apellidos'])) {
            $errores = true;
            $error['apellidos'] = '<p>El campo apellidos está vacío</p>';

            //Dos palabras, solo letras, 3 o más caracteres cada una, separdas por espacio
        } elseif (!preg_match('/^[a-zA-Z]{3,}\s[a-zA-z]{3,}$/',$_POST['apellidos'])) {
            $error['apellidos'] = '<p>Los apellidos introducidos no son válidos.</p>';
            $errores = true;
        }

        if (empty($_POST['dni'])) {
            $errores = true;
            $error['dni'] = '<p>El campo DNI está vacío</p>';

            // Formato DNI 7u8 numeros + letra
        } elseif (!preg_match('/^\d{7,8}\w{1}$/',$_POST['dni'])) {
            $error['dni'] = '<p>El DNI introducido no es válido.</p>';
            $errores = true;

            // Verificación DNI existente
        } else {
            $letras = ["T", "R", "W", "A", "G", "M", "Y", "F", "P", "D", "X", "B", "N", "J", "Z", "S", "Q", "V", "H", "L", "C", "K", "E"];

            $num_dni = substr($_POST['dni'], 0, (strlen($_POST['dni'])-1));

            $letra_dni = substr($_POST['dni'], (strlen($_POST['dni'])-1), strlen($_POST['dni']));

            $num_dni = intval($num_dni);
            $letra_dni = strtoupper($letra_dni);

            if ($letras[$num_dni%23] != $letra_dni) {
                $error['dni'] = '<p>El DNI introducido no existe.</p>';
                $errores = true;
            }
        }

        if (empty($_POST['direccion'])) {
            $errores = true;
            $error['direccion'] = '<p>El campo dirección está vacío</p>';

            // Cadena de 8 o más caracteres con espacios en blanco; ha de terminar en uno o más números
        } elseif (!preg_match('/^\D{8,}\d{1,}$/',$_POST['direccion'])) {
            $error['direccion'] = '<p>La dirección introducida no es válida.</p>';
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

        if (empty($_POST['tlf'])) {
            $errores = true;
            $error['tlf'] = '<p>El campo teléfono está vacío</p>';

            // Formato numérico de 9 caracteres
        } elseif (!preg_match('/^[0-9]{9}$/',$_POST['tlf'])) {
            $error['tlf'] = '<p>El teléfono introducido no es válido.</p>';
            $errores = true;
        }

        if (empty($_POST['fecha_nacimiento'])) {
            $errores = true;
            $error['fecha_nacimiento'] = '<p>El campo fecha de nacimiento está vacío</p>';

            // dd/mm/año
        } elseif (!preg_match('/^(0[1-9]|[12][0-9]|3[01])(\-|\.|\/)(0[1-9]|1[012])(\-|\.|\/)(19[0-9]{2}|20[01][0-9]|202[12])$/',$_POST['fecha_nacimiento'])) {
            $error['fecha_nacimiento'] = '<p>La fecha de nacimiento introducida no es válida.</p>';
            $errores = true;
        }
    } 
    if ($errores) {
        ?>
        <form action="#" method="post">
            <label for="usuario">Usuario:</label><br>
            <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?=$_POST['usuario']??""?>"><br>
            <?php
                if (isset($error['usuario'])) {
                    echo $error['usuario'];
                }
            ?>
            <label for="nombre">Nombre:</label><br>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?=$_POST['nombre']??""?>"><br>
            <?php
                if (isset($error['nombre'])) {
                    echo $error['nombre'];
                }
            ?>
            <label for="apellidos">Apellidos:</label><br>
            <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos" value="<?=$_POST['apellidos']??""?>"><br>
            <?php
                if (isset($error['apellidos'])) {
                    echo $error['apellidos'];
                }
            ?>
            <label for="dni">DNI:</label><br>
            <input type="text" name="dni" id="dni" placeholder="DNI" value="<?=$_POST['dni']??""?>"><br>
            <?php
                if (isset($error['dni'])) {
                    echo $error['dni'];
                }
            ?>
            <label for="direccion">Dirección:</label><br>
            <input type="text" name="direccion" id="direccion" placeholder="Dirección" value="<?=$_POST['direccion']??""?>"><br>
            <?php
                if (isset($error['direccion'])) {
                    echo $error['direccion'];
                }
            ?>
            <label for="mail">Mail:</label><br>
            <input type="text" name="mail" id="mail" placeholder="Mail" value="<?=$_POST['mail']??""?>"><br>
            <?php
                if (isset($error['mail'])) {
                    echo $error['mail'];
                }
            ?>
            <label for="tlf">Teléfono:</label><br>
            <input type="number" name="tlf" id="tlf" placeholder="Teléfono" value="<?=$_POST['tlf']??""?>"><br>
            <?php
                if (isset($error['tlf'])) {
                    echo $error['tlf'];
                }
            ?>
            <label for="fecah_nacimiento">Fecha de nacimiento:</label><br>
            <input type="text" name="fecha_nacimiento" id="fecha_nacimiento" placeholder="Fecha de nacimiento" value="<?=$_POST['fecha_nacimiento']??""?>"><br>
            <?php
                if (isset($error['fecha_nacimiento'])) {
                    echo $error['fecha_nacimiento'];
                }
            ?>
            <input type="submit">
        </form>
        <?php
    } else {
        echo '<p>La solicitud se ha realizado correctamente.</p>';
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form productos</title>
    <style>
        label, input {
            margin: 4px;
        }
    </style>
</head>
<body>
</body>
</html>