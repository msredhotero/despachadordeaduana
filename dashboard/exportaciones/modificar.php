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

$serviciosFunciones = new Servicios();
$serviciosUsuario 	= new ServiciosUsuarios();
$serviciosHTML 		= new ServiciosHTML();
$serviciosReferencias 	= new ServiciosReferencias();

$fecha = date('Y-m-d');

//$resProductos = $serviciosProductos->traerProductosLimite(6);
$resMenu = $serviciosHTML->menu(utf8_encode($_SESSION['nombre_predio']),"Exportaciones",$_SESSION['refroll_predio'],'');


$id = $_GET['id'];

$resResultado = $serviciosReferencias->traerExportacionesPorId($id);


/////////////////////// Opciones pagina ///////////////////////////////////////////////
$singular = "Exportacion";

$plural = "Exportaciones";

$eliminar = "eliminarExportaciones";

$modificar = "modificarExportaciones";

$idTabla = "idexportacion";

$tituloWeb = "Gestión: Despachante de Aduana";
//////////////////////// Fin opciones ////////////////////////////////////////////////


/////////////////////// Opciones para la creacion del formulario  /////////////////////
$tabla 			= "dbexportaciones";

$lblCambio	 	= array("refclientes","refbuques","refpuertos","refdestinos","refcolores",'permisoembarque');
$lblreemplazo	= array("Clientes","Buques","Puertos","Destinos","Canales",'Permiso de Embarque');


$resClientes 	= $serviciosReferencias->traerClientes();
$cadRef 	= $serviciosFunciones->devolverSelectBoxActivo($resClientes,array(1),'', mysql_result($resResultado,0,'refclientes'));

$resBuques 	= $serviciosReferencias->traerBuques();
$cadRef2 	= $serviciosFunciones->devolverSelectBoxActivo($resBuques,array(1),'', mysql_result($resResultado,0,'refbuques'));

$resPuertos 	= $serviciosReferencias->traerPuertos();
$cadRef3 	= $serviciosFunciones->devolverSelectBoxActivo($resPuertos,array(1),'', mysql_result($resResultado,0,'refpuertos'));


$resDestinos 	= $serviciosReferencias->traerDestinos();
$cadRef5 	= $serviciosFunciones->devolverSelectBoxActivo($resDestinos,array(1),'', mysql_result($resResultado,0,'refdestinos'));


$resColores 	= $serviciosReferencias->traerColores();
$cadRef6 	= $serviciosFunciones->devolverSelectBoxActivo($resColores,array(1),'', mysql_result($resResultado,0,'refcolores'));

//die(var_dump($cadRef3));
$refdescripcion = array(0 => $cadRef,1 => $cadRef2,2 => $cadRef3,3 => $cadRef5,4 => $cadRef6);
$refCampo 	=  array("refclientes","refbuques","refpuertos","refdestinos","refcolores");
//////////////////////////////////////////////  FIN de los opciones //////////////////////////


$formulario 	= $serviciosFunciones->camposTablaModificar($id, $idTabla, $modificar,$tabla,$lblCambio,$lblreemplazo,$refdescripcion,$refCampo);


/////////////////////// Opciones para la creacion del view  apellido,nombre,nrodocumento,fechanacimiento,direccion,telefono,email/////////////////////
$cabeceras 		= "	<th>Contenedor</th>
					<th>Tara</th>
					<th>Precinto</th>";

//////////////////////////////////////////////  FIN de los opciones //////////////////////////

$lstCargados 	= $serviciosFunciones->camposTablaView($cabeceras,$serviciosReferencias->traerExportacioncontenedoresPorExportacion($id),3);



/////////////////////// Opciones para la creacion del formulario  /////////////////////
$tabla2 			= "dbexportacioncontenedores";

$lblCambio2	 	= array("refexportaciones");
$lblreemplazo2	= array("Permiso de Embarque");


$resExportacion 	= $serviciosReferencias->traerExportacionesPorId($id);
$cadRef3 	= $serviciosFunciones->devolverSelectBoxActivo($resExportacion,array(6),'', $id);

$refdescripcion2 = array(0 => $cadRef3);
$refCampo2 	=  array("refexportaciones");

$formularioContenedor 	= $serviciosFunciones->camposTabla("insertarExportacioncontenedores" ,$tabla2,$lblCambio2,$lblreemplazo2,$refdescripcion2,$refCampo2);
//////////////////////////////////////////////  FIN de los opciones //////////////////////////

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
    <link rel="stylesheet" href="../../css/jquery-ui.css">

    <script src="../../js/jquery-ui.js"></script>
    
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css"/>
	171
    <!-- Latest compiled and minified JavaScript -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../../css/bootstrap-datetimepicker.min.css">
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

