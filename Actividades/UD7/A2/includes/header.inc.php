<header>
    <a href="index.php"><h1>MerchaShop Javier</h1></a>
        <a href="index.php"><?=$message['index']?></a>
    <?php
        if (isset($_SESSION['usuario'])) {
            echo '<a href="carrito.php">
                    <img src="img/carrito.png" alt="carrito">[ '.count($_SESSION['carrito']).' ]
                </a>';
            echo '<p id="usuario"> '.$_SESSION['usuario'].'</p> 
            <a href="logout.php">Logout</a>';
        }
        if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin') {
            echo '<a href="usuarios.php">Users</a>';
        }
    ?>
    <a href="?idioma=es" class="idioma"><img src="/img/banderaes.jpg" alt="ESPAÑA"></a>
    <a href="?idioma=ca" class="idioma"><img src="/img/banderaca.svg" alt="Valencià"></a>
    <a href="?idioma=en" class="idioma"><img src="/img/banderaen.png" alt="Inglés"></a>
</header>