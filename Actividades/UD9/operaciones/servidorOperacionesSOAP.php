<?php
// Se instancia un nuevo servidor SOAP
// Sin WSDL
//$uri="http://localhost.actividades/ud9/operaciones";
//$server = new SoapServer(null,array('uri'=>$uri));

// Con WSDL
$server = new SoapServer("http://localhost.actividades/ud9/operaciones/wsdl.xml");
 
// Se Definen las funciones que se van a ofrecer
function suma($numero1, $numero2) {
    return $numero1+$numero2;
}

function resta($numero1, $numero2) {
    return $numero1-$numero2;
}

function multiplicacion($numero1, $numero2) {
    return $numero1*$numero2;
}

function division($numero1, $numero2) {
    return $numero1/$numero2;
}

function aBinario($numero) {
    return decbin($numero);
}

// Se añaden las funciones al servidor
$server->addFunction("suma");
$server->addFunction("resta");
$server->addFunction("multiplicacion");
$server->addFunction("division");
$server->addFunction("aBinario");

$server->handle();