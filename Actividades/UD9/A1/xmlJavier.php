<?php
    include 'personas.inc.php';
    header('Content-Type: application/xml');
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<personas>';
    foreach ($personas as $p => $datos) {
        echo '<persona>';
        foreach ($datos as $d => $valor) {
            echo '<'.$d.'>'.$valor.'</'.$d.'>';
        }
        echo '</persona>';
    }
    echo '</personas>';