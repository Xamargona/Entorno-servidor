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

    <!-- Página CV -->

    <div class="titulo_exp_section"><h2>Experiencia</h2></div>

    <article class="caja_conocimientos">
        <section class="exp_section">
            <h2>Conocimientos</h2>
            <ul>
                <li><p><strong>Java:</strong> nv 8 / 10</p></li>
                <li><p><strong>C++:</strong> nv 5 / 10</p></li>
                <li><p><strong>SQL:</strong> nv ? / 10</p></li>
                <li><p><strong>JavaScript:</strong> ERROR 404</p></li>
                <li><p><strong>Html:</strong> nv 10 / 50</p></li>
                <li><p><strong>Python:</strong> nv 6 / 10</p></li>
                <li><p><strong>Github:</strong> nv 7 / 10</p></li>
                <li><p><strong>Inglés:</strong> nv B2 / C2</p></li>
            </ul>
        </section>
        <section class="exp_laboral">
            <h2>Experiencia laboral</h2>
            <p>Empleado en funciones diversas cara al público: Empleado del burger</p>
            <div class="tenor-gif-embed" data-postid="24043549" data-share-method="host" data-aspect-ratio="1.00629" data-width="85%">
                <a href="https://tenor.com/view/angry-birds-real-angry-birds-angry-birds-gif-24043549">Angry Birds Real Angry GIF</a>
            </div> 
            <script type="text/javascript" async src="https://tenor.com/embed.js"></script>
        </section>
        <section class="formacion">
            <h2>Formación</h2>
            <ul>
                <li><p>Bachillerato ciéntifico técnico, Florida Secundaria, Catarroja</p></li>
                <li><p>Grado Superior en Desarrollo de Aplicaciones Web, en proceso</p></li>
                <li><p>Titulación en manejo de Word</p></li>
            </ul>
        </section>
    </article>
    
    <!-- Footer, links y teléfono de contacto -->

    <?php
        include("footer.inc.php");
    ?>

</body>