<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 1 - Portafolio</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    
    <!-- Encabezado y menú de navegación entre -->

    <?php
        include("cabecera.inc.php");
    ?>

    <!-- Página principal -->

    <div class="principal">

        <button class="button" id="btn"></button>
        <script>
            const btn = document.getElementById('btn');
            let i = 0;
            const colores = ['orange','blue','grey','wheat','green','yellow']
            btn.addEventListener('click', function onClick(){
                btn.style.backgroundColor = colores[i];
                i = i >= colores.length - 1 ? 0 : i + 1;
            });
        </script>

        <script>
            function audio() {
                var audio = document.getElementById("audio");
                audio.play();
        }
        </script>
        <input type="button" value="jijijaja" onclick="audio()"></button>
        <audio id="audio" src="audio/jijijaja.mp3"></audio>

    </div>



    <!-- Footer, links y teléfono de contacto -->

    <?php
        include("footer.inc.php");
    ?>

</body>