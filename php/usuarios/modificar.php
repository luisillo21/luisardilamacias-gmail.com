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
		if(valida_permisos($conexion,"M")!=1)
		{
		 header('Location: ../mensaje.php?mensaje=Función No Permitida a Usuario&programa=../php/personas/index.php&tipo=danger');
		}
		else
		{
			$id = $_GET['id'];
			$sql = "SELECT usu_nombre,usu_password,rol_descripcion,rol_id,usu_id,usu_rol FROM adm_usuarios,adm_roles WHERE usu_id = '$id' and rol_id = usu_rol";
			$resultado = $mysqli->query($sql);
			$row = $resultado->fetch_array(MYSQLI_ASSOC);
			
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
		<div class="row">
			<h2 style="text-align:center"><?php echo $GLOBALS['program_name']; ?></h2>
		</div>
	</header>	
	<body>
		<div class="container">
			<div class="row">
				<h3 style="text-align:center">MODIFICAR REGISTRO</h3>
			</div>
			
			<form class="form-horizontal" method="POST" action="update.php" autocomplete="off">

				<input type="hidden" id="id" name="id" value="<?php echo $row['usu_id']; ?>" />

				<div class="form-group">
					<label for="nombre" class="col-sm-2 control-label">Nombre</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" placeholder="Nombre de usuario" 
						value="<?php echo $row['usu_id']; ?>" required>
					</div>
				</div>
				
				<div class="form-group">
					<label for="email" class="col-sm-2 control-label">Nombre completo</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="nombre_completo" name="nombre_completo" placeholder="Nombre completo" value="<?php echo $row['usu_nombre']; ?>"  required>
					</div>
				</div>
				
				<div class="form-group">
					<label for="rol" class="col-sm-2 control-label">Tipo de usuario</label>
					<div class="col-sm-10">
						<select class="form-control" id="rol" name="rol">
							<?php echo "<option  value='".$row['usu_rol']."' selected> '".$row['rol_descripcion']."'</option>"; ?>
							<?php 

								$sql_roles = "SELECT * FROM adm_roles WHERE rol_estado = 'A' ";
								$resultado2 = $mysqli->query($sql_roles);
								while ($row_roles = $resultado2->fetch_array(MYSQLI_ASSOC)) {
										if ($row_roles['rol_descripcion'] != $row['rol_descripcion']) {
											echo "<option  value='".$row_roles['rol_id']."' > '".$row_roles['rol_descripcion']."'</option>";
										}
										
									}
							 ?>
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