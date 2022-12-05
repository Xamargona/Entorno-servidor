<?php ob_start() ?>

<h1>Error 404</h1>

<p><?=$params['mensaje']?></p>
<img src="img/interfaz/404.png" alt="Enlace roto" class="enlaceroto">

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>