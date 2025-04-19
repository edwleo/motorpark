CREATE DATABASE yondaapp;
USE yondaapp;

-- Actualización marzo 2025 (se integra el módulo de leticia)
CREATE TABLE ubigeoinei
(
	idubigeo 			VARCHAR(6) 	NOT NULL PRIMARY KEY,
    distrito 			VARCHAR(50) NOT NULL,
    provincia 			VARCHAR(50) NOT NULL,
    departamento 		VARCHAR(50) NOT NULL
)ENGINE = INNODB;

CREATE TABLE personas
(
	idpersona 			INT PRIMARY KEY AUTO_INCREMENT,
    apellidos 			VARCHAR(70) 	NOT NULL,
    nombres 			VARCHAR(70)		NOT NULL,
    tipodoc 			ENUM('DNI','PSP','CEX') DEFAULT 'DNI',
    nrodoc	 			VARCHAR(12) 	NOT NULL,
    genero 				ENUM('M', 'F'), -- M, F
    fechanac 			DATE 			NULL,
    estadocivil 		ENUM('SOL', 'CAS', 'VDO', 'DVC', 'CNV')	NULL,
    email 				VARCHAR(150)	NULL,
    idubigeo 			VARCHAR(6) 		NULL, -- Puede ser NULL
    direccion			VARCHAR(200) 	NULL, 
    referencia 			VARCHAR(200) 	NULL,
    latitud				VARCHAR(30) 	NULL,  -- Actualizado por el especialista de crédito
    longitud 			VARCHAR(30) 	NULL,  -- Actualizado por el especialista de crédito
    telprimario 		CHAR(9) 		NOT NULL,
    telalternativo 		CHAR(9) 		NULL,
	creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT uk_nrodoc UNIQUE (tipodoc, nrodoc),
    CONSTRAINT fk_idubigeo_per FOREIGN KEY (idubigeo) REFERENCES ubigeoinei (idubigeo)
)ENGINE = INNODB;


-- ALTER TABLE personas ADD CONSTRAINT uk_nrodoc UNIQUE (tipodoc, nrodoc);
-- ESTADOS = activo, suspensión temporal, baja provisional, baja definitiva, baja provisional de oficio y baja definitiva de oficio
CREATE TABLE empresas
(
	idempresa 			INT PRIMARY KEY AUTO_INCREMENT,
    razonsocial 		VARCHAR(400) 	NOT NULL,
    nombrecomercial 	VARCHAR(100)	NOT NULL,
    ruc 				CHAR(11)		NOT NULL,
    representante 		VARCHAR(100) 	NULL,
    email 				VARCHAR(150) 	NULL,
    idubigeo 			VARCHAR(6) 		NULL,
    direccion 			VARCHAR(200) 	NULL,
    referencia 			VARCHAR(200) 	NULL,
	latitud				VARCHAR(30) 	NULL,  -- Actualizado por el especialista de crédito
    longitud 			VARCHAR(30) 	NULL,  -- Actualizado por el especialista de crédito
    telprimario 		CHAR(9) 		NOT NULL,
    telalternativo 		CHAR(9) 		NULL,
	activo 				ENUM('S', 'N')	NOT NULL DEFAULT 'S',
	creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT uk_ruc_emp UNIQUE (ruc),
    CONSTRAINT fk_idubigeo_emp FOREIGN KEY (idubigeo) REFERENCES ubigeoinei (idubigeo)
)ENGINE = INNODB;

CREATE TABLE cargos
(
	idcargo				INT PRIMARY KEY AUTO_INCREMENT,
    cargo 				VARCHAR(40)		NOT NULL,
    creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT uk_rol_rol UNIQUE (cargo)
)
ENGINE = INNODB;

CREATE TABLE permisos
(
	idpermiso			INT PRIMARY KEY AUTO_INCREMENT,
    idcargo				INT 			NOT NULL,
    moduloapp			VARCHAR(50) 	NOT NULL,
    creado				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT fk_idcargo_per FOREIGN KEY (idcargo) REFERENCES cargos (idcargo)
)
ENGINE = INNODB;

