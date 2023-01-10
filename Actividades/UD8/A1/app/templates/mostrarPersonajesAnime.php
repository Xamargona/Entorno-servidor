<?php ob_start() ?>
<table>
	<tr>
		<th>Nombre</th>
		<th>Descripción</th>
		<th>Edad</th>
		<th>Manganime</th>
	</tr>	
	<?php foreach ($params['personajes'] as $personaje) :?>
		<tr>
			<td><?=$personaje['nombre'] ?></td>
			<td><?=$personaje['descripcion']?></td>
			<td><?=$personaje['edad']??'?'?></td>
			<td><?=$personaje['manganime']['nombre'] ?></td>
		</tr>
	<?php endforeach; ?>
</table>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>