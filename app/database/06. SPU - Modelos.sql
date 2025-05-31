USE motorpark;

DELIMITER $$
DROP PROCEDURE IF EXISTS `spu_modelos_obtener_por_marca`;
CREATE PROCEDURE spu_modelos_obtener_por_marca(IN _idmarca INT)
BEGIN
	SELECT
		MD.idmodelo,
		TV.tipovehiculo,
		MD.modelo, modelos.anio, MD.imagenreferencial
		FROM modelos MD
		INNER JOIN tipovehiculos TV ON TV.idtipovehiculo = MD.idtipovehiculo
		WHERE MD.idmarca = _idmarca
        ORDER BY TV.tipovehiculo, MD.modelo;
END $$

-- CALL spu_modelos_obtener_por_marca(8)