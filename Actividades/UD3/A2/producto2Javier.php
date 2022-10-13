<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form productos</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }
        th, td {
            text-align: left;
        }
    </style>
</head>
<body>

    <?php
        
        if (!isset($_POST['codigo'])) {
            $validar = false;
        } else {

            $validar = true;

            if (!preg_match('/^[a-zA-Z0-9]{5}$/',$_POST['codigo'])) {
                echo '<h3>El código introducido es erróneo.</h3>';
                $validar = false;
            }

            if (!preg_match('/^[A-Z][a-zA-Z]{2}/',$_POST['nombre'])) {
                echo '<h3>El nombre introducido es erróneo.</h3>';
                $validar = false;
            }

            if (!preg_match('/^[0-9]{1}$|^[0-9]{1}\.[0-9]{1,2}$/',$_POST['precio'])) {
                echo '<h3>El precio introducido es erróneo.</h3>';
                $validar = false;
            }

            if (!preg_match('/^[a-z0-9]{50}/',$_POST['descripcion'])) {
                echo '<h3>La descripcion introducida es errónea.</h3>';
                $validar = false;
            }

            if (!preg_match('/^[a-z0-9]{10,20}$/',$_POST['fabricante'])) {
                echo '<h3>El fabricante introducido es erróneo.</h3>';
                $validar = false;
            }

            if (!preg_match('/^[0-9]{1}$|^[0-9]{1}\.[0-9]{1,2}$/',$_POST['cantidad'])) {
                echo '<h3>La cantidad introducida es errónea.</h3>';
                $validar = false;
            }

            if (!preg_match('/^(0[1-9]|[12][0-9]|3[01])(\-|\.|\/)(0[1-9]|1[012])(\-|\.|\/)(19[0-9]{2}|20[01][0-9]|202[12])$/',$_POST['fecha'])) {
                echo '<h3>La fecha introducida es errónea.</h3>';
                $validar = false;
            }


        }
    ?>
    <form action="#" method="POST">

        <label for="codigo">Código:</label><br>
        <input name="codigo" id="codigo"><br>

        <label for="nombre">Nombre:</label><br>
        <input type="text" name="nombre" id="nombre"><br>
    
        <label for="precio">Precio:</label><br>
        <input type="text" name="precio" id="precio"><br>
    
        <label for="descripcion">Descripción:</label><br>
        <textarea name="descripcion" id="descripcion"></textarea><br>
    
        <label for="fabricante">Fabricante:</label><br>
        <input type="text" name="fabricante" id="fabricante"><br>
    
        <label for="cantidad">Cantidad:</label><br>
        <input type="number" name="cantidad" id="cantidad"><br>
    
        <label for="fecha">Fecha de adquisición:</label><br>
        <input type="text" name="fecha" id="fecha"><br>
    
        <input type="submit">

    </form>

    <?php
        if ($validar) {
            $_POST['precio'] .= "€";
            $_POST['cantidad'] .= " unidades";
    
            echo '<table>';
            foreach ($_POST as $dato => $value) {
                echo '<tr><th>'.ucfirst($dato).'</th><td>'.$value.'</td></tr>';
            }
            echo '</table>';
        }
    ?>
</body>
</html>