CREATE DATABASE motorpark;
USE motorpark;

-- Necesitaremos de una función que calcula la hora actual, esto será 
-- útil cuando la aplicación se aloje en un servidor remoto
/*
DELIMITER $$
CREATE FUNCTION GETDATE()
RETURNS DATETIME
DETERMINISTIC
BEGIN
    RETURN NOW() - INTERVAL 5 HOUR;
END $$
DELIMITER ;
*/

-- Tabla controlar los de las personas y su acceso al sistema
CREATE TABLE departamentos
(
	iddepartamento		INT PRIMARY KEY AUTO_INCREMENT,
    departamento	 	VARCHAR(150) 	NOT NULL
)ENGINE = INNODB;

CREATE TABLE provincias
(
	idprovincia			INT PRIMARY KEY AUTO_INCREMENT,
    iddepartamento		INT 			NOT NULL,
    provincia 			VARCHAR(150) 	NOT NULL,
    CONSTRAINT uk_iddepartamento_pro FOREIGN KEY (iddepartamento) REFERENCES departamentos (iddepartamento)
)ENGINE = INNODB;

CREATE TABLE distritos
(
	iddistrito 			INT PRIMARY KEY AUTO_INCREMENT,
    idprovincia 		INT 			NOT NULL,
    distrito			VARCHAR(150) 	NOT NULL,
    ubigeoinei 			VARCHAR(12) 	NOT NULL,
    CONSTRAINT fk_idprovincia_dis FOREIGN KEY (idprovincia) REFERENCES provincias (idprovincia)
)ENGINE = INNODB;

CREATE TABLE personas
(
	idpersona 			INT PRIMARY KEY AUTO_INCREMENT,
    apellidos 			VARCHAR(70) 	NOT NULL,
    nombres 			VARCHAR(70)		NOT NULL,
    tipodoc 			ENUM('DNI', 'CEX', 'PAS') NOT NULL DEFAULT 'DNI',
    nrodoc	 			VARCHAR(12) 	NOT NULL,
    genero 				ENUM('M', 'F')	NOT NULL,
    fechanac 			DATE 			NULL,
    estadocivil 		ENUM('SOL', 'CAS', 'VDO', 'DVC', 'CNV') NULL COMMENT 'Soltero, casado, viudo, divorciado y conviviente',
    email 				VARCHAR(150)	NULL,
    iddistrito 			INT 			NULL,
    direccion			VARCHAR(200) 	NULL,
    referencia 			VARCHAR(200) 	NULL,
    telprimario 		CHAR(9) 		NOT NULL,
    telalternativo 		CHAR(9) 		NULL,
	creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT uk_nrodoc UNIQUE (tipodoc, nrodoc),
    CONSTRAINT fk_iddistrito_per FOREIGN KEY (iddistrito) REFERENCES distritos (iddistrito) 
)ENGINE = INNODB;

CREATE TABLE areas
(
	idarea 				INT AUTO_INCREMENT PRIMARY KEY,
    area 				VARCHAR(40) 	NOT NULL,
	creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT uk_area_are UNIQUE (area)
)ENGINE = INNODB;

CREATE TABLE cargos
(
	idcargo				INT AUTO_INCREMENT PRIMARY KEY,
    idarea				INT 			NOT NULL,
    cargo				VARCHAR(40) 	NOT NULL,
	creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT fk_idarea_car FOREIGN KEY (idarea) REFERENCES areas (idarea)
)ENGINE = INNODB;

CREATE TABLE contratoslaborales
(
	idcontratolaboral	INT AUTO_INCREMENT PRIMARY KEY,
    idpersona 			INT 			NOT NULL,
    idcargo 			INT 			NOT NULL,
    fechainicio			DATE 			NOT NULL,
    fechafin 			DATE 			NULL,
    tipocontrato 		ENUM('P', 'R') NOT NULL COMMENT 'Planilla - Recibos',
	creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT fk_idpersona_cla FOREIGN KEY (idpersona) REFERENCES personas (idpersona),
    CONSTRAINT fk_idcargocla FOREIGN KEY (idcargo) REFERENCES cargos (idcargo)
)ENGINE = INNODB;

