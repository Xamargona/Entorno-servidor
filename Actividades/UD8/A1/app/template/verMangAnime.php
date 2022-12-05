<?php ob_start() ?>
<h1><?=strtoupper($params['nombre']) ?></h1>

<?php if($params['imagen']!='') :?>
	<img src="img/portadas/<?=$params['imagen']?>" alt="foto de <?=$params['nombre']?>" class="portada">
<?php endif; ?>

<table class="infomanga">
	<tr>
		<td>Energia</td>
		<td><?=$params['nombre'] ?></td>
	</tr>

	<tr>
		<td>Creador</td>
		<td><?=$params['creador']?></td>
	</tr>

	<tr>
		<td>Género</td>
		<td><?=$params['genero']?></td>
	</tr>

	<tr>
		<td>Demografía</td>
		<td><?=$params['demografia']?></td>
	</tr>

	<tr>
		<td>Estreno</td>
		<td><?=$params['estreno']?></td>
	</tr>

	<tr>
		<td>fin</td>
		<td><?=$params['fin']?></td>
	</tr>

	<tr>
		<td>tomos</td>
		<td><?=$params['tomos']?></td>
	</tr>

	<tr>
		<td>Capítulos</td>
		<td><?=$params['capitulos']?></td>
	</tr>
</table>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>