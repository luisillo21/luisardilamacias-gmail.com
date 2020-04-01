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

  <title>Aula virtual | Calificar tareas</title>

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
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="gestion_tarea.php?id=<?php echo $_GET['id'];?>" class="nav-link text-light">Volver a la pantalla anterior</a>
          </li>
          
        </ul>

        <!-- SEARCH FORM -->
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2 ">
          <div class="col-sm-9">
            <h1 class="m-0 text-dark"> Aula virtual | Tareas </small></h1>
          </div>
          <!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  </div>


    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">

      <div class="card shadow">
            <div class="card-header bg-dark">
              <h3 class="card-title text-light"><strong>Gestionar deberes</strong></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr class="bg-dark">
                  <th>Usuario</th>
                  <th>Fecha de entrega</th>
                  <th>Fecha de limite de entrega</th>
                  <th>Descripcion del alumno</th>
                  <th>Calificacion</th>
                  <th>Observacion</th>
                  <th>Estado</th>
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

                    $consulta = "SELECT tu.usuario,tu.fecha_pub,tu.estado,t.fecha_entrega,tu.descripcion,tu.calificacion,tu.observacion,tu.id_usuario_tareas from cls_usuario_tareas tu inner join cls_cab_tareas t on tu.id_tarea = t.idcls_cab_tareas where t.idcls_cab_tareas=".$_GET['id_tarea'];

                    if ($result= mysqli_query($conexion,$consulta)) {
                      while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                      <td><?php echo ''.$data["usuario"].''; ?></td>
                      <td><?php echo ''.$data["fecha_pub"].''; ?></td>
                      <td><?php echo ''.$data["fecha_entrega"].''; ?></td>
                      <td><?php echo ''.$data["descripcion"].''; ?></td>

                      <?php if ($data['calificacion'] == 0) { ?>
                      <td>Sin calificar</td>
                      <?php }else{ ?>
                      <td><?php echo ''.$data["calificacion"].''; ?></td>
                      <?php } ?>

                      <?php if ($data['observacion'] == '') { ?>
                      <td>Sin observaciones</td>
                      <?php }else{ ?>
                      <td><?php echo ''.$data["observacion"].''; ?></td>
                      <?php } ?>
                      
                      <td>
                        <?php if ($data['estado'] == 'No revisado') { ?>
                            <label class="text-danger"><i class="fas fa-belll bg-danger"> No revisado</label></i>
                        <?php }else{ ?>
                             <label class="text-success"><i class="fas fa-check bg-success"></i><?php echo ''.$data["estado"].''; ?></label></td>
                        <?php } ?>
                      <td>
                        <a href="core/seccion_tareas/detalle_tareas.php?id=<?php echo ''.$_GET['id'].''?>&id_tarea=<?php echo ''.$data["id_usuario_tareas"].'';?>"  class="btn btn-primary text-light">
                        Calificar tarea
                      </a>
                      </td>
                    </tr>


                      <?php }
                    }?>


                </tbody>
                
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.modal-content -->
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

