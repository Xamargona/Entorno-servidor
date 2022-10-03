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
    
    <!-- Página Hobbies -->

    <section class="section_hobbies">
        <h2>Hobbies</h2>
        <div class="caja_hobbies">
            <a href="https://euw.op.gg/summoners/euw/Xamargó"><img src="imagenes/ligolegen.webp" alt="ligoleyen"></a>
            <a href="https://www.brandonsanderson.com/books-and-art/#cosmere"><img src="imagenes/libro.jpg" alt="librito"></a>
            <a href="https://es.wikipedia.org/wiki/Isabel_II_del_Reino_Unido"><img src="imagenes/memes.jpg" alt="meme"></a>
            <a href="https://youtu.be/jfKfPfyJRdk"><img src="imagenes/procrastinar icon.webp" alt="khe" class="img_procrastinar"></a>
            <a href="https://youtu.be/_0GGLILyOM4"><img src="imagenes/icono series.png" alt="series"></a>
        </div>
        <h4>Toda la información a un click</h4>
    </section>

    <!-- Footer, links y teléfono de contacto -->

    <?php
        include("footer.inc.php");
    ?>

</body>