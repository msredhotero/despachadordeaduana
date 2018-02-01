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
$pdf->Cell(190,7,'PERMISO DE EMBARQUE',0,0,'C',false);

$pdf->SetFont('Arial','U',12);
$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(47.5,5,'PERMISO DE EMBARQUE:',1,0,'L',false);
$pdf->Cell(47.5,5,strtoupper($sim),1,0,'C',false);
$pdf->Cell(47.5,5,'CANAL:',1,0,'L',false);
$pdf->Cell(47.5,5,strtoupper($color),1,0,'C',false);

$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(47.5,5,'BUQUE:',1,0,'L',false);
$pdf->Cell(47.5,5,strtoupper($buque),1,0,'C',false);
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
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$primero = 0;
$contenedor = '';

$fob = 0;
$neto = 0;
$bruto = 0;
$bultos = 0;
$tara = 0;

$file = "rptPermisoDeEmbarque.pdf";

$pdf->Output($file,'f');









//Para y asunto del mensaje a enviar
    $email_to = "msredhotero@msn.com,msredhotero@gmail.com"; 
    $email_subject = "Email desde cotizador de pagina Web";

    //variables para los datos del archivo 
    $nombrearchivo = $file;
    $archivo = $file;
    // Leemos el archivo a adjuntar
    
    $archivo = file_get_contents($archivo);
    $archivo = chunk_split(base64_encode($archivo));
     
    
     
// create email headers
      /*$headers = "MIME-Version: 1.0\r\n";
      $headers .= "Content-type: multipart/mixed;";
      $headers .= "boundary=\"=A=G=R=O=\"\r\n";
      $headers .= "From : ".$email_from."\r\n"; */
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
    
    $CuerpoMensaje = '';
     // Cuerpo del Email
    $CuerpoMensaje .= "A continuación más detalles:\r\n\r\n";

    $CuerpoMensaje .= "<b>Email:</b> ".clean_string('msredhotero@gmail.com')."\r\n";    

    $CuerpoMensaje .= "<b>Mensaje:</b> ".clean_string('marcos')."\r\n";
      
    
     //cabecera del email (forma correcta de codificarla)
    $headers = "From: Globalcolor WEB <msredhotero@gmail.com>\r\n";
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

?>

