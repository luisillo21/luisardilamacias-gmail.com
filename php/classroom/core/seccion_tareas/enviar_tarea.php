<?php
	session_start();
	require '../../../conexion.php';
	error_reporting(E_ERROR | E_PARSE);
	$usuario = $_SESSION["_user"];
	$id = $_POST['id_classroom'];
	$fecha = $_POST["fecha_entrega"];
	$nueva_fecha = date("Y-m-d", strtotime($fecha));
	$fecha_pub = date('Y-m-d');
	$desc = $_POST["descripcion"];
	$titulo = $_POST["titulo"];
	$imagen = $_FILES['imagen']['name'];

	$sql = "INSERT INTO cls_cab_tareas (fecha_pub,fecha_entrega,descripcion,titulo,recurso,classroom,usuario) VALUES ('".$fecha_pub."', '".$nueva_fecha."', '".$desc."', '". $titulo ."','".$imagen."','".$id."','".$usuario."')";
	$resultado = $mysqli->query($sql);
	
	if ($resultado) {
		if((isset($_FILES['imagen']['name']) && ($_FILES['imagen']['error'] == UPLOAD_ERR_OK))) {
					$destino_de_ruta = "../../media/tareas/";
					move_uploaded_file($_FILES['imagen']['tmp_name'],$destino_de_ruta . $_FILES['imagen']['name']);
					chmod($destino_de_ruta,0777);
					chmod("../../media/classroom/".$archivo,0777); 
					}else{
						echo "el archivo nose a podido copiar a la carpeta imagenes";
					}
			header("location:../../gestion_tarea.php?id=".$id);
		}


 ?>