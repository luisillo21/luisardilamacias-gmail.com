<?php
	SESSION_START();
	if(!isset($_SESSION['_user']))
	{
		header("location:../../index.php");
	}
	else
	{
		$GLOBALS['program_id'] = 201; // Personas
		include("../conexion.php");
		include("../valida_permisos.php");	
		if(valida_permisos($conexion,"A")!=1)
		{
		 header('Location: ../mensaje.php?mensaje=Función No Permitida a Usuario&programa=../php/personas/index.php&tipo=danger');
		}
	}
?>





	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
			<header class="cuadro_titulo bg-danger">
                <h4 class="title text-center text-light">Aula virtual | Crear Aula virtual</h4>
            </header>
			<form class="form-horizontal" method="POST" action="core/guardar.php" autocomplete="off">
				<div class="modal-body">
					
					<div class="form-group">
						<label for="imagen">Seleccione una portada para el aula virtual</label>
						<div class="col-sm-10">
						<input type="hidden" name="MAX_TAM" value="2097152">
							<input type="file" class="custom-file-input" accept="image/x-png,image/jpeg" id="imagen" name="imagen">
						</div>
					</div>
					<div class="form-group">
						<label for="nombre" class="col-sm-2 control-label">Nombre</label>
						<div class="col-sm-10">
						<input type="text" class="form-control" id="cls_nombre" name="cls_nombre" placeholder="Nombre" required>
						</div>
					</div>

					<div class="form-group">
						<label for="cls_descripcion" class="col-sm-2 control-label">Descripcion</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="cls_descripcion" name="cls_descripcion" placeholder="Escribe una descripcion de tu aula virtual" required>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-primary btn-block">Guardar</button>
							<a class="btn btn-danger btn-block text-light" data-dismiss="modal">Cancelar</a>
						</div>
					</div>

				</div>
			</form>
		</div>
	</div>
