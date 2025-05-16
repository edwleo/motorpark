USE motorpark;

-- La eliminación deberá evaluar si el concesionario posee una tienda que haya sido utilizada 
-- en una orden de compra de ser así, no se podrá proceder a su eliminación
DELIMITER $$
CREATE PROCEDURE spu_concesionarios_obtener_oc
(
	IN  _idconcesionario INT,
    OUT _registros 		 INT
)
BEGIN
	SET _registros = 
		(
        SELECT COUNT(*) 
		FROM ordenescompra 
        WHERE idtienda IN 
			(SELECT idtienda FROM tiendas WHERE idconcesionario = _idconcesionario)
		);
END $$

SELECT * FROM tiendas;