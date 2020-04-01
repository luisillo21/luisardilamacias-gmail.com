<?php
	
	require '../conexion.php';
	
	$usuario = $_POST['nombre_usuario'];
	$nombre = $_POST['nombre_completo'];
	$clave = $_POST['clave'];
	$tipo_de_usuario = $_POST['rol'];
	$archivo = $_FILES['imagen']['name'];

	if ($_FILES['imagen']['error']) {
		switch ($_FILES['imagen']['error']) {
			case 1: // Error exceso de tamaño de archivo en php.ini
			echo "El tamaño del archovi exede a lo permitido del servidor";
			break;	
			case 2: // Error tamaño archivo marcado desxde el formullario
			echo "el tamaño del archivo excede dos megas";
			break;
			case 3: //corrupcion de archivo
				echo "el envio de archivo se interrumpio";
				beak;
			case 4://No subio imagen iniguna
				echo "no se a enviado archivo alguno";
				break;
			default:
		}
	}else{		
				
				if((isset($_FILES['imagen']['name']) && ($_FILES['imagen']['error'] == UPLOAD_ERR_OK))) {
					$destino_de_ruta = "./media/usuario_perfil";
					move_uploaded_file($_FILES['imagen']['tmp_name'],$destino_de_ruta . $_FILES['imagen']['name']);
					chmod($destino_de_ruta,0777);
					
		}else{
			echo "el archivo nose a podido copiar a la carpeta imagenes";
		}
	}
	
	$sql="INSERT INTO `4g`.`adm_usuarios` (`usu_id`, `usu_nombre`, `usu_password`, `usu_rol`, `usu_estado`, `foto`) VALUES ('$usuario', '$nombre', '$clave', '$tipo_de_usuario', 'A', '$archivo');";

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
