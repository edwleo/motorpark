USE yondaapp;



INSERT INTO marcas (marca) VALUES
	('Nissan'),
    ('Hyundai'),
    ('KIA'),
    ('Toyota'),
    ('Chevrolet'),
    ('Hero'),
    ('Bajaj'),
    ('Geely'),
	('Jettor');

INSERT INTO marcas (marca) VALUES
	('Pulsar'),
    ('Changan'),
    ('Jetour'),
    ('Suzuki'),
    ('Volkswagen'),
    ('Chery'),
    ('Haval'),
    ('Honda'),
    ('JAC'),
    ('Great Wall');

-- Agregamos datos predominantes
-- Información obtenida desde: https://www.bridgestone.com.mx/tips-bridgestone/tecnologia-de-llantas/que-tipos-de-carroceria-existen/
INSERT INTO tipovehiculos (tipovehiculo) VALUES 
	('SUV'),
    ('Sedán'),
    ('Hatchback'),
    ('Pickup'),
    ('Minivan'),
    ('Moto lineal'),
    ('Moto taxi');



-- Datos de prueba (KIA)
INSERT INTO modelos (idtipovehiculo, idmarca, modelo) VALUES 
	(3, 3, 'New Picanto'),
    (2, 3, 'Soluto'),
    (3, 3, 'All new K3'),
    (1, 3, 'Sportage'),
    (1, 3, 'New Seltos'),
    (1, 3, 'New Sorento');

-- Datos de prueba HYUNDAI
INSERT INTO modelos (idtipovehiculo, idmarca, modelo) VALUES
	(3, 2, 'Grand i10'),
    (3, 2, 'New i20'),
    (2, 2, 'Accent'),
    (2, 2, 'i10 Sedan'),
    (2, 2, 'Elantra'),
    (1, 2, 'Tucson'),
    (1, 2, 'Creta'),
    (1, 2, 'Creta Grand'),
    (1, 2, 'Santa Fe');

-- Datos de prueba NISSAN
INSERT INTO modelos (idtipovehiculo, idmarca, modelo) VALUES
	(1, 1, 'Kicks'),
    (1, 1, 'Qashqai'),
    (1, 1, 'X-Trail'),
    (4, 1, 'Frontier'),
    (2, 1, 'Sentra'),
    (2, 1, 'Versa');
    
    
    
-- Estos requisitos son independients del tipo de cotización
INSERT INTO requisitos (requisito) VALUES
	('Fotocopia DNI titular y cónyugue'), -- 1
    ('Copia del último recibo pagado de servicios (luz o agua)'), -- 2
    ('Copia simple de vivienda (titulado de propiedad/certificado de posesión, copia literal)'), -- 3
    ('Boletas de pago'), -- 4
    ('DNI Aval (DNI cónyugue de ser necesario)'), -- 5
    ('Evaluación de gastos familiares'), -- 6
    ('30% de inicial como mínimo (aumenta según el precio de la unidad)'), -- 7
    ('Verificación domiciliaria y laboral'), -- 8
    ('Pago único por gastos administrativos'), -- 9
    ('Seguro vehicular (bajo evaluación)'), -- 10
    ('GPS Satelital'), -- 11
	('Declaración jurada de ingresos'), -- 12
	('Licencia de conducir'), -- 13
    ('Recibo de servicios'), -- 14
    ('Record de papeletas'); -- 15


-- Creamos el formato para el cliente independiente
INSERT INTO formatocotizacion (tipocotizacion, fechainicio, fechafin) VALUES 
	('Dependiente', '2024-06-01', null),
    ('Independiente formal', '2024-06-01', null),
    ('Independiente informal', '2024-06-01', null);
    
-- Requisitos para el CLIENTE DEPENDIENTE (Personas naturales)
INSERT INTO detallerequisitos (idformato, idrequisito) VALUES
	(1, 1),
    (1, 2),
    (1, 3),
    (1, 4),
    (1, 5),
    (1, 6),
    (1, 7),
    (1, 8),
    (1, 9),
    (1, 10),
    (1, 11);

-- Requisitos para cliente INDEPENDIENTE FORMAL (Empresas/pymes)
INSERT INTO detallerequisitos (idformato, idrequisito) VALUES
	(2, 1),
    (2, 2),
    (2, 3),
    (2, 12),
    (2, 13),
    (2, 14),
    (2, 15),
    (2, 5),
    (2, 6),
    (2, 7),
    (2, 8),
    (2, 9),
    (2, 10),
    (2, 11);

-- Requisitos para cliente INDEPENDIENTE INFORMAL (negocios personales/taxistas)
INSERT INTO detallerequisitos (idformato, idrequisito) VALUES
	(3, 1),
    (3, 2),
    (3, 3),
    (3, 12),
    (3, 13),
    (3, 15),
    (3, 5),
    (3, 6),
    (3, 7),
    (3, 8),
    (3, 9),
    (3, 10),
    (3, 11);





/*
ACERCA DE: "ESTADOCOTIZACION" y su relación con el VEHÍCULO:
	[P]endiente		: Cuando se crea la cotización y está pendiente de PAGO y REVISIÓN (área de crédito)
					  VEHICULO	: Libre
    [E]valuación	: El cliente realizó el pago por concepto de ADELANTO, ahora el área de crédito puede proceder con la evaluación
					  VEHICULO	: Separado
    [A]probada		: El área de crédito realizó la evaluación
					  VEHICULO	: Separado
    [C]ancelada		: El cliente voluntariamente desiste, se cobrará un monto por penalidad
					  VEHICULO	: Libre
    [R]echazada		: El analista de CRÉDITO determina que no cumple las condiciones, se retorna el dinero sin penalidad
					  VEHICULO	: Libre
*/


-- Agregamos algunas entidades para prueba
INSERT INTO entidadespago (entidad, moneda, numcuenta) VALUES
	('BCP', 'PEN', '001-002-003-004'),
    ('BBVA', 'PEN', '001-002-003-004'),
    ('YAPE', 'PEN', '956111222'),
    ('PLIN', 'PEN', '956111333'),
	('EFECTIVO', 'PEN', NULL);
