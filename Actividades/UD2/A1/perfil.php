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

    <!-- Página perfil -->

    <section>
        <p><strong>Nombre:</strong> Javier</p>
        <p><strong>Apellidos:</strong> Martínez González</p>
        <p><strong>Fecha de nacimiento:</strong> 14/02/2002</p>
        <p><strong>Domicilio:</strong> Cadira, Vlc</p>
        <p><strong>Información adicional:</strong> Estudiante de DAW, acuario, con perre y hermano</p>
        <div class="imagenes_perfil">
            <img src="imagenes/Perre.jpg" alt="Perre">
            <img src="imagenes/las viejas 2.jpg" alt="las viejas">
            <img src="imagenes/las viejas.jpg" alt="las viejas de verdad">
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <div class="extra">
            <p >Parece que te has pasado bajando ¡vuelve arriba!</p> <a href="#top"><img src="imagenes/flecha.png" alt="flecha"></a>
        </div>
    </section>


    <!-- Footer, links y teléfono de contacto -->

    <?php
        include("footer.inc.php");
    ?>

</body>