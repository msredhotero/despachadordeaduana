<?php

date_default_timezone_set('America/Buenos_Aires');

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');


$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosReferancias 		= new ServiciosReferencias();

$fecha = date('Y-m-d');

require('fpdf.php');

//$header = array("Hora", "Cancha 1", "Cancha 2", "Cancha 3");

$fechaPost		= 	$_GET['fecha'];


$datos = $serviciosReferancias->rptExportacionesDiarias($fecha);


$Totales = 0;


$pdf = new FPDF('L','mm','A4');

$pdf->AddPage();

$pdf->SetFont('Arial','U',17);
$pdf->Cell(250,7,'Reporte Diario Totales',0,0,'C',false);
$pdf->Ln();
$pdf->Cell(250,7,'Fecha: '.date('Y-m-d'),0,0,'C',false);
$pdf->Ln();

$pdf->SetFont('Arial','',8);

/*
SIM	CANAL	OFIC.	EXPORTADOR	ITEM	SUB	CONTENEDOR	BOOKING	PAIS	
PUERTO	AGENCIA	PRECINTO	MARCAS	BULTOS	BRUTO	NETO	VAL. UNIT	
FOB	TC	FOB PESOS	GASTOS	%	SUBTOTAL	MINIMO	TOTAL	FACT

*/
$pdf->SetX(5);
$pdf->Cell(15,4,'SIM',1,0,'L',false);
$pdf->Cell(15,4,'CANAL',1,0,'C',false);
$pdf->Cell(15,4,'OFIC.',1,0,'C',false);
$pdf->Cell(20,4,'EXPORTADOR',1,0,'C',false);
$pdf->Cell(8,4,'ITEM',1,0,'C',false);
$pdf->Cell(15,4,'BOOKING',1,0,'C',false);
$pdf->Cell(20,4,'PAIS',1,0,'C',false);
$pdf->Cell(20,4,'PUERTO',1,0,'C',false);
$pdf->Cell(20,4,'AGENCIA',1,0,'C',false); // ??? preguntar
$pdf->Cell(10,4,'BULTOS',1,0,'C',false);
$pdf->Cell(12,4,'BRUTO',1,0,'C',false);
$pdf->Cell(12,4,'NETO',1,0,'C',false);
$pdf->Cell(8,4,'VAL.UNIT',1,0,'C',false);
$pdf->Cell(12,4,'FOB',1,0,'C',false);
$pdf->Cell(5,4,'TC',1,0,'C',false);
$pdf->Cell(12,4,'FOB PESOS',1,0,'C',false);
$pdf->Cell(8,4,'GASTOS',1,0,'C',false);
$pdf->Cell(5,4,'%',1,0,'C',false);
$pdf->Cell(12,4,'SUBTOTAL',1,0,'C',false);
$pdf->Cell(10,4,'MINIMO',1,0,'C',false);
$pdf->Cell(12,4,'TOTAL',1,0,'C',false);
$pdf->Cell(5,4,'FACT',1,0,'C',false);

$subTotal = 0;
while ($row = mysql_fetch_array($datos)) {
	$subTotal = 0;
	$pdf->Ln();
	$pdf->SetX(5);
	$pdf->Cell(15,4,$row['permisoembarque'],1,0,'L',false);
	$pdf->Cell(15,4,$row['color'],1,0,'C',false);
	$pdf->Cell(15,4,$row['fecha'],1,0,'C',false);
	$pdf->Cell(20,4,$row['razonsocial'],1,0,'C',false);
	$pdf->Cell(8,4,$row['cantidad'],1,0,'C',false);
	$pdf->Cell(15,4,$row['booking'],1,0,'C',false);
	$pdf->Cell(20,4,$row['destino'],1,0,'C',false);
	$pdf->Cell(20,4,$row['puerto'],1,0,'C',false);
	$pdf->Cell(20,4,'AG Martin',1,0,'C',false);
	$pdf->Cell(10,4,$row['bulto'],1,0,'C',false);
	$pdf->Cell(12,4,$row['bruto'],1,0,'C',false);
	$pdf->Cell(12,4,$row['neto'],1,0,'C',false);
	$pdf->Cell(8,4,$row['valorunitario'],1,0,'C',false);
	$pdf->Cell(12,4,$row['neto'] * $row['valorunitario'],1,0,'C',false);
	$pdf->Cell(5,4,$row['tc'],1,0,'C',false);
	$pdf->Cell(12,4,$row['tc'] * $row['neto'] * $row['valorunitario'],1,0,'C',false);
	$pdf->Cell(8,4,'1000',1,0,'C',false);
	$pdf->Cell(5,4,'3%',1,0,'C',false);
	$pdf->Cell(12,4,$row['tc'] * $row['neto'] * $row['valorunitario'] * 0.03,1,0,'C',false);
	$pdf->Cell(10,4,'2500',1,0,'C',false);
	
	if (2500 >= $row['tc'] * $row['neto'] * $row['valorunitario'] * 0.03) {
		$subTotal = 2500 + 1000;
	} else {
		$subTotal = ($row['tc'] * $row['neto'] * $row['valorunitario'] * 0.03) + 1000;
	}

	$pdf->Cell(12,4,$subTotal,1,0,'C',false);
	$pdf->Cell(5,4,$row['factura'],1,0,'C',false);
}
$pdf->Ln();

$pdf->SetFont('Arial','',14);


$nombreTurno = "rptDiario-".$fecha.".pdf";

$pdf->Output($nombreTurno,'D');


?>

