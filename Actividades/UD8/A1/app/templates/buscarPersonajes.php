<?php ob_start() ?>
<form name="formBusqueda" action="index.php?accion=buscarPersonajes" method="post">
	<label for="nombre">Nombre del Personaje:</label>
	<input type="text" name="nombre" id="nombre" value="<?=$params['nombre']?>">

	<input type="submit" value="buscar">
</form>

<?php if(isset($params['personajes'])) { 
	if (count($params['personajes'])>0): ?>
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
<?php else: ?>
	<p>No se han encontrado resultados.</p>
<?php endif; }?>
	

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>