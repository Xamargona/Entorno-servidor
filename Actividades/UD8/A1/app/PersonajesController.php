<?php
class PersonajesController
{
	public function listar() {
		$personajeModel = new Personaje(Config::$bd_nombre,
										Config::$bd_usuario,
										Config::$bd_clave,
										Config::$bd_hostname);
		$params = ['personajes' => $personajeModel->getPersonajes()];
		unset($personajeModel);
        // Por cada personaje sacamos el nombre del manganime al que pertenece
        $manganimeModel = new Manganime(Config::$bd_nombre,
        Config::$bd_usuario,
        Config::$bd_clave,
        Config::$bd_hostname);
        $indice = 0;
        foreach ($params['personajes'] as $personaje) {
            $manganime = $manganimeModel->getMangAnimeNombre($personaje['manganime']);
            $params['personajes'][$indice]['manganime']= $manganime;
            $indice++;
        }
        unset($manganimeModel);

		require __DIR__ . '/templates/mostrarPersonajes.php';
	}

	public function buscarPersonajes() {
		$params = [ 'nombre' => '',
					'resultado' => []
				];
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['nombre'])) {
			$_POST['nombre'] = isset($_GET['nombre']) ? $_GET['nombre'] : $_POST['nombre'];
			$orden = isset($_GET['orden']) ? $_GET['orden'] : 'nombre';
			$by = isset($_GET['by']) ? $_GET['by'] : 'DESC';
			$personajeModel = new Personaje(Config::$bd_nombre,
											Config::$bd_usuario,
											Config::$bd_clave,
											Config::$bd_hostname);
			$params['nombre'] = $_POST['nombre'];
			// Si se necesita pasar el orden y el tipo de orden a la vista:
			$params['orden'] = $orden;
			$params['by'] = $by;
			// TODO: completar con la llamada al método del modelo que devuelve los manganimes que coinciden con el nombre
			$params['personajes'] = $personajeModel->getPersonajesbyName($params['nombre'], $params['orden'], $params['by']);  

			unset($personajeModel);
            $manganimeModel = new Manganime(Config::$bd_nombre,
            Config::$bd_usuario,
            Config::$bd_clave,
            Config::$bd_hostname);
            $indice = 0;
            foreach ($params['personajes'] as $personaje) {
                $manganime = $manganimeModel->getMangAnimeNombre($personaje['manganime']);
                $params['personajes'][$indice]['manganime']= $manganime;
                $indice++;
            }
            unset($manganimeModel);

		}
		require __DIR__ . '/templates/buscarPersonajes.php';
	}
	
	public function buscarPersonajesManganime() {
        if (!isset($_GET['id'])) {
            header('location: index.php');
            exit();

            throw new Exception('Pagina no encontrada');
        }
        $id = $_GET['id'];
    
        $personajeModel = new Personaje(Config::$bd_nombre,
                        Config::$bd_usuario,
                        Config::$bd_clave,
                        Config::$bd_hostname);	
        $params['personajes'] = $personajeModel->getPersonajesManganime($id);  
        unset($personajeModel);
        $manganimeModel = new Manganime(Config::$bd_nombre,
        Config::$bd_usuario,
        Config::$bd_clave,
        Config::$bd_hostname);
        $indice = 0;
        foreach ($params['personajes'] as $personaje) {
            $manganime = $manganimeModel->getMangAnimeNombre($personaje['manganime']);
            $params['personajes'][$indice]['manganime']= $manganime;
            $indice++;
        }
        unset($manganimeModel);

		require __DIR__ . '/templates/mostrarPersonajes.php';
	}

}