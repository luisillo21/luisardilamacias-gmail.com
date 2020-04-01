<?php
  SESSION_START();
  if(!isset($_SESSION['_user']))
  {
    header("location:../../index.php");
  }
  else
  {
    $GLOBALS['program_id'] = 201; // aula virtual
    include("../../../conexion.php");
    include("../../../valida_permisos.php");

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
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
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
            <a href="../../gestion_tarea.php?id_tarea=<?php echo $_GET['id_tarea'] ?>&id=<?php echo $_GET['id'];?>" class="nav-link text-light">Volver a la pantalla anterior</a>
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
      <div class="container">

      <div class="card shadow">
            <div class="card-header bg-dark">
              <h3 class="card-title text-light text-center"><strong>Gestionar deberes</strong></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

            

          

              <?php
                  if (!$conexion) {
                    echo "Error" . mysqli_error();
                    exit();
                    }
                    $id = $_GET["id"];
                    $consulta = "SELECT tu.estado,tu.recurso,t.titulo,tu.usuario,tu.fecha_pub ,t.fecha_entrega,tu.descripcion,tu.calificacion,tu.observacion,tu.id_usuario_tareas from cls_usuario_tareas tu inner join cls_cab_tareas t on tu.id_tarea = t.idcls_cab_tareas where t.idcls_cab_tareas=".$_GET['id_tarea'];
                      if ($result= mysqli_query($conexion,$consulta)) {
                      while ($data = mysqli_fetch_assoc($result)) {
                    ?>


              <div class="row justify-content-center">
                  <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                  <li>
                  <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>
                  <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"><?php echo ''.$data["recurso"].''; ?></i></a>
                        <span class="mailbox-attachment-size clearfix mt-1">
                          <a href="../../media/tareas_entregadas/Calculo_deber.xlsx" onclick="window.open(this.href, this.target, 'width=600,height=700'); return false;" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                        </span>
                  </div>
                  </li>
              </ul>

              </div>
              
              <form class="form-horizontal" method="POST" action="calificar_tarea.php" autocomplete="off">
                  <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'];?>" />
                  <input type="hidden" name="id_tarea" id="id_tarea" value="<?php echo $_GET['id_tarea']; ?>"/>  
                  <input type="hidden" name="id_usuario_tareas" id="id_usuario_tareas" value="<?php echo $data['id_usuario_tareas']; ?>"/>  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Descripcion del estudiante</label>
                    <textarea required class="form-control" readonly="" name="descripcion_est"><?php echo ''.$data["descripcion"].''; ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="cls_descripcion">Fecha de entrega</label>
                    <input type="date" value="<?php echo ''.$data["fecha_pub"].''; ?>" readonly class="form-control" id="fecha_pub" name="fecha_pub" placeholder="Escribe una descripcion de tu aula virtual" required>
                  </div>

                  <div class="form-group">
                    <label for="cls_descripcion">Fecha limite de entrega</label>
                    <input type="date" value="<?php echo ''.$data["fecha_entrega"].''; ?>" readonly class="form-control" id="fecha_entrega" name="fecha_entrega" placeholder="Escribe una descripcion de tu aula virtual" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Observaciones de la tarea</label>
                    <?php if ($data["observacion"] == '' || $data["observacion"] == 'Sin observaciones') { 
                    ?>
                    <textarea required class="form-control is-invalid" id="observacion" name="observacion">Sin observaciones</textarea>
                    <?php } else {?>
                    <textarea required class="form-control is-valid" id="observacion" name="observacion"><?php echo ''.$data["observacion"].''; ?></textarea>
                    <?php } ?>
                  </div>

                   <div class="form-group">
                    <label for="exampleInputEmail1">Estado</label><br>
                    <?php if ($data["estado"] == 'No revisado') { 
                    ?>
                    <label class="col-form-label text-danger"><i class="fas fa-bell bg-danger text-danger"></i> Sin calificar</label>
                    <input type="hidden" name="estado" id="estado" value="<?php echo ''.$data["estado"].''; ?>"/>
                    <?php } else {?>
                    <input type="hidden" name="estado" id="estado" value="<?php echo ''.$data["estado"].''; ?>"/>  
                    <label class="col-form-label text-success"><i class="fas fa-check bg-success"></i>Calificado</label>
                    <?php } ?>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Nota del estudiante</label>
                    <?php if ($data["calificacion"] == 0) { 
                    ?>
                    <label for="calificacion">( Sin calificar )</label>
                    <input type="number" min="0" max="10" required class="form-control is-invalid" id="calificacion" name="calificacion" value="0" />
                    <?php } else{ ?>
                    <label for="calificacion"> ( Calificado )</label>
                    <input type="number" min="0" max="10" required class="form-control is-valid" id="calificacion" name="calificacion" value="<?php echo ''.$data["calificacion"].''; ?>"/>
                    <?php } ?>
                  </div>


                  <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block" value="Finalizar revision" />
                    <a href="../../gestion_tarea.php?id_tarea=<?php echo $_GET['id_tarea'] ?>&id=<?php echo $_GET['id'];?>" class="btn btn-danger btn-block">Cancelar</a>    
                  </div>





              </form>

              <?php }
            }?>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.modal-content -->
        <!-- /.modal-dialog -->
      </div>
    </div>
    
    <div class="modal fade" id="mostrar_modal" role="dialog">
    </div>

<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../js/modal.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="../../dist/js/demo.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../plugins/select2/js/select2.full.min.js"></script>
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

