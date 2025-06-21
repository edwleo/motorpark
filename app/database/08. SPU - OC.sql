USE motorpark;

-- REGLAS:
-- 	1. emision 		: Será la fecha actual
--  2. estado 		: "emitido" como valor por defecto
--  3. numstock		: puede quedar NULL
--  4. observaciones: puede quedar NULL
DELIMITER $$
CREATE PROCEDURE spu_oc_registrar
(
	IN _idtienda		INT,
    IN _idlogistica		INT,
    IN _moneda			CHAR(3),
    IN _serie 			CHAR(4),
    IN _numstock 		VARCHAR(20),
    IN _observaciones	VARCHAR(400)
)
BEGIN
    INSERT INTO ordenescompra (idtienda, idlogistica, moneda, serie, emision, numstock, observaciones, estado) 
		VALUES (
			_idtienda,
            _idlogistica, 
            _moneda,
            _serie,
            NOW(),
            NULLIF(_numstock, ''),
            NULLIF(_observaciones, ''),
            'emitido'
        );
	SELECT last_insert_id() AS 'last_id';
END $$
