<?php ob_start() ?>
<?php if(isset($params['mensaje'])) :?>
	<div class="mensaje"><?=$params['mensaje']?></div>
<?php endif; ?>

<form name="formInsertar" action="index.php?accion=insertar" method="post">
	<label for="nombre">Nombre</label>
	<input type="text" name="nombre" id="nombre" value="<?=$params['nombre']?>">
	
	<label for="creador">Creador</label>
	<input type="text" name="creador" id="creador" value="<?=$params['creador']?>">
	
	<label for="genero">Género</label>
	<input type="text" name="genero" id="genero" value="<?=$params['genero']?>">
	
	<label for="demografia">Demografía</label>
	<select name="demografia" id="demografia">
		<?php foreach(['Kodomo', 'Shōnen', 'Shōjo', 'Seinen', 'Josei'] as $demografia) :?>
			<option value="<?=$demografia?>" <?php if($demografia==$params['demografia']) echo 'selected'?>><?=$demografia?></option>
		<?php endforeach; ?>
	</select>
	
	<label for="estreno">Estreno</label>
	<input type="date" name="estreno" id="estreno" value="<?=$params['estreno']?>">

	<label for="fin">Fin</label>
	<input type="date" name="fin" id="fin" value="<?=$params['fin']?>">

	<label for="tomos">Tomos</label>
	<input type="text" name="tomos" id="tomos" value="<?=$params['tomos']?>">

	<label for="capitulos">Capítulos</label>
	<input type="text" name="capitulos" id="capitulos" value="<?=$params['capitulos']?>">

	<label for="imagen">Imágen</label>
	<input type="file" name="imagen" id="imagen" value="<?=$params['imagen']?>">

	<input type="submit" value="insertar" name="insertar">
</form>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>