<h3><?php echo $plural; ?></h3>

    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Modificar <?php echo $singular; ?></p>
        	
        </div>
    	<div class="cuerpoBox">
        	<form class="form-inline formulario" role="form">
        	
			<div class="row">
			<?php echo $formulario; ?>

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
                        <button type="button" class="btn btn-warning" id="cargar" style="margin-left:0px;">Modificar</button>
                    </li>
                    <li>
                        <button type="button" class="btn btn-primary" id="agregar" style="margin-left:0px;" data-toggle="modal" data-target="#myModal3">Agregar Contenedor</button>
                    </li>
                    <li>
                        <button type="button" class="btn btn-danger borrar" id="<?php echo $id; ?>" style="margin-left:0px;">Eliminar</button>
                    </li>
                    <li>
                        <button type="button" class="btn btn-default volver" style="margin-left:0px;">Volver</button>
                    </li>
                </ul>
                </div>
            </div>
            </form>
    	</div>


    </div>
    

    <div class="boxInfoLargo">
        <div id="headBoxInfo">
        	<p style="color: #fff; font-size:18px; height:16px;">Contenedores Cargados</p>
        	
        </div>
    	<div class="cuerpoBox">
        	<?php echo $lstCargados; ?>
            
    	</div>
    </div>
    
   
</div>


</div>

<div id="dialog3" title="Eliminar <?php echo $singular; ?>">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar el <?php echo $singular; ?>?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>Si elimina la exportacion se perderan todos los datos de este</p>
        <input type="hidden" value="" id="idEliminar2" name="idEliminar">
</div>

<div id="dialog2" title="Eliminar Contenedor">
    	<p>
        	<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
            ¿Esta seguro que desea eliminar el contenedor?.<span id="proveedorEli"></span>
        </p>
        <p><strong>Importante: </strong>Si elimina el contenedor se perderan todos los datos de este y sus items</p>
        <input type="hidden" value="" id="idEliminar" name="idEliminar">
</div>

<!-- Modal -->
<div class="modal fade" id="myModal3" tabindex="1" style="z-index:500000;" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form class="form-inline formulario" role="form">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agrear Contenedor</h4>
      </div>
      <div class="modal-body">
        <?php echo $formularioContenedor; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="cargarContenedor">Agregar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script src="../../bootstrap/js/dataTables.bootstrap.js"></script>

<script src="../../js/bootstrap-datetimepicker.min.js"></script>
<script src="../../js/bootstrap-datetimepicker.es.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	

	
	$('.volver').click(function(event){
		 
		url = "index.php";
		$(location).attr('href',url);
	});//fin del boton modificar
	
	$('.borrar').click(function(event){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			$("#idEliminar2").val(usersid);
			$("#dialog3").dialog("open");

			
			//url = "../clienteseleccionado/index.php?idcliente=" + usersid;
			//$(location).attr('href',url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton eliminar


	$('.varborrar').click(function(event){
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

	 $( "#dialog3" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:600,
				height:240,
				modal: true,
				buttons: {
				    "Eliminar": function() {
	
						$.ajax({
									data:  {id: $('#idEliminar2').val(), accion: '<?php echo $eliminar; ?>'},
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



	 $( "#dialog2" ).dialog({
		 	
			    autoOpen: false,
			 	resizable: false,
				width:600,
				height:240,
				modal: true,
				buttons: {
				    "Eliminar": function() {
	
						$.ajax({
									data:  {id: $('#idEliminar').val(), accion: 'eliminarExportacioncontenedores'},
									url:   '../../ajax/ajax.php',
									type:  'post',
									beforeSend: function () {
											
									},
									success:  function (response) {
											url = "modificar.php?id=<?php echo $id; ?>";
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
		echo str_replace('url = "modificar.php?id=" + usersid;', 'url = "modificarcontenedor.php?id=" + usersid;', $serviciosHTML->validacion($tabla));
	
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
                                            $(".alert").html('<strong>Ok!</strong> Se modifico exitosamente el <strong><?php echo $singular; ?></strong>. ');
											$(".alert").delay(3000).queue(function(){
												/*aca lo que quiero hacer 
												  después de los 2 segundos de retraso*/
												$(this).dequeue(); //continúo con el siguiente ítem en la cola
												
											});
											$("#load").html('');
											//url = "index.php";
											//$(location).attr('href',url);
                                            
											
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


	//al enviar el formulario
    $('#cargarContenedor').click(function(){
		
			//información del formulario
			var formData = new FormData($(".formulario")[1]);
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
					
					if (!isNaN(data)) {
						$(".alert").removeClass("alert-danger");
						$(".alert").removeClass("alert-info");
						$(".alert").addClass("alert-success");
						$(".alert").html('<strong>Ok!</strong> Se cargo exitosamente el <strong>Contenedor</strong>. ');
						$(".alert").delay(3000).queue(function(){
							/*aca lo que quiero hacer 
							  después de los 2 segundos de retraso*/
							$(this).dequeue(); //continúo con el siguiente ítem en la cola
							
						});
						$("#load").html('');
						url = "modificar.php?id=<?php echo $id; ?>";
						$(location).attr('href',url);
						//alert('<option value="' + data.toString() + '">' + $('#reftipocontactos option:selected').text() + ', ' + $('#nombre1').val() + '</option>');

						
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
