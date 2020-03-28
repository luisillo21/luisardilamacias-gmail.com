<?php
	function valida_permisos($conexion, $accion)
	{
		$x_usuario  = $_SESSION['_user'];
		$x_programa = $GLOBALS['program_id'];

		$sql = "	SELECT * FROM adm_usuarios, adm_roles, adm_permisos, adm_programas
					WHERE usu_id = '$x_usuario'
					AND usu_rol = rol_id
					AND usu_rol = per_rol
					AND per_programa = pro_id
					AND pro_id = $x_programa
					AND pro_estado = 'A'
					AND usu_estado = 'A'
					AND rol_estado = 'A'
			";

		$result = mysqli_query($conexion,$sql) or die(mysqli_error());
		if (mysqli_num_rows($result) == 0 )
		{
			return 0;
		}
		else
		{
			$row = mysqli_fetch_assoc($result);
			$GLOBALS['program_name'] = $row['pro_descripcion'];

			if($row['per_ejecutar']!="S")
			{
				return 0;
			}
			else
			{
				
				if((($row['per_agregar']=="S")   AND ($accion=="A")) 
				or (($row['per_consultar']=="S") AND ($accion=="C")) 
				or (($row['per_modificar']=="S") AND ($accion=="M")) 
				or (($row['per_eliminar']=="S")  AND ($accion=="E")) 
				or (($row['per_imprimir']=="S")  AND ($accion=="I"))) {return 1;}
					else
					return 0;		
			}
		}
	}
?>