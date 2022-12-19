<?php
// Se instancia un nuevo cliente SOAP
// Sin WSDL
//$url = "http://localhost.actividades/ud9/operaciones/servidorOperacionesSOAP.php";
//$uri = "http://localhost.actividades/ud9/operaciones/";
//$peticionSOAP = new SoapClient(null, array('location' => $url, 'uri' => $uri));

// Con WSDL
$peticionSOAP = new SoapClient("http://localhost.actividades/ud9/operaciones/wsdl.xml");

// ver las funciones disponibles
//$peticionSOAP = new SoapClient("http://localhost.actividades/ud9/operaciones/wsdl.xml", array("trace" => 1, "exception" => 0));
//var_dump($peticionSOAP->__getFunctions());
// ver las últimas peticiones y respuestas  después de haber usado una función del servicio
//$peticionSOAP = new SoapClient("http://localhost.actividades/ud9/operaciones/wsdl.xml", array("trace" => 1));
//echo $peticionSOAP->__getLastRequestHeaders(). "<br>"; // Encabezados SOAP de la última petición
//echo $peticionSOAP->__getLastRequest() . "<br>"; // Ultima petición SOAP
//echo $peticionSOAP->__getLastResponseHeaders(). "<br>"; // Encabezados SOAP de la última respuesta
//echo $peticionSOAP->__getLastResponse(). "<br>"; // Devuelve la última respuesta SOAP

if (isset($_POST['numero1']) && isset($_POST['numero2']) && isset($_POST['operacion'])) {
    // Se eliminan los espacios en blanco y se sustituyen las comas por puntos
    // para tener números decimales aunque se introduzca la coma
    $numero1 = str_replace(',', '.', trim($_POST['numero1']));
    $numero2 = str_replace(',', '.', trim($_POST['numero2']));
    $operacion = trim($_POST['operacion']);

    // Se inicializa el array de datos indicando que no hay errores
    $datos['error'] = 0;

    // Se comprueba que los operandos sean numéricos
    if(!is_numeric($numero1) || !is_numeric($numero2)) {
        $datos['error'] = "Los operandos deben ser numéricos.";
    } else {
        if (!empty($operacion)) {
            switch($operacion) {
                case 'suma':
                    $datos['resultado'] =  $peticionSOAP->suma($numero1, $numero2);
                    $datos['operacion'] = '+';
                    break;
                case 'resta':
                    $datos['resultado'] =  $peticionSOAP->resta($numero1, $numero2);
                    $datos['operacion'] = '-';
                    break;
                case 'multiplicacion':
                    $datos['resultado'] =  $peticionSOAP->multiplicacion($numero1, $numero2);
                    $datos['operacion'] = '*';
                    break;
                case 'division':
                    if($numero2 == 0)
                        $datos['error'] = "No se puede dividir entre 0.";
                    else
                        $datos['resultado'] =  $peticionSOAP->division($numero1, $numero2);
                        $datos['operacion'] = '/';
                    break;
                default:
                    $datos['error'] = "Operación no válida.";
            }       
        } else {
            $datos['error'] = "Se debe seleccionar una operación.";
        }
    }
// Se devuelve el resultado en formato JSON
//    header('Content-Type: application/json; charset=utf-8');
//    echo json_encode($datos);
//    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado operación SOAP</title>
</head>
<body>
    <?php
        if(isset($datos['resultado'])) {
            echo $numero1 .' '. $datos['operacion']  .' '. $numero2 . ' = ' . $datos['resultado'];
        } else {
            echo '<p>'. $datos['error'] .'</p>';
        }
    ?>
    
</body>
</html>