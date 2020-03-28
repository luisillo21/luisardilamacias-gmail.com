<?php  
    require '../../conexion.php';
	error_reporting(E_ERROR | E_PARSE);
    $id = $_POST['id'];
	$nombre = $_POST['usuarios'];
    $descripcion = $_POST['id_classroom'];
    foreach ($nombre as $c ) {
        $sql = "INSERT INTO cls_detalle_classroom (id_cab_classroom,usuarios) VALUES ('".$descripcion."', '". mysqli_real_escape_string($conexion, $c)."')";
	    $resultado = $mysqli->query($sql);
    }

    if ($resultado) {
		header("location:../tabla_usuarios.php?id=".$id);
	}
?>