CREATE TABLE contratoslaborales
(
	idcontratolaboral	INT PRIMARY KEY AUTO_INCREMENT,
    idpersona 			INT 			NOT NULL,
    idcargo				INT 			NOT NULL,
    fechainicio			DATE			NOT NULL,
    fechafin 			DATE 			NULL,
    tipocontrato 		ENUM('Planilla', 'Locador'),
	creado				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT fk_idpersona_cla FOREIGN KEY (idpersona) REFERENCES personas (idpersona),
    CONSTRAINT fk_idcargo_cla FOREIGN KEY (idcargo) REFERENCES cargos (idcargo)
)
ENGINE = INNODB;

CREATE TABLE colaboradores
(
	idcolaborador 		INT PRIMARY KEY AUTO_INCREMENT,
    idcontratolaboral	INT 			NOT NULL,
    usernick 			VARCHAR(20) 	NOT NULL,
    userpassword 		VARCHAR(70) 	NOT NULL,
    avatar 				VARCHAR(150) 	NULL,
    ultimoacceso 		DATETIME 		NULL,
	creado				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    inactivo			DATETIME 		NULL,
    CONSTRAINT fk_idcontratolaboral_col FOREIGN KEY (idcontratolaboral) REFERENCES contratoslaborales (idcontratolaboral),
    CONSTRAINT uk_usernick_col UNIQUE (usernick)
)ENGINE = INNODB;

/* PENDIENTE */

CREATE TABLE accesos
(
	idacceso 			INT PRIMARY KEY AUTO_INCREMENT,
    idcolaborador 		INT 			NOT NULL,
    fechahora 			DATETIME 		NOT NULL,
    condicion 			ENUM('Acceso', '', '')
)ENGINE = INNODB;

CREATE TABLE clientes
(
	idcliente			INT PRIMARY KEY AUTO_INCREMENT,
    tipocliente			ENUM("P", "E") 	NOT NULL,
    idpersona 			INT 			NULL,
    idempresa			INT 			NULL,
    idcolregistra		INT 			NOT NULL,
    idcolactualiza 		INT 			NULL,
	creado				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT fk_idpersona_cli FOREIGN KEY (idpersona) REFERENCES personas (idpersona),
    CONSTRAINT fk_idempresa_cli FOREIGN KEY (idempresa) REFERENCES empresas (idempresa),
    CONSTRAINT fk_idcolregistra_cli FOREIGN KEY (idcolregistra) REFERENCES colaboradores (idcolaborador),
    CONSTRAINT fk_idcolactualiza_cli FOREIGN KEY (idcolactualiza) REFERENCES colaboradores (idcolaborador)
)
ENGINE = INNODB;

CREATE TABLE concesionarios
(
	idconcesionario		INT PRIMARY KEY AUTO_INCREMENT,
    ruc 				CHAR(11) 		NOT NULL,
    razonsocial			VARCHAR(300)	NOT NULL,
    nombrecomercial		VARCHAR(100)	NOT NULL,
    direccion			VARCHAR(200) 	NULL,
    telefono 			VARCHAR(12) 	NOT NULL,
    contacto 			VARCHAR(100) 	NULL,
    creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT uk_ruc_con UNIQUE (ruc),
    CONSTRAINT uk_razonsocial_con UNIQUE (razonsocial)
)
ENGINE = INNODB;

CREATE TABLE entidadespago
(
	identidadpago		INT PRIMARY KEY AUTO_INCREMENT, 
    entidad 			VARCHAR(40) 	NOT NULL,
    tipo 				ENUM("BANCO", "FINANCIERA", "CAJA"),
    creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT uk_entidad_ent UNIQUE (entidad, tipo)
)
ENGINE = INNODB;

CREATE TABLE compras
(
	idcompra 			INT PRIMARY KEY AUTO_INCREMENT,
    fechacompra 		DATE			NOT NULL,
    fechaentrega 		DATE 			NOT NULL,
    idconcesionario 	INT 			NOT NULL,
    serie 				VARCHAR(5) 		NOT NULL,
    numdocumento	 	VARCHAR(10)		NOT NULL,
    moneda 				ENUM("PEN", "USD") NOT NULL,
    tipocambio			DECIMAL(8,4) 	NULL COMMENT 'No se requiere si se paga en PEN',
    pagado 				ENUM("S", "N")	NOT NULL,
    idlogistica			INT 			NOT NULL,
    creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT fk_idconcesionario_com FOREIGN KEY (idconcesionario) REFERENCES concesionarios (idconcesionario),
    CONSTRAINT fk_idlogistica_com FOREIGN KEY (idlogistica) REFERENCES colaboradores (idcolaborador)
)
ENGINE = INNODB;


