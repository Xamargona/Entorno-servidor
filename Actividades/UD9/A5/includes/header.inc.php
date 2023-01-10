<header>
    <a href="index.php?buscar=Rick">Rick</a>
    <a href="index.php?buscar=Morty">Morty</a>
    <form action="index.php" method="$_GET">
        <input type="text" name="buscar" id="buscar" value="<?=$_GET['buscar']??''?>">
        <input type="submit" value="Buscar">
    </form>
</header>