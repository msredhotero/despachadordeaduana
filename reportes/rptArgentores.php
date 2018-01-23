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
$fecha			=	$_GET['fecha5'];
$valorentrada	=	$_GET['valorentrada'];
$totalrecaudado	=	$_GET['totalrecaudado'];
$argentores		=	$_GET['argentores'];
$efull			=	$_GET['efull'];
$e50			=	$_GET['e50'];
$ecartelera		=	$_GET['ecartelera'];
$einvitados		=	$_GET['einvitados'];

$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");


if ($fecha != '') {
	$fecha = date('d')." de ".$meses[date('n')-1]. " del ".date('y');
}
$resObra		=	$serviciosReferencias->traerObrasPorId($id);


if (mysql_num_rows($resObra)>0) {
$TotalIngresos = 0;
$TotalEgresos = 0;
$Totales = 0;
$Caja = 0;



$pdf = new FPDF();



$pdf->SetMargins(3,3,3);
// Títulos de las columnas

$headerFacturacion = array("Tipo Doc", "Nro Documento", "Apellido y Nombre Artístico","Puntaje", "Remuneracion","Aporte Sindical", "Aporte Social");
// Carga de datos

$pdf->AddPage();



$pdf->SetXY(10,10);

$pdf->Image('../imagenes/argentores_bg.jpg',15,14,20);

$pdf->SetFont('Arial','b',28);
$pdf->SetXY(40,23);
$pdf->Cell(80,8,'argentores',0,0,'C',0);


$pdf->SetXY(140,25);
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,5,'Fecha:',0,0,'C',0);
$pdf->SetLineWidth(0.1);
$pdf->Cell(35,5,$fecha,'B',0,'C',0);

