<?php
	SESSION_START();
	if(!isset($_SESSION['_user']))
	{
		header("location:../../index.php");
	}
	else
	{
		$GLOBALS['program_id'] = 100; // Personas
		include("../conexion.php");
		include("../valida_permisos.php");	
		if(valida_permisos($conexion,"E")!=1)
		{
		 header('Location: ../mensaje.php?mensaje=Función No Permitida a Usuario&programa=../php/personas/index.php&tipo=danger');
		}
		else
		{
			$id = $_GET['id'];			
			$sql = "UPDATE adm_usuarios SET usu_estado = 'I' WHERE usu_id = '$id'";
			$resultado = $mysqli->query($sql);
		}
	}
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
				<h3>REGISTRO ELIMINADO</h3>
				<?php } else { ?>
				<h3>ERROR AL ELIMINAR</h3>
				<?php } ?>
				
				<a href="index.php" class="btn btn-primary">Regresar</a>
				
				</div>
			</div>
		</div>
	</body>
</html>
