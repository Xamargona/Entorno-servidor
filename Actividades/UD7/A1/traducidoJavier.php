<?php 
    // Inicializamos la sesión
    session_start();
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
    if (isset($_SESSION['idioma']) && isset($_POST['idioma'])) {
        $_SESSION['idioma'] = $_POST['idioma'];
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traducido - Javier Martínez González</title>
</head>
<body>
    <?php
        // Mostramos un formulario select con los 3 idiomas disponibles
        echo "<form action='#' method='post'>
                <select name='idioma'>
                    <option value='es'>Español</option>
                    <option value='ca'>Valencià</option>
                    <option value='en'>English</option>
                </select>
                <input type='submit' value='Cambiar idioma'>
            </form>";
            // Mostramos un texto en el idioma seleccionado
            ?>
            <div>
                <h1>Waxillium Ladrian</h1>
                <img src="https://coppermind.net/w/images/Waxillium_Ladrian.jpg" alt="Waxillium Ladrian" style="height: 300px;">
                <?php
                    // Mostramos el texto en función del idioma de la sesion
                    echo "<p>";
                    if ($_SESSION['idioma'] == 'es') {
                        echo "Waxillium Ladrian, o Wax para abreviar, es un nacidoble y el Decimosexto Alto Señor de la Casa Ladrian en Scadrial. Entre los Terris, Wax es conocido como Asinthew. Creció en Elendel, pero abandonó la ciudad para escapar de su política, y finalmente vivió como representante de la ley en los Áridos durante veinte años. Regresó a Elendel en el 341 a. C., después de recibir la noticia de la muerte de su tío, para convertirse en Gran Señor de su Casa, aunque continúa investigando a criminales notables, en particular a los relacionados con El Círculo"; 
                        echo "</p><p>";
                        echo "Además de sus mentes de metal, un par de brazales de hierro que usa en la parte superior de sus brazos generalmente ocultos por los puños de sus mangas, Wax prefiere usar un sombrero estilo Roughs forrado de aluminio, así como un largo abrigo de niebla sobre su fino traje de ciudad, chaleco y corbata. Wax tiende a ser antinaturalmente ligero en sus pies, debido a su hábito de llenar casi constantemente sus mentes de metal con un pequeño porcentaje de su peso.";
                    } elseif ($_SESSION['idioma'] == 'ca') {
                        echo "Waxillium Ladrian, o Wax per abreujar, és un nascutdoble i el Setzè Alt Senyor de la Casa Ladrian a Scadrial. Entre els Terris, Wax és conegut com Asinthew. Va créixer a Elendel, però va abandonar la ciutat per escapar de la seva política, i finalment va viure com a representant de la llei als Àrids durant vint anys. Va tornar a Elendel el 341 a. C., després de rebre la notícia de la mort del seu oncle, per convertir-se en Gran Senyor de casa seva, encara que continua investigant a criminals notables, en particular als relacionats amb El Cercle";
                        echo "</p><p>";
                        echo "A més de les seves ments de metall, un parell de braçals de ferro que utilitza a la part superior dels seus braços generalment ocults pels punys de les seves mànigues, Wax prefereix fer servir un barret estil Roughs folrat d'alumini, així com un llarg abric de boira sobre el seu fi vestit de ciutat, armilla i corbata. Wax tendeix a ser antinaturalment lleuger als peus, a causa del seu hàbit d'omplir gairebé constantment les seves ments de metall amb un petit percentatge del seu pes.";
                    } else {
                        echo "Waxillium Ladrian, or Wax for short, is a Twinborn and Sixteenth High Lord of House Ladrian on Scadrial. Among the Terris, Wax is known as Asinthew.He grew up in Elendel, but left the city to escape its politics, eventually living as a lawman in the Roughs for twenty years. He returned to Elendel in 341 PC, after receiving word of his uncle's death, to become High Lord of his House, though he continues to investigate notable criminals, particuarly those connected with the Set.";
                        echo "</p><p>";
                        echo "In addition to his metalminds, a pair of iron bracers he wears on his upper arms typically hidden by the cuffs of his sleeves, Wax favors wearing an aluminum-lined, Roughs-style hat, as well as a long, mistcloak duster over his fine city suit, vest, and cravat. Wax tends to be unnaturally light on his feet, due to his habit of nearly constantly filling his metalminds with a small percentage of his weight.";
                    }
                    echo"</p>"
                ?>
            </div>
            <?php
    ?>
</body>
</html>