CREATE TABLE colaboradores
(
	idcolaborador 		INT AUTO_INCREMENT PRIMARY KEY,
    idcontratolaboral	INT 			NOT NULL,
    usernick 			VARCHAR(40) 	NOT NULL,
    userpassword 		VARCHAR(70) 	NOT NULL,
    avatar 				VARCHAR(150) 	NULL,
    ultimoacceso 		DATETIME 		NULL,
    habilitado			ENUM('S', 'N') 	NOT NULL DEFAULT 'S',
	creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT fk_idcontratolaboral_col FOREIGN KEY (idcontratolaboral) REFERENCES contratoslaborales (idcontratolaboral),
    CONSTRAINT uk_usernick_col UNIQUE (usernick)
)ENGINE = INNODB;

CREATE TABLE concesionarios
(
	idconcesionario 	INT AUTO_INCREMENT PRIMARY KEY, 
    ruc 				CHAR(11) 		NOT NULL,
    razonsocial			VARCHAR(350)	NOT NULL,
    nombrecomercial		VARCHAR(150) 	NOT NULL,
	creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT uk_ruc_con UNIQUE (ruc)
)ENGINE = INNODB;

CREATE TABLE tiendas
(
	idtienda 			INT AUTO_INCREMENT PRIMARY KEY,
    iddistrito			INT 			NOT NULL,
    idconcesionario		INT 			NOT NULL,
    direccion			VARCHAR(300)	NULL,
    email				VARCHAR(200) 	NULL,
    telefono 			VARCHAR(12) 	NOT NULL,
    contacto 			VARCHAR(100)	NULL,
	creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT fk_iddistrito_tnd FOREIGN KEY (iddistrito) REFERENCES distritos (iddistrito),
    CONSTRAINT fk_idconcesionario_tnd FOREIGN KEY (idconcesionario) REFERENCES concesionarios (idconcesionario)
)ENGINE = INNODB;

CREATE TABLE marcas
(
	idmarca 			INT AUTO_INCREMENT PRIMARY KEY,
    marca				VARCHAR(40) 	NOT NULL,
	creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT uk_marca_mar UNIQUE (marca)
)ENGINE = INNODB;

CREATE TABLE tipovehiculos
(
	idtipovehiculo		INT AUTO_INCREMENT PRIMARY KEY,
    tipovehiculo 		VARCHAR(40) 	NOT NULL,
	creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT uk_tipovehiculo_tve UNIQUE (tipovehiculo)
)ENGINE = INNODB;

-- El unique para modelos debe ser tipovehiculo + marca + año
CREATE TABLE modelos
(
	idmodelo 			INT AUTO_INCREMENT PRIMARY KEY,
    idtipovehiculo		INT 			NOT NULL,
    idmarca 			INT 			NOT NULL,
    modelo 				VARCHAR(40) 	NOT NULL,
    anio 				CHAR(4) 		NOT NULL,
    imagenreferencial 	VARCHAR(200)	NULL,
	creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT fk_idtipovehiculo_mod FOREIGN KEY (idtipovehiculo) REFERENCES tipovehiculos (idtipovehiculo),
    CONSTRAINT fk_idmarca_mod FOREIGN KEY (idmarca) REFERENCES marcas (idmarca),
    CONSTRAINT uk_modelo_mod UNIQUE (idmarca, modelo, anio)
)ENGINE = INNODB;

CREATE TABLE combustibles
(
	idcombustible		INT AUTO_INCREMENT PRIMARY KEY,
    combustible 		VARCHAR(40) 	NOT NULL,
	creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT uk_combustible_cmb UNIQUE (combustible)
)ENGINE = INNODB;

CREATE TABLE motorpark
(
	idmotorpark 		INT AUTO_INCREMENT PRIMARY KEY,
    ruc 				CHAR(11) 		NOT NULL,
    razonsocial			VARCHAR(300)	NOT NULL,
    nombrecomercial		VARCHAR(100) 	NOT NULL,
    representante 		VARCHAR(100) 	NULL,
	creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT uk_ruc_mtp UNIQUE(ruc)
)ENGINE = INNODB;