CREATE TABLE marcas
(
	idmarca 			INT PRIMARY KEY AUTO_INCREMENT,
    marca 				VARCHAR(50)		NOT NULL,
    creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT uk_marca_mar UNIQUE (marca)
)ENGINE = INNODB;

CREATE TABLE tipovehiculos
(
	idtipovehiculo		INT PRIMARY KEY AUTO_INCREMENT,
    tipovehiculo 		VARCHAR(70) 	NOT NULL,
    creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT uk_tipovehiculo_tve UNIQUE (tipovehiculo)
)ENGINE = INNODB;

CREATE TABLE modelos
(
	idmodelo 			INT PRIMARY KEY AUTO_INCREMENT,
    idtipovehiculo 		INT 			NOT NULL,
    idmarca				INT 			NOT NULL,
    modelo 				VARCHAR(40) 	NOT NULL,
    creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT fk_idtipomodelo_mod FOREIGN KEY (idtipovehiculo) REFERENCES tipovehiculos (idtipovehiculo),
    CONSTRAINT fk_idmarca_mod FOREIGN KEY (idmarca) REFERENCES marcas (idmarca),
    CONSTRAINT uk_modelo_mod UNIQUE (idmarca, modelo)
)ENGINE = INNODB;


CREATE TABLE tiendas
(
	idtienda			INT PRIMARY KEY AUTO_INCREMENT,
    tienda				VARCHAR(40) 	NOT NULL,
    direccion 			VARCHAR(150) 	NOT NULL,
    idubigeo 			VARCHAR(6) 		NOT NULL,
    creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT uk_tienda_tnd UNIQUE (tienda),
    CONSTRAINT fk_idubigeo_tnd FOREIGN KEY (idubigeo) REFERENCES ubigeoinei (idubigeo)
)ENGINE = INNODB;


CREATE TABLE vehiculos
(
	idvehiculo			INT PRIMARY KEY AUTO_INCREMENT,
    idtienda 			INT 			NOT NULL COMMENT 'Si el auto no está en piso este datos nos indica qué área lo solicitó',
    idmodelo 			INT 			NOT NULL COMMENT 'Esta FK define además marca y modelo',
	aniovehiculo 		CHAR(4) 		NOT NULL,
    versionveh			VARCHAR(40) 	NULL COMMENT 'Full, Básico, Sport, etc.',
    estadovehiculo 		ENUM('Nuevo', 'Semi') NOT NULL DEFAULT 'Nuevo',  
    tipocombustible		ENUM('Gasolina', 'Dual', 'Diesel', 'GLP', 'GNV', 'Eléctrico') NOT NULL,
    color 				VARCHAR(30) 	NULL,
    chasis 				VARCHAR(30)		NOT NULL,
    placa 				CHAR(7) 		NULL,
    motor 				VARCHAR(30) 	NULL,
    moneda 				ENUM('PEN', 'USD') NOT NULL DEFAULT 'PEN',
    precio 				DECIMAL(11,4) 	NOT NULL,
    statusveh 			ENUM('Libre', 'Separado', 'Vendido') NOT NULL DEFAULT 'Libre',  
	placarotativa		VARCHAR(10) 	NULL,
    enpiso				ENUM('S', 'N') 	NOT NULL DEFAULT 'S' COMMENT 'S = comprado (logística), N = orden de compra (ventas)',
    idcolventa 			INT 			NULL COMMENT 'En caso venga de orden de compra, solicitado por el área de venta',
    idcollogistica		INT 			NULL COMMENT 'Logística registra la compra del vehículo',
    idcolactualiza 		INT 			NULL COMMENT 'Si se realiza cambios en el vehículo',
    creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT fk_idtienda_veh FOREIGN KEY (idtienda) REFERENCES tiendas (idtienda),
    CONSTRAINT fk_idmodelo_veh FOREIGN KEY (idmodelo) REFERENCES modelos (idmodelo),
    CONSTRAINT fk_idcolventa_veh FOREIGN KEY (idcolventa) REFERENCES colaboradores (idcolaborador),
    CONSTRAINT fk_idcollogistica_veh FOREIGN KEY (idcollogistica) REFERENCES colaboradores (idcolaborador),
    CONSTRAINT fk_idcolactualiza_veh FOREIGN KEY (idcolactualiza) REFERENCES colaboradores (idcolaborador)
)ENGINE = INNODB;


