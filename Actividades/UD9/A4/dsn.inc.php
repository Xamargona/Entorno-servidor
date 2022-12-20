<?php
$dsn = 'mysql:host=localhost;port=3306;dbname=pokemon';
$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$user = 'Ash';
$pass = 'pikachu';
try {
    $conexion = new PDO($dsn, $user, $pass, $opciones);
} catch (PDOException $e) {
    echo 'Falló la conexión: ' . $e->getMessage();
}