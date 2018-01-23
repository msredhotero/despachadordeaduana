select
((t.totalgral *  coalesce(t.porcentajereparto,1) / 100) - (t.totalgral * coalesce(t.porcentajeretencion,1) / 100)) / op.puntos
from (

	select
	sum(r.total - (r.valorpulicidad + r.costopapelentrada + r.gastotarjeta + r.argentores)) as totalgral, r.idobra,r.porcentajereparto,	r.porcentajeretencion
	from (	
		
		SELECT 
			total, 
			o.valorpulicidad,
			round((o.valorticket * v.cantidad),2) as costopapelentrada, 
			round((o.costotranscciontarjetaiva / 100 * v.totaltarjeta),2) as gastotarjeta, 
			round((o.porcentajeargentores / 100 * v.total),2) as argentores,
			o.idobra,
			o.porcentajereparto,
			o.porcentajeretencion

		FROM dbventas v
		inner join dbfunciones fu on fu.idfuncion = v.reffunciones
		inner join dbobras o on o.idobra = fu.refobras
		where fu.idfuncion = 40) as r

	group by r.idobra,r.porcentajereparto,	r.porcentajeretencion
    ) as t
    inner join (SELECT 
					sum(cp.puntos) as puntos, o.idobra
				FROM
					dbpersonal p
						INNER JOIN
					dbpersonalcooperativas cp ON p.idpersonal = cp.refpersonal
						INNER JOIN
					dbcooperativas c ON c.idcooperativa = cp.refcooperativas
						INNER JOIN
					dbobrascooperativas oc ON oc.refcooperativas = c.idcooperativa
						INNER JOIN
					dbobras o ON o.idobra = oc.refobras
						INNER JOIN
					dbfunciones fu ON o.idobra = fu.refobras and fu.refcooperativas = c.idcooperativa
						INNER JOIN
					tbdias di ON di.iddia = fu.refdias
				where fu.idfuncion = 40
                group by o.idobra) op on op.idobra = t.idobra