<?php
	SESSION_START();
	if(!isset($_SESSION['_user']))
	{
		header("location:../../index.php");
	}
	else
	{
	ob_start();

	$GLOBALS['program_id'] = 101; // Personas
	include("../conexion.php");
	include("../valida_permisos.php");	
	if(valida_permisos($conexion,"I")!=1)
	{
		header('Location: ../mensaje.php?mensaje=Función No Permitida a Usuario&tipo=danger');
	}
	
	require_once("../../dompdf/dompdf_config.inc.php");

	$codigoHTML='
				<html><head>
						<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
						<title> '.$GLOBALS['program_name'].' </title>
						<style>
	    					@page { margin: 180px 50px; }
							#header { position: fixed; left: 0px; top: -180px; right: 0px; height: 180px; text-align: center; }
							#footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 50px; text-align: center;}
    						#footer .page:after { content: counter(page, upper-arial); }
						</style>
					</head><body>
						<div id="header">
							<img src="../../imagenes/logo.jpg" height="90px" width="90px">
							<center><h2>'.strtoupper($GLOBALS['program_name']).'</h2></center>
							<table border="1" width="100%" cellspacing="0" cellpadding="0">
								<tr>
								    <td><strong>NOMBRE</strong></td>
								    <td><strong>CORREO</strong></td>
								    <td><strong>TELEFONO</strong></td>
								</tr>
							</table>
						</div>
						<div id="footer">
			    			<p class="page">Pag </p>
			  			</div>
						<div id="content">
							<table width="100%" cellspacing="0" cellpadding="0">
						  '  ;
	$contador = 0;
	$result=mysqli_query($conexion, "SELECT * FROM personas ");
	while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$codigoHTML.='			<tr>
								<td>'.$row['nombre'].'</td>
								<td>'.$row['correo'].'</td>
								<td>'.$row['telefono'].'</td>
							</tr>
				 	 '	;
	}
	if($contador==0) { $codigoHTML.="No Existen Registros "; }
	
	$codigoHTML.='		</div>
					</table>
				</body></html>';
	
	echo $codigoHTML;

	$dompdf=new DOMPDF();
	$dompdf->set_paper('a4','portrait'); //portrait landscape

	$dompdf->load_html(ob_get_clean());
	$dompdf->render();
	$pdf = $dompdf->output();
	$filename = strtoupper($GLOBALS['program_name']).'.pdf';
	$dompdf->stream($filename, array("Attachment" => 0));
	}
?>