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

function insertarClientes($razonsocial,$cuit,$honorarios,$minhonorarios,$gastos,$email) { 
$sql = "insert into dbclientes(idcliente,razonsocial,cuit,honorarios,minhonorarios,gastos,email) 
values ('','".($razonsocial)."','".($cuit)."',".$honorarios.",".$minhonorarios.",".$gastos.",'".($email)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarClientes($id,$razonsocial,$cuit,$honorarios,$minhonorarios,$gastos,$email) { 
$sql = "update dbclientes 
set 
razonsocial = '".($razonsocial)."',cuit = '".($cuit)."',honorarios = ".$honorarios.",minhonorarios = ".$minhonorarios.",gastos = ".$gastos.",email = '".($email)."' 
where idcliente =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarClientes($id) { 
$sql = "delete from dbclientereferentes where refclientes =".$id; 
$res = $this->query($sql,0); 


$sql = "delete from dbclientes where idcliente =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerClientes() { 
$sql = "select 
c.idcliente,
c.razonsocial,
c.cuit,
c.honorarios,
c.minhonorarios,
c.gastos,
c.email
from dbclientes c 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerClientesPorId($id) { 
$sql = "select idcliente,razonsocial,cuit,honorarios,minhonorarios,gastos,email from dbclientes where idcliente =".$id; 
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

function insertarExportaciondetalles($refexportacioncontenedores,$bulto,$bruto,$neto,$marca,$refmercaderias,$valorunitario) {
$sql = "insert into dbexportaciondetalles(idexportaciondetalle,refexportacioncontenedores,bulto,bruto,neto,marca,refmercaderias,valorunitario)
values ('',".$refexportacioncontenedores.",".($bulto == '' ? 0 : $bulto).",".($bruto == '' ? 0 : $bruto).",".($neto == '' ? 0 : $neto).",'".($marca)."',".$refmercaderias.",".($valorunitario == '' ? 0 : $valorunitario).")";
$res = $this->query($sql,1);
return $res;
}


function modificarExportaciondetalles($id,$refexportacioncontenedores,$bulto,$bruto,$neto,$marca,$refmercaderias,$valorunitario) {
$sql = "update dbexportaciondetalles
set
refexportacioncontenedores = ".$refexportacioncontenedores.",bulto = ".($bulto == '' ? 0 : $bulto).",bruto = ".($bruto == '' ? 0 : $bruto).",neto = ".($neto == '' ? 0 : $neto).",marca = '".($marca)."',refmercaderias = ".$refmercaderias.",valorunitario = ".($valorunitario == '' ? 0 : $valorunitario)."
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
e.valorunitario
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
e.valorunitario
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
e.bulto,
e.bruto,
e.neto,
e.marca,
tm.nombre as mercaderia,
e.valorunitario,
e.refexportacioncontenedores,
e.refmercaderias
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
$sql = "select idexportaciondetalle,refexportacioncontenedores,bulto,bruto,neto,marca,refmercaderias,valorunitario from dbexportaciondetalles where idexportaciondetalle =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbexportaciondetalles*/


/* PARA Exportaciones */

function insertarExportaciones($refclientes,$refbuques,$refcolores,$refdestinos,$refpuertos,$permisoembarque,$booking,$despachante,$cuit,$fecha,$factura,$tc, $refagencias, $gastos, $honorarios, $minhonorarios) {
$sql = "insert into dbexportaciones(idexportacion,refclientes,refbuques,refcolores,refdestinos,refpuertos,permisoembarque,booking,despachante,cuit,fecha,factura,tc, fechamodi,refagencias, gastos, honorarios, minhonorarios)
values ('',".$refclientes.",".$refbuques.",".$refcolores.",".$refdestinos.",".$refpuertos.",'".($permisoembarque)."','".($booking)."','".($despachante)."','".($cuit)."','".($fecha)."','".($factura)."',".($tc == '' ? 0 : $tc).", now(), ".$refagencias.", ".($gastos == '' ? 0 : $gastos).", ".($honorarios == '' ? 0 : $honorarios).", ".($minhonorarios == '' ? 0 : $minhonorarios).")";
$res = $this->query($sql,1);
return $res;
}


function modificarExportaciones($id,$refclientes,$refbuques,$refcolores,$refdestinos,$refpuertos,$permisoembarque,$booking,$despachante,$cuit,$fecha,$factura,$tc, $refagencias, $gastos, $honorarios, $minhonorarios) {
$sql = "update dbexportaciones
set
refclientes = ".$refclientes.",refbuques = ".$refbuques.",refcolores = ".$refcolores.",refdestinos = ".$refdestinos.",refpuertos = ".$refpuertos.",permisoembarque = '".($permisoembarque)."',booking = '".($booking)."',despachante = '".($despachante)."',cuit = '".($cuit)."',fecha = '".($fecha)."',factura = '".($factura)."', tc = ".($tc == '' ? 0 : $tc).", fechamodi = now(), refagencias = ".$refagencias.", gastos = ".$gastos.", honorarios = ".$honorarios.", minhonorarios = ".$minhonorarios."
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
e.tc,
e.refagencias,
e.gastos,
e.honorarios,
e.minhonorarios
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
	r.idexportacion,
	r.permisoembarque,
	r.razonsocial,
	r.buque,
	r.destino,
	r.puerto,
	r.color,
	r.booking,
	r.fecha,
	r.factura,
	(case when sum(r.honorariosFinal) <= r.minhonorarios 
		then r.minhonorarios + r.gastos
        else
		(sum(r.honorariosFinal) + r.gastos) end) as honorariosFinal,
	sum(r.brutototal) as brutototal,
	sum(r.fob) as fob,
	sum(r.fobpesos) as fobpesos
from (
	select
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
		t.gastos,
        t.minhonorarios,
        round(sum(t.honorariosFinal),2) as honorariosFinal,
		round((sum(t.bruto) + t.tara),2) as brutototal,
		round(sum(t.fob),2) as fob,
		round(sum(t.fobpesos),2) as fobpesos
		
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
                                ec.tara,
                                e.gastos,
                                sum(ed.bruto) as bruto,
                                sum(ed.neto) * ed.valorunitario as fob,
                                sum(ed.neto) * ed.valorunitario * e.tc as fobpesos,
                                e.minhonorarios,
                                (case when sum(ed.neto) * ed.valorunitario * e.tc <= e.minhonorarios 
									then e.minhonorarios + e.gastos
                                    else (sum(ed.neto) * ed.valorunitario * e.tc) * e.honorarios / 100 end) as honorariosFinal
							from dbexportaciones e
				            inner join dbexportacioncontenedores ec ON e.idexportacion = ec.refexportaciones
				            inner join dbexportaciondetalles ed ON ed.refexportacioncontenedores = ec.idexportacioncontenedor
							inner join dbclientes cli ON cli.idcliente = e.refclientes
							inner join tbbuques buq ON buq.idbuque = e.refbuques
							inner join tbcolores colo ON colo.idcolor = e.refcolores
							inner join tbdestinos des ON des.iddestino = e.refdestinos
							inner join tbpuertos pue ON pue.idpuerto = e.refpuertos
							inner join tbagencias ag ON ag.idagencia = e.refagencias
				            group by e.idexportacion,
								e.permisoembarque,
								cli.razonsocial,
								buq.nombre,
								des.destino,
								pue.puerto,
								colo.color,
								e.booking,
								e.fecha,
								e.factura,
                                ed.valorunitario,
                                e.minhonorarios,
                                e.gastos,
                                ec.tara,
                                e.honorarios
							) as t
				group by t.idexportacion,
		t.permisoembarque,
		t.razonsocial,
		t.buque,
		t.destino,
		t.puerto,
		t.color,
		t.booking,
		t.gastos,
		t.fecha,
        t.tara,
        t.minhonorarios,
		t.factura            
				order by t.fecha desc
		) r
        group by r.idexportacion,
	r.permisoembarque,
	r.razonsocial,
	r.buque,
	r.destino,
	r.puerto,
	r.color,
	r.gastos,
	r.booking,
	r.fecha,
	r.factura";
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
				e.tc,
				ag.agencia,
				e.gastos,
				e.honorarios,
				e.minhonorarios
			from dbexportaciones e
			inner join dbclientes cli ON cli.idcliente = e.refclientes
			inner join tbbuques buq ON buq.idbuque = e.refbuques
			inner join tbcolores colo ON colo.idcolor = e.refcolores
			inner join tbdestinos des ON des.iddestino = e.refdestinos
			inner join tbpuertos pue ON pue.idpuerto = e.refpuertos
			inner join tbagencias ag ON ag.idagencia = e.refagencias
			where e.idexportacion = ".$id."
			order by 1";
			$res = $this->query($sql,0);
			return $res;
}

function rptExportacionesCompletoPorId($id) {
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
				t.precinto,
				t.agencia,
				t.gastos,
				t.honorarios,
				t.minhonorarios,
				t.mercaderia,
				t.marca
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
				                ed.valorunitario as valorunitario,
				                ag.agencia,
				                e.gastos,
				                e.honorarios,
				                e.minhonorarios,
				                mer.nombre as mercaderia,
				                ed.marca
							from dbexportaciones e
				            inner join dbexportacioncontenedores ec ON e.idexportacion = ec.refexportaciones
				            inner join dbexportaciondetalles ed ON ed.refexportacioncontenedores = ec.idexportacioncontenedor
							inner join dbclientes cli ON cli.idcliente = e.refclientes
							inner join tbbuques buq ON buq.idbuque = e.refbuques
							inner join tbcolores colo ON colo.idcolor = e.refcolores
							inner join tbdestinos des ON des.iddestino = e.refdestinos
							inner join tbpuertos pue ON pue.idpuerto = e.refpuertos
							inner join tbagencias ag ON ag.idagencia = e.refagencias
							inner join tbmercaderias mer ON mer.idmercaderia = ed.refmercaderias
				            where e.idexportacion = ".$id."
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
				                ed.valorunitario,
				                ec.contenedor,
                                ec.precinto,
                                ag.agencia,
                                e.gastos,
                                e.honorarios,
                                e.minhonorarios,
                                mer.nombre,
				                ed.marca
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
				t.precinto,
				t.agencia,
				t.gastos,
				t.honorarios,
				t.minhonorarios,
				t.mercaderia,
				t.marca
				order by t.fecha";
	
	$res = $this->query($sql,0);
	return $res;
} 

function rptExportacionesDiarias($anio, $mes) {
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
				t.precinto,
				t.agencia,
				t.marca,
				t.gastos,
				t.honorarios,
				t.minhonorarios
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
                                ed.marca,
				                sum(ed.bulto) as bulto,
				                sum(ed.bruto) as bruto,
				                sum(ed.neto) as neto,
				                count(ed.idexportaciondetalle) as cantidad,
				                ed.valorunitario as valorunitario,
				                ag.agencia,
				                e.gastos,
				                e.honorarios,
				                e.minhonorarios
							from dbexportaciones e
				            inner join dbexportacioncontenedores ec ON e.idexportacion = ec.refexportaciones
				            inner join dbexportaciondetalles ed ON ed.refexportacioncontenedores = ec.idexportacioncontenedor
							inner join dbclientes cli ON cli.idcliente = e.refclientes
							inner join tbbuques buq ON buq.idbuque = e.refbuques
							inner join tbcolores colo ON colo.idcolor = e.refcolores
							inner join tbdestinos des ON des.iddestino = e.refdestinos
							inner join tbpuertos pue ON pue.idpuerto = e.refpuertos
							inner join tbagencias ag ON ag.idagencia = e.refagencias
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
				                ec.tara,
				                ed.marca,
				                ed.valorunitario,
				                ec.contenedor,
                                ec.precinto,
                                ag.agencia,
                                e.gastos,
                                e.honorarios,
                                e.minhonorarios
							) as t
				            group by t.idexportacion,
				t.permisoembarque,
				t.razonsocial,
				t.buque,
				t.destino,
				t.puerto,
				t.color,
				t.marca,
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
				t.precinto,
				t.agencia,
				t.gastos,
				t.honorarios,
				t.minhonorarios
				order by t.fecha, t.permisoembarque";
	
	$res = $this->query($sql,0);
	return $res;
} 


function rptExportacionesPorBuqueFechaFacturado($anio, $mes, $idBuque, $facturado) {
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
				t.marca,
				sum(t.tara) as tara,
				sum(t.bulto) as bulto,
				sum(t.bruto) as bruto,
				sum(t.neto) as neto,
				sum(t.cantidad) as cantidad,
				t.valorunitario,
                t.contenedor,
				t.precinto,
				t.agencia,
				t.gastos,
				t.honorarios,
				t.minhonorarios
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
                                ed.marca,
				                sum(ed.bulto) as bulto,
				                sum(ed.bruto) as bruto,
				                sum(ed.neto) as neto,
				                count(ed.idexportaciondetalle) as cantidad,
				                ed.valorunitario as valorunitario,
				                ag.agencia,
				                e.gastos,
				                e.honorarios,
				                e.minhonorarios
							from dbexportaciones e
				            inner join dbexportacioncontenedores ec ON e.idexportacion = ec.refexportaciones
				            inner join dbexportaciondetalles ed ON ed.refexportacioncontenedores = ec.idexportacioncontenedor
							inner join dbclientes cli ON cli.idcliente = e.refclientes
							inner join tbbuques buq ON buq.idbuque = e.refbuques
							inner join tbcolores colo ON colo.idcolor = e.refcolores
							inner join tbdestinos des ON des.iddestino = e.refdestinos
							inner join tbpuertos pue ON pue.idpuerto = e.refpuertos
							inner join tbagencias ag ON ag.idagencia = e.refagencias";
		if ($idBuque == 0) {
			$sql .=	            " where year(e.fecha) = ".$anio." and month(e.fecha) = ".$mes." and (e.factura ".$facturado.")";
		} else {
			$sql .=	            " where year(e.fecha) = ".$anio." and month(e.fecha) = ".$mes." and buq.idbuque = ".$idBuque." and (e.factura ".$facturado.")";
		}
		

		$sql .=	            " group by e.idexportacion,e.permisoembarque,
								cli.razonsocial,buq.nombre,
								des.destino,pue.puerto,
								colo.color,	e.booking,
								e.fecha,e.factura,
								e.despachante,e.cuit,
								e.refclientes,e.refbuques,
								e.refcolores,e.refdestinos,
								e.refpuertos,e.tc,
				                ec.tara,
				                ed.valorunitario,
				                ec.contenedor,
                                ec.precinto,
                                ag.agencia,
                                e.gastos,
                                ed.marca,
                                e.honorarios,
                                e.minhonorarios
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
				t.marca,
				t.valorunitario,
                t.contenedor,
				t.precinto,
				t.agencia,
				t.gastos,
				t.honorarios,
				t.minhonorarios
				order by t.fecha";
	
	$res = $this->query($sql,0);
	return $res;
} 


function rptExportacionesNoFacturadas() {
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
				t.marca,
				sum(t.tara) as tara,
				sum(t.bulto) as bulto,
				sum(t.bruto) as bruto,
				sum(t.neto) as neto,
				sum(t.cantidad) as cantidad,
				t.valorunitario,
                t.contenedor,
				t.precinto,
				t.agencia,
				t.gastos,
				t.honorarios,
				t.minhonorarios
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
                                ed.marca,
				                sum(ed.bulto) as bulto,
				                sum(ed.bruto) as bruto,
				                sum(ed.neto) as neto,
				                count(ed.idexportaciondetalle) as cantidad,
				                ed.valorunitario as valorunitario,
				                ag.agencia,
				                e.gastos,
				                e.honorarios,
				                e.minhonorarios
							from dbexportaciones e
				            inner join dbexportacioncontenedores ec ON e.idexportacion = ec.refexportaciones
				            inner join dbexportaciondetalles ed ON ed.refexportacioncontenedores = ec.idexportacioncontenedor
							inner join dbclientes cli ON cli.idcliente = e.refclientes
							inner join tbbuques buq ON buq.idbuque = e.refbuques
							inner join tbcolores colo ON colo.idcolor = e.refcolores
							inner join tbdestinos des ON des.iddestino = e.refdestinos
							inner join tbpuertos pue ON pue.idpuerto = e.refpuertos
							inner join tbagencias ag ON ag.idagencia = e.refagencias
				            where (e.factura = 0 or e.factura is null)
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
				                ed.valorunitario,
				                ec.contenedor,
                                ec.precinto,
                                ag.agencia,
                                e.gastos,
                                ed.marca,
                                e.honorarios,
                                e.minhonorarios
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
				t.marca,
				t.valorunitario,
                t.contenedor,
				t.precinto,
				t.agencia,
				t.gastos,
				t.honorarios,
				t.minhonorarios
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
				sum(t.neto) as neto,
				sum(t.cantidad) as cantidad,
				t.valorunitario,
                t.contenedor,
				t.precinto,
				t.agencia,
				t.gastos,
				t.honorarios,
				t.minhonorarios
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
				                ed.valorunitario as valorunitario,
				                ag.agencia,
				                e.gastos,
				                e.honorarios,
				                e.minhonorarios
							from dbexportaciones e
				            inner join dbexportacioncontenedores ec ON e.idexportacion = ec.refexportaciones
				            inner join dbexportaciondetalles ed ON ed.refexportacioncontenedores = ec.idexportacioncontenedor
							inner join dbclientes cli ON cli.idcliente = e.refclientes
							inner join tbbuques buq ON buq.idbuque = e.refbuques
							inner join tbcolores colo ON colo.idcolor = e.refcolores
							inner join tbdestinos des ON des.iddestino = e.refdestinos
							inner join tbpuertos pue ON pue.idpuerto = e.refpuertos
							inner join tbagencias ag ON ag.idagencia = e.refagencias
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
				                ec.tara,
				                ed.valorunitario,
				                ec.contenedor,
                                ec.precinto,
                                ag.agencia,
                                e.gastos,
                                e.honorarios,
                                e.minhonorarios
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
				t.precinto,
				t.agencia,
				t.gastos,
				t.honorarios,
				t.minhonorarios
				order by t.fecha";
	
	$res = $this->query($sql,0);
	return $res;
} 


function traerExportacionesPorId($id) {
$sql = "select idexportacion,refclientes,refbuques,refcolores,refdestinos,refpuertos,permisoembarque,booking,despachante,cuit,fecha,factura,tc,refagencias, gastos, honorarios, minhonorarios from dbexportaciones where idexportacion =".$id;
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

function insertarPuertos($puerto,$bandera,$refdestinos) {
$sql = "insert into tbpuertos(idpuerto,puerto,bandera,refdestinos)
values ('','".($puerto)."','".($bandera)."',".$refdestinos.")";
$res = $this->query($sql,1);
return $res;
}


function modificarPuertos($id,$puerto,$bandera,$refdestinos) {
$sql = "update tbpuertos
set
puerto = '".($puerto)."',bandera = '".($bandera)."',refdestinos = ".$refdestinos."
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
p.bandera,
des.destino,
p.refdestinos
from tbpuertos p
inner join tbdestinos des ON des.iddestino = p.refdestinos
order by 1";
$res = $this->query($sql,0);
return $res;
}

function traerPuertosPorDestino($iddestino) {
	$sql = "select
			p.idpuerto,
			p.puerto,
			p.bandera,
			des.destino,
			p.refdestinos
			from tbpuertos p
			inner join tbdestinos des ON des.iddestino = p.refdestinos
			where p.refdestinos = ".$iddestino."
			order by 1";
	$res = $this->query($sql,0);
	return $res;
}


function traerPuertosPorId($id) {
$sql = "select idpuerto,puerto,bandera,refdestinos from tbpuertos where idpuerto =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbpuertos*/


/* PARA Referentes */

function insertarReferentes($email,$razonsocial) {
$sql = "insert into tbreferentes(idreferente,email,razonsocial)
values ('','".($email)."','".($razonsocial)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarReferentes($id,$email,$razonsocial) {
$sql = "update tbreferentes
set
email = '".($email)."',razonsocial = '".($razonsocial)."'
where idreferente =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarReferentes($id) {
$sql = "delete from tbreferentes where idreferente =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerReferentes() {
$sql = "select
r.idreferente,
r.email,
r.razonsocial
from tbreferentes r
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerReferentesPorId($id) {
$sql = "select idreferente,email,razonsocial from tbreferentes where idreferente =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbreferentes*/


/* PARA Agenciareferentes */

function insertarAgenciareferentes($refagencias,$refreferentes) {
$sql = "insert into dbagenciareferentes(idagenciareferente,refagencias,refreferentes)
values ('',".$refagencias.",".$refreferentes.")";
$res = $this->query($sql,1);
return $res;
}


function modificarAgenciareferentes($id,$refagencias,$refreferentes) {
$sql = "update dbagenciareferentes
set
refagencias = ".$refagencias.",refreferentes = ".$refreferentes."
where idagenciareferente =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarAgenciareferentes($id) {
$sql = "delete from dbagenciareferentes where idagenciareferente =".$id;
$res = $this->query($sql,0);
return $res;
}

function eliminarAgenciareferentesPorAgentes($idagente) {
$sql = "delete from dbagenciareferentes where refagencias =".$idagente;
$res = $this->query($sql,0);
return $res;
}


function traerAgenciareferentes() {
$sql = "select
a.idagenciareferente,
a.refagencias,
a.refreferentes
from dbagenciareferentes a
order by 1";
$res = $this->query($sql,0);
return $res;
}

function traerAgenciareferentesPorAgencia($idagencia) {
$sql = "select
a.idagenciareferente,
a.refagencias,
a.refreferentes
from dbagenciareferentes a
where refagencias = ".$idagencia."
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerAgenciareferentesPorId($id) {
$sql = "select idagenciareferente,refagencias,refreferentes from dbagenciareferentes where idagenciareferente =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbagenciareferentes*/


/* PARA Clientereferentes */

function insertarClientereferentes($refclientes,$refreferentes) {
$sql = "insert into dbclientereferentes(idclientereferente,refclientes,refreferentes)
values ('',".$refclientes.",".$refreferentes.")";
$res = $this->query($sql,1);
return $res;
}


function modificarClientereferentes($id,$refclientes,$refreferentes) {
$sql = "update dbclientereferentes
set
refclientes = ".$refclientes.",refreferentes = ".$refreferentes."
where idclientereferente =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarClientereferentes($id) {
$sql = "delete from dbclientereferentes where idclientereferente =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarClientereferentesPorCliente($idcliente) {
$sql = "delete from dbclientereferentes where refclientes =".$idcliente;
$res = $this->query($sql,0);
return $res;
}


function traerClientereferentes() {
$sql = "select
c.idclientereferente,
c.refclientes,
c.refreferentes
from dbclientereferentes c
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerClientereferentesPorCliente($idcliente) {
$sql = "select
c.idclientereferente,
c.refclientes,
c.refreferentes
from dbclientereferentes c
where c.refclientes = ".$idcliente."
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerClientereferentesPorId($id) {
$sql = "select idclientereferente,refclientes,refreferentes from dbclientereferentes where idclientereferente =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbclientereferentes*/


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




/* PARA Configuracion */

function insertarConfiguracion($razonsocial,$cuit) {
$sql = "insert into tbconfiguracion(idtbconfiguracion,razonsocial,cuit)
values ('','".($razonsocial)."','".($cuit)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarConfiguracion($id,$razonsocial,$cuit) {
$sql = "update tbconfiguracion
set
razonsocial = '".($razonsocial)."',cuit = '".($cuit)."'
where idtbconfiguracion =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarConfiguracion($id) {
$sql = "delete from tbconfiguracion where idtbconfiguracion =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerConfiguracion() {
$sql = "select
c.idtbconfiguracion,
c.razonsocial,
c.cuit
from tbconfiguracion c
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerConfiguracionPorId($id) {
$sql = "select idtbconfiguracion,razonsocial,cuit from tbconfiguracion where idtbconfiguracion =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbconfiguracion*/


/* PARA Agencias */

function insertarAgencias($agencia,$email) {
$sql = "insert into tbagencias(idagencia,agencia,email)
values ('','".($agencia)."','".($email)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarAgencias($id,$agencia,$email) {
$sql = "update tbagencias
set
agencia = '".($agencia)."',email = '".($email)."'
where idagencia =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarAgencias($id) {
$sql = "delete from tbagencias where idagencia =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerAgencias() {
$sql = "select
a.idagencia,
a.agencia,
a.email
from tbagencias a
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerAgenciasPorId($id) {
$sql = "select idagencia,agencia,email from tbagencias where idagencia =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbagencias*/




/***** email ******************/

function enviarEmail($destinatario,$asunto,$cuerpo) {


	# Defina el número de e-mails que desea enviar por periodo. Si es 0, el proceso por lotes
	# se deshabilita y los mensajes son enviados tan rápido como sea posible.
	define("MAILQUEUE_BATCH_SIZE",0);

	//para el envío en formato HTML
	//$headers = "MIME-Version: 1.0\r\n";
	
	// Cabecera que especifica que es un HMTL
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	//dirección del remitente
	$headers .= utf8_decode("From: GUSTAVO OMAR AVILA - PROCOMEX <gustavo@procomex.com.ar>\r\n");
	
	//ruta del mensaje desde origen a destino
	$headers .= "Return-path: ".$destinatario."\r\n";
	
	//direcciones que recibirán copia oculta
	$headers .= "Bcc: gustavo@procomex.com.ar\r\n";
	
	mail($destinatario,$asunto,$cuerpo,$headers); 	
}



function enviarEmailPrueba() {

	$destinatario = "msredhotero@msn.com, msredhotero@gmail.com";

	$asunto = 'Prueba de Envio de Email - PROCOMEX';

	$cuerpo = '<h4>No responder</h4>';
	# Defina el número de e-mails que desea enviar por periodo. Si es 0, el proceso por lotes
	# se deshabilita y los mensajes son enviados tan rápido como sea posible.
	define("MAILQUEUE_BATCH_SIZE",0);

	//para el envío en formato HTML
	//$headers = "MIME-Version: 1.0\r\n";
	
	// Cabecera que especifica que es un HMTL
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	//dirección del remitente
	$headers .= utf8_decode("From: GUSTAVO OMAR AVILA - PROCOMEX <gustavo@procomex.com.ar>\r\n");
	
	//ruta del mensaje desde origen a destino
	$headers .= "Return-path: ".$destinatario."\r\n";
	
	//direcciones que recibirán copia oculta
	$headers .= "Bcc: gustavo@procomex.com.ar, msredhotero@msn.com\r\n";
	
	mail($destinatario,$asunto,$cuerpo,$headers); 	
}

function enviarEmailDePermisos($id) {
	$sql = "SELECT DISTINCT
			    t.email
			FROM
			    (SELECT 
			        ag.email
			    FROM
			        tbagencias ag
			    INNER JOIN dbexportaciones e ON e.refagencias = ag.idagencia
			    WHERE
			        e.idexportacion = ".$id." and ag.email <> '' AND ag.email IS NOT NULL
			            AND ag.email LIKE '%@%' 
			    UNION ALL SELECT 
			        email
			    FROM
			        dbclientes c
			    INNER JOIN dbexportaciones e ON e.refclientes = c.idcliente
			    WHERE
			        e.idexportacion = ".$id." and c.email <> '' AND c.email IS NOT NULL
			            AND c.email LIKE '%@%' 
			    UNION ALL SELECT 
			        r.email
			    FROM
			        tbagencias ag
			    INNER JOIN dbexportaciones e ON e.refagencias = ag.idagencia
			    INNER JOIN dbagenciareferentes ar ON ar.refagencias = ag.idagencia
			    INNER JOIN tbreferentes r ON r.idreferente = ar.refreferentes
			    WHERE
			        e.idexportacion = ".$id." and r.email <> '' AND r.email IS NOT NULL
			            AND r.email LIKE '%@%' 
			    UNION ALL SELECT 
			        r.email
			    FROM
			        dbclientes c
			    INNER JOIN dbexportaciones e ON e.refclientes = c.idcliente
			    INNER JOIN dbclientereferentes cr ON cr.refclientes = c.idcliente
			    INNER JOIN tbreferentes r ON r.idreferente = cr.refreferentes
			    WHERE
			        e.idexportacion = ".$id." and r.email <> '' AND r.email IS NOT NULL
			            AND r.email LIKE '%@%') t";
	
	$res = $this->query($sql,0);

	return $res;


}



/***** fin email **************/



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

/*
function enviar_correo($destinatarios, $mail_asunto, $mail_contendio, $from, $from_name, $archivos_adjuntos_ruta,$archivos_adjuntos_temp){
	$mail= new PHPMailer(); // defaults to using php "mail()"
	$mail->CharSet = 'UTF-8';
	$body= $mail_contendio;
	$mail->IsSMTP(); // telling the protocol to use SMTP
	$mail->Host = "tu.host.com"; // SMTP server
	$mail->From = $from;
	$mail->FromName = $from_name;
	$mail->Subject = $mail_asunto;
	$mail->MsgHTML($body);
	$destinatarios=explode(",", $destinatarios);
	if(!empty($destinatarios)){
	foreach($destinatarios as $un_destinatario){
	$mail->AddAddress($un_destinatario); //destinatarios
	}
	}else{
	return false;
	}
	if(!empty($archivos_adjuntos_ruta)){
	foreach($archivos_adjuntos_ruta as $archivo){
	$mail->AddAttachment($archivo); // attachment
	}
	}
	if(!empty($archivos_adjuntos_temp)){
	foreach($archivos_adjuntos_temp as $nombrearchivo=>$contenidoArchivo){
	$mail->AddStringAttachment($contenidoArchivo,$nombrearch ivo,'base64');
	}
	}
	$mail->Timeout = 20;
	if($mail->Send()) {
	return array(true);
	}else {
	return array(false,"Mailer Error: ".$mail->ErrorInfo);
	}
}
$archivos_adjuntos_ruta=array($path1,path2);
$archivos_adjuntos_temp=array(utf8_decode($strfile PDF)=>$strContenidoPdf,utf8_decode($strNomArch)=>$ strContenidoXml);
enviar_correo(...,array(),archivos_adjuntos_temp);//los archivos estan en variables temporales
enviar_correo(...,$archivos_adjuntos_ruta,array()) ;//los archivos estan en rutas en disco
enviar_correo(...,$archivos_adjuntos_ruta,archivos _adjuntos_temp);//ambas opciones al mismo tiempo
*/


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