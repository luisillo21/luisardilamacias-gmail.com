<?php
	
	require '../conexion.php';
	
	$usuario = $_POST['nombre_usuario'];
	$nombre = $_POST['nombre_completo'];
	$clave = $_POST['clave'];
	$tipo_de_usuario = $_POST['rol'];
	//$estado_civil = $_POST['estado_civil'];
	//$hijos = isset($_POST['hijo']) ? $_POST['hijos'] : 0;
	//$intereses = isset($_POST['intereses']) ? $_POST['intereses'] : null;
	//$arrayIntereses = null;
	//$num_array = count($intereses);
	//$contador = 0;
	//
	//if($num_array>0){
	//	foreach ($intereses as $key => $value) {
	//		if ($contador != $num_array-1)
	//		$arrayIntereses .= $value.' ';
	//		else
	//		$arrayIntereses .= $value;
	//		$contador++;
	//	}
	//}
	
	$sql="INSERT INTO `4g`.`adm_usuarios` (`usu_id`, `usu_nombre`, `usu_password`, `usu_rol`, `usu_estado`) VALUES ('$usuario', '$nombre', '$clave', '$tipo_de_usuario', 'A');";
	$resultado = $mysqli->query($sql);

	
?>

<html lang="es">
	<head>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	
	</head>
	
	<body>
		<div class="container">
			<div class="row">
				<div class="row" style="text-align:center">
					<?php if($resultado) { ?>
						<h3>REGISTRO GUARDADO</h3>
						<?php } else { ?>
						<h3>ERROR AL GUARDAR</h3>
					<?php } ?>
					
					<a href="index.php" class="btn btn-primary">Regresar</a>
					
				</div>
			</div>
		</div>
	</body>
</html>
