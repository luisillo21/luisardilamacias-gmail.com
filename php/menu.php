<?php
  SESSION_START();
  if(!isset($_SESSION['_user']))
  {
    header("location:../index.php");
  }
  include("conexion.php");
  
  $id_system  = $_SESSION["_system"];

  // Obtengo los datos de Parametros Basicos
  $sql = "SELECT * FROM adm_parametros ";
  $fila = mysqli_fetch_assoc(mysqli_query($conexion, $sql) );
  $xx_nombre_largo    = $fila['par_nombreLargo'];
  $xx_nombre_corto    = $fila['par_nombreCorto'];

  // Obtengo los datos del Usuario
  $sql = "SELECT * FROM adm_usuarios, adm_roles WHERE usu_id = '$user' AND usu_rol = rol_id ";
  $fila = mysqli_fetch_assoc(mysqli_query($conexion, $sql));
  if ( $fila['usu_estado'] != 'A' )
  {
    $cadena = "Location: mensaje.php?mensaje=Usuario Inactivo...<br>Consulte en Sistemas&programa=salir.php&tipo=danger";
    header($cadena);
  }

  $xx_tipo_usuario = $fila['rol_descripcion'];
  $xx_name_usuario = $fila['usu_nombre'];
  $xx_tp_usuario   = $fila['TipoUsuario'];

  if($fila['FotoUsuario']!=NULL)
  $foto_user          = "./documentos/".$fila['FotoUsuario'];

  if (!file_exists($foto_user))
  { $foto_user = "../imagenes/avatar.jpg"; }

  $cadena = "";

  // Obtengo los Programas Padres Autorizados para el usuario logoneado.. en tanto el "sub-sistema" este activo
  $result = mysqli_query($conexion,
                        " SELECT * FROM adm_menus, adm_programas, adm_sistemas
                          WHERE adm_menus.adm_programa = adm_programas.pro_id
                          AND adm_sistema = $id_system AND adm_tipo = 'P'
                          AND sis_id =  adm_sistema
                      ");

  while($data = mysqli_fetch_assoc($result))
  {
    $sistema_name = $data['sis_descripcion'];
    $menuPadre    = $data['adm_padre'];
    $menuName     = $data['pro_descripcion'];
    $cadena       = $cadena."
                            <li class='treeview'> 
                              <a href=''>
                                <i class='fa fa-book'></i> <span>$menuName</span>
                                <span class='pull-right-container'> <i class='fa fa-angle-left pull-right'></i></span>
                              </a> 
                              <ul class='treeview-menu'>
                            ";

    // Obtengo los Programas Hijos Autorizados para el usuario logoneado
    $result2 = mysqli_query($conexion,
                          " SELECT * FROM adm_menus, adm_programas, adm_permisos, adm_usuarios, adm_roles, adm_sistemas
                            WHERE adm_padre = $menuPadre
                            AND pro_id = adm_programa
                            AND adm_tipo = 'H'
                            AND pro_id = per_programa
                            AND rol_id = usu_rol
                            AND usu_id  = '$user'
                            AND per_rol = usu_rol
                            AND rol_estado = 'A'
                            AND sis_estado = 'A'
                            AND sis_id = $id_system
                        ");  

    /*
      SELECT * FROM adm_menus, adm_programas, adm_permisos, adm_usuarios, adm_roles, adm_sistemas
                            WHERE adm_padre = $menuPadre
                            AND pro_id = adm_programa
                            AND adm_tipo = 'H'
                            AND pro_id = per_programa
                            AND rol_id = usu_rol
                            AND per_rol = usu_rol
                            AND usu_id  = $user
                            AND rol_estado = 'A'
                            AND sus_id = $id_system
                            AND sis_estado = 'A'
                            GROUP BY pro_descripcion
    */

    while($data2 = mysqli_fetch_assoc($result2))
    {
      $program_id   = $data2['pro_id'];
      $program_name = $data2['pro_descripcion'];
      $program_ruta = $data2['pro_ruta'];
      $program_blank= "";
      if($data2['pro_target']=='S') { $program_blank = "target='_blank' " ; }
      $cadena      = $cadena." 
                        <li class='active' onclick='set_cookie(\"cookie_id_program\",\"$program_id\")'><a href='$program_ruta' $program_blank >
                        <i class='fa fa-circle-o'></i> $program_name </a></li>
                      ";
    } 

    $cadena      = $cadena."
                    </ul>
                    </li>
                      ";  
  }
  

  $presentar = "
  <!DOCTYPE html>
  <html>
  <head>
    <link rel='stylesheet' href='../css/estilos_slider.css'>
    <link rel='stylesheet' href='../css/font-awesome.css'>
    <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
    
    <script src='../js/jquery-3.4.1.min.js'></script>
    <script src='../js/main.js'></script>
    <script src='../js/funciones.js'>          </script>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title> $sistema_name </title>
    <link rel='stylesheet' href='../bootstrap/css/bootstrap.min.css'>

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css'>

    <link rel='stylesheet' href='../dist/css/AdminLTE.min.css'>
    <link rel='stylesheet' href='../dist/css/skins/_all-skins.min.css'>

    <link rel='stylesheet' href='../plugins/jvectormap/jquery-jvectormap-1.2.2.css'>
    <link rel='stylesheet' href='../plugins/datepicker/datepicker3.css'>
    <link rel='stylesheet' href='../plugins/daterangepicker/daterangepicker.css'>
    <link rel='stylesheet' href='../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'>
  </head>

  <body class='sidebar-mini skin-blue' data-gr-c-s-loaded='true' style='height: auto; min-height: 100%;'>
    <div class='wrapper'>
      <header class='main-header bg-dark'>
        <a href='#' class='logo'>
          <span class='logo-mini'><b>$xx_nombre_corto </b></span>
          <span class='logo-lg'>  <b>$xx_nombre_corto </b></span>
        </a>

        <a href='#' class='sidebar-toggle' data-toggle='offcanvas' role='button' title='Menu'>  </a>
        
        <nav class='navbar navbar-static-top bg-dark'>
          <div class='navbar-custom-menu bg-dark'>
            <ul class='nav navbar-nav bg-dark'>
              
              <li class='dropdown user user-menu'>
                <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                  <span class='hidden-xs'>Desarrollado por </span>
                </a>
                <ul class='dropdown-menu'>
                  <li class='user-header'>
                    <p> Desarrollado por: </p>
                    <hr>
                    <p>  </p>
                    <p> Lorenza Bodero </p>
                    <p> Maria Maldonado </p>
                    <p> Luis Lopez </p>
                  </li>

                  <!-- Menu Footer-->
                  <li class='user-footer'>
                    <div class='pull-left'> </div>
                    <div class='pull-right'>
                      <a href='#' class='btn btn-default btn-flat'>Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>

              <li class='dropdown user user-menu'>
                <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                  <span class='hidden-xs'>Acerca de</span>
                </a>
                <ul class='dropdown-menu'>
                  <li class='user-header'>
                    <br>
                    <p> Sistema Informàtico de <br>Gestiòn Acadèmica</p>
                    <p> </p>
                    <p> Versiòn 1.0 </p>
                  </li>

                  <!-- Menu Footer-->
                  <li class='user-footer'>
                    <div class='pull-left'> </div>
                    <div class='pull-right'>
                      <a href='#' class='btn btn-default btn-flat'>Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>

              <li class='dropdown user user-menu'>
                <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                  <span class='hidden-xs'>Usuario</span>
                </a>
                <ul class='dropdown-menu'>
                  <li class='user-header'>
                    <img src='$foto_user' class='img-circle' alt='Foto Usuario'>
                    <p> $xx_name_usuario </p>
                    <p> $xx_tipo_usuario </p>
                  </li>

                  <!-- Menu Footer-->
                  <li class='user-footer'>
                    <div class='pull-left'> </div>
                    <div class='pull-right'>
                      <a href='#' class='btn btn-default btn-flat'>Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </div>
        </nav>

      </header>

      <!-- Left side column. contains the logo and sidebar -->
      <aside class='main-sidebar'>
        <!-- sidebar: style can be found in sidebar.less -->
        <section class='sidebar'>
          <!-- Sidebar user panel -->
          <div class='user-panel'>
            <div class='pull-left image'>
              <img src='$foto_user' class='img-circle' alt='User Image'>
            </div>
            <div class='pull-left info'>
              <p> <h4> $user </h4>$xx_tipo_usuario </p>
            </div>
          </div>
          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class='sidebar-menu'>
            <li class='header'><h4> <center> MENU PRINCIPAL </center></h4></li>
            ".$cadena."
             <li>
              <a href='salir.php'>
                <i class='fa fa-power-off'></i> <span>Salir del Sistema</span>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class='content-wrapper'>
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class='content'>
          <!-- Small boxes (Stat box) -->
          <marquee> <h4 style='color:rgba(93, 173, 226);'> $xx_nombre_largo </h4> </marquee>
          <div class='row'>
            <div class='col-lg-3 col-xs-6'>
              <!-- small box -->
              <div class='small-box bg-aqua'>
                <div class='inner'>
                  <h3>80</h3>
                  <p>Docentes</p>
                </div>
                <div class='icon'>
                  <i class='ion ion-person'></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class='col-lg-3 col-xs-6'>
              <!-- small box -->
              <div class='small-box bg-green'>
                <div class='inner'>
                  <h3>75<sup style='font-size: 20px'>%</sup></h3>
                  <p>Notas Asentadas</p>
                </div>
                <div class='icon'>
                  <i class='ion ion-stats-bars'></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class='col-lg-3 col-xs-6'>
              <!-- small box -->
              <div class='small-box bg-yellow'>
                <div class='inner'>
                  <h3>2920</h3>
                  <p>Alumnos Matriculados</p>
                </div>
                <div class='icon'>
                  <i class='ion ion-person-stalker'></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class='col-lg-3 col-xs-6'>
              <!-- small box -->
              <div class='small-box bg-red'>
                <div class='inner'>
                  <h3>53<sup style='font-size: 20px'>%</sup></h3>
                  <p>Inasistencia</p>
                </div>
                <div class='icon'>
                  <i class='ion ion-pie-graph'></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <div class='row'>

            <div class='slideshow'>
              <ul class='slider'>
                <li> <img src='../imagenes/1.jpg' alt=''> </li>
                <li> <img src='../imagenes/2.jpg' alt=''> </li>
                <li> <img src='../imagenes/3.jpg' alt=''> </li>
              </ul>
              <div class='left'> <span class='fa fa-chevron-left'></span> </div>
              <div class='right'> <span class='fa fa-chevron-right'></span> </div>
            </div>            

          </div>
        
                      
          <!-- /.row (main row) -->
        </section>
        <!-- /.content -->

      </div>
      <!-- /.content-wrapper -->

      <footer class='main-footer'>
        <div class='pull-right hidden-xs'>
          <b>Version</b> 1.0
        </div>
        Todos los derechos reservados. &copy; 
      </footer>

    </div>

    <script src='../plugins/jQuery/jquery-2.2.3.min.js'></script>
    <script src='https://code.jquery.com/ui/1.11.4/jquery-ui.min.js'></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>

    <script src='../bootstrap/js/bootstrap.min.js'></script>
    <script src='../plugins/sparkline/jquery.sparkline.min.js'></script>
    <script src='../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
    <script src='../plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
    <script src='../plugins/knob/jquery.knob.js'></script>
    <script src='../dist/js/app.min.js'></script>
  </body>
  </html>
  ";
echo $presentar;
?>