CREATE DATABASE motorpark;
USE motorpark;

-- Necesitaremos de una función que calcula la hora actual, esto será 
-- útil cuando la aplicación se aloje en un servidor remoto
DELIMITER $$
CREATE FUNCTION GETDATE()
RETURNS DATETIME
DETERMINISTIC
BEGIN
    RETURN NOW() - INTERVAL 5 HOUR;
END $$
DELIMITER ;

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
	creado 				DATETIME 		NOT NULL DEFAULT GETDATE(),
    modificado 			DATETIME 		NULL,
    CONSTRAINT uk_nrodoc UNIQUE (tipodoc, nrodoc),
    CONSTRAINT fk_iddistrito_per FOREIGN KEY (iddistrito) REFERENCES distritos (iddistrito) 
)ENGINE = INNODB;