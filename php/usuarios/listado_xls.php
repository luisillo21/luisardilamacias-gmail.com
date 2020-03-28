<?php
	SESSION_START();
	if(!isset($_SESSION['_user']))
	{
		header("location:../../index.php");
	}
	else
	{
		$GLOBALS['program_id'] = 101; // Personas
		include("../conexion.php");
		include("../valida_permisos.php");	
		if(valida_permisos($conexion,"I")!=1)
		{
			header('Location: ../mensaje.php?mensaje=Función No Permitida a Usuario&tipo=danger');
		}
		else
		{
				//include("funciones.php");
				include("../../PHPExcel-1.8/Classes/PHPExcel.php");

				// Recibo los parametros
				//$x_hoy 	= fechaCastellano(date("Y/m/d"),1);
				$x_hoy 	= date("Y/m/d");

				// Obtengo los Parametros Básicos del Sistema
				$query = " SELECT * FROM adm_parametros";
				$result = mysqli_query($conexion, $query) or die(mysqli_error());
				$row = mysqli_fetch_assoc($result);

				////////////////////////////////////////////////////////////////

				// Creo el Objeto
				$objPHPExcel = new PHPExcel();

				// Defino propiedades del archivo
				$objPHPExcel->getProperties()
							->setCreator('Dpto. de Sistemas')
							->setTitle('el titulo')
							->setDescription('la descripcion')
							->setKeywords('palabras claves')
							->setCategory('la categoria') ;

				$objPHPExcel->setActiveSheetIndex(0);
				$objPHPExcel->getActiveSheet()->setTitle($GLOBALS[program_name]); // Doy Nombre a la Hoja

				// Escribo y pongo formato a la primera fila que será el titulo del reporte
				$borders = array('font'=> array('bold'=>true, 'size'=>24, 'color'=> array('rgb'=>'030303'), 'name'=> 'Verdana'));
				$objPHPExcel->getActiveSheet()->setCellValue('A1','LISTADO DE '.strtoupper($GLOBALS['program_name']));
				
				// Inserto Logo de Institución en Cabecera
				$objDrawing = new PHPExcel_Worksheet_Drawing(); 
				$objDrawing->setName('test_img'); 
				$objDrawing->setDescription('test_img'); 
				$objDrawing->setPath('../../imagenes/logo.jpg'); 
				$objDrawing->setCoordinates('A1'); //setOffsetX works properly 
				$objDrawing->setOffsetX(5); 
				$objDrawing->setOffsetY(5); //set width, height 
				$objDrawing->setWidth(200); 
				$objDrawing->setHeight(50); 
				$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:D1');
				$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
				$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($borders);
				//////////////////////////////////////

				$objPHPExcel->getActiveSheet()->setCellValue('A3','USUARIO: ');
				$objPHPExcel->getActiveSheet()->setCellValue('B3',$_SESSION['_user']);

				$objPHPExcel->getActiveSheet()->setCellValue('C3','IMPRESO: ');
				$objPHPExcel->getActiveSheet()->setCellValue('D3',$x_hoy);
				
				$objPHPExcel->getActiveSheet()->getStyle("A1:A3")->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle("C1:C3")->getFont()->setBold(true);

				$objPHPExcel->getActiveSheet()->setCellValue('A4','Sec.');
				$objPHPExcel->getActiveSheet()->setCellValue('B4','Nombre');
				$objPHPExcel->getActiveSheet()->setCellValue('C4','Correo');
				$objPHPExcel->getActiveSheet()->setCellValue('D4','Telefono');
				
				// Ajusto Texto
				$objPHPExcel->getActiveSheet()->getStyle('E4:F4')->getAlignment()->setWrapText(true);

				// Defino el ancho de cada columna
				$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
				$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
				$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
				$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
				
				// pongo color de fondo a celdas que conforman la cabecera
				$objPHPExcel->getActiveSheet()
							->getStyle('A4:D4')
							->getFill()
							->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
							->getStartColor()->SetARGB('366092'); 

				$borders = array(
					'font' => array('bold' => true,'size'=> 14, 'color' => array('rgb' => 'ffffff')),
					'borders'=>array(
						'allborders'=>array(
							'style'=>PHPExcel_Style_Border::BORDER_THIN,
							'color'=>array('argb'=>'FF000000'),
							)
						),
					);
				$objPHPExcel->getActiveSheet()
							->getStyle('A4:D4')
							->applyFromArray($borders);

				// Protejo Libro
				//$objPHPExcel->getActiveSheet()->getProtection()->setPassword('el_password');
				$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
				$objPHPExcel->getActiveSheet()->getProtection()->setSort(true);
				$objPHPExcel->getActiveSheet()->getProtection()->setInsertRows(true);
				$objPHPExcel->getActiveSheet()->getProtection()->setFormatCells(true);

				// Obtengo los datos segun parametros recibidos
				$result = mysqli_query($conexion, "SELECT * FROM personas");
				$i = 5;

				while($data=mysqli_fetch_array($result, MYSQLI_ASSOC))
				{

					//$objPHPExcel->getActiveSheet()->setCellValue('A3',True); // Poniendo un valor Booleano

					// Justificando a la izquierda la celda
					$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					$objPHPExcel->getActiveSheet()->getStyle('J'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

					// Protejo o Desprotejo la celda
					//$objPHPExcel->getActiveSheet()->getStyle('A'.$i.':Q'.$i)->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

					// Dando Valor a las celdas
					$objPHPExcel->getActiveSheet()->setCellValue('A'.$i,$i-4);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.$i,$data['nombre']); 
					$objPHPExcel->getActiveSheet()->setCellValue('C'.$i,$data['correo']); 
					$objPHPExcel->getActiveSheet()->setCellValue('D'.$i,$data['telefono']); 

					$i = $i + 1;
				}
				
				header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
				$cadena = $GLOBALS['program_name'].".xlsx" ;
				header('Content-Disposition: attachment; filename="'.$cadena.'"');
				header('Cache-Control: max-age=0');

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
				$objWriter->save('php://output');
			}
	}
?>