CREATE TABLE detallecompra
(
	iddetcompra 		INT PRIMARY KEY AUTO_INCREMENT,
    idcompra 			INT				NOT NULL,
    idvehiculo 			INT 			NOT NULL COMMENT 'relación uno a uno',
    preciocompra 		DECIMAL(11,4)	NOT NULL COMMENT 'La moneda está definida en el tipo de cambio',
    cantidad 			TINYINT			NOT NULL,
    CONSTRAINT fk_idcompra_dco FOREIGN KEY (idcompra) REFERENCES compras (idcompra),
    CONSTRAINT fk_idvehiculo_dco FOREIGN KEY (idvehiculo) REFERENCES vehiculos (idvehiculo),
    CONSTRAINT uk_idvehiculo_dco UNIQUE (idvehiculo)
)ENGINE = INNODB;


CREATE TABLE amortizacioncompra
(
	idamortizacion		INT PRIMARY KEY AUTO_INCREMENT,
    idcompra 			INT 			NOT NULL,
    identidadpago 		INT 			NOT NULL,
	fechapago			DATETIME 		NOT NULL,
    numtrasaccion		VARCHAR(20)		NOT NULL,
    amortizacion		DECIMAL(11,4)	NOT NULL,
    saldo 				DECIMAL(11,4) 	NOT NULL,
    creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    idlogistica 		INT 			NOT NULL,
    CONSTRAINT fk_idcompra_amt FOREIGN KEY (idcompra) REFERENCES compras (idcompra),
    CONSTRAINT fk_identidadpago_amt FOREIGN KEY (identidadpago) REFERENCES entidadespago (identidadpago),
    CONSTRAINT fk_idlogistica_amt FOREIGN KEY (idlogistica) REFERENCES colaboradores (idcolaborador)
)ENGINE = INNODB;


CREATE TABLE requisitos
(
	idrequisito 		INT PRIMARY KEY AUTO_INCREMENT,
    requisito 			VARCHAR(500)	NOT NULL,
    creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT uk_requisito_req UNIQUE (requisito)
)ENGINE = INNODB;

CREATE TABLE formatocotizacion
(
	idformato 			INT PRIMARY KEY AUTO_INCREMENT,
    tipocotizacion		ENUM('Independiente formal', 'Independiente Informal', 'Dependiente') NOT NULL,
    fechainicio 		DATE 			NOT NULL,
    fechafin 			DATE 			NULL,
    creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL
)ENGINE = INNODB;


CREATE TABLE detallerequisitos
(
	iddetrequisito		INT PRIMARY KEY AUTO_INCREMENT,
    idformato 			INT 			NOT NULL,
    idrequisito 		INT 			NOT NULL,
    creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    CONSTRAINT fk_idformato_dre FOREIGN KEY (idformato) REFERENCES formatocotizacion (idformato),
    CONSTRAINT fk_idrequisito_dre FOREIGN KEY (idrequisito) REFERENCES requisitos (idrequisito)
)ENGINE = INNODB;


