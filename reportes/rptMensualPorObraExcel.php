<?php

date_default_timezone_set('America/Buenos_Aires');

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');


require_once '../excelClass/PHPExcel.php';

$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosReferancias 		= new ServiciosReferencias();

$fecha = date('Y-m-d');


//$header = array("Hora", "Cancha 1", "Cancha 2", "Cancha 3");

$fechaPost			= 	$_GET['fecha'];
$refobras		= 	$_GET['refobras'];

$arrayColumnas = array("B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP");

$objPHPExcel = new PHPExcel();


$objPHPExcel->getProperties()
		->setCreator("Exebin")
		->setLastModifiedBy("Exebin")
		->setTitle("Documento Excel")
		->setSubject("Documento Excel")
		->setDescription("Documento Excel Total Diario.")
		->setKeywords("Excel Office 2007 openxml php")
		->setCategory("Excel");
		 
		$tituloReporte = "Total Mensual";
		
		$objPHPExcel->setActiveSheetIndex(0)
			->mergeCells('A1:D1');
		
			
			 
		// Se agregan los titulos del reporte
		
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', htmlspecialchars(utf8_encode($tituloReporte)));
			
		
$lstFunciones = $serviciosReferancias->traerVentasPorObrasFecha($fechaPost, $refobras);

//die(print_r($lstFunciones));

$k = 0;

$primero = 0;

