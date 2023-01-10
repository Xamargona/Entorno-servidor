<?php ob_start() ?>
<h1><?=strtoupper($params['resultado']['nombre']) ?></h1>
<?php if($params['resultado']['imagen']!='') :?>
	<img src="img/portadas/<?=$params['resultado']['imagen']?>" alt="foto de <?=$params['resultado']['nombre']?>" class="portada">
<?php endif; ?>

<table class="infomanga">
	<tr>
		<td>Energia</td>
		<td><?=$params['resultado']['nombre'] ?></td>
	</tr>

	<tr>
		<td>Creador</td>
		<td><?=$params['resultado']['creador']?></td>
	</tr>

	<tr>
		<td>Género</td>
		<td><?=$params['resultado']['genero']?></td>
	</tr>

	<tr>
		<td>Demografía</td>
		<td><?=$params['resultado']['demografia']?></td>
	</tr>

	<tr>
		<td>Estreno</td>
		<td><?=$params['resultado']['estreno']?></td>
	</tr>

	<tr>
		<td>fin</td>
		<td><?=$params['resultado']['fin']?></td>
	</tr>

	<tr>
		<td>tomos</td>
		<td><?=$params['resultado']['tomos']?></td>
	</tr>

	<tr>
		<td>Capítulos</td>
		<td><?=$params['resultado']['capitulos']?></td>
	</tr>
</table>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>