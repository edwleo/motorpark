USE motorpark;

DELIMITER $$
DROP PROCEDURE IF EXISTS `spu_modelos_obtener_por_marca`;
CREATE PROCEDURE spu_modelos_obtener_por_marca(IN _idmarca INT)
BEGIN
	SELECT
		MD.idmodelo,
		TV.tipovehiculo,
		MD.modelo, MD.anio, MD.imagenreferencial
		FROM modelos MD
		INNER JOIN tipovehiculos TV ON TV.idtipovehiculo = MD.idtipovehiculo
		WHERE MD.idmarca = _idmarca
        ORDER BY TV.tipovehiculo, MD.modelo;
END $$


-- Obtiene una lista de marcas y la cantidad de modelos registrados
SELECT
	MR.idmarca, MR.marca, COUNT(MD.idmodelo) 'modelos'
	FROM marcas MR
    LEFT JOIN modelos MD ON MD.idmarca = MR.idmarca
    GROUP BY MR.idmarca, MR.marca;


SELECT idtipovehiculo, tipovehiculo FROM tipovehiculos ORDER BY tipovehiculo;