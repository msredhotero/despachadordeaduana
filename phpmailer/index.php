<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require 'vendor/autoload.php';


date_default_timezone_set('America/Buenos_Aires');

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');


$serviciosUsuarios          = new ServiciosUsuarios();
$serviciosFunciones         = new Servicios();
$serviciosHTML              = new ServiciosHTML();
$serviciosReferancias       = new ServiciosReferencias();

$fecha = date('Y-m-d');

require('fpdf.php');


//$header = array("Hora", "Cancha 1", "Cancha 2", "Cancha 3");

$id     =   $_GET['id'];


$datos = $serviciosReferancias->traerExportacionesPorIdReporte($id);

$fecha      = mysql_result($datos,0,'fecha');
$sim        = mysql_result($datos,0,'permisoembarque');

$buque      = mysql_result($datos,0,'buque');
$destino    = mysql_result($datos,0,'destino');
$puerto     = mysql_result($datos,0,'puerto');
$color      = mysql_result($datos,0,'color');
$booking    = mysql_result($datos,0,'booking');
$despachante= mysql_result($datos,0,'despachante');
$cuit       = mysql_result($datos,0,'cuit');

$resClientes    = $serviciosReferancias->traerClientesPorId(mysql_result($datos,0,'refclientes'));

$cliente    = mysql_result($resClientes,0,'razonsocial');

$factura    = mysql_result($datos,0,'factura');




$datosDetalles = $serviciosReferancias->rptExportacionesCompletoPorId($id);


$Totales = 0;


$pdf = new FPDF('L','mm','A4');

$pdf->AddPage();

$pdf->SetFont('Arial','U',17);
$pdf->Cell(285,7,'AUTORIZACION PARA CARGAR MERCADERIAS',0,0,'C',false);

$pdf->SetFont('Arial','',10);
$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(54,5,'PERMISO DE EMBARQUE:',1,0,'L',false);
$pdf->Cell(81,5,strtoupper($sim),1,0,'C',false);
$pdf->Cell(40.5,5,'CANAL:',1,0,'L',false);
$pdf->Cell(110,5,strtoupper($color),1,0,'C',false);

$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(54,5,'BUQUE:',1,0,'L',false);
$pdf->Cell(81,5,strtoupper($buque),1,0,'C',false);
$pdf->Cell(40.5,5,'DESPACHANTE:',1,0,'L',false);
$pdf->Cell(110,5,strtoupper($despachante),1,0,'C',false);

$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(54,5,'DESTINO:',1,0,'L',false);
$pdf->Cell(81,5,strtoupper($destino),1,0,'C',false);
$pdf->Cell(40.5,5,'CUIT:',1,0,'L',false);
$pdf->Cell(110,5,strtoupper($cuit),1,0,'C',false);

$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(54,5,'PUERTO:',1,0,'L',false);
$pdf->Cell(81,5,strtoupper($puerto),1,0,'C',false);
$pdf->Cell(40.5,5,'EXPORTADOR:',1,0,'L',false);
$pdf->Cell(110,5,strtoupper($cliente),1,0,'C',false);

$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(54,5,'BOOKING:',1,0,'L',false);
$pdf->Cell(81,5,strtoupper($booking),1,0,'C',false);
$pdf->Cell(40.5,5,'CUIT:',1,0,'L',false);
$pdf->Cell(110,5,strtoupper(mysql_result($resClientes, 0,'cuit')),1,0,'C',false);

$pdf->SetFont('Arial','',10);

