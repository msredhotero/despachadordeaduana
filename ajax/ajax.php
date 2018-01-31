<?php

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');


$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosReferencias		= new ServiciosReferencias();


$accion = $_POST['accion'];


switch ($accion) {
    case 'login':
        enviarMail($serviciosUsuarios);
        break;
	case 'entrar':
		entrar($serviciosUsuarios);
		break;
	case 'insertarUsuario':
        insertarUsuario($serviciosUsuarios);
        break;
	case 'modificarUsuario':
        modificarUsuario($serviciosUsuarios);
        break;
	case 'registrar':
		registrar($serviciosUsuarios);
        break;
	case 'recuperar':
		recuperar($serviciosUsuarios);
		break;


/* PARA Roles */

case 'insertarClientes':
insertarClientes($serviciosReferencias);
break;
case 'modificarClientes':
modificarClientes($serviciosReferencias);
break;
case 'eliminarClientes':
eliminarClientes($serviciosReferencias);
break;
case 'insertarExportacioncontenedores':
insertarExportacioncontenedores($serviciosReferencias);
break;
case 'modificarExportacioncontenedores':
modificarExportacioncontenedores($serviciosReferencias);
break;
case 'eliminarExportacioncontenedores':
eliminarExportacioncontenedores($serviciosReferencias);
break;

case 'eliminarExportacionContenedoresDetallesPorExportacion':
	eliminarExportacionContenedoresDetallesPorExportacion($serviciosReferencias);
	break;

case 'insertarExportaciondetalles':
insertarExportaciondetalles($serviciosReferencias);
break;
case 'modificarExportaciondetalles':
modificarExportaciondetalles($serviciosReferencias);
break;
case 'eliminarExportaciondetalles':
eliminarExportaciondetalles($serviciosReferencias);
break;
case 'insertarExportaciones':
insertarExportaciones($serviciosReferencias);
break;
case 'modificarExportaciones':
modificarExportaciones($serviciosReferencias);
break;
case 'eliminarExportaciones':
eliminarExportaciones($serviciosReferencias);
break;
case 'insertarUsuarios':
insertarUsuarios($serviciosReferencias);
break;
case 'modificarUsuarios':
modificarUsuarios($serviciosReferencias);
break;
case 'eliminarUsuarios':
eliminarUsuarios($serviciosReferencias);
break;
case 'insertarPredio_menu':
insertarPredio_menu($serviciosReferencias);
break;
case 'modificarPredio_menu':
modificarPredio_menu($serviciosReferencias);
break;
case 'eliminarPredio_menu':
eliminarPredio_menu($serviciosReferencias);
break;
case 'insertarBuques':
insertarBuques($serviciosReferencias);
break;
case 'modificarBuques':
modificarBuques($serviciosReferencias);
break;
case 'eliminarBuques':
eliminarBuques($serviciosReferencias);
break;
case 'insertarColores':
insertarColores($serviciosReferencias);
break;
case 'modificarColores':
modificarColores($serviciosReferencias);
break;
case 'eliminarColores':
eliminarColores($serviciosReferencias);
break;
case 'insertarDestinos':
insertarDestinos($serviciosReferencias);
break;
case 'modificarDestinos':
modificarDestinos($serviciosReferencias);
break;
case 'eliminarDestinos':
eliminarDestinos($serviciosReferencias);
break;
case 'insertarMercaderias':
insertarMercaderias($serviciosReferencias);
break;
case 'modificarMercaderias':
modificarMercaderias($serviciosReferencias);
break;
case 'eliminarMercaderias':
eliminarMercaderias($serviciosReferencias);
break;
case 'insertarPuertos':
insertarPuertos($serviciosReferencias);
break;
case 'modificarPuertos':
modificarPuertos($serviciosReferencias);
break;
case 'eliminarPuertos':
eliminarPuertos($serviciosReferencias);
break;
case 'insertarRoles':
insertarRoles($serviciosReferencias);
break;
case 'modificarRoles':
modificarRoles($serviciosReferencias);
break;
case 'eliminarRoles':
eliminarRoles($serviciosReferencias);
break;

case 'insertarConfiguracion':
insertarConfiguracion($serviciosReferencias);
break;
case 'modificarConfiguracion':
modificarConfiguracion($serviciosReferencias);
break;
case 'eliminarConfiguracion':
eliminarConfiguracion($serviciosReferencias);
break; 


case 'insertarAgencias':
insertarAgencias($serviciosReferencias);
break;
case 'modificarAgencias':
modificarAgencias($serviciosReferencias);
break;
case 'eliminarAgencias':
eliminarAgencias($serviciosReferencias);
break; 

case 'insertarReferentes':
insertarReferentes($serviciosReferencias);
break;
case 'modificarReferentes':
modificarReferentes($serviciosReferencias);
break;
case 'eliminarReferentes':
eliminarReferentes($serviciosReferencias);
break; 

case 'traerPuertosPorDestino':
	traerPuertosPorDestino($serviciosReferencias, $serviciosFunciones);
	break;
case 'traerGastosPorCliente':
	traerGastosPorCliente($serviciosReferencias, $serviciosFunciones);
	break;
case 'traerHonorariosPorCliente':
	traerHonorariosPorCliente($serviciosReferencias, $serviciosFunciones);
	break;
case 'traerHonorariosMinimosPorCliente':
	traerHonorariosMinimosPorCliente($serviciosReferencias, $serviciosFunciones);
	break;
/* Fin */
////////////////////////////////*****    FIN   *******/////////////////////////////////////

}