while ($hoja = mysql_fetch_array($lstFunciones)) {
	
	//die();
	
	$resVenta = $serviciosReferancias->traerVentasPorDiaFuncionActivos($hoja['fecha'], $hoja['idfuncion']);
	//die(print_r($resVenta));
	if (mysql_num_rows($resVenta)>0) {
		//die();
		
		$resDetalleVentaCategorias  = $serviciosReferancias->traerVentadetallePorVentaCategoria($hoja['idventa']);
		
		$resDetalleVentaPromociones = $serviciosReferancias->traerVentadetallePorVentaPromociones($hoja['idventa']);
		
		$resPuntosVentaPersonal = $serviciosReferancias->traerPuntosTotalesPorVenta($hoja['idventa']);
		
		$resGastos	= $serviciosReferancias->traerGastosPorFuncion($hoja['fecha'],$hoja['idfuncion']);
		
		$TotalCuponeras = 0;
		$TotalGastos = mysql_result($resGastos,0,0);
		$TotalesParciales = 0;
		$TotalesGeneral = 0;
		
		$descuentosParciales = 0;
		
		$valorPuntoParcial = 0;
		$valorPuntosDia = 0;
		$cantidadEntradasCuponeras = 0;
		
		// Crea un nuevo objeto PHPExcel
		
		
		
		
		
		
		if ($primero == 0) {	
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A3', 'Nombre') // Titulo del reporte
				->setCellValue('A4', 'Nro Venta')
				->setCellValue('A5', 'Fecha')
				->setCellValue('A6', 'Dia de la semana')
				->setCellValue('A7', 'Capacidad Total')
				->setCellValue('A8', 'Total Entradas')
				->setCellValue('A9', 'Porcentaje ocupacion sala')
				->setCellValue('A10', 'Precio Entrada');
		}
		
		
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue($arrayColumnas[$k].'3', mysql_result($resVenta,0,'obra')) // Titulo del reporte
			->setCellValue($arrayColumnas[$k].'4', mysql_result($resVenta,0,'numero'))
			->setCellValue($arrayColumnas[$k].'5', mysql_result($resVenta,0,'fecha'))
			->setCellValue($arrayColumnas[$k].'6', mysql_result($resVenta,0,'dia'))
			->setCellValue($arrayColumnas[$k].'7', mysql_result($resVenta,0,'capacidad'))
			->setCellValue($arrayColumnas[$k].'8', mysql_result($resVenta,0,'cantidad'))
			->setCellValue($arrayColumnas[$k].'9', (mysql_result($resVenta,0,'cantidad') * 100 / (mysql_result($resVenta,0,'capacidad') == 0 ? 1 : mysql_result($resVenta,0,'capacidad'))))
			->setCellValue($arrayColumnas[$k].'10', mysql_result($resVenta,0,'valorentrada'));
			
		
		
		$i= 11;
		while ($row = mysql_fetch_array($resDetalleVentaCategorias)) {
			if ($primero == 0) {
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $row['descripcion']);
			}
			
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($arrayColumnas[$k].$i, $row['cantidad']);
			
			$TotalCuponeras += $row['total']; 
			$cantidadEntradasCuponeras += 	$row['cantidad'];
			$i += 1;	
		}
		
		
		while ($row = mysql_fetch_array($resDetalleVentaPromociones)) {
			if ($primero == 0) {
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, $row['descripcion']);
			}
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($arrayColumnas[$k].$i, $row['cantidad']);
			
			//$TotalCuponeras += $row['total']; 
			$cantidadEntradasCuponeras += 	$row['cantidad'];
				
			$i += 1;	
		}
		
		if ($primero == 0) {
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i, 'Entradas cartelera');
		}
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($arrayColumnas[$k].$i, mysql_result($resVenta,0,'cantidad') - $cantidadEntradasCuponeras);
		
		if ($primero == 0) {
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.($i + 1), 'Efectivo')
			->setCellValue('A'.($i + 2), 'Ingreso con tarjeta')
			->setCellValue('A'.($i + 3), 'Ingreso Total sin cuponeras')
			->setCellValue('A'.($i + 4), 'Ingreso cuponeras')
			->setCellValue('A'.($i + 5), 'Otros ingresos/egresos')
			->setCellValue('A'.($i + 6), 'Ingreso Bruto Total');
		}
		
		$objPHPExcel->setActiveSheetIndex(0)	
			->setCellValue($arrayColumnas[$k].($i + 1), mysql_result($resVenta,0,'totalefectivo'))
			->setCellValue($arrayColumnas[$k].($i + 2), mysql_result($resVenta,0,'totaltarjeta'))
			->setCellValue($arrayColumnas[$k].($i + 3), mysql_result($resVenta,0,'totalefectivo') + mysql_result($resVenta,0,'totaltarjeta'))
			->setCellValue($arrayColumnas[$k].($i + 4), $TotalCuponeras)
			->setCellValue($arrayColumnas[$k].($i + 5), '')
			->setCellValue($arrayColumnas[$k].($i + 6), mysql_result($resVenta,0,'totalefectivo') + mysql_result($resVenta,0,'totaltarjeta') + $TotalCuponeras );
		
		$TotalesParciales = mysql_result($resVenta,0,'totalefectivo') + mysql_result($resVenta,0,'totaltarjeta') + $TotalCuponeras;
			
		$i = $i + 7;	
		
		if ($primero == 0) {
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.($i + 1), 'Deduciones de Arriba');
		}
		
		$i = $i + 1;
		
		$descuentosParciales = (float)mysql_result($resVenta,0,'valorpulicidad') + (float)mysql_result($resVenta,0,'costopapelentrada') + (float)mysql_result($resVenta,0,'gastotarjeta') + (float)mysql_result($resVenta,0,'argentores');
		
		if ($primero == 0) {
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.($i + 1), 'Publicidad ('.mysql_result($resVenta,0,'cantpulicidad').' entradas)')
			->setCellValue('A'.($i + 2), 'Costo papel entrada ($'.mysql_result($resVenta,0,'valorticket').' por entrada)')
			->setCellValue('A'.($i + 3), 'Gastos Tarjeta de crédito ('.mysql_result($resVenta,0,'costotranscciontarjetaiva').'% sobre compras con tarjeta)')
			->setCellValue('A'.($i + 4), 'Argentores - ('.mysql_result($resVenta,0,'porcentajeargentores').'%)')
			->setCellValue('A'.($i + 5), 'Gastos puntuales (limpieza, compra de insumos, etc) ')
			->setCellValue('A'.($i + 6), 'Catering')
			->setCellValue('A'.($i + 7), 'Ingreso neto');
		}
		
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue($arrayColumnas[$k].($i + 1), mysql_result($resVenta,0,'valorpulicidad'))
			->setCellValue($arrayColumnas[$k].($i + 2), mysql_result($resVenta,0,'costopapelentrada'))
			->setCellValue($arrayColumnas[$k].($i + 3), mysql_result($resVenta,0,'gastotarjeta'))
			->setCellValue($arrayColumnas[$k].($i + 4), mysql_result($resVenta,0,'argentores'))
			->setCellValue($arrayColumnas[$k].($i + 5), $TotalGastos)
			->setCellValue($arrayColumnas[$k].($i + 6), '')
			->setCellValue($arrayColumnas[$k].($i + 7), $TotalesParciales - $descuentosParciales - $TotalGastos);
		
		$TotalesGeneral = $TotalesParciales - $descuentosParciales - $TotalGastos;
		
		$i = $i + 8;	
		
		if ($primero == 0) {
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.($i + 1), 'Divisiones');
		}
		
		$i = $i + 1;
		
		if ($primero == 0) {
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.($i + 1), mysql_result($resVenta,0,'porcentajereparto').'% a cooperativa)')
			->setCellValue('A'.($i + 2), '30% a sala ')
			->setCellValue('A'.($i + 3), 'Retención coop para actores ('.mysql_result($resVenta,0,'porcentajeretencion').')')
			->setCellValue('A'.($i + 4), 'Argentores - ('.mysql_result($resVenta,0,'porcentajeargentores').'%)')
			->setCellValue('A'.($i + 5), 'Neto cooperativa')
			->setCellValue('A'.($i + 6), 'Pago por Punto')
			->setCellValue('A'.($i + 7), 'Observaciones');
		}
		
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue($arrayColumnas[$k].($i + 1), ($TotalesGeneral * mysql_result($resVenta,0,'porcentajereparto') / 100))
			->setCellValue($arrayColumnas[$k].($i + 2), ($TotalesGeneral * 30 / 100))
			->setCellValue($arrayColumnas[$k].($i + 3), (($TotalesGeneral * mysql_result($resVenta,0,'porcentajereparto') / 100) * mysql_result($resVenta,0,'porcentajeretencion') / 100))
			->setCellValue($arrayColumnas[$k].($i + 4), ($TotalesGeneral * mysql_result($resVenta,0,'porcentajeargentores') / 100))
			->setCellValue($arrayColumnas[$k].($i + 5), (($TotalesGeneral * mysql_result($resVenta,0,'porcentajereparto') / 100) - ($TotalesGeneral * mysql_result($resVenta,0,'porcentajeretencion') / 100)))
			->setCellValue($arrayColumnas[$k].($i + 6), (($TotalesGeneral * mysql_result($resVenta,0,'porcentajereparto') / 100) - ($TotalesGeneral * mysql_result($resVenta,0,'porcentajeretencion') / 100)) / mysql_result($resPuntosVentaPersonal,0,0))
			->setCellValue($arrayColumnas[$k].($i + 7), mysql_result($resVenta,0,'observacion'));
		
		
		$k += 1;
		$primero = 1;
	}
	
} //fin del while