/*
SIM CANAL   OFIC.   EXPORTADOR  ITEM    SUB CONTENEDOR  BOOKING PAIS    
PUERTO  AGENCIA PRECINTO    MARCAS  BULTOS  BRUTO   NETO    VAL. UNIT   
FOB TC  FOB PESOS   GASTOS  %   SUBTOTAL    MINIMO  TOTAL   FACT

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
        $pdf->Cell(95,5,'CONTENEDOR: '.strtoupper($row['contenedor']),1,0,'C',true);
        $pdf->Cell(95,5,'TARA: '.$row['tara'],1,0,'C',true);
        $pdf->Cell(95,5,'PRECINTO: '.strtoupper($row['precinto']),1,0,'C',true);

        $pdf->SetTextColor(0);

        $pdf->Ln();
        $pdf->SetX(5);
        $pdf->Cell(42.75,5,'BULTO',1,0,'C',false);
        $pdf->Cell(42.75,5,'BRUTO',1,0,'C',false);
        $pdf->Cell(42.75,5,'NETO',1,0,'C',false);
        $pdf->Cell(78.3,5,'MARCA',1,0,'C',false);
        $pdf->Cell(78.4,5,'MERCADERIA',1,0,'C',false);

        $contenedor = $row['contenedor'];

        $tara += $row['tara'];
    }


    $pdf->SetDrawColor(0,0,0);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial','',8);

    $pdf->Ln();
    $pdf->SetX(5);
  $pdf->SetFont('Arial','',10);
    $pdf->Cell(42.75,5,$row['bulto'],1,0,'C',false);
    $pdf->Cell(42.75,5,$row['bruto'],1,0,'C',false);
    $pdf->Cell(42.75,5,$row['neto'],1,0,'C',false);
  $pdf->SetFont('Arial','',9);
    $pdf->Cell(78.3,5,strtoupper($row['marca']),1,0,'C',false);
    $pdf->Cell(78.4,5,strtoupper($row['mercaderia']),1,0,'C',false);


    $bulto += $row['bulto'];
    $neto += $row['neto'];
    $bruto += $row['bruto'];


}

$pdf->SetFillColor(166,247,238);
$pdf->SetFont('Arial','',10);
$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(285,7,'TOTALES',1,0,'C',true);
$pdf->Ln();
$pdf->SetX(5);
$pdf->Cell(57,7,'BULTOS: '.$bulto,1,0,'C',false);
$pdf->Cell(57,7,'BRUTO: '.$bruto,1,0,'C',false);
$pdf->Cell(57,7,'NETO: '.$neto,1,0,'C',false);
$pdf->Cell(114,7,'PESO BRUTO CON TARA: '.($bruto + $tara),1,0,'C',false);

$file = "rptPermisoDeEmbarque.pdf";

$pdf->Output($file,'F');





$emails = $serviciosReferancias->enviarEmailDePermisos($id);
$emailsAux = $serviciosReferancias->enviarEmailDePermisos($id);

$lstEmail = '';
while ($rowE = mysql_fetch_array($emails)) {
    $lstEmail .= $rowE[0].',';
}

$lstEmail = substr($lstEmail,0,-1);

$CuerpoMensaje = '<h3>Le enviamos este email con el motivo de la generacion de una Permiso de Embarque a traves de PROCOMEX</h3>';
$CuerpoMensaje .= '<p>Permiso de Embarque: '.$sim.'</p>';
$CuerpoMensaje .= '<p>Buque: '.$buque.'</p>';


if ($lstEmail != '') {
//phpinfo();


    

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'mail.procomex.com.ar';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'marcos@procomex.com.ar';                 // SMTP username
        $mail->Password = 'RHcp7575';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('gustavo@procomex.com.ar', 'PROCOMEX - Gustavo Omar Avila');

        while ($rowE = mysql_fetch_array($emailsAux)) {
            //$lstEmail .= $rowE[0].',';
            $mail->addAddress($rowE[0]);
        }
        $mail->addAddress('msredhotero@gmail.com'); 
        //$mail->addAddress('msredhotero@gmail.com', 'Joe User');     // Add a recipient
        //$mail->addAddress('msredhotero@msn.com');               // Name is optional
        $mail->addReplyTo('marcos@procomex.com.ar', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        $mail->addAttachment($file);         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Permiso de Embarque '.$sim;
        $mail->Body    = $CuerpoMensaje;
        $mail->AltBody = '';

        $mail->send();
        echo '<h2>Se envio el email con el adjunto a los destinatarios: '.$lstEmail.'</h2>';
    } catch (Exception $e) {
        echo 'No se pudo enviar el mensaje. Mailer Error: ', $mail->ErrorInfo;
    }
    
}
?>