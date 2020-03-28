
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
<html lang="en">
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
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="../../index.php" class="nav-link">Volver a la pantalla principal</a>
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
             <a onclick="modal('crear_classroom.php')" class="btn btn-success btn-block text-light">Crear Classroom</a>
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

         # <!-- /.col-md-6 -->
         #  <?php
         #  if (!$conexion) {
         #    echo "Error" . mysqli_error();
         #    exit();
         # }
         #  $usuario = $_SESSION["_user"];
         #  $consulta = "SELECT * FROM cls_classroom where estado = 'A' AND autor = '$usuario'";
         #  if ($result= mysqli_query($conexion,$consulta)) {
         #     while ($data = mysqli_fetch_assoc($result)) {
         # ?>
                  <!--
                   <div class="col-lg-6">
                        <div class="card card-primary card-outline">
                            <img class="card-img-top" src="../../imagenes/2.jpg" alt="Card image cap">
                            <div class="card-body">"
                                <h3 class="card-title text-dark mb-3"></h3>
                                <p class="card-text"></p>
                                <a href="#" class="btn btn-primary">Entrar al aula virtual</a>
                                <a href="#" class="btn btn-success">Asignar estudiantes al aula virtual</a>
                            </div>
                        </div>
                   </div>
                  -->
            <?php
         #     }
         #   }
         #   ?>
        </div>
      </div>
    </div>
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