/* Fin */

function traerPuertosPorDestino($serviciosReferencias, $serviciosFunciones) {
	$iddestino = $_POST['id'];

	$res = $serviciosReferencias->traerPuertosPorDestino($iddestino);

	$cadRef = $serviciosFunciones->devolverSelectBoxObligatorio($res,array(1),'');

	echo $cadRef;

}

function traerGastosPorCliente($serviciosReferencias, $serviciosFunciones) {
	$idcliente = $_POST['id'];

	$res = $serviciosReferencias->traerClientesPorId($idcliente);

	if (mysql_num_rows($res)>0) {
		echo mysql_result($res, 0,'gastos');
	} else {
		echo 0;
	}

}

function traerHonorariosPorCliente($serviciosReferencias, $serviciosFunciones) {
	$idcliente = $_POST['id'];

	$res = $serviciosReferencias->traerClientesPorId($idcliente);

	if (mysql_num_rows($res)>0) {
		echo mysql_result($res, 0,'honorarios');
	} else {
		echo 0;
	}

}

function traerHonorariosMinimosPorCliente($serviciosReferencias, $serviciosFunciones) {
	$idcliente = $_POST['id'];

	$res = $serviciosReferencias->traerClientesPorId($idcliente);

	if (mysql_num_rows($res)>0) {
		echo mysql_result($res, 0,'minhonorarios');
	} else {
		echo 0;
	}

}


