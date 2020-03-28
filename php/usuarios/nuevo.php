<?php
	SESSION_START();
	if(!isset($_SESSION['_user']))
	{
		header("location:../../index.php");
	}
	else
	{
		$GLOBALS['program_id'] = 101; // Personas
		include("../conexion.php");
		include("../valida_permisos.php");	
		if(valida_permisos($conexion,"A")!=1)
		{
		 header('Location: ../mensaje.php?mensaje=Función No Permitida a Usuario&programa=../php/personas/index.php&tipo=danger');
		}
	}
?>
<html lang="es">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	

	</head>
	<header>
		<div class="row bg-primary">
			<h2 style="text-align:center"><?php echo $GLOBALS['program_name']; ?></h2>
		</div>
	</header>
	<body>
		<div class="container">
			<div class="row">
				<h3 style="text-align:center">NUEVO REGISTRO</h3>
			</div>
			
			<form class="form-horizontal" method="POST" action="guardar.php" autocomplete="off">

				 <div class="form-group">
					<label for="nombre" class="col-sm-2 control-label">Nombre de usuario</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" placeholder="Nombre de usuario" required>
					</div>
				</div>

				<div class="form-group">
					<label for="nombre" class="col-sm-2 control-label">Nombre completo</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="nombre_completo" name="nombre_completo" placeholder="Nombre de usuario" required>
					</div>
				</div>
				
				<div class="form-group">
					<label for="email" class="col-sm-2 control-label">Contraseña</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="clave" name="clave" placeholder="clave" required>
					</div>
				</div>
				
				<div class="form-group">
					<label for="estado_civil" class="col-sm-2 control-label">Tipo de usuario</label>
					<div class="col-sm-10">
						<select class="form-control" id="rol" name="rol">
							<option value="5">Estudiante</option>
							<option value="2">Docente</option>
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<a href="index.php" class="btn btn-default">Regresar</a>
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>