/*


Divisiones
 70% a cooperativa 
 30% a sala 
 Retención coop para actores (6%) 
 Neto cooperativa 
 Pago por Punto 
 OBSERVACIONES 



*/


	


// Agregar Informacion
/*$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'Valor 1')
->setCellValue('B1', 'Valor 2')
->setCellValue('C1', 'Total')
->setCellValue('A2', '10')
->setCellValue('C2', '=sum(A2:B2)');*/



$estiloTituloReporte = array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>16,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array(
            'argb' => '0B87A9')
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
 
$estiloTituloColumnas = array(
    'font' => array(
        'name'  => 'Arial',
        'bold'  => true,
        'color' => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
        'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
    'rotation'   => 90,
        'startcolor' => array(
            'rgb' => '1ACEFF'
        ),
        'endcolor' => array(
            'argb' => '0AA3CE'
        )
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '143860'
            )
        ),
        'bottom' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '143860'
            )
        )
    ),
    'alignment' =>  array(
        'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap'      => TRUE
    )
);
 
$estiloInformacion = new PHPExcel_Style();
$estiloInformacion->applyFromArray( array(
    'font' => array(
        'name'  => 'Arial',
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
    'type'  => PHPExcel_Style_Fill::FILL_SOLID,
    'color' => array(
            'argb' => 'B8FEFF')
    ),
    'borders' => array(
        'left' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
        'color' => array(
                'rgb' => '2A4348'
            )
        )
    )
));

$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($estiloTituloReporte);

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Hoja1');
 
// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);


// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8');
header('Content-Disposition: attachment;filename="rptTotalDia.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;


?>

