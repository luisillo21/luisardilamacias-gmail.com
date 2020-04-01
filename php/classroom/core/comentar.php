<?php 
	session_start();
	require '../../conexion.php';
	error_reporting(E_ERROR | E_PARSE);
	$id= $_POST['id_post'];
	$id_post_actual = $_POST['id_post_actual'];
	$comentario = $_POST['c_usuario'];
	date_default_timezone_set('GMT/UTC');
	$fecha = date('Y-m-d');
	$usuario = $_SESSION["_user"];

	$sql = "INSERT INTO cls_post_comentarios (id_post,comentario,usuario,fecha_pub) VALUES ('".$id."', '".$comentario."', '".$usuario."', '". $fecha."')";
	$resultado = $mysqli->query($sql);
	if ($resultado) {
		header("location:../post_clasroom.php?id=".$id_post_actual);
	}else{
		echo "Error";
	}

?>