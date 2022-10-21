<?php
    // Seleccionamos la imagen a usar como marca de agua
    $marca = imagecreatefrompng('img/marca.png');
    imagealphablending($marca, false);
    imagesavealpha($marca, true);
    imagefilter($marca, IMG_FILTER_COLORIZE, 0, 0, 0, 60);
    //Obtenemos la imagen mediante variable get y colocamos la marca de agua
    $imagen = imagecreatefrompng('img/'.$_GET['img']);
    $destX = imagesx($imagen) - imagesx($marca) - 5;
    $destY = imagesy($imagen) - imagesy($marca) - 5;
    
    imagecopy($imagen, $marca, $destX, $destY, 0, 0, imagesx($marca), imagesy($marca));
    header('content-type: image/png');
    imagepng($imagen);
?>