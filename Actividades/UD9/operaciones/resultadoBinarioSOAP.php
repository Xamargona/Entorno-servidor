<?php
// Se instancia el cliente SOAP con WSDL
$peticionSOAP = new SoapClient("http://localhost.actividades/ud9/operaciones/wsdl.xml");

if (isset($_POST['numero'])) {
    // Se elimina el espacio en blanco y se sustituye la coma por punto
    // para tener números decimales aunque se introduzca la coma
    $numero = str_replace(',', '.', trim($_POST['numero']));

    // Se inicializa el array de datos indicando que no hay errores
    $datos['error'] = 0;

    // Se comprueba que operando sea numérico
    if(!is_numeric($numero)) {
        $datos['error'] = "Para convertir a binario se necesita un número.";
    } else {
        $datos['resultado'] =  $peticionSOAP->aBinario($numero);
    }
} else {
    $datos['error'] = "Se debe introducir un número.";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado a binario SOAP</title>
</head>
<body>
<?php
        if(isset($datos['resultado'])) {
            echo $numero .' en decimal corresponde a: '. $datos['resultado']  .' en binario.';
        } else {
            echo '<p>'. $datos['error'] .'</p>';
        }
    ?>
</body>
</html>