CREATE TABLE locales
(
	idlocal				INT AUTO_INCREMENT PRIMARY KEY,
    tienda 				VARCHAR(40) 	NOT NULL,
    iddistrito			INT 			NOT NULL,
    idmotorpark			INT 			NOT NULL,
    principal			ENUM('S','N') 	NOT NULL,
    responsable 		VARCHAR(100) 	NOT NULL,
    correo 				VARCHAR(200) 	NULL,
    direccion			VARCHAR(300)	NULL,
    telefono 			VARCHAR(12) 	NULL,
    latitud 			VARCHAR(20) 	NULL,
    longitud 			VARCHAR(20) 	NULL,
	creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,    
    CONSTRAINT fk_iddistrito_loc FOREIGN KEY (iddistrito) REFERENCES distritos (iddistrito),
    CONSTRAINT fk_idmotorpark_loc FOREIGN KEY (idmotorpark) REFERENCES motorpark (idmotorpark)
)ENGINE = INNODB;


-- La moneda y precio de compra están definidos en el proceso de COMPRA
CREATE TABLE vehiculos
(
	idvehiculo			INT AUTO_INCREMENT PRIMARY KEY,
	idmodelo 			INT 			NOT NULL,
    version				VARCHAR(20) 	NOT NULL,
    condicion			ENUM('nuevo', 'seminuevo') NOT NULL DEFAULT 'nuevo',
    idcombustible 		INT 			NOT NULL,
    color 				VARCHAR(30) 	NULL,
    chasis 				VARCHAR(30)		NULL,
    placa 				VARCHAR(10)	 	NULL,
    placarotativa		VARCHAR(10) 	NULL,
    seriemotor 			VARCHAR(20) 	NULL,
    moneda				ENUM('USD', 'PEN') NULL DEFAULT 'USD', -- VENTA
    precioventa			DECIMAL(9,2) 	NULL,
    disponibilidad 		ENUM('proceso', 'libre', 'separado', 'vendido', 'recuperado') NOT NULL,
    idlogistica			INT 			NOT NULL COMMENT 'Usuario del área de logística',
    idlocal 			INT 			NULL COMMENT 'Piso: CHINCHA - ICA',
    origen 				ENUM ('OCP', 'OLD','CTZ') NOT NULL COMMENT 'OCP = Orden de compra (conducto regular), OLD (Contratos anteriores al sistema), CTZ (Cotizado por asesor)',
	creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT fk_idmodelo_veh FOREIGN KEY (idvehiculo) REFERENCES modelos (idmodelo),
    CONSTRAINT fk_idcombustible_veh FOREIGN KEY (idcombustible) REFERENCES combustibles (idcombustible),
    CONSTRAINT fk_idlocal_veh FOREIGN KEY (idlocal) REFERENCES locales (idlocal),
    CONSTRAINT fk_idlogistica_veh FOREIGN KEY (idlogistica) REFERENCES colaboradores (idcolaborador)
)ENGINE = INNODB;

-- Cuando se compra un vehículo, este además de su valor, supone pagos adicioanles como:
-- Tarjeta de propiedad y placa, Flete picanto, gastos administrativos
-- No se requiere indiciar la moneda porque esto se especifica al momento de realizar la comrpa
CREATE TABLE gastos
(
	idgasto 			INT AUTO_INCREMENT PRIMARY KEY,
    idvehiculo 			INT 			NOT NULL,
    descripcion 		VARCHAR(300) 	NOT NULL,
	importe 			DECIMAL(9,2) 	NOT NULL,
	creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT fk_idvehiculo_gst FOREIGN KEY (idvehiculo) REFERENCES vehiculos (idvehiculo)
)ENGINE = INNODB;

CREATE TABLE ordenescompra
(
	idordencompra		INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Será el número de orden de compra',
    idtienda			INT 			NOT NULL,
    idlogistica			INT 			NOT NULL,
    moneda				ENUM('USD', 'PEN') NOT NULL,
    serie 				CHAR(4) 		NOT NULL COMMENT 'Será el año',
    emision				DATE	 		NOT NULL COMMENT 'Se creó la orden de compra',
    aprobacion			DATE			NULL COMMENT 'Gerencia aprueba la orden',
    presentacion		DATE 			NULL COMMENT 'Logística envía la orden al concesionario',
    anulacion 			DATE 			NULL COMMENT 'Logística anula la orden de compra',
    numstock			VARCHAR(20) 	NULL COMMENT 'Este dato será provisto por el concesionario - opcional',
    observaciones		VARCHAR(400) 	NULL,
    estado 				ENUM('emitido', 'aprobado', 'presentado', 'anulado', 'pagado')  NOT NULL DEFAULT 'emitido',
    CONSTRAINT fk_idtienda_ocp FOREIGN KEY (idtienda) REFERENCES tiendas (idtienda),
    CONSTRAINT fk_idlogistica_ocp FOREIGN KEY (idlogistica) REFERENCES colaboradores (idcolaborador)
)ENGINE = INNODB;

