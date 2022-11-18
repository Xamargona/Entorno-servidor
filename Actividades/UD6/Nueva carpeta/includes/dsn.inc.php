<?php
$dsn = 'mysql:host=localhost;port=3306;dbname=tiendamercha';
$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$user = 'Lumos';
$pass = 'Nox';
try {
    $conexion = new PDO($dsn, $user, $pass, $opciones);
} catch (PDOException $e) {
    echo 'Falló la conexión: ' . $e->getMessage();
}