<?php 
	require '../../../conexion.php';
	$id = $_POST['id'];
	$id_tarea =$_POST['id_usuario_tareas'];
	$observacion = $_POST['observacion'];
	$calificacion = $_POST['calificacion'];

	#echo  $id ."<br>";
	#echo  $id_tarea."<br>";
	#echo  $observacion."<br>";
	#echo  $calificacion."<br>";
	 	
	$sql = "UPDATE cls_usuario_tareas SET observacion = '".$observacion."', calificacion = '".$calificacion."', estado = 'Revisado' WHERE (id_usuario_tareas = '".$id_tarea."');";
	$resultado = $mysqli->query($sql);
	if ($resultado) {
		header("location:../../ver_tareas.php?id=".$id."&id_tarea=".$id_tarea);
	}else{
		echo $mysql->errno;
	}


 ?>