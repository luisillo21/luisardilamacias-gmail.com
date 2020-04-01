 <?php
  SESSION_START();
  if(!isset($_SESSION['_user']))
  {
    header("location:../../index.php");
  }
  else
  {
    $GLOBALS['program_id'] = 201; // aula virtual
    include("../conexion.php");
    include("../valida_permisos.php");
    #include("core/modales.php");
    if(valida_permisos($conexion,"A")!=1)
    {
     header('Location: ../mensaje.php?mensaje=Función No Permitida a Usuario&programa=../php/personas/index.php&tipo=danger');
    }
  }
  
?>

<html lang="es">
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
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
    <div class="container">
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3 " id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="../../index.php" class="nav-link text-light">VOLVER A LA PANTALLA PRINCIPAL</a>
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
            <h1 class="m-0 text-dark"> Aula virtual | Listado de aulas </small></h1>
          </div>
          <div class="col-sm-7">
             <a data-toggle="modal" data-target="#modal-xl" class="btn btn-success btn-block text-light">Crear Classroom</a>
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

          <!-- /.col-md-6 -->
           <?php
           if (!$conexion) {
             echo "Error" . mysqli_error();
             exit();
          }
           $usuario = $_SESSION["_user"];
           $consulta = "SELECT * FROM cls_classroom where estado = 'A' AND autor = '$usuario'";
           if ($result= mysqli_query($conexion,$consulta)) {
              while ($data = mysqli_fetch_assoc($result)) {
          ?>
                   <div class="col-lg-6">
                        <div class="card card-primary card-outline">
                            <?php if($data['imagen']){ ?>
                            <img class="card-img-top"  src="media/classroom/<?php echo ''.$data["imagen"].''; ?>" alt="Sin foto de portada">
                            <?php } else{?>
                            <img class="card-img-top" src="media/classroom_fondo_clases.jpg">
                            <?php }?>
                            <div class="card-body">
                                <h2 class="card-title text-dark mb-3"><?php echo ''.$data["nombre"].''; ?></h2>
                                <p class="card-text"><?php echo ''.$data["descripcion"].''; ?></p>
                                <a href="post_clasroom.php?id=<?php echo ''.$data["id_classroom"].''; ?>" class="btn btn-primary">Entrar</a>
                                <a href="tabla_usuarios.php?id=<?php echo ''.$data["id_classroom"].''; ?>" class="btn btn-warning text-dark" >Asignar</a>
                                <a href="core/eliminar_classroom.php?id=<?php echo ''.$data["id_classroom"].''; ?>" class="btn btn-danger">Eliminar</a>
                                <a href="editar_classroom_form.php?id=<?php echo ''.$data["id_classroom"].''; ?>" class="btn btn-primary">Editar</a>
                            </div>
                        </div>
                   </div>
            <?php
              }
            }
            ?>
        </div>
      </div>
    </div>
  </div>
</div>



    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Aula virtual | Registrar classroom</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="card card-primary">
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" method="POST" action="core/guardar_classroom.php" enctype="multipart/form-data"  autocomplete="off">
                <div class="card-body">
                  
					        <div class="form-group">
					        	<label for="imagen">Seleccione una imagen de fondo</label>
                        <input type="hidden" name="MAX_TAM" value="2097152">
                        <input type="file" class="form-control" name="imagen" id="imagen"  accept="image/x-png,image/jpeg"   required>
					        </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" class="form-control" id="cls_nombre" name="cls_nombre" placeholder="Nombre" required>
                  </div>
                  <div class="form-group">
                    <label for="cls_descripcion">Descripcion</label>
                    <input type="text" class="form-control" id="cls_descripcion" name="cls_descripcion" placeholder="Escribe una descripcion de tu aula virtual" required>
                  </div>
                </div>
                <!-- /.card-body -->
              
            </div>
            </div>
            <div class="modal-footer justify-content-between">
              <a class="btn btn-danger btn-block text-light" data-dismiss="modal">Cancelar</a>
              <button type="submit" class="btn btn-primary btn-block">Guardar</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
     </div>

    

<script src="plugins/jquery/jquery.min.js"></script>
    <script src="js/modal.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

<script type="text/javascript">
$(document).ready(function () {
  
});
</script>
</body>
</html>

