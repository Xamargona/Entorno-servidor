<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DWES - MVC - MangAnime</title>
	
	<link rel="stylesheet" href="<?php echo 'css/'.Config::$css ?>"/>
</head>
<body>
	<header>
		<h1>MangAnime</h1>
	</header>

	<nav>
		<ul>
			<li><a href="index.php?accion=inicio">Inicio</a></li>
			<li><a href="index.php?accion=listar">Ver todos MangAnimes</a></li>
			<li><a href="index.php?accion=insertar">Insertar un MangAnime</a></li>
			<li><a href="index.php?accion=buscarPorNombre">Buscar MangAnime por nombre</a></li>
			<li><a href="index.php?accion=buscarPorDemografia">Buscar MangAnime por demografía</a></li>
			<li><a href="index.php?accion=buscarCombinada">Búsqueda combinada de MangAnime</a></li>
		</ul>
	 </nav>

	<main>
		<?php echo $contenido ?>
	</main>

	<footer id="pie"> - Desarrollo Web en Entorno Servidor -</footer>
</body>
</html>