$pdf->SetXY(10,40);
$pdf->SetFont('Arial','b',12);
$pdf->Cell(25,5,'Localidad:',0,0,'L',0);
$pdf->Cell(5,5,'',0,0,'C',0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(145,5,'Ciudad de Buenos Aires','B',0,'L',0);

$pdf->SetXY(10,48);
$pdf->SetFont('Arial','b',12);
$pdf->Cell(40,5,'Nombre de la Sala:',0,0,'L',0);
$pdf->Cell(5,5,'',0,0,'C',0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(130,5,'Centro Argentino de Teatro Ciego','B',0,'L',0);


$pdf->SetXY(10,56);
$pdf->SetFont('Arial','b',12);
$pdf->Cell(25,5,'Domicilio:',0,0,'L',0);
$pdf->Cell(5,5,'',0,0,'C',0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70,5,'Zelaya 3006','B',0,'L',0);
$pdf->SetXY(110,56);
$pdf->SetFont('Arial','b',12);
$pdf->Cell(10,5,'T.e:',0,0,'L',0);
$pdf->Cell(5,5,'',0,0,'C',0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(60,5,'011 63798596','B',0,'L',0);


$pdf->SetXY(10,64);
$pdf->SetFont('Arial','b',12);
$pdf->Cell(15,5,'CUIT:',0,0,'L',0);
$pdf->Cell(5,5,'',0,0,'C',0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(75,5,'30-71248596-1','B',0,'L',0);
$pdf->SetXY(110,64);
$pdf->SetFont('Arial','b',12);
$pdf->Cell(30,5,'Situación IVA:',0,0,'L',0);
$pdf->Cell(5,5,'',0,0,'C',0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(40,5,'Exento','B',0,'L',0);


$pdf->SetXY(10,72);
$pdf->SetFont('Arial','b',12);
$pdf->Cell(40,5,'Obra Representada:',0,0,'L',0);
$pdf->Cell(5,5,'',0,0,'C',0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(130,5,mysql_result($resObra,0,'nombre'),'B',0,'L',0);


$pdf->SetXY(10,80);
$pdf->SetFont('Arial','b',12);
$pdf->Cell(25,5,'Compañia:',0,0,'L',0);
$pdf->Cell(5,5,'',0,0,'C',0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(145,5,mysql_result($resObra,0,'nombre'),'B',0,'L',0);

$pdf->Line(10,90,185,90);
$pdf->Line(10,90.1,185,90.1);
$pdf->Line(10,90.2,185,90.2);


$pdf->SetFont('Arial','b',12);
$pdf->SetXY(10,93);
$pdf->MultiCell(26,5,'NOTA: El Importe Resultante de la CONTRIBUCIÓN No podrá en modo alguno afectar el porcentaje de los Derechos de Autor.',1,'L',0);

$pdf->SetFont('Arial','',12);
$pdf->SetXY(55,93);
$pdf->MultiCell(26,5,'Localidades Vendidas',0,'C',0);

$pdf->SetXY(105,93);
$pdf->MultiCell(26,5,'Precio de Cada una',0,'C',0);

$pdf->SetXY(155,93);
$pdf->MultiCell(26,5,'Total',0,'C',0);

$pdf->SetFont('Arial','b',12);
$pdf->SetXY(55,110);
$pdf->Cell(30,5,$efull,'B',0,'C',0);
$pdf->SetXY(55,120);
$pdf->Cell(30,5,$e50,'B',0,'C',0);
$pdf->SetXY(55,130);
$pdf->Cell(30,5,$ecartelera,'B',0,'C',0);
$pdf->SetXY(55,140);
$pdf->Cell(30,5,$einvitados,'B',0,'C',0);


$pdf->SetFont('Arial','b',12);
$pdf->SetXY(105,110);
$pdf->Cell(30,5,(float)$valorentrada / 1,'B',0,'C',0);
$pdf->SetXY(105,120);
$pdf->Cell(30,5,(float)$valorentrada * 0.5,'B',0,'C',0);
$pdf->SetXY(105,130);
$pdf->Cell(30,5,(float)$valorentrada * 0.1,'B',0,'C',0);
$pdf->SetXY(105,140);
$pdf->Cell(30,5,'0','B',0,'C',0);



$pdf->SetFont('Arial','',12);
$pdf->SetXY(150,110);
$pdf->Cell(3,8,'$',0,0,'L',0);
$pdf->SetFont('Arial','b',12);
$pdf->SetXY(155,110);
$pdf->Cell(30,5,(float)$valorentrada * $efull,'B',0,'C',0);

$pdf->SetFont('Arial','',12);
$pdf->SetXY(150,120);
$pdf->Cell(3,8,'$',0,0,'L',0);
$pdf->SetFont('Arial','b',12);
$pdf->SetXY(155,120);
$pdf->Cell(30,5,(float)$valorentrada * 0.5 * $e50,'B',0,'C',0);

$pdf->SetFont('Arial','',12);
$pdf->SetXY(150,130);
$pdf->Cell(3,8,'$',0,0,'L',0);
$pdf->SetFont('Arial','b',12);
$pdf->SetXY(155,130);
$pdf->Cell(30,5,(float)$valorentrada * 0.1 * $ecartelera,'B',0,'C',0);

$pdf->SetFont('Arial','',12);
$pdf->SetXY(150,140);
$pdf->Cell(3,8,'$',0,0,'L',0);
$pdf->SetFont('Arial','b',12);
$pdf->SetXY(155,140);
$pdf->Cell(30,5,'0','B',0,'C',0);

$pdf->SetFont('Arial','b',15);
$pdf->SetXY(40,152);
$pdf->Cell(100,10,'TOTAL RECAUDADO..............................',0,0,'L',0);

$pdf->SetFont('Arial','',12);
$pdf->SetXY(150,152);
$pdf->Cell(3,8,'$',0,0,'L',0);

$pdf->SetFont('Arial','b',12);
$pdf->SetXY(155,152);
$pdf->Cell(30,6,((float)$valorentrada * $efull) + ((float)$valorentrada * 0.5 * $e50) + ((float)$valorentrada * 0.1 * $ecartelera),'B',0,'C',0);



$pdf->Line(10,168,185,168);
$pdf->Line(10,168.1,185,168.1);
$pdf->Line(10,168.2,185,168.2);

$pdf->SetFont('Arial','',11);
$pdf->SetXY(50,168);
$pdf->Cell(100,8,'LIQUIDACION PARA ARGENTORES',0,0,'L',0);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','',14);
$pdf->SetX(20);
$pdf->Cell(140,8,'DERECHOS DE AUTOR (10%) S/TOTAL RECAUDADO $',0,0,'L',0);
$pdf->Cell(30,6,number_format(((((float)$valorentrada * $efull) + ((float)$valorentrada * 0.5 * $e50) + ((float)$valorentrada * 0.1 * $ecartelera)) * 0.1),2,',','.'),'B',0,'C',0);
$pdf->Ln();
$pdf->Ln();
$pdf->SetX(10);
$pdf->Cell(150,8,'MONTEPIO (EL VALOR DE..... ENTRADAS P/FUNCION) $',0,0,'L',0);
$pdf->Cell(30,6,'','B',0,'C',0);
$pdf->Ln();
$pdf->Ln();
$pdf->SetX(10);
$pdf->Cell(150,8,'CONTRIBUCION (15% DEL MONTEPIO).............................$',0,0,'L',0);
$pdf->Cell(30,6,'','B',0,'C',0);
$pdf->Ln();
$pdf->Ln();
$pdf->SetX(10);
$pdf->Cell(150,8,'TOTAL A ABONAR A ARGENTORES .................................$',0,0,'L',0);
$pdf->Cell(30,6,'','B',0,'C',0);
$pdf->Ln();
$pdf->Ln();
$pdf->SetX(10);
$pdf->Cell(150,8,'VISTO BUENO CONTROL ARGENTORES........................:$',0,0,'L',0);
$pdf->Cell(30,6,'','B',0,'C',0);

$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->SetX(10);
$pdf->Cell(80,6,'FIRMA Y SELLO EMPRESA CÍA','T',0,'C',0);

$pdf->SetX(100);
$pdf->Cell(90,6,'FIRMA Y SELLO EMPRESA DE SALA','T',0,'C',0);

$nombreTurno = mysql_result($resObra,0,'nombre').".pdf";

$pdf->Output($nombreTurno,'I');
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

