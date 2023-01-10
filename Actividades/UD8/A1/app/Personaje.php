<?php
class Personaje {
	protected $conexion;

	public function __construct($dbname, $dbuser, $dbpass, $dbhost){

		$opciones = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];
		try {
			$conexion = new PDO('mysql:host='. $dbhost .';dbname='.$dbname, $dbuser, $dbpass, $opciones);
			
			$this->conexion = $conexion;
		} catch (PDOException $e) {
			$error = 'Falló la conexión: ' . $e->getMessage();
			die('No ha sido posible realizar la conexión con la base de datos: '. $conexion->connect_error);
		}
	}

	public function getPersonajes(){
		$sql = 'SELECT * FROM personajes ORDER BY nombre DESC';
		$result = $this->conexion->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getPersonaje($id){
		$id = htmlspecialchars($id);

		$sql = 'SELECT * FROM personajes WHERE id = ?'; 
		$result = $this->conexion->prepare($sql);
		$result->execute([$id]);
		return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPersonajesbyName($nombre, $orden, $ascDesc){
		$nombre = htmlspecialchars($nombre);
		$sql = ("SELECT * FROM personajes WHERE nombre LIKE ? ORDER BY ".$orden." ".$ascDesc);
		$result = $this->conexion->prepare($sql);
		$result->execute(['%'.$nombre.'%']);
	
		return $result->fetchAll(PDO::FETCH_ASSOC);        
    }
    
    public function getPersonajesManganime($id){
		$id = htmlspecialchars($id);

		$sql = 'SELECT * FROM personajes WHERE manganime = ?'; 
		$result = $this->conexion->prepare($sql);
		$result->execute([$id]);
		return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>