-- Para determinar qué asesor de crédito aprobó/rechazó la cotización, consulte la tabla "fichasolicitud"
CREATE TABLE cotizaciones
(
	idcotizacion		INT PRIMARY KEY AUTO_INCREMENT,
    idformato 			INT 			NOT NULL,
    idcliente			INT 			NOT NULL,
    idvehiculo 			INT 			NOT NULL,
    moneda 				ENUM('PEN', 'USD') NOT NULL,
    tipocambio 			DECIMAL(7,2) 	NOT NULL,
    gastosadmin			DECIMAL(7,2) 	NOT NULL COMMENT 'Solicitado por el área de venta, es un valor flexible',
    tasa 				DECIMAL(5,2) 	NOT NULL COMMENT 'Valor porcentual 65% (entero) o decimal ejemplo: 60.5%',  
    precioventa 		DECIMAL(9,2) 	NOT NULL,
    vigenciadias 		TINYINT 		NOT NULL COMMENT 'Días válidos de la cotización' DEFAULT 7,
    inicial 			DECIMAL(9,2) 	NOT NULL,
    fechainicio			DATE 			NOT NULL,
    numcuotas 			SMALLINT		NOT NULL,
    valorcuota 			DECIMAL(9,2) 	NOT NULL,
    estadocotizacion	ENUM('P','E','A','C','R') NOT NULL DEFAULT 'P' COMMENT 'Pendiente | Evaluación | Aprobada | Cancelada (cliente) | Rechazada (Analista crédito)',
    idasesor 			INT 			NOT NULL COMMENT 'Colaborador del área de VENTA', -- 
    creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT fk_idformato_cot FOREIGN KEY (idformato) REFERENCES formatocotizacion (idformato),
    CONSTRAINT fk_idcliente_cot FOREIGN KEY (idcliente) REFERENCES clientes (idcliente),
    CONSTRAINT fk_idvehiculo_cot FOREIGN KEY (idvehiculo) REFERENCES vehiculos (idvehiculo),
    CONSTRAINT fk_idcolventa_cot FOREIGN KEY (idasesor) REFERENCES colaboradores (idcolaborador)
)ENGINE = INNODB;

/* 
Cuando se realice el primer pago, se creará una ficha de solicitud, con los datos NULL
para cuando se ingrese al módulo: creditos/evaluar-credito, se puedan aplicar las foráneas
Una cotización solo puede tener una ficha
*/
CREATE TABLE fichasolicitud
(
	idficha				INT PRIMARY KEY AUTO_INCREMENT,
    idcotizacion		INT 			NOT NULL,
    idconyuge 			INT 			NULL COMMENT 'Esposo(a)',
    idaval 				INT 			NULL,
    idavalconyuge		INT 			NULL COMMENT 'Solo si aval es casado(a)',
    comentarios 		VARCHAR(400) 	NULL,
    fechavisita 		DATETIME 		NULL,
    pathformatopdf 		VARCHAR(400) 	NULL,
    idcolcredito 		INT 			NULL,
    evaluado 			ENUM('S', 'N') 	NOT NULL DEFAULT 'N' COMMENT 'Cuando la evaluación pase a S, se debe modificar el campo estadocotizacion en la tabla cotizaciones',
    creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT fk_idcotizacion_fso FOREIGN KEY (idcotizacion) REFERENCES cotizaciones (idcotizacion),
    CONSTRAINT fk_idconyuge_fso FOREIGN KEY (idconyuge) REFERENCES personas (idpersona),
    CONSTRAINT fk_idaval_fso FOREIGN KEY (idaval) REFERENCES personas (idpersona),
    CONSTRAINT fk_idavalconyuge_fso FOREIGN KEY (idavalconyuge) REFERENCES personas (idpersona),
    CONSTRAINT fk_idcolcredito_fso FOREIGN KEY (idcolcredito) REFERENCES colaboradores (idcolaborador),
    CONSTRAINT uk_idcotizacion_fso UNIQUE (idcotizacion)
)ENGINE = INNODB;

-- Los contratos son validados por logistica
CREATE TABLE contratos
(
	idcontrato 			INT PRIMARY KEY AUTO_INCREMENT,
    escredito	 		ENUM('S', 'N')  NOT NULL COMMENT 'Las compras al contado se registran en esta tabla como N',
    idtienda 			INT 			NOT NULL,
    idcotizacion 		INT 			NOT NULL,
    fechainicio			DATE			NOT NULL,
    diapago	 			TINYINT 		NOT NULL COMMENT 'Es el día de pago, valor entre 1 - 30, preferencia primeros días',
    idlogistica 		INT 			NOT NULL COMMENT 'Logística tiene que validar los datos y generar el contrato',
	estadocontrato 		ENUM('Vigente', 'Terminado', 'Cancelado') NOT NULL COMMENT 'Cancelado (se recuperó el vehículo), Para contratos ',
    fecharevision		DATETIME 		NULL COMMENT 'Es el momento cuando el área de logística valida el contrato',
    observaciones 		VARCHAR(400) 	NULL,
    creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT fk_idtienda_cnt FOREIGN KEY (idtienda) REFERENCES tiendas (idtienda),
    CONSTRAINT fk_idcotizacion_cnt FOREIGN KEY (idcotizacion) REFERENCES cotizaciones (idcotizacion),
	CONSTRAINT fk_idlogistica_cnt FOREIGN KEY (idlogistica) REFERENCES colaboradores (idcolaborador)
)ENGINE = INNODB;


