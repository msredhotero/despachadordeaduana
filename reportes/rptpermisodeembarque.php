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


$datos = $serviciosReferancias->traerExportacionesPorIdReporte($id);

$fecha 		= mysql_result($datos,0,'fecha');
$sim 		= mysql_result($datos,0,'permisoembarque');

$buque 		= mysql_result($datos,0,'buque');
$destino 	= mysql_result($datos,0,'destino');
$puerto 	= mysql_result($datos,0,'puerto');
$color 		= mysql_result($datos,0,'color');
$booking 	= mysql_result($datos,0,'booking');
$despachante= mysql_result($datos,0,'despachante');
$cuit 		= mysql_result($datos,0,'cuit');

$resClientes	= $serviciosReferancias->traerClientesPorId(mysql_result($datos,0,'refclientes'));

$cliente 	= mysql_result($resClientes,0,'razonsocial');

$factura	= mysql_result($datos,0,'factura');




$datosDetalles = $serviciosReferancias->rptExportacionesCompletoPorId($id);


$Totales = 0;


$pdf = new FPDF();

$pdf->AddPage();

$pdf->SetFont('Arial','U',17);
$pdf->Cell(200,7,'AUTORIZACION PARA CARGAR MERCADERIAS',0,0,'C',false);

$pdf->SetFont('Arial','',8);
$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(40,5,'PERMISO DE EMBARQUE:',1,0,'L',false);
$pdf->Cell(60,5,strtoupper($sim),1,0,'C',false);
$pdf->Cell(30,5,'CANAL:',1,0,'L',false);
$pdf->Cell(70,5,strtoupper($color),1,0,'C',false);

$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(40,5,'BUQUE:',1,0,'L',false);
$pdf->Cell(60,5,strtoupper($buque),1,0,'C',false);
$pdf->Cell(30,5,'DESPACHANTE:',1,0,'L',false);
$pdf->Cell(70,5,strtoupper($despachante),1,0,'C',false);

$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(40,5,'DESTINO:',1,0,'L',false);
$pdf->Cell(60,5,strtoupper($destino),1,0,'C',false);
$pdf->Cell(30,5,'CUIT:',1,0,'L',false);
$pdf->Cell(70,5,strtoupper($cuit),1,0,'C',false);

$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(40,5,'PUERTO:',1,0,'L',false);
$pdf->Cell(60,5,strtoupper($puerto),1,0,'C',false);
$pdf->Cell(30,5,'EXPORTADOR:',1,0,'L',false);
$pdf->Cell(70,5,strtoupper($cliente),1,0,'C',false);

$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(40,5,'BOOKING:',1,0,'L',false);
$pdf->Cell(60,5,strtoupper($booking),1,0,'C',false);
$pdf->Cell(30,5,'CUIT:',1,0,'L',false);
$pdf->Cell(70,5,strtoupper(mysql_result($resClientes, 0,'cuit')),1,0,'C',false);

$pdf->SetFont('Arial','',10);

/*
SIM	CANAL	OFIC.	EXPORTADOR	ITEM	SUB	CONTENEDOR	BOOKING	PAIS	
PUERTO	AGENCIA	PRECINTO	MARCAS	BULTOS	BRUTO	NETO	VAL. UNIT	
FOB	TC	FOB PESOS	GASTOS	%	SUBTOTAL	MINIMO	TOTAL	FACT

*/
$pdf->Ln();
$pdf->Ln();


$primero = 0;
$contenedor = '';

$fob = 0;
$neto = 0;
$bruto = 0;
$bulto = 0;
$tara = 0;

