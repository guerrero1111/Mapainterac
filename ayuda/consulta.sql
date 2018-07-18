insert into mapa_catalogo_pais (pais)
select pais from 
	(select pais
	from (
		SELECT pais FROM `mapa_catalogo_importacion` 
		union all
		SELECT pais FROM `mapa_catalogo_exportacion` 
	) aa
	group by aa.pais
	) bb


//////////////
ALTER TABLE  `mapa_catalogo_exportacion` ADD  `id_pais` INT NOT NULL AFTER  `pais` ;
ALTER TABLE  `mapa_catalogo_importacion` ADD  `id_pais` INT NOT NULL AFTER  `pais` ;
//////////////

UPDATE mapa_catalogo_exportacion as e 
inner join mapa_catalogo_pais as m on e.pais=m.pais 
SET 
	e.id_pais = m.id

//////////////////////

UPDATE mapa_catalogo_importacion as e 
inner join mapa_catalogo_pais as m on e.pais=m.pais 
SET 
	e.id_pais = m.id
	

//////////////////////

SELECT puerto FROM `mapa_catalogo_importacion` where puerto="Altamira" or puerto="Manzanillo" or puerto="Veracruz"
SELECT * FROM `mapa_catalogo_exportacion` where puerto="Altamira" or puerto="Manzanillo" or puerto="Veracruz"
SELECT * FROM `mapa_catalogo_puerto` where puerto="Altamira" or puerto="Manzanillo" or puerto="Veracruz"

/////////////////////////////
UPDATE mapa_catalogo_importacion as e 
inner join mapa_catalogo_puerto as m on e.pto_destino=m.puerto
SET 
	e.id_destino = m.id



UPDATE mapa_catalogo_puerto as e 
inner join (
	select puerto , city,  city_ascii, 	 lat, 	 lng, 	 pop, 	 country, 	 iso2, 	 iso3, 	 province from (
				SELECT puerto , city,  city_ascii, 	 lat, 	 lng, 	 pop, 	 country, 	 iso2, 	 iso3, 	 province  FROM `mapa_catalogo_importacion` 
						union all
				SELECT puerto , city,  city_ascii, 	 lat, 	 lng, 	 pop, 	 country, 	 iso2, 	 iso3, 	 province  FROM `mapa_catalogo_exportacion` 
	   ) bb
	group by puerto
) as m on e.puerto=m.puerto
SET 
	e.city = m.city, 
	e.city_ascii = m.city_ascii, 
	e.lat = m.lat, 
	e.lng = m.lng, 
	e.pop = m.pop, 
	e.country = m.country, 
	e.iso2 = m.iso2, 
	e.iso3 = m.iso3, 
	e.province= m.province




/*////////////////////

UPDATE mapa_catalogo_exportacion as e 
inner join mapa_catalogo_mundo as m on e.pto_destino=m.city and e.city_ascii is null


//////////////////////////////////



SELECT pto_destino FROM `mapa_catalogo_importacion` group by `pto_destino`;
SELECT pto_destino FROM `mapa_catalogo_exportacion` group by `pto_destino`;

SELECT puerto FROM `mapa_catalogo_exportacion` where puerto="Altamira" or puerto="Manzanillo
" or puerto="Veracruz"
SELECT puerto FROM `mapa_catalogo_importacion` where puerto="Altamira" or puerto="Manzanillo
" or puerto="Veracruz" 

SELECT puerto FROM `mapa_catalogo_importacion` group by `puerto`
union all
SELECT puerto FROM `mapa_catalogo_exportacion` group by `puerto`;


insert into mapa_catalogo_puerto (puerto)
select puerto from 
	(select puerto
	from (
		SELECT puerto FROM `mapa_catalogo_importacion` 
		union all
		SELECT puerto FROM `mapa_catalogo_exportacion` 
	)
	group by `puerto`
	) bb

insert into mapa_catalogo_puerto (puerto)
select puerto from (
			SELECT puerto FROM `mapa_catalogo_importacion` 
					union all
			SELECT puerto FROM `mapa_catalogo_exportacion` 
   ) bb
group by puerto


insert into mapa_catalogo_pais (pais)

CREATE TABLE IF NOT EXISTS `mapa_catalogo_pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pais` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;




/////////////////////////////


SELECT * 
FROM mapa_catalogo_exportacion AS e
inner join mapa_catalogo_mundo as m on e.pto_destino=m.city_ascii and e.city_ascii is null

and e.city_ascii is null


UPDATE mapa_catalogo_exportacion as e 
inner join mapa_catalogo_mundo as m on e.pto_destino=m.city and e.city_ascii is null
SET 
	e.city = m.city, 
	e.city_ascii = m.city_ascii, 
	e.lat = m.lat, 
	e.lng = m.lng, 
	e.pop = m.pop, 
	e.country = m.country, 
	e.iso2 = m.iso2, 
	e.iso3 = m.iso3, 
	e.province= m.province

 


SELECT * 
FROM  `mapa_catalogo_mundo` 
WHERE country =  "tanzania"
LIMIT 0 , 830


SELECT * 
FROM  `mapa_catalogo_mundo` 
WHERE city =  "Djibouti"




SELECT m.id,e.pto_destino,m.city,e.pais,m.province 
FROM mapa_catalogo_importacion as e
inner join mapa_catalogo_mundo as m on e.pto_destino=m.city
group by m.id

SELECT m.id, e.puerto, count(*) as cantidad FROM mapa_catalogo_importacion as e
inner join mapa_catalogo_mundo as m on e.puerto=m.city
group by e.id
having cantidad>=2
order by cantidad desc




Sydney
Dublin
Cartagena
San Antonio
Barcelona
Melbourne
Dublin




SELECT * 
FROM  `mapa_catalogo_importacion` 
WHERE puerto =  "Barcelona"


SELECT * 
FROM  `mapa_catalogo_mundo` 
WHERE city =  "Barcelona"





SELECT e.pto_destino,m.city,e.pais,m.province FROM mapa_catalogo_exportacion as e
inner join mapa_catalogo_mundo as m on e.pto_destino=m.province



//133
SELECT  pais ,  puerto 
FROM  mapa_catalogo_importacion 
GROUP BY  puerto 
LIMIT 0 , 30




SELECT  pais ,  puerto, pto_destino 
FROM  mapa_catalogo_importacion 
GROUP BY  pto_destino 
LIMIT 0 , 30