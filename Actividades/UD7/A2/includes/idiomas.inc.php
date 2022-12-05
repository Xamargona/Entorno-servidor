<?php
    $locale = locale_accept_from_http($_SERVER['HTTP_ACCEPT_LANGUAGE']);
    // Si no existe la sesion idioma la creamos
    if (!isset($_SESSION['idioma'])) {
        // Si en locale hay un guion seleecionamos lo anterior
        if (strpos($locale, '-') !== false) {
            $locale = substr($locale, 0, strpos($locale, '-'));
        } 
        $_SESSION['idioma'] = $locale;
    }
    // Si existe la sesion idioma y se ha pulsado el boton de cambiar idioma
    if (isset($_SESSION['idioma']) && isset($_GET['idioma'])) {
        $_SESSION['idioma'] = $_GET['idioma'];
    }

    // Incluimos el fichero de idioma
    require_once 'includes/lang/es.inc.php';
    require_once 'includes/lang/'.$_SESSION['idioma'].'.inc.php';