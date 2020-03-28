<?php
	SESSION_START();
	if(!isset($_SESSION['_user']))
	{
		header("location:../../index.php");
	}
	else
	{
		$GLOBALS['program_id'] = 101; // Personas
		include("../conexion.php");
		include("../valida_permisos.php");	

		if(valida_permisos($conexion,"C")!=1)
		{
			header('Location: ../mensaje.php?mensaje=Función No Permitida a Usuario&programa=menu.php&tipo=danger');
		}
	}
?>
<html lang="es">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<link href="css/jquery.dataTables.min.css" rel="stylesheet">
		<link rel="stylesheet" href="css/main.css"> 
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/main.js"></script>

		<script>
			$(document).ready(function(){
				$('#mitabla').DataTable({
					"order": [[1, "asc"]],
					"language":{
					"lengthMenu": "Mostrar _MENU_ registros por pagina",
					"info": "Mostrando pagina _PAGE_ de _PAGES_",
						"infoEmpty": "No hay registros disponibles",
						"infoFiltered": "(filtrada de _MAX_ registros)",
						"loadingRecords": "Cargando...",
						"processing":     "Procesando...",
						"search": "Buscar:",
						"zeroRecords":    "No se encontraron registros coincidentes",
						"paginate": {
							"next":       "Siguiente",
							"previous":   "Anterior"
						},					
					},
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": "server_process.php"
				});	
			});
			
		</script>
		
	</head>
	
	<header>
		<div class="row">
			<h2 style="text-align:center"><?php echo $GLOBALS['program_name']; ?></h2>
		</div>
	</header>

	<body>
		
		<div class="container">
			<br>	
			<div class="row">
				<a href="../menu.php" class="btn btn-success">Regresar</a>
				<a href="nuevo.php" class="btn btn-primary">Nuevo Registro</a>
				<a href="listado_xls.php" class="btn btn-warning">Excel</a>
				<a href="listado_pdf.php" target="_blank" onclick="window.open(this.href, this.target, 'width=500,height=600'); return false;" class="btn btn-danger">Pdf</a>
			</div>
			<br>

			<div class="row table-responsive">
				<table class="display" id="mitabla">
					<thead>
						<tr>
							<th>Nombre de usuario</th>
							<th>Nombre completo</th>
							<th>Acciones</th>
							<th></th>
						</tr>
					</thead>
					
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
		
		<!-- Modal -->
		<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
					</div>
					
					<div class="modal-body">
						¿Desea eliminar este registro?
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<a class="btn btn-danger btn-ok">Delete</a>
					</div>
				</div>
			</div>
		</div>
		
		<script>
			$('#confirm-delete').on('show.bs.modal', function(e) {
				$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
				
				$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
			});
		</script>	
		
	</body>
</html>	