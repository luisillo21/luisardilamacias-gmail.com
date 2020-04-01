<?php  
    require '../../conexion.php';
	$id = $_GET['id'];
            $sql = "UPDATE `4g`.`cls_classroom` SET `estado` = 'I' WHERE (`id_classroom` = $id);";
            $resultado = $mysqli->query($sql);
            if ($resultado) {
                header("location:../index.php");
            }
            else{

                echo "Error";
            }
        

?>