function insertarReferentes($serviciosReferencias) {
$email = $_POST['email'];
$razonsocial = $_POST['razonsocial'];
$res = $serviciosReferencias->insertarReferentes($email,$razonsocial);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarReferentes($serviciosReferencias) {
$id = $_POST['id'];
$email = $_POST['email'];
$razonsocial = $_POST['razonsocial'];
$res = $serviciosReferencias->modificarReferentes($id,$email,$razonsocial);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarReferentes($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarReferentes($id);
echo $res;
} 

/* PARA Roles */


function insertarAgencias($serviciosReferencias) {
	$agencia = $_POST['agencia'];
	$email = $_POST['email'];
	
	$res = $serviciosReferencias->insertarAgencias($agencia,$email);
	
	if ((integer)$res > 0) {
		$resUser = $serviciosReferencias->traerReferentes();
		$cad = 'user';
		while ($rowFS = mysql_fetch_array($resUser)) {
			if (isset($_POST[$cad.$rowFS[0]])) {
				$serviciosReferencias->insertarAgenciareferentes($res,$rowFS[0]);
			}
		}
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}

function modificarAgencias($serviciosReferencias) {
	$id = $_POST['id'];
	$agencia = $_POST['agencia'];
	$email = $_POST['email'];
	
	$res = $serviciosReferencias->modificarAgencias($id,$agencia,$email);
	
	if ($res == true) {
		$serviciosReferencias->eliminarAgenciareferentesPorAgentes($id);
		$resUser = $serviciosReferencias->traerReferentes();
		$cad = 'user';
		while ($rowFS = mysql_fetch_array($resUser)) {
			if (isset($_POST[$cad.$rowFS[0]])) {
				$serviciosReferencias->insertarAgenciareferentes($id,$rowFS[0]);
			}
		}
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}


function eliminarAgencias($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarAgencias($id);
echo $res;
} 


function insertarConfiguracion($serviciosReferencias) {
	$serviciosReferencias->eliminarConfiguracion();

	$razonsocial = $_POST['razonsocial'];
	$cuit = $_POST['cuit'];
	
	$res = $serviciosReferencias->insertarConfiguracion($razonsocial,$cuit);
	
	if ((integer)$res > 0) {
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}


function modificarConfiguracion($serviciosReferencias) {
$id = $_POST['id'];
$razonsocial = $_POST['razonsocial'];
$cuit = $_POST['cuit'];

$res = $serviciosReferencias->modificarConfiguracion($id,$razonsocial,$cuit);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarConfiguracion($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarConfiguracion();
echo $res;
} 



function insertarClientes($serviciosReferencias) {
	$razonsocial = $_POST['razonsocial'];
	$cuit = $_POST['cuit'];
	$honorarios = $_POST['honorarios'];
	$minhonorarios = $_POST['minhonorarios'];
	$gastos = $_POST['gastos'];
	$email = $_POST['email'];
	
	$res = $serviciosReferencias->insertarClientes($razonsocial,$cuit,$honorarios,$minhonorarios,$gastos,$email);
	
	if ((integer)$res > 0) {
		$resUser = $serviciosReferencias->traerReferentes();
		$cad = 'user';
		while ($rowFS = mysql_fetch_array($resUser)) {
			if (isset($_POST[$cad.$rowFS[0]])) {
				$serviciosReferencias->insertarClientereferentes($res,$rowFS[0]);
			}
		}
		echo '';
	} else {
		echo 'Huvo un error al insertar datos';
	}
}

function modificarClientes($serviciosReferencias) {
	$id = $_POST['id'];
	$razonsocial = $_POST['razonsocial'];
	$cuit = $_POST['cuit'];
	$honorarios = $_POST['honorarios'];
	$minhonorarios = $_POST['minhonorarios'];
	$gastos = $_POST['gastos'];
	$email = $_POST['email'];
	
	$res = $serviciosReferencias->modificarClientes($id,$razonsocial,$cuit,$honorarios,$minhonorarios,$gastos,$email);
	
	if ($res == true) {
		$serviciosReferencias->eliminarClientereferentesPorCliente($id);
		$resUser = $serviciosReferencias->traerReferentes();
		$cad = 'user';
		while ($rowFS = mysql_fetch_array($resUser)) {
			if (isset($_POST[$cad.$rowFS[0]])) {
				$serviciosReferencias->insertarClientereferentes($id,$rowFS[0]);
			}
		}
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}


function eliminarClientes($serviciosReferencias) {
	$id = $_POST['id'];
	$res = $serviciosReferencias->eliminarClientes($id);
	echo $res;
} 



function insertarExportacioncontenedores($serviciosReferencias) {
$refexportaciones = $_POST['refexportaciones'];
$contenedor = $_POST['contenedor'];
$tara = $_POST['tara'];
$precinto = $_POST['precinto'];
$res = $serviciosReferencias->insertarExportacioncontenedores($refexportaciones,$contenedor,$tara,$precinto);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarExportacioncontenedores($serviciosReferencias) {
$id = $_POST['id'];
$refexportaciones = $_POST['refexportaciones'];
$contenedor = $_POST['contenedor'];
$tara = $_POST['tara'];
$precinto = $_POST['precinto'];
$res = $serviciosReferencias->modificarExportacioncontenedores($id,$refexportaciones,$contenedor,$tara,$precinto);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarExportacioncontenedores($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarExportacionContenedoresDetallesPorContenedor($id);
echo $res;
}

function eliminarExportacionContenedoresDetallesPorExportacion($serviciosReferencias) {
	$id = $_POST['id'];
	
	$res = $serviciosReferencias->eliminarExportacionContenedoresDetallesPorExportacion($id);
	
	echo $res;
	
}

function insertarExportaciondetalles($serviciosReferencias) {
$refexportacioncontenedores = $_POST['refexportacioncontenedores'];

$bulto = $_POST['bulto'];
$bruto = $_POST['bruto'];
$neto = $_POST['neto'];
$marca = $_POST['marca'];
$refmercaderias = $_POST['refmercaderias'];
$valorunitario = $_POST['valorunitario'];
$res = $serviciosReferencias->insertarExportaciondetalles($refexportacioncontenedores,$bulto,$bruto,$neto,$marca,$refmercaderias,$valorunitario);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarExportaciondetalles($serviciosReferencias) {
$id = $_POST['id'];
$refexportacioncontenedores = $_POST['refexportacioncontenedores'];

$bulto = $_POST['bulto'];
$bruto = $_POST['bruto'];
$neto = $_POST['neto'];
$marca = $_POST['marca'];
$refmercaderias = $_POST['refmercaderias'];
$valorunitario = $_POST['valorunitario'];
$res = $serviciosReferencias->modificarExportaciondetalles($id,$refexportacioncontenedores,$bulto,$bruto,$neto,$marca,$refmercaderias,$valorunitario);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarExportaciondetalles($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarExportaciondetalles($id);
echo $res;
}

function insertarExportaciones($serviciosReferencias) {
	$refclientes = $_POST['refclientes'];
	$refbuques = $_POST['refbuques'];
	$refcolores = $_POST['refcolores'];
	$refdestinos = $_POST['refdestinos'];
	$refpuertos = $_POST['refpuertos'];
	$refagencias = $_POST['refagencias'];
	$permisoembarque = $_POST['permisoembarque'];
	$booking = $_POST['booking'];
	$despachante = $_POST['despachante'];
	$cuit = $_POST['cuit'];
	$fecha = $_POST['fecha'];
	$factura = $_POST['factura'];
	$tc = $_POST['tc'];
	$gastos = $_POST['gastosaux'];
	$honorarios = $_POST['honorariosaux'];
	$honorarios = $_POST['minhonorariosaux'];

	$clientes = $serviciosReferencias->traerClientesPorId($refclientes);
	$valorunitario = mysql_result($clientes,0,'valorunitario');

	$lstContenedores = $_POST['tokenContenedor'];
	$lstItems = $_POST['tokenItem'];

	
	$res = $serviciosReferencias->insertarExportaciones($refclientes,$refbuques,$refcolores,$refdestinos,$refpuertos,$permisoembarque,$booking,$despachante,$cuit,$fecha,$factura,$tc,$valorunitario,$refagencias,$gastos, $honorarios, $minhonorarios);
	
	if ((integer)$res > 0) {
		for ($i=1; $i <=$lstContenedores ; $i++) {
			if (isset($_POST['contenedor'.$i])) {
				$contenedor = $_POST['contenedor'.$i];
				$tara = $_POST['tara'.$i];
				$precinto = $_POST['precinto'.$i];

				$resContenedor = $serviciosReferencias->insertarExportacioncontenedores($res, $contenedor,$tara,$precinto);

				for ($k=0; $k <= $lstItems ; $k++) { 
					if (isset($_POST['bulto'.$i.$k])) {
						$bulto = $_POST['bulto'.$i.$k];
						$bruto = $_POST['bruto'.$i.$k];
						$neto = $_POST['neto'.$i.$k];
						$marca = $_POST['marca'.$i.$k];
						$refmercaderias = $_POST['refmercaderias'.$i.$k];
						$valorunitario = $_POST['valorunitario'.$i.$k];

						$serviciosReferencias->insertarExportaciondetalles($resContenedor,$bulto,$bruto,$neto,$marca,$refmercaderias,$valorunitario);
					}
				}


			}
		}

		echo '';
	} else {
		echo 'Huvo un error al insertar datos: '.$res;
	}
}

function modificarExportaciones($serviciosReferencias) {
	$id = $_POST['id'];
	$refclientes = $_POST['refclientes'];
	$refbuques = $_POST['refbuques'];
	$refcolores = $_POST['refcolores'];
	$refdestinos = $_POST['refdestinos'];
	$refpuertos = $_POST['refpuertos'];
	$refagencias = $_POST['refagencias'];
	$permisoembarque = $_POST['permisoembarque'];
	$booking = $_POST['booking'];
	$despachante = $_POST['despachante'];
	$cuit = $_POST['cuit'];
	$fecha = $_POST['fecha'];
	$factura = $_POST['factura'];
	$tc = $_POST['tc'];
	$gastos = $_POST['gastos'];
	$honorarios = $_POST['honorarios'];
	$valorunit = $_POST['valorunit'];
	$honorarios = $_POST['minhonorariosaux'];

	$res = $serviciosReferencias->modificarExportaciones($id,$refclientes,$refbuques,$refcolores,$refdestinos,$refpuertos,$permisoembarque,$booking,$despachante,$cuit,$fecha,$factura,$tc,$valorunit,$refagencias,$gastos, $honorarios, $minhonorarios);

	if ($res == true) {
		echo '';
	} else {
		echo 'Huvo un error al modificar datos';
	}
}

function eliminarExportaciones($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarExportaciones($id);
echo $res;
}
function insertarUsuarios($serviciosReferencias) {
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$refroles = $_POST['refroles'];
$email = $_POST['email'];
$nombrecompleto = $_POST['nombrecompleto'];
$res = $serviciosReferencias->insertarUsuarios($usuario,$password,$refroles,$email,$nombrecompleto);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarUsuarios($serviciosReferencias) {
$id = $_POST['id'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$refroles = $_POST['refroles'];
$email = $_POST['email'];
$nombrecompleto = $_POST['nombrecompleto'];
$res = $serviciosReferencias->modificarUsuarios($id,$usuario,$password,$refroles,$email,$nombrecompleto);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarUsuarios($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarUsuarios($id);
echo $res;
}
function insertarPredio_menu($serviciosReferencias) {
$url = $_POST['url'];
$icono = $_POST['icono'];
$nombre = $_POST['nombre'];
$Orden = $_POST['Orden'];
$hover = $_POST['hover'];
$permiso = $_POST['permiso'];
$res = $serviciosReferencias->insertarPredio_menu($url,$icono,$nombre,$Orden,$hover,$permiso);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarPredio_menu($serviciosReferencias) {
$id = $_POST['id'];
$url = $_POST['url'];
$icono = $_POST['icono'];
$nombre = $_POST['nombre'];
$Orden = $_POST['Orden'];
$hover = $_POST['hover'];
$permiso = $_POST['permiso'];
$res = $serviciosReferencias->modificarPredio_menu($id,$url,$icono,$nombre,$Orden,$hover,$permiso);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarPredio_menu($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarPredio_menu($id);
echo $res;
}
function insertarBuques($serviciosReferencias) {
$nombre = $_POST['nombre'];
$res = $serviciosReferencias->insertarBuques($nombre);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarBuques($serviciosReferencias) {
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$res = $serviciosReferencias->modificarBuques($id,$nombre);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarBuques($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarBuques($id);
echo $res;
}
function insertarColores($serviciosReferencias) {
$color = $_POST['color'];
$res = $serviciosReferencias->insertarColores($color);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarColores($serviciosReferencias) {
$id = $_POST['id'];
$color = $_POST['color'];
$res = $serviciosReferencias->modificarColores($id,$color);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarColores($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarColores($id);
echo $res;
}
function insertarDestinos($serviciosReferencias) {
$destino = $_POST['destino'];
$res = $serviciosReferencias->insertarDestinos($destino);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarDestinos($serviciosReferencias) {
$id = $_POST['id'];
$destino = $_POST['destino'];
$res = $serviciosReferencias->modificarDestinos($id,$destino);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarDestinos($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarDestinos($id);
echo $res;
}
function insertarMercaderias($serviciosReferencias) {
$nombre = $_POST['nombre'];
$res = $serviciosReferencias->insertarMercaderias($nombre);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarMercaderias($serviciosReferencias) {
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$res = $serviciosReferencias->modificarMercaderias($id,$nombre);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarMercaderias($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarMercaderias($id);
echo $res;
}


function insertarPuertos($serviciosReferencias) {
$puerto = $_POST['puerto'];
$bandera = $_POST['bandera'];
$refdestinos = $_POST['refdestinos'];
$res = $serviciosReferencias->insertarPuertos($puerto,$bandera,$refdestinos);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarPuertos($serviciosReferencias) {
$id = $_POST['id'];
$puerto = $_POST['puerto'];
$bandera = $_POST['bandera'];
$refdestinos = $_POST['refdestinos'];
$res = $serviciosReferencias->modificarPuertos($id,$puerto,$bandera,$refdestinos);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarPuertos($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarPuertos($id);
echo $res;
} 


function insertarRoles($serviciosReferencias) {
$descripcion = $_POST['descripcion'];
if (isset($_POST['activo'])) {
$activo = 1;
} else {
$activo = 0;
}
$res = $serviciosReferencias->insertarRoles($descripcion,$activo);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarRoles($serviciosReferencias) {
$id = $_POST['id'];
$descripcion = $_POST['descripcion'];
if (isset($_POST['activo'])) {
$activo = 1;
} else {
$activo = 0;
}
$res = $serviciosReferencias->modificarRoles($id,$descripcion,$activo);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarRoles($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarRoles($id);
echo $res;
} 
////////////////////////// FIN DE TRAER DATOS ////////////////////////////////////////////////////////////

//////////////////////////  BASICO  /////////////////////////////////////////////////////////////////////////

function toArray($query)
{
    $res = array();
    while ($row = @mysql_fetch_array($query)) {
        $res[] = $row;
    }
    return $res;
}


function entrar($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	echo $serviciosUsuarios->loginUsuario($email,$pass);
}


function cambiarSede($serviciosUsuarios) {
	$sede		=	$_POST['sede'];

	echo $serviciosUsuarios->cambiarSede($sede);
}


function registrar($serviciosUsuarios) {
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroll'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	$res = $serviciosUsuarios->insertarUsuario($usuario,$password,$refroll,$email,$nombre);
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}

function recuperar($serviciosUsuarios) {
	$email		=		$_POST['email'];
	
	$res		=	$serviciosUsuarios->recuperar($email);
	
	echo $res;
}


function insertarUsuario($serviciosUsuarios) {
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroles'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	$sedes				=	$_POST['refsedes'];
	$refpersonal		=	$_POST['refpersonal'];
	
	$res = $serviciosUsuarios->insertarUsuario($usuario,$password,$refroll,$email,$nombre,$sedes,$refpersonal);
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}


function modificarUsuario($serviciosUsuarios) {
	$id					=	$_POST['id'];
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroles'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	$sedes				=	$_POST['refsedes'];
	$refpersonal		=	$_POST['refpersonal'];
	
	echo $serviciosUsuarios->modificarUsuario($id,$usuario,$password,$refroll,$email,$nombre,$sedes,$refpersonal);
}


function enviarMail($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	
	echo $serviciosUsuarios->login($email,$pass);
}


function devolverImagen($nroInput) {
	
	if( $_FILES['archivo'.$nroInput]['name'] != null && $_FILES['archivo'.$nroInput]['size'] > 0 ){
	// Nivel de errores
	  error_reporting(E_ALL);
	  $altura = 100;
	  // Constantes
	  # Altura de el thumbnail en píxeles
	  //define("ALTURA", 100);
	  # Nombre del archivo temporal del thumbnail
	  //define("NAMETHUMB", "/tmp/thumbtemp"); //Esto en servidores Linux, en Windows podría ser:
	  //define("NAMETHUMB", "c:/windows/temp/thumbtemp"); //y te olvidas de los problemas de permisos
	  $NAMETHUMB = "c:/windows/temp/thumbtemp";
	  # Servidor de base de datos
	  //define("DBHOST", "localhost");
	  # nombre de la base de datos
	  //define("DBNAME", "portalinmobiliario");
	  # Usuario de base de datos
	  //define("DBUSER", "root");
	  # Password de base de datos
	  //define("DBPASSWORD", "");
	  // Mime types permitidos
	  $mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png");
	  // Variables de la foto
	  $name = $_FILES["archivo".$nroInput]["name"];
	  $type = $_FILES["archivo".$nroInput]["type"];
	  $tmp_name = $_FILES["archivo".$nroInput]["tmp_name"];
	  $size = $_FILES["archivo".$nroInput]["size"];
	  // Verificamos si el archivo es una imagen válida
	  if(!in_array($type, $mimetypes))
		die("El archivo que subiste no es una imagen válida");
	  // Creando el thumbnail
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  $img = imagecreatefromjpeg($tmp_name);
		  break;
		case $mimetypes[2]:
		  $img = imagecreatefromgif($tmp_name);
		  break;
		case $mimetypes[3]:
		  $img = imagecreatefrompng($tmp_name);
		  break;
	  }
	  
	  $datos = getimagesize($tmp_name);
	  
	  $ratio = ($datos[1]/$altura);
	  $ancho = round($datos[0]/$ratio);
	  $thumb = imagecreatetruecolor($ancho, $altura);
	  imagecopyresized($thumb, $img, 0, 0, 0, 0, $ancho, $altura, $datos[0], $datos[1]);
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  imagejpeg($thumb, $NAMETHUMB);
			  break;
		case $mimetypes[2]:
		  imagegif($thumb, $NAMETHUMB);
		  break;
		case $mimetypes[3]:
		  imagepng($thumb, $NAMETHUMB);
		  break;
	  }
	  // Extrae los contenidos de las fotos
	  # contenido de la foto original
	  $fp = fopen($tmp_name, "rb");
	  $tfoto = fread($fp, filesize($tmp_name));
	  $tfoto = addslashes($tfoto);
	  fclose($fp);
	  # contenido del thumbnail
	  $fp = fopen($NAMETHUMB, "rb");
	  $tthumb = fread($fp, filesize($NAMETHUMB));
	  $tthumb = addslashes($tthumb);
	  fclose($fp);
	  // Borra archivos temporales si es que existen
	  //@unlink($tmp_name);
	  //@unlink(NAMETHUMB);
	} else {
		$tfoto = '';
		$type = '';
	}
	$tfoto = utf8_decode($tfoto);
	return array('tfoto' => $tfoto, 'type' => $type);	
}


?>