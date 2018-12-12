<?php

session_start();

if (!isset($_SESSION['usua_predio']))
{
	header('Location: ../../error.php');
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
$resMenu = $serviciosHTML->menu($_SESSION['nombre_predio'],"Dashboard",$_SESSION['refroll_predio'],'');




/////////////////////// Opciones para la creacion del view  apellido,nombre,nrodocumento,fechanacimiento,direccion,telefono,email/////////////////////
$cabeceras 		= "	<th>ID</th>
					<th>Permiso Emb.</th>
					<th>Clientes</th>
					<th>Buques</th>
					<th>Puertos</th>
					<th>Destinos</th>
					<th>Colores</th>
					<th>Booking</th>
					<th>Fecha</th>
					<th>Fact.</th>";

//////////////////////////////////////////////  FIN de los opciones //////////////////////////


$lstCargados 	= $serviciosFunciones->camposTablaView($cabeceras,$serviciosReferencias->traerExportacionesGridNuevo(),10);


/////////////////////// Opciones para la creacion del formulario  /////////////////////

/////////////////////// Opciones para la creacion del view  

?>

<!DOCTYPE HTML>
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">



<title>Gesti&oacute;n: Despachante de Aduana</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link href="../../css/estiloDash.css" rel="stylesheet" type="text/css">
    

    
    <script type="text/javascript" src="../../js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" href="../../css/jquery-ui.css">

    <script src="../../js/jquery-ui.js"></script>
    
	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css"/>
	<!--<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>-->
    <!-- Latest compiled and minified JavaScript -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../../css/chosen.css">


   
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
    

	<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css" rel="stylesheet">
</head>

<body>

 
<?php echo $resMenu; ?>

<div id="content">
	
    
    

    <form class="form-inline">
    <div class="row" style="margin-right:15px;margin-top:25px;">
    <div class="col-md-12">
    <div class="panel" style="border-color:#006666;">
				<div class="panel-heading" style="background-color:#006666; color:#FFF; ">
					<h3 class="panel-title">Exportaciones Sin Facturar</h3>
					<span class="pull-right clickable panel-collapsed" style="margin-top:-15px; cursor:pointer;"><i class="glyphicon glyphicon-chevron-down"></i></span>
				</div>
                <div class="panel-body collapse">
                	<div class="row">
                		<div class="col-md-12">
                			<div class="alert"></div>
                		</div>
                	</div>
                	<div class="row">
                		<div class="col-md-2"></div>
                		<div class="col-md-4" align="right">
							<div class="form-group">
								<label for="email">Nro Factura:</label>
								<input type="text" class="form-control" name="factura" id="factura" />
							</div>
                			
                		</div>
                		<div class="col-md-4" align="left">
                			<div class="form-group">
                				<button type="button" class="btn btn-success" id="asignarContacto"><span class="glyphicon glyphicon-share-alt"></span> Asinar Nro de Factura</button>
                			</div>
                		</div>
                		<div class="col-md-2"></div>
                		
                	</div>
            		<?php echo str_replace('table-striped','', $lstCargados); ?>
								
				</div>
            </div>
    
    </div>
    </div>
    </form>
    
    
   
</div>


</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="1" style="z-index:500000;" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width:90%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detalle de Venta</h4>
      </div>
      <div class="modal-body detalleVentas">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script src="../../bootstrap/js/dataTables.bootstrap.js"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>


<script type="text/javascript">
$(document).ready(function(){

	var permisos = [];

	$('.alert').hide();
	
	$(document).on('click', '.panel-heading span.clickable', function(e){
		var $this = $(this);
		if(!$this.hasClass('panel-collapsed')) {
			$this.parents('.panel').find('.panel-body').slideUp();
			$this.addClass('panel-collapsed');
			$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
		} else {
			$this.parents('.panel').find('.panel-body').slideDown();
			$this.removeClass('panel-collapsed');
			$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
		}
	});

	$('.panel-heading span.clickable').click();
	
	var table = $('#example').DataTable({
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
		  },
		select: {
        	style: 'multi'
        }
	});

	function cargarFactura(nroFactura, permisos) {
		$.ajax({
			data:  {nrofactura: nroFactura, 
					permisos: (permisos == '' ? '' : permisos),
					accion: 'cargarFacturasMasivas'
			},
			url:   '../../ajax/ajax.php',
			type:  'post',
			beforeSend: function () {
				$('.alert').hide();
			},
			success:  function (response) {

				if (response == '') {
					$('.alert').show();
					$(".alert").removeClass("alert-danger");
                    $(".alert").addClass("alert-success");
                    $(".alert").html('<strong>Ok!</strong> Se cargo exitosamente la Factura</strong>. ');
					url = "index.php";
					setInterval(function() {
		                $(location).attr('href',url);
		            },3000);
				} else {
					$('.alert').show();
					$(".alert").removeClass("alert-danger");
                    $(".alert").addClass("alert-danger");
                    $(".alert").html('<strong>Error!</strong> '+response);
				}
				
				
				
			}
		});
	}


	$('#asignarContacto').click(function() {
		//console.log( table.rows('.selected').data()[0][0] );
		permisos = [];
		
		var ar = table.rows('.selected').data();
		var fila = '';
		for (var i = 0; i < ar.length; i+=1) {
		  //console.log("En el índice '" + i + "' hay este valor: " + ar[i]);
		  fila = ar[i][0];
		  permisos.push(fila.replace('<div style="height:60px;overflow:auto;">','').replace('</div>',''));
		  //console.log( fila.replace('<div style="height:60px;overflow:auto;">','').replace('</div>',''));
		}

		cargarFactura($('#factura').val(), Array.from(permisos).toString() );

		
	});

	
    

    table.on( 'select', function ( e, dt, type, indexes ) {
	    if ( type === 'row' ) {
	        var data = table.rows( indexes ).data().pluck( 'id' );
	 
	        // do something with the ID of the selected items
	    }
	});



	
	



});
</script>

<?php } ?>
</body>
</html>
