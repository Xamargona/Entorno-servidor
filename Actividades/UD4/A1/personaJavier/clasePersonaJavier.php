<?php
    require_once("include/personas.inc.php");
    require_once("include/Persona.inc.php");
    /*Creamos un array que contiene objetos persona con la información proporcionada*/
    foreach ($personas as $persona) {
        $agenda[] = new Persona($persona['idContacto'], $persona['nombre'], $persona['apellido1'], $persona['apellido2'], $persona['telefono']);
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Javier Martínez González</title>
</head>
<body>
    <?php
        foreach ($agenda as $persona) {
            echo "<div>".$persona."</div><br>";
        }
    ?>
</body>
</html>