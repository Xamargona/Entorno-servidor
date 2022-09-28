<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 7</title>
    <style>
        table, th, td {
            border: 1px solid black;
            text-align: center;
            border-collapse: collapse;
            padding: 15px;
        }
    </style>
</head>
<body>
    <table>
        <?php
            $personas = [ ['nombre'=>'Aitor',
                        'altura'=>182,
                        'email'=>'aitor@correo.com'],
                        ['nombre'=>'Paula',
                        'altura'=>175,
                        'email'=>'Pauli@correo.com'],
                        ['nombre'=>'Isma',
                        'altura'=>180,
                        'email'=>'Isma@correo.com'],
                        ['nombre'=>'Arthur',
                        'altura'=>140,
                        'email'=>'minimois@correo.com'],
                        ['nombre'=>'Random5',
                        'altura'=>160,
                        'email'=>'random5@correo.com'],
                        ['nombre'=>'Silvia',
                        'altura'=>165,
                        'email'=>'Sil@correo.com'],
                        ]; 
        ?>
        <tr>
            <th>Nombre</th>
            <th>Altura</th>
            <th>Email</th>
        </tr>
        <?php
            foreach ($personas as $persona) {
                echo '<tr>';
                foreach ($persona as $dato => $value) {
                    echo '<td>'.$value.'</td>';
                }
                echo '</tr>';
            }
        ?>
    </table>
</body>
</html>