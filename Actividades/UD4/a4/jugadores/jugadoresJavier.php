<?php
    // Creamos una conexión con la base de datos
    $dsn = 'mysql:host=localhost;port=3306;dbname=dungeonsanddragons';
    $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    $user = 'dad';
    $pass = 'd20';
    try {
        $conexion = new PDO($dsn, $user, $pass, $opciones);
    } catch (PDOException $e) {
        echo 'Falló la conexión: ' . $e->getMessage();
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
        a {
            margin: 10px;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 15px;
        }
    </style>
</head>
<body>
    <a href="crearJugadorJavier.php">Crear Jugador</a>
    <?php
        // Realizamos una consulta a la base de datos para obtener los datos de los jugadores y lo mostramos en formato tabla para una mejor visualización
        $resultado = $conexion->query('SELECT * FROM jugadores');
        echo '<table style="border:1px solid black; border-collapse: collapse;">';
        echo '<tr><th>Nick</th><th>Mail</th><th>País</th><th>Fecha de Nacimiento</th><th>Monedas</th>';
        while ($jugador = $resultado->fetch()) {
            echo '<tr>';
            echo '<td>' . $jugador['nick'] . '</td>';
            echo '<td>' . $jugador['mail'] . '</td>';
            echo '<td>' . $jugador['pais'] . '</td>';
            echo '<td>' . $jugador['fechanacimiento'] . '</td>';
            echo '<td>' . $jugador['monedas'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    ?>
</body>
</html>