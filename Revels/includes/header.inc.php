<?php
    /*
        Dos estilos de Header:
        - Header con el logo y nombre de la app en un enlace a Index.php
        USUARIOS NO REGISTRADOS
        - Se añade un enlace a login.php
        USUARIOS REGISTRADOS
        - Se añade un enlace a 'new.php', 'account.php' y 'close' o 'logout.php'
        Un formulario de búsqueda con un campo de texto y un botón de búsqueda a 'results.php'
    */ 
    // Iniciamos la sesión y comprobamos si existe el user o el token
    if(isset($_SESSION['user'])) {
        // Si existe el usuario, mostramos el header con los enlaces a 'new.php', 'account.php' y 'close' o 'logout.php'
        ?>
        <header>
            <a href="index.php"><img src="img/logo.png" alt="Logo de Revels"></a>
            <a href="index.php"><h1>Revels</h1></a>
            <a href="new.php">Nuevo Revel</a>
            <a href="account.php">Mi cuenta</a>
            <a href="close.php">Cerrar sesión</a>
            <form action="results.php" method="GET">
                <input type="text" name="search" id="search" placeholder="Buscar">
                <input type="submit" value="Buscar">
            </form>
        </header>
        <?php
    } else {
        // Si no existe el usuario, mostramos el header con el enlace a login.php
        ?>
        <header>
            <a href="index.php"><img src="img/logo.png" alt="Logo de Revels"></a>
            <a href="index.php"><h1>Revels</h1></a>
            <a href="login.php">Iniciar sesión</a>
            <form action="results.php" method="GET">
                <input type="text" name="search" id="search" placeholder="Buscar">
                <input type="submit" value="Buscar">
            </form>
        </header>
        <?php
    }
?>