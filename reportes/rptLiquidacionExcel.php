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
$serviciosReferencias 		= new ServiciosReferencias();

$fecha = date('Y-m-d');


//$header = array("Hora", "Cancha 1", "Cancha 2", "Cancha 3");

////***** Parametros ****////////////////////////////////
$desde		=	$_GET['desde'];
$hasta		=	$_GET['hasta'];
/////////////////////////////  fin parametross  ///////////////////////////

$resPersonalActivo = $serviciosReferencias->traerPersonalActivoDesdeHasta($desde, $hasta);

$objPHPExcel = new PHPExcel();

if (mysql_num_rows($resPersonalActivo)>0) {

// Crea un nuevo objeto PHPExcel

$objPHPExcel->getProperties()
->setCreator("Exebin")
->setLastModifiedBy("Exebin")
->setTitle("Documento Excel")
->setSubject("Documento Excel")
->setDescription("Documento Excel Pagos Haberes.")
->setKeywords("Excel Office 2007 openxml php")
->setCategory("Excel");
 
$tituloReporte = "Pagos Haberes";
$tituloReporte2 = "Fecha: desde el ".$desde." hasta el ".$hasta;

$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A1:E1');
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A2:E2');
	
	 
// Se agregan los titulos del reporte

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', htmlspecialchars(utf8_encode($tituloReporte))) // Titulo del reporte
	->setCellValue('A2', utf8_encode($tituloReporte2));
	
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A3', 'Apellido y Nombre') // Titulo del reporte
	->setCellValue('B3', 'Nro Documento')
	->setCellValue('C3', 'CBU')
	->setCellValue('D3', 'Nro Cuenta')
	->setCellValue('E3', 'Liquido');


$i = 4;
while ($row = mysql_fetch_array($resPersonalActivo)) {
	$calculoLiquido = $serviciosReferencias->calculoBasePorPersona($row['idpersonal'], $desde, $hasta);
	$objPHPExcel->setActiveSheetIndex(0)
    	->setCellValue('A'.$i, utf8_encode($row['apellido']).' '.utf8_encode($row['nombre']))
		->setCellValue('B'.$i, $row['nrodocumento'])
		->setCellValueExplicit('C'.$i, $row['cbu'], PHPExcel_Cell_DataType::TYPE_STRING)
		->setCellValue('D'.$i, $row['nrocuenta'])
		->setCellValue('E'.$i, $calculoLiquido);
	
	$i += 1;	
}


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

$objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($estiloTituloReporte);

// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Hoja1');
 
// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
$objPHPExcel->setActiveSheetIndex(0);

}
// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8');
header('Content-Disposition: attachment;filename="rptPagoHaberes.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;


?>

