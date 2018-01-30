<?php


session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../../error.php');
} else {


include ('../../includes/funciones.php');
include ('../../includes/funcionesUsuarios.php');
include ('../../includes/funcionesHTML.php');
include ('../../includes/funcionesReferencias.php');

$serviciosFunciones 	= new Servicios();
$serviciosUsuario 		= new ServiciosUsuarios();
$serviciosHTML 			= new ServiciosHTML();
$serviciosReferencias 	= new ServiciosReferencias();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Exportaciones",$_SESSION['refroll_predio'],'');


$resConfiguracion = $serviciosReferencias->traerConfiguracion();

if (mysql_num_rows($resConfiguracion)>0) {
	$despachador = mysql_result($resConfiguracion,0,'razonsocial');
	$despachadorCUIT = mysql_result($resConfiguracion,0,'cuit');
	$gastos = mysql_result($resConfiguracion,0,'gastos');
	$honorarios = mysql_result($resConfiguracion,0,'honorarios');
} else {
	$despachador = '';
	$despachadorCUIT = '';
	$gastos =10;
	$honorarios = 0;
}

/////////////////////// Opciones pagina ///////////////////////////////////////////////
$singular = "Exportacion";

$plural = "Exportaciones";

$eliminar = "eliminarExportaciones";

$insertar = "insertarExportaciones";

$tituloWeb = "Gestión: Despachante de Aduana";
//////////////////////// Fin opciones ////////////////////////////////////////////////


/////////////////////// Opciones para la creacion del formulario  /////////////////////
$tabla 			= "dbexportaciones";

$lblCambio	 	= array("refclientes","refbuques","refpuertos","refdestinos","refcolores",'permisoembarque',"refagencias");
$lblreemplazo	= array("Clientes","Buques","Puertos","Destinos","Canales",'Permiso de Embarque','Agencias');


$resClientes 	= $serviciosReferencias->traerClientes();
$cadRef 	= $serviciosFunciones->devolverSelectBox($resClientes,array(1),'');

$resBuques 	= $serviciosReferencias->traerBuques();
$cadRef2 	= $serviciosFunciones->devolverSelectBox($resBuques,array(1),'');

$resPuertos 	= $serviciosReferencias->traerPuertos();
$cadRef3 	= $serviciosFunciones->devolverSelectBox($resPuertos,array(1),'');


$resDestinos 	= $serviciosReferencias->traerDestinos();
$cadRef5 	= $serviciosFunciones->devolverSelectBox($resDestinos,array(1),'');


$resColores 	= $serviciosReferencias->traerColores();
$cadRef6 	= $serviciosFunciones->devolverSelectBox($resColores,array(1),'');

$resAgencias 	= $serviciosReferencias->traerAgencias();
$cadRef7 	= $serviciosFunciones->devolverSelectBox($resAgencias,array(1),'');

//die(var_dump($cadRef3));
$refdescripcion = array(0 => $cadRef,1 => $cadRef2,2 => $cadRef3,3 => $cadRef5,4 => $cadRef6, 5 => $cadRef7);
$refCampo 	=  array("refclientes","refbuques","refpuertos","refdestinos","refcolores","refagencias");
//////////////////////////////////////////////  FIN de los opciones //////////////////////////




/////////////////////// Opciones para la creacion del view  apellido,nombre,nrodocumento,fechanacimiento,direccion,telefono,email/////////////////////
$cabeceras 		= "	<th>Permiso Emb.</th>
					<th>Clientes</th>
					<th>Buques</th>
					<th>Puertos</th>
					<th>Destinos</th>
					<th>Canales</th>
					<th>Booking</th>
					<th>Fecha</th>
					<th>Fact.</th>";

//////////////////////////////////////////////  FIN de los opciones //////////////////////////




$formulario 	= $serviciosFunciones->camposTabla($insertar ,$tabla,$lblCambio,$lblreemplazo,$refdescripcion,$refCampo);

$lstCargados 	= $serviciosFunciones->camposTablaView($cabeceras,$serviciosReferencias->traerExportacionesGrid(),9);

$resMercaderias = $serviciosReferencias->traerMercaderias();
$cadMercaderia 	= $serviciosFunciones->devolverSelectBoxObligatorio($resMercaderias,array(1),'');

//die(var_dump($cadMercaderia2));

if ($_SESSION['refroll_predio'] != 1) {

} else {

	
}


?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">



<title><?php echo $tituloWeb; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../../js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="../../js/jquery.number.min.js"></script>
    <link rel="stylesheet" href="../../css/jquery-ui.css">

    <script src="../../js/jquery-ui.js"></script>
    
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css"/>
	171
    <!-- Latest compiled and minified JavaScript -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../../css/bootstrap-datetimepicker.min.css">
	
    
   
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

    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Carga de <?php echo $plural; ?></p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	<div class="row">
			<?php echo $formulario; ?>
			<input type="hidden" name="gastosaux" id="gastosaux">
			<input type="hidden" name="honorariosaux" id="honorariosaux">

				<br>
				<div class="col-md-12" style="margin-top:25px;" id="lstContenedores">
					
					<ul class="list-inline" style=" color:#5cb85c;border-bottom:2px solid #5cb85c; padding-bottom:15px;">
						<li style="font-size:18px; border-left:2px solid #F00;">Pulse agregar para cargar un contenedor</li>
						<li><input type="button" class="btn btn-success agregarContenedor" value="Agregar"></li>
					</ul>

					<div id="contenedorData" class="col-md-12" style="margin-top:25px;">

						
						
					</div>
				</div>
            </div>

            <div class='row' style="margin-left:25px; margin-right:25px;">
                <div class='alert'>
                
                </div>
                <div id='load'>
                
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                <ul class="list-inline" style="margin-top:15px;">
                    <li>
                        <button type="button" class="btn btn-primary" id="cargar" style="margin-left:0px;">Guardar</button>
                    </li>

                </ul>
                </div>
            </div>
            <input type="hidden" id="tokenContenedor" name="tokenContenedor" value="0">
            <input type="hidden" id="tokenItem" name="tokenItem" value="0">
            </form>
    	</div>
    </div>
    
    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;"><?php echo $plural; ?> Cargados</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<?php echo $lstCargados; ?>
            
    	</div>
    </div>
    
    

    
    
   
</div>


</div>
<div id="dialog2" title="Eliminar <?php echo $singular; ?>">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar el <?php echo $singular; ?>?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>Si elimina el <?php echo $singular; ?> se perderan todos los datos de este</p>
        <input type="hidden" value="" id="idEliminar" name="idEliminar">
</div>
<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script src="../../bootstrap/js/dataTables.bootstrap.js"></script>

<script src="../../js/bootstrap-datetimepicker.min.js"></script>
<script src="../../js/bootstrap-datetimepicker.es.js"></script>

<script type="text/javascript">
var idContenedor = 1;
var idItems = 1;
$(document).ready(function(){
	

	$('#colapsarMenu').click();
	$('#gastos').val(<?php echo $gastos; ?>);
	$('#honorarios').val(<?php echo $honorarios; ?>);
	$('#gastosaux').val(<?php echo $gastos; ?>);
	$('#honorariosaux').val(<?php echo $honorarios; ?>);

	$('#cuit').val('<?php echo $despachadorCUIT; ?>');
	$('#despachante').val('<?php echo $despachador; ?>');

	$('#gastos').prop("disabled",true);
	$('#honorarios').prop("disabled",true);
	
	
	
	
	var table = $('#example').dataTable({
		"order": [[ 0, "asc" ]],
		"language": {
			"emptyTable":     "No hay datos cargados",
			"info":           "Mostrar _START_ hasta _END_ del total de _TOTAL_ filas",
			"infoEmpty":      "Mostrar 0 hasta 0 del total de 0 filas",
			"infoFiltered":   "(filtrados del total de _MAX_ filas)",
			"infoPostFix":    "",
			"thousands":      ",",
			"lengthMenu":     "Mostrar _MENU_ filas",
			"loadingRecords": "Cargando...",
			"processing":     "Procesando...",
			"search":         "Buscar:",
			"zeroRecords":    "No se encontraron resultados",
			"paginate": {
				"first":      "Primero",
				"last":       "Ultimo",
				"next":       "Siguiente",
				"previous":   "Anterior"
			},
			"aria": {
				"sortAscending":  ": activate to sort column ascending",
				"sortDescending": ": activate to sort column descending"
			}
		  }
	} );
	
	
	$('#eliminarMasivo').click( function(){
      		url = "borrarMasivo.php";
			$(location).attr('href',url);
      });
	
	$("#lstContenedores").on("click",'.agregarContenedor', function(){
		$('#contenedorData').append('<div class="row" id="idC' + idContenedor + '" style="padding-bottom:10px; border-bottom:5px dashed #FF5733;"> \
						<div class="form-group col-md-4 col-xs-4" style="display:block"> \
							<label for="factura" class="control-label" style="text-align:left">Contenedor</label> \
							<div class="input-group col-md-12 col-xs-12"> \
								<input type="text" class="form-control datacontenedor" id="contenedor' + idContenedor + '" name="contenedor' + idContenedor + '" placeholder="Ingrese el Contenedor..." required=""> \
							</div> \
						</div> \
						<div class="form-group col-md-3 col-xs-4" style="display:block"> \
							<label for="factura" class="control-label" style="text-align:left">Tara</label> \
							<div class="input-group col-md-12 col-xs-12"> \
								<input type="text" class="form-control datatara" id="tara' + idContenedor + '" name="tara' + idContenedor + '" placeholder="Ingrese la Tara..." required=""> \
							</div> \
						</div> \
						<div class="form-group col-md-3 col-xs-4" style="display:block"> \
							<label for="factura" class="control-label" style="text-align:left">Precinto</label> \
							<div class="input-group col-md-12 col-xs-12"> \
								<input type="text" class="form-control datapreciento" id="precinto' + idContenedor + '" name="precinto' + idContenedor + '" placeholder="Ingrese el Precinto..." required=""> \
							</div> \
						</div> \
						<div class="form-group col-md-2 col-xs-4" style="display:block"> \
							<label for="factura" class="control-label" style="text-align:left">Acciones</label> \
							<div class="input-group col-md-12 col-xs-12"> \
								<input type="button" class="btn btn-danger eliminarContenedor" id="' + idContenedor + '" value="Eliminar"> \
								<input type="button" class="btn btn-success agregarMercaderia" id="' + idContenedor + '" value="Agregar Mercaderia"> \
							</div> \
						</div> \
						<div id="idI' + idContenedor + '"> \
						</div> \
						</div>');
		$('#tokenContenedor').val(idContenedor);
		idContenedor += 1;

		$('.datatara').each(function(intIndex){
			$(this).number( true, 2, '.','' );
			$(this).change( function() {
				if ($(this).val() < 0) {
					$(this).val(0);
				}
			});
		});
	});

	$(document).on("click",'.agregarMercaderia', function(){
		usersid =  $(this).attr("id");

		agregarItem(usersid, 'idI' + usersid);
		$('#tokenItem').val(idItems);
		idItems += 1;

		$('.databulto').each(function(intIndex){
			$(this).number( true, 0,'','');
			$(this).change( function() {
				if ($(this).val() < 0) {
					$(this).val(0);
				}
			});
		});

		$('.databruto').each(function(intIndex){
			$(this).number( true, 2, '.','' );
			$(this).change( function() {
				if ($(this).val() < 0) {
					$(this).val(0);
				}
			});
		});

		$('.dataneto').each(function(intIndex){
			$(this).number( true, 2, '.','' );
			$(this).change( function() {
				if ($(this).val() < 0) {
					$(this).val(0);
				}
			});
		});

		$('.datavalorunitario').each(function(intIndex){
			$(this).number( true, 2, '.','' );
			$(this).change( function() {
				if ($(this).val() < 0) {
					$(this).val(0);
				}
			});
		});
	});

	function agregarItem(id, contenedor) {
		$('#'+contenedor).append('<div class="row" style="margin-left:15px;" id="contenedorItems' + idItems + '"> \
						<div class="form-group col-md-1 col-xs-3" style="display:block"> \
							<label for="factura" class="control-label" style="text-align:left">Bulto</label> \
							<div class="input-group col-md-12 col-xs-12"> \
								<input type="text" class="form-control databulto" id="bulto' + id + idItems + '" name="bulto' + id + idItems + '" required=""> \
							</div> \
						</div> \
						<div class="form-group col-md-2 col-xs-3" style="display:block"> \
							<label for="factura" class="control-label" style="text-align:left">Bruto</label> \
							<div class="input-group col-md-12 col-xs-12"> \
								<input type="text" class="form-control databruto" id="bruto' + id + idItems + '" name="bruto' + id + idItems + '" required=""> \
							</div> \
						</div> \
						<div class="form-group col-md-2 col-xs-3" style="display:block"> \
							<label for="factura" class="control-label" style="text-align:left">Neto</label> \
							<div class="input-group col-md-12 col-xs-12"> \
								<input type="text" class="form-control dataneto" id="neto' + id + idItems + '" name="neto' + id + idItems + '" required=""> \
							</div> \
						</div> \
						<div class="form-group col-md-2 col-xs-3" style="display:block"> \
							<label for="factura" class="control-label" style="text-align:left">Marca</label> \
							<div class="input-group col-md-12 col-xs-12"> \
								<input type="text" class="form-control datamarca" id="marca' + id + idItems + '" name="marca' + id + idItems + '" required=""> \
							</div> \
						</div> \
						<div class="form-group col-md-3 col-xs-3" style="display:block"> \
							<label for="factura" class="control-label" style="text-align:left">Mercaderia</label> \
							<div class="input-group col-md-12 col-xs-12"> \
								<select class="form-control datamercaderia" id="refmercaderias' + id + idItems + '" name="refmercaderias' + id + idItems + '"> \
								<?php echo $cadMercaderia; ?> \
								</select> \
							</div> \
						</div> \
						<div class="form-group col-md-1 col-xs-3" style="display:block"> \
							<label for="factura" class="control-label" style="text-align:left">Valor Unit</label> \
							<div class="input-group col-md-12 col-xs-12"> \
								<input type="text" class="form-control datavalorunitario" id="valorunitario' + id + idItems + '" name="valorunitario' + id + idItems + '" required=""> \
							</div> \
						</div> \
						<div class="form-group col-md-1 col-xs-4" style="display:block"> \
							<label for="factura" class="control-label" style="text-align:left">Acciones</label> \
							<div class="input-group col-md-12 col-xs-12"> \
								<input type="button" class="btn btn-danger eliminarItem" id="' + idItems + '" value="X"> \
							</div> \
						</div></div>');
		
	}



	$("#example").on("click",'.varborrar', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			$("#idEliminar").val(usersid);
			$("#dialog2").dialog("open");

			
			//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
			//$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton eliminar


	$("#lstContenedores").on("click",'.eliminarContenedor', function(){

		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			$("#idC"+usersid).remove();

		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton eliminar

	$("#lstContenedores").on("click",'.eliminarItem', function(){

		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			$("#contenedorItems"+usersid).remove();

		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton eliminar
	
	$("#example").on("click",'.varmodificar', function(){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			
			url = "modificar.php?id=" + usersid;
			$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton modificar


	 $( "#dialog2" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:600,
				height:240,
				modal: true,
				buttons: {
				    "Eliminar": function() {
	
						$.ajax({
									data:  {id: $('#idEliminar').val(), accion: '<?php echo $eliminar; ?>'},
									url:   '../../ajax/ajax.php',
									type:  'post',
									beforeSend: function () {
											
									},
									success:  function (response) {
											url = "index.php";
											$(location).attr('href',url);
											
									}
							});
						$( this ).dialog( "close" );
						$( this ).dialog( "close" );
							$('html, body').animate({
	           					scrollTop: '1000px'
	       					},
	       					1500);
				    },
				    Cancelar: function() {
						$( this ).dialog( "close" );
				    }
				}
		 
		 
	 		}); //fin del dialogo para eliminar
			
	<?php 
		echo $serviciosHTML->validacion($tabla);
	
	?>
	

	
	
	//al enviar el formulario
    $('#cargar').click(function(){
		
		if (validador() == "")
        {
			//información del formulario
			var formData = new FormData($(".formulario")[0]);
			var message = "";
			//hacemos la petición ajax  
			$.ajax({
				url: '../../ajax/ajax.php',  
				type: 'POST',
				// Form data
				//datos del formulario
				data: formData,
				//necesario para subir archivos via ajax
				cache: false,
				contentType: false,
				processData: false,
				//mientras enviamos el archivo
				beforeSend: function(){
					$("#load").html('<img src="../../imagenes/load13.gif" width="50" height="50" />');       
				},
				//una vez finalizado correctamente
				success: function(data){

					if (data == '') {
                                            $(".alert").removeClass("alert-danger");
											$(".alert").removeClass("alert-info");
                                            $(".alert").addClass("alert-success");
                                            $(".alert").html('<strong>Ok!</strong> Se cargo exitosamente el <strong><?php echo $singular; ?></strong>. ');
											$(".alert").delay(3000).queue(function(){
												/*aca lo que quiero hacer 
												  después de los 2 segundos de retraso*/
												$(this).dequeue(); //continúo con el siguiente ítem en la cola
												
											});
											$("#load").html('');
											url = "index.php";
											$(location).attr('href',url);
                                            
											
                                        } else {
                                        	$(".alert").removeClass("alert-danger");
                                            $(".alert").addClass("alert-danger");
                                            $(".alert").html('<strong>Error!</strong> '+data);
                                            $("#load").html('');
                                        }
				},
				//si ha ocurrido un error
				error: function(){
					$(".alert").html('<strong>Error!</strong> Actualice la pagina');
                    $("#load").html('');
				}
			});
		}
    });

});
</script>

<script type="text/javascript">
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
</script>
<?php } ?>
</body>
</html>
