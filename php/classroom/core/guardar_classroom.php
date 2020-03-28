<?php
	session_start();
	require '../../conexion.php';
	error_reporting(E_ERROR | E_PARSE);
	$nombre = $_POST['cls_nombre'];
	$descripcion = $_POST['cls_descripcion'];
	date_default_timezone_set('GMT/UTC');
	$fecha = date('Y-m-d');
	$usuario = $_SESSION["_user"];
	$archivo = $_FILES['imagen']['name'];
	

	if ($_FILES['imagen']['error']) {
		switch ($_FILES['imagen']['error']) {
			case 1: // Error exceso de tamaño de archivo en php.ini
			echo "El tamaño del archovi exede a lo permitido del servidor";
			break;	
			case 2: // Error tamaño archivo marcado desxde el formullario
			echo "el tamañoi del archivo excede dos megas";
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
					$destino_de_ruta = "./media/classroom";
					move_uploaded_file($_FILES['imagen']['tmp_name'],$destino_de_ruta . $_FILES['imagen']['name']);
					chmod($destino_de_ruta, 0755);
		}else{
			echo "el archivo nose a podido copiar a la carpeta imagenes";
		}
	}

	$imagen = $_FILES['imagen']['name'];
	$sql = "INSERT INTO cls_classroom (nombre, descripcion,fecha_creacion,autor,estado,imagen) VALUES ('".$nombre."', '".$descripcion."', '".$fecha."', '". $usuario ."', 'A','".$imagen."')";
	$resultado = $mysqli->query($sql);
	
	if ($resultado) {
		header("location:../index.php");
	}

?>