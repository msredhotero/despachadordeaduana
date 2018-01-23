SELECT 
    sum(cp.puntos)
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
where o.idobra =1 and fu.idfuncion = 40
ORDER BY o.nombre