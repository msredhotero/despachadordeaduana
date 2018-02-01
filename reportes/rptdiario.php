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

$id		= 	$_GET['id'];


$datos = $serviciosReferancias->traerExportacionesPorId($id);

$fecha 		= mysql_result($datos,0,'fecha');
$sim 		= mysql_result($datos,0,'permisoembarque');
$cliente 	= mysql_result($datos,0,'razonsocial');
$buque 		= mysql_result($datos,0,'buque');
$destino 	= mysql_result($datos,0,'destino');
$puerto 	= mysql_result($datos,0,'puerto');
$color 		= mysql_result($datos,0,'color');
$booking 	= mysql_result($datos,0,'booking');
$despachante= mysql_result($datos,0,'despachante');
$cuit 		= mysql_result($datos,0,'cuit');

$resClientes	= $serviciosReferancias->traerClientesPorId(mysql_result($datos,0,'refclientes'));

$factura	= mysql_result($datos,0,'factura');




$datosDetalles = $serviciosReferancias->rptExportacionesCompletoPorId($id);


$Totales = 0;


$pdf = new FPDF();

$pdf->AddPage();

$pdf->SetFont('Arial','U',17);
$pdf->Cell(190,7,'PERMISO DE EMBARQUE',0,0,'C',false);

$pdf->SetFont('Arial','U',12);
$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(47.5,5,'PERMISO DE EMBARQUE:',1,0,'L',false);
$pdf->Cell(47.5,5,strtoupper($permisoembarque),1,0,'C',false);
$pdf->Cell(47.5,5,'CANAL:',1,0,'L',false);
$pdf->Cell(47.5,5,strtoupper($permisoembarque),1,0,'C',false);

$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(47.5,5,'BUQUE:',1,0,'L',false);
$pdf->Cell(47.5,5,strtoupper($permisoembarque),1,0,'C',false);
$pdf->Cell(47.5,5,'DESPACHANTE:',1,0,'L',false);
$pdf->Cell(47.5,5,strtoupper($despachante),1,0,'C',false);

$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(47.5,5,'DESTINO:',1,0,'L',false);
$pdf->Cell(47.5,5,strtoupper($destino),1,0,'C',false);
$pdf->Cell(47.5,5,'CUIT:',1,0,'L',false);
$pdf->Cell(47.5,5,strtoupper($cuit),1,0,'C',false);

$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(47.5,5,'PUERTO:',1,0,'L',false);
$pdf->Cell(47.5,5,strtoupper($puerto),1,0,'C',false);
$pdf->Cell(47.5,5,'EXPORTADOR:',1,0,'L',false);
$pdf->Cell(47.5,5,strtoupper($cliente),1,0,'C',false);

$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(47.5,5,'BOOKING:',1,0,'L',false);
$pdf->Cell(47.5,5,strtoupper($booking),1,0,'C',false);
$pdf->Cell(47.5,5,'CUIT:',1,0,'L',false);
$pdf->Cell(47.5,5,strtoupper(mysql_result($resClientes, 0,'cuit')),1,0,'C',false);

$pdf->SetFont('Arial','',10);

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

