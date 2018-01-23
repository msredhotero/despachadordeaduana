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
//$serviciosReportes			= new ServiciosReportes();

$fecha = date('Y-m-d');

require('fpdf.php');

//$header = array("Hora", "Cancha 1", "Cancha 2", "Cancha 3");

$id				=	$_GET['id'];
$desde			=	$_GET['desde'];
$hasta			=	$_GET['hasta'];

$mes 			=	date('M', strtotime($desde));

$resObra		=	$serviciosReferencias->traerObrascooperativasPorObra($id);

$resBruto		=	$serviciosReferencias->traerTotalCooperativaPorObra($id,$desde, $hasta);

$resDatos		=	$serviciosReferencias->traerPersonalcooperativasPorObra($id);

$totalActores   =	mysql_num_rows($serviciosReferencias->traerPersonalcooperativasPorObra($id));

if (mysql_num_rows($resObra)>0) {
$TotalIngresos = 0;
$TotalEgresos = 0;
$Totales = 0;
$Caja = 0;



$pdf = new FPDF('L','mm','A4');

$pdf->SetMargins(3,3,3);
// Títulos de las columnas

$headerFacturacion = array("Tipo Doc", "Nro Documento", "Apellido y Nombre Artístico","Puntaje", "Remuneracion","Aporte Sindical", "Aporte Social");
// Carga de datos

$pdf->AddPage();



$pdf->SetXY(10,10);

$pdf->SetFillColor(188,188,188);
$pdf->Rect(9.5,9.5,277,25.5,'F');


$pdf->SetXY(138.5,8);
$pdf->SetFillColor(232,232,232);
$pdf->Rect(9.8,9.8,174.5,25,'F');
$pdf->Rect(184.8,9.8,101.5,25,'F');

$pdf->Image('../imagenes/logoactores2.jpg',15,14,80);

$pdf->SetFont('Arial','b',9);
$pdf->SetXY(240,15);
$pdf->Cell(45,4,'PLANILLA DE APORTES',0,0,'R');
$pdf->SetFont('Arial','b',9);
$pdf->SetXY(203,19);
$pdf->Cell(82,4,'Para ser entregada en la Asociación Argentina de Actores',0,0,'R');
$pdf->SetFont('Arial','b',14);
$pdf->SetXY(222,26);
$pdf->Cell(30,6,'RAMA: ',0,0,'R');


$pdf->SetFillColor(88,88,88);
$pdf->Rect(9.8,34.8,276.5,6,'F');

$wA = 31;
$wB = 61;
$wC = 61.5;

$pdf->SetFont('Arial','b',8);
$pdf->SetDrawColor(188, 188, 188);
$pdf->SetFillColor(255,255,255);
$pdf->SetXY(9.8,40.8);
$pdf->Cell($wA,8,'N°COOPERATIVA',1,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->Cell($wB,8,mysql_result($resObra,0,'numero'),1,0,'C',1);

$pdf->SetFont('Arial','b',8);
$pdf->MultiCell($wA,4,'AP Y NOMB. DEL RESPONSABLE',1,'L',1);

$pdf->SetXY(132.8,40.8);
$pdf->SetFont('Arial','',8);
$pdf->Cell($wC,8,'A CIEGAS TEATRO POR LA INTEGRACION',1,0,'C',1);

$pdf->SetFont('Arial','b',8);
$pdf->Cell($wA,8,'NRO de CUIT',1,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->Cell($wB,8,'30712485961',1,0,'C',1);


$pdf->SetFont('Arial','b',8);
$pdf->SetDrawColor(188, 188, 188);
$pdf->SetFillColor(255,255,255);
$pdf->SetXY(9.8,48.8);
$pdf->Cell($wA,8,'DOMICILIO LEGAL',1,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->Cell($wB,8,'',1,0,'L',1);
$pdf->SetFont('Arial','b',8);
$pdf->MultiCell($wA,4,'AP Y NOMB. DEL CONTACTO',1,'L',1);
$pdf->SetXY(132.8,48.8);
$pdf->SetFont('Arial','',8);
$pdf->Cell($wC,8,'ASOC. CIVIL',1,0,'C',1);
$pdf->SetFont('Arial','b',8);
$pdf->Cell($wA,8,'INGRESOS BRUTOS',1,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->Cell($wB,8,'',1,0,'L',1);



$pdf->SetFont('Arial','b',8);
$pdf->SetDrawColor(188, 188, 188);
$pdf->SetFillColor(255,255,255);
$pdf->SetXY(9.8,56.8);
$pdf->Cell($wA,8,'DOMICILIO REAL',1,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->Cell($wB,8,'',1,0,'L',1);
$pdf->SetFont('Arial','b',8);
$pdf->MultiCell($wA,4,'TELEFONO FIJO  DEL CONTACTO',1,'L',1);
$pdf->SetXY(132.8,56.8);
$pdf->SetFont('Arial','',8);
$pdf->Cell($wC,8,'',1,0,'L',1);
$pdf->SetFont('Arial','b',8);
$pdf->Cell($wA,8,'',1,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->Cell($wB,8,'',1,0,'L',1);



$pdf->SetFont('Arial','b',8);
$pdf->SetDrawColor(188, 188, 188);
$pdf->SetFillColor(255,255,255);
$pdf->SetXY(9.8,64.8);
$pdf->Cell($wA,8,'TELEFONO / FAX',1,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->Cell($wB,8,'',1,0,'L',1);
$pdf->SetFont('Arial','b',8);
$pdf->MultiCell($wA,4,'TELEFONO MOVIL DEL CONTACTO',1,'L',1);
$pdf->SetXY(132.8,64.8);
$pdf->SetFont('Arial','',8);
$pdf->Cell($wC,8,'',1,0,'L',1);
$pdf->SetFont('Arial','b',8);
$pdf->Cell($wA,8,'',1,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->Cell($wB,8,'',1,0,'L',1);



$pdf->SetFont('Arial','b',8);
$pdf->SetDrawColor(188, 188, 188);
$pdf->SetFillColor(255,255,255);
$pdf->SetXY(9.8,72.8);
$pdf->Cell($wA,8,'EMAIL',1,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->Cell($wB,8,'',1,0,'L',1);
$pdf->SetFont('Arial','b',8);
$pdf->MultiCell($wA,4,'EMAIL DEL CONTACTO',1,'L',1);
$pdf->SetXY(132.8,72.8);
$pdf->SetFont('Arial','',8);
$pdf->Cell($wC,8,'',1,0,'L',1);
$pdf->SetFont('Arial','b',8);
$pdf->Cell($wA,8,'',1,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->Cell($wB,8,'',1,0,'L',1);


$pdf->SetFillColor(88,88,88);
$pdf->Rect(9.8,80.8,276.5,6,'F');


$pdf->SetFont('Arial','b',8);
$pdf->SetDrawColor(188, 188, 188);
$pdf->SetFillColor(255,255,255);
$pdf->SetXY(9.8,86.8);
$pdf->MultiCell($wA,4,'TITULO DEL PROGRAMA',1,'L',1);
$pdf->SetXY(9.8 + $wA,86.8);
$pdf->SetFont('Arial','',8);
$pdf->Cell($wB,8,mysql_result($resObra,0,'nombre'),1,0,'C',1);
$pdf->SetFont('Arial','b',8);
$pdf->MultiCell($wA,8,'MONTO BORDEAUX',1,'L',1);
$pdf->SetXY(132.8,86.8);
$pdf->SetFont('Arial','',8);
$pdf->Cell($wC,8,'$'.number_format( mysql_result($resBruto,0,'totalcooperativas'),2,'.',''),1,0,'C',1);
$pdf->SetFont('Arial','b',8);
$pdf->Cell($wA,8,'PERIOD. LIQUID',1,0,'L',1);
$pdf->SetFont('Arial','',8);
$pdf->Cell($wB,8,'DESDE: '.$desde.' HASTA: '.$hasta,1,0,'C',1);

$pdf->SetFillColor(88,88,88);
$pdf->Rect(9.8,94.8,276.5,6,'F');

$w1 = 5;
$w2 = 10;
$w3 = 40;
$w4 = 49.5;
$w5 = 43;
$w6 = 43;
$w7 = 43;
$w8 = 43;

$y2 = 100.8;

$pdf->SetFont('Arial','',8);
$pdf->SetDrawColor(188, 188, 188);
$pdf->SetFillColor(255,255,255);
$pdf->SetXY(9.8,$y2);
$pdf->Cell($w1,8,'',1,0,'C',1);
$pdf->MultiCell($w2,4,'Tipo Doc',1,'C',1);
$pdf->SetXY(9.8 + $w1 + $w2,$y2);
$pdf->Cell($w3,8,'Nro Documento',1,0,'C',1);
$pdf->Cell($w4,8,'Apellido y Nombre Artístico',1,0,'C',1);
$pdf->Cell($w5,8,'Puntaje',1,0,'C',1);
$pdf->Cell($w6,8,'Renumeracion',1,0,'C',1);
$pdf->Cell($w7,8,'Aporte Sindical',1,0,'C',1);
$pdf->Cell($w8,8,'Aporte Social',1,0,'C',1);

$i = 0;
$netoActor = 0;
$totalSindical = 0;
$totalSocial = 0;
$totalRemunerativo = 0;

while ($row = mysql_fetch_array($resDatos)) {
	$y2 += 8;
	$i += 1;
	$netoActor = (($row['puntos'] * mysql_result($resBruto,0,'totalcooperativas')) / $row['puntoscooperativa']);
	
	$pdf->SetXY(9.8,$y2);
	$pdf->Cell($w1,8,$i,1,0,'C',1);
	$pdf->MultiCell($w2,8,'DNI',1,'C',1);
	$pdf->SetXY(9.8 + $w1 + $w2,$y2);
	$pdf->Cell($w3,8,$row['nrodocumento'],1,0,'C',1);
	$pdf->Cell($w4,8,$row['apellido'].' '.$row['nombre'],1,0,'C',1);
	$pdf->Cell($w5,8,'$'.round($row['puntos'],0),1,0,'C',1);
	$pdf->Cell($w6,8,'$'.round($netoActor,2),1,0,'C',1);
	$pdf->Cell($w7,8,'$'.round(($netoActor * 0.03),2),1,0,'C',1);  // 3% aporte de actores
	$pdf->Cell($w8,8,'$'.round(($netoActor * 0.03),2),1,0,'C',1);
	
	$totalSindical += round(($netoActor * 0.03),2);
	$totalSocial += round(($netoActor * 0.03),2);
	$totalRemunerativo += round($netoActor,2);
}

	$pdf->SetXY(9.8,$y2 + 8);
	$pdf->Cell($w1,8,'',1,0,'C',1);
	$pdf->Cell($w2,8,'',1,0,'C',1);
	$pdf->Cell($w3,8,'',1,0,'C',1);
	$pdf->Cell($w4,8,'',1,0,'C',1);
	$pdf->Cell($w5,8,'',1,0,'C',1);
	$pdf->Cell($w6,8,'',1,0,'C',1);
	$pdf->Cell($w7,8,'$'.round($totalSindical,2),1,0,'C',1);  // 3% aporte de actores
	$pdf->Cell($w8,8,'$'.round($totalSocial,2),1,0,'C',1);
	
$pdf->SetFillColor(88,88,88);
$pdf->Rect(9.8,$y2 + 8 + 8,276.5,6,'F');

$w9 = 26.5;
$w10 = 50;

$pdf->SetFont('Arial','',8);
$pdf->SetXY(9.8,$y2 + 8 + 8 + 6);
$pdf->Cell($w9,10,'',1,0,'C',0);
$pdf->Cell($w10,10,'RECIBIÓ',1,0,'L',0);
$pdf->Cell($w10,10,'AUTORIZÓ',1,0,'L',0);
$pdf->Cell($w10,10,'ASENTÓ',1,0,'L',0);
$pdf->Cell($w10,10,'',1,0,'L',0);
$pdf->Cell($w10,10,'',1,0,'L',0);


$pdf->SetXY(9.8,$y2 + 8 + 8 + 6 + 10);
$pdf->Cell($w9,20,'ACLARACION',1,0,'L',0);
$pdf->Cell($w10,20,'X',1,0,'L',0);
$pdf->Cell($w10,20,'X',1,0,'L',0);
$pdf->Cell($w10,20,'X',1,0,'L',0);
$pdf->Cell($w10,10,'TOTAL GENERAL RENUM.',1,0,'L',0);
$pdf->Cell($w10,10,'$'.$totalRemunerativo,1,0,'L',0);
$pdf->Ln();
$pdf->SetX(186.3);
$pdf->SetFont('Arial','B',10);
$pdf->Cell($w10,10,'TOTAL A DEPOSITAR',1,0,'L',0);
$pdf->SetFont('Arial','',8);
$pdf->Cell($w10,10,'$'.($totalSindical + $totalSocial),1,0,'L',0);


$pdf->SetXY(9.8,$y2 + 8 + 8 + 6 + 10 + 24);
$pdf->Cell($w9,20,'FIRMA',1,0,'L',0);
$pdf->Cell($w10,20,'X',1,0,'L',0);
$pdf->Cell($w10,20,'X',1,0,'L',0);
$pdf->Cell($w10,20,'X',1,0,'L',0);
$pdf->Cell($w10,10,'NETO',1,0,'L',0);
$pdf->Cell($w10,10,'$'.($totalRemunerativo - ($totalSindical + $totalSocial)),1,0,'L',0);
$pdf->Ln();
$pdf->SetX(186.3);
$pdf->Cell($w10,10,'',1,0,'L',0);
$pdf->Cell($w10,10,'',1,0,'L',0);

$pdf->SetFillColor(88,88,88);
$pdf->Rect(9.8,$y2 + 8 + 8 + 6 + 10 + 24 + 20,276.5,6,'F');

/*
$pdf->SetFont('Arial','',14);
$pdf->SetXY(42,3);
$pdf->Cell(32,5,'Razon Social: ',0,0,'L',false);
$pdf->SetXY(74,3);
$pdf->Cell(58,5,strtoupper($empresa),0,0,'L',false);

$pdf->SetFont('Arial','',11);

$pdf->SetXY(42,9);
$pdf->Cell(24,5,"CUIT: ",0,0,'L',false);
$pdf->SetXY(66,9);
$pdf->Cell(90,5,$cuit,0,0,'L',false);

$pdf->SetXY(42,14);
$pdf->Cell(24,5,"Dirección: ",0,0,'L',false);
$pdf->SetXY(66,14);
$pdf->Cell(90,5,$direccion,0,0,'L',false);

$pdf->SetXY(42,19);
$pdf->Cell(24,5,"Teléfono: ",0,0,'L',false);
$pdf->SetXY(66,19);
$pdf->Cell(90,5,$telefono,0,0,'L',false);

$pdf->SetXY(42,24);
$pdf->Cell(24,5,"Ciudad: ",0,0,'L',false);
$pdf->SetXY(66,24);
$pdf->Cell(90,5,$ciudad,0,0,'L',false);

$pdf->SetXY(42,29);
$pdf->Cell(24,5,"Cod.Postal: ",0,0,'L',false);
$pdf->SetXY(66,29);
$pdf->Cell(90,5,$codpostal,0,0,'L',false);

$pdf->SetXY(42,34);
$pdf->Cell(24,5,"Email: ",0,0,'L',false);
$pdf->SetXY(66,34);
$pdf->Cell(90,5,$email,0,0,'L',false);


$pdf->SetXY(158,4);
$pdf->Cell(50,5,'Fecha: '.mysql_result($resFactura,0,'fecha'),1,0,'L',false);

$pdf->SetXY(158,11);
$pdf->Cell(50,5,'NºFactura: '.mysql_result($resFactura,0,'numero'),1,0,'L',false);

$pdf->SetFont('Arial','',10);

$pdf->SetXY(2,36);

$pdf->ingresosFacturacion($headerFacturacion,$datos,$TotalFacturacion);


*/
$pdf->Ln();

$pdf->SetFont('Arial','',13);

$nombreTurno = mysql_result($resObra,0,'nombre')." - ".$mes.".pdf";

$pdf->Output($nombreTurno,'D');
} else {
	echo '<h1>No existe datos</h1>';	
}
/*
require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'¡Hola, Mundo!');
$pdf->Output();
*/
?>

