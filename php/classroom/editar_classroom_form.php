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





	






<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>AdminLTE 3 | Top Navigation</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="../../index.php" class="nav-link bg-info">VOLVER A LA PANTALLA PRINCIPAL</a>
          </li>
          
        </ul>

        <!-- SEARCH FORM -->
        
      </div>

   
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2 ">
          <div class="col-sm-5">
            <h1 class="m-0 text-dark"> Aula virtual | Editar aula virtual </small></h1>
          </div>
          <!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
			<?php
           if (!$conexion) {
             echo "Error" . mysqli_error();
             exit();
          }
           $usuario = $_SESSION["_user"];
           $consulta = "SELECT * FROM cls_classroom where id_classroom=".$_GET['id'];
           if ($result= mysqli_query($conexion,$consulta)) {
              while ($data = mysqli_fetch_assoc($result)) {
          ?>
		<div class="col-md-12">
			   <div class="card card-primary">
              <div class="card-header">
              	<?php
              		if ($data["imagen"]) {
              	?>
                <img class="card-img-top" src="media/classroom/<?php echo ''.$data["imagen"].''; ?>">
              	<?php } else{ ?>
              	<img class="card-img-top" src="media/classroom_fondo_clases.jpg">	
              	<?php  } ?>
              </div>

              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" enctype="multipart/form-data"  autocomplete="off" action="core/editar_classroom.php" method="POST">
                <div class="card-body">

                  <div class="form-group">
                    <label for="cls_nombre">Nombre</label>
                   <input type="text" class="form-control" id="cls_nombre" value="<?php echo ''.$data["nombre"].''; ?>" name="cls_nombre" required>
                  </div>


                  <div class="form-group">
                    <label for="cls_descripcion">Descripcion</label>
                   	<input type="text" name="cls_descripcion"  class="form-control" id="cls_descripcion" value="<?php echo ''.$data["descripcion"].''; ?>" required>
                  </div>
  				  


                  <div class="form-group">
                    <label for="nueva_imagen">Seleccione una foto</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="hidden" type="text" name="id" id="id" value="<?php echo ''.$data["id_classroom"].''; ?>">
                        <input type="hidden"name="old_imagen" id="old_imagen" type="text" value="<?php echo ''.$data["imagen"].''; ?>">

						<input type="hidden" name="MAX_TAM" value="2097152">
							<input type="file" class="form-control" accept="image/x-png,image/jpeg" id="" name="nueva_imagen">

                      </div>
                    </div>
                  </div>

                <div class="card-footer">
                  <input type="submit" name="Actualizar" id="Actualizar" class="btn btn-success btn-block text-light" value="Actualizar" />
                </div>      
       		</div>
       	</form>
   		</div>
		</div>
       
   		<?php
   			}}
   		?>
    

<script src="plugins/jquery/jquery.min.js"></script>
    <script src="js/modal.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script>
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>

