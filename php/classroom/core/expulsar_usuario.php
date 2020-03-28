<?php  
    require '../../conexion.php';
	$id = $_GET['id'];
    $id_classroom = $_GET['id2'];
            $sql = "DELETE FROM cls_detalle_classroom WHERE (idcls_detalle_classroom = $id)";
            $resultado = $mysqli->query($sql);
            if ($resultado) {
                header("location:../tabla_usuarios.php?id=".$id_classroom);
            }
            else{

                echo "Error";
            }
        

?>
