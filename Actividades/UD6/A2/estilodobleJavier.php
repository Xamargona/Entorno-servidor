<?php
    // si no existe la cookie galleta y recibimos un valor por get la creamos
    if (isset($_GET['estilo'])) {
        setcookie('Galleta', $_GET['estilo'], time() + 60, $httponly=true);
        header('Location: estilodobleJavier.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estilo doble - Javier Martínez González</title>
    <?php
        // si no existen la cookie o la cookie es igual a diurno establezco el css diurno
        if (!isset($_COOKIE['Galleta']) || $_COOKIE['Galleta'] == 'diurno') {
            echo '<link rel="stylesheet" href="css/light.css">';
        } elseif ($_COOKIE['Galleta'] == 'nocturno') {
            echo '<link rel="stylesheet" href="css/dark.css">';
        }
    ?>
</head>
<body>
    <div>
        <!-- Creamos un enlace de modo diurno y otro nocturno que setearan la cookie y a su vez el modo-->
        <a href="estilodobleJavier.php?estilo=diurno">Estilo diurno</a>
        <a href="estilodobleJavier.php?estilo=nocturno">Estilo nocturno</a>
    </div>
    <h1>Javier Martínez González</h1>
    <p>
        Superior a mí
        Es la fuerza que me lleva en el pulso
        Que mantengo con la oscuridad
        Que tiñen de oscuro tus ojos negros
        Y que me cuentas del tiempo
        Que pasa en tu pestañeo
        Y que me trae por esta calle
        De amargura y de lamento
        Que yo sé que la sonrisa
        Que se dibuja en mi cara
        Tiene que ver con la brisa
        Que abanica tu mirada
        Tan despacio y tan deprisa
        Tan normal y tan extraño
        Yo me parto la camisa
        Como camarón
        Tú me rompes las entrañas
        Me trepas como una araña
        Bebes del sudor que empaña
        El cristal de mi habitación
        Y después por la mañana
        Despierto y no tengo alas
        Llevo diez horas durmiendo
        Y mi almohada está empapada
        Todo había sido un sueño
        Muy real y muy profundo
        Tus ojos no tienen dueño
        Porque no son de este mundo
        Que no te quiero mirar
        Pero es que cierro los ojos
        Y hasta te veo por dentro
        Te veo en un lado y en otro
        En cada foto, en cada espejo
        Y en las paradas del metro
        Y en los ojos de la gente
        Hasta en las sopas más calientes
        Loco yo me estoy volviendo
        Que yo sé que la sonrisa
        Que se dibuja en mi cara
        Tiene que ver con la brisa
        Que abanica tu mirada
        Tan despacio y tan deprisa
        Tan normal y tan extraño
        Yo me parto la camisa
        Como camarón
        Tú me rompes las entrañas
        Me trepas como una araña
        Bebes del sudor que empaña
        El cristal de mi habitación
        Y después por la mañana
        Despierto y no tengo alas
        Llevo diez horas durmiendo
        Y mi almohada está empapada
        Todo había sido un sueño
        Muy real y muy profundo
        Tus ojos no tienen dueño
        Porque no son de este mundo
        Y a veces me confundo
        Y pico a tu vecina
        Esa del segundo que vende cosas finas
        Y a veces te espero
        En el bar de la esquina
        Con la mirada fija en tu portería
        Y a veces me como de un bocao el mundo
        Y a veces te siento
        Y a veces te tumbo
        A veces te leo un beso en los labios
        Y como yo no me atrevo
        Me corto y me abro
        Que yo sé que la sonrisa
        Que se dibuja en mi cara
        Tiene que ver con la brisa
        Que abanica tu mirada
        Tan despacio y tan deprisa
        Tan normal y tan extraño
        Yo me parto la camisa
        Como camarón
        Tú me rompes las entrañas
        Me trepas como una araña
        Bebes del sudor que empaña
        El cristal de mi habitación
        Y después por la mañana
        Despierto y no tengo alas
        Llevo diez horas durmiendo
        Y mi almohada está empapada
        Todo había sido un sueño
        Muy real y muy profundo
        Tus ojos no tienen dueño
        Porque no son de este mundo
    </p>

    <p>
    ¿Sabías que, en términos de reproducción de Pokémon humanos masculinos y femeninos, Vaporeon...
    </p>

    <p>
    Waxillium “Wax” Ladrian, también llamado Asinthew, es un Nacidoble oriundo de Elendel y el jefe de la Casa Ladrian que se desempeña como vigilante de la ley. En su juventud escapó hacía los Áridos para convertirse en un héroe y se pasó veinte años combatiendo al crimen con la ayuda de aliados como Wayne y Lessie. Tras la muerte de su tío regresó a Elendel para ocupar el lugar como heredero de su casa. Pese a tratar de llevar una vida normal con su prometida, Steris Harms, Wax acabó involucrándose en la investigación y resolución de varios crímenes relacionado con una misteriosa organización clandestina conocida como el Grupo.
    </p>
</body>
</html>