DELETE FROM ordenescompra;
ALTER TABLE ordenescompra AUTO_INCREMENT 1;
SELECT * FROM ordenescompra;

-- Una orden de compra puede tener más de un equipo
CREATE TABLE detordencompra
(
	iddetordencompra	INT AUTO_INCREMENT PRIMARY KEY,
    idordencompra		INT 			NOT NULL,
    idvehiculo			INT 			NOT NULL,
    preciocompra		DECIMAL(9,2)	NOT NULL,
    escorrecto 			ENUM ('S', 'N') NULL COMMENT 'Define si el vehículo llego de acuerdo a los datos de la factura',
    CONSTRAINT fk_idordencompra_doc FOREIGN KEY (idordencompra) REFERENCES ordenescompra (idordencompra),
    CONSTRAINT fk_idvehiculo_doc FOREIGN KEY (idvehiculo) REFERENCES vehiculos (idvehiculo),
    CONSTRAINT uk_idvehiculo_doc UNIQUE (idvehiculo) -- Relación uno a uno
)ENGINE = INNODB;

CREATE TABLE compras
(
	idcompra 			INT AUTO_INCREMENT PRIMARY KEY,
    idorden				INT 			NOT NULL COMMENT 'De esta clave se obtendrán las datos de los vehículos',
    idlogistica 		INT 			NOT NULL COMMENT 'Colaborador que realiza el registro',
    fechacompra 		DATE 			NOT NULL,
    fecharecepcion		DATE 			NULL,
    tipodoc 			ENUM('B','F')	NOT NULL DEFAULT 'F' COMMENT 'Boleta o Factura',
    serie 				VARCHAR(10) 	NOT NULL,
    numdocumento		INT 			NOT NULL,
    pathxml 			VARCHAR(200)	NULL,
	creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT fk_idorden_cmp FOREIGN KEY (idorden) REFERENCES ordenescompra (idordencompra),
    CONSTRAINT fk_idlogistica_cmp FOREIGN KEY (idlogistica) REFERENCES colaboradores (idcolaborador)
)ENGINE = INNODB;

CREATE TABLE entidadespago
(
	identidadpago		INT AUTO_INCREMENT PRIMARY KEY,
    entidad 			VARCHAR(20) 	NOT NULL,
    tipo 				ENUM('Banco', 'Caja', 'Financiera') NOT NULL DEFAULT 'Banco',
	creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT uk_entidad_epg UNIQUE (entidad)
)ENGINE = INNODB;

CREATE TABLE amortizacionesoc
(
	idamortizacion		INT AUTO_INCREMENT PRIMARY KEY,
    idorden 			INT 			NOT NULL,
    idlogistica			INT 			NOT NULL,
    identidadpago		INT 			NOT NULL,
    fechapago 			DATE 			NOT NULL,
    numtransaccion		VARCHAR(20)		NOT NULL,
    moneda				ENUM('USD', 'PEN') NOT NULL,
    tipocambio 			DECIMAL(5,2) 	NULL,
    amortizacion		DECIMAL(9,2) 	NOT NULL,
    saldo 				DECIMAL(9,2) 	NOT NULL,
    comprobante			VARCHAR(200) 	NULL,
    observaciones		VARCHAR(400) 	NULL,
	creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT fk_idorden_aoc FOREIGN KEY (idorden) REFERENCES ordenescompra (idordencompra),
    CONSTRAINT fk_idlogistica_aoc FOREIGN KEY (idlogistica) REFERENCES colaboradores (idcolaborador),
    CONSTRAINT fk_identidadpago_aoc FOREIGN KEY (identidadpago) REFERENCES entidadespago (identidadpago)
)ENGINE = INNODB;
