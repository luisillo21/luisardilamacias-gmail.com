
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
  <title>Aula virtual</title>

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
  <nav class="main-header navbar navbar-expand-md navbar-dark navbar-dark">
    <div class="container">
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index.php" class="nav-link text-light">Volver a la pantalla principal</a>
          </li>
          <li class="nav-item">
            <a href="gestion_tarea.php?id=<?php echo $_GET['id']; ?>" class="nav-link text-light">Asignar tareas</a> 
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
            <h1 class="m-0 text-dark"> Aula virtual | Publicacion </small></h1>
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
          <div class="col-md-12">
            <div class="card card-widget">
                <!-- /.card-tools -->
              <!-- /.card-header -->
            <form method="POST" name="post_form" id="post_form" action="core/guardar_post.php" enctype="multipart/form-data">

              <div class="card-body" style="display: block;">
                    <input type="hidden" name="MAX_TAM" value="2097152">
                    <input type="hidden" name="id" id="id" value="<?php  echo $_GET['id'] ?>">
                    <input type="text" required="" class="form-control" name="descripcion" id="descripcion" placeholder="Escribe algo..." />
                      <br>
                    <input type="file" class="form-control" name="archivo[]" id="archivo[]" multiple="" placeholder="Seleccionar archivo" />
              </div>

              <div class="card-footer" style="display: block;">
                <button type="submit" class="btn btn-success text-light btn-block">Publicar</a>
              </div>

                  </form>
              </div>
                    
              <!-- /.card-footer -->
            </div>
          </div>

        <?php
           require ('core/BDD.php');
           $usuario = $_SESSION["_user"];
           $id = $_GET['id'];

           $lista = BDD::QUERY("SELECT * FROM cls_posts_classroom WHERE classroom=$id ORDER BY fecha"); 
           foreach ($lista as $data) {
           ?>

          <div class="row">
            <div class ="col-md-12">
              <div class="card card-widget">
              <div class="card-header bg-dark">
                <div class="user-block text-light">
                  <img class="img-circle" width="100%" src="media/Logo_usuario/default_avatar.png" alt="User Image">
                  <span class="username text-light"><p class="text-light"><?php echo $data['usuario']?></p></span>
                  <span class="description text-light">Compartido el - <?php echo $data['fecha']?></span>
                </div>


                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>

              </div>

              <div class="card-body" style="display: block;">
                <p><?php echo $data['descripcion'];?></p><br>
                  <?php 
                      $detalle= BDD::QUERY("SELECT recurso FROM cls_post_detalle_classroom where post_clasroom=".$data['id_cls_posts_classroom']);
                      $ruta = "media/biblioteca/";
                      if (!empty($detalle)) {
                      ?>      
                      <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                       <?php foreach($detalle as $r){ ?> 
                          <li>
                            <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>
                              <div class="mailbox-attachment-info">
                                <a class="mailbox-attachment-name"><i class="fas fa-paperclip"></i><?php echo $r['recurso']; ?></a>
                                    <span class="mailbox-attachment-size clearfix mt-1">
                           
                                      <a href="<?php echo $ruta.$r['recurso']; ?>" onclick="window.open(this.href, this.target, 'width=600,height=700'); return false;" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i>
                                      </a>
                                    </span>
                              </div>
                          </li>
                          <?php } ?>                    
                        </ul>
                       <?php }else{ echo " "; } ?> 
                    
                <?php $fila = BDD::QUERY("SELECT COUNT(idcls_detalle_post) as num_c FROM cls_post_comentarios where id_post=".$data['id_cls_posts_classroom']);
                  foreach ($fila as $c) { ?>
                    <a onclick="" class="float-right text-muted p-2"><?php echo $c['num_c']; ?> Comentarios</a>
                  <?php }?>
              </div>


              <div class="card-footer card-comments" id="comentarios" style="display: block;">
                      <?php 
                           $comentarios = "SELECT id_post,comentario,usu_nombre,foto,fecha_pub 
                            from cls_post_comentarios,adm_usuarios 
                            where usuario =usu_id and  id_post =".$data['id_cls_posts_classroom'];
                            $lst_c = BDD::QUERY($comentarios);
                            foreach ($lst_c as $c) {
                            ?>
                            <div class="card-comment py-4">
                               <img class="img-circle img-sm" src="media/Logo_usuario/default_avatar.png" alt="User Image">
                                     <div class="comment-text">
                                       <span class="username">
                                         <?php echo $c['usu_nombre']?>
                                          <span class="text-muted float-right"><?php echo $c['fecha_pub']?></span>
                                          </span>
                                          <?php echo $c['comentario']?>
                                      </div>
                            </div>
                           <?php } ?> 
              </div>

              <div class="card-footer" style="display: block;">
                <form action="core/comentar.php" method="post">
                   <input type="hidden" name="id_post_actual" id="id_post_actual" value="<?php echo $_GET['id'];?>"> 
                  <input type="hidden" name="id_post" id="id_post" value="<?php echo $data['id_cls_posts_classroom'];?>">
                  <img class="img-fluid img-circle img-sm" src="media/Logo_usuario/default_avatar.png" alt="Alt Text">
                  <!-- .img-push is used to add margin to elements next to floating images -->
                  <div class="img-push">
                    <input type="text" id="c_usuario" name="c_usuario" class="form-control form-control-sm" placeholder="Presiona enter para comentar" required="">
                  </div>
                </form>
              </div>
              <!-- /.card-footer -->
            </div>

            </div>
              </div>
            <?php     
          }
          ?>
      </div>
    </div>





<div class="modal fade" id="mostrar_modal" role="dialog">

</div>

    

<script src="plugins/jquery/jquery.min.js"></script>
<script src="js/modal.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="dist/js/adminlte.min.js"></script>
</body>
</html>

