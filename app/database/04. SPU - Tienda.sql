USE motorpark;

DELIMITER $$
CREATE PROCEDURE spu_tiendas_por_concesionario(IN _idconcesionario INT)
BEGIN
    SELECT
		TD.idtienda,
        CONCAT(DP.departamento, ', ', PR.provincia, ', ', DS.distrito) AS 'ubigeo',
        TD.direccion,
        TD.email,
        TD.telefono,
        TD.contacto
		FROM tiendas TD
        INNER JOIN distritos DS ON DS.iddistrito = TD.iddistrito
        INNER JOIN provincias PR ON PR.idprovincia = DS.idprovincia
        INNER JOIN departamentos DP ON DP.iddepartamento = PR.iddepartamento
        WHERE TD.idconcesionario = _idconcesionario;
END $$

DELIMITER $$
CREATE PROCEDURE spu_tiendas_obtener(IN _idtienda INT)
BEGIN
SELECT
	TD.idtienda,
	DP.iddepartamento, PR.idprovincia, DS.iddistrito,
	TD.direccion,
	TD.email,
	TD.telefono,
	TD.contacto
	FROM tiendas TD
	INNER JOIN distritos DS ON DS.iddistrito = TD.iddistrito
	INNER JOIN provincias PR ON PR.idprovincia = DS.idprovincia
	INNER JOIN departamentos DP ON DP.iddepartamento = PR.iddepartamento
	WHERE TD.idtienda = _idtienda;
END $$

call spu_tiendas_obtener(1);
