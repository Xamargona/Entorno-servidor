<!DOCTYPE html>
<html lang=es>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operaciones - Servicio Web + PHP + SOAP</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>

<body>
    <h1>Realizar operaciones</h1>
    <form action="resultadoOperacionesSOAP.php" method="post">
        Inserta los números a operar:
        <br>
        <input type="text" name="numero1">
        <select name="operacion" id="operacion">
            <option value="suma">+</option>
            <option value="resta">-</option>
            <option value="multiplicacion">*</option>
            <option value="division">/</option>
        </select>
        <input type="text" name="numero2">
        <input type="submit" name="enviar" value="Calcular">
    </form>

    <br><br>
    <h1>Convertir a binario</h1>
    <form action="resultadoBinarioSOAP.php" method="post">
        Inserta el número decimal que quieres convertir a binario:
        <br>
        <input type="text" name="numero">
        <input type="submit" name="enviar" value="Convertir">
    </form>
</body>
</html>