<?php ob_start() ?>
<form name="formBusqueda" action="index.php?accion=buscarPorNombre" method="post">
	<label for="nombre">Nombre del MangAnime:</label>
	<input type="text" name="nombre" id="nombre" value="<?=$params['nombre']?>">

	<input type="submit" value="buscar">
</form>

<?php if (count($params['resultado'])>0): ?>
	<table>
		<tr>
			<th>Nombre</th>
			<th>Creador</th>
			<th>Género</th>
			<th>Demografía</th>
			<th>
				Fecha de estreno
				<a href="index.php?accion=buscarPorNombre&nombre=<?=$params['nombre']?>&order=estreno&by=asc"><img src="img/interfaz/asc.png" alt="orden ascendiente" class="imgorden"></a>
				<a href="index.php?accion=buscarPorNombre&nombre=<?=$params['nombre']?>&order=estreno&by=desc"><img src="img/interfaz/desc.png" alt="orden descendiente" class="imgorden"></a>
			</th>
			<th>Fecha de finalización</th>
			<th>Cantidad de tomos</th>
			<th>Cantidad de capítulos</th>
		</tr>

		<?php foreach ($params['resultado'] as $manganime) :?>
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
<?php else: ?>
	<p>No se han encontrado resultados.</p>
<?php endif; ?>
	

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>