-- Cuando se confirma un contrato, también se generar los registros correspondientes a cada pago
-- NO SE INTEGRA EL IDCAJA ya que esto no es un pago, sino, un cronograma de cuándo se deben realizar los pagos
CREATE TABLE cronogramas
(
	idcronograma 		INT PRIMARY KEY AUTO_INCREMENT,
    aplicapenalidad		ENUM('S', 'N')  NOT NULL DEFAULT 'S' COMMENT 'Para compras al contado NO se aplica penalidad pero se pueden pagar en partes (separación)',
    idcontrato 			INT 			NOT NULL,
    numcuota 			SMALLINT 		NOT NULL,
    fechapago 			DATE 			NOT NULL,
    interes 			DECIMAL(9,2) 	NOT NULL COMMENT 'De este dato se deducirá base imponible e IGV',
    abonocapital 		DECIMAL(9,2) 	NOT NULL COMMENT 'CUOTA = abonocapital + interés',
    penalidad			DECIMAL(9,2) 	NOT NULL DEFAULT 0 COMMENT 'Si se encuentra 3 días después de la fecha se aplica una mora',
    saldocapital		DECIMAL(9,2) 	NOT NULL ,
    estadocuota 		ENUM('Pendiente', 'Pagado', 'Parcial') DEFAULT 'Pendiente' NOT NULL COMMENT 'El estado "Parcial" se da cuando se realiza el pago por amortización',
    creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT fk_idcontrato_cro FOREIGN KEY (idcontrato) REFERENCES contratos (idcontrato)
)ENGINE = INNODB;

CREATE TABLE pagos
(
	idpago 				INT PRIMARY KEY AUTO_INCREMENT,
    idcronograma 		INT 			NOT NULL COMMENT 'Pod',
    idcuentapago 		INT 			NOT NULL,
    mediopago			ENUM('Efectivo', 'Yape', 'POS', 'Depósito') NOT NULL,
    tipopago 			ENUM('Credito', 'Inicial', 'Contado', 'Otros') NOT NULL,
    fechapago			DATE 			NOT NULL,
    amortizacion		DECIMAL(9,2) 	NOT NULL,
    nota 				VARCHAR(300) 	NULL,
    idcolcaja 			INT 			NOT NULL,
    creado 				DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT fk_idcronograma_pag FOREIGN KEY (idcronograma) REFERENCES cronogramas (idcronograma),
    CONSTRAINT fk_identidadpago_pag FOREIGN KEY (identidadpago) REFERENCES entidadespago (identidadpago),
    CONSTRAINT fk_idcolcaja_pag FOREIGN KEY (idcolcaja) REFERENCES colaboradores (idcolaborador),
    CONSTRAINT fk_idcolrecepciona_pag FOREIGN KEY (idcolrecepciona) REFERENCES colaboradores (idcolaborador)
)ENGINE = INNODB;

CREATE TABLE conceptospago
(
	idconcepto			INT PRIMARY KEY AUTO_INCREMENT,
    concepto			VARCHAR(200) 	NOT NULL,
    descripcion			VARCHAR(400) 	NULL,
    montosugerido 		DECIMAL(7,2) 	NOT NULL,
    idcolregistra 		INT 			NOT NULL,
    idcolactualiza		INT 			NULL,
    create_at 			DATETIME 		NOT NULL DEFAULT NOW(),
    update_at 			DATETIME 		NULL,
    CONSTRAINT uk_concepto_cpg UNIQUE (concepto),
    CONSTRAINT fk_idcolregistra_cpg FOREIGN KEY (idcolregistra) REFERENCES colaboradores (idcolaborador),
    CONSTRAINT fk_idcolactualiza_cpg FOREIGN KEY (idcolactualiza) REFERENCES colaboradores (idcolaborador)
)ENGINE = INNODB;

