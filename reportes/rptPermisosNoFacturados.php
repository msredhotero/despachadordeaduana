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



$datos = $serviciosReferancias->rptExportacionesNoFacturadas();

// Crea un nuevo objeto PHPExcel
//die(print_r($datos));

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
 
$tituloReporte = "Permisos No Facturados: ";


$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A1:Z1');

	
	 
// Se agregan los titulos del reporte

/*
SIM CANAL   OFIC.   EXPORTADOR  ITEM    SUB CONTENEDOR  BOOKING PAIS    
PUERTO  AGENCIA PRECINTO    MARCAS  BULTOS  BRUTO   NETO    VAL. UNIT   
FOB TC  FOB PESOS   GASTOS  %   SUBTOTAL    MINIMO  TOTAL   FACT

*/

$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', htmlspecialchars(utf8_encode($tituloReporte)));
	
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A2', 'SIM') // Titulo del reporte
	->setCellValue('B2', 'CANAL')
	->setCellValue('C2', 'OFIC.')
	->setCellValue('D2', 'EXPORTADOR')
	->setCellValue('E2', 'ITEM')
	->setCellValue('F2', 'SUB')
	->setCellValue('G2', 'CONTENEDOR')
	->setCellValue('H2', 'BOOKING')
    ->setCellValue('I2', 'PAIS')
    ->setCellValue('J2', 'PUERTO')
    ->setCellValue('K2', 'AGENCIA')
    ->setCellValue('L2', 'PRECINTO')
    ->setCellValue('M2', 'MARCAS')
    ->setCellValue('N2', 'BULTOS')
    ->setCellValue('O2', 'BRUTO')
    ->setCellValue('P2', 'NETO')
    ->setCellValue('Q2', 'VAL. UNIT')
    ->setCellValue('R2', 'FOB')
    ->setCellValue('S2', 'TC')
    ->setCellValue('T2', 'FOB PESOS')
    ->setCellValue('U2', 'GASTOS')
    ->setCellValue('V2', '%')
    ->setCellValue('W2', 'SUBTOTAL')
    ->setCellValue('X2', 'MINIMO')
    ->setCellValue('Y2', 'TOTAL')
    ->setCellValue('Z2', 'FACT');



$i= 3;
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
            if ($minHonorarios >= $totalGralFinal) {
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('V'.$i, 'Gastos:')
                ->setCellValue('W'.$i, $totalGastos)
                ->setCellValue('X'.$i, 'Total:')
                ->setCellValue('Y'.$i, $minHonorarios + $totalGastos);
            } else {
                $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('V'.$i, 'Gastos:')
                ->setCellValue('W'.$i, $totalGastos)
                ->setCellValue('X'.$i, 'Total:')
                ->setCellValue('Y'.$i, $totalGral + $totalGastos);
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

    $totalGralFinal += $subTotal;

    $i += 1;    
}

if ($minHonorarios >= $totalGralFinal) {
    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('V'.$i, 'Gastos:')
    ->setCellValue('W'.$i, $totalGastos)
    ->setCellValue('X'.$i, 'Total:')
    ->setCellValue('Y'.$i, $minHonorarios + $totalGastos);
} else {
    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('V'.$i, 'Gastos:')
    ->setCellValue('W'.$i, $totalGastos)
    ->setCellValue('X'.$i, 'Total:')
    ->setCellValue('Y'.$i, round($totalGral + $totalGastos,2));
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
// Renombrar Hoja
$objPHPExcel->getActiveSheet()->setTitle('Hoja1');
 
// Establecer la hoja activa, para que cuando se abra el documento se muestre primero.
// Se modifican los encabezados del HTTP para indicar que se envia un archivo de Excel.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8');
header('Content-Disposition: attachment;filename="rptPermisosNoFacturados.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;


?>

