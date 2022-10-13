<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos producto</title>
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

        $_GET['precio'] .= "€";
        $_GET['cantidad'] .= " unidades";

        echo '<table>';
        foreach ($_GET as $dato => $value) {
            echo '<tr><th>'.ucfirst($dato).'</th><td>'.$value.'</td></tr>';
        }
        echo '</table>';
        
    ?>
</body>
</html>