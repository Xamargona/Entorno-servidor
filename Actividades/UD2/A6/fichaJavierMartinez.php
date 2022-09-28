<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 5</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 15px;   
        }
    </style>
</head>
<body>
    <table>
        <?php
            $ficha['Nombre'] = 'Juan';
            $ficha['Apellidos'] = 'Granizo Perdido';
            $ficha['Email'] = 'Juannogenerico@gmail.com';
            $ficha['Fecha de nacimiento'] = '11 de marzo de 1998';
            $ficha['Teléfono'] = '654 332 111';
            foreach ($ficha as $key => $value) {
                echo '<tr><td>'.$key.'</td><td>'.$value.'</td></tr>';
            }
        ?>
    </table>
</body>
</html>