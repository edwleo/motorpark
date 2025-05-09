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
        ('TOYOTA'), -- 21
        ('VOLKSWAGEN'), -- 22
        ('VOLVO'); -- 23

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
        ('Motocarga'); -- 10

-- Modelo para las marcas más comunes: 
-- GEELY (PK: 8)
INSERT INTO modelos
	(idmarca, idtipovehiculo, modelo) 
    VALUES	
		(8, 1, 'Emgrand'), -- Sedan
        (8, 2, 'Cityray'), -- SUV
        (8, 2, 'CX3 Pro'), -- SUV
        (8, 2, 'Coolray'), -- SUV
        (8, 2, 'New Starray'); -- SUV

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

SELECT * FROM modelos;
SELECT * FROM modelos WHERE idmarca = 8 AND idtipovehiculo = 2;

delete from concesionarios;
alter table concesionarios auto_increment 1;
SELECT * FROM concesionarios;
SELECT * FROM tiendas;

SELECT * FROM tiendas;