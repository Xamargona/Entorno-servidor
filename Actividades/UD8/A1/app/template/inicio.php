<?php ob_start() ?>

<h1>Inicio</h1>
Fecha: <?=$params['fecha']?>
<p><?=$params['mensaje']?></p>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>