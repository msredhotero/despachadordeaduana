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
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Reportes",$_SESSION['refroll_predio'],$_SESSION['sede']);


$lstFunciones = $serviciosFunciones->devolverSelectBox( $serviciosReferencias->traerFunciones(),array(3,4,5),' - ');

$lstObras = $serviciosFunciones->devolverSelectBox( $serviciosReferencias->traerObras(),array(1),'');

?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title>Gesti&oacute;n: Teatro Ciego</title>
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
        	<p style="color: #fff; font-size:18px; height:16px;">Reporte Diario</p>
        	
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
                
                <div class="form-group col-md-6" style="display:block">
                    <label class="control-label" for="codigobarra" style="text-align:left">Función <span style="color:#F00;">*</span></label>
                    <div class="input-group col-md-12">
                        <select data-placeholder="selecione la Función..." id="reffunciones" name="reffunciones" class="form-control" tabindex="2">
                            
                            <?php echo $lstFunciones; ?>
                        </select>
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
        	<p style="color: #fff; font-size:18px; height:16px;">Reporte Mensual</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	<div class="row">
            	<div class="form-group col-md-4 col-xs-6" style="display:'.$lblOculta.'">
                    <label for="fecha1" class="control-label" style="text-align:left">Seleccione la fecha</label>
                    <div class="input-group col-md-6 col-xs-12">
                    <input class="form-control" type="text" name="fecha2" id="fecha2" value="Date"/>
                    </div>
                </div>
                
                <div class="form-group col-md-6" style="display:block">
                    <label class="control-label" for="codigobarra" style="text-align:left">Obra <span style="color:#F00;">*</span></label>
                    <div class="input-group col-md-12">
                        <select data-placeholder="selecione la Función..." id="refobras" name="refobras" class="form-control" tabindex="2">
                            
                            <?php echo $lstObras; ?>
                        </select>
                    </div>
                </div>
                
                
                <div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="refcliente">Acción</label>

                    	<ul class="list-inline">
                        	<li>
                    			<button type="button" class="btn btn-success" id="rptCajaMensual" style="margin-left:0px;">Generar</button>
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
        	<p style="color: #fff; font-size:18px; height:16px;">Planilla de Aportes</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	<div class="row">
            	<div class="form-group col-md-3 col-xs-6" style="display:'.$lblOculta.'">
                    <label for="fecha1" class="control-label" style="text-align:left">Seleccione la fecha desde</label>
                    <div class="input-group col-md-12 col-xs-12">
                    <input class="form-control" type="text" name="fecha3" id="fecha3" value="Date"/>
                    </div>
                </div>
                
                <div class="form-group col-md-3 col-xs-6" style="display:'.$lblOculta.'">
                    <label for="fecha1" class="control-label" style="text-align:left">Seleccione la fecha hasta</label>
                    <div class="input-group col-md-12 col-xs-12">
                    <input class="form-control" type="text" name="fecha4" id="fecha4" value="Date"/>
                    </div>
                </div>
                
                <div class="form-group col-md-6" style="display:block">
                    <label class="control-label" for="codigobarra" style="text-align:left">Obra <span style="color:#F00;">*</span></label>
                    <div class="input-group col-md-12">
                        <select data-placeholder="selecione la Función..." id="refobras2" name="refobras2" class="form-control" tabindex="2">
                            
                            <?php echo $lstObras; ?>
                        </select>
                    </div>
                </div>
                
                
                <div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="refcliente">Acción</label>

                    	<ul class="list-inline">
                        	<li>
                    			<button type="button" class="btn btn-success" id="rptPlanillaAportes" style="margin-left:0px;">Generar</button>
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
        	<p style="color: #fff; font-size:18px; height:16px;">Argentores</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	<div class="row">
            	<div class="form-group col-md-3 col-xs-6" style="display:fechas">
                    <label for="fecha1" class="control-label" style="text-align:left">Seleccione la fecha</label>
                    <div class="input-group col-md-12 col-xs-12">
                    <input class="form-control" type="text" name="fecha5" id="fecha5" value="Date"/>
                    </div>
                </div>
                
               <div class="form-group col-md-6" style="display:block">
                    <label class="control-label" for="codigobarra" style="text-align:left">Obra <span style="color:#F00;">*</span></label>
                    <div class="input-group col-md-12">
                        <select data-placeholder="selecione la Función..." id="refobras3" name="refobras3" class="form-control" tabindex="2">
                            
                            <?php echo $lstObras; ?>
                        </select>
                    </div>
                </div>
                
                
                <div class="form-group col-md-3">
                    <label class="control-label" style="text-align:left" for="refcliente">Acción</label>

                    	<ul class="list-inline">
                        	<li>
                    			<button type="button" class="btn btn-info" id="buscarargentores" style="margin-left:0px;">Buscar</button>
                            </li>
                            <!--<li>
                        		<button type="button" class="btn btn-default" id="rptCJExcel" style="margin-left:0px;">Generar Excel</button>
                            </li>-->
                        </ul>

                </div>
                
                <div class="form-group col-md-3">
                	<label for="fecha1" class="control-label" style="text-align:left">Valor Entrada</label>
                    <div class="input-group col-md-12 col-xs-12">
                    <input class="form-control" type="text" name="valorentrada" id="valorentrada" value="0" readonly/>
                    </div>
                
                </div>
                
                <div class="form-group col-md-3">
                	<label for="fecha1" class="control-label" style="text-align:left">Total Recaudado</label>
                    <div class="input-group col-md-12 col-xs-12">
                    <input class="form-control" type="text" name="totalrecaudado" id="totalrecaudado" value="0" readonly/>
                    </div>
                
                </div>
                
                <div class="form-group col-md-3">
                	<label for="fecha1" class="control-label" style="text-align:left">Argentores</label>
                    <div class="input-group col-md-12 col-xs-12">
                    <input class="form-control" type="text" name="argentores" id="argentores" value="0" readonly/>
                    </div>
                
                </div>
           </div>
           <div class="row">     
                <div class="form-group col-md-3">
                	<label for="fecha1" class="control-label" style="text-align:left">Entradas Full</label>
                    <div class="input-group col-md-12 col-xs-12">
                    <input class="form-control" type="text" name="efull" id="efull" value="0"/>
                    </div>
                
                </div>
                
                <div class="form-group col-md-3">
                	<label for="fecha1" class="control-label" style="text-align:left">Entradas 50%</label>
                    <div class="input-group col-md-12 col-xs-12">
                    <input class="form-control" type="text" name="e50" id="e50" value="0"/>
                    </div>
                
                </div>
                
                <div class="form-group col-md-3">
                	<label for="fecha1" class="control-label" style="text-align:left">Entradas Cartelera</label>
                    <div class="input-group col-md-12 col-xs-12">
                    <input class="form-control" type="text" name="ecartelera" id="ecartelera" value="0"/>
                    </div>
                
                </div>
                
                <div class="form-group col-md-3">
                	<label for="fecha1" class="control-label" style="text-align:left">Entradas Invitados</label>
                    <div class="input-group col-md-12 col-xs-12">
                    <input class="form-control" type="text" name="einvitados" id="einvitados" value="0"/>
                    </div>
                
                </div>
                
			</div>
            
            <div class="form-group col-md-6">
                    <label class="control-label" style="text-align:left" for="refcliente">Acción</label>

                        <ul class="list-inline">
                            <li>
                                <button type="button" class="btn btn-success" id="rptArgentores" style="margin-left:0px;">Generar</button>
                            </li>
                            <!--<li>
                                <button type="button" class="btn btn-default" id="rptCJExcel" style="margin-left:0px;">Generar Excel</button>
                            </li>-->
                        </ul>

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
        window.open("../../reportes/rptdiarioExcel.php?fecha=" + $("#fecha1").val() + "&reffuncion=" + $('#reffunciones').val() ,'_blank');	
						
    });
	
	$("#rptCajaMensual").click(function(event) {
        window.open("../../reportes/rptMensualPorObraExcel.php?fecha=" + $("#fecha2").val() + "&refobras=" + $('#refobras').val() ,'_blank');	
						
    });
	$("#rptCajaDiariaDetalle").click(function(event) {
        window.open("../../reportes/rptdiariodetalle.php?fecha=" + $("#fecha1").val() ,'_blank');	
						
    });
	
	$("#rptPlanillaAportes").click(function(event) {

        window.open("../../reportes/rptPlanillaDeAportes.php?desde=" + $("#fecha3").val() + "&hasta=" + $("#fecha4").val() + '&id=' + $('#refobras2').val(),'_blank');	
						
    });

    $('#rptArgentores').click(function(event) {

        window.open("../../reportes/rptArgentores.php?fecha5=" + $("#fecha5").val() + "&id=" + $("#refobras3").val() + '&valorentrada=' + $('#valorentrada').val() + '&totalrecaudado=' + $('#totalrecaudado').val() + '&argentores=' + $('#argentores').val() + '&efull=' + $('#efull').val() + '&e50=' + $('#e50').val() + '&ecartelera=' + $('#ecartelera').val() + '&einvitados=' + $('#einvitados').val() ,'_blank');  
                        
    });
	
	
	
	
	$("#rptsc").click(function(event) {
        window.open("../../reportes/rptSaldosClientes.php?idEmp=" + $("#refempresa2").val() + "&fechadesde=" + $("#fechadesde2").val()+ "&fechahasta=" + $("#fechahasta2").val(),'_blank');	
						
    });
	
	$("#rptscc").click(function(event) {
        window.open("../../reportes/rptSaldosPorClientes.php?idEmp=" + $("#refempresa4").val() + "&idClie=" + $("#refcliente1").val() + "&fechadesde=" + $("#fechadesde3").val()+ "&fechahasta=" + $("#fechahasta3").val(),'_blank');	
						
    });
	
	$('#rptcc').click(function(e) {
        window.open("../../reportes/rptSaldosEmpresa.php?fechadesde=" + $("#fechadesde4").val()+ "&fechahasta=" + $("#fechahasta4").val(),'_blank');
    });
	
	$("#rpt5").click(function(event) {
        window.open("../../reportes/rptSaldosClientesEmpresas.php?idClie=" + $("#refcliente5").val() + "&fechadesde=" + $("#fechadesde5").val()+ "&fechahasta=" + $("#fechahasta5").val(),'_blank');	
						
    });
	
	
	$("#rpt6").click(function(event) {
        window.open("../../reportes/rptSociosEmpresas.php",'_blank');	
						
    });
	
	$("#rpt7").click(function(event) {
        window.open("../../reportes/rptSocios.php",'_blank');	
						
    });

	
	
	
	
	$("#rptgfExcel").click(function(event) {
        window.open("../../reportes/rptFacturacionGeneralExcel.php?id=" + $("#refempresa1").val() + "&fechadesde=" + $("#fechadesde1").val()+ "&fechahasta=" + $("#fechahasta1").val(),'_blank');	
						
    });
	
	$("#rptscExcel").click(function(event) {
        window.open("../../reportes/rptSaldosClientesExcel.php?idEmp=" + $("#refempresa2").val() + "&fechadesde=" + $("#fechadesde2").val()+ "&fechahasta=" + $("#fechahasta2").val(),'_blank');	
						
    });
	
	$("#rptsccExcel").click(function(event) {
        window.open("../../reportes/rptSaldosPorClientesExcel.php?idEmp=" + $("#refempresa4").val() + "&idClie=" + $("#refcliente1").val() + "&fechadesde=" + $("#fechadesde3").val()+ "&fechahasta=" + $("#fechahasta3").val(),'_blank');	
						
    });
	
	$('#rptccExcel').click(function(e) {
        window.open("../../reportes/rptSaldosEmpresaExcel.php?fechadesde=" + $("#fechadesde4").val()+ "&fechahasta=" + $("#fechahasta4").val(),'_blank');
    });
	
	$("#rpt5Excel").click(function(event) {
        window.open("../../reportes/rptSaldosClientesEmpresasExcel.php?idClie=" + $("#refcliente5").val() + "&fechadesde=" + $("#fechadesde5").val()+ "&fechahasta=" + $("#fechahasta5").val(),'_blank');	
						
    });
	
	$("#rpt6Excel").click(function(event) {
        window.open("../../reportes/rptSociosEmpresasExcel.php",'_blank');	
						
    });
	
	$("#rpt7Excel").click(function(event) {
        window.open("../../reportes/rptSociosExcel.php",'_blank');	
						
    });
	
	
	function traerAutocompleteVal(idObra, funcion, contenedor) {
		$.ajax({
			data:  {id: idObra, accion: funcion},
					url:   '../../ajax/ajax.php',
					type:  'post',
			beforeSend: function () {
			
			},
			success:  function (response) {
				$('#'+contenedor).val(response);
			
			}
		});		
	}
	
	var total = 0;
	$('#buscarargentores').click(function() {
		
		$('#efull').val(0);
		$('#e50').val(0);
		$('#ecartelera').val(0);
		$('#einvitados').val(0);

		//valor entrada
		traerAutocompleteVal($('#refobras3').val(), 'traerValorEntradaPorFuncion', 'valorentrada');
	});
	
	$('#efull').change(function() {
		if ($(this).val() > 0) {
			total = parseFloat( $(this).val() * $('#valorentrada').val() ) + parseFloat( ($('#e50').val() * $('#valorentrada').val()) * 0.5 ) + parseFloat( $('#ecartelera').val() * $('#valorentrada').val() * 0.1);
			$('#totalrecaudado').val(total);
			
			$('#argentores').val(total * 0.1);
		} else {
			$(this).val(0);
		}
	});
	
	
	$('#e50').change(function() {
		if ($(this).val() > 0) {
			total = parseFloat( $('#efull').val() * $('#valorentrada').val() ) + parseFloat( ($('#e50').val() * $('#valorentrada').val()) * 0.5 ) + parseFloat( $('#ecartelera').val() * $('#valorentrada').val() * 0.1);
			$('#totalrecaudado').val(total);
			
			$('#argentores').val(total * 0.1);
		} else {
			$(this).val(0);
		}
	});
	
	
	$('#ecartelera').change(function() {
		if ($(this).val() > 0) {
			total = parseFloat( $('#efull').val() * $('#valorentrada').val() ) + parseFloat( ($('#e50').val() * $('#valorentrada').val()) * 0.5 ) + parseFloat( $('#ecartelera').val() * $('#valorentrada').val() * 0.1);
			$('#totalrecaudado').val(total);
			
			$('#argentores').val(total * 0.1);
		} else {
			$(this).val(0);
		}
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
    $( "#fecha1" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$( "#fecha2" ).datepicker();
    $( "#fecha2" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	
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
