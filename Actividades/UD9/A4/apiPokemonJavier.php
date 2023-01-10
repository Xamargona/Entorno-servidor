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

            $consulta = $conexion->prepare('SELECT p.nombre AS Nombre, p.numero_pokedex AS Numero, p.peso AS Peso, p.altura AS Altura, t.nombre AS Tipo FROM pokemon p INNER JOIN pokemon_tipo pt ON pt.numero_pokedex = p.numero_pokedex INNER JOIN tipo t ON t.id_tipo = pt.id_tipo WHERE p.numero_pokedex = :numero');
            $consulta->bindParam(':numero', $numero);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

            if (empty($resultado)) {
                throw new Exception('No se ha encontrado ningún resultado con los parámetros recibidos.');
            }

        } else if (isset($_GET['tipo'])) {
            $tipo = $_GET['tipo'];
            $consulta = $conexion->prepare('SELECT p.nombre AS Nombre, p.numero_pokedex AS Numero FROM pokemon p INNER JOIN pokemon_tipo pt ON pt.numero_pokedex = p.numero_pokedex INNER JOIN tipo t ON t.id_tipo = pt.id_tipo WHERE t.nombre = :tipo');
            $consulta->bindParam(':tipo', $tipo);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            if (empty($resultado)) {
                throw new Exception('No se ha encontrado ningún resultado con los parámetros recibidos.');
            }
            echo 'Pokemon tipo ' . $tipo;
        }
    } catch (Exception $e) {
        echo 'Ha ocurrido un error: ' . $e->getMessage();
    }

    unset($conexion);
    unset($consulta);

    if (isset($resultado) && !empty($resultado)) {
        header('Content-Type: application/json');
        echo json_encode($resultado);
    }
?>