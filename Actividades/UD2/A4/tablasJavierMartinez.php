<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 4</title>
    <style>
        table, th, td {
            border: 1px solid black;
            text-align: center;
        }

        tr:nth-child(odd) {
            background-color:lightgreen;
        }

        tr:nth-child(even) {
            background-color:papayawhip;
        }
        tr:first-child{
            background-color:aqua;
        }
        td:first-child{
            background-color:aqua;
        }
        tr:first-child td:first-child{
            background-color: red;
        }
    </style>
</head>
<body>
    <section>
        <table>
            <?php
                for ($i=1; $i < 11; $i++) { 
                    echo '<tr>';
                    if ($i == 1) {
                        echo '<td>x</td>';
                        for ($j=1; $j < 11; $j++) { 
                            echo '<td>'.$j.'</td>';
                        }   
                        echo '</tr>';
                        echo '<tr>';                 
                    }
                    echo '<td>'.$i.'</td>';
                    for ($j=1; $j < 11; $j++) { 
                        echo '<td>'.$i*$j.'</td>';
                    }
                    echo '</tr>';
                }
            ?>
        </table>
    </section>
</body>
</html>