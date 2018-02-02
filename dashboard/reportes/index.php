<?php


session_start();


if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../error.php');
} else {


include ('../../includes/funcionesUsuarios.php');
include ('../../includes/funcionesHTML.php');
include ('../../includes/funciones.php');
include ('../../includes/funcionesReferencias.php');

$serviciosUsuario = new ServiciosUsuarios();
$serviciosHTML = new ServiciosHTML();
$serviciosFunciones = new Servicios();
$serviciosReferencias 	= new ServiciosReferencias();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Reportes",$_SESSION['refroll_predio'],'');

$resBuques = $serviciosReferencias->traerBuques();
$cadBuques = $serviciosFunciones->devolverSelectBox($resBuques,array(1),'');

?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title>Gesti&oacute;n: Despachante de Aduana</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../../js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="../../css/jquery-ui.css">

    <script src="../../js/jquery-ui.js"></script>
    
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../css/bootstrap-datetimepicker.min.css">
	171
    <!-- Latest compiled and minified JavaScript -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
	<style type="text/css">

		
	</style>
    
   
   <link href="../../css/perfect-scrollbar.css" rel="stylesheet">
      <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
      <script src="../../js/jquery.mousewheel.js"></script>
      <script src="../../js/perfect-scrollbar.js"></script>
      <script>
      jQuery(document).ready(function ($) {
        "use strict";
        $('#navigation').perfectScrollbar();
      });
    </script>
</head>

<body>

 <?php echo $resMenu; ?>

<div id="content">

<h3>Reportes</h3>

    <div class="boxInfoLargo tile-stats stat-til tile-white">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Reporte Mes</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	<div class="row">
            	<div class="form-group col-md-4 col-xs-6" style="display:'.$lblOculta.'">
                    <label for="fecha1" class="control-label" style="text-align:left">Seleccione el Día</label>
                    <div class="input-group col-md-6 col-xs-12">
                    <input class="form-control" type="text" name="fecha1" id="fecha1" value="Date"/>
                    </div>
                </div>
                
                
                <div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="refcliente">Acción</label>

                    	<ul class="list-inline">
                        	<li>
                    			<button type="button" class="btn btn-success" id="rptCajaDiaria" style="margin-left:0px;">Generar</button>
                            </li>
                            <!--<li>
                        		<button type="button" class="btn btn-default" id="rptCJExcel" style="margin-left:0px;">Generar Excel</button>
                            </li>-->
                        </ul>

                </div>
                

            </div>
            
            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <div class='alert'>
                
                </div>
                <div id='load'>
                
                </div>
            </div>

            </form>
    	</div>
    </div>
    
    
    <div class="boxInfoLargo tile-stats stat-til tile-white">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Reporte Por Buque</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	<div class="row">
            	<div class="form-group col-md-4 col-xs-3" style="display:'.$lblOculta.'">
                    <label for="fecha1" class="control-label" style="text-align:left">Seleccione el Mes</label>
                    <div class="input-group col-md-6 col-xs-12">
                    <input class="form-control" type="text" name="fecha2" id="fecha2" value="Date"/>
                    </div>
                </div>

                <div class="form-group col-md-4 col-xs-3" style="display:'.$lblOculta.'">
                    <label for="fecha1" class="control-label" style="text-align:left">Seleccione el Buque</label>
                    <div class="input-group col-md-6 col-xs-12">
                        <select class="form-control" id="lstbuques" name="lstbuques">
                            <?php echo $cadBuques; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-4 col-xs-5" style="display:'.$lblOculta.'">
                    <label for="fecha1" class="control-label" style="text-align:left">Seleccione el Buque</label>
                    <div class="input-group col-md-6 col-xs-12">
                        <select class="form-control" id="facturado" name="facturado">
                            <option value="0">No Facturado</option>
                            <option value="1">Todo</option>
                        </select>
                    </div>
                </div>

                
                <div class="form-group col-md-2">
                    <label class="control-label" style="text-align:left" for="refcliente">Acción</label>

                    	<ul class="list-inline">
                        	<li>
                    			<button type="button" class="btn btn-success" id="rptBuque" style="margin-left:0px;">Generar</button>
                            </li>
                            <!--<li>
                        		<button type="button" class="btn btn-default" id="rptCJExcel" style="margin-left:0px;">Generar Excel</button>
                            </li>-->
                        </ul>

                </div>
                

            </div>
            
            
            <div class='row' style="margin-left:25px; margin-right:25px;">
                <div class='alert'>
                
                </div>
                <div id='load'>
                
                </div>
            </div>

            </form>
    	</div>
    </div>
    

    
   
</div>


</div>

<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script src="../../bootstrap/js/dataTables.bootstrap.js"></script>
<script src="../../js/bootstrap-datetimepicker.min.js"></script>
<script src="../../js/bootstrap-datetimepicker.es.js"></script>

<script type="text/javascript">
$(document).ready(function(){


	$("#rptCajaDiaria").click(function(event) {
        window.open("../../reportes/rptdiarioExcel.php?fecha=" + $("#fecha1").val() ,'_blank');	
						
    });
	
	$("#rptBuque").click(function(event) {
        window.open("../../reportes/rptmensualPorBuqueExcel.php?fecha=" + $("#fecha2").val() + "&buque=" + $('#lstbuques').val() + "&facturado=" + $('#facturado').val() ,'_blank'); 
                        
    });
	

});
</script>
<script type="text/javascript">
/*
$('.form_date').datetimepicker({
	language:  'es',
	weekStart: 1,
	todayBtn:  1,
	autoclose: 1,
	todayHighlight: 1,
	startView: 2,
	minView: 2,
	forceParse: 0,
	format: 'dd/mm/yyyy'
});
*/
</script>

<script>
  $(function() {
	  $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
 
    $( "#fecha1" ).datepicker();
    $( "#fecha1" ).datepicker( "option", "dateFormat", "yy-mm" );
	
	$( "#fecha2" ).datepicker();
    $( "#fecha2" ).datepicker( "option", "dateFormat", "yy-mm" );
	
	$( "#fecha3" ).datepicker();
    $( "#fecha3" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fecha4" ).datepicker();
    $( "#fecha4" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fecha5" ).datepicker();
    $( "#fecha5" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechadesde2" ).datepicker();
    $( "#fechadesde2" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechadesde3" ).datepicker();
    $( "#fechadesde3" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechadesde4" ).datepicker();
    $( "#fechadesde4" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechadesde5" ).datepicker();
    $( "#fechadesde5" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	
	$( "#fechahasta1" ).datepicker();
    $( "#fechahasta1" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechahasta2" ).datepicker();
    $( "#fechahasta2" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechahasta3" ).datepicker();
    $( "#fechahasta3" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechahasta4" ).datepicker();
    $( "#fechahasta4" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fechahasta5" ).datepicker();
    $( "#fechahasta5" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
  });
  </script>
<?php } ?>
</body>
</html>
