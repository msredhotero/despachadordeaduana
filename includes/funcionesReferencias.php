<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosReferencias {

function calculoBasePorExportacion($idPedidoEmbarque) {
	
}





function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}


///**********  PARA SUBIR ARCHIVOS  ***********************//////////////////////////
	function borrarDirecctorio($dir) {
		array_map('unlink', glob($dir."/*.*"));	
	
	}
	
	function borrarArchivo($id,$archivo) {
		$sql	=	"delete from images where idfoto =".$id;
		
		$res =  unlink("./../archivos/".$archivo);
		if ($res)
		{
			$this->query($sql,0);	
		}
		return $res;
	}
	
	
	function existeArchivo($id,$nombre,$type) {
		$sql		=	"select * from images where refproyecto =".$id." and imagen = '".$nombre."' and type = '".$type."'";
		$resultado  =   $this->query($sql,0);
			   
			   if(mysql_num_rows($resultado)>0){
	
				   return mysql_result($resultado,0,0);
	
			   }
	
			   return 0;	
	}
	
	function sanear_string($string)
{
 
    $string = trim($string);
 
    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );
 
    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );
 
    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );
 
    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );
 
    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );
 
    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $string
    );
 
 
 
    return $string;
}

function crearDirectorioPrincipal($dir) {
	if (!file_exists($dir)) {
		mkdir($dir, 0777);
	}
}

	function subirArchivo($file,$carpeta,$id) {
		
		
		
		$dir_destino = '../archivos/'.$carpeta.'/'.$id.'/';
		$imagen_subida = $dir_destino . $this->sanear_string(str_replace(' ','',basename($_FILES[$file]['name'])));
		
		$noentrar = '../imagenes/index.php';
		$nuevo_noentrar = '../archivos/'.$carpeta.'/'.$id.'/'.'index.php';
		
		if (!file_exists($dir_destino)) {
			mkdir($dir_destino, 0777);
		}
		
		 
		if(!is_writable($dir_destino)){
			
			echo "no tiene permisos";
			
		}	else	{
			if ($_FILES[$file]['tmp_name'] != '') {
				if(is_uploaded_file($_FILES[$file]['tmp_name'])){
					//la carpeta de libros solo los piso
					if ($carpeta == 'galeria') {
						$this->eliminarFotoPorObjeto($id);
					}
					/*echo "Archivo ". $_FILES['foto']['name'] ." subido con éxtio.\n";
					echo "Mostrar contenido\n";
					echo $imagen_subida;*/
					if (move_uploaded_file($_FILES[$file]['tmp_name'], $imagen_subida)) {
						
						$archivo = $this->sanear_string($_FILES[$file]["name"]);
						$tipoarchivo = $_FILES[$file]["type"];
						
						if ($carpeta == 'galeria') {
							if ($this->existeArchivo($id,$archivo,$tipoarchivo) == 0) {
								$sql	=	"insert into images(idfoto,refproyecto,imagen,type) values ('',".$id.",'".str_replace(' ','',$archivo)."','".$tipoarchivo."')";
								$this->query($sql,1);
							}
						} else {
							$sql = "update dblibros set ruta = '".$dir_destino.$archivo."'";
							$this->query($sql,0);	
						}
						echo "";
						
						copy($noentrar, $nuevo_noentrar);
		
					} else {
						echo "Posible ataque de carga de archivos!\n";
					}
				}else{
					echo "Posible ataque del archivo subido: ";
					echo "nombre del archivo '". $_FILES[$file]['tmp_name'] . "'.";
				}
			}
		}	
	}


	
	function TraerFotosRelacion($id) {
		$sql    =   "select 'galeria',s.idproducto,f.imagen,f.idfoto,f.type
							from dbproductos s
							
							inner
							join images f
							on	s.idproducto = f.refproyecto

							where s.idproducto = ".$id;
		$result =   $this->query($sql, 0);
		return $result;
	}
	
	
	function eliminarFoto($id)
	{
		
		$sql		=	"select concat('galeria','/',s.idproducto,'/',f.imagen) as archivo
							from dbproductos s
							
							inner
							join images f
							on	s.idproducto = f.refproyecto

							where f.idfoto =".$id;
		$resImg		=	$this->query($sql,0);
		
		if (mysql_num_rows($resImg)>0) {
			$res 		=	$this->borrarArchivo($id,mysql_result($resImg,0,0));
		} else {
			$res = true;
		}
		if ($res == false) {
			return 'Error al eliminar datos';
		} else {
			return '';
		}
	}
	
	function eliminarLibro($id)
	{
		
		$sql		=	"update dblibros set ruta = '' where idlibro =".$id;
		$res		=	$this->query($sql,0);
		
		if ($res == false) {
			return 'Error al eliminar datos';
		} else {
			return '';
		}
	}
	
	
	function eliminarFotoPorObjeto($id)
	{
		
		$sql		=	"select concat('galeria','/',s.idproducto,'/',f.imagen) as archivo,f.idfoto
							from dbproductos s
							
							inner
							join images f
							on	s.idproducto = f.refproyecto

							where s.idproducto =".$id;
		$resImg		=	$this->query($sql,0);
		
		if (mysql_num_rows($resImg)>0) {
			$res 		=	$this->borrarArchivo(mysql_result($resImg,0,1),mysql_result($resImg,0,0));
		} else {
			$res = true;
		}
		if ($res == false) {
			return 'Error al eliminar datos';
		} else {
			return '';
		}
	}

