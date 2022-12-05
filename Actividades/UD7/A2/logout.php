<?php
    session_start();
    if (isset($_COOKIE['token'])) {
        setcookie('token', '', time() - 3600);
    }
    session_destroy();
    header('Location: index.php');
?>