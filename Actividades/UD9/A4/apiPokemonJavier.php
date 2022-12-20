<?php
/*
    include_once 'dsn.inc.php';
    $cadena = $_GET['cadena'];

    if (isset($cadena) && $cadena == 'pokemon' && isset($_GET['numero'])) {

        $numero = $_GET['numero'];
        $consulta = $conexion->prepare('SELECT * FROM pokemon WHERE numero_pokedex = :numero');
        $consulta->bindParam(':numero', $numero);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

    } else if (isset($cadena) && $cadena == 'tipo' && isset($_GET['tipo'])) {

        $tipo = $_GET['tipo'];
        $consulta = $conexion->prepare('SELECT * FROM pokemon_tipo WHERE id_tipo = (SELECT id_tipo FROM tipo WHERE nombre = :tipo)');
        $consulta->bindParam(':tipo', $tipo);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

    }
    
    if (isset($resultado) && !empty($resultado)) {
        header('Content-Type: application/json');
        echo json_encode($resultado);
    } else {
        echo 'No se ha encontrado ningún resultado';
    }
*/

    try {
        include_once 'dsn.inc.php';
        $cadena = $_GET['cadena'];

        if (isset($_GET['numero'])) {
            $numero = $_GET['numero'];
            // selecciona la informacion de la tabla pokemon y el tipo de la tabla tipo

            $consulta = $conexion->prepare('SELECT * FROM pokemon WHERE numero_pokedex = :numero INNER JOIN pokemon_tipo ON pokemon.numero_pokedex = pokemon_tipo.numero_pokedex INNER JOIN tipo ON pokemon_tipo.id_tipo = tipo.id_tipo');   
            $consulta->bindParam(':numero', $numero);
            $consulta->execute();

            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC) + $consulta2->fetchAll(PDO::FETCH_ASSOC);

        } else if (isset($_GET['tipo'])) {
            $tipo = $_GET['tipo'];
            $consulta = $conexion->prepare('SELECT * FROM pokemon_tipo WHERE id_tipo = (SELECT id_tipo FROM tipo WHERE nombre = :tipo)');
            $consulta->bindParam(':tipo', $tipo);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (Exception $e) {
        echo 'Ha ocurrido un error: ' . $e->getMessage();
        echo 'No se ha encontrado ningún resultado con los parámetros recibidos';
    }

    if (isset($resultado) && !empty($resultado)) {
        header('Content-Type: application/json');
        echo json_encode($resultado);
    }
?>