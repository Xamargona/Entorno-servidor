<?php ob_start() ?>
<table>
	<tr>
		<th>Nombre</th>
		<th>Creador</th>
		<th>Género</th>
		<th>Demografía</th>
		<th>Fecha de estreno</th>
		<th>Fecha de finalización</th>
		<th>Cantidad de tomos</th>
		<th>Cantidad de capítulos</th>
	</tr>	
	<?php foreach ($params['manganimes'] as $manganime) :?>
		<tr>
			<td><a href="index.php?accion=ver&id=<?=$manganime['id']?>"><?=$manganime['nombre'] ?></a></td>
			<td><?=$manganime['creador']?></td>
			<td><?=$manganime['genero']?></td>
			<td><?=$manganime['demografia']?></td>
			<td><?=$manganime['estreno']?></td>
			<td><?=$manganime['fin']?></td>
			<td><?=$manganime['tomos']?></td>
			<td><?=$manganime['capitulos']?></td>
		</tr>
	<?php endforeach; ?>
</table>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>