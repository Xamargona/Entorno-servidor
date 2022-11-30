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
    if (isset($_SESSION['user'])) {
        // Si existe el usuario, mostramos el header con los enlaces a 'new.php', 'account.php' y 'close' o 'logout.php'
        ?>
        <header>
            <a href="index.php" class="logo"><img src="/img/Revels Logo Name White2.png" alt="Logo de Revels"></a>
            <form action="results.php" method="GET" class="formBusqueda">
                <input type="text" name="search" id="search" placeholder="Buscar">
                <input type="submit" value="Buscar">
            </form>
            <span>
                <p><?=$_SESSION['user']?></p>
                <a href="new.php">Nuevo Revel</a>
                <a href="account.php">Mi cuenta</a>
                <a href="logout.php">Cerrar sesión</a>
            </span>
        </header>
        <?php   
    } else {
        // Si no existe el usuario, mostramos el header con el enlace a login.php
        ?>
        <header>
            <a href="index.php" class="logo"><img src="/img/Revels Logo Name White2.png" alt="Logo de Revels"></a>
            <a href="login.php" class="headerLogin">Iniciar sesión</a>
        </header>
        <?php
    }
?>