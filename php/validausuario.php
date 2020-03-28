<?php
	session_start();
	if($_POST['usuario'] !='' AND $_POST['clave'] !='' )
	{
		include("conexion.php");

		// Se valida el usuario y el tipo_usuario (que exista y que se encuentra activos)
		//$x_usr = mysqli_real_escape_string($conexion, $_POST["usuario"]);

		$x_usr = $_POST["usuario"];
		$x_cla = $_POST["clave"];
		
		$sql = "SELECT * FROM adm_usuarios, adm_roles
				WHERE usu_id = '".$x_usr."' AND usu_rol = rol_id AND rol_estado = 'A' ";

		$result = mysqli_query($conexion,$sql);
		if (mysqli_num_rows($result) > 0 )
		{
			// Si el usuario SI existe validamos que se encuentre ACTIVO
			$fila 		= mysqli_fetch_assoc($result);
			if($fila['usu_estado']!='A')
			{
				header('Location: mensaje.php?mensaje=Usuario Inactivo&programa=../index.php&tipo=danger');
			}
			else
			{
				// Si el usuario SI existe y esta ACTIVO validamos si el password ingresado es el correcto
				if($x_cla != $fila['usu_password'] )
				{
					header('Location: mensaje.php?mensaje=Password Incorrecto&programa=../index.php&tipo=danger');
				}
				else
				{
					$_SESSION["_user"]	= $fila["usu_id"];
					$_SESSION["_rol"]	= $fila["usu_rol"];
					$_SESSION["_system"]= '1';

					echo '<script>location.href = "menu.php"</script>';
				}
			}
		}	
		else
		{
			header('Location: mensaje.php?mensaje=Usuario No Existe&programa=../index.php&tipo=danger');
		}
		mysqli_free_result($result);
		mysqli_close($conexion);
	}
	else
	{
		header("location:../index.php");
	}
?>