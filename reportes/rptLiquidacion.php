<?php

date_default_timezone_set('America/Buenos_Aires');

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');


$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosReferencias 		= new ServiciosReferencias();

$fecha = date('Y-m-d');

require('fpdf.php');

//$header = array("Hora", "Cancha 1", "Cancha 2", "Cancha 3");

////***** Parametros ****////////////////////////////////
$desde		=	$_GET['desde'];
$hasta		=	$_GET['hasta'];
/////////////////////////////  fin parametross  ///////////////////////////

$resPersonalActivo = $serviciosReferencias->traerPersonalActivoDesdeHasta($desde, $hasta);


$pdf = new FPDF();
$cantidadJugadores = 0;
#Establecemos los márgenes izquierda, arriba y derecha: 
$pdf->SetMargins(2, 2 , 2); 

#Establecemos el margen inferior: 
$pdf->SetAutoPageBreak(true,1); 


	
	$pdf->AddPage();
	/***********************************    PRIMER CUADRANTE ******************************************/
	
	$pdf->Image('../imagenes/logo_cara.png',95,2,20);

	/***********************************    FIN ******************************************/
	
	
	
	//////////////////// Aca arrancan a cargarse los datos de los equipos  /////////////////////////

	
	$pdf->SetFillColor(183,183,183);
	$pdf->SetFont('Arial','B',10);
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetY(25);
	$pdf->SetX(5);
	$pdf->Cell(200,5,'Pago de Haberes - Fecha: desde el '.$desde." hasta el ".$hasta,1,0,'C',true);
	$pdf->SetFont('Arial','',8);
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetX(5);
	


	$pdf->Ln();
	$pdf->SetX(5);
	$pdf->Cell(70,4,'Apellido y Nombre',1,0,'L',true);
	$pdf->Cell(25,4,'Nro Documento',1,0,'C',true);
	$pdf->Cell(40,4,'CBU',1,0,'C',true);
	$pdf->Cell(25,4,'Cuenta',1,0,'C',true);
	$pdf->Cell(25,4,'Liquido',1,0,'C',true);

while ($row = mysql_fetch_array($resPersonalActivo)) {
	$calculoLiquido = $serviciosReferencias->calculoBasePorPersona($row['idpersonal'], $desde, $hasta);
	
	$pdf->Ln();
	$pdf->SetX(5);
	$pdf->Cell(70,4,$row['apellido'].' '.$row['nombre'],1,0,'L',false);
	$pdf->Cell(25,4,$row['nrodocumento'],1,0,'C',false);
	$pdf->Cell(40,4,$row['cbu'],1,0,'R',false);
	$pdf->Cell(25,4,$row['nrocuenta'],1,0,'C',false);
	$pdf->Cell(25,4,'$ '.number_format($calculoLiquido,2,'.',','),1,0,'R',false);	


}
//120 x 109



$nombreTurno = "PagosHaberes-".date('Y-m-d').".pdf";

$pdf->Output($nombreTurno,'I');


?>

