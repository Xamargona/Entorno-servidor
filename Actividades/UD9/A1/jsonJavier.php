<?php
    header('Content-Type: application/json; charset=utf-8');
    include 'personas.inc.php';
    echo json_encode($personas);