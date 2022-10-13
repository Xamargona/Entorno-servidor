<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form productos</title>
</head>
<body>
    <form action="datosproductoJavier.php" method="GET">

        <label for="codigo">Código:</label><br>
        <input name="codigo" id="codigo"><br>

        <label for="nombre">Nombre:</label><br>
        <input type="text" name="nombre" id="nombre"><br>
    
        <label for="precio">Precio:</label><br>
        <input type="text" name="precio" id="precio"><br>
    
        <label for="descripcion">Descripción:</label><br>
        <textarea name="descripcion" id="descripcion"></textarea><br>
    
        <label for="fabricante">Fabricante:</label><br>
        <input type="text" name="fabricante" id="fabricante"><br>
    
        <label for="cantidad">Cantidad:</label><br>
        <input type="number" name="cantidad" id="cantidad"><br>
    
        <label for="fecha">Fecha de adquisición:</label><br>
        <input type="date" name="fecha" id="fecha"><br>
    
        <input type="submit">

    </form>

</body>
</html>