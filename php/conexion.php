<?php 
	class conectar{
		private $servidor="localhost";
		private $usuario="root";
		private $password="root";
		private $bd="4g";

		public function conexion(){
			$conexion=mysqli_connect($this->servidor,
									 $this->usuario,
									 $this->password,
									 $this->bd);
			return $conexion;
		}
	}

	$mysqli= new conectar();
	$conexion=$mysqli->conexion();

	// Datablade
	$mysqli = new mysqli('localhost', 'root', 'root', '4g');
	if($mysqli->connect_error)
	{
		die('Error en la conexion' . $mysqli->connect_error);
	}
	else
	{
		$user = $_SESSION['_user'];

	}
 ?>

