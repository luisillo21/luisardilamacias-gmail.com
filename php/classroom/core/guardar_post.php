<?php
	//------Header
	session_start();
	require '../../conexion.php';
	error_reporting(E_ERROR | E_PARSE);
	date_default_timezone_set('GMT/UTC');
  //------Valores a guardar-------
	$desc= $_POST['descripcion'];
	$id = $_POST['id'];
	$fecha = date('Y-m-d');
	$usuario = $_SESSION["_user"]; 

	$sql = "INSERT INTO cls_posts_classroom (usuario, classroom,fecha,descripcion) VALUES ('".$usuario."', '".$id."', '".$fecha."', '". $desc."')";
	$resultado = $mysqli->query($sql);
	$id_post = $mysqli->insert_id;

	if ($resultado){
		if (!empty($_FILES['archivo']['tmp_name'][0]))
		{
				
				foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name){
					$filename = $_FILES["archivo"]["name"][$key];
					$sql_detalle = "INSERT INTO cls_post_detalle_classroom(post_clasroom,recurso) VALUES ('".$id_post."', '".$filename."')";
					$resultado2 = $mysqli->query($sql_detalle);
					if ($resultado2) { 
						if($_FILES["archivo"]["name"][$key]) {
							$filename = $_FILES["archivo"]["name"][$key];
							$source = $_FILES["archivo"]["tmp_name"][$key]; 
							$directorio = '../media/biblioteca/';  

						if(!file_exists($directorio)){
							mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
						}
						$dir=opendir($directorio); 
						$targetPath = $directorio.'/'.$filename;

						if(move_uploaded_file($source, $targetPath)) {	
						echo "<script>alert('archivo guardado exitosamente');</script>";
						}else{	
						echo "<script>alert('Error al guardar');</script>";
						}
			 			closedir($dir);
					
						}else{
							echo "<script>alert(".$id_post.");</script>";
						}
					}
					if ($resultado2 and $resultado) {
						header("location:../post_clasroom.php?id=".$id);	
					}else{
						echo $id_post;
					}	
				}

			}else{
					header("location:../post_clasroom.php?id=".$id);
				}
	}else{
		echo "Algo salio mal";
	}

 ?>