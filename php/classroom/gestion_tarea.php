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

  <title>Aula virtual | tareas</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-dark navbar-dark">
    <div class="container">
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="post_clasroom.php?id=<?php echo $_GET['id'];?>" class="nav-link text-light">Volver a la pantalla principal</a>
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
            <h1 class="m-0 text-dark"> Aula virtual | Tareas </small></h1>
          </div>
          <!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
            <div class="card-body pad table-responsive">
                <table class="table table-bordered text-center">
                    <tr>
                    <td style="width: 20px;">
                      <button type="button" class="btn btn-block bg-gradient-success" data-toggle="modal" data-target="#modal-asignar">Asignar deberes</button>
                    </td>
                    </tr>
                </table>
            </div>

      <div class="card">
            <div class="card-header">
              <h3 class="card-title">Lista de deberes</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Titulo</th>
                  <th>Descripcion</th>
                  <th>Fecha de entrega</th>
                  <th></th>

                </tr>
                </thead>
                <tbody>
                 <?php
                  if (!$conexion) {
                    echo "Error" . mysqli_error();
                    exit();
                    }
                    $id = $_GET["id"];
                    $consulta = "SELECT *  from  cls_cab_tareas  WHERE classroom=".$id;

                    if ($result= mysqli_query($conexion,$consulta)) {
                      while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                      <td><?php echo ''.$data["titulo"].''; ?></td>
                      <td><?php echo ''.$data["descripcion"].''; ?></td>
                      <td><?php echo ''.$data["fecha_entrega"].''; ?></td>
                      <td>
                        <a href="ver_tareas.php?id=<?php echo $_GET['id']; ?>&id_tarea=<?php echo ''.$data["idcls_cab_tareas"].''; ?>" class="btn btn-info">Ver tareas entregadas</a> 
                      </td>
                    </tr>


                      <?php }
                    }?>


                </tbody>
                
              </table>
            </div>
            <!-- /.card-body -->
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
              <form class="form-horizontal" method="POST" action="guardar.php" autocomplete="off">
                <div class="card-body">
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

<div class="modal fade" id="modal-asignar">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Aula virtual | Asignar usuarios</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="card card-primary">
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="core/seccion_tareas/enviar_tarea.php" autocomplete="off">
                <div class="card-body">
                  <div class="form-group">
        
						          <div class="form-group">
                            <label>Titulo</label>
                            <input type="text" name="titulo" id="titulo" class="form-control" required="">
					             </div>
                      <div class="form-group">
                            <label>Fecha de entrega</label>
                            <input type="date" name="fecha_entrega" id="fecha_entrega" class="form-control" required="">
                       </div>

                      <div class="form-group">
                            <label>Descripcion</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" required="">
                       </div>

                      <div class="form-group">
                            <label>Imagen</label>
                            <input type="hidden" name="MAX_TAM" value="2097152">
                            <input type="file" class="form-control" accept="image/x-png,image/jpeg" id="imagen" name="imagen">
                       </div>

					          <div class="form-group">
					          		<input type="hidden"  class="form-control" id="id_classroom" name="id_classroom" value="<?php echo ''.$_GET["id"].''; ?>"/>
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
    
    <div class="modal fade" id="mostrar_modal" role="dialog">
    </div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="js/modal.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="dist/js/demo.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/select2/js/select2.full.min.js"></script>
<script>
  $(function () {
    $('.select2').select2();
    $('.select2').select2({
      theme: 'bootstrap4'
    })
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });

    function modal(url){
        var $ = jQuery.noConflict();
        $('#mostrar_modal').load(url, function(){
            $(this).modal('show');
        });
    }

</script>
</body>
</html>

