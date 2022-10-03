<?php

function suma(int $num1, int $num2) :int {
    $total = $num1 + $num2;
    return $total;
}

function resta(int $num1, int $num2) :int {
    $total = $num1 - $num2;
    return $total;
}

function multiplicacion(int $num1, int $num2) :int {
    $total = $num1 * $num2;
    return $total;
}

function division(int $num1, int $num2) {
    if ($num2 == 0) {
        return 'ERROR: No se puede dividir entre 0';
    }
    $total = $num1 / $num2;
    return $total;
}

function modulo(int $num1, int $num2) {
    if($num2 == 0) return "No se puede hacer modulo de 0";
    $total = $num1 % $num2;
    return $total;
}

function comparaDosEnteros(int $num1, int $num2) :string {
    if ($num1 == $num2) {
        return $num1.' y '.$num2.' son iguales';
    } else if ($num1 > $num2){
        return $num1.' es mayor que '.$num2;
    } else {
        return $num2.' es mayor que '.$num1;
    }
}

function esPar(int $num1, int $num2) :string {
    if ($num1%2 == 0) {
        return $num1.' es par y ';
    } else {
        return $num1.' es impar y ';
    }
    if ($num2%2 == 0) {
        return $num2.' es par';
    } else {
        return $num2.' es impar';
    }
}

?>
