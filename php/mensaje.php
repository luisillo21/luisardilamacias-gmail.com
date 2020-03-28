<?php
	SESSION_START();
	$x_mensaje  = $_REQUEST['mensaje'];
	$x_programa = $_REQUEST['programa'];
	$x_tipo     = $_REQUEST['tipo']; // success  info  warning danger
	$x_click    = $_REQUEST['click'];
	$x_time     = $_REQUEST['time'];
	if($x_time=="")
		$x_time 	= 1;
	if($x_tipo=="danger")
		$x_time = 2;
	
	if(empty($x_click))
	{
		$x_click = $x_programa;
	}

	$accion = "window.location=\"".$x_click."\"";
	if(empty($x_programa))
	{
		$accion = "window.close()";
	}

	
	$presentar  = "
			<head>
				<script type='text/javascript' src='../js/funciones.js'> 					</script>
				<script type='text/javascript' src='../js/alertify.js/lib/alertify.js'> 	</script>
				<title> MENSAJE </title>
				<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'/>
				<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'/>
				<link rel='stylesheet' href='../css/estilo.css' >
				<link rel='stylesheet' href='../css/bootstrap.min.css'>
				<link rel='stylesheet' href='../js/alertify.js/themes/alertify.core.css' />
				<link rel='stylesheet' href='../js/alertify.js/themes/alertify.default.css' />
				<META HTTP-EQUIV='REFRESH' CONTENT=\"".$x_time.";URL=".$x_programa."\">
			</head>
			<br>
			<div class='center-block'>
				<div class='alert alert-".$x_tipo."' role='alert'>
					<h1>".$x_mensaje."</h1>
				</div>
				<br>
				<div class='col-xs-5'> 
					<button class='btn btn-lg btn-primary btn-block' onClick='".$accion."' type='button'> Ok </button>
				</div>
			</div>
	";
	echo $presentar;
?>