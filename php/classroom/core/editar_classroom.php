<?php  
    require '../../conexion.php';
    $id = $_POST['id'];
    $nombre = $_POST['cls_nombre'];
    $descripcion = $_POST['cls_descripcion'];
    $old_imagen = $_POST['old_imagen'];
    $nueva_imagen = $_FILES['nueva_imagen']['name'];

        if (isset($_POST['Actualizar'])) {

                $sql = "UPDATE cls_classroom set nombre = '$nombre',descripcion = '$descripcion',imagen='$nueva_imagen' where id_classroom =".$id;
                $resultado = $mysqli->query($sql);
                if ($resultado) {

                    if ($_FILES['imagen']['error']) {
                        switch ($_FILES['imagen']['error']) {
                        case 1: // Error exceso de tamaño de archivo en php.ini
                        echo "El tamaño del archovi exede a lo permitido del servidor";
                        break;  
                        case 2: // Error tamaño archivo marcado desxde el formullario
                        echo "el tamañoi del archivo excede dos megas";
                        break;
                        case 3: //corrupcion de archivo
                            echo "el envio de archivo se interrumpio";
                            beak;
                        case 4://No subio imagen iniguna
                            echo "no se a enviado archivo alguno";
                            break;
                        default:
                    }
                }else{
                    if((isset($_FILES['nueva_imagen']['name']) && ($_FILES['imagen']['error'] == UPLOAD_ERR_OK))) {
                        unlink("../media/classroom/".$old_imagen);
                        $destino_de_ruta = "../media/classroom/";
                        move_uploaded_file($_FILES['nueva_imagen']['tmp_name'],$destino_de_ruta . $_FILES['nueva_imagen']['name']);
                        chmod($destino_de_ruta,0777);
                        chmod("../media/classroom/".$archivo,0777); 
                    }else{
                        echo "el archivo nose a podido copiar a la carpeta imagenes";
                }
                }



                    header("location:../index.php");
                }

                echo "Error sql <br>";
                echo $id."<br>";
                echo $nombre."<br>";
                echo $descripcion."<br>";
                echo $old_imagen."<br>";
                echo $nueva_imagen."<br>";
            
        }

?>