-- CONSTRAINT ck_montosugerido_cpg CHECK (montosugerido > 0),

CREATE TABLE pagosvarios
(
	idpago				INT PRIMARY KEY AUTO_INCREMENT,
    idcontrato 			INT 			NOT NULL,
    idconcepto 			INT 			NOT NULL,
    montofinal 			DECIMAL(9,2) 	NOT NULL,
    fechapago 			DATE			NOT NULL,
    identidadpago 		INT 			NOT NULL,
    idcolcaja 			INT 			NOT NULL,
    idcolrecepciona		INT 			NOT NULL,
    create_at 			DATETIME 		NOT NULL DEFAULT NOW(),
    CONSTRAINT fk_idcontrato_pva FOREIGN KEY (idcontrato) REFERENCES contratos (idcontrato),
    CONSTRAINT fk_idconcepto_pva FOREIGN KEY (idconcepto) REFERENCES conceptospago (idconcepto),
    CONSTRAINT fk_identidadpago_pva FOREIGN KEY (identidadpago) REFERENCES entidadespago (identidadpago),
    CONSTRAINT fk_idcolcaja_pva FOREIGN KEY (idcolcaja) REFERENCES colaboradores (idcolaborador),
    CONSTRAINT fk_idcolrecepciona_pva FOREIGN KEY (idcolrecepciona) REFERENCES colaboradores (idcolaborador)
)ENGINE = INNODB;

CREATE TABLE conceptosegreso
(
	idconcepto 			INT PRIMARY KEY AUTO_INCREMENT,
    concepto			VARCHAR(200) 	NOT NULL,
    descripcion 		VARCHAR(400) 	NULL,
    create_at 			DATETIME 		NOT NULL DEFAULT NOW(),
    update_at 			DATETIME 		NULL,
    CONSTRAINT uk_concepto_ceg UNIQUE (concepto)
)ENGINE = INNODB;

CREATE TABLE egresos
(
	idegreso 			INT PRIMARY KEY AUTO_INCREMENT,
    idconceptoegreso	INT 			NOT NULL,
    idcolcaja 			INT 			NOT NULL,
    idcolsolicitante 	INT 			NOT NULL,
    monto 				DECIMAL(9,2) 	NOT NULL,
    comentarios 		VARCHAR(300)	NULL,
    requierecomprobante CHAR(1) 		NOT NULL DEFAULT 'N',
    create_at 			DATETIME 		NOT NULL DEFAULT NOW(),
    update_at			DATETIME 		NULL,
    CONSTRAINT fk_idconceptoegreso_egr FOREIGN KEY (idconceptoegreso) REFERENCES conceptosegreso (idconcepto),
    CONSTRAINT fk_idcolcaja_egr FOREIGN KEY (idcolcaja) REFERENCES colaboradores (idcolaborador),
    CONSTRAINT fk_idcolsolicitante_egr FOREIGN KEY (idcolsolicitante) REFERENCES colaboradores (idcolaborador)
)ENGINE = INNODB;

-- CONSTRAINT cK_requierecomprobante_egr CHECK (requierecomprobante IN ('S','N'))

CREATE TABLE comprobantes
(
	idcomprobante		INT PRIMARY KEY AUTO_INCREMENT,
    idegreso 			INT 			NOT NULL,
    tipodoc 			CHAR(1) 		NOT NULL,
    rucproveedor 		CHAR(11) 		NULL,
    serie 				VARCHAR(5) 		NOT NULL,
    nrodoc 				VARCHAR(10) 	NOT NULL,
    monto 				DECIMAL(9,2)	NOT NULL,
    cargadocontabilidad	CHAR(1) 		NOT NULL DEFAULT 'N',
    create_at 			DATETIME 		NOT NULL DEFAULT NOW(),
    update_at 			DATETIME 		NULL,
    CONSTRAINT fk_idegreso_cmp FOREIGN KEY (idegreso) REFERENCES egresos (idegreso)
)ENGINE = INNODB;