while ($row = mysql_fetch_array($datosDetalles)) {
	if ($contenedor != $row['contenedor']) {
		$pdf->Ln();
		$pdf->SetX(5);

		$pdf->SetFillColor(255,0,0);
		$pdf->SetTextColor(255);
		$pdf->SetDrawColor(128,0,0);
		$pdf->SetLineWidth(.3);
		
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(67,5,'CONTENEDOR: '.strtoupper($row['contenedor']),1,0,'C',true);
		$pdf->Cell(67,5,'TARA: '.$row['tara'],1,0,'C',true);
		$pdf->Cell(66,5,'PRECINTO: '.strtoupper($row['precinto']),1,0,'C',true);

		$pdf->SetTextColor(0);

		$pdf->Ln();
		$pdf->SetX(5);
		$pdf->Cell(30,5,'BULTO',1,0,'C',false);
		$pdf->Cell(30,5,'BRUTO',1,0,'C',false);
		$pdf->Cell(30,5,'NETO',1,0,'C',false);
		$pdf->Cell(55,5,'MARCA',1,0,'C',false);
		$pdf->Cell(55,5,'MERCADERIA',1,0,'C',false);

		$contenedor = $row['contenedor'];

		$tara += $row['tara'];
	}


	$pdf->SetDrawColor(0,0,0);
	$pdf->SetTextColor(0);
	$pdf->SetFont('Arial','',8);

	$pdf->Ln();
	$pdf->SetX(5);
	$pdf->Cell(30,5,$row['bulto'],1,0,'C',false);
	$pdf->Cell(30,5,$row['bruto'],1,0,'C',false);
	$pdf->Cell(30,5,$row['neto'],1,0,'C',false);
	$pdf->Cell(55,5,strtoupper($row['marca']),1,0,'C',false);
	$pdf->Cell(55,5,strtoupper($row['mercaderia']),1,0,'C',false);


	$bulto += $row['bulto'];
	$neto += $row['neto'];
	$bruto += $row['bruto'];


}

$pdf->SetFillColor(166,247,238);
$pdf->SetFont('Arial','',10);
$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(200,7,'TOTALES',1,0,'C',true);
$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(40,7,'BULTOS: '.$bulto,1,0,'C',false);
$pdf->Cell(40,7,'BRUTO: '.$bruto,1,0,'C',false);
$pdf->Cell(40,7,'NETO: '.$neto,1,0,'C',false);
$pdf->Cell(80,7,'PESO BRUTO CON TARA: '.($bruto + $tara),1,0,'C',false);

$file = "rptPermisoDeEmbarque.pdf";

$pdf->Output($file,'I');








/*
//Para y asunto del mensaje a enviar
    $email_to = "msredhotero@msn.com,msredhotero@gmail.com"; 
    $email_subject = "Permiso de Embarque - PROCOMEX";

    //variables para los datos del archivo 
    $nombrearchivo = $file;
    $archivo = $file;
    // Leemos el archivo a adjuntar
    
    $archivo = file_get_contents($archivo);
    $archivo = chunk_split(base64_encode($archivo));
     */
    
     
// create email headers
      /*$headers = "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: multipart/mixed;";
      $headers .= "boundary=\"=A=G=R=O=\"\r\n";
      $headers .= "From : ".$email_from."\r\n"; */
    /* 
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
    
    $CuerpoMensaje = 'Le enviamos este email con el motivo de la generacion de una Permiso de Embarque a traves de PROCOMEX';
     // Cuerpo del Email
      
    
     //cabecera del email (forma correcta de codificarla)
    $headers = "From: PROCOMEX - Gustavo Omar Avila <gustavo@procomex.com.ar>\r\n";
    //$header .= "Reply-To: " . $replyto . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"=A=G=R=O=\"\r\n\r\n";
    
    
    //armando mensaje del email
    $email_message = "--=A=G=R=O=\r\n";
    $email_message .= "Content-type:text/plain; charset=utf-8\r\n";
    $email_message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $email_message .= $CuerpoMensaje . "\r\n\r\n";
    
    //archivo adjunto  para email    
    $email_message .= "--=A=G=R=O=\r\n";
    $email_message .= "Content-Type: application/octet-stream; name=\"" . $nombrearchivo . "\"\r\n";
    $email_message .= "Content-Transfer-Encoding: base64\r\n";
    $email_message .= "Content-Disposition: attachment; filename=\"" . $nombrearchivo . "\"\r\n\r\n";
    $email_message .= $archivo . "\r\n\r\n";
    $email_message .= "--=A=G=R=O=--";
    
    
    
    //enviamos el email
    mail($email_to, $email_subject, $email_message, $headers);
    */
?>

