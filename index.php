<?php
	session_start();
	if(!isset($_SESSION['_user']))
	{
		$html = "
				<html>
					<head>
				  		<title> Sistema </title>
				  		<script type='text/javascript' src='./js/funciones.js'> 				</script>
						<script type='text/javascript' src='./js/alertify/alertify.js'> 		</script>
						<script type='text/javascript' src='./js/alertify/alertify.min.js'> 	</script>
						<script type='text/javascript' src='./js/jquery-3.4.1.min.js'>			</script>
						<script type='text/javascript' src='./bootstrap/js/bootstrap.min.js'>	</script>
						<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'/>
						<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'/>
						<link rel='stylesheet' href='./css/estilo.css'>
						<link rel='stylesheet' href='./js/alertify/css/alertify.css' />
						<link rel='stylesheet' href='./js/alertify/css/alertify.min.css' />
						<link rel='stylesheet' href='./bootstrap/css/bootstrap.min.css'>
					</head>
					<body>
					  	<div class='container'>
							<center> 
								<p> </p>
								<img src='./imagenes/logo.jpg'>
								<form class='form-signin' method='post' action='./php/validausuario.php'>
									<h2 class='form-signin-heading'>Ingrese su Usuario</h2>
						        	<input type='user' id='usuario' name='usuario' class='form-control' placeholder='Usuario' required pattern='[A-Za-z0-9_-]{1,15}' autofocus>
						        	<input type='password' id='clave' name='clave' class='form-control' placeholder='Clave' pattern='[A-Za-z0-9_-]{1,15}' required>
						        	<button class='btn btn-lg btn-primary btn-block' type='submit'>Ingresar</button>
					    		</form>
					    	</center>
					    </div>
					</body>
				</html>
				"	;
		echo $html;
	}
	else
	{
		header('Location: ./php/menu.php');
	}
?>