USE motorpark;

-- Datos de prueba
INSERT INTO marcas 
	(marca) VALUES
		('BMW'), -- 1
        ('CHANGAN'), -- 2
        ('CHERY'), -- 3
        ('CHEVROLET'), -- 4
        ('DFSK'), -- 5
        ('DONGFENG'), -- 6
        ('FORD'), -- 7
        ('GEELY'), -- 8
        ('GREAT WALL'), -- 9
        ('HAVAL'), -- 10
        ('HONDA'), -- 11
        ('HYUNDAI'), -- 12
        ('JAC'), -- 13
        ('JETOUR'), -- 14
        ('KIA'), -- 15
        ('MAZDA'), -- 16
        ('MERCEDES BENZ'), -- 17
        ('NISSAN'), -- 18
        ('RENAULT'), -- 19
        ('SSANGYONG'), -- 20
        ('TOYOTA'); -- 21


INSERT INTO tipovehiculos 
	(tipovehiculo) VALUES
		('Sedan'), -- 1
        ('SUV'), -- 2
        ('Hatchback'), -- 3
        ('Station wagon'), -- 4
        ('Pickup'), -- 5
        ('Coupé'), -- 6
        ('Van'), -- 7
        ('Camión ligero'), -- 8
		('Motolineal'), -- 9
        ('Motocarga'), -- 10
   		('Mototaxi'); -- 11


-- Modelo para las marcas más comunes: 
-- GEELY (PK: 8)
INSERT INTO modelos
	(idmarca, idtipovehiculo, modelo, anio) 
    VALUES	
		(8, 1, 'Emgrand', '2025'), -- Sedan
        (8, 2, 'Cityray', '2025'), -- SUV
        (8, 2, 'CX3 Pro', '2025'), -- SUV
        (8, 2, 'Coolray', '2025'), -- SUV
        (8, 2, 'New Starray', '2025'); -- SUV

-- HAVAL (PK: 10)
INSERT INTO modelos
	(idmarca, idtipovehiculo, modelo) 
    VALUES	
		(10, 2, 'New Jolion'), -- SUV
        (10, 2, 'H6'), -- SUV
		(10, 2, 'Jolion pro'), -- SUV
        (10, 2, 'Dargo'), -- SUV
		(10, 2, 'H6 GT'), -- SUV
        (10, 2, 'Jolion Híbrido'), -- SUV
		(10, 2, 'H6 Híbrido'); -- SUV

-- HYUNDAI (PK: 12)
INSERT INTO modelos
	(idmarca, idtipovehiculo, modelo) 
    VALUES	
		(12, 3, 'Grand i10'), -- Hatchback
        (12, 3, 'i20 Hatch'), -- Hatchback
        (12, 1, 'Grand i10 Sedan') , -- Sedan
        (12, 1, 'Accent') , -- Sedan
        (12, 1, 'Elantra') , -- Sedan
        (12, 2, 'Venue'), -- SUV
        (12, 2, 'Creta'), -- SUV
        (12, 2, 'Creta Grand'), -- SUV
        (12, 2, 'Kona'), -- SUV
        (12, 2, 'Tucson'), -- SUV
        (12, 2, 'Santa Fe'), -- SUV
        (12, 2, 'Palisade'); -- SUV

-- KIA (PK: 15)
INSERT INTO modelos
	(idmarca, idtipovehiculo, modelo) 
    VALUES	
		(15, 1, 'All-new K3'), -- Sedan
        (15, 1, 'Soluto'), -- Sedan
        (15, 3, 'Picanto'), -- Hatchback
        (15, 2, 'Sorento'), -- SUV
        (15, 2, 'K3 Cross'), -- SUV
        (15, 2, 'Carnival'), -- SUV
        (15, 2, 'Seltos'), -- SUV
        (15, 2, 'Sonet'), -- SUV
        (15, 2, 'Carens'), -- SUV
        (15, 2, 'Sportage'); -- SUV

-- Todos los modelos registrados de prueba serán 2025
UPDATE modelos SET anio = '2025';

INSERT INTO areas (area) VALUES 
	('Sistemas'),
    ('Recursos Humanos'),
    ('Contabilidad'),
    ('Marketing'),
    ('Ventas'),
    ('Caja'),
    ('Cobranza'),
    ('Legal');

INSERT INTO cargos (idarea, cargo) 
	VALUES 
		(1, 'Jefe de sistemas'),
        (1, 'Analista desarrollador'),
        (1, 'Practicante');


INSERT INTO personas 
	(
		apellidos, nombres, tipodoc, nrodoc, genero, fechanac, estadocivil, email, iddistrito, 
		direccion, referencia, telprimario, telalternativo
	) 
    VALUES
	(
		'Francia Minaya', 'Jhon Edward', 'DNI', '45406071', 'M', '1984-09-20', 'CAS', 'sistemas@yondaperu.com', '1012',
        'Upis Felix Amoretti Mz G Lote 19', 'Cerca loza deportiva', '956834915', NULL
    );

INSERT INTO contratoslaborales 
	(idpersona, idcargo, fechainicio, fechafin, tipocontrato) 
	VALUES 
		(1, 1, '2024-06-01', NULL, 'R');

-- Verificando datos del contrato
/*
SELECT
	CO.idcontratolaboral,
	PE.apellidos, PE.nombres,
    CA.cargo,
    CO.fechainicio, 
    CO.fechafin,
    CO.tipocontrato
	FROM contratoslaborales CO
    INNER JOIN personas PE ON CO.idpersona = PE.idpersona
    INNER JOIN cargos CA ON CA.idcargo = CO.idcargo;
*/

-- Cuenta para Jhon Francia, clave: YONDA2025
INSERT INTO colaboradores (idcontratolaboral, usernick, userpassword, avatar) 
	VALUES 
		(1, 'jhonfm', '$2y$10$GpQTuV8A8UPRul2E1E1OeOrhAb7842wa1cfB3bNieXncYTk2S1NTC', NULL);


INSERT INTO ordenescompra 
	(idtienda, idlogistica, moneda, serie, emision, aprobacion, presentacion, anulacion, numstock, observaciones, estado) 
    VALUES 
    (16, 1, 'USD', '2025', '2025-04-07', '2025-04-08', '2025-04-08', NULL, NULL, NULL, 'emitido');

SELECT * FROM concesionarios;
SELECT * FROM modelos;
SELECT * FROM vehiculos;