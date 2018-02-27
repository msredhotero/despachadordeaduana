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


$fecha      =   $_GET['fecha'];


$datos = $serviciosReferancias->rptExportacionesDiarias(substr($fecha,0,4),substr($fecha,-2));

// Crea un nuevo objeto PHPExcel


$totalGral = 0;

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
$tituloReporte2 = "Fecha: ".$fecha;

$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A1:Z1')
    ->mergeCells('A2:Z2');

	
	 
// Se agregan los titulos del reporte

/*
SIM CANAL   OFIC.   EXPORTADOR  ITEM    SUB CONTENEDOR  BOOKING PAIS    
PUERTO  AGENCIA PRECINTO    MARCAS  BULTOS  BRUTO   NETO    VAL. UNIT   
FOB TC  FOB PESOS   GASTOS  %   SUBTOTAL    MINIMO  TOTAL   FACT

*/

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', htmlspecialchars(utf8_encode($tituloReporte))) // Titulo del reporte
	->setCellValue('A2', utf8_encode($tituloReporte2));
	
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A3', 'SIM') // Titulo del reporte
	->setCellValue('B3', 'CANAL')
	->setCellValue('C3', 'OFIC.')
	->setCellValue('D3', 'EXPORTADOR')
	->setCellValue('E3', 'ITEM')
	->setCellValue('F3', 'SUB')
	->setCellValue('G3', 'CONTENEDOR')
	->setCellValue('H3', 'BOOKING')
    ->setCellValue('I3', 'PAIS')
    ->setCellValue('J3', 'PUERTO')
    ->setCellValue('K3', 'AGENCIA')
    ->setCellValue('L3', 'PRECINTO')
    ->setCellValue('M3', 'MARCAS')
    ->setCellValue('N3', 'BULTOS')
    ->setCellValue('O3', 'BRUTO')
    ->setCellValue('P3', 'NETO')
    ->setCellValue('Q3', 'VAL. UNIT')
    ->setCellValue('R3', 'FOB')
    ->setCellValue('S3', 'TC')
    ->setCellValue('T3', 'FOB PESOS')
    ->setCellValue('U3', 'GASTOS')
    ->setCellValue('V3', '%')
    ->setCellValue('W3', 'SUBTOTAL')
    ->setCellValue('X3', 'MINIMO')
    ->setCellValue('Y3', 'TOTAL')
    ->setCellValue('Z3', 'FACT');



$i= 4;
$subTotal = 0;
$permiso = '';
$totalGastos = 0;
$totalGastosTotales = 0;
$totalGralFinal = 0; 
$primero = 0;
$minHonorarios = 0;

while ($row = mysql_fetch_array($datos)) {

    if ($permiso != $row['permisoembarque']) {
        

        if ($primero == 1) {
            if ($minHonorarios >= $totalGral) {
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('V'.$i, 'Gastos:')
                ->setCellValue('W'.$i, $totalGastos)
                ->setCellValue('X'.$i, 'Total:')
                ->setCellValue('Y'.$i, $minHonorarios + $totalGastos);
                $totalGralFinal += $minHonorarios;
            } else {
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('V'.$i, 'Gastos:')
                ->setCellValue('W'.$i, $totalGastos)
                ->setCellValue('X'.$i, 'Total:')
                ->setCellValue('Y'.$i, $totalGral + $totalGastos);
                $totalGralFinal += $totalGral;
            }
            
            $totalGastos = 0;
            $totalGral = 0;
            $minHonorarios = 0;
            $i += 1;

        }

        $totalGastos += $row['gastos'];
        $totalGastosTotales += $row['gastos'];
        $permiso = $row['permisoembarque'];
        $minHonorarios = $row['minhonorarios'];
        
        $primero = 1;

    }

    $subTotal = $row['tc'] * $row['neto'] * $row['valorunitario'] * $row['honorarios'] / 100;
    

    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A'.$i, strtoupper($row['permisoembarque'])) // Titulo del reporte
    ->setCellValue('B'.$i, strtoupper($row['color']))
    ->setCellValue('C'.$i, $row['fecha'])
    ->setCellValue('D'.$i, strtoupper($row['razonsocial']))
    ->setCellValue('E'.$i, $row['cantidad'])
    ->setCellValue('F'.$i, '0')
    ->setCellValue('G'.$i, strtoupper($row['contenedor']))
    ->setCellValue('H'.$i, strtoupper($row['booking']))
    ->setCellValue('I'.$i, strtoupper($row['destino']))
    ->setCellValue('J'.$i, strtoupper($row['puerto']))
    ->setCellValue('K'.$i, strtoupper($row['agencia']))
    ->setCellValue('L'.$i, strtoupper($row['precinto']))
    ->setCellValue('M'.$i, strtoupper($row['marca']))
    ->setCellValue('N'.$i, $row['bulto'])
    ->setCellValue('O'.$i, $row['bruto'])
    ->setCellValue('P'.$i, $row['neto'])
    ->setCellValue('Q'.$i, $row['valorunitario'])
    ->setCellValue('R'.$i, $row['neto'] * $row['valorunitario'])
    ->setCellValue('S'.$i, $row['tc'])
    ->setCellValue('T'.$i, round($row['tc'] * $row['neto'] * $row['valorunitario'],2))
    ->setCellValue('U'.$i, $row['gastos'])
    ->setCellValue('V'.$i, $row['honorarios'])
    ->setCellValue('W'.$i, round($row['tc'] * $row['neto'] * $row['valorunitario'] * ($row['honorarios'] / 100),2))
    ->setCellValue('X'.$i, $row['gastos'])
    ->setCellValue('Y'.$i, round($subTotal,2))
    ->setCellValue('Z'.$i, $row['factura']);
    
    $totalGral += $subTotal; 

    

    $i += 1;    
}

if ($minHonorarios >= $totalGral) {
    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('V'.$i, 'Gastos:')
    ->setCellValue('W'.$i, $totalGastos)
    ->setCellValue('X'.$i, 'Total:')
    ->setCellValue('Y'.$i, $minHonorarios + $totalGastos);
    $totalGralFinal += $minHonorarios;
} else {
    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('V'.$i, 'Gastos:')
    ->setCellValue('W'.$i, $totalGastos)
    ->setCellValue('X'.$i, 'Total:')
    ->setCellValue('Y'.$i, round($totalGral + $totalGastos,2));
    $totalGralFinal += $totalGral;
}

$i += 1;

$objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('V'.$i, 'Gastos Totales:')
                ->setCellValue('W'.$i, $totalGastosTotales)
                ->setCellValue('X'.$i, 'Total Final:')
                ->setCellValue('Y'.$i, round($totalGastosTotales + $totalGralFinal,2));




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

$objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A2:Z2')->applyFromArray($estiloTituloReporte);
// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Hoja1');
 
// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8');
header('Content-Disposition: attachment;filename="rptTotalDia.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;


?>