/* fin archivos */



function zerofill($valor, $longitud){
 $res = str_pad($valor, $longitud, '0', STR_PAD_LEFT);
 return $res;
}

function existeDevuelveId($sql) {

	$res = $this->query($sql,0);
	
	if (mysql_num_rows($res)>0) {
		return mysql_result($res,0,0);	
	}
	return 0;
}



/* PARA Clientes */

function insertarClientes($razonsocial,$cuit,$valorunitario) {
$sql = "insert into dbclientes(idcliente,razonsocial,cuit,valorunitario)
values ('','".($razonsocial)."','".($cuit)."',".$valorunitario.")";
$res = $this->query($sql,1);
return $res;
}


function modificarClientes($id,$razonsocial,$cuit,$valorunitario) {
$sql = "update dbclientes
set
razonsocial = '".($razonsocial)."',cuit = '".($cuit)."',valorunitario = ".$valorunitario."
where idcliente =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarClientes($id) {
$sql = "delete from dbclientes where idcliente =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerClientes() {
$sql = "select
c.idcliente,
c.razonsocial,
c.cuit,
c.valorunitario
from dbclientes c
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerClientesPorId($id) {
$sql = "select idcliente,razonsocial,cuit,valorunitario from dbclientes where idcliente =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbclientes*/


/* PARA Exportacioncontenedores */

function insertarExportacioncontenedores($refexportaciones,$contenedor,$tara,$precinto) {
$sql = "insert into dbexportacioncontenedores(idexportacioncontenedor,refexportaciones,contenedor,tara,precinto)
values ('',".$refexportaciones.",'".($contenedor)."',".$tara.",'".($precinto)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarExportacioncontenedores($id,$refexportaciones,$contenedor,$tara,$precinto) {
$sql = "update dbexportacioncontenedores
set
refexportaciones = ".$refexportaciones.",contenedor = '".($contenedor)."',tara = ".$tara.",precinto = '".($precinto)."'
where idexportacioncontenedor =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarExportacioncontenedores($id) {
$sql = "delete from dbexportacioncontenedores where idexportacioncontenedor =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerExportacioncontenedores() {
$sql = "select
e.idexportacioncontenedor,
e.refexportaciones,
e.contenedor,
e.tara,
e.precinto
from dbexportacioncontenedores e
inner join dbexportaciones exp ON exp.idexportacion = e.refexportaciones
inner join dbclientes cl ON cl.idcliente = exp.refclientes
inner join tbbuques bu ON bu.idbuque = exp.refbuques
inner join tbcolores co ON co.idcolor = exp.refcolores
inner join tbdestinos de ON de.iddestino = exp.refdestinos
inner join tbpuertos pu ON pu.idpuerto = exp.refpuertos
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerExportacioncontenedoresPorExportacion($idExportaciones) {
$sql = "select
e.idexportacioncontenedor,
e.contenedor,
e.tara,
e.precinto,
e.refexportaciones

from dbexportacioncontenedores e
inner join dbexportaciones expo ON expo.idexportacion = e.refexportaciones
inner join dbclientes cl ON cl.idcliente = expo.refclientes
inner join tbbuques bu ON bu.idbuque = expo.refbuques
inner join tbcolores co ON co.idcolor = expo.refcolores
inner join tbdestinos de ON de.iddestino = expo.refdestinos
inner join tbpuertos pu ON pu.idpuerto = expo.refpuertos
where expo.idexportacion = ".$idExportaciones."
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerExportacioncontenedoresPorId($id) {
$sql = "select idexportacioncontenedor,refexportaciones,contenedor,tara,precinto from dbexportacioncontenedores where idexportacioncontenedor =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbexportacioncontenedores*/


/* PARA Exportaciondetalles */

function insertarExportaciondetalles($refexportacioncontenedores,$bulto,$bruto,$neto,$marca,$refmercaderias,$total) {
$sql = "insert into dbexportaciondetalles(idexportaciondetalle,refexportacioncontenedores,bulto,bruto,neto,marca,refmercaderias,total)
values ('',".$refexportacioncontenedores.",".$bulto.",".$bruto.",".$neto.",'".($marca)."',".$refmercaderias.",".$total.")";
$res = $this->query($sql,1);
return $res;
}


function modificarExportaciondetalles($id,$refexportacioncontenedores,$bulto,$bruto,$neto,$marca,$refmercaderias,$total) {
$sql = "update dbexportaciondetalles
set
refexportacioncontenedores = ".$refexportacioncontenedores.",bulto = ".$bulto.",bruto = ".$bruto.",neto = ".$neto.",marca = '".($marca)."',refmercaderias = ".$refmercaderias.",total = ".$total."
where idexportaciondetalle =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarExportaciondetalles($id) {
$sql = "delete from dbexportaciondetalles where idexportaciondetalle =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarExportacionContenedoresDetallesPorExportacion($idExportacion) {
$sql = "delete dbexportaciondetalles,dbexportacioncontenedores 
			from dbexportacioncontenedores
			inner join dbexportaciondetalles ON dbexportacioncontenedores.idexportacioncontenedor = dbexportaciondetalles.refexportacioncontenedores
		where dbexportacioncontenedores.refexportaciones =".$idExportacion;
$res = $this->query($sql,0);
return $res;
}

function eliminarExportacionContenedoresDetallesPorContenedor($idContenedor) {
$sqlA = "delete 
			from dbexportaciondetalles
		where refexportacioncontenedores =".$idContenedor;

$resA = $this->query($sqlA,0);

$sql = "delete 
			from dbexportacioncontenedores
		where idexportacioncontenedor =".$idContenedor;

$res = $this->query($sql,0);


return $res;
}


function traerExportaciondetalles() {
$sql = "select
e.idexportaciondetalle,
e.refexportacioncontenedores,
e.bulto,
e.bruto,
e.neto,
e.marca,
e.refmercaderias,
e.total
from dbexportaciondetalles e
inner join dbexportacioncontenedores exp ON exp.idexportacioncontenedor = e.refexportacioncontenedores
inner join dbexportaciones ex ON ex.idexportacion = exp.refexportaciones
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerExportaciondetallesPorExportacionContenedor($idExportacion, $idContenedor) {
$sql = "select
e.idexportaciondetalle,
e.refexportacioncontenedores,
e.bulto,
e.bruto,
e.neto,
e.marca,
e.refmercaderias,
e.total
from dbexportaciondetalles e
inner join dbexportacioncontenedores expo ON expo.idexportacioncontenedor = e.refexportacioncontenedores
inner join dbexportaciones ex ON ex.idexportacion = expo.refexportaciones
inner join tbmercaderias tm on tm.idmercaderia = e.refmercaderias
where ex.idexportacion = ".$idexportacion." and expo.idexportacioncontenedor = ".$idContenedor."
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerExportaciondetallesPorContenedor($idContenedor) {
$sql = "select
e.idexportaciondetalle,
e.refexportacioncontenedores,
e.bulto,
e.bruto,
e.neto,
e.marca,
tm.nombre as mercaderia,
e.refmercaderias,
e.total
from dbexportaciondetalles e
inner join dbexportacioncontenedores expo ON expo.idexportacioncontenedor = e.refexportacioncontenedores
inner join dbexportaciones ex ON ex.idexportacion = expo.refexportaciones
inner join tbmercaderias tm on tm.idmercaderia = e.refmercaderias
where expo.idexportacioncontenedor = ".$idContenedor."
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerExportaciondetallesPorId($id) {
$sql = "select idexportaciondetalle,refexportacioncontenedores,bulto,bruto,neto,marca,refmercaderias,total from dbexportaciondetalles where idexportaciondetalle =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbexportaciondetalles*/


/* PARA Exportaciones */

function insertarExportaciones($refclientes,$refbuques,$refcolores,$refdestinos,$refpuertos,$permisoembarque,$booking,$despachante,$cuit,$fecha,$factura,$tc) {
$sql = "insert into dbexportaciones(idexportacion,refclientes,refbuques,refcolores,refdestinos,refpuertos,permisoembarque,booking,despachante,cuit,fecha,factura,tc)
values ('',".$refclientes.",".$refbuques.",".$refcolores.",".$refdestinos.",".$refpuertos.",'".($permisoembarque)."','".($booking)."','".($despachante)."','".($cuit)."','".($fecha)."','".($factura)."',".$tc.")";
$res = $this->query($sql,1);
return $res;
}


function modificarExportaciones($id,$refclientes,$refbuques,$refcolores,$refdestinos,$refpuertos,$permisoembarque,$booking,$despachante,$cuit,$fecha,$factura,$tc) {
$sql = "update dbexportaciones
set
refclientes = ".$refclientes.",refbuques = ".$refbuques.",refcolores = ".$refcolores.",refdestinos = ".$refdestinos.",refpuertos = ".$refpuertos.",permisoembarque = '".($permisoembarque)."',booking = '".($booking)."',despachante = '".($despachante)."',cuit = '".($cuit)."',fecha = '".($fecha)."',factura = '".($factura)."', tc = ".$tc."
where idexportacion =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarExportaciones($id) {


$sqlA = "delete 
			from dbexportaciondetalles
		where refexportacioncontenedores in 
		(select idexportacioncontenedor 
			from dbexportacioncontenedores ec
			inner join dbexportaciones e ON e.idexportacion = ec.refexportaciones
			where e.idexportacion = ".$id.")";

$resA = $this->query($sqlA,0);

$sqlB = "delete 
			from dbexportacioncontenedores
		where refexportaciones =".$id;

$resB = $this->query($sqlB,0);


$sql = "delete 
			from dbexportaciones
		where idexportacion =".$id;

$res = $this->query($sql,0);


return $res;
}


function traerExportaciones() {
$sql = "select
e.idexportacion,
e.refclientes,
e.refbuques,
e.refcolores,
e.refdestinos,
e.refpuertos,
e.permisoembarque,
e.booking,
e.despachante,
e.cuit,
e.fecha,
e.factura,
e.tc
from dbexportaciones e
inner join dbclientes cli ON cli.idcliente = e.refclientes
inner join tbbuques buq ON buq.idbuque = e.refbuques
inner join tbcolores col ON col.idcolor = e.refcolores
inner join tbdestinos des ON des.iddestino = e.refdestinos
inner join tbpuertos pue ON pue.idpuerto = e.refpuertos
order by 1";
$res = $this->query($sql,0);
return $res;
}

function traerExportacionesGrid() {
	$sql = "select
				e.idexportacion,
				e.permisoembarque,
				cli.razonsocial,
				buq.nombre as buque,
				des.destino,
				pue.puerto,
				colo.color,
				e.booking,
				e.fecha,
				e.factura,
				e.despachante,
				e.cuit,
				e.refclientes,
				e.refbuques,
				e.refcolores,
				e.refdestinos,
				e.refpuertos,
				e.tc
			from dbexportaciones e
			inner join dbclientes cli ON cli.idcliente = e.refclientes
			inner join tbbuques buq ON buq.idbuque = e.refbuques
			inner join tbcolores colo ON colo.idcolor = e.refcolores
			inner join tbdestinos des ON des.iddestino = e.refdestinos
			inner join tbpuertos pue ON pue.idpuerto = e.refpuertos
			order by 1";
			$res = $this->query($sql,0);
			return $res;
}


function traerExportacionesPorIdReporte($id) {
	$sql = "select
				e.idexportacion,
				e.permisoembarque,
				cli.razonsocial,
				buq.nombre as buque,
				des.destino,
				pue.puerto,
				colo.color,
				e.booking,
				e.fecha,
				e.factura,
				e.despachante,
				e.cuit,
				e.refclientes,
				e.refbuques,
				e.refcolores,
				e.refdestinos,
				e.refpuertos,
				e.tc
			from dbexportaciones e
			inner join dbclientes cli ON cli.idcliente = e.refclientes
			inner join tbbuques buq ON buq.idbuque = e.refbuques
			inner join tbcolores colo ON colo.idcolor = e.refcolores
			inner join tbdestinos des ON des.iddestino = e.refdestinos
			inner join tbpuertos pue ON pue.idpuerto = e.refpuertos
			where e.idexportacion = ".$id."
			order by 1";
			$res = $this->query($sql,0);
			return $res;
}

function rptExportacionesDiarias($fecha) {
	$sql = "select
				t.idexportacion,
				t.permisoembarque,
				t.razonsocial,
				t.buque,
				t.destino,
				t.puerto,
				t.color,
				t.booking,
				t.fecha,
				t.factura,
				t.despachante,
				t.cuit,
				t.refclientes,
				t.refbuques,
				t.refcolores,
				t.refdestinos,
				t.refpuertos,
				t.tc,
				sum(t.tara) as tara,
				sum(t.bulto) as bulto,
				sum(t.bruto) as bruto,
				sum(t.neto) as neto,
				sum(t.cantidad) as cantidad,
				t.valorunitario,
                t.contenedor,
				t.precinto
				from	(
						select
								e.idexportacion,
								e.permisoembarque,
								cli.razonsocial,
								buq.nombre as buque,
								des.destino,
								pue.puerto,
								colo.color,
								e.booking,
								e.fecha,
								e.factura,
								e.despachante,
								e.cuit,
								e.refclientes,
								e.refbuques,
								e.refcolores,
								e.refdestinos,
								e.refpuertos,
								e.tc,
				                ec.tara,
				                ec.contenedor,
                                ec.precinto,
				                sum(ed.bulto) as bulto,
				                sum(ed.bruto) as bruto,
				                sum(ed.neto) as neto,
				                count(ed.idexportaciondetalle) as cantidad,
				                cli.valorunitario
							from dbexportaciones e
				            inner join dbexportacioncontenedores ec ON e.idexportacion = ec.refexportaciones
				            inner join dbexportaciondetalles ed ON ed.refexportacioncontenedores = ec.idexportacioncontenedor
							inner join dbclientes cli ON cli.idcliente = e.refclientes
							inner join tbbuques buq ON buq.idbuque = e.refbuques
							inner join tbcolores colo ON colo.idcolor = e.refcolores
							inner join tbdestinos des ON des.iddestino = e.refdestinos
							inner join tbpuertos pue ON pue.idpuerto = e.refpuertos
				            where e.fecha = '".$fecha."'
				            group by e.idexportacion,e.permisoembarque,
								cli.razonsocial,buq.nombre,
								des.destino,pue.puerto,
								colo.color,	e.booking,
								e.fecha,e.factura,
								e.despachante,e.cuit,
								e.refclientes,e.refbuques,
								e.refcolores,e.refdestinos,
								e.refpuertos,e.tc,
				                ec.tara,
				                cli.valorunitario,
				                ec.contenedor,
                                ec.precinto
							) as t
				            group by t.idexportacion,
				t.permisoembarque,
				t.razonsocial,
				t.buque,
				t.destino,
				t.puerto,
				t.color,
				t.booking,
				t.fecha,
				t.factura,
				t.despachante,
				t.cuit,
				t.refclientes,
				t.refbuques,
				t.refcolores,
				t.refdestinos,
				t.refpuertos,
				t.tc ,
				t.valorunitario,
                t.contenedor,
				t.precinto
				order by t.fecha";
	
	$res = $this->query($sql,0);
	return $res;
} 


function rptExportacionesMensual($anio,$mes) {
	$sql = "select
				t.idexportacion,
				t.permisoembarque,
				t.razonsocial,
				t.buque,
				t.destino,
				t.puerto,
				t.color,
				t.booking,
				t.fecha,
				t.factura,
				t.despachante,
				t.cuit,
				t.refclientes,
				t.refbuques,
				t.refcolores,
				t.refdestinos,
				t.refpuertos,
				t.tc,
				sum(t.tara) as tara,
				sum(t.bulto) as bulto,
				sum(t.bruto) as bruto,
				sum(t.neto) as neto
				from	(
						select
								e.idexportacion,
								e.permisoembarque,
								cli.razonsocial,
								buq.nombre as buque,
								des.destino,
								pue.puerto,
								colo.color,
								e.booking,
								e.fecha,
								e.factura,
								e.despachante,
								e.cuit,
								e.refclientes,
								e.refbuques,
								e.refcolores,
								e.refdestinos,
								e.refpuertos,
								e.tc,
				                ec.tara,
				                sum(ed.bulto) as bulto,
				                sum(ed.bruto) as bruto,
				                sum(ed.neto) as neto
							from dbexportaciones e
				            inner join dbexportacioncontenedores ec ON e.idexportacion = ec.refexportaciones
				            inner join dbexportaciondetalles ed ON ed.refexportacioncontenedores = ec.idexportacioncontenedor
							inner join dbclientes cli ON cli.idcliente = e.refclientes
							inner join tbbuques buq ON buq.idbuque = e.refbuques
							inner join tbcolores colo ON colo.idcolor = e.refcolores
							inner join tbdestinos des ON des.iddestino = e.refdestinos
							inner join tbpuertos pue ON pue.idpuerto = e.refpuertos
				            where year(e.fecha) = ".$anio." and month(e.fecha) = ".$mes."
				            group by e.idexportacion,e.permisoembarque,
								cli.razonsocial,buq.nombre,
								des.destino,pue.puerto,
								colo.color,	e.booking,
								e.fecha,e.factura,
								e.despachante,e.cuit,
								e.refclientes,e.refbuques,
								e.refcolores,e.refdestinos,
								e.refpuertos,e.tc,
				                ec.tara
							) as t
				            group by t.idexportacion,
				t.permisoembarque,
				t.razonsocial,
				t.buque,
				t.destino,
				t.puerto,
				t.color,
				t.booking,
				t.fecha,
				t.factura,
				t.despachante,
				t.cuit,
				t.refclientes,
				t.refbuques,
				t.refcolores,
				t.refdestinos,
				t.refpuertos,
				t.tc
				order by t.fecha";
	
	$res = $this->query($sql,0);
	return $res;
} 


function traerExportacionesPorId($id) {
$sql = "select idexportacion,refclientes,refbuques,refcolores,refdestinos,refpuertos,permisoembarque,booking,despachante,cuit,fecha,factura from dbexportaciones where idexportacion =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbexportaciones*/


/* PARA Usuarios */

function insertarUsuarios($usuario,$password,$refroles,$email,$nombrecompleto) {
$sql = "insert into dbusuarios(idusuario,usuario,password,refroles,email,nombrecompleto)
values ('','".($usuario)."','".($password)."',".$refroles.",'".($email)."','".($nombrecompleto)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarUsuarios($id,$usuario,$password,$refroles,$email,$nombrecompleto) {
$sql = "update dbusuarios
set
usuario = '".($usuario)."',password = '".($password)."',refroles = ".$refroles.",email = '".($email)."',nombrecompleto = '".($nombrecompleto)."'
where idusuario =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarUsuarios($id) {
$sql = "delete from dbusuarios where idusuario =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerUsuarios() {
$sql = "select
u.idusuario,
u.usuario,
u.password,
u.refroles,
u.email,
u.nombrecompleto
from dbusuarios u
inner join tbroles rol ON rol.idrol = u.refroles
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerUsuariosPorId($id) {
$sql = "select idusuario,usuario,password,refroles,email,nombrecompleto from dbusuarios where idusuario =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbusuarios*/


/* PARA Predio_menu */

function insertarPredio_menu($url,$icono,$nombre,$Orden,$hover,$permiso) {
$sql = "insert into predio_menu(idmenu,url,icono,nombre,Orden,hover,permiso)
values ('','".($url)."','".($icono)."','".($nombre)."',".$Orden.",'".($hover)."','".($permiso)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarPredio_menu($id,$url,$icono,$nombre,$Orden,$hover,$permiso) {
$sql = "update predio_menu
set
url = '".($url)."',icono = '".($icono)."',nombre = '".($nombre)."',Orden = ".$Orden.",hover = '".($hover)."',permiso = '".($permiso)."'
where idmenu =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarPredio_menu($id) {
$sql = "delete from predio_menu where idmenu =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerPredio_menu() {
$sql = "select
p.idmenu,
p.url,
p.icono,
p.nombre,
p.Orden,
p.hover,
p.permiso
from predio_menu p
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerPredio_menuPorId($id) {
$sql = "select idmenu,url,icono,nombre,Orden,hover,permiso from predio_menu where idmenu =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: predio_menu*/


/* PARA Buques */

function insertarBuques($nombre) {
$sql = "insert into tbbuques(idbuque,nombre)
values ('','".($nombre)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarBuques($id,$nombre) {
$sql = "update tbbuques
set
nombre = '".($nombre)."'
where idbuque =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarBuques($id) {
$sql = "delete from tbbuques where idbuque =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerBuques() {
$sql = "select
b.idbuque,
b.nombre
from tbbuques b
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerBuquesPorId($id) {
$sql = "select idbuque,nombre from tbbuques where idbuque =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbbuques*/


/* PARA Colores */

function insertarColores($color) {
$sql = "insert into tbcolores(idcolor,color)
values ('','".($color)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarColores($id,$color) {
$sql = "update tbcolores
set
color = '".($color)."'
where idcolor =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarColores($id) {
$sql = "delete from tbcolores where idcolor =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerColores() {
$sql = "select
c.idcolor,
c.color
from tbcolores c
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerColoresPorId($id) {
$sql = "select idcolor,color from tbcolores where idcolor =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbcolores*/


/* PARA Destinos */

function insertarDestinos($destino) {
$sql = "insert into tbdestinos(iddestino,destino)
values ('','".($destino)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarDestinos($id,$destino) {
$sql = "update tbdestinos
set
destino = '".($destino)."'
where iddestino =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarDestinos($id) {
$sql = "delete from tbdestinos where iddestino =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerDestinos() {
$sql = "select
d.iddestino,
d.destino
from tbdestinos d
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerDestinosPorId($id) {
$sql = "select iddestino,destino from tbdestinos where iddestino =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbdestinos*/


/* PARA Mercaderias */

function insertarMercaderias($nombre) {
$sql = "insert into tbmercaderias(idmercaderia,nombre)
values ('','".$nombre."')";
$res = $this->query($sql,1);
return $res;
}


function modificarMercaderias($id,$nombre) {
$sql = "update tbmercaderias
set
nombre = '".$nombre."'
where idmercaderia =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarMercaderias($id) {
$sql = "delete from tbmercaderias where idmercaderia =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerMercaderias() {
$sql = "select
m.idmercaderia,
m.nombre
from tbmercaderias m
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerMercaderiasPorId($id) {
$sql = "select idmercaderia,nombre from tbmercaderias where idmercaderia =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbmercaderias*/


/* PARA Puertos */

function insertarPuertos($puerto,$bandera) {
$sql = "insert into tbpuertos(idpuerto,puerto,bandera)
values ('','".($puerto)."','".($bandera)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarPuertos($id,$puerto,$bandera) {
$sql = "update tbpuertos
set
puerto = '".($puerto)."',bandera = '".($bandera)."'
where idpuerto =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarPuertos($id) {
$sql = "delete from tbpuertos where idpuerto =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerPuertos() {
$sql = "select
p.idpuerto,
p.puerto,
p.bandera
from tbpuertos p
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerPuertosPorId($id) {
$sql = "select idpuerto,puerto,bandera from tbpuertos where idpuerto =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbpuertos*/


/* PARA Roles */

function insertarRoles($descripcion,$activo) {
$sql = "insert into tbroles(idrol,descripcion,activo)
values ('','".($descripcion)."',".$activo.")";
$res = $this->query($sql,1);
return $res;
}


function modificarRoles($id,$descripcion,$activo) {
$sql = "update tbroles
set
descripcion = '".($descripcion)."',activo = ".$activo."
where idrol =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarRoles($id) {
$sql = "delete from tbroles where idrol =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerRoles() {
$sql = "select
r.idrol,
r.descripcion,
r.activo
from tbroles r
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerRolesPorId($id) {
$sql = "select idrol,descripcion,activo from tbroles where idrol =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbroles*/




function graficosProductosConsumo($anio) {


	$sql = "select
			
				p.refcategorias, c.descripcion, coalesce(count(c.idcategoria),0)
		
					from dbventas v
					inner join tbtipopago tip ON tip.idtipopago = v.reftipopago
					inner join dbclientes cli ON cli.idcliente = v.refclientes
					inner join dbdetalleventas dv ON v.idventa = dv.refventas
					inner join dbproductos p ON p.idproducto = dv.refproductos
					inner join tbcategorias c ON c.idcategoria = p.refcategorias
					where	year(v.fecha) = ".$anio." and c.esegreso = 0 and v.cancelado = 0
			group by p.refcategorias, c.descripcion
			";
			
	$sqlT = "select
			
				coalesce(count(p.idproducto),0)

			from dbventas v
			inner join tbtipopago tip ON tip.idtipopago = v.reftipopago
			inner join dbclientes cli ON cli.idcliente = v.refclientes
			inner join dbdetalleventas dv ON v.idventa = dv.refventas
			inner join dbproductos p ON p.idproducto = dv.refproductos
			inner join tbcategorias c ON c.idcategoria = p.refcategorias
			where	year(v.fecha) = ".$anio." and c.esegreso = 0 and v.cancelado = 0";
			
	$sqlT2 = "select
					count(*)
				from dbproductos p
				where p.activo = 1
			";

	
	$resT = mysql_result($this->query($sqlT,0),0,0);
	$resR = $this->query($sql,0);
	
	$cad	= "Morris.Donut({
              element: 'graph2',
              data: [";
	$cadValue = '';
	if ($resT > 0) {
		while ($row = mysql_fetch_array($resR)) {
			$cadValue .= "{value: ".((100 * $row[2])	/ $resT).", label: '".$row[1]."'},";
		}
	}
	

	$cad .= substr($cadValue,0,strlen($cadValue)-1);
    $cad .=          "],
              formatter: function (x) { return x + '%'}
            }).on('click', function(i, row){
              console.log(i, row);
            });";
			
	return $cad;
}


/* PARA Audit */

function insertarAudit($tabla,$idtabla,$campo,$previousvalue,$newvalue,$dateupdate,$user,$action) { 
$sql = "insert into audit(idaudit,tabla,idtabla,campo,previousvalue,newvalue,dateupdate,user,action) 
values ('','".utf8_decode($tabla)."',".$idtabla.",'".$campo."','".utf8_decode($previousvalue)."','".utf8_decode($newvalue)."','".utf8_decode($dateupdate)."','".utf8_decode($user)."','".utf8_decode($action)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarAudit($id,$tabla,$idtabla,$idmodificado,$previousvalue,$newvalue,$dateupdate,$user,$action) { 
$sql = "update audit 
set 
tabla = '".utf8_decode($tabla)."',idtabla = ".$idtabla.",idmodificado = ".$idmodificado.",previousvalue = '".utf8_decode($previousvalue)."',newvalue = '".utf8_decode($newvalue)."',dateupdate = '".utf8_decode($dateupdate)."',user = '".utf8_decode($user)."',action = '".utf8_decode($action)."' 
where idaudit =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarAudit($id) { 
$sql = "delete from audit where idaudit =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerAudit() { 
$sql = "select idaudit,tabla,idtabla,idmodificado,previousvalue,newvalue,dateupdate,user,action from audit order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerAuditPorId($id) { 
$sql = "select idaudit,tabla,idtabla,idmodificado,previousvalue,newvalue,dateupdate,user,action from audit where idaudit =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */

/* PARA Cajadiaria */

function insertarCajadiaria($fecha,$inicio,$fin) {
$sql = "insert into tbcajadiaria(idcajadiaria,fecha,inicio,fin)
values ('','".utf8_decode($fecha)."',".$inicio.",".($fin == '' ? 0 : $fin).")";
$res = $this->query($sql,1);
return $res;
}


function modificarCajadiaria($id,$fecha,$inicio,$fin) {
$sql = "update tbcajadiaria
set
fecha = '".utf8_decode($fecha)."',inicio = ".$inicio.",fin = ".($fin == '' ? 0 : $fin)."
where idcajadiaria =".$id;
$res = $this->query($sql,0);
return $id;
}


function eliminarCajadiaria($id) {
$sql = "delete from tbcajadiaria where idcajadiaria =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerCajadiaria() {
$sql = "select
c.idcajadiaria,
c.fecha,
c.inicio,
c.fin
from tbcajadiaria c
order by 1";
$res = $this->query($sql,0);
return $res;
}

function traerCajadiariaPorFecha($fecha) {
$sql = "select
c.idcajadiaria,
c.fecha,
c.inicio,
c.fin
from tbcajadiaria c 
where c.fecha = '".$fecha."'
";
$res = $this->query($sql,0);
return $res;
}


function traerCajadiariaPorId($id) {
$sql = "select idcajadiaria,fecha,inicio,fin from tbcajadiaria where idcajadiaria =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbcajadiaria*/



function query($sql,$accion) {
		
		
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();	
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		
		        $error = 0;
		mysql_query("BEGIN");
		$result=mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		if(!$result){
			$error=1;
		}
		if($error==1){
			mysql_query("ROLLBACK");
			return false;
		}
		 else{
			mysql_query("COMMIT");
			return $result;
		}
		
	}

}

?>