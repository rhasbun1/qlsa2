/* SQL Manager for MySQL                              5.7.2.52112 */
/* -------------------------------------------------------------- */
/* Host     : localhost                                           */
/* Port     : 3306                                                */
/* Database : sgtt_version2                                       */


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES 'latin1' */;

SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE `sgtt_version2`
    CHARACTER SET 'latin1'
    COLLATE 'latin1_swedish_ci';

USE `sgtt_version2`;

/* Structure for the `alarmatarea` table : */

CREATE TABLE `alarmatarea` (
  `idAlarmaTarea` SMALLINT(6) NOT NULL,
  `descripcion` VARCHAR(30) COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY USING BTREE (`idAlarmaTarea`)
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `areas` table : */

CREATE TABLE `areas` (
  `idArea` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  PRIMARY KEY USING BTREE (`idArea`)
) ENGINE=InnoDB
AUTO_INCREMENT=4 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `centros` table : */

CREATE TABLE `centros` (
  `idCentro` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idCentro`)
) ENGINE=InnoDB
AUTO_INCREMENT=4 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `compromisosfinanciamiento` table : */

CREATE TABLE `compromisosfinanciamiento` (
  `idCompromisoFinanciamiento` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `idFuenteFinanciamiento` INTEGER(11) NOT NULL,
  `origen` SMALLINT(6) DEFAULT NULL,
  `idOrigen` BIGINT(20) DEFAULT NULL COMMENT '1=iNICIATIVA,2=PROYECTO,3=LICENCIAMIENTO',
  `tipoFinanciamiento` SMALLINT(6) DEFAULT 1 COMMENT '1=Pecuinario\r\n2=Valorizado',
  `montoFinanciamiento` BIGINT(20) NOT NULL DEFAULT 0,
  `fechaComprometida` VARCHAR(8) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idCompromisoFinanciamiento`)
) ENGINE=InnoDB
AUTO_INCREMENT=25 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `contrato` table : */

CREATE TABLE `contrato` (
  `idContrato` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `codigoContrato` VARCHAR(50) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `nombre` VARCHAR(150) COLLATE utf8_general_ci NOT NULL,
  `descripcion` VARCHAR(500) COLLATE utf8_general_ci NOT NULL,
  `idTipoContrato` INTEGER(11) NOT NULL DEFAULT 0,
  `idUsuarioEncargado` INTEGER(11) NOT NULL DEFAULT 0,
  `idUnidadNegocio` INTEGER(11) NOT NULL DEFAULT 0,
  `idEstadoContrato` INTEGER(11) NOT NULL DEFAULT 0,
  `fechaEstado` VARCHAR(8) COLLATE utf8_general_ci DEFAULT NULL,
  `fechaCreacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY USING BTREE (`idContrato`)
) ENGINE=InnoDB
AUTO_INCREMENT=15 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `contrato_estadocontrato` table : */

CREATE TABLE `contrato_estadocontrato` (
  `idContrato_EstadoContrato` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `idContrato` INTEGER(11) NOT NULL,
  `idEstadoContrato` INTEGER(11) NOT NULL,
  `fechaEstado` CHAR(8) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY USING BTREE (`idContrato_EstadoContrato`)
) ENGINE=InnoDB
AUTO_INCREMENT=34 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `contrato_fuentefinanciamiento` table : */

CREATE TABLE `contrato_fuentefinanciamiento` (
  `idContrato` BIGINT(20) NOT NULL,
  `idFuenteFinanciamiento` BIGINT(20) NOT NULL,
  `contacto` VARCHAR(255) COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `contrato_notas` table : */

CREATE TABLE `contrato_notas` (
  `idNota` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `idContrato` BIGINT(20) NOT NULL,
  `nota` VARCHAR(255) COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `fechahora` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `idUsuario` INTEGER(11) NOT NULL,
  PRIMARY KEY USING BTREE (`idNota`)
) ENGINE=InnoDB
AUTO_INCREMENT=26 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `cuentacorriente` table : */

CREATE TABLE `cuentacorriente` (
  `idCuentaCorriente` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `numeroCuenta` VARCHAR(20) COLLATE latin1_swedish_ci NOT NULL,
  `descripcion` VARCHAR(100) COLLATE latin1_swedish_ci DEFAULT NULL,
  `activa` TINYINT(1) DEFAULT 1,
  `idProyecto` BIGINT(20) NOT NULL DEFAULT 0,
  PRIMARY KEY USING BTREE (`idCuentaCorriente`),
  UNIQUE KEY `idCuentaCorriente` USING BTREE (`idCuentaCorriente`)
) ENGINE=InnoDB
AUTO_INCREMENT=3 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `cuentaspresupuesto` table : */

CREATE TABLE `cuentaspresupuesto` (
  `idCuentaPresupuesto` INTEGER(11) NOT NULL DEFAULT 0,
  `descripcion` VARCHAR(100) COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  PRIMARY KEY USING BTREE (`idCuentaPresupuesto`)
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `disciplinaconocimiento` table : */

CREATE TABLE `disciplinaconocimiento` (
  `idDisciplinaConocimiento` INTEGER(11) NOT NULL,
  `nombre` VARCHAR(200) COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB
CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `documentos` table : */

CREATE TABLE `documentos` (
  `idDocumento` INTEGER(11) NOT NULL,
  `origen` INTEGER(11) NOT NULL COMMENT '1=Idea, 2=Postulacion. 3=Proyecto, 4=Tecnologia, 5 = Proteccion',
  `idOrigen` INTEGER(11) NOT NULL COMMENT 'el identificador del Orgien',
  `fechaCreacion` CHAR(8) COLLATE utf8_general_ci NOT NULL,
  `fechaUltimaModificacion` CHAR(8) COLLATE utf8_general_ci NOT NULL,
  `idUsuario` INTEGER(11) NOT NULL,
  `nombreDocumento` VARCHAR(300) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idDocumento`)
) ENGINE=InnoDB
CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `egresoctacte` table : */

CREATE TABLE `egresoctacte` (
  `idEgresoCtacte` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `fecha` VARCHAR(10) COLLATE latin1_swedish_ci NOT NULL,
  `origen` SMALLINT(6) DEFAULT NULL,
  `idOrigen` BIGINT(20) NOT NULL DEFAULT 0,
  `monto` BIGINT(20) NOT NULL,
  `detalle` VARCHAR(255) COLLATE latin1_swedish_ci DEFAULT '',
  `idCuentaCorriente` BIGINT(20) DEFAULT NULL,
  `comprobanteEgreso` VARCHAR(20) COLLATE latin1_swedish_ci DEFAULT NULL COMMENT 'numero de comprobante de egreso contable. OPCIONAL',
  `ordenCompra` BIGINT(20) NOT NULL DEFAULT 0 COMMENT 'numero de Orden de Compra asociada. OPCIONAL',
  `idFormaPago` INTEGER(11) DEFAULT NULL,
  `numeroDocumentoPago` VARCHAR(20) COLLATE latin1_swedish_ci DEFAULT NULL,
  `numeroDocumentoCompra` VARCHAR(20) COLLATE latin1_swedish_ci DEFAULT NULL,
  `idItemPresupuesto` BIGINT(20) DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idEgresoCtacte`)
) ENGINE=InnoDB
AUTO_INCREMENT=11 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `equipotrabajo` table : */

CREATE TABLE `equipotrabajo` (
  `idEquipoTrabajo` INTEGER(11) NOT NULL,
  `idProyecto` INTEGER(11) NOT NULL,
  `idInvestigador` INTEGER(11) NOT NULL,
  `idFuenteFinanciamiento` INTEGER(11) NOT NULL,
  `porcentajeParticipacion` DECIMAL(10,0) NOT NULL DEFAULT 0,
  `idPerfilInvestigador` INTEGER(11) NOT NULL,
  `principal` TINYINT(4) NOT NULL DEFAULT 1,
  `horasComprometidas` INTEGER(11) NOT NULL DEFAULT 0,
  PRIMARY KEY USING BTREE (`idEquipoTrabajo`)
) ENGINE=InnoDB
CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `estadocontrato` table : */

CREATE TABLE `estadocontrato` (
  `idEstadoContrato` INTEGER(11) NOT NULL,
  `nombre` VARCHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idEstadoContrato`)
) ENGINE=InnoDB
CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `estadofuentefinanciamiento` table : */

CREATE TABLE `estadofuentefinanciamiento` (
  `idEstadoFuenteFinanciamiento` INTEGER(11) NOT NULL,
  `nombre` VARCHAR(100) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY USING BTREE (`idEstadoFuenteFinanciamiento`)
) ENGINE=InnoDB
CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `estadoiniciativa` table : */

CREATE TABLE `estadoiniciativa` (
  `idEstadoIniciativa` INTEGER(11) NOT NULL,
  `nombre` VARCHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idEstadoIniciativa`)
) ENGINE=InnoDB
CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `estadopostulacion` table : */

CREATE TABLE `estadopostulacion` (
  `idEstadoPostulacion` INTEGER(11) NOT NULL,
  `nombre` VARCHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idEstadoPostulacion`)
) ENGINE=InnoDB
CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `estadoproteccion` table : */

CREATE TABLE `estadoproteccion` (
  `idEstadoProteccion` INTEGER(11) NOT NULL,
  `nombre` VARCHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idEstadoProteccion`)
) ENGINE=InnoDB
CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `estadoproyecto` table : */

CREATE TABLE `estadoproyecto` (
  `idEstadoProyecto` INTEGER(11) NOT NULL,
  `nombre` VARCHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idEstadoProyecto`)
) ENGINE=InnoDB
CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `estadotecnologia` table : */

CREATE TABLE `estadotecnologia` (
  `idEstadoTecnologia` INTEGER(11) NOT NULL,
  `nombre` VARCHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idEstadoTecnologia`)
) ENGINE=InnoDB
CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `formadepago` table : */

CREATE TABLE `formadepago` (
  `idFormaPago` INTEGER(11) NOT NULL,
  `nombre` VARCHAR(100) COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY USING BTREE (`idFormaPago`)
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `fuentefinanciamiento` table : */

CREATE TABLE `fuentefinanciamiento` (
  `idFuenteFinanciamiento` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(200) COLLATE utf8_general_ci NOT NULL,
  `rut` VARCHAR(20) COLLATE utf8_general_ci DEFAULT NULL,
  `idPais` BIGINT(20) DEFAULT NULL,
  `direccion` VARCHAR(150) COLLATE utf8_general_ci DEFAULT NULL,
  `region` VARCHAR(100) COLLATE utf8_general_ci DEFAULT NULL,
  `telefono` VARCHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  `web` VARCHAR(100) COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idFuenteFinanciamiento`)
) ENGINE=InnoDB
AUTO_INCREMENT=6 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `ingresoctacte` table : */

CREATE TABLE `ingresoctacte` (
  `idIngresoCtacte` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `fecha` VARCHAR(10) COLLATE latin1_swedish_ci NOT NULL,
  `idFinancista` BIGINT(20) NOT NULL,
  `origen` SMALLINT(6) DEFAULT NULL,
  `idOrigen` BIGINT(20) NOT NULL DEFAULT 0,
  `monto` BIGINT(20) NOT NULL,
  `detalle` VARCHAR(255) COLLATE latin1_swedish_ci DEFAULT '',
  `idCuentaCorriente` BIGINT(20) DEFAULT NULL,
  `idFormaPago` INTEGER(11) NOT NULL,
  `numeroDocumentoPago` VARCHAR(20) COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  PRIMARY KEY USING BTREE (`idIngresoCtacte`)
) ENGINE=InnoDB
AUTO_INCREMENT=16 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `iniciativa` table : */

CREATE TABLE `iniciativa` (
  `idIniciativa` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(150) COLLATE utf8_general_ci NOT NULL,
  `descripcion` MEDIUMTEXT COLLATE utf8_general_ci NOT NULL,
  `idUsuarioEncargado` INTEGER(11) NOT NULL DEFAULT 0,
  `idUnidadNegocio` INTEGER(11) NOT NULL DEFAULT 0,
  `idEstadoIniciativa` INTEGER(11) NOT NULL DEFAULT 0,
  `fechaEstado` VARCHAR(8) COLLATE utf8_general_ci DEFAULT NULL,
  `fechaCreacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idTipoIniciativa` INTEGER(11) DEFAULT 0,
  PRIMARY KEY USING BTREE (`idIniciativa`)
) ENGINE=InnoDB
AUTO_INCREMENT=24 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `iniciativa_areaprioritaria` table : */

CREATE TABLE `iniciativa_areaprioritaria` (
  `idIniciativa` BIGINT(20) NOT NULL,
  `idArea` BIGINT(20) NOT NULL,
  PRIMARY KEY USING BTREE (`idIniciativa`, `idArea`)
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `iniciativa_centro` table : */

CREATE TABLE `iniciativa_centro` (
  `idIniciativa` BIGINT(20) NOT NULL,
  `idCentro` BIGINT(20) NOT NULL,
  PRIMARY KEY USING BTREE (`idIniciativa`, `idCentro`)
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `iniciativa_disciplinaconocimiento` table : */

CREATE TABLE `iniciativa_disciplinaconocimiento` (
  `idIniciativa` BIGINT(20) NOT NULL,
  `idDisciplinaConocimiento` BIGINT(20) DEFAULT NULL
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `iniciativa_equipotrabajo` table : */

CREATE TABLE `iniciativa_equipotrabajo` (
  `idIniciativa` BIGINT(20) NOT NULL,
  `idInvestigador` BIGINT(20) NOT NULL,
  `idFuenteFinanciamiento` BIGINT(20) NOT NULL,
  `idPerfil` INTEGER(11) NOT NULL,
  `horas` INTEGER(11) DEFAULT NULL,
  `porcentajeParticipacion` DECIMAL(10,0) DEFAULT 0,
  `principal` TINYINT(1) DEFAULT 0,
  PRIMARY KEY USING BTREE (`idIniciativa`, `idInvestigador`)
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `iniciativa_estadoiniciativa` table : */

CREATE TABLE `iniciativa_estadoiniciativa` (
  `idIniciativa_EstadoIniciativa` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `idIniciativa` INTEGER(11) NOT NULL,
  `idEstadoIniciativa` INTEGER(11) NOT NULL,
  `fechaEstado` CHAR(8) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY USING BTREE (`idIniciativa_EstadoIniciativa`)
) ENGINE=InnoDB
AUTO_INCREMENT=36 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `iniciativa_etapa` table : */

CREATE TABLE `iniciativa_etapa` (
  `idIniciativaEtapa` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `idIniciativa` BIGINT(20) DEFAULT NULL,
  `descripcion` VARCHAR(200) COLLATE latin1_swedish_ci NOT NULL,
  `fechaInicio` VARCHAR(9) COLLATE latin1_swedish_ci DEFAULT NULL,
  `fechaTermino` VARCHAR(8) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idIniciativaEtapa`)
) ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `iniciativa_notas` table : */

CREATE TABLE `iniciativa_notas` (
  `idNota` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `idIniciativa` BIGINT(20) NOT NULL,
  `nota` VARCHAR(255) COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `fechahora` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `idUsuario` INTEGER(11) NOT NULL,
  PRIMARY KEY USING BTREE (`idNota`)
) ENGINE=InnoDB
AUTO_INCREMENT=5 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `iniciativa_sectorimpacto` table : */

CREATE TABLE `iniciativa_sectorimpacto` (
  `idIniciativa` BIGINT(20) DEFAULT NULL,
  `idSectorImpacto` BIGINT(20) DEFAULT NULL
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `investigador` table : */

CREATE TABLE `investigador` (
  `idInvestigador` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `apellidos` VARCHAR(100) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `nombres` VARCHAR(60) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `numeroIdentificacion` VARCHAR(20) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `email` VARCHAR(100) COLLATE utf8_general_ci DEFAULT '',
  `telefonoFijo` VARCHAR(20) COLLATE utf8_general_ci DEFAULT '',
  `telefonoMovil` VARCHAR(20) COLLATE utf8_general_ci DEFAULT '',
  `direccion` VARCHAR(100) COLLATE utf8_general_ci DEFAULT '',
  `idPerfilInvestigador` INTEGER(11) NOT NULL DEFAULT 0,
  `departamento_id` INTEGER(11) DEFAULT 0,
  `institucion_id` INTEGER(11) DEFAULT 0,
  PRIMARY KEY USING BTREE (`idInvestigador`),
  UNIQUE KEY `numeroIdentificacion_UNIQUE` USING BTREE (`numeroIdentificacion`)
) ENGINE=InnoDB
AUTO_INCREMENT=2589 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `investigador_fuentefinanciamiento` table : */

CREATE TABLE `investigador_fuentefinanciamiento` (
  `idInvestigador` BIGINT(20) NOT NULL,
  `idFuenteFinanciamiento` INTEGER(11) NOT NULL,
  PRIMARY KEY USING BTREE (`idInvestigador`, `idFuenteFinanciamiento`)
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `itempresupuesto` table : */

CREATE TABLE `itempresupuesto` (
  `idItemPresupuesto` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `idProyecto` BIGINT(20) NOT NULL,
  `idCuentaPresupuesto` BIGINT(20) NOT NULL,
  `item` VARCHAR(100) COLLATE latin1_swedish_ci NOT NULL,
  `monto` BIGINT(20) NOT NULL,
  `mes` INTEGER(11) DEFAULT NULL,
  `ano` INTEGER(11) DEFAULT NULL,
  `detalle` VARCHAR(255) COLLATE latin1_swedish_ci DEFAULT '',
  PRIMARY KEY USING BTREE (`idItemPresupuesto`)
) ENGINE=InnoDB
AUTO_INCREMENT=131 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `menu` table : */

CREATE TABLE `menu` (
  `idMenu` INTEGER(11) DEFAULT NULL,
  `etiqueta` VARCHAR(100) COLLATE latin1_swedish_ci DEFAULT NULL,
  `submenu` TINYINT(1) DEFAULT NULL,
  `orden` INTEGER(11) DEFAULT NULL,
  `activo` TINYINT(1) DEFAULT NULL,
  `href` VARCHAR(500) COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `migrations` table : */

CREATE TABLE `migrations` (
  `id` INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` INTEGER(11) NOT NULL,
  PRIMARY KEY USING BTREE (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `oficinaregistro` table : */

CREATE TABLE `oficinaregistro` (
  `idOficinaRegistro` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` INTEGER(11) NOT NULL,
  `codigo` VARCHAR(4) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY USING BTREE (`idOficinaRegistro`)
) ENGINE=InnoDB
AUTO_INCREMENT=78 CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci'
;

/* Structure for the `paises` table : */

CREATE TABLE `paises` (
  `idPais` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) COLLATE latin1_swedish_ci NOT NULL,
  `default` TINYINT(1) DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idPais`)
) ENGINE=InnoDB
AUTO_INCREMENT=6 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `perfil` table : */

CREATE TABLE `perfil` (
  `idPerfil` INTEGER(11) NOT NULL,
  `nombre` VARCHAR(45) COLLATE latin1_swedish_ci NOT NULL,
  `orden` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idPerfil`)
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `perfilinvestigador` table : */

CREATE TABLE `perfilinvestigador` (
  `idPerfilInvestigador` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY USING BTREE (`idPerfilInvestigador`)
) ENGINE=InnoDB
AUTO_INCREMENT=4 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `plandecuentas` table : */

CREATE TABLE `plandecuentas` (
  `codigoCuenta` VARCHAR(20) COLLATE latin1_swedish_ci NOT NULL,
  `nombreCuenta` VARCHAR(100) COLLATE latin1_swedish_ci NOT NULL,
  UNIQUE KEY `codigoCuenta` USING BTREE (`codigoCuenta`)
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `postulacion` table : */

CREATE TABLE `postulacion` (
  `idPostulacion` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(150) COLLATE latin1_swedish_ci NOT NULL,
  `descripcion` MEDIUMTEXT COLLATE latin1_swedish_ci,
  `codigoPostulacion` VARCHAR(30) COLLATE latin1_swedish_ci DEFAULT '',
  `fechaPostulacion` VARCHAR(8) COLLATE latin1_swedish_ci DEFAULT '',
  `idEstadoPostulacion` INTEGER(11) NOT NULL,
  `fechaEstado` VARCHAR(8) COLLATE latin1_swedish_ci DEFAULT '',
  `idConcurso` BIGINT(20) NOT NULL,
  `fechaCreacion` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `idIniciativa` BIGINT(20) NOT NULL,
  PRIMARY KEY USING BTREE (`idPostulacion`)
) ENGINE=InnoDB
AUTO_INCREMENT=13 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `postulacion_equipotrabajo` table : */

CREATE TABLE `postulacion_equipotrabajo` (
  `idPostulacion` BIGINT(20) NOT NULL,
  `idInvestigador` BIGINT(20) NOT NULL,
  `idFuenteFinanciamiento` BIGINT(20) NOT NULL,
  `idPerfil` INTEGER(11) NOT NULL,
  `horas` INTEGER(11) DEFAULT NULL,
  `porcentajeParticipacion` DECIMAL(10,0) DEFAULT 0,
  `principal` TINYINT(1) DEFAULT 0,
  PRIMARY KEY USING BTREE (`idPostulacion`, `idInvestigador`)
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `postulacion_estadopostulacion` table : */

CREATE TABLE `postulacion_estadopostulacion` (
  `idPostulacion_EstadoPostulacion` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `idPostulacion` INTEGER(11) NOT NULL,
  `idEstadoPostulacion` INTEGER(11) NOT NULL,
  `fechaEstado` CHAR(8) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY USING BTREE (`idPostulacion_EstadoPostulacion`)
) ENGINE=InnoDB
AUTO_INCREMENT=4 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `postulacion_etapa` table : */

CREATE TABLE `postulacion_etapa` (
  `idPostulacionEtapa` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `idPostulacion` BIGINT(20) DEFAULT NULL,
  `descripcion` VARCHAR(200) COLLATE latin1_swedish_ci NOT NULL,
  `fechaInicio` VARCHAR(9) COLLATE latin1_swedish_ci DEFAULT NULL,
  `fechaTermino` VARCHAR(8) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idPostulacionEtapa`)
) ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `postulacion_notas` table : */

CREATE TABLE `postulacion_notas` (
  `idNota` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `idPostulacion` BIGINT(20) NOT NULL,
  `nota` VARCHAR(255) COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `fechahora` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `idUsuario` INTEGER(11) NOT NULL,
  PRIMARY KEY USING BTREE (`idNota`)
) ENGINE=InnoDB
AUTO_INCREMENT=3 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `presupuestos` table : */

CREATE TABLE `presupuestos` (
  `idPresupuesto` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `idProyecto` BIGINT(20) NOT NULL,
  `fechaInicio` VARCHAR(8) COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `fechaTermino` VARCHAR(8) COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  PRIMARY KEY USING BTREE (`idPresupuesto`)
) ENGINE=InnoDB
AUTO_INCREMENT=2 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `presupuestos_detalles` table : */

CREATE TABLE `presupuestos_detalles` (
  `idPresupuestoDetalle` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `idPresupuesto` BIGINT(20) DEFAULT 0,
  `idCuenta` INTEGER(11) NOT NULL,
  `idSubcuenta` INTEGER(11) NOT NULL,
  `idFuenteFinanciamiento` INTEGER(11) NOT NULL,
  `detalle` VARCHAR(255) COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `monto` BIGINT(20) NOT NULL DEFAULT 0,
  `periodo` VARCHAR(6) COLLATE latin1_swedish_ci NOT NULL COMMENT 'AAAAMM  ejemplo: 201801',
  PRIMARY KEY USING BTREE (`idPresupuestoDetalle`)
) ENGINE=InnoDB
AUTO_INCREMENT=2 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `prioridadtarea` table : */

CREATE TABLE `prioridadtarea` (
  `idPrioridadTarea` SMALLINT(6) NOT NULL,
  `descripcion` VARCHAR(20) COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY USING BTREE (`idPrioridadTarea`)
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `programacion` table : */

CREATE TABLE `programacion` (
  `idProgramacion` INTEGER(11) NOT NULL,
  `descripcion` MEDIUMTEXT COLLATE utf8_general_ci,
  `fechaInicio` CHAR(8) COLLATE utf8_general_ci NOT NULL,
  `fechaTermino` CHAR(8) COLLATE utf8_general_ci NOT NULL,
  `estado` INTEGER(11) NOT NULL DEFAULT 1 COMMENT '1=Pendiente\n2=Finalizada',
  `idProyecto` INTEGER(11) NOT NULL,
  PRIMARY KEY USING BTREE (`idProgramacion`)
) ENGINE=InnoDB
CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `proteccion` table : */

CREATE TABLE `proteccion` (
  `idProteccion` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `idTecnologia` BIGINT(20) DEFAULT 0,
  `codigo` VARCHAR(20) COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `idTipoProteccion` INTEGER(11) DEFAULT NULL,
  `titulo` VARCHAR(500) COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `numeroSolicitud` VARCHAR(20) COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `idOficinaRegistro` INTEGER(11) DEFAULT NULL,
  `numeroPublicacion` VARCHAR(20) COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `numeroRegistro` VARCHAR(20) COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `idRepresentante` INTEGER(11) NOT NULL DEFAULT 0,
  `linkBaseDatos` VARCHAR(500) COLLATE latin1_swedish_ci DEFAULT '',
  `fechaCreacion` VARCHAR(8) COLLATE latin1_swedish_ci DEFAULT '',
  `idEstadoProteccion` INTEGER(11) DEFAULT NULL,
  `fechaEstado` VARCHAR(8) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idProteccion`)
) ENGINE=InnoDB
AUTO_INCREMENT=5 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `proteccion_estadoproteccion` table : */

CREATE TABLE `proteccion_estadoproteccion` (
  `idProteccion_EstadoProteccion` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `idProteccion` INTEGER(11) NOT NULL,
  `idEstadoProteccion` INTEGER(11) NOT NULL,
  `fechaEstado` CHAR(8) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY USING BTREE (`idProteccion_EstadoProteccion`)
) ENGINE=InnoDB
AUTO_INCREMENT=34 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `proteccion_notas` table : */

CREATE TABLE `proteccion_notas` (
  `idNota` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `idProteccion` BIGINT(20) NOT NULL,
  `nota` VARCHAR(255) COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `fechahora` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `idUsuario` INTEGER(11) NOT NULL,
  PRIMARY KEY USING BTREE (`idNota`)
) ENGINE=InnoDB
AUTO_INCREMENT=26 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `proyecto` table : */

CREATE TABLE `proyecto` (
  `idProyecto` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `codigoProyecto` VARCHAR(50) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `nombre` VARCHAR(150) COLLATE utf8_general_ci NOT NULL,
  `descripcion` MEDIUMTEXT COLLATE utf8_general_ci NOT NULL,
  `idPostulacion` VARCHAR(45) COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `idTipoProyecto` INTEGER(11) NOT NULL DEFAULT 0,
  `idUsuarioEncargado` INTEGER(11) NOT NULL DEFAULT 0,
  `idUnidadNegocio` INTEGER(11) NOT NULL DEFAULT 0,
  `fechaInicio` CHAR(8) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `fechaTermino` CHAR(8) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `idEstadoProyecto` INTEGER(11) NOT NULL DEFAULT 0,
  `fechaEstado` VARCHAR(8) COLLATE utf8_general_ci DEFAULT NULL,
  `totalProyecto` BIGINT(20) DEFAULT 0,
  `fechaCreacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY USING BTREE (`idProyecto`)
) ENGINE=InnoDB
AUTO_INCREMENT=13 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `proyecto_areaprioritaria` table : */

CREATE TABLE `proyecto_areaprioritaria` (
  `idProyecto` BIGINT(20) NOT NULL,
  `idArea` BIGINT(20) NOT NULL,
  PRIMARY KEY USING BTREE (`idProyecto`, `idArea`)
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `proyecto_centro` table : */

CREATE TABLE `proyecto_centro` (
  `idProyecto` BIGINT(20) NOT NULL,
  `idCentro` BIGINT(20) NOT NULL,
  PRIMARY KEY USING BTREE (`idProyecto`, `idCentro`)
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `proyecto_disciplinaconocimiento` table : */

CREATE TABLE `proyecto_disciplinaconocimiento` (
  `idProyecto` BIGINT(20) NOT NULL,
  `idDisciplinaConocimiento` BIGINT(20) DEFAULT NULL
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `proyecto_equipotrabajo` table : */

CREATE TABLE `proyecto_equipotrabajo` (
  `idProyecto` BIGINT(20) NOT NULL,
  `idInvestigador` BIGINT(20) NOT NULL,
  `idFuenteFinanciamiento` BIGINT(20) NOT NULL,
  `idPerfil` INTEGER(11) NOT NULL,
  `horas` INTEGER(11) DEFAULT NULL,
  `porcentajeParticipacion` DECIMAL(10,0) DEFAULT 0,
  `principal` TINYINT(1) DEFAULT 0,
  PRIMARY KEY USING BTREE (`idProyecto`, `idInvestigador`)
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `proyecto_estadoproyecto` table : */

CREATE TABLE `proyecto_estadoproyecto` (
  `idProyecto_EstadoProyecto` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `idProyecto` INTEGER(11) NOT NULL,
  `idEstadoProyecto` INTEGER(11) NOT NULL,
  `fechaEstado` CHAR(8) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY USING BTREE (`idProyecto_EstadoProyecto`)
) ENGINE=InnoDB
AUTO_INCREMENT=32 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `proyecto_etapa` table : */

CREATE TABLE `proyecto_etapa` (
  `idProyectoEtapa` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `idProyecto` BIGINT(20) DEFAULT NULL,
  `descripcion` VARCHAR(200) COLLATE latin1_swedish_ci NOT NULL,
  `fechaInicio` VARCHAR(9) COLLATE latin1_swedish_ci DEFAULT NULL,
  `fechaTermino` VARCHAR(8) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idProyectoEtapa`)
) ENGINE=InnoDB
AUTO_INCREMENT=10 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `proyecto_fuentefinanciamiento` table : */

CREATE TABLE `proyecto_fuentefinanciamiento` (
  `idProyecto_FuenteFinanciamiento` INTEGER(11) NOT NULL,
  `idProyecto` INTEGER(11) NOT NULL,
  `idFuenteFinanciamiento` INTEGER(11) NOT NULL,
  `idNombreFinanciamiento` INTEGER(11) NOT NULL,
  `idEstadoFinanciamiento` INTEGER(11) NOT NULL,
  `fechaEstado` CHAR(8) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY USING BTREE (`idProyecto_FuenteFinanciamiento`)
) ENGINE=InnoDB
CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `proyecto_notas` table : */

CREATE TABLE `proyecto_notas` (
  `idNota` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `idProyecto` BIGINT(20) NOT NULL,
  `nota` VARCHAR(255) COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `fechahora` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `idUsuario` INTEGER(11) NOT NULL,
  PRIMARY KEY USING BTREE (`idNota`)
) ENGINE=InnoDB
AUTO_INCREMENT=25 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `proyecto_sectorimpacto` table : */

CREATE TABLE `proyecto_sectorimpacto` (
  `idProyecto` BIGINT(20) DEFAULT NULL,
  `idSectorImpacto` BIGINT(20) DEFAULT NULL
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `representante` table : */

CREATE TABLE `representante` (
  `idRepresentante` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `rut` VARCHAR(15) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` VARCHAR(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccion` VARCHAR(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` VARCHAR(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numeroResolucionConvenio` VARCHAR(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idPais` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idRepresentante`)
) ENGINE=InnoDB
AUTO_INCREMENT=3 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `reservas` table : */

CREATE TABLE `reservas` (
  `idReserva` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `origen` SMALLINT(6) DEFAULT NULL,
  `idOrigen` BIGINT(20) DEFAULT NULL,
  `descripcion` VARCHAR(255) COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `monto` BIGINT(20) DEFAULT 0,
  `fechaHora` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `idUsuario` INTEGER(11) DEFAULT NULL,
  `idCuentaCorriente` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idReserva`)
) ENGINE=InnoDB
AUTO_INCREMENT=14 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `reservasdefondos` table : */

CREATE TABLE `reservasdefondos` (
  `idReserva` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `idOrigen` INTEGER(11) DEFAULT NULL,
  `numeroOrigen` BIGINT(20) DEFAULT NULL,
  `monto` BIGINT(20) DEFAULT NULL,
  `detalle` VARCHAR(20) COLLATE latin1_swedish_ci DEFAULT '255',
  `idUsuario` BIGINT(20) DEFAULT NULL,
  `fechaHoraCreacion` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `periodo` VARCHAR(10) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idReserva`)
) ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `sectorimpacto` table : */

CREATE TABLE `sectorimpacto` (
  `idSectorImpacto` INTEGER(11) NOT NULL,
  `nombre` VARCHAR(200) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY USING BTREE (`idSectorImpacto`)
) ENGINE=InnoDB
CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `subcuentaspresupuesto` table : */

CREATE TABLE `subcuentaspresupuesto` (
  `idSubcuenta` INTEGER(11) NOT NULL DEFAULT 0,
  `idCuenta` BIGINT(20) NOT NULL,
  `descripcion` VARCHAR(100) COLLATE latin1_swedish_ci DEFAULT '',
  PRIMARY KEY USING BTREE (`idSubcuenta`)
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `submenu` table : */

CREATE TABLE `submenu` (
  `idMenu` INTEGER(11) DEFAULT NULL,
  `idSubMenu` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `etiqueta` VARCHAR(255) COLLATE latin1_swedish_ci DEFAULT NULL,
  `href` VARCHAR(255) COLLATE latin1_swedish_ci DEFAULT NULL,
  `orden` INTEGER(11) DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idSubMenu`)
) ENGINE=InnoDB
AUTO_INCREMENT=17 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `tarea` table : */

CREATE TABLE `tarea` (
  `idTarea` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(100) COLLATE utf8_general_ci DEFAULT NULL,
  `fecha` CHAR(8) COLLATE utf8_general_ci NOT NULL,
  `hora` CHAR(5) COLLATE utf8_general_ci NOT NULL,
  `prioridad` SMALLINT(6) NOT NULL DEFAULT 1 COMMENT '1=Normal\r\n2=Alta',
  `estado` SMALLINT(6) NOT NULL DEFAULT 1 COMMENT '1=Pendiente\r\n2=Finalizada',
  `origen` SMALLINT(6) NOT NULL COMMENT '1=Idea, 2=Postulacion. 3=Proyecto, 4=Tecnologia, 5 = Proteccion, 6=Contrato',
  `idOrigen` INTEGER(11) NOT NULL,
  `alarma_fecha` CHAR(8) COLLATE utf8_general_ci DEFAULT '',
  `alarma_hora` VARCHAR(5) COLLATE utf8_general_ci DEFAULT '',
  `idUsuario` BIGINT(20) DEFAULT 0,
  PRIMARY KEY USING BTREE (`idTarea`)
) ENGINE=InnoDB
AUTO_INCREMENT=34 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `tecnologia` table : */

CREATE TABLE `tecnologia` (
  `idTecnologia` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(20) COLLATE latin1_swedish_ci DEFAULT '',
  `nombre` VARCHAR(255) COLLATE latin1_swedish_ci DEFAULT '',
  `descripcion` TEXT COLLATE latin1_swedish_ci,
  `idUsuarioEncargado` BIGINT(20) DEFAULT NULL,
  `idUnidad` INTEGER(11) NOT NULL DEFAULT 0,
  `idEstadoTecnologia` INTEGER(11) NOT NULL DEFAULT 0,
  `fechaEstado` VARCHAR(8) COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `fechaCreacion` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY USING BTREE (`idTecnologia`)
) ENGINE=InnoDB
AUTO_INCREMENT=5 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `tecnologia_areaprioritaria` table : */

CREATE TABLE `tecnologia_areaprioritaria` (
  `idTecnologia` BIGINT(20) NOT NULL,
  `idArea` BIGINT(20) NOT NULL,
  PRIMARY KEY USING BTREE (`idTecnologia`, `idArea`)
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `tecnologia_centro` table : */

CREATE TABLE `tecnologia_centro` (
  `idTecnologia` BIGINT(20) NOT NULL,
  `idCentro` BIGINT(20) NOT NULL,
  PRIMARY KEY USING BTREE (`idTecnologia`, `idCentro`)
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `tecnologia_disciplinaconocimiento` table : */

CREATE TABLE `tecnologia_disciplinaconocimiento` (
  `idTecnologia` BIGINT(20) NOT NULL,
  `idDisciplinaConocimiento` BIGINT(20) DEFAULT NULL
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `tecnologia_equipotrabajo` table : */

CREATE TABLE `tecnologia_equipotrabajo` (
  `idTecnologia` BIGINT(20) NOT NULL,
  `idInvestigador` BIGINT(20) NOT NULL,
  `idFuenteFinanciamiento` BIGINT(20) NOT NULL,
  `idPerfil` INTEGER(11) NOT NULL,
  `horas` INTEGER(11) DEFAULT NULL,
  `porcentajeParticipacion` DECIMAL(10,0) DEFAULT 0,
  `principal` TINYINT(1) DEFAULT 0,
  PRIMARY KEY USING BTREE (`idTecnologia`, `idInvestigador`)
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `tecnologia_estadotecnologia` table : */

CREATE TABLE `tecnologia_estadotecnologia` (
  `idTecnologia_EstadoTecnologia` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `idTecnologia` INTEGER(11) NOT NULL,
  `idEstadoTecnologia` INTEGER(11) NOT NULL,
  `fechaEstado` CHAR(8) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY USING BTREE (`idTecnologia_EstadoTecnologia`)
) ENGINE=InnoDB
AUTO_INCREMENT=7 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `tecnologia_notas` table : */

CREATE TABLE `tecnologia_notas` (
  `idNota` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `idTecnologia` BIGINT(20) NOT NULL,
  `nota` VARCHAR(255) COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `fechahora` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `idUsuario` INTEGER(11) NOT NULL,
  PRIMARY KEY USING BTREE (`idNota`)
) ENGINE=InnoDB
AUTO_INCREMENT=2 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `tecnologia_sectorimpacto` table : */

CREATE TABLE `tecnologia_sectorimpacto` (
  `idTecnologia` BIGINT(20) DEFAULT NULL,
  `idSectorImpacto` BIGINT(20) DEFAULT NULL
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `tipocontrato` table : */

CREATE TABLE `tipocontrato` (
  `idTipoContrato` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idTipoContrato`)
) ENGINE=InnoDB
AUTO_INCREMENT=4 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `tipodocumento` table : */

CREATE TABLE `tipodocumento` (
  `idTipoDocumento` INTEGER(11) NOT NULL,
  `nombre` VARCHAR(150) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY USING BTREE (`idTipoDocumento`)
) ENGINE=InnoDB
CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `tipoiniciativa` table : */

CREATE TABLE `tipoiniciativa` (
  `idTipoIniciativa` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY USING BTREE (`idTipoIniciativa`)
) ENGINE=InnoDB
AUTO_INCREMENT=5 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `tipoorigen` table : */

CREATE TABLE `tipoorigen` (
  `origen` INTEGER(11) DEFAULT NULL,
  `nombre` VARCHAR(30) COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `tipoproteccion` table : */

CREATE TABLE `tipoproteccion` (
  `idTipoProteccion` INTEGER(11) NOT NULL,
  `nombre` VARCHAR(50) COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idTipoProteccion`)
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `tipoproyecto` table : */

CREATE TABLE `tipoproyecto` (
  `idTipoProyecto` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY USING BTREE (`idTipoProyecto`)
) ENGINE=InnoDB
AUTO_INCREMENT=7 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'
;

/* Structure for the `unidad` table : */

CREATE TABLE `unidad` (
  `idUnidad` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY USING BTREE (`idUnidad`)
) ENGINE=InnoDB
AUTO_INCREMENT=3 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `users` table : */

CREATE TABLE `users` (
  `id` INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` VARCHAR(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` VARCHAR(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY USING BTREE (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=2 CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'
;

/* Structure for the `usuario` table : */

CREATE TABLE `usuario` (
  `idUsuario` INTEGER(11) NOT NULL AUTO_INCREMENT,
  `correo` VARCHAR(100) COLLATE latin1_swedish_ci NOT NULL,
  `nombreCompleto` VARCHAR(100) COLLATE latin1_swedish_ci NOT NULL,
  `password` VARCHAR(100) COLLATE latin1_swedish_ci NOT NULL,
  `activo` TINYINT(1) DEFAULT NULL,
  `administradorSistema` TINYINT(1) DEFAULT NULL,
  PRIMARY KEY USING BTREE (`idUsuario`)
) ENGINE=InnoDB
AUTO_INCREMENT=4 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `usuario_menu` table : */

CREATE TABLE `usuario_menu` (
  `idUsuario` INTEGER(11) DEFAULT NULL,
  `idMenu` INTEGER(11) DEFAULT NULL
) ENGINE=InnoDB
CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Structure for the `usuarios_perfil` table : */

CREATE TABLE `usuarios_perfil` (
  `idUsuario` INTEGER(11) NOT NULL,
  `idPerfil` INTEGER(11) NOT NULL,
  PRIMARY KEY USING BTREE (`idUsuario`, `idPerfil`)
) ENGINE=MyISAM
ROW_FORMAT=FIXED CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci'
;

/* Definition for the `FormatoFecha` function : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' FUNCTION `FormatoFecha`(
        `fecha` VARCHAR(10)
    )
    RETURNS VARCHAR(10) CHARACTER SET latin1
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
  DECLARE salida VARCHAR(10); 
 
  set salida=concat(substr(fecha,7,2), '/', substr(fecha,5,2), '/', substr(fecha,1,4));
  
  RETURN salida;
END$$

DELIMITER ;

/* Definition for the `FormatoFechaHora` function : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' FUNCTION `FormatoFechaHora`(
        `fechaHora` VARCHAR(20)
    )
    RETURNS VARCHAR(20) CHARACTER SET latin1
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
  DECLARE salida VARCHAR(20); 
  set salida= substr(fechaHora,1,10);
  
  set salida=concat(substr(salida,9,2), '/', substr(salida,6,2), '/', substr(salida,1,4), substr(fechaHora,11));
  
  RETURN salida;
END$$

DELIMITER ;

/* Definition for the `nombreMes` function : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' FUNCTION `nombreMes`(
        `mes` INTEGER
    )
    RETURNS VARCHAR(15) CHARACTER SET latin1
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
  DECLARE salida VARCHAR(15); 

  set @numeroMes=mes;
  if (@numeroMes = 1) THEN set @mesTexto="enero"; end if;
  if (@numeroMes = 2) THEN set @mesTexto="febrero"; end if;
  if (@numeroMes = 3) THEN set @mesTexto="marzo"; end if;
  IF (@numeroMes = 4) THEN set @mesTexto="abril"; end if;
  if (@numeroMes = 5) THEN set @mesTexto="mayo"; end if;
  if (@numeroMes = 6) THEN set @mesTexto="junio"; end if;
  IF (@numeroMes = 7) THEN set @mesTexto="julio"; end if;
  IF (@numeroMes = 8) THEN set @mesTexto="agosto"; end if;
  if (@numeroMes = 9) THEN set @mesTexto="septiembre"; end if;
  if (@numeroMes = 10) THEN set @mesTexto="octubre"; end if;
  if (@numeroMes = 11) THEN set @mesTexto="noviembre"; end if;
  if (@numeroMes = 12) THEN set @mesTexto="diciembre"; end if;
 
  set salida=@mesTexto;	
  RETURN salida;

END$$

DELIMITER ;

/* Definition for the `textoaFecha` function : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' FUNCTION `textoaFecha`(
        `fecha` VARCHAR(10)
    )
    RETURNS VARCHAR(10) CHARACTER SET latin1
    DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
  DECLARE salida varchar(10);
  SET salida = IF(TRIM(fecha) <> '', CONCAT(SUBSTR(fecha, 7, 2), '/', SUBSTR(fecha, 5, 2), '/', SUBSTR(fecha, 1, 4)), '');

  RETURN salida;
END$$

DELIMITER ;

/* Definition for the `spDelArea` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelArea`(
        IN `idArea` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Delete from `areas` where `areas`.`idArea`=idArea;

select idArea as idArea;

END$$

DELIMITER ;

/* Definition for the `spDelCentro` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelCentro`(
        IN `idCentro` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Delete from `centros` where `centros`.`idCentro`=idCentro;

select idCentro as idCentro;

END$$

DELIMITER ;

/* Definition for the `spDelCompromisoFinanciamiento` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelCompromisoFinanciamiento`(
        IN `idCompromisoFinanciamiento` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
Delete from `compromisosfinanciamiento` where `compromisosfinanciamiento`.`idCompromisoFinanciamiento`=idCompromisoFinanciamiento;

END$$

DELIMITER ;

/* Definition for the `spDelContratoEstado` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelContratoEstado`(
        IN `idContratoEstadoContrato` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

delete from `contrato_estadocontrato` 
where `contrato_estadocontrato`.`idContrato_EstadoContrato` =idContratoEstadoContrato;

END$$

DELIMITER ;

/* Definition for the `spDelContratoNota` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelContratoNota`(
        IN `idNota` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

delete from `contrato_notas` where `contrato_notas`.`idNota`=idNota;

END$$

DELIMITER ;

/* Definition for the `spDelDisciplinaConocimiento` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelDisciplinaConocimiento`(
        IN `idDisciplinaConocimiento` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Delete from `disciplinaconocimiento` where `disciplinaconocimiento`.`idDisciplinaConocimiento`=idDisciplinaConocimiento;

select idDisciplinaConocimiento as idDisciplinaConocimiento;

END$$

DELIMITER ;

/* Definition for the `spDelEstadoTecnologia` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelEstadoTecnologia`(
        IN `idEstadoTecnologia` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Delete from `estadotecnologia` where `estadotecnologia`.`idEstadoTecnologia`=idEstadoTecnologia;

select idEstadoTecnologia as idEstadoTecnologia;

END$$

DELIMITER ;

/* Definition for the `spDelIniciativaAreaPrioritaria` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelIniciativaAreaPrioritaria`(
        IN `idIniciativa` BIGINT,
        IN `idAreaPrioritaria` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

delete from `iniciativa_areaprioritaria` where 
`iniciativa_areaprioritaria`.`idIniciativa`=idIniciativa and 
`iniciativa_areaprioritaria`.`idArea`=idAreaPrioritaria;

END$$

DELIMITER ;

/* Definition for the `spDelIniciativaCentro` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelIniciativaCentro`(
        IN `idIniciativa` BIGINT,
        IN `idCentro` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

delete from `iniciativa_centro` where 
`iniciativa_centro`.`idIniciativa`=idIniciativa and 
`iniciativa_centro`.`idCentro`=idCentro;

END$$

DELIMITER ;

/* Definition for the `spDelIniciativaDisciplinaConocimiento` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelIniciativaDisciplinaConocimiento`(
        IN `idIniciativa` BIGINT,
        IN `idDisciplinaConocimiento` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

delete from `iniciativa_disciplinaconocimiento` where `iniciativa_disciplinaconocimiento`.`idIniciativa`=idIniciativa and `iniciativa_disciplinaconocimiento`.`idDisciplinaConocimiento`=idDisciplinaConocimiento;

END$$

DELIMITER ;

/* Definition for the `spDelIniciativaEstado` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelIniciativaEstado`(
        IN `idIniciativaEstadoIniciativa` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
set @idIniciativa=Coalesce((
                    Select i.`idIniciativa` from `iniciativa_estadoiniciativa` as i
                    where i.`idIniciativa_EstadoIniciativa`=idIniciativaEstadoIniciativa limit 1),0);

delete from `iniciativa_estadoiniciativa` 
where `iniciativa_estadoiniciativa`.`idIniciativa_EstadoIniciativa` =idIniciativaEstadoIniciativa;

Update iniciativa set `iniciativa`.`idEstadoIniciativa`=0, `iniciativa`.`fechaEstado`=null where iniciativa.`idIniciativa`=@idIniciativa;

if exists(select 1 from iniciativa_estadoiniciativa as i where i.`idIniciativa`=@idIniciativa) then
	select 
        @idEstado=i.`idEstadoIniciativa`,
        @fechaEstado=i.`fechaEstado`
    FROM
    	iniciativa_estadoiniciativa as i
    where      
    	i.`idIniciativa`=@idIniciativa
    order by
        i.`fechaEstado` DESC
    limit 1;
    
    Update iniciativa set `iniciativa`.`idEstadoIniciativa`=@idEstado, `iniciativa`.`fechaEstado`=@fechaEstado 
    where iniciativa.`idIniciativa`=@idIniciativa;
       
end if;
    
END$$

DELIMITER ;

/* Definition for the `spDelIniciativaIntegranteEquipo` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelIniciativaIntegranteEquipo`(
        IN `idIniciativa` BIGINT,
        IN `idInvestigador` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Delete from `iniciativa_equipotrabajo` where `iniciativa_equipotrabajo`.`idIniciativa`=idIniciativa and `iniciativa_equipotrabajo`.`idInvestigador`=idInvestigador;

END$$

DELIMITER ;

/* Definition for the `spDelIniciativaNota` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelIniciativaNota`(
        IN `idNota` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

delete from `iniciativa_notas` where `iniciativa_notas`.`idNota`=idNota;

END$$

DELIMITER ;

/* Definition for the `spDelIniciativaSectorImpacto` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelIniciativaSectorImpacto`(
        IN `idIniciativa` BIGINT,
        IN `idSectorImpacto` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

delete from `iniciativa_sectorimpacto` where `iniciativa_sectorimpacto`.`idIniciativa`=idIniciativa and `iniciativa_sectorimpacto`.`idSectorImpacto`=idSectorImpacto;

END$$

DELIMITER ;

/* Definition for the `spDelIntegranteEquipo` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelIntegranteEquipo`(
        IN `idProyecto` BIGINT,
        IN `idInvestigador` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Delete from `proyecto_equipotrabajo` where `proyecto_equipotrabajo`.`idProyecto`=idProyecto and `proyecto_equipotrabajo`.`idInvestigador`=idInvestigador;

END$$

DELIMITER ;

/* Definition for the `spDelItemPresupuesto` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelItemPresupuesto`(
        IN `idItemPresupuesto` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

delete from `itempresupuesto` where `itempresupuesto`.`idItemPresupuesto`=idItemPresupuesto;

select idItemPresupuesto as idItemPresupuesto;


END$$

DELIMITER ;

/* Definition for the `spDelPostulacionEstado` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelPostulacionEstado`(
        IN `idPostulacionEstadoPostulacion` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

delete from `postulacion_estadopostulacion` 
where `postulacion_estadopostulacion`.`idPostulacion_EstadoPostulacion` =idPostulacionEstadoPostulacion;

END$$

DELIMITER ;

/* Definition for the `spDelPostulacionIntegranteEquipo` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelPostulacionIntegranteEquipo`(
        IN `idPostulacion` BIGINT,
        IN `idInvestigador` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Delete from `postulacion_equipotrabajo` where `postulacion_equipotrabajo`.`idPostulacion`=idPostulacion and `postulacion_equipotrabajo`.`idInvestigador`=idInvestigador;

END$$

DELIMITER ;

/* Definition for the `spDelPostulacionNota` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelPostulacionNota`(
        IN `idNota` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

delete from `postulacion_notas` where `postulacion_notas`.`idNota`=idNota;

END$$

DELIMITER ;

/* Definition for the `spDelProyectoAreaPrioritaria` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelProyectoAreaPrioritaria`(
        IN `idProyecto` BIGINT,
        IN `idAreaPrioritaria` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

delete from `proyecto_areaprioritaria` where 
`proyecto_areaprioritaria`.`idProyecto`=idProyecto and 
`proyecto_areaprioritaria`.`idArea`=idAreaPrioritaria;

END$$

DELIMITER ;

/* Definition for the `spDelProyectoCentro` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelProyectoCentro`(
        IN `idProyecto` BIGINT,
        IN `idCentro` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

delete from `proyecto_centro` where 
`proyecto_centro`.`idProyecto`=idProyecto and 
`proyecto_centro`.`idCentro`=idCentro;

END$$

DELIMITER ;

/* Definition for the `spDelProyectoDisciplinaConocimiento` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelProyectoDisciplinaConocimiento`(
        IN `idProyecto` BIGINT,
        IN `idDisciplinaConocimiento` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

delete from `proyecto_disciplinaconocimiento` where `proyecto_disciplinaconocimiento`.`idProyecto`=idProyecto and `proyecto_disciplinaconocimiento`.`idDisciplinaConocimiento`=idDisciplinaConocimiento;

END$$

DELIMITER ;

/* Definition for the `spDelProyectoEstado` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelProyectoEstado`(
        IN `idProyectoEstadoProyecto` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

delete from `proyecto_estadoproyecto` 
where `proyecto_estadoproyecto`.`idProyecto_EstadoProyecto` =idProyectoEstadoProyecto;

END$$

DELIMITER ;

/* Definition for the `spDelProyectoEtapa` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelProyectoEtapa`(
        IN `idProyectoEtapa` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Delete from `proyecto_etapa` where `proyecto_etapa`.`idProyectoEtapa`=idProyectoEtapa;

END$$

DELIMITER ;

/* Definition for the `spDelProyectoNota` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelProyectoNota`(
        IN `idNota` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

delete from `proyecto_notas` where `proyecto_notas`.`idNota`=idNota;

END$$

DELIMITER ;

/* Definition for the `spDelProyectoSectorImpacto` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelProyectoSectorImpacto`(
        IN `idProyecto` BIGINT,
        IN `idSectorImpacto` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

delete from `proyecto_sectorimpacto` where `proyecto_sectorimpacto`.`idProyecto`=idProyecto and `proyecto_sectorimpacto`.`idSectorImpacto`=idSectorImpacto;

END$$

DELIMITER ;

/* Definition for the `spDelSectorImpacto` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelSectorImpacto`(
        IN `idSectorImpacto` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Delete from `sectorimpacto` where `sectorimpacto`.`idSectorImpacto`=idSectorImpacto;

select idSectorImpacto as idSectorImpacto;

END$$

DELIMITER ;

/* Definition for the `spDelTarea` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelTarea`(
        IN `idTarea` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Delete from `tarea` where tarea.`idTarea`=idTarea;

END$$

DELIMITER ;

/* Definition for the `spDelTecnologiaAreaPrioritaria` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelTecnologiaAreaPrioritaria`(
        IN `idTecnologia` BIGINT,
        IN `idAreaPrioritaria` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

delete from `tecnologia_areaprioritaria` where 
`tecnologia_areaprioritaria`.`idTecnologia`=idTecnologia and 
`tecnologia_areaprioritaria`.`idArea`=idAreaPrioritaria;

END$$

DELIMITER ;

/* Definition for the `spDelTecnologiaCentro` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelTecnologiaCentro`(
        IN `idTecnologia` BIGINT,
        IN `idCentro` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

delete from `tecnologia_centro` where 
`tecnologia_centro`.`idTecnologia`=idTecnologia and 
`tecnologia_centro`.`idCentro`=idCentro;

END$$

DELIMITER ;

/* Definition for the `spDelTecnologiaDisciplinaConocimiento` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelTecnologiaDisciplinaConocimiento`(
        IN `idTecnologia` BIGINT,
        IN `idDisciplinaConocimiento` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

delete from `Tecnologia_disciplinaconocimiento` where `Tecnologia_disciplinaconocimiento`.`idTecnologia`=idTecnologia and `Tecnologia_disciplinaconocimiento`.`idDisciplinaConocimiento`=idDisciplinaConocimiento;

END$$

DELIMITER ;

/* Definition for the `spDelTecnologiaEstado` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelTecnologiaEstado`(
        IN `idTecnologiaEstadoTecnologia` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
set @idTecnologia=Coalesce((
                    Select i.`idTecnologia` from `tecnologia_estadotecnologia` as i
                    where i.`idTecnologia_EstadoTecnologia`=idTecnologiaEstadoTecnologia limit 1),0);

delete from `tecnologia_estadotecnologia` 
where `tecnologia_estadotecnologia`.`idTecnologia_EstadoTecnologia` =idTecnologiaEstadoTecnologia;

Update tecnologia set `tecnologia`.`idEstadoTecnologia`=0, `tecnologia`.`fechaEstado`=null where tecnologia.`idTecnologia`=@idTecnologia;

if exists(select 1 from tecnologia_estadotecnologia as i where i.`idTecnologia`=@idTecnologia) then
	select 
        @idEstado=i.`idEstadoTecnologia`,
        @fechaEstado=i.`fechaEstado`
    FROM
    	tecnologia_estadotecnologia as i
    where      
    	i.`idTecnologia`=@idTecnologia
    order by
        i.`fechaEstado` DESC
    limit 1;
    
    Update tecnologia set `tecnologia`.`idEstadoTecnologia`=@idEstado, `tecnologia`.`fechaEstado`=@fechaEstado 
    where tecnologia.`idTecnologia`=@idTecnologia;
       
end if;
    
END$$

DELIMITER ;

/* Definition for the `spDelTecnologiaIntegranteEquipo` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelTecnologiaIntegranteEquipo`(
        IN `idTecnologia` BIGINT,
        IN `idInvestigador` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Delete from `tecnologia_equipotrabajo` where `tecnologia_equipotrabajo`.`idTecnologia`=idTecnologia and `tecnologia_equipotrabajo`.`idInvestigador`=idInvestigador;

END$$

DELIMITER ;

/* Definition for the `spDelTecnologiaNota` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelTecnologiaNota`(
        IN `idNota` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

delete from `tecnologia_notas` where `tecnologia_notas`.`idNota`=idNota;

END$$

DELIMITER ;

/* Definition for the `spDelTecnologiaSectorImpacto` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelTecnologiaSectorImpacto`(
        IN `idTecnologia` BIGINT,
        IN `idSectorImpacto` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

delete from `tecnologia_sectorimpacto` where `tecnologia_sectorimpacto`.`idTecnologia`=idTecnologia and `tecnologia_sectorimpacto`.`idSectorImpacto`=idSectorImpacto;

END$$

DELIMITER ;

/* Definition for the `spDelTipoProyecto` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelTipoProyecto`(
        IN `idTipoProyecto` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Delete from `tipoproyecto` where `tipoproyecto`.`idTipoProyecto`=idTipoProyecto;

select idTipoProyecto as idTipoProyecto;

END$$

DELIMITER ;

/* Definition for the `spDelUnidad` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spDelUnidad`(
        IN `idUnidad` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Delete from `unidad` where `unidad`.`idUnidad`=idUnidad;

select idUnidad as idUnidad;

END$$

DELIMITER ;

/* Definition for the `spGetAreas` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetAreas`()
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN


Select
	c.`idArea`,
    c.`nombre`
from
    `areas` as c
order by
     c.`nombre`;

END$$

DELIMITER ;

/* Definition for the `spGetCentros` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetCentros`()
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
	c.`idCentro`,
    c.`nombre`
from
    `centros` as c
order by
     c.`nombre`;

END$$

DELIMITER ;

/* Definition for the `spGetCompromisosFinanciamiento` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetCompromisosFinanciamiento`(
        IN `origen` TINYINT,
        IN `idOrigen` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

select 
	f.`idCompromisoFinanciamiento`,
    ff.`nombre` as fuenteFinanciamiento,
    case when f.`tipoFinanciamiento`=1 then
    	'Pecuniario'
    else 
    	'Valorizado'
    end as tipoFinanciamiento,    
	f.`montoFinanciamiento`,
    `FormatoFecha`(f.`fechaComprometida`) as fechaComprometida
from
    `compromisosfinanciamiento` as f
    inner join `fuentefinanciamiento` as ff on ( ff.`idFuenteFinanciamiento`=f.`idFuenteFinanciamiento` )
where
    f.`origen`=origen and
    f.`idOrigen`=idOrigen
order by
    f.`idCompromisoFinanciamiento` ;    


END$$

DELIMITER ;

/* Definition for the `spGetContrato` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetContrato`(
        IN `idContrato` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

select
   p.`idContrato`,
   p.`nombre`,
   p.`descripcion`,
   p.`codigoContrato`,
   left( FormatoFechaHora(p.`fechaCreacion`),10) as fechaCreacion,
   p.`idEstadoContrato`,
   p.`idTipoContrato`,
   coalesce(tp.`nombre`,'') as nombreTipoContrato,
   p.`idUnidadNegocio`,
   coalesce(u.`nombre`,'') as nombreUnidad,
   p.`idUsuarioEncargado`,
   Case when coalesce( p.`fechaEstado`,'') <> '' then
        concat( right(p.`fechaEstado`,2), '/', left( right(p.`fechaEstado`,4),2) , '/', left(p.`fechaEstado`,4))
   Else
        ''
   End as fechaEstado,
   coalesce(ep.`nombre`,'') as nombreEstado
from
   contrato as p 
   left join `estadocontrato` as ep on ( ep.`idEstadoContrato`= p.`idEstadoContrato` )
   left join `tipocontrato` as tp on ( tp.`idTipoContrato`=p.`idTipoContrato` )
   left join `unidad` as u on ( u.`idUnidad`=p.`idUnidadNegocio`)
where 
    p.`idContrato` = idContrato limit 1;

END$$

DELIMITER ;

/* Definition for the `spGetContratoEstados` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetContratoEstados`(
        IN `idContrato` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
	pf.`idContrato_EstadoContrato`,
    ff.`idEstadoContrato`,
    ff.`nombre`,
    concat( right(pf.`fechaEstado`,2), '/', left( right(pf.`fechaEstado`,4),2) , '/', left(pf.`fechaEstado`,4)) as fechaEstado   
from
	`contrato_estadocontrato` as pf
    inner join `estadocontrato` as ff on ( ff.`idEstadoContrato`=pf.`idEstadoContrato` )
where
    pf.`idContrato`= idContrato
order by
    pf.`fechaEstado` desc;

END$$

DELIMITER ;

/* Definition for the `spGetContratoFuenteFinanciamiento` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetContratoFuenteFinanciamiento`(
        IN `idContrato` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
   cf.`idContrato`,
   cf.`idFuenteFinanciamiento`,
   coalesce(ff.`rut`,'') as identificadorUnico,
   ff.`nombre`,
   cf.`contacto` 
from
   `contrato_fuentefinanciamiento` as cf
   inner join `fuentefinanciamiento` as ff on ( ff.`idFuenteFinanciamiento`=cf.`idFuenteFinanciamiento` )
where
	cf.`idContrato`=idContrato;

END$$

DELIMITER ;

/* Definition for the `spGetContratoNotas` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetContratoNotas`(
        IN `idContrato` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select 
    n.`nota`,
    `FormatoFechaHora`(n.`fechahora`) as fechahora,
    u.`nombreCompleto` as nombreUsuario,
    n.`idNota`
from 
   `contrato_notas` as n
	inner join `usuario` as u on ( u.`idUsuario`=n.`idUsuario` )
Where
    n.`idContrato`=idContrato
Order by
    n.`idNota` desc;       


END$$

DELIMITER ;

/* Definition for the `spGetContratos` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetContratos`()
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
select
  c.`idContrato`,
  c.`codigoContrato`,
  c.`nombre`,
  left( `FormatoFechaHora`( c.`fechaCreacion` ),10) as fechaCreacion,
  tc.`nombre` as tipoContrato,
  uni.`nombre` as nombreUnidad,
  u.`nombreCompleto` as nombreUsuarioEncargado,
  `ec`.`nombre` as estadoContrato,
  `FormatoFecha`(c.`fechaEstado`) as fechaEstado
from
  contrato as c
  inner join `tipocontrato` as tc on ( tc.`idTipoContrato`=c.`idTipoContrato` )
  inner join `estadocontrato` as ec on ( ec.`idEstadoContrato`=c.`idEstadoContrato` )
  inner join `unidad` as uni on ( uni.`idUnidad`=c.`idUnidadNegocio` )
  inner join `usuario` as u on ( u.`idUsuario`=c.`idUsuarioEncargado` );
END$$

DELIMITER ;

/* Definition for the `spGetCuentaCorriente` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetCuentaCorriente`(
        IN `idCuentaCorriente` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
  cc.*,
  Coalesce( p.`codigoProyecto`,'-') as codigoProyecto,
  Coalesce( p.`idProyecto`,0) as idProyecto
from
   `cuentacorriente` as cc
   left join proyecto as p on ( p.`idProyecto`=cc.`idProyecto` )
where
   cc.`idCuentaCorriente`=idCuentaCorriente;

END$$

DELIMITER ;

/* Definition for the `spGetCuentaCorrienteMovimientos` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetCuentaCorrienteMovimientos`(
        IN `idCuentaCorriente` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN


select 
    `FormatoFecha`( ic.`fecha`) as fecha,
    ic.`detalle`,
    coalesce( ff.`nombre`, '') as nombre,
    t.`nombre` as Origen,
    ic.`idOrigen` as Numero,    
    ic.`monto` as ingreso,
    0 as egreso

from
    `ingresoctacte` as ic
    inner join `tipoorigen` as t on ( t.`tipoOrigen`=ic.`origen` )
    left join `fuentefinanciamiento` as ff on ( ff.`idFuenteFinanciamiento` = ic.`idFinancista` )
where
     ic.`idCuentaCorriente`=idCuentaCorriente
Union all
Select
    `FormatoFecha`( e.`fecha`) as fecha,
    e.`detalle`,
    '' as nombre,
    t.`nombre` as Origen,
    e.`idOrigen` as Numero,            
    0 as ingreso,
    e.`monto` as egreso

from
    `egresoctacte` as e
    inner join `tipoorigen` as t on ( t.`tipoOrigen`=e.`origen` )
where
     e.`idCuentaCorriente`=idCuentaCorriente
order by           
    1;



END$$

DELIMITER ;

/* Definition for the `spGetCuentasCorrientes` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetCuentasCorrientes`()
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
   cc.*,
  Coalesce( p.`codigoProyecto`,'-') as codigoProyecto
from
   `cuentacorriente` as cc
   left join proyecto as p on ( p.`idProyecto`=cc.`idProyecto` )
order by
   cc.`numeroCuenta`;

END$$

DELIMITER ;

/* Definition for the `spGetDatosInvestigador` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetDatosInvestigador`(
        IN `idInvestigador` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

select
   i.`numeroIdentificacion`,
   i.`apellidos`,
   i.`nombres`,
   coalesce(i.`email`,'') as email,
   i.`idPerfilInvestigador`,
   pf.`nombre` as perfilInvestigador
from
   `investigador` as i
   inner join `perfilinvestigador` as pf on ( pf.`idPerfilInvestigador`=i.`idPerfilInvestigador` )
where
    i.`idInvestigador`=idInvestigador
Limit 1;   

END$$

DELIMITER ;

/* Definition for the `spGetDetallePresupuesto` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetDetallePresupuesto`(
        IN `idPresupuesto` TINYINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN


Select
   cp.`descripcion` as cuenta,
   sp.`descripcion` as subcuenta,
   d.`detalle`,
   ff.`nombre` as FuenteFinanciamiento,
   d.`monto`,
   d.`periodo`
from
   `presupuestos_detalles` as d
   inner join `cuentaspresupuesto` as cp on ( cp.`idCuenta`=d.`idCuenta` )
   inner join `subcuentaspresupuesto` as sp on ( sp.`idSubcuenta`=d.`idSubcuenta` )
   inner join `fuentefinanciamiento` as ff on ( ff.`idFuenteFinanciamiento`=d.`idFuenteFinanciamiento` )
where
   d.`idPresupuesto`= idPresupuesto;


END$$

DELIMITER ;

/* Definition for the `spGetDisciplinasdeConocimiento` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetDisciplinasdeConocimiento`()
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

select 
    d.`idDisciplinaConocimiento`,
    d.`nombre`
from
   `disciplinaconocimiento` as d
order by
    d.`idDisciplinaConocimiento`;
END$$

DELIMITER ;

/* Definition for the `spGetEgresos` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetEgresos`(
        IN `origen` BIGINT,
        IN `idProyecto` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
select
	`FormatoFecha`(ic.`fecha`) as fecha,
    ic.`monto`,
    ic.`detalle`,
    ic.`comprobanteEgreso`,
    ic.`ordenCompra`
from
    `egresoctacte` as ic
where
    ic.`origen`=origen and
    ic.`idOrigen`=idProyecto
order by
 	ic.`fecha`;    


END$$

DELIMITER ;

/* Definition for the `spGetIngresos` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetIngresos`(
        IN `origen` SMALLINT,
        IN `idProyecto` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
select
	`FormatoFecha`(ic.`fecha`) as fecha,
    ic.`monto`,
    ff.`nombre` as FuenteFinanciamiento,
    ic.`detalle`
from
    `ingresoctacte` as ic
    inner join `fuentefinanciamiento` as ff on ( ff.`idFuenteFinanciamiento`=ic.`idFinancista` )
where
    ic.`origen`=origen and
    ic.`idOrigen`=idProyecto
order by
    ic.`fecha`;    


END$$

DELIMITER ;

/* Definition for the `spGetIniciativa` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetIniciativa`(
        IN `idIniciativa` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

select
   p.`idIniciativa`,
   p.`nombre`,
   p.`descripcion`,
   p.`fechaCreacion` as fechaCreacion,
   p.`idEstadoIniciativa`,
   p.`idUnidadNegocio`,
   coalesce(u.`nombre`,'') as nombreUnidad,
   p.`idUsuarioEncargado`,
   Case when coalesce( p.`fechaEstado`,'') <> '' then
        concat( right(p.`fechaEstado`,2), '/', left( right(p.`fechaEstado`,4),2) , '/', left(p.`fechaEstado`,4))
   Else
        ''
   End as fechaEstado,
   coalesce(ep.`nombre`,'') as nombreEstado,
   p.`idTipoIniciativa`
from
   `iniciativa` as p 
   left join `estadoiniciativa` as ep on ( ep.`idEstadoIniciativa`= p.`idEstadoIniciativa` )
   left join `unidad` as u on ( u.`idUnidad`=p.`idUnidadNegocio`)
where 
    p.`idIniciativa` = idIniciativa limit 1;

END$$

DELIMITER ;

/* Definition for the `spGetIniciativaAreasPrioritarias` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetIniciativaAreasPrioritarias`(
        IN `idIniciativa` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
    ff.`idArea`,
    ff.`nombre`
from
	`iniciativa_areaPrioritaria` as pf
    inner join `areas` as ff on ( ff.`idArea`=pf.`idArea` )
where
    pf.`idIniciativa`= idIniciativa;

END$$

DELIMITER ;

/* Definition for the `spGetIniciativaCentros` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetIniciativaCentros`(
        IN `idIniciativa` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
    ff.`idCentro`,
    ff.`nombre`
from
	`iniciativa_centro` as pf
    inner join `centros` as ff on ( ff.`idCentro`=pf.`idCentro` )
where
    pf.`idIniciativa`= idIniciativa;

END$$

DELIMITER ;

/* Definition for the `spGetIniciativaDisciplinaConocimiento` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetIniciativaDisciplinaConocimiento`(
        IN `idIniciativa` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
    ff.`idDisciplinaConocimiento`,
    ff.`nombre`
from
	`iniciativa_disciplinaconocimiento` as pf
    inner join `disciplinaconocimiento` as ff on ( ff.`idDisciplinaConocimiento`=pf.`idDisciplinaConocimiento` )
where
    pf.`idIniciativa`= idIniciativa;

END$$

DELIMITER ;

/* Definition for the `spGetIniciativaEquipoTrabajo` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetIniciativaEquipoTrabajo`(
        IN `idIniciativa` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
    i.`idInvestigador`,
    i.`numeroIdentificacion`,
    i.`apellidos`,
    i.`nombres`,
    coalesce(i.`email`,'') as email,
    ff.`nombre` as fuenteFinanciamiento,
    pe.`porcentajeParticipacion`,
    pe.`principal`,
    pf.`nombre` as perfil,
    pe.`horas`
from
    `iniciativa_equipotrabajo` as pe 
    inner join `investigador` as i on ( i.`idInvestigador`=pe.`idInvestigador` )
    inner join `fuentefinanciamiento` as ff on ( ff.`idFuenteFinanciamiento`=pe.`idFuenteFinanciamiento` )
    inner join `perfilinvestigador` as pf on ( pf.`idPerfilInvestigador`=pe.`idPerfil` )
where
    pe.`idIniciativa`=idIniciativa;    


END$$

DELIMITER ;

/* Definition for the `spGetIniciativaEstados` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetIniciativaEstados`(
        IN `idIniciativa` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
	pf.`idIniciativa_EstadoIniciativa`,
    ff.`idEstadoIniciativa`,
    ff.`nombre`,
    concat( right(pf.`fechaEstado`,2), '/', left( right(pf.`fechaEstado`,4),2) , '/', left(pf.`fechaEstado`,4)) as fechaEstado   
from
	`iniciativa_estadoiniciativa` as pf
    inner join `estadoiniciativa` as ff on ( ff.`idEstadoIniciativa`=pf.`idEstadoIniciativa` )
where
    pf.`idIniciativa`= idIniciativa
order by
    pf.`fechaEstado` desc;

END$$

DELIMITER ;

/* Definition for the `spGetIniciativaEtapas` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetIniciativaEtapas`(
        IN `idIniciativa` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select 
    p.`descripcion`,
    `FormatoFecha`( p.`fechaInicio`) as fechaInicio,
    `FormatoFecha`( p.`fechaTermino`) as fechaTermino,
    p.`idIniciativaEtapa`
from
   `iniciativa_etapa` as p
Where
    p.`idIniciativa`=idIniciativa
order by 
    p.`fechaInicio`;   

END$$

DELIMITER ;

/* Definition for the `spGetIniciativaNotas` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetIniciativaNotas`(
        IN `idIniciativa` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select 
    n.`nota`,
    `FormatoFechaHora`(n.`fechahora`) as fechahora,
    u.`nombreCompleto` as nombreUsuario,
    n.`idNota`
from 
   `iniciativa_notas` as n
	inner join `usuario` as u on ( u.`idUsuario`=n.`idUsuario` )
Where
    n.`idIniciativa`=idIniciativa
Order by
    n.`idNota` desc;       


END$$

DELIMITER ;

/* Definition for the `spGetIniciativaPostulaciones` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetIniciativaPostulaciones`(
        IN `idIniciativa` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

select
    p.`idPostulacion`,
    p.`nombre`,
    p.`codigoPostulacion`,
    FormatoFecha(p.`fechaPostulacion`) as fechaPostulacion,
    ep.`nombre` as estadoPostulacion,
    formatoFecha(p.`fechaEstado`) as fechaEstadoPostulacion,
    formatoFecha( replace( substring( p.`fechaCreacion`,1,10),'-','')) as fechaCreacion
from
   `postulacion` as p
   inner join `estadopostulacion` as ep on ( ep.`idEstadoPostulacion`=p.`idEstadoPostulacion`)
where 
    p.`idIniciativa`=idIniciativa;
END$$

DELIMITER ;

/* Definition for the `spGetIniciativas` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetIniciativas`()
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
select
   p.`idIniciativa`,
   p.`nombre`,
   `FormatoFecha`( replace( left(p.`fechaCreacion`,10),'-','')) as fechaCreacion,
   coalesce( ti.`nombre`,'') as tipoIniciativa,
   coalesce( u.`nombre`, '') as unidad,
   coalesce(ep.`nombre`,'') as estadoIniciativa,
   coalesce( `FormatoFecha`(p.`fechaEstado`),'') as fechaEstado,
   Coalesce( ( 
        select
            concat(i.`nombres`, ' ', i.`apellidos`)  
        from 
        	`investigador` as i
            inner join `iniciativa_equipotrabajo` as pe on ( i.`idInvestigador`=pe.`idInvestigador` )
        where 
        	pe.`idIniciativa`=p.`idIniciativa` and
            pe.`principal`=1
        limit 1),'')  as nombreInvestigador           
from
   iniciativa as p
   left join `estadoiniciativa` as ep on ( ep.`idEstadoIniciativa`=p.`idEstadoIniciativa`)
   left join `tipoiniciativa` as ti on ( ti.`idTipoIniciativa`=p.`idTipoIniciativa`)
   left join `unidad` as u on ( u.`idUnidad`=p.`idUnidadNegocio`);

END$$

DELIMITER ;

/* Definition for the `spGetIniciativaSectorImpacto` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetIniciativaSectorImpacto`(
        IN `idIniciativa` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
    ff.`idSectorImpacto`,
    ff.`nombre`
from
	`iniciativa_sectorimpacto` as pf
    inner join `sectorimpacto` as ff on ( ff.`idSectorImpacto`=pf.`idSectorImpacto` )
where
    pf.`idIniciativa`= idIniciativa;

END$$

DELIMITER ;

/* Definition for the `spGetInvestigadores` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetInvestigadores`(
        IN `cadenabusqueda` VARCHAR(100)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN


Select
    i.`idInvestigador`,
    i.`numeroIdentificacion`,
    i.`apellidos`,
    i.`nombres`
from
    investigador as i
where
    CONCAT( i.`nombres`, ' ', i.`apellidos` ) like CONCAT('%',cadenabusqueda,'%')
ORDER BY
    2,3 ;   





END$$

DELIMITER ;

/* Definition for the `spGetInvestigadorFuenteFinanciamiento` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetInvestigadorFuenteFinanciamiento`(
        IN `idInvestigador` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
SELECT
   f.`idFuenteFinanciamiento`,
   f.`nombre`
from
   `investigador_fuentefinanciamiento` as i
   inner join `fuentefinanciamiento` as f on ( f.`idFuenteFinanciamiento`=i.`idFuenteFinanciamiento`)
where
   i.`idInvestigador`=idInvestigador
order by
   f.`nombre`;   
END$$

DELIMITER ;

/* Definition for the `spGetMenus` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetMenus`()
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
Select * from menu order by orden;
END$$

DELIMITER ;

/* Definition for the `spGetOficinaRegistro` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetOficinaRegistro`()
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select * from `oficinaregistro` as ofr order by ofr.`nombre`;

END$$

DELIMITER ;

/* Definition for the `spGetPaises` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetPaises`()
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
select p.`idPais`, p.`nombre` from paises as p order by p.`nombre`;
END$$

DELIMITER ;

/* Definition for the `spGetPostulacion` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetPostulacion`(
        IN `idPostulacion` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

select
   p.`idPostulacion`,
   p.`nombre`,
   p.`descripcion`,
   p.`codigoPostulacion`,
   `FormatoFecha`( p.`fechaPostulacion`) as fechaPostulacion,
   p.`idEstadoPostulacion`,
   Case when coalesce( p.`fechaEstado`,'') <> '' then
        concat( right(p.`fechaEstado`,2), '/', left( right(p.`fechaEstado`,4),2) , '/', left(p.`fechaEstado`,4))
   Else
        ''
   End as fechaEstado,
   coalesce(ep.`nombre`,'') as nombreEstado
from
   `postulacion` as p 
   left join `estadopostulacion` as ep on ( ep.`idEstadoPostulacion`= p.`idEstadoPostulacion` )
where 
    p.`idPostulacion` = idPostulacion limit 1;

END$$

DELIMITER ;

/* Definition for the `spGetPostulacionEquipoTrabajo` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetPostulacionEquipoTrabajo`(
        IN `idPostulacion` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
    i.`idInvestigador`,
    i.`numeroIdentificacion`,
    i.`apellidos`,
    i.`nombres`,
    coalesce(i.`email`,'') as email,
    ff.`nombre` as fuenteFinanciamiento,
    pe.`porcentajeParticipacion`,
    pe.`principal`,
    pf.`nombre` as perfil,
    pe.`horas`
from
    `postulacion_equipotrabajo` as pe 
    inner join `investigador` as i on ( i.`idInvestigador`=pe.`idInvestigador` )
    inner join `fuentefinanciamiento` as ff on ( ff.`idFuenteFinanciamiento`=pe.`idFuenteFinanciamiento` )
    inner join `perfilinvestigador` as pf on ( pf.`idPerfilInvestigador`=pe.`idPerfil` )
where
    pe.`idPostulacion`=idPostulacion;    


END$$

DELIMITER ;

/* Definition for the `spGetPostulacionEstados` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetPostulacionEstados`(
        IN `idPostulacion` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
	pf.`idPostulacion_EstadoPostulacion`,
    ff.`idEstadoPostulacion`,
    ff.`nombre`,
    concat( right(pf.`fechaEstado`,2), '/', left( right(pf.`fechaEstado`,4),2) , '/', left(pf.`fechaEstado`,4)) as fechaEstado   
from
	`postulacion_estadopostulacion` as pf
    inner join `estadopostulacion` as ff on ( ff.`idEstadoPostulacion`=pf.`idEstadoPostulacion` )
where
    pf.`idPostulacion`= idPostulacion
order by
    pf.`fechaEstado` desc;

END$$

DELIMITER ;

/* Definition for the `spGetPostulacionEtapas` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetPostulacionEtapas`(
        IN `idPostulacion` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select 
    p.`descripcion`,
    `FormatoFecha`( p.`fechaInicio`) as fechaInicio,
    `FormatoFecha`( p.`fechaTermino`) as fechaTermino,
    p.`idPostulacionEtapa`
from
   `postulacion_etapa` as p
Where
    p.`idPostulacion`=idPostulacion
order by 
    p.`fechaInicio`;   

END$$

DELIMITER ;

/* Definition for the `spGetPostulacionNotas` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetPostulacionNotas`(
        IN `idPostulacion` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select 
    n.`nota`,
    `FormatoFechaHora`(n.`fechahora`) as fechahora,
    u.`nombreCompleto` as nombreUsuario,
    n.`idNota`
from 
   `postulacion_notas` as n
	inner join `usuario` as u on ( u.`idUsuario`=n.`idUsuario` )
Where
    n.`idPostulacion`=idPostulacion
Order by
    n.`idNota` desc;       


END$$

DELIMITER ;

/* Definition for the `spGetPresupuesto` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetPresupuesto`(
        IN `idPresupuesto` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
    pre.`idPresupuesto`,
    pre.`idProyecto`,
    pro.`nombre` as nombreProyecto,
    pre.`fechaInicio`,
    pre.`fechaTermino`
from
    `presupuestos` as pre
    inner join proyecto as pro on ( pro.`idProyecto`=pre.`idProyecto` )
where
    `pre`.`idPresupuesto`=idPresupuesto
limit 1;    


END$$

DELIMITER ;

/* Definition for the `spGetProteccion` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetProteccion`(
        IN `idProteccion` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
	p.`idProteccion`,
	p.`codigo`,
    p.titulo,
    p.`fechaCreacion`,
    p.`idOficinaRegistro`,
    p.`idRepresentante`,
    p.`idTecnologia`,
    p.`idTipoProteccion`,
    p.`linkBaseDatos`,
    p.`numeroPublicacion`,
    p.`numeroRegistro`,
    p.`numeroSolicitud`
from
    `proteccion` as p
where
    p.`idProteccion`=idProteccion
limit 1;


END$$

DELIMITER ;

/* Definition for the `spGetProteccionEstados` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetProteccionEstados`(
        IN `idProteccion` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
	pf.`idProteccion_EstadoProteccion`,
    ff.`idEstadoProteccion`,
    ff.`nombre`,
    concat( right(pf.`fechaEstado`,2), '/', left( right(pf.`fechaEstado`,4),2) , '/', left(pf.`fechaEstado`,4)) as fechaEstado   
from
	`proteccion_estadoproteccion` as pf
    inner join `estadoproteccion` as ff on ( ff.`idEstadoProteccion`=pf.`idEstadoProteccion` )
where
    pf.`idProteccion`= idProteccion
order by
    pf.`fechaEstado` desc;

END$$

DELIMITER ;

/* Definition for the `spGetProteccionNotas` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetProteccionNotas`(
        IN `idProteccion` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select 
    n.`nota`,
    `FormatoFechaHora`(n.`fechahora`) as fechaHora,
    u.`nombreCompleto` as nombreUsuario,
    n.`idNota`
from 
   `proteccion_notas` as n
	inner join `usuario` as u on ( u.`idUsuario`=n.`idUsuario` )
Where
    n.`idProteccion`=idProteccion
Order by
    n.`idNota` desc;       


END$$

DELIMITER ;

/* Definition for the `spGetProyecto` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetProyecto`(
        IN `idProyecto` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

select
   p.`idProyecto`,
   p.`nombre`,
   p.`descripcion`,
   p.`codigoProyecto`,
   concat( right(p.`fechaInicio`,2), '/', left( right(p.`fechaInicio`,4),2) , '/', left(p.`fechaInicio`,4)) as fechaInicio,
   concat( right(p.`fechaTermino`,2), '/', left( right(p.`fechaTermino`,4),2) , '/', left(p.`fechaTermino`,4)) as fechaTermino,
   p.`idEstadoProyecto`,
   p.`idPostulacion`,
   p.`idTipoProyecto`,
   coalesce(tp.`nombre`,'') as nombreTipoProyecto,
   p.`idUnidadNegocio`,
   coalesce(u.`nombre`,'') as nombreUnidad,
   p.`idUsuarioEncargado`,
   Case when coalesce( p.`fechaEstado`,'') <> '' then
        concat( right(p.`fechaEstado`,2), '/', left( right(p.`fechaEstado`,4),2) , '/', left(p.`fechaEstado`,4))
   Else
        ''
   End as fechaEstado,
   coalesce(ep.`nombre`,'') as nombreEstado,
   coalesce( p.`totalProyecto`, 0) as totalProyecto
from
   proyecto as p 
   left join `estadoproyecto` as ep on ( ep.`idEstadoProyecto`= p.`idEstadoProyecto` )
   left join `tipoproyecto` as tp on ( tp.`idTipoProyecto`=p.`idTipoProyecto` )
   left join `unidad` as u on ( u.`idUnidad`=p.`idUnidadNegocio`)
where 
    p.`idProyecto` = idProyecto limit 1;

END$$

DELIMITER ;

/* Definition for the `spGetProyectoAreasPrioritarias` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetProyectoAreasPrioritarias`(
        IN `idProyecto` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
    ff.`idArea`,
    ff.`nombre`
from
	`proyecto_areaPrioritaria` as pf
    inner join `areas` as ff on ( ff.`idArea`=pf.`idArea` )
where
    pf.`idProyecto`= idProyecto;

END$$

DELIMITER ;

/* Definition for the `spGetProyectoCentros` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetProyectoCentros`(
        IN `idProyecto` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
    ff.`idCentro`,
    ff.`nombre`
from
	`proyecto_centro` as pf
    inner join `centros` as ff on ( ff.`idCentro`=pf.`idCentro` )
where
    pf.`idProyecto`= idProyecto;

END$$

DELIMITER ;

/* Definition for the `spGetProyectoDisciplinaConocimiento` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetProyectoDisciplinaConocimiento`(
        IN `idProyecto` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
    ff.`idDisciplinaConocimiento`,
    ff.`nombre`
from
	`proyecto_disciplinaconocimiento` as pf
    inner join `disciplinaconocimiento` as ff on ( ff.`idDisciplinaConocimiento`=pf.`idDisciplinaConocimiento` )
where
    pf.`idProyecto`= idProyecto;

END$$

DELIMITER ;

/* Definition for the `spGetProyectoEquipoTrabajo` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetProyectoEquipoTrabajo`(
        IN `idProyecto` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
    i.`idInvestigador`,
    i.`numeroIdentificacion`,
    i.`apellidos`,
    i.`nombres`,
    coalesce(i.`email`,'') as email,
    ff.`nombre` as fuenteFinanciamiento,
    pe.`porcentajeParticipacion`,
    pe.`principal`,
    pf.`nombre` as perfil,
    pe.`horas`
from
    `proyecto_equipotrabajo` as pe 
    inner join `investigador` as i on ( i.`idInvestigador`=pe.`idInvestigador` )
    inner join `fuentefinanciamiento` as ff on ( ff.`idFuenteFinanciamiento`=pe.`idFuenteFinanciamiento` )
    inner join `perfilinvestigador` as pf on ( pf.`idPerfilInvestigador`=pe.`idPerfil` )
where
    pe.`idProyecto`=idProyecto;    


END$$

DELIMITER ;

/* Definition for the `spGetProyectoEstados` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetProyectoEstados`(
        IN `idProyecto` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
	pf.`idProyecto_EstadoProyecto`,
    ff.`idEstadoProyecto`,
    ff.`nombre`,
    concat( right(pf.`fechaEstado`,2), '/', left( right(pf.`fechaEstado`,4),2) , '/', left(pf.`fechaEstado`,4)) as fechaEstado   
from
	`proyecto_estadoproyecto` as pf
    inner join `estadoproyecto` as ff on ( ff.`idEstadoProyecto`=pf.`idEstadoProyecto` )
where
    pf.`idProyecto`= idProyecto
order by
    pf.`fechaEstado` desc;

END$$

DELIMITER ;

/* Definition for the `spGetProyectoEtapas` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetProyectoEtapas`(
        IN `idProyecto` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select 
    p.`descripcion`,
    `FormatoFecha`( p.`fechaInicio`) as fechaInicio,
    `FormatoFecha`( p.`fechaTermino`) as fechaTermino,
    p.`idProyectoEtapa`
from
   `proyecto_etapa` as p
Where
    p.`idProyecto`=idProyecto
order by 
    p.`fechaInicio`;   

END$$

DELIMITER ;

/* Definition for the `spGetProyectoFuenteFinanciamiento` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetProyectoFuenteFinanciamiento`(
        IN `idProyecto` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
    ff.`idFuenteFinanciamiento`,
    ff.`nombre`
from
	`proyecto_fuentefinanciamiento` as pf
    inner join `fuentefinanciamiento` as ff on ( ff.`idFuenteFinanciamiento`=pf.`idFuenteFinanciamiento` )
where
    pf.`idProyecto`= idProyecto;

END$$

DELIMITER ;

/* Definition for the `spGetProyectoNotas` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetProyectoNotas`(
        IN `idProyecto` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select 
    n.`nota`,
    `FormatoFechaHora`(n.`fechahora`) as fechahora,
    u.`nombreCompleto` as nombreUsuario,
    n.`idNota`
from 
   `proyecto_notas` as n
	inner join `usuario` as u on ( u.`idUsuario`=n.`idUsuario` )
Where
    n.`idProyecto`=idProyecto
Order by
    n.`idNota` desc;       


END$$

DELIMITER ;

/* Definition for the `spGetProyectoPresupuesto` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetProyectoPresupuesto`(
        IN `idProyecto` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
    ip.`idItemPresupuesto`,
    ip.`idCuentaPresupuesto`,
    cp.`descripcion` as nombreCuentaPresupuesto,
    ip.`item`,
    ip.`detalle`,
    nombreMes( ip.`mes` ) as nombreMes,
    ip.`ano`,
    ip.`monto`,    
    Coalesce((select sum( e.`monto`) from `egresoctacte` as e where e.`idItemPresupuesto`=ip.`idItemPresupuesto` ),0) as montoRendido
from
    `itempresupuesto` as ip
    inner join `cuentaspresupuesto` as cp on ( cp.`idCuentaPresupuesto`=ip.`idCuentaPresupuesto`)
where
   ip.`idProyecto`=idProyecto
order by
   ip.`idItemPresupuesto`  ;    

END$$

DELIMITER ;

/* Definition for the `spGetProyectos` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetProyectos`()
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
select
   p.`idProyecto`,
   p.`codigoProyecto`,
   p.`nombre`,
   concat( right(p.`fechaInicio`,2), '/', left( right(p.`fechaInicio`,4),2) , '/', left(p.`fechaInicio`,4)) as fechaInicio,
   concat( right(p.`fechaTermino`,2), '/', left( right(p.`fechaTermino`,4),2) , '/', left(p.`fechaTermino`,4)) as fechaTermino,
   coalesce(ep.`nombre`,'') as estadoProyecto,
   formatoFecha( coalesce(p.`fechaEstado`,'')) as fechaEstado,
   tp.nombre as tipoProyecto,
   Coalesce( ( 
        select
            concat(i.`nombres`, ' ', i.`apellidos`)  
        from 
        	`investigador` as i
            inner join `proyecto_equipotrabajo` as pe on ( i.`idInvestigador`=pe.`idInvestigador` )
        where 
        	pe.`idProyecto`=p.`idProyecto` and
            pe.`principal`=1
        limit 1),'')  as nombreInvestigador,
   coalesce( u.`nombre`,'') as nombreUnidad,
   p.`totalProyecto`            
from
   proyecto as p
   left join `estadoproyecto` as ep on ( ep.`idEstadoProyecto`=p.`idEstadoProyecto`)
   left join `unidad` as u on ( u.`idUnidad`=p.`idUnidadNegocio`)
   inner join `tipoproyecto` as tp on ( tp.`idTipoProyecto`=p.`idTipoProyecto` )    
   ;

END$$

DELIMITER ;

/* Definition for the `spGetProyectoSectorImpacto` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetProyectoSectorImpacto`(
        IN `idProyecto` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
    ff.`idSectorImpacto`,
    ff.`nombre`
from
	`proyecto_sectorimpacto` as pf
    inner join `sectorimpacto` as ff on ( ff.`idSectorImpacto`=pf.`idSectorImpacto` )
where
    pf.`idProyecto`= idProyecto;

END$$

DELIMITER ;

/* Definition for the `spGetRepresentantes` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetRepresentantes`()
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

select
	r.`idRepresentante`,
    r.`nombre`,
    p.`nombre` as pais
from
   `representante` as r
   inner join `paises` as p on (p.`idPais`=r.`idPais` )
order by
     r.`nombre` ;


END$$

DELIMITER ;

/* Definition for the `spGetReservas` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetReservas`(
        IN `origen` SMALLINT,
        IN `idProyecto` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
select
	r.`fechaHora`,
    r.`monto`,
    r.`descripcion`,
    u.`nombreCompleto` as nombreUsuario
from
   `reservas` as r
   inner join usuario as u on ( u.`idUsuario`=r.`idUsuario` )
where
   r.`origen`=origen and
   r.`idOrigen`=idProyecto   
order by
   r.`fechaHora`;


END$$

DELIMITER ;

/* Definition for the `spGetResumenAportes` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetResumenAportes`(
        IN `origen` TINYINT,
        IN `idProyecto` TINYINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN


select
    ff.`nombre` as fuenteFinanciamiento,
    sum(cf.`montoFinanciamiento`) as aporteComprometido,
    Coalesce( ( Select sum(i.`monto`) from `ingresoctacte` as i 
    where i.`idFinancista`=cf.`idFuenteFinanciamiento` and i.`origen`=origen and i.`idOrigen`=cf.`idOrigen`),0) as aporteReal
from
    `compromisosfinanciamiento` as cf 
    inner join `fuentefinanciamiento` as ff on ( ff.`idFuenteFinanciamiento`=cf.`idFuenteFinanciamiento` )
where
    cf.`origen`=origen and
    cf.`idOrigen`=idProyecto and
    cf.`tipoFinanciamiento`=1   
group by
	ff.`nombre`;
    


END$$

DELIMITER ;

/* Definition for the `spGetResumenAportesPostulacion` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetResumenAportesPostulacion`(
        IN `idPostulacion` TINYINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN


select
    ff.`nombre` as fuenteFinanciamiento,
    sum(
    		Case When (cf.`tipoFinanciamiento`=1) then
            	cf.`montoFinanciamiento`
            Else
            	0
            end	) as montoPecuniario,
    sum(
    		Case When (cf.`tipoFinanciamiento`=2) then
            	cf.`montoFinanciamiento`
            Else
            	0
            end	) as montoValorizado
from
    `compromisosfinanciamiento` as cf 
    inner join `fuentefinanciamiento` as ff on ( ff.`idFuenteFinanciamiento`=cf.`idFuenteFinanciamiento` )
where
    cf.`origen`=3 and
    cf.`idOrigen`=idPostulacion    
group by
	ff.`nombre`;
    


END$$

DELIMITER ;

/* Definition for the `spGetSaldoDisponible` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetSaldoDisponible`(
        IN `tipoOrigen` SMALLINT,
        IN `numeroOrigen` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

set @ingresos=Coalesce((Select
   sum(i.`monto`)
from
    `ingresoctacte` as i
Where
    i.`origen`=tipoOrigen and
    i.`numeroOrigen`=numeroOrigen),0);

set @egresos=Coalesce((Select
   sum(e.`monto`)
from
    `egresoctacte` as e
Where
    e.`origen`=tipoOrigen and
    e.`numeroOrigen`=numeroOrigen),0);     

set @reservas=Coalesce((Select
   sum(e.`monto`)
from
    `reservas` as e
Where
    e.`tipoOrigen`=tipoOrigen and
    e.`numeroOrigen`=numeroOrigen),0);    

select 
    round(@ingresos,0) as ingresos, 
    round(@egresos,0) as egresos, 
    round(@reservas,0) as reservas,
    round(@ingresos-@egresos-@reservas,0) as saldoDisponible;


END$$

DELIMITER ;

/* Definition for the `spGetSectoresdeImpacto` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetSectoresdeImpacto`()
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

select 
    d.`idSectorImpacto`,
    d.`nombre`
from
   `sectorimpacto` as d
order by
    d.`idSectorImpacto`;
END$$

DELIMITER ;

/* Definition for the `spGetSubMenus` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetSubMenus`()
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
select * from `submenu` order by `submenu`.`idMenu`, `submenu`.`orden`;
END$$

DELIMITER ;

/* Definition for the `spGetTareas` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetTareas`(
        IN `origen` SMALLINT,
        IN `idOrigen` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select 
    t.`descripcion`,
    `FormatoFecha`(t.`fecha`) as fecha,
    t.hora,
    Case When t.`estado`=1 then
        'Pendiente'
    Else
        'Finalizada'
    End as estado,         
    coalesce( p.`descripcion`,'') as prioridad,
    `FormatoFecha`(t.`alarma_fecha`) as alarma_fecha,
    t.`alarma_hora`,    
    t.`idTarea`,
    u.`nombreCompleto` as nombreUsuario
From
    `tarea` as t
    inner join `prioridadtarea` as p on ( p.`idPrioridadTarea`=t.`prioridad` )
    inner join usuario as u on ( u.`idUsuario`=t.`idUsuario` )
where
    t.`origen`=origen and
    t.`idOrigen`=idOrigen
Order by
    t.`fecha`,
    t.`hora`;    



END$$

DELIMITER ;

/* Definition for the `spGetTareasTecnologia` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetTareasTecnologia`(
        IN `idTecnologia` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select 
    t.`descripcion`,
    `FormatoFecha`(t.`fecha`) as fecha,
    t.hora,
    Case When t.`estado`=1 then
        'Pendiente'
    Else
        'Finalizada'
    End as estado,         
    coalesce( p.`descripcion`,'') as prioridad,
    `FormatoFecha`(t.`alarma_fecha`) as alarma_fecha,
    t.`alarma_hora`,    
    t.`idTarea`
From
    `tarea` as t
    inner join `prioridadtarea` as p on ( p.`idPrioridadTarea`=t.`prioridad` )
where
    t.`origen`=4 and
    t.`idOrigen`=idTecnologia
Order by
    t.`fecha`,
    t.`hora`;    



END$$

DELIMITER ;

/* Definition for the `spGetTareasUsuario` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetTareasUsuario`(
        IN `idUsuario` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
Select 
    tpo.`nombre` as origen,
    t.`idOrigen` as identificador,
    t.`descripcion`,
    `FormatoFecha`(t.`fecha`) as fecha,
    t.hora,
    Case When t.`estado`=1 then
        'Pendiente'
    Else
        'Finalizada'
    End as estado,         
    coalesce( p.`descripcion`,'') as prioridad,
    `FormatoFecha`(t.`alarma_fecha`) as alarma_fecha,
    t.`alarma_hora`,    
    t.`idTarea`
From
    `tarea` as t
    inner join `prioridadtarea` as p on ( p.`idPrioridadTarea`=t.`prioridad` )
    inner join usuario as u on ( u.`idUsuario`=t.`idUsuario` )
    inner join tipoOrigen as tpo on ( `tpo`.`origen`=t.`origen`)
where
    t.`idUsuario`=idUsuario    
Order by
    t.`fecha`;

END$$

DELIMITER ;

/* Definition for the `spGetTecnologia` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetTecnologia`(
        IN `idTecnologia` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

select
   p.`idTecnologia`,
   p.`nombre`,
   p.`descripcion`,
   p.`codigo`,
   p.`idEstadoTecnologia`,
   p.`idUnidad`,
   coalesce(u.`nombre`,'') as nombreUnidad,
   p.`idUsuarioEncargado`,
   Case when coalesce( p.`fechaEstado`,'') <> '' then
        concat( right(p.`fechaEstado`,2), '/', left( right(p.`fechaEstado`,4),2) , '/', left(p.`fechaEstado`,4))
   Else
        ''
   End as fechaEstado,
   coalesce(ep.`nombre`,'') as nombreEstado,
   DATE_FORMAT( p.`fechaCreacion`,'%d/%m/%Y')  as fechaCreacion
from
   `tecnologia` as p 
   left join `estadotecnologia` as ep on ( ep.`idEstadoTecnologia`= p.`idEstadoTecnologia` )
   left join `unidad` as u on ( u.`idUnidad`=p.`idUnidad`)
where 
    p.`idTecnologia` = idTecnologia limit 1;

END$$

DELIMITER ;

/* Definition for the `spGetTecnologiaAreasPrioritarias` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetTecnologiaAreasPrioritarias`(
        IN `idTecnologia` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
    ff.`idArea`,
    ff.`nombre`
from
	`tecnologia_areaPrioritaria` as pf
    inner join `areas` as ff on ( ff.`idArea`=pf.`idArea` )
where
    pf.`idTecnologia`= idTecnologia;

END$$

DELIMITER ;

/* Definition for the `spGetTecnologiaCentros` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetTecnologiaCentros`(
        IN `idTecnologia` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
    ff.`idCentro`,
    ff.`nombre`
from
	`tecnologia_centro` as pf
    inner join `centros` as ff on ( ff.`idCentro`=pf.`idCentro` )
where
    pf.`idTecnologia`= idTecnologia;

END$$

DELIMITER ;

/* Definition for the `spGetTecnologiaDisciplinaConocimiento` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetTecnologiaDisciplinaConocimiento`(
        IN `idTecnologia` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
    ff.`idDisciplinaConocimiento`,
    ff.`nombre`
from
	`tecnologia_disciplinaconocimiento` as pf
    inner join `disciplinaconocimiento` as ff on ( ff.`idDisciplinaConocimiento`=pf.`idDisciplinaConocimiento` )
where
    pf.`idTecnologia`= idTecnologia;

END$$

DELIMITER ;

/* Definition for the `spGetTecnologiaEquipoTrabajo` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetTecnologiaEquipoTrabajo`(
        IN `idTecnologia` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
    i.`idInvestigador`,
    i.`numeroIdentificacion`,
    i.`apellidos`,
    i.`nombres`,
    coalesce(i.`email`,'') as email,
    ff.`nombre` as fuenteFinanciamiento,
    pe.`porcentajeParticipacion`,
    pe.`principal`,
    pf.`nombre` as perfil,
    pe.`horas`
from
    `tecnologia_equipotrabajo` as pe 
    inner join `investigador` as i on ( i.`idInvestigador`=pe.`idInvestigador` )
    inner join `fuentefinanciamiento` as ff on ( ff.`idFuenteFinanciamiento`=pe.`idFuenteFinanciamiento` )
    inner join `perfilinvestigador` as pf on ( pf.`idPerfilInvestigador`=pe.`idPerfil` )
where
    pe.`idTecnologia`=idTecnologia;    


END$$

DELIMITER ;

/* Definition for the `spGetTecnologiaEstados` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetTecnologiaEstados`(
        IN `idTecnologia` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
	pf.`idTecnologia_EstadoTecnologia`,
    ff.`idEstadoTecnologia`,
    ff.`nombre`,
    concat( right(pf.`fechaEstado`,2), '/', left( right(pf.`fechaEstado`,4),2) , '/', left(pf.`fechaEstado`,4)) as fechaEstado   
from
	`tecnologia_estadotecnologia` as pf
    inner join `estadotecnologia` as ff on ( ff.`idEstadoTecnologia`=pf.`idEstadoTecnologia` )
where
    pf.`idTecnologia`= idTecnologia
order by
    pf.`fechaEstado` desc;

END$$

DELIMITER ;

/* Definition for the `spGetTecnologiaNotas` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetTecnologiaNotas`(
        IN `idTecnologia` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select 
    n.`nota`,
    `FormatoFechaHora`(n.`fechahora`) as fechahora,
    u.`nombreCompleto` as nombreUsuario,
    n.`idNota`
from 
   `tecnologia_notas` as n
	inner join `usuario` as u on ( u.`idUsuario`=n.`idUsuario` )
Where
    n.`idTecnologia`=idTecnologia
Order by
    n.`idNota` desc;       


END$$

DELIMITER ;

/* Definition for the `spGetTecnologiaProteccion` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetTecnologiaProteccion`(
        IN `idTecnologia` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

select
    p.`idProteccion`,
    p.`codigo`,
    p.`titulo`,
    p.`numeroPublicacion`,
    p.`numeroRegistro`,
    p.`numeroSolicitud`,
    p.`fechaCreacion`,
    tp.`nombre` as tipoProteccion,
    rep.`nombre` as representante,
    ofr.`nombre` as oficinaRegistro
from
    proteccion as p
    inner join `representante` as rep on ( rep.`idRepresentante`=p.`idRepresentante` )
    inner join `oficinaregistro` as ofr on ( ofr.`idOficinaRegistro`=p.`idOficinaRegistro` )
    inner join `tipoproteccion` as tp on ( tp.`idTipoProteccion`=p.`idTipoProteccion` )
where
    p.`idTecnologia`=idTecnologia
order by
   p.`idProteccion`;


END$$

DELIMITER ;

/* Definition for the `spGetTecnologias` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetTecnologias`()
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
select
   p.`idTecnologia`,
   p.`codigo`,
   p.`nombre`,
   DATE_FORMAT( p.`fechaCreacion`,'%d/%m/%Y')  as fechaCreacion,
   coalesce(ep.`nombre`,'') as estadoTecnologia,
   Coalesce( ( 
        select
            concat(i.`nombres`, ' ', i.`apellidos`)  
        from 
        	`investigador` as i
            inner join `tecnologia_equipotrabajo` as pe on ( i.`idInvestigador`=pe.`idInvestigador` )
        where 
        	pe.`idTecnologia`=p.`idTecnologia` and
            pe.`principal`=1
        limit 1),'')  as nombreInvestigador       
from
   `tecnologia` as p
   left join `estadotecnologia` as ep on ( ep.`idEstadoTecnologia`=p.`idEstadoTecnologia`)
   ;

END$$

DELIMITER ;

/* Definition for the `spGetTecnologiaSectorImpacto` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetTecnologiaSectorImpacto`(
        IN `idTecnologia` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
    ff.`idSectorImpacto`,
    ff.`nombre`
from
	`tecnologia_sectorimpacto` as pf
    inner join `sectorimpacto` as ff on ( ff.`idSectorImpacto`=pf.`idSectorImpacto` )
where
    pf.`idTecnologia`= idTecnologia;

END$$

DELIMITER ;

/* Definition for the `spGetTiposProyecto` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetTiposProyecto`()
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN


Select
	c.`idTipoProyecto`,
    c.`nombre`
from
    `tipoproyecto` as c
order by
     c.`nombre`;

END$$

DELIMITER ;

/* Definition for the `spGetUnidades` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetUnidades`()
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
	c.`idUnidad`,
    c.`nombre`
from
    `unidad` as c
order by
     c.`nombre`;

END$$

DELIMITER ;

/* Definition for the `spGetUsuarioMenus` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spGetUsuarioMenus`(
        IN `idUsuario` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

set @admin=coalesce((select u.`administradorSistema` from usuario as u where u.`idUsuario`=idUsuario limit 1),0);

if @admin=0 then
  select
     m.*
  from
     menu as m
     inner join `usuario_menu` as um on (um.`idMenu`=m.`idMenu`)
  where
     um.`idUsuario`=idUsuario;
else
  select
     m.*
  from
     menu as m
  order by
     m.`orden`;
end if;   
END$$

DELIMITER ;

/* Definition for the `spInsArea` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsArea`(
        IN `idArea` INTEGER,
        IN `nombre` VARCHAR(200)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `areas` as d where d.`nombre`=nombre and d.`idArea`<>idArea) then
   set idArea=-1;
else
	if (idArea=0) then
        set idArea=Coalesce((select max(d.`idArea` )+1 from `areas` as d),0);
    	insert into `areas`(
        	`areas`.`idArea`,
            `areas`.nombre)
        values(
        	idArea,
        	nombre);
           
    else
    	UPDATE
        	`areas`
        set
            `areas`.`nombre`=nombre
        where
            `areas`.`idArea`=idArea;        
    end if;    
end if;

select idArea as idArea;

END$$

DELIMITER ;

/* Definition for the `spInsCentro` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsCentro`(
        IN `idCentro` INTEGER,
        IN `nombre` VARCHAR(200)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `centros` as d where d.`nombre`=nombre and d.`idCentro`<>idCentro) then
   set idCentro=-1;
else
	if (idCentro=0) then
        set idCentro=Coalesce((select max(d.`idCentro`)+1 from `centros` as d),0);
    	insert into `centros`(
        	`centros`.`idCentro`,
            `centros`.nombre)
        values(
        	idCentro,
        	nombre);
           
    else
    	UPDATE
        	`centros`
        set
            `centros`.`nombre`=nombre
        where
            `centros`.`idCentro`=idCentro;        
    end if;    
end if;

select idCentro as idCentro;

END$$

DELIMITER ;

/* Definition for the `spInsCompromisoFinanciamiento` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsCompromisoFinanciamiento`(
        IN `idFinanciamiento` BIGINT,
        IN `tipoOrigen` SMALLINT,
        IN `idOrigen` BIGINT,
        IN `idFuenteFinanciamiento` INTEGER,
        IN `tipoFinanciamiento` SMALLINT,
        IN `monto` BIGINT,
        IN `fecha` VARCHAR(8)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `compromisosfinanciamiento` as f where f.`idCompromisoFinanciamiento`=idFinanciamiento limit 1) then
	Update
		`compromisosfinanciamiento`
    set
    	compromisosfinanciamiento.`idFuenteFinanciamiento`=idFuenteFinanciamiento,
    	`compromisosfinanciamiento`.`tipoFinanciamiento`=tipoFinanciamiento,
    	compromisosfinanciamiento.`montoFinanciamiento`=monto,
        compromisosfinanciamiento.`fechaComprometida`=fecha
	where
    	`compromisosfinanciamiento`.`idCompromisoFinanciamiento`=idFinanciamiento;
Else
	Insert into `compromisosfinanciamiento`(
    	`compromisosfinanciamiento`.`origen`,
        compromisosfinanciamiento.idOrigen,
        compromisosfinanciamiento.`idFuenteFinanciamiento`,
        compromisosfinanciamiento.`tipoFinanciamiento`,
        compromisosfinanciamiento.`montoFinanciamiento`,
        compromisosfinanciamiento.`fechaComprometida`)
    Values(
    	tipoOrigen,
        idOrigen,
        idFuenteFinanciamiento,
        tipoFinanciamiento,
        monto,
        fecha);    
	set idFinanciamiento=@@identity;
end if;         

select idFinanciamiento as idFinanciamiento;

END$$

DELIMITER ;

/* Definition for the `spInsContrato` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsContrato`(
        IN `idContrato` BIGINT,
        IN `codigoContrato` VARCHAR(20),
        IN `nombre` VARCHAR(150),
        IN `descripcion` MEDIUMTEXT,
        IN `idUnidadNegocio` BIGINT,
        IN `idUsuarioEncargado` BIGINT,
        IN `idTipoContrato` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `contrato` as p where p.`idContrato`=idContrato) then
   Update 
        contrato
   set
        contrato.`codigoContrato`=codigoContrato,
   		contrato.`nombre`=nombre,
        contrato.`descripcion`=descripcion,
        contrato.`idUnidadNegocio`=idUnidadNegocio,
        `contrato`.`idUsuarioEncargado`=idUsuarioEncargado,
        `contrato`.`idTipoContrato`=idTipoContrato
   Where
        contrato.`idContrato`=idContrato;
else
  insert into `contrato`(
  	   contrato.`codigoContrato`,	
       contrato.`nombre`,
       contrato.`descripcion`,
       contrato.`idUnidadNegocio`,
       contrato.`idUsuarioEncargado`,
       `contrato`.`idEstadoContrato`,
       contrato.`fechaEstado`,
       `contrato`.`idTipoContrato`)
  Values(
       codigoContrato,
       nombre,
       descripcion,
       idUnidadNegocio,
       idUsuarioEncargado,
       1,
       DATE_FORMAT(now(),'%Y%m%d'),
       idTipoContrato
       );
       
   set idContrato=@@identity;
   
   insert into `contrato_estadocontrato`(
   		contrato_estadocontrato.`idContrato`,
        contrato_estadocontrato.`idEstadoContrato`,
        contrato_estadocontrato.`fechaEstado`)
   Values(
   		idContrato,
        1,
        DATE_FORMAT(now(),'%Y%m%d')
        );
   
end if;
      
Select idContrato as idContrato, DATE_FORMAT(now(),'%Y%m%d') as fechaCreacion;
  


END$$

DELIMITER ;

/* Definition for the `spInsContratoNota` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsContratoNota`(
        IN `idNota` BIGINT,
        IN `idContrato` BIGINT,
        IN `nota` VARCHAR(255),
        IN `idUsuario` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `contrato_notas` as n  where n.`idNota`=idNota) then
   UPDATE
   		`contrato_notas`
   set
   		`contrato_notas`.`nota`=nota
   where
        `contrato_notas`.`idNota`=idNota;      

else
  insert into `contrato_notas`(
      `contrato_notas`.`idContrato`,
      `contrato_notas`.`nota`,
      `contrato_notas`.`idUsuario`)
  values(
      idContrato,
      nota,
      idUsuario);  
      
  set idNota=(select @@identity);
end if;

Select 
    n.`idNota`,
    `FormatoFechaHora`(n.`fechahora`) as fechahora,
    u.`nombreCompleto` as nombreUsuario
from
    `contrato_notas` as n
    inner join `usuario` as u on ( u.`idUsuario`=n.`idUsuario` )
where 
     n.`idNota`=idNota
limit 1;                 


END$$

DELIMITER ;

/* Definition for the `spInsDisciplinaConocimiento` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsDisciplinaConocimiento`(
        IN `idDisciplinaConocimiento` INTEGER,
        IN `nombre` VARCHAR(200)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `disciplinaconocimiento` as d where d.`nombre`=nombre and d.`idDisciplinaConocimiento`<>idDisciplinaConocimiento) then
   set idDisciplinaConocimiento=-1;
else
	if (idDisciplinaConocimiento=0) then
        set idDisciplinaConocimiento=Coalesce((select max(d.`idDisciplinaConocimiento`)+1 from `disciplinaconocimiento` as d),0);
    	insert into `disciplinaconocimiento`(
        	`disciplinaconocimiento`.`idDisciplinaConocimiento`,
            `disciplinaconocimiento`.nombre)
        values(
        	idDisciplinaConocimiento,
        	nombre);
           
    else
    	UPDATE
        	`disciplinaconocimiento`
        set
            `disciplinaconocimiento`.`nombre`=nombre
        where
            `disciplinaconocimiento`.`idDisciplinaConocimiento`=idDisciplinaConocimiento;        
    end if;    
end if;

select idDisciplinaConocimiento as idDisciplinaConocimiento;

END$$

DELIMITER ;

/* Definition for the `spInsEgresoCtaCte` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsEgresoCtaCte`(
        IN `fecha` VARCHAR(8),
        IN `monto` BIGINT,
        IN `detalle` VARCHAR(255),
        IN `origen` SMALLINT,
        IN `numeroOrigen` BIGINT,
        IN `idCuentaCorriente` BIGINT,
        IN `numeroComprobante` VARCHAR(20),
        IN `ordenCompra` BIGINT,
        IN `idFormaPago` TINYINT,
        IN `numeroDocumentoPago` VARCHAR(20),
        IN `numeroDocumentoCompra` VARCHAR(20),
        IN `idItemPresupuesto` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN


insert into `egresoctacte`(
	`egresoctacte`.`fecha`,
    `egresoctacte`.`monto`,
    `egresoctacte`.`detalle`,
    `egresoctacte`.`origen`,
    `egresoctacte`.`idOrigen`,
    `egresoctacte`.`idCuentaCorriente`,
    `egresoctacte`.`comprobanteEgreso`,
    `egresoctacte`.`ordenCompra`,
    `egresoctacte`.`idFormaPago`,
    `egresoctacte`.`numeroDocumentoPago`,
    `egresoctacte`.`numeroDocumentoCompra`,
    `egresoctacte`.`idItemPresupuesto`)
values(
     fecha,
 	 monto,
     detalle,
     origen,
     numeroOrigen,
     idCuentaCorriente,
     numeroComprobante,
     ordenCompra,
     idFormaPago,
     numeroDocumentoPago,
     numeroDocumentoCompra,
     idItemPresupuesto);
      
select @@identity as idEgreso;
END$$

DELIMITER ;

/* Definition for the `spInsEstadoTecnologia` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsEstadoTecnologia`(
        IN `idEstadoTecnologia` INTEGER,
        IN `nombre` VARCHAR(200)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `estadotecnologia` as d where d.`nombre`=nombre and d.`idEstadoTecnologia`<>idEstadoTecnologia) then
   set idEstadoTecnologia=-1;
else
	if (idEstadoTecnologia=0) then
        set idEstadoTecnologia=Coalesce((select max(d.`idEstadoTecnologia`)+1 from `estadotecnologia` as d),0);
    	insert into `estadotecnologia`(
        	`estadotecnologia`.`idEstadoTecnologia`,
            `estadotecnologia`.nombre)
        values(
        	idEstadoTecnologia,
        	nombre);
           
    else
    	UPDATE
        	`estadotecnologia`
        set
            `estadotecnologia`.`nombre`=nombre
        where
            `estadotecnologia`.`idEstadoTecnologia`=idEstadoTecnologia;        
    end if;    
end if;

select idEstadoTecnologia as idEstadoTecnologia;

END$$

DELIMITER ;

/* Definition for the `spInsFuenteFinanciamiento` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsFuenteFinanciamiento`(
        IN `idFuenteFinanciamiento` INTEGER,
        IN `nombre` VARCHAR(200),
        IN `rut` VARCHAR(20),
        IN `direccion` VARCHAR(150),
        IN `region` VARCHAR(100),
        IN `telefono` VARCHAR(50),
        IN `web` VARCHAR(100),
        IN `idPais` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if (idFuenteFinanciamiento=0) then
    insert into `fuentefinanciamiento`(
        `fuentefinanciamiento`.nombre,
        `fuentefinanciamiento`.`rut`,
        `fuentefinanciamiento`.`direccion`,
        `fuentefinanciamiento`.`region`,
        `fuentefinanciamiento`.`telefono`,
        `fuentefinanciamiento`.`web`,
        `fuentefinanciamiento`.`idPais`
        )
    values(
        nombre,
        rut,
        direccion,
        region,
        telefono,
        web,
        idPais
        );
    set idFuenteFinanciamiento=(select @@identity);      
else
    UPDATE
        `fuentefinanciamiento`
    set
        `fuentefinanciamiento`.`nombre`=nombre,
        `fuentefinanciamiento`.`rut`=rut,
        `fuentefinanciamiento`.`direccion`=direccion,
        `fuentefinanciamiento`.`region`=region,
        `fuentefinanciamiento`.`telefono`=telefono,
        `fuentefinanciamiento`.web=web,
        `fuentefinanciamiento`.`idPais`=idPais
    where
        `fuentefinanciamiento`.`idFuenteFinanciamiento`=idFuenteFinanciamiento;        
end if;    

select idFuenteFinanciamiento as idFuenteFinanciamiento;

END$$

DELIMITER ;

/* Definition for the `spInsIngresoCtaCte` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsIngresoCtaCte`(
        IN `fecha` VARCHAR(8),
        IN `monto` BIGINT,
        IN `detalle` VARCHAR(255),
        IN `origen` SMALLINT,
        IN `numeroOrigen` BIGINT,
        IN `idFinancista` BIGINT,
        IN `idCuentaCorriente` BIGINT,
        IN `idFormaPago` INTEGER,
        IN `numeroDocumentoPago` VARCHAR(20)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN


insert into `ingresoctacte`(
	`ingresoctacte`.`fecha`,
    `ingresoctacte`.`monto`,
    `ingresoctacte`.`detalle`,
    `ingresoctacte`.`idFinancista`,
    `ingresoctacte`.`origen`,
    `ingresoctacte`.`idOrigen`,
    `ingresoctacte`.`idCuentaCorriente`,
    `ingresoctacte`.`idFormaPago`,
    `ingresoctacte`.`numeroDocumentoPago`)
values(
     fecha,
 	 monto,
     detalle,
     idFinancista,
     origen,
     numeroOrigen,
     idCuentaCorriente,
     idFormaPago,
     numeroDocumentoPago);
      
select @@identity as idIngreso;
END$$

DELIMITER ;

/* Definition for the `spInsIniciativa` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsIniciativa`(
        IN `idIniciativa` BIGINT,
        IN `nombre` VARCHAR(150),
        IN `descripcion` MEDIUMTEXT,
        IN `idUnidadNegocio` BIGINT,
        IN `idUsuarioEncargado` BIGINT,
        IN `idEstadoIniciativa` BIGINT,
        IN `idTipoIniciativa` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `iniciativa` as p where p.`idIniciativa`=idIniciativa) then
   Update 
        iniciativa
   set
   		iniciativa.`nombre`=nombre,
        iniciativa.`descripcion`=descripcion,
        iniciativa.`idUnidadNegocio`=idUnidadNegocio,
        `iniciativa`.`idUsuarioEncargado`=idUsuarioEncargado,
        `iniciativa`.`idEstadoIniciativa`=idEstadoIniciativa,
        `iniciativa`.`idTipoIniciativa`=idTipoIniciativa
   Where
        iniciativa.`idIniciativa`=idIniciativa;
else
  insert into `iniciativa`(
       iniciativa.`nombre`,
       iniciativa.`descripcion`,
       iniciativa.`idUnidadNegocio`,
       iniciativa.`idUsuarioEncargado`,
       `iniciativa`.`idEstadoIniciativa`,
       `iniciativa`.`idTipoIniciativa`)
  Values(
       nombre,
       descripcion,
       idUnidadNegocio,
       idUsuarioEncargado,
       0,
       idTipoIniciativa);
       
   set idIniciativa=@@identity;
end if;
      
Select idIniciativa as idIniciativa, NOW() as fechaCreacion;
  


END$$

DELIMITER ;

/* Definition for the `spInsIniciativaAreaPrioritaria` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsIniciativaAreaPrioritaria`(
        IN `idIniciativa` BIGINT,
        IN `idArea` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `iniciativa_areaprioritaria` as a where a.`idIniciativa`=idIniciativa and a.`idArea`=idArea) then
   select -1 as idIniciativaAreaPrioritaria;
else
	insert into `iniciativa_areaprioritaria`(
         	iniciativa_areaprioritaria.`idIniciativa`,
            iniciativa_areaprioritaria.`idArea`)
    values(
    		idIniciativa,
            idArea);
            
     select @@identity as idIniciativaAreaPrioritaria;               
end if;



END$$

DELIMITER ;

/* Definition for the `spInsIniciativaCentro` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsIniciativaCentro`(
        IN `idIniciativa` BIGINT,
        IN `idCentro` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `iniciativa_centro` as a where a.`idIniciativa`=idIniciativa and a.`idCentro`=idCentro) then
   select -1 as idCentro;
else
	insert into `iniciativa_centro`(
         	iniciativa_centro.`idIniciativa`,
            iniciativa_centro.`idCentro`)
    values(
    		idIniciativa,
            idCentro);
            
     select @@identity as idCentro;               
end if;



END$$

DELIMITER ;

/* Definition for the `spInsIniciativaEquipoTrabajo` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsIniciativaEquipoTrabajo`(
        IN `idIniciativa` INTEGER,
        IN `idInvestigador` INTEGER,
        IN `idFuenteFinanciamiento` INTEGER,
        IN `idPerfil` INTEGER,
        IN `horas` INTEGER,
        IN `porcentajeParticipacion` DECIMAL(10,2),
        IN `principal` TINYINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN


if exists(select 1 from `iniciativa_equipotrabajo` as pe where pe.`idIniciativa`=idIniciativa and pe.`idInvestigador`=idInvestigador limit 1 ) then
   Update
        `iniciativa_equipotrabajo`
   set
        iniciativa_equipotrabajo.`idIniciativa`=idIniciativa,
        iniciativa_equipotrabajo.`idInvestigador`=idInvestigador,
        iniciativa_equipotrabajo.`idFuenteFinanciamiento`=idFuenteFinanciamiento,
        iniciativa_equipotrabajo.`idPerfil`=idPerfil,
        iniciativa_equipotrabajo.`horas`=horas,
        iniciativa_equipotrabajo.`porcentajeParticipacion`=porcentajeParticipacion,
        iniciativa_equipotrabajo.`principal`=principal
   Where
       iniciativa_equipotrabajo.`idIniciativa`=idIniciativa and iniciativa_equipotrabajo.`idInvestigador`=idInvestigador; 
             
else
	Insert into `iniciativa_equipotrabajo`(
         iniciativa_equipotrabajo.`idIniciativa`,
         iniciativa_equipotrabajo.`idInvestigador`,
         iniciativa_equipotrabajo.`idFuenteFinanciamiento`,
         iniciativa_equipotrabajo.`idPerfil`,
         iniciativa_equipotrabajo.`horas`,
         iniciativa_equipotrabajo.`porcentajeParticipacion`,
         iniciativa_equipotrabajo.`principal`)
    Values(
    	 idIniciativa,
         idInvestigador,
         idFuenteFinanciamiento,
         idPerfil,
         horas,
         porcentajeParticipacion,
         principal);    

end if;

select idIniciativa as idIniciativa;
END$$

DELIMITER ;

/* Definition for the `spInsIniciativaNota` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsIniciativaNota`(
        IN `idNota` BIGINT,
        IN `idIniciativa` BIGINT,
        IN `nota` VARCHAR(255),
        IN `idUsuario` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `iniciativa_notas` as n  where n.`idNota`=idNota) then
   UPDATE
   		`iniciativa_notas`
   set
   		`iniciativa_notas`.`nota`=nota
   where
        `iniciativa_notas`.`idNota`=idNota;      

else
  insert into `iniciativa_notas`(
      `iniciativa_notas`.`idIniciativa`,
      `iniciativa_notas`.`nota`,
      `iniciativa_notas`.`idUsuario`)
  values(
      idIniciativa,
      nota,
      idUsuario);  
      
  set idNota=(select @@identity);
end if;

Select 
    n.`idNota`,
    `FormatoFechaHora`(n.`fechahora`) as fechahora,
    u.`nombreCompleto` as nombreUsuario
from
    `iniciativa_notas` as n
    inner join `usuario` as u on ( u.`idUsuario`=n.`idUsuario` )
where 
     n.`idNota`=idNota
limit 1;                 


END$$

DELIMITER ;

/* Definition for the `spInsInvestigador` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsInvestigador`(
        IN `idInvestigador` BIGINT,
        IN `apellidos` VARCHAR(100),
        IN `nombres` VARCHAR(60),
        IN `numeroIdentificacion` VARCHAR(20),
        IN `email` VARCHAR(50),
        IN `telefonoFijo` VARCHAR(20),
        IN `telefonoMovil` VARCHAR(20),
        IN `direccion` VARCHAR(100),
        IN `idPerfilInvestigador` INTEGER,
        IN `departamento_id` INTEGER,
        IN `institucion_id` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `investigador` as i where i.`idInvestigador`=idInvestigador limit 1) then
    Update Investigador
    set
        investigador.`apellidos`=apellidos,
        investigador.`nombres`=nombres,
        investigador.`email`=email,
        investigador.`direccion`=direccion,
        investigador.`telefonoFijo`=telefonoFijo,
        investigador.`telefonoMovil`=telefonoMovil,
        investigador.`numeroIdentificacion`=numeroIdentificacion,
        investigador.`idPerfilInvestigador`=idPerfilInvestigador,
        investigador.`departamento_id`=departamento_id,
        investigador.`institucion_id`=institucion_id
	Where
		investigador.`idInvestigador`=idInvestigador;

else
    insert into investigador(
    	investigador.`apellidos`,
        investigador.`nombres`,
        investigador.`email`,
        investigador.`telefonoFijo`,
        investigador.`telefonoMovil`,
        investigador.`numeroIdentificacion`,
        investigador.`idPerfilInvestigador`,
        investigador.`departamento_id`,
        investigador.`institucion_id`)
    Values(
    	apellidos,
        nombres,
        email,
        telefonoFijo,
        telefonoMovil,
        numeroIdentificacion,
        idPerfilInvestigador,
        departamento_id,
        institucion_id);
            
	set idInvestigador=@@identity;
end if;

select idInvestigador as idInvestigador;

END$$

DELIMITER ;

/* Definition for the `spInsInvestigadorFuenteFinanciamiento` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsInvestigadorFuenteFinanciamiento`(
        IN `idInvestigador` BIGINT,
        IN `idFuenteFinanciamiento` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if not exists(select 1 from `investigador_fuentefinanciamiento` as i where i.`idInvestigador`=idInvestigador and i.`idFuenteFinanciamiento`=idFuenteFinanciamiento) then
   insert into `investigador_fuentefinanciamiento`(
   			`investigador_fuentefinanciamiento`.`idInvestigador`,
            `investigador_fuentefinanciamiento`.`idFuenteFinanciamiento`)
   Values(
   			idInvestigador,
            idFuenteFinanciamiento);         
end if;
END$$

DELIMITER ;

/* Definition for the `spInsItemPresupuesto` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsItemPresupuesto`(
        IN `idItemPresupuesto` BIGINT,
        IN `idProyecto` BIGINT,
        IN `idCuentaPresupuesto` BIGINT,
        IN `item` VARCHAR(100),
        IN `monto` BIGINT,
        IN `mes` INTEGER,
        IN `ano` INTEGER,
        IN `detalle` VARCHAR(255)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `itempresupuesto` as ip where ip.`idItemPresupuesto`=idItemPresupuesto) then

   Update
       `itempresupuesto`
   set
      itempresupuesto.idProyecto=idProyecto,
      itempresupuesto.`idCuentaPresupuesto`=idCuentaPresupuesto,
      itempresupuesto.`item`=item,
      itempresupuesto.`monto`=monto,
      itempresupuesto.`mes`=mes,
      itempresupuesto.ano=ano,
      itempresupuesto.`detalle`=detalle
   where
      `itempresupuesto`.`idItemPresupuesto`=idItemPresupuesto;              	

else 

  Insert into `itempresupuesto`(
      itempresupuesto.idProyecto,
      itempresupuesto.`idCuentaPresupuesto`,
      itempresupuesto.`item`,
      itempresupuesto.`monto`,
      itempresupuesto.`mes`,
      itempresupuesto.ano,
      itempresupuesto.`detalle`)
  values(
      idProyecto,
      idCuentaPresupuesto,
      item,
      monto,
      mes,
      ano,
      detalle);
        
  set idItemPresupuesto=@@identity;
      
end if;

select idItemPresupuesto as idItemPresupuesto;


END$$

DELIMITER ;

/* Definition for the `spInsNota` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsNota`(
        IN `idNota` BIGINT,
        IN `idProyecto` BIGINT,
        IN `nota` VARCHAR(255),
        IN `idUsuario` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `proyecto_notas` as n  where n.`idNota`=idNota) then
   UPDATE
   		`proyecto_notas`
   set
   		`proyecto_notas`.`nota`=nota
   where
        `proyecto_notas`.`idNota`=idNota;      

else
  insert into `proyecto_notas`(
      `proyecto_notas`.`idProyecto`,
      `proyecto_notas`.`nota`,
      `proyecto_notas`.`idUsuario`)
  values(
      idProyecto,
      nota,
      idUsuario);  
      
  set idNota=(select @@identity);
end if;

Select 
    n.`idNota`,
    `FormatoFechaHora`(n.`fechahora`) as fechahora,
    u.`nombreCompleto` as nombreUsuario
from
    `proyecto_notas` as n
    inner join `usuario` as u on ( u.`idUsuario`=n.`idUsuario` )
where 
     n.`idNota`=idNota
limit 1;                 


END$$

DELIMITER ;

/* Definition for the `spInsPostulacion` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsPostulacion`(
        IN `idPostulacion` BIGINT,
        IN `nombre` VARCHAR(100),
        IN `descripcion` VARCHAR(500),
        IN `idIniciativa` BIGINT,
        IN `codigoPostulacion` VARCHAR(30),
        IN `fechaPostulacion` CHAR(8)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN


if exists(select 1 from postulacion as p where p.`idPostulacion`=idPostulacion) then
   Update 
        postulacion
   set
   		postulacion.`nombre`=nombre,
        postulacion.`descripcion`=descripcion,
        postulacion.`fechaPostulacion`=fechaPostulacion,
        `postulacion`.`codigoPostulacion`=codigoPostulacion
   Where
        postulacion.`idPostulacion`=idPostulacion;          

else
  insert into `postulacion`(
       postulacion.`nombre`,
       postulacion.`descripcion`,
       postulacion.`idEstadoPostulacion`,
       postulacion.`fechaEstado`,
       postulacion.`idIniciativa`,
       postulacion.`fechaPostulacion`,
       postulacion.`codigoPostulacion`)
  Values(
       nombre,
       descripcion,
       0,
       DATE_FORMAT(now(),'%Y%m%d'),
       idIniciativa,
       fechaPostulacion,
       codigoPostulacion);
       
  set idPostulacion=@@identity;
  
  Insert into `postulacion_equipotrabajo`(
         postulacion_equipotrabajo.`idPostulacion`,
         postulacion_equipotrabajo.`idInvestigador`,
         postulacion_equipotrabajo.`idFuenteFinanciamiento`,
         postulacion_equipotrabajo.`idPerfil`,
         postulacion_equipotrabajo.`horas`,
         postulacion_equipotrabajo.`porcentajeParticipacion`,
         postulacion_equipotrabajo.`principal`)
  SELECT
         idPostulacion,
         i.`idInvestigador`,
         i.`idFuenteFinanciamiento`,
         i.`idPerfil`,
         i.`horas`,
         i.`porcentajeParticipacion`,
         i.`principal`
  from
        `iniciativa_equipotrabajo` as i
  where
        i.`idIniciativa`=idIniciativa;      
  
  insert into `postulacion_estadopostulacion`(
      `postulacion_estadopostulacion`.`idPostulacion`,
      `postulacion_estadopostulacion`.`idEstadoPostulacion`,
      `postulacion_estadopostulacion`.`fechaEstado`)
  Values(
  		idPostulacion,
        0,
  		DATE_FORMAT(now(),'%Y%m%d')
        );
       
end if;

select idPostulacion as idPostulacion;


END$$

DELIMITER ;

/* Definition for the `spInsPostulacionEquipoTrabajo` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsPostulacionEquipoTrabajo`(
        IN `idPostulacion` INTEGER,
        IN `idInvestigador` INTEGER,
        IN `idFuenteFinanciamiento` INTEGER,
        IN `idPerfil` INTEGER,
        IN `horas` INTEGER,
        IN `porcentajeParticipacion` DECIMAL(10,2),
        IN `principal` TINYINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN


if exists(select 1 from `postulacion_equipotrabajo` as pe where pe.`idPostulacion`=idPostulacion and pe.`idInvestigador`=idInvestigador limit 1 ) then
   Update
        `postulacion_equipotrabajo`
   set
        postulacion_equipotrabajo.`idPostulacion`=idPostulacion,
        postulacion_equipotrabajo.`idInvestigador`=idInvestigador,
        postulacion_equipotrabajo.`idFuenteFinanciamiento`=idFuenteFinanciamiento,
        postulacion_equipotrabajo.`idPerfil`=idPerfil,
        postulacion_equipotrabajo.`horas`=horas,
        postulacion_equipotrabajo.`porcentajeParticipacion`=porcentajeParticipacion,
        postulacion_equipotrabajo.`principal`=principal
   Where
       postulacion_equipotrabajo.`idPostulacion`=idPostulacion and postulacion_equipotrabajo.`idInvestigador`=idInvestigador; 
             
else
	Insert into `postulacion_equipotrabajo`(
         postulacion_equipotrabajo.`idPostulacion`,
         postulacion_equipotrabajo.`idInvestigador`,
         postulacion_equipotrabajo.`idFuenteFinanciamiento`,
         postulacion_equipotrabajo.`idPerfil`,
         postulacion_equipotrabajo.`horas`,
         postulacion_equipotrabajo.`porcentajeParticipacion`,
         postulacion_equipotrabajo.`principal`)
    Values(
    	 idPostulacion,
         idInvestigador,
         idFuenteFinanciamiento,
         idPerfil,
         horas,
         porcentajeParticipacion,
         principal);    

end if;

select idPostulacion as idPostulacion;
END$$

DELIMITER ;

/* Definition for the `spInsPostulacionNota` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsPostulacionNota`(
        IN `idNota` BIGINT,
        IN `idPostulacion` BIGINT,
        IN `nota` VARCHAR(255),
        IN `idUsuario` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `postulacion_notas` as n  where n.`idNota`=idNota) then
   UPDATE
   		`postulacion_notas`
   set
   		`postulacion_notas`.`nota`=nota
   where
        `postulacion_notas`.`idNota`=idNota;      

else
  insert into `postulacion_notas`(
      `postulacion_notas`.`idPostulacion`,
      `postulacion_notas`.`nota`,
      `postulacion_notas`.`idUsuario`)
  values(
      idPostulacion,
      nota,
      idUsuario);  
      
  set idNota=(select @@identity);
end if;

Select 
    n.`idNota`,
    `FormatoFechaHora`(n.`fechahora`) as fechahora,
    u.`nombreCompleto` as nombreUsuario
from
    `postulacion_notas` as n
    inner join `usuario` as u on ( u.`idUsuario`=n.`idUsuario` )
where 
     n.`idNota`=idNota
limit 1;                 


END$$

DELIMITER ;

/* Definition for the `spInsProteccion` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsProteccion`(
        IN `idProteccion` BIGINT,
        IN `idTecnologia` BIGINT,
        IN `codigo` VARCHAR(20),
        IN `titulo` VARCHAR(500),
        IN `idTipoProteccion` INTEGER,
        IN `numeroSolicitud` VARCHAR(20),
        IN `numeroPublicacion` VARCHAR(20),
        IN `numeroRegistro` VARCHAR(20),
        IN `idOficinaRegistro` INTEGER,
        IN `idRepresentante` INTEGER,
        IN `linkBaseDatos` VARCHAR(500)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `proteccion` as p where p.`idProteccion`=idProteccion) then
   Update 
        proteccion
   set
	    proteccion.`codigo`=codigo,
        proteccion.`titulo`=titulo,
        proteccion.`idTipoProteccion`=idTipoProteccion,
        proteccion.`numeroSolicitud`=numeroSolicitud,
        proteccion.`numeroPublicacion`= numeroPublicacion,
        proteccion.`numeroRegistro`=numeroRegistro,
        proteccion.`idOficinaRegistro`=idOficinaRegistro,
        proteccion.`idRepresentante`=idRepresentante,
        proteccion.`linkBaseDatos`=linkBaseDatos
   Where
        `proteccion`.`idProteccion`=idProteccion;
else
  insert into `proteccion`(
  		proteccion.`idTecnologia`,
  	   `proteccion`.`codigo`,	
       proteccion.`titulo`,
       proteccion.`idTipoProteccion`,
       proteccion.`numeroSolicitud`,
       proteccion.`numeroPublicacion`,
       `proteccion`.`numeroRegistro`,
       proteccion.`idOficinaRegistro`,
       proteccion.`idRepresentante`,
       `proteccion`.`linkBaseDatos`,
       proteccion.`fechaCreacion`)
  Values(
  	   idTecnologia,
       codigo,
       titulo,
       idTipoProteccion,
       numeroSolicitud,
       numeroPublicacion,
       numeroRegistro,
       idOficinaRegistro,
       idRepresentante,
       linkBaseDatos,
       DATE_FORMAT(now(),'%Y%m%d')
       );
       
   set idProteccion=@@identity;
   
  
end if;
      
Select idProteccion as idProteccion;
  


END$$

DELIMITER ;

/* Definition for the `spInsProyectoAreaPrioritaria` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsProyectoAreaPrioritaria`(
        IN `idProyecto` BIGINT,
        IN `idArea` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `proyecto_areaprioritaria` as a where a.`idProyecto`=idProyecto and a.`idArea`=idArea) then
   select -1 as idProyectoAreaPrioritaria;
else
	insert into `proyecto_areaprioritaria`(
         	proyecto_areaprioritaria.`idProyecto`,
            proyecto_areaprioritaria.`idArea`)
    values(
    		idProyecto,
            idArea);
            
     select @@identity as idProyectoAreaPrioritaria;               
end if;



END$$

DELIMITER ;

/* Definition for the `spInsProyectoCentro` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsProyectoCentro`(
        IN `idProyecto` BIGINT,
        IN `idCentro` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `proyecto_centro` as a where a.`idProyecto`=idProyecto and a.`idCentro`=idCentro) then
   select -1 as idCentro;
else
	insert into `proyecto_centro`(
         	proyecto_centro.`idProyecto`,
            proyecto_centro.`idCentro`)
    values(
    		idProyecto,
            idCentro);
            
     select @@identity as idCentro;               
end if;



END$$

DELIMITER ;

/* Definition for the `spInsProyectoEquipoTrabajo` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsProyectoEquipoTrabajo`(
        IN `idProyecto` INTEGER,
        IN `idInvestigador` INTEGER,
        IN `idFuenteFinanciamiento` INTEGER,
        IN `idPerfil` INTEGER,
        IN `horas` INTEGER,
        IN `porcentajeParticipacion` DECIMAL(10,2),
        IN `principal` TINYINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN


if exists(select 1 from `proyecto_equipotrabajo` as pe where pe.`idProyecto`=idProyecto and pe.`idInvestigador`=idInvestigador limit 1 ) then
   Update
        `proyecto_equipotrabajo`
   set
        proyecto_equipotrabajo.`idProyecto`=idProyecto,
        proyecto_equipotrabajo.`idInvestigador`=idInvestigador,
        proyecto_equipotrabajo.`idFuenteFinanciamiento`=idFuenteFinanciamiento,
        proyecto_equipotrabajo.`idPerfil`=idPerfil,
        proyecto_equipotrabajo.`horas`=horas,
        proyecto_equipotrabajo.`porcentajeParticipacion`=porcentajeParticipacion,
        proyecto_equipotrabajo.`principal`=principal
   Where
       proyecto_equipotrabajo.`idProyecto`=idProyecto and proyecto_equipotrabajo.`idInvestigador`=idInvestigador; 
             
else
	Insert into `proyecto_equipotrabajo`(
         proyecto_equipotrabajo.`idProyecto`,
         proyecto_equipotrabajo.`idInvestigador`,
         proyecto_equipotrabajo.`idFuenteFinanciamiento`,
         proyecto_equipotrabajo.`idPerfil`,
         proyecto_equipotrabajo.`horas`,
         proyecto_equipotrabajo.`porcentajeParticipacion`,
         proyecto_equipotrabajo.`principal`)
    Values(
    	 idProyecto,
         idInvestigador,
         idFuenteFinanciamiento,
         idPerfil,
         horas,
         porcentajeParticipacion,
         principal);    

end if;

select idProyecto as idProyecto;
END$$

DELIMITER ;

/* Definition for the `spInsProyectoEtapa` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsProyectoEtapa`(
        IN `idProyectoEtapa` BIGINT,
        IN `idProyecto` BIGINT,
        IN `descripcion` VARCHAR(200),
        IN `fechaInicio` VARCHAR(8),
        IN `fechaTermino` VARCHAR(8)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN
if EXISTS(select 1 from `proyecto_etapa` as pe where pe.`idProyectoEtapa`=idProyectoEtapa limit 1) then
   Update
       `proyecto_etapa`
   set    
       `proyecto_etapa`.`descripcion`=descripcion,
       `proyecto_etapa`.`fechaInicio`=fechaInicio,
       `proyecto_etapa`.`fechaTermino`=fechaTermino
   Where
   		`proyecto_etapa`.`idProyectoEtapa`=idProyectoEtapa;

else
  
   insert into `proyecto_etapa`(
   	   `proyecto_etapa`.`idProyecto`,
       `proyecto_etapa`.`descripcion`,
       `proyecto_etapa`.`fechaInicio`,
       `proyecto_etapa`.`fechaTermino`)
   Values(
        idProyecto,
        descripcion,
        fechaInicio,
        fechaTermino)    ;
        
	set idProyectoEtapa= @@identity;        	    
       
end if;

select idProyectoEtapa as idProyectoEtapa;

END$$

DELIMITER ;

/* Definition for the `spInsReserva` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsReserva`(
        IN `tipoOrigen` SMALLINT,
        IN `numeroOrigen` BIGINT,
        IN `descripcion` VARCHAR(255),
        IN `monto` BIGINT,
        IN `idUsuario` INTEGER,
        IN `idCuentaCorriente` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

insert into `reservas`(
    `reservas`.`origen`,
    `reservas`.`idOrigen`,
    `reservas`.`descripcion`,
    `reservas`.`monto`,
    `reservas`.`idUsuario`,
    `reservas`.`idCuentaCorriente`)
values(
	tipoOrigen,
    numeroOrigen,
    descripcion,
    monto,
    idUsuario,
    idCuentaCorriente);
    
select @@identity as idReserva;    

END$$

DELIMITER ;

/* Definition for the `spInsSectorImpacto` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsSectorImpacto`(
        IN `idSectorImpacto` INTEGER,
        IN `nombre` VARCHAR(200)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `sectorimpacto` as d where d.`nombre`=nombre and d.`idSectorImpacto`<>idSectorImpacto) then
   set idSectorImpacto=-1;
else
	if (idSectorImpacto=0) then
        set idSectorImpacto=Coalesce((select max(d.`idSectorImpacto`)+1 from `sectorimpacto` as d),0);
    	insert into `sectorimpacto`(
        	`sectorimpacto`.`idSectorImpacto`,
            `sectorimpacto`.nombre)
        values(
        	idSectorImpacto,
        	nombre);
           
    else
    	UPDATE
        	`sectorimpacto`
        set
            `sectorimpacto`.`nombre`=nombre
        where
            `sectorimpacto`.`idSectorImpacto`=idSectorImpacto;        
    end if;    
end if;

select idSectorImpacto as idSectorImpacto;
END$$

DELIMITER ;

/* Definition for the `spInsTarea` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsTarea`(
        IN `idTarea` BIGINT,
        IN `descripcion` VARCHAR(100),
        IN `fecha` CHAR(8),
        IN `hora` CHAR(5),
        IN `prioridad` SMALLINT,
        IN `origen` SMALLINT,
        IN `idOrigen` BIGINT,
        IN `alarmaFecha` CHAR(8),
        IN `alarmaHora` CHAR(5),
        IN `idUsuario` BIGINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `tarea` as t where t.`idTarea`=idTarea limit 1) then
   update tarea
   set
   		tarea.`descripcion`=descripcion,
        tarea.`fecha`=fecha,
        tarea.`hora`=hora,
        tarea.`prioridad`=prioridad,
        tarea.`origen`=origen,
        tarea.`idOrigen`=idOrigen,
        tarea.`alarma_fecha`=alarmaFecha,
        tarea.`alarma_hora`=alarmaHora,
        tarea.`idUsuario`=idUsuario
   where
   		tarea.`idTarea`=idTarea;

else
   insert into tarea(
   		tarea.`descripcion`,
        tarea.`fecha`,
        tarea.`hora`,
        tarea.`prioridad`,
        tarea.`estado`,
        tarea.`origen`,
        tarea.`idOrigen`,
        tarea.`alarma_fecha`,
        `tarea`.`alarma_hora`,
        tarea.`idUsuario`)
   VALUES(
   		descripcion,
        fecha,
        hora,
        prioridad,
        1,
        origen,
        idOrigen,
        alarmaFecha,
        alarmaHora,
        idUsuario
        );
        
	set idTarea=@@identity;      
    
end if;

select idTarea as idTarea;

END$$

DELIMITER ;

/* Definition for the `spInsTecnologiaAreaPrioritaria` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsTecnologiaAreaPrioritaria`(
        IN `idTecnologia` BIGINT,
        IN `idArea` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `tecnologia_areaprioritaria` as a where a.`idTecnologia`=idTecnologia and a.`idArea`=idArea) then
   select -1 as idTecnologiaAreaPrioritaria;
else
	insert into `tecnologia_areaprioritaria`(
         	tecnologia_areaprioritaria.`idTecnologia`,
            tecnologia_areaprioritaria.`idArea`)
    values(
    		idTecnologia,
            idArea);
            
     select @@identity as idTecnologiaAreaPrioritaria;               
end if;



END$$

DELIMITER ;

/* Definition for the `spInsTecnologiaCentro` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsTecnologiaCentro`(
        IN `idTecnologia` BIGINT,
        IN `idCentro` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `tecnologia_centro` as a where a.`idTecnologia`=idTecnologia and a.`idCentro`=idCentro) then
   select -1 as idCentro;
else
	insert into `tecnologia_centro`(
         	tecnologia_centro.`idTecnologia`,
            tecnologia_centro.`idCentro`)
    values(
    		idTecnologia,
            idCentro);
            
     select @@identity as idCentro;               
end if;



END$$

DELIMITER ;

/* Definition for the `spInsTecnologiaEquipoTrabajo` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsTecnologiaEquipoTrabajo`(
        IN `idTecnologia` INTEGER,
        IN `idInvestigador` INTEGER,
        IN `idFuenteFinanciamiento` INTEGER,
        IN `idPerfil` INTEGER,
        IN `horas` INTEGER,
        IN `porcentajeParticipacion` DECIMAL(10,2),
        IN `principal` TINYINT
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN


if exists(select 1 from `tecnologia_equipotrabajo` as pe where pe.`idTecnologia`=idTecnologia and pe.`idInvestigador`=idInvestigador limit 1 ) then
   Update
        `tecnologia_equipotrabajo`
   set
        tecnologia_equipotrabajo.`idTecnologia`=idTecnologia,
        tecnologia_equipotrabajo.`idInvestigador`=idInvestigador,
        tecnologia_equipotrabajo.`idFuenteFinanciamiento`=idFuenteFinanciamiento,
        tecnologia_equipotrabajo.`idPerfil`=idPerfil,
        tecnologia_equipotrabajo.`horas`=horas,
        tecnologia_equipotrabajo.`porcentajeParticipacion`=porcentajeParticipacion,
        tecnologia_equipotrabajo.`principal`=principal
   Where
       tecnologia_equipotrabajo.`idTecnologia`=idTecnologia and tecnologia_equipotrabajo.`idInvestigador`=idInvestigador; 
             
else
	Insert into `tecnologia_equipotrabajo`(
         tecnologia_equipotrabajo.`idTecnologia`,
         tecnologia_equipotrabajo.`idInvestigador`,
         tecnologia_equipotrabajo.`idFuenteFinanciamiento`,
         tecnologia_equipotrabajo.`idPerfil`,
         tecnologia_equipotrabajo.`horas`,
         tecnologia_equipotrabajo.`porcentajeParticipacion`,
         tecnologia_equipotrabajo.`principal`)
    Values(
    	 idTecnologia,
         idInvestigador,
         idFuenteFinanciamiento,
         idPerfil,
         horas,
         porcentajeParticipacion,
         principal);    

end if;

select idTecnologia as idTecnologia;
END$$

DELIMITER ;

/* Definition for the `spInsTecnologiaNota` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsTecnologiaNota`(
        IN `idNota` BIGINT,
        IN `idTecnologia` BIGINT,
        IN `nota` VARCHAR(255),
        IN `idUsuario` INTEGER
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `tecnologia_notas` as n  where n.`idNota`=idNota) then
   UPDATE
   		`tecnologia_notas`
   set
   		`tecnologia_notas`.`nota`=nota
   where
        `tecnologia_notas`.`idNota`=idNota;      

else
  insert into `tecnologia_notas`(
      `tecnologia_notas`.`idTecnologia`,
      `tecnologia_notas`.`nota`,
      `tecnologia_notas`.`idUsuario`)
  values(
      idTecnologia,
      nota,
      idUsuario);  
      
  set idNota=(select @@identity);
end if;

Select 
    n.`idNota`,
    `FormatoFechaHora`(n.`fechahora`) as fechahora,
    u.`nombreCompleto` as nombreUsuario
from
    `tecnologia_notas` as n
    inner join `usuario` as u on ( u.`idUsuario`=n.`idUsuario` )
where 
     n.`idNota`=idNota
limit 1;                 


END$$

DELIMITER ;

/* Definition for the `spInsTipoProyecto` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsTipoProyecto`(
        IN `idTipoProyecto` INTEGER,
        IN `nombre` VARCHAR(200)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `tipoproyecto` as d where d.`nombre`=nombre and d.`idTipoProyecto`<>idTipoProyecto) then
   set idTipoProyecto=-1;
else
	if (idTipoProyecto=0) then
        set idTipoProyecto=Coalesce((select max(d.`idTipoProyecto`)+1 from `tipoproyecto` as d),0);
    	insert into `tipoproyecto`(
        	`tipoproyecto`.`idTipoProyecto`,
            `tipoproyecto`.nombre)
        values(
        	idTipoProyecto,
        	nombre);
           
    else
    	UPDATE
        	`tipoproyecto`
        set
            `tipoproyecto`.`nombre`=nombre
        where
            `tipoproyecto`.`idTipoProyecto`=idTipoProyecto;        
    end if;    
end if;

select idTipoProyecto as idTipoProyecto;

END$$

DELIMITER ;

/* Definition for the `spInsUnidad` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `spInsUnidad`(
        IN `idUnidad` INTEGER,
        IN `nombre` VARCHAR(200)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

if exists(select 1 from `unidad` as d where d.`nombre`=nombre and d.`idUnidad`<>idUnidad) then
   set idUnidad=-1;
else
	if (idUnidad=0) then
        set idUnidad=Coalesce((select max(d.`idUnidad`)+1 from `unidad` as d),0);
    	insert into `unidad`(
        	`unidad`.`idUnidad`,
            `unidad`.nombre)
        values(
        	idUnidad,
        	nombre);
           
    else
    	UPDATE
        	`unidad`
        set
            `unidad`.`nombre`=nombre
        where
            `unidad`.`idUnidad`=idUnidad;        
    end if;    
end if;

select idUnidad as idUnidad;

END$$

DELIMITER ;

/* Definition for the `validarUsuario` procedure : */

DELIMITER $$

CREATE DEFINER = 'root'@'localhost' PROCEDURE `validarUsuario`(
        IN `email` VARCHAR(50),
        IN `clave` VARCHAR(30)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT ''
BEGIN

Select
    up.`idPerfil`,
    p.`nombre` as nombrePerfil,
    u.`idUsuario`,
    u.`nombreCompleto` as nombreUsuario,
    u.`correo`,
   coalesce( u.`administradorSistema`,0) as administradorSistema
from
    usuario as u 
    inner join `usuarios_perfil` as up on ( up.idUsuario=u.`idUsuario` )
    inner join perfil as p On ( p.`idPerfil`=up.`idPerfil` )
Where
    u.`correo` = email and
    u.`password` = clave; 
    


END$$

DELIMITER ;

/* Data for the `alarmatarea` table  (LIMIT 0,500) */

INSERT INTO `alarmatarea` (`idAlarmaTarea`, `descripcion`) VALUES
  (1,'Ninguna'),
  (2,'1 Día'),
  (3,'2 Dias'),
  (4,'3 Dias');
COMMIT;

/* Data for the `areas` table  (LIMIT 0,500) */

INSERT INTO `areas` (`idArea`, `nombre`) VALUES
  (1,'Area 1'),
  (2,'Area 2'),
  (3,'Area 3');
COMMIT;

/* Data for the `centros` table  (LIMIT 0,500) */

INSERT INTO `centros` (`idCentro`, `nombre`) VALUES
  (1,'Centro 1'),
  (2,'Centro 2'),
  (3,'Centro 3');
COMMIT;

/* Data for the `compromisosfinanciamiento` table  (LIMIT 0,500) */

INSERT INTO `compromisosfinanciamiento` (`idCompromisoFinanciamiento`, `idFuenteFinanciamiento`, `origen`, `idOrigen`, `tipoFinanciamiento`, `montoFinanciamiento`, `fechaComprometida`) VALUES
  (1,2,2,10,1,1500000,'20180610'),
  (2,3,2,10,1,5000000,'20180630'),
  (3,3,2,10,2,1350000,'20180614'),
  (15,2,2,10,2,1000000,'20180619'),
  (17,1,3,1,1,1500000,'20180928'),
  (18,1,3,1,1,5000000,'20181010'),
  (19,1,3,9,1,5000000,'20180926'),
  (20,1,3,9,1,5700000,'20181026'),
  (21,3,3,9,2,3000000,'20181030'),
  (23,3,3,9,1,2500000,'20181020'),
  (24,1,2,10,1,25000000,'20181027');
COMMIT;

/* Data for the `contrato` table  (LIMIT 0,500) */

INSERT INTO `contrato` (`idContrato`, `codigoContrato`, `nombre`, `descripcion`, `idTipoContrato`, `idUsuarioEncargado`, `idUnidadNegocio`, `idEstadoContrato`, `fechaEstado`, `fechaCreacion`) VALUES
  (13,'001','test','prueba',2,2,2,1,NULL,'2019-02-13 00:00:00'),
  (14,'002','test contrato','prueba',3,1,2,1,'20190213','2019-02-13 15:41:33');
COMMIT;

/* Data for the `contrato_estadocontrato` table  (LIMIT 0,500) */

INSERT INTO `contrato_estadocontrato` (`idContrato_EstadoContrato`, `idContrato`, `idEstadoContrato`, `fechaEstado`) VALUES
  (33,14,1,'20190227');
COMMIT;

/* Data for the `contrato_fuentefinanciamiento` table  (LIMIT 0,500) */

INSERT INTO `contrato_fuentefinanciamiento` (`idContrato`, `idFuenteFinanciamiento`, `contacto`) VALUES
  (14,2,'David Diaz, Departamento de Informatica, Nº cel 88888884141');
COMMIT;

/* Data for the `contrato_notas` table  (LIMIT 0,500) */

INSERT INTO `contrato_notas` (`idNota`, `idContrato`, `nota`, `fechahora`, `idUsuario`) VALUES
  (25,14,'nota contrato','2019-02-14 15:56:31',2);
COMMIT;

/* Data for the `cuentacorriente` table  (LIMIT 0,500) */

INSERT INTO `cuentacorriente` (`idCuentaCorriente`, `numeroCuenta`, `descripcion`, `activa`, `idProyecto`) VALUES
  (1,'102102-201','cuenta para proyecto 2018 ',1,0),
  (2,'2154521','cuenta Proyectos 2017',1,1);
COMMIT;

/* Data for the `cuentaspresupuesto` table  (LIMIT 0,500) */

INSERT INTO `cuentaspresupuesto` (`idCuentaPresupuesto`, `descripcion`) VALUES
  (1,'RRHH'),
  (2,'GASTOS DE ADMINISTRACION'),
  (3,'GASTOS DE OPERACION');
COMMIT;

/* Data for the `disciplinaconocimiento` table  (LIMIT 0,500) */

INSERT INTO `disciplinaconocimiento` (`idDisciplinaConocimiento`, `nombre`) VALUES
  (1,'disciplina 1'),
  (2,'disciplina 2'),
  (3,'disciplina 3');
COMMIT;

/* Data for the `egresoctacte` table  (LIMIT 0,500) */

INSERT INTO `egresoctacte` (`idEgresoCtacte`, `fecha`, `origen`, `idOrigen`, `monto`, `detalle`, `idCuentaCorriente`, `comprobanteEgreso`, `ordenCompra`, `idFormaPago`, `numeroDocumentoPago`, `numeroDocumentoCompra`, `idItemPresupuesto`) VALUES
  (3,'20180704',2,10,350000,'test',2,'0',0,NULL,NULL,NULL,NULL),
  (4,'20180725',2,1,500000,'honorarios',2,'1233',0,NULL,NULL,NULL,NULL),
  (5,'20180724',2,1,250000,'compra de materiales',2,'120092',0,NULL,NULL,NULL,NULL),
  (6,'20180725',2,10,350000,'test egreso',1,'23232',0,NULL,NULL,NULL,NULL),
  (7,'20180731',2,10,150000,'sdsd',1,'0',0,NULL,NULL,NULL,NULL),
  (8,'20181023',2,1,55000,'sdsdsds',1,'2332323',0,NULL,NULL,NULL,NULL),
  (9,'20181002',2,8,151000,'test',1,'0',23510,4,'1240',NULL,NULL),
  (10,'20181114',2,10,600000,NULL,1,'5260',0,1,'0',NULL,39);
COMMIT;

/* Data for the `estadocontrato` table  (LIMIT 0,500) */

INSERT INTO `estadocontrato` (`idEstadoContrato`, `nombre`) VALUES
  (1,'Creado');
COMMIT;

/* Data for the `estadoiniciativa` table  (LIMIT 0,500) */

INSERT INTO `estadoiniciativa` (`idEstadoIniciativa`, `nombre`) VALUES
  (1,'Estado Iniciativa 1'),
  (2,'Estado Iniciativa 2');
COMMIT;

/* Data for the `estadopostulacion` table  (LIMIT 0,500) */

INSERT INTO `estadopostulacion` (`idEstadoPostulacion`, `nombre`) VALUES
  (0,'Creada'),
  (1,'Enviada'),
  (2,'Aceptada'),
  (3,'Rechazada');
COMMIT;

/* Data for the `estadoproteccion` table  (LIMIT 0,500) */

INSERT INTO `estadoproteccion` (`idEstadoProteccion`, `nombre`) VALUES
  (1,'Estado Proteccion 1'),
  (2,'Estado Proteccion 2');
COMMIT;

/* Data for the `estadoproyecto` table  (LIMIT 0,500) */

INSERT INTO `estadoproyecto` (`idEstadoProyecto`, `nombre`) VALUES
  (0,'Creado'),
  (1,'Preparación'),
  (2,'Activado'),
  (3,'Terminado'),
  (4,'Termino Anticipado'),
  (5,'Terminado con observaciones');
COMMIT;

/* Data for the `estadotecnologia` table  (LIMIT 0,500) */

INSERT INTO `estadotecnologia` (`idEstadoTecnologia`, `nombre`) VALUES
  (1,'estado 1'),
  (3,'estado 3');
COMMIT;

/* Data for the `formadepago` table  (LIMIT 0,500) */

INSERT INTO `formadepago` (`idFormaPago`, `nombre`) VALUES
  (1,'Transferencia'),
  (2,'Depósito'),
  (3,'Efectivo'),
  (4,'Cheque');
COMMIT;

/* Data for the `fuentefinanciamiento` table  (LIMIT 0,500) */

INSERT INTO `fuentefinanciamiento` (`idFuenteFinanciamiento`, `nombre`, `rut`, `idPais`, `direccion`, `region`, `telefono`, `web`) VALUES
  (1,'CORFO',NULL,NULL,NULL,NULL,NULL,NULL),
  (2,'EMPRESA PRIVADA',NULL,NULL,NULL,NULL,NULL,NULL),
  (3,'USACH',NULL,NULL,NULL,NULL,NULL,NULL),
  (4,'Prueba','111',1,'a','s','d','vc'),
  (5,'U DE CHILE','12121212',1,'FDSFSDFDSFDSF','DFSDSFFDSF','DFD434234','QWQQWQWQW');
COMMIT;

/* Data for the `ingresoctacte` table  (LIMIT 0,500) */

INSERT INTO `ingresoctacte` (`idIngresoCtacte`, `fecha`, `idFinancista`, `origen`, `idOrigen`, `monto`, `detalle`, `idCuentaCorriente`, `idFormaPago`, `numeroDocumentoPago`) VALUES
  (6,'20180720',3,2,1,1200000,'test',2,0,''),
  (7,'20180718',1,2,1,1500000,'prueba',2,0,''),
  (8,'20180725',1,2,10,3500000,'50% aporte',2,0,''),
  (9,'20180720',2,2,10,1000000,'aporte parcial',1,0,''),
  (10,'20180725',2,2,1,1000000,'test',2,0,''),
  (11,'20180712',3,2,2,1000000,'dfsdfdsfs',1,0,''),
  (12,'20181018',1,2,1,1500000,'test select',1,0,''),
  (13,'20181024',1,2,4,5000000,'test',1,1,'541400'),
  (14,'20181012',3,2,11,3500000,'test 2',1,4,'120120'),
  (15,'20181030',2,2,3,1500000,'test 3',1,2,'4181247210');
COMMIT;

/* Data for the `iniciativa` table  (LIMIT 0,500) */

INSERT INTO `iniciativa` (`idIniciativa`, `nombre`, `descripcion`, `idUsuarioEncargado`, `idUnidadNegocio`, `idEstadoIniciativa`, `fechaEstado`, `fechaCreacion`, `idTipoIniciativa`) VALUES
  (11,'test','prueba',1,2,2,'20181023','2018-08-27 18:48:24',4),
  (12,'prueba nueva iniciativa','probando',3,2,1,'20181009','2018-10-07 19:48:03',3),
  (13,'test david','test',2,2,0,NULL,'2018-10-11 10:57:48',4),
  (14,'prueba 01','prueba',2,2,0,NULL,'2018-10-11 11:14:35',4),
  (15,'prueba 2','david',1,1,0,NULL,'2018-10-11 11:15:44',3),
  (16,'prueba 3','test',3,1,0,NULL,'2018-10-11 11:17:22',3),
  (17,'PRUEBA 5','test',2,2,0,NULL,'2018-10-11 11:20:49',3),
  (18,'PRUEBA 6','sdsdsd',1,2,0,NULL,'2018-10-11 11:24:49',3),
  (19,'PRUEBA 6','sdsdsd',1,2,0,NULL,'2018-10-11 11:25:00',3),
  (20,'PRUEBA 7','sdsdsd',1,1,0,NULL,'2018-10-11 11:26:59',3),
  (21,'PRUEBA  12','test',3,2,0,NULL,'2018-10-11 11:52:17',3),
  (22,'prueba 13','test 13',1,1,2,'20181016','2018-10-11 11:53:55',4),
  (23,'test dd','pruieba',2,2,0,NULL,'2018-12-28 16:48:33',3);
COMMIT;

/* Data for the `iniciativa_areaprioritaria` table  (LIMIT 0,500) */

INSERT INTO `iniciativa_areaprioritaria` (`idIniciativa`, `idArea`) VALUES
  (11,2),
  (22,2);
COMMIT;

/* Data for the `iniciativa_centro` table  (LIMIT 0,500) */

INSERT INTO `iniciativa_centro` (`idIniciativa`, `idCentro`) VALUES
  (11,2),
  (22,2);
COMMIT;

/* Data for the `iniciativa_disciplinaconocimiento` table  (LIMIT 0,500) */

INSERT INTO `iniciativa_disciplinaconocimiento` (`idIniciativa`, `idDisciplinaConocimiento`) VALUES
  (11,2),
  (12,2),
  (12,3);
COMMIT;

/* Data for the `iniciativa_equipotrabajo` table  (LIMIT 0,500) */

INSERT INTO `iniciativa_equipotrabajo` (`idIniciativa`, `idInvestigador`, `idFuenteFinanciamiento`, `idPerfil`, `horas`, `porcentajeParticipacion`, `principal`) VALUES
  (11,1728,1,1,350,20,0),
  (11,2431,1,1,400,30,0),
  (11,2488,1,1,1200,50,1),
  (22,2431,1,1,0,100,1),
  (23,2431,1,1,121,10,1);
COMMIT;

/* Data for the `iniciativa_estadoiniciativa` table  (LIMIT 0,500) */

INSERT INTO `iniciativa_estadoiniciativa` (`idIniciativa_EstadoIniciativa`, `idIniciativa`, `idEstadoIniciativa`, `fechaEstado`) VALUES
  (30,11,1,'20180830'),
  (31,11,2,'20180831'),
  (32,11,1,'20181026'),
  (33,11,2,'20181023'),
  (34,12,1,'20181009'),
  (35,22,2,'20181016');
COMMIT;

/* Data for the `iniciativa_notas` table  (LIMIT 0,500) */

INSERT INTO `iniciativa_notas` (`idNota`, `idIniciativa`, `nota`, `fechahora`, `idUsuario`) VALUES
  (3,22,'test 1','2018-10-11 23:50:21',2),
  (4,22,'test 2','2018-10-11 23:50:24',2);
COMMIT;

/* Data for the `iniciativa_sectorimpacto` table  (LIMIT 0,500) */

INSERT INTO `iniciativa_sectorimpacto` (`idIniciativa`, `idSectorImpacto`) VALUES
  (11,5),
  (22,2),
  (22,5);
COMMIT;

/* Data for the `investigador` table  (LIMIT 0,500) */

INSERT INTO `investigador` (`idInvestigador`, `apellidos`, `nombres`, `numeroIdentificacion`, `email`, `telefonoFijo`, `telefonoMovil`, `direccion`, `idPerfilInvestigador`, `departamento_id`, `institucion_id`) VALUES
  (1,'MUÑOZ','GABRIEL','16327225-3','gbelmm@gmail.com','','','',2,5,1),
  (2,'Diaz Urrea','David Antonio','13.292.380-9','david.diaz@itsoft.cl','','','',2,12,2),
  (3,'GAUTIER ZAMORA','JUAN LIUIS','4556384-7','','','','',2,8,2),
  (4,'LEVYREBI','ISAAC','EXT-4',NULL,'','','',2,16,1),
  (6,'NAVARRO DONOSO','PATRICIO EUGENIO','5524974-1','patricio.navarro@usach.cl','','','',2,14,2),
  (7,'SIMPSON ALVAREZ','JAIME ROBERTO','8276625-1','JAIME.SIMPSON@USACH:CL','','','',2,14,2),
  (8,'ROZAS SOTO','ROBERTO','3487156-6','ROBERTO.ROZAS@USACH:CL','','','',2,7,2),
  (9,'GAETE GARRETON','LUIS FRANCISCO JAVIER','4771958-5','LUIS.GAETE@USACH:CL','','','',2,18,2),
  (10,'VARGAS HERNANDEZ','YOLANDA DEL PILAR','9009300-2','YOLANDA.VARGAS@USACH:CL','','','',2,18,2),
  (11,'GUTIERREZ SILVA','ALEJANDRO GUILLERMO','7062764-7','ALEJANDRO.GUTIERREZ@USACH:CL','','','',2,13,2),
  (12,'GRAMSCH LABRA','ERNESTO VICENTE','6621879-1','ERNESTO.GRAMSCH@USACH:CL','','','',2,18,2),
  (13,'CIFUENTES MOLINA','GERARDO ALEXIS','8878331-K','GERARDO.CIFUENTES@USACH:CL','','','',2,14,2),
  (14,'GANGA MUNOZ','MARIA ANGELICA','10710712-6','MARIA.GANGA@USACH:CL','','','',2,38,2),
  (15,'MARTINEZ FERNANDEZ','CLAUDIO ANDRES','10228308-2','CLAUDIO.MARTINEZ@USACH:CL','','','',2,38,2),
  (16,'VILLABLANCA MARTINEZ','MIGUEL ENRIQUE','5837814-3','MIGUEL.VILLABLANCA@USACH:CL','','','',2,10,2),
  (17,'CASTILLO NARA','ANTONIO ROSAMEL','6826857-5','ANTONIO.CASTILLO@USACH:CL','','','',2,6,2),
  (18,'ZUNIGA NAVARRO','GUSTAVO EMILIO','8316296-1','GUSTAVO.ZUNIGA@USACH:CL','','','',2,6,2),
  (19,'VARGAS RIQUELME','CRISTIAN ALEJANDRO','11952574-8','CRISTIAN.VARGAS@USACH:CL','','','',2,14,2),
  (20,'SILVA SERRANO','JOSE ROLANDO','5198743-8','JOSE.SILVA@USACH:CL','','','',2,38,2),
  (21,'TOMIC STEFANIN','GERDA ROXANA','5201125-6','GERDA.TOMIC@USACH:CL','','','',2,38,2),
  (22,'SALINAS SILVA','RENATO ALBERTO CARLOS ALFONSO','6119746-K','RENATO.SALINAS@USACH:CL','','','',2,13,2),
  (23,'GALOTTO LOPEZ','MARIA JOSE ALICIA','14649940-6','MARIA.GALOTTO@USACH:CL','','','',2,38,2),
  (24,'GUARDA MORAGA','ABEL','5334010-5','ABEL.GUARDA@USACH:CL','','','',2,38,2),
  (25,'LOPEZ VILLARROEL','MARIO JOSE','5643463-1','MARIO.LOPEZ@USACH:CL','','','',2,11,2),
  (26,'PONCE ARIAS','HECTOS RAUL','10602534-7',NULL,'','','',2,21,2),
  (27,'OSORIO LIRA','FERNANDO ALBERTO','6287295-0','FERNANDO.OSORIO@USACH:CL','','','',2,38,2),
  (28,'BARRERA ZUNIGA','HECTOR FLORENCIO','6045607-0','','','','',2,5,2),
  (29,'MOENNE MUNOZ','ALEJANDRA LEONOR SOLANGE','8420757-8','ALEJANDRA.MOENNE@USACH:CL','','','',2,6,2),
  (30,'COTORAS TADIC','MILENA NILA','6915727-0','MILENA.COTORAS@USACH:CL','','','',2,6,2),
  (31,'BUSTOS CERDA','RUBEN OSVALDO','9802583-9','RUBEN.BUSTOS@USACH:CL','','','',2,15,2),
  (32,'RIOS RAMIREZ','MIGUEL ANGEL','8266676-1','MIGUEL.RIOS@USACH:CL','','','',2,6,2),
  (33,'CABELLO BUSTOS','HECTOR ALEJANDRO','12603902-6','HECTOR.CABELLO@USACH:CL','','','',2,37,2),
  (34,'MONSALVE GONZALEZ','ALBERTO EDUARDO','7808763-3','ALBERTO.MONSALVE@USACH:CL','','','',2,14,2),
  (35,'IMARAI BAHAMONDE','CARMEN MONICA','8160660-9','CARMEN.IMARAI@USACH:CL','','','',2,6,2),
  (36,'MORALES MUNOZ','BERNARDO ENRIQUE','8782201-K','BERNARDO.MORALES@USACH:CL','','','',2,6,2),
  (37,'ACUNA CASTILLO','CLAUDIO ANTONIO','12445112-4','claudio.acuna@usach.cl','','','',2,6,2),
  (38,'MODAK CANOBRA','BRENDA ETHEL','9107238-6','BRENDA.MODAK@USACH:CL','','','',2,7,2),
  (39,'SANDINO GARCIA','ANA MARIA','7656244-K','ANA.SANDINO@USACH:CL','','','',2,6,2),
  (40,'TORRES GAONA','MIGUEL RENE','4359030-8','MIGUEL.TORRES@USACH:CL','','','',2,7,2),
  (41,'CERDA VILLABLANCA','ENRIQUE ARIEL','10937806-2','ENRIQUE.CERDA@USACH:CL','','','',2,18,2),
  (42,'ESCUDEY CASTRO','ALDO MAURICIO','6154376-7','','','','',2,8,2),
  (43,'GUTIERREZ CUTINO','MARLEN DEL CARMEN','13680713-7','MARLEN.GUTIERREZ@USACH:CL','','','',2,8,2),
  (44,'ALTBIR DRULLINSKY','DORA ROSA','6957244-8','dora.altbir@usach.cl','','','',2,39,2),
  (45,'CASAGRANDE DENARDIN','JULIANO','21959542-5','JULIANO.CASAGRANDE@USACH:CL','','','',2,18,2),
  (46,'ACUNA LEIVA','GONZALO PEDRO NOLASCO','6947637-6','GONZALO.ACUNA@USACH:CL','','','',2,12,2),
  (47,'CHACON PACHECO','MAX LEONARDO','8079660-9','MAX.CHACON@USACH:CL','','','',2,12,2),
  (48,'ALVAREZ CEA','ARTURO CESAR','13693438-4','','','','',2,12,2),
  (49,'AGUIRRE QUINTANA','MARIA JESUS','7627760-5','MARIA.AGUIRRE@USACH:CL','','','',2,8,2),
  (50,'MATSUHIRO YAMAMOTO','BETTY','7573987-7','BETTY.MATSUHIRO@USACH:CL','','','',2,7,2),
  (51,'MENDOZA ESPINOLA','LEONORA SOFIA','9389571-1','LEONORA.MENDOZA@USACH:CL','','','',2,8,2),
  (52,'ROMERO FIGUEROA','JULIO RODRIGO','12404385-9','JULIO.ROMERO@USACH:CL','','','',2,15,2),
  (53,'VASQUEZ GUZMAN','CLAUDIO CHRISTIAN','6564716-8','CLAUDIO.VASQUEZ@USACH:CL','','','',2,6,2),
  (54,'CANETE ARRATIA','LUCIO RAUL','9487094-1','','','','',2,5,2),
  (55,'MONTALVA RAMIREZ','AIBERTO TUCAPEL','1729312-5','AIBERTO.MONTALVA@USACH:CL','','','',2,14,2),
  (56,'ORTIZ CALDERON','CLAUDIA ANDREA','9796400-9','CLAUDIA.ORTIZ@USACH:CL','','','',2,6,2),
  (57,'WILKENS ANWANDTER','MARCELA ANDREA','7176892-9','MARCELA.WILKENS@USACH:CL','','','',2,6,2),
  (58,'CASTRO MORALES','SERGIO ANTONIO','10284690-7','SERGIO.CASTRO@USACH:CL','','','',2,6,2),
  (59,'MAHN OSSES','ANDREA VERONICA','10983053-4','ANDREA.MAHN@USACH:CL','','','',2,15,2),
  (60,'CARDENAS SANKAN','GUILLERMO HUGO','7186407-3','GUILLERMO.CARDENAS@USACH:CL','','','',2,6,2),
  (61,'RABAGLIATI CANESSA','FRANCO MIGUEL ERNESTO','2931573-6','FRANCO.RABAGLIATI@USACH:CL','','','',2,7,2),
  (62,'ZAPATA RAMIREZ','PAULA ANDREA','21797734-7','paula.zapata@usach.cl','','','',2,39,2),
  (63,'ESCOBAR CERDA','ALEJANDRO HERNAN','3645654-K','ALEJANDRO.ESCOBAR@USACH:CL','','','',2,23,2),
  (64,'MATIACEVICH SSA','SILVIA BEATRIZ','22807628-7','silvia.matiacevich@usach.cl','','','',2,39,2),
  (65,'ARANCIBIA MIRANDA','NICOLAS EDUARDO','13455126-7','NICOLAS.ARANCIBIA@USACH:CL','','','',2,8,2),
  (66,'PIZARRO ARRIAGADA','CARMEN GLORIA','9798684-3','CARMEN.PIZARRO@USACH:CL','','','',2,8,2),
  (67,'ACEVEDO LIRA','CRISTIAN LEONARDO','12541324-2','CRISTIAN.ACEVEDO@USACH:CL','','','',2,10,2),
  (68,'ROSAS ZUMELZU','CESAR ERNESTO','5152034-3','CESAR.ROSAS@USACH:CL','','','',2,13,2),
  (69,'BUBNOVICH ','VALERI IVANOVICH','14521853-5','VALERI.BUBNOVICH@USACH:CL','','','',2,15,2),
  (70,'SANTANDER MOYA','ROBERTO ENRIQUE','7171091-2','ROBERTO.SANTANDER@USACH:CL','','','',2,13,2),
  (71,'MORAGA BENAVIDES','NELSON ORLANDO','6298500-3','NELSON.MORAGA@USACH:CL','','','',2,13,2),
  (72,'PIZARRO KONCZAK','JAIME FRANCISCO','6650896-K','JAIME.PIZARRO@USACH:CL','','','',2,35,2),
  (73,'CONSTANDIL CORDOVA','LUIS ERNESTO','10067213-8','LUIS.CONSTANDIL@USACH:CL','','','',2,6,2),
  (74,'MONTALVO MARTINEZ','SILVIO JACINTO','21652970-7','SILVIO.MONTALVO@USACH:CL','','','',2,15,2),
  (75,'MARIN CAIHUAN','JUAN MAURICIO','7153158-9','','','','',2,12,2),
  (76,'ABARZUA ORTIZ','RODRIGO GERMAN','13235434-0','RODRIGO.ABARZUA@USACH:CL','','','',2,11,2),
  (77,'VALENZUELA MONTENEGRO','BEATRIZ DE LOURDES','13189747-2','','','','',2,6,2),
  (78,'VIDAL SOTO','RUBEN RODRIGO','9112063-1','RUBEN.VIDAL@USACH:CL','','','',2,6,2),
  (79,'LAURIDO FUENZALIDA','CLAUDIO AURELIO','6772733-9','CLAUDIO.LAURIDO@USACH:CL','','','',2,6,2),
  (80,'ROJAS DIAZ','OSCAR FRANCISCO','13261308-7','OSCAR.ROJAS@USACH:CL','','','',2,19,2),
  (81,'ORIHUELA DIAZ','PEDRO ALEJANDRO','14577351-2','','','','',2,6,2),
  (82,'CORTEZ SAN MARTIN','MARCELO ANDRES','16080631-1','marcelo.cortez@usach.cl','','','',2,39,2),
  (83,'VENEGAS YAZIGI','DIEGO ALONSO','10561501-9','diego.venegas@usach.cl','','','',2,8,2),
  (84,'CAVIERES REBOLLEDO','ELENA DE LAS MERCEDES','6366182-1','ELENA.CAVIERES@USACH:CL','','','',2,38,2),
  (89,'CALEBOTTA DULCIC','MARIO ','EXT-1','','','','',2,16,1),
  (90,'GATICA ROJAS','JORGE','EXT-2','','','','',2,16,1),
  (91,'ROA FERREIRA','MARGARITA','EXT-3','','','','',2,16,1),
  (92,'MAGNE ORTEGA','LUIS ALBERTO','8184647-2','luis.magne@usach.cl','','','',2,14,2),
  (93,'LEVYREBI ','ISAAC','1111111-1','','','','',2,16,2),
  (94,'Huiliñir Curío','Cesar Esteban','13733335-k','cesar.huilinir@usach.cl','','','',2,15,2),
  (95,'CUBILLOS MONTECINO','FRANCISCO ANIBAL','7446246-4','FRANCISCO.CUBILLOS@USACH:CL','','','',2,15,2),
  (96,'LOPEZ ANGULO','DANIEL ENRIQUE','14359264-2','DANIEL.LOPEZ@USACH:CL','','','',2,5,2),
  (97,'CHANA CUEVAS','PEDRO FRANCISCO','6553247-6','PEDRO.CHANA@USACH:CL','','','',2,25,2),
  (98,'MASCAYANO COLLADO','CAROLINA LORENA','12413559-1','CAROLINA.MASCAYANO@USACH:CL','','','',2,7,2),
  (99,'ORREGO ALFARO','PEDRO ALEX','7088987-0','PEDRO.ORREGO@USACH:CL','','','',2,14,7),
  (100,'Hernandez Torres','Jose','EXT-5',NULL,'','','',2,16,7),
  (101,'Olavarria Gambi','Mauricio','8046902-0','mauricio.olavarria@usach.cl','','','',2,32,2),
  (102,'Torres Aviles','Francisco Javier','9609192-3','francisco.torres@usach.cl','','','',2,19,2),
  (103,'Hernandez Silva','Carla Viviana','14123542-7','carla.hernandez.s@usach.cl','','','',2,18,2),
  (104,'PESSE LOHR','OSCAR RICARDO','4708020-7','OSCAR.PESSE@USACH:CL','','','',2,18,2),
  (105,'HERRERA GONZALEZ','VICTOR FERNANDO','9125416-6','VICTOR.HERRERA@USACH:CL','','','',2,35,2),
  (106,'ARANDA LACOMBE','PATRICIA MARCELA','5029939-2','PATRICIA.ARANDA@USACH:CL','','','',2,6,2),
  (107,'ABARZUA GUINEZ','JORGE JAIME','4058874-4','JORGE.ABARZUA@USACH:CL','','','',2,18,2),
  (108,'ABUIN SACCOMANO','ELSA BEATRIZ','6228793-4','ELSA.ABUIN@USACH:CL','','','',2,7,2),
  (109,'ABURTO MELO','MIGUEL ANGEL','6069526-1','MIGUEL.ABURTO@USACH:CL','','','',2,37,2),
  (110,'ACENCIO OLIVA','JUDITH DEL CARMEN','14367080-5','JUDITH.ACENCIO@USACH:CL','','','',2,8,2),
  (111,'ACEVEDO GRIFERO','SERGIO PATRICIO','4485716-2','SERGIO.ACEVEDO@USACH:CL','','','',2,33,2),
  (112,'ACEVEDO LOPEZ','SONIA ALEJANDRA','10530245-2','SONIA.ACEVEDO@USACH:CL','','','',2,19,2),
  (113,'ACEVEDO CORDOVA','MARCELA ALEJANDRA','13257771-4','MARCELA.ACEVEDO@USACH:CL','','','',2,25,2),
  (114,'ACUNA FERNANDEZ','PATRICIO LEOPOLDO','5126311-1','PATRICIO.ACUNA@USACH:CL','','','',2,7,2),
  (115,'ACUNA HORMAZABAL','GUILLERMO EDGARDO','6622835-5','GUILLERMO.ACUNA@USACH:CL','','','',2,19,2),
  (116,'ACUNA DONOSO','JUAN CARLOS','6539738-2','JUAN.ACUNA@USACH:CL','','','',2,18,2),
  (117,'ADASME AGUILERA','CECILIA MARIA','9796851-9','CECILIA.ADASME@USACH:CL','','','',2,35,2),
  (118,'ADASME SOTO','PABLO ALBERTO','14420559-6','PABLO.ADASME@USACH:CL','','','',2,11,2),
  (119,'AEDO MARCHANT','NORA INES','7506735-6','NORA.AEDO@USACH:CL','','','',2,37,2),
  (120,'AGUILA OLIVOS','DANIELA EUGENIA','15482585-1','DANIELA.AGUILA@USACH:CL','','','',2,36,2),
  (121,'AGUILAR MIRANDA','PEDRO ERNESTO','8350619-9','PEDRO.AGUILAR@USACH:CL','','','',2,25,2),
  (122,'AGUILAR PEREZ','RODRIGO ANDRES','12113777-1','RODRIGO.AGUILAR@USACH:CL','','','',2,17,2),
  (123,'AGUILAR LOPEZ','EVELYN CECILIA','13688649-5','EVELYN.AGUILAR@USACH:CL','','','',2,19,2),
  (124,'AGUILAR CARCAMO','PATRICIA FIDELISA','6875781-9','PATRICIA.AGUILAR@USACH:CL','','','',2,36,2),
  (125,'AGUILAR LEYTON','ELVIRA LOURDES','9295194-4','ELVIRA.AGUILAR@USACH:CL','','','',2,30,2),
  (126,'AGUILAR MARTINEZ','OMAR DOMINGO','14703436-9','OMAR.AGUILAR@USACH:CL','','','',2,5,2),
  (127,'AGUILAR SANDOVAL','FELIPE ANDRES','13774511-9','FELIPE.AGUILAR@USACH:CL','','','',2,18,2),
  (128,'AGUILERA PEREZ','MARIO OSVALDO','6973508-8','MARIO.AGUILERA@USACH:CL','','','',2,5,2),
  (129,'AGUILERA CAMPOS','PATRICIA ISABEL','9583618-6','PATRICIA.AGUILERA@USACH:CL','','','',2,31,2),
  (130,'AGUIRRE QUIJADA','JORGE RICARDO','8046065-1','JORGE.AGUIRRE@USACH:CL','','','',2,18,2),
  (131,'AGUIRRE PEREZ','WALDO VICTOR','5165979-1','WALDO.AGUIRRE@USACH:CL','','','',2,38,2),
  (132,'AGUIRRE CAMPOSANO','VIVIANA LUZ','7550619-8','VIVIANA.AGUIRRE@USACH:CL','','','',2,25,2),
  (133,'AGUIRRE LOPEZ','JORGE LEOPOLDO','5318770-6','JORGE.AGUIRRE@USACH:CL','','','',2,5,2),
  (134,'AGUIRRE GUZMAN','PAMELA ANDREA','11840309-6','PAMELA.AGUIRRE@USACH:CL','','','',2,12,2),
  (135,'AGUIRRE ALVAREZ','JUAN PABLO','9976199-7','JUAN.AGUIRRE@USACH:CL','','','',2,19,2),
  (136,'AHUMADA VARGAS','DANNY MARCELO','8249972-5','DANNY.AHUMADA@USACH:CL','','','',2,32,2),
  (137,'AHUMADA FIGUEROA','PAULINA VIRGINIA','7431692-1','PAULINA.AHUMADA@USACH:CL','','','',2,17,2),
  (138,'ALARCON SANCHEZ','JUAN CARLOS','15113174-3','JUAN.ALARCON@USACH:CL','','','',2,17,2),
  (139,'ALARCON HERNANDEZ','HECTOR ANTONIO','13911305-5','HECTOR.ALARCON@USACH:CL','','','',2,18,2),
  (140,'ALBORNOZ BUSTOS','ANDRES ALEJANDRO','15313012-4','ANDRES.ALBORNOZ@USACH:CL','','','',2,30,2),
  (141,'ALBURQUENQUE BARRERA','JOSE MARCIAL','8675697-8','JOSE.ALBURQUENQUE@USACH:CL','','','',2,14,2),
  (142,'ALCAINA DIAZ','EDUARDO','14735237-9','EDUARDO.ALCAINA@USACH:CL','','','',2,25,2),
  (143,'ALCARRAZ ECHEVERRIA','RUTH ZANDRA','6154002-4','RUTH.ALCARRAZ@USACH:CL','','','',2,19,2),
  (144,'ALFARO LEAL','JESSICA MIRTA','9408891-7','JESSICA.ALFARO@USACH:CL','','','',2,27,2),
  (145,'ALFARO MARCHANT','MIGUEL DOMINGO','7546421-5','MIGUEL.ALFARO@USACH:CL','','','',2,11,2),
  (146,'ALFARO SIRONVALLE','MARCO ANTONIO','5126673-0','MARCO.ALFARO@USACH:CL','','','',2,33,2),
  (147,'ALIAGA GAMBINO','HECTOR JUAN FERNANDO','4269382-0','HECTOR.ALIAGA@USACH:CL','','','',2,25,2),
  (148,'ALLENDE CALDERON','MONICA CECILIA','6496622-7','MONICA.ALLENDE@USACH:CL','','','',2,35,2),
  (149,'ALRUIZ LUAN','JULIO IVAN','6551509-1','JULIO.ALRUIZ@USACH:CL','','','',2,10,2),
  (150,'ALTAMIRANO CADIMA','KATHERINE ANDREA','13469027-5','KATHERINE.ALTAMIRANO@USACH:CL','','','',2,34,2),
  (151,'ALVARADO BUSTAMANTE','HECTOR MAURICIO','5017300-3','HECTOR.ALVARADO@USACH:CL','','','',2,5,2),
  (152,'ALVARADO ROBIS','PEDRO TOMAS','4169274-K','PEDRO.ALVARADO@USACH:CL','','','',2,19,2),
  (153,'ALVARADO LIZANA','DANIEL ANDRES','12679680-3','DANIEL.ALVARADO@USACH:CL','','','',2,34,2),
  (154,'ALVARADO JORQUERA','OSCAR','5410181-3','OSCAR.ALVARADO@USACH:CL','','','',2,25,2),
  (155,'ALVAREZ QUINTEROS','FIDEL FABIAN','8393643-6','FIDEL.ALVAREZ@USACH:CL','','','',2,11,2),
  (156,'ALVAREZ GARCIA','RUBY PRADELIA','12255189-K','RUBY.ALVAREZ@USACH:CL','','','',2,15,2),
  (157,'ALVAREZ CORONA','FRESIA ANDREA','9831098-3','FRESIA.ALVAREZ@USACH:CL','','','',2,38,2),
  (158,'ALVAREZ MORALES','YANIRA NICOLE','17376289-5','YANIRA.ALVAREZ@USACH:CL','','','',2,35,2),
  (159,'ALVAREZ GUTIERREZ','PEDRO IVAN','3557384-4','PEDRO.ALVAREZ@USACH:CL','','','',2,15,2),
  (160,'ALVAREZ GUENCHUMAN','JOSE ARSENIO','6356783-3','JOSE.ALVAREZ@USACH:CL','','','',2,12,2),
  (161,'ALVAREZ VALLADARES','EMILIANO LIZARDO','5327663-6','EMILIANO.ALVAREZ@USACH:CL','','','',2,10,2),
  (162,'ALVAREZ CALDERON','MARCOS ALEJANDRO','8608686-7','MARCOS.ALVAREZ@USACH:CL','','','',2,5,2),
  (163,'ALVAREZ ZEPEDA','CARLOS MANUEL','8879253-K','CARLOS.ALVAREZ@USACH:CL','','','',2,25,2),
  (164,'ALVAREZ CANALES','IVONNE LUCIA','7132251-3','IVONNE.ALVAREZ@USACH:CL','','','',2,18,2),
  (165,'ALVAREZ VEAS','MARIA CECILIA','7674611-7','MARIA.ALVAREZ@USACH:CL','','','',2,38,2),
  (166,'ALVAREZ MALDONADO','JAIME OMAR','10341154-8','JAIME.ALVAREZ@USACH:CL','','','',2,19,2),
  (167,'ALVAREZ SEGUEL','TATIANA MARCELA','9756521-K','TATIANA.ALVAREZ@USACH:CL','','','',2,15,2),
  (168,'ALVAREZ LISTER','MARIA SOLEDAD','15368369-7','MARIA.ALVAREZ@USACH:CL','','','',2,30,2),
  (169,'ALVAREZ VILLAR','SISSY ANNE','13889018-K','SISSY.ALVAREZ@USACH:CL','','','',2,11,2),
  (170,'ALVAREZ MILLACURA','MARCELINA','8137978-5','MARCELINA.ALVAREZ@USACH:CL','','','',2,25,2),
  (171,'ALVEAR ESPINOZA','MABEL EUFEMIA','8116500-9','MABEL.ALVEAR@USACH:CL','','','',2,31,2),
  (172,'AMPUERO PINO','MYRIAM DEL CARMEN','8001871-1','MYRIAM.AMPUERO@USACH:CL','','','',2,21,2),
  (173,'AMPUERO ALFARO','MARIA HORTENSIA','6851734-6','MARIA.AMPUERO@USACH:CL','','','',2,33,2),
  (174,'ANDAUR BASTIAS','CESAR JORGE','6695195-2','CESAR.ANDAUR@USACH:CL','','','',2,17,2),
  (175,'ANDAUR ALISTE','RODOLFO EUGENIO','8013981-0','RODOLFO.ANDAUR@USACH:CL','','','',2,11,2),
  (176,'ANDRADE VELASQUEZ','JANET ELIDA','8313185-3','JANET.ANDRADE@USACH:CL','','','',2,18,2),
  (177,'ANDRADE CUADRA','VICTOR ENZO','7649387-1','VICTOR.ANDRADE@USACH:CL','','','',2,13,2),
  (178,'ANDRADES MUNOZ','MIGUEL ARTURO','8153289-3','MIGUEL.ANDRADES@USACH:CL','','','',2,13,2),
  (179,'ANTILEF JARA','RUTH ROSEMARIE','9765706-8','RUTH.ANTILEF@USACH:CL','','','',2,38,2),
  (180,'ANTILLANCA ESPINA','HECTOR BENICIO','6577654-5','HECTOR.ANTILLANCA@USACH:CL','','','',2,12,2),
  (181,'ANTILLANCA QUINTREQUEO','RAYEN VALERIA','12502378-9','RAYEN.ANTILLANCA@USACH:CL','','','',2,19,2),
  (182,'APEY GUZMAN','ALFREDO','7385005-3','ALFREDO.APEY@USACH:CL','','','',2,35,2),
  (183,'ARACENA URRUTIA','CARLOS MALAQUIAS','9765610-K','CARLOS.ARACENA@USACH:CL','','','',2,5,2),
  (184,'ARANCIBIA CARRASCO','RENE ARMANDO','6243523-2','RENE.ARANCIBIA@USACH:CL','','','',2,19,2),
  (185,'ARANCIBIA PEDREROS','TERESA ALICIA VERONICA','5320656-5','TERESA.ARANCIBIA@USACH:CL','','','',2,18,2),
  (186,'ARANCIBIA MORALES','LUIS HUMBERTO','6888624-4','LUIS.ARANCIBIA@USACH:CL','','','',2,19,2),
  (187,'ARANCIBIA HERRERA','DANIEL ARTURO','10542791-3','DANIEL.ARANCIBIA@USACH:CL','','','',2,35,2),
  (188,'ARANCIBIA BERRIOS','MARCELA DEL CARMEN','13088593-4','MARCELA.ARANCIBIA@USACH:CL','','','',2,17,2),
  (189,'ARANDA LAGOS','RODRIGO FERNANDO','7560656-7','RODRIGO.ARANDA@USACH:CL','','','',2,22,2),
  (190,'ARANDA ESPINOZA','CLAUDIA MARGARITA','12351551-K','CLAUDIA.ARANDA@USACH:CL','','','',2,15,2),
  (191,'ARANDA CHACON','ANGEL OMAR','7177776-6','ANGEL.ARANDA@USACH:CL','','','',2,19,2),
  (192,'ARANDA GREZ','FERNANDO RODOLFO','7478834-3','FERNANDO.ARANDA@USACH:CL','','','',2,25,2),
  (193,'ARANGUIZ ZAMBRANO','GUILLERMO SEGUNDO','4046429-8','GUILLERMO.ARANGUIZ@USACH:CL','','','',2,13,2),
  (194,'ARANGUIZ CANESSA','HUMBERTO JOSE','11844568-6','HUMBERTO.ARANGUIZ@USACH:CL','','','',2,33,2),
  (195,'ARANZUBIA VERA','SOLANGE XIMENA','13924983-6','SOLANGE.ARANZUBIA@USACH:CL','','','',2,19,2),
  (196,'ARAOS URIBE','CARLOS ALBERTO','9877239-1','CARLOS.ARAOS@USACH:CL','','','',2,29,2),
  (197,'ARAVENA DERPICH','SONIA ELIANA','4031947-6','SONIA.ARAVENA@USACH:CL','','','',2,29,2),
  (198,'ARAVENA CASTILLO','ANGELICA MARIA','11479783-9','ANGELICA.ARAVENA@USACH:CL','','','',2,15,2),
  (199,'ARAVENA QUINTERO','JUAN GUILLERMO','7203005-2','JUAN.ARAVENA@USACH:CL','','','',2,19,2),
  (200,'ARAVENA GUZMAN','FRANCISCO JAVIER','15157014-3','FRANCISCO.ARAVENA@USACH:CL','','','',2,23,2),
  (201,'ARAVENA NUNEZ','ALEJANDRO','8058916-6','ALEJANDRO.ARAVENA@USACH:CL','','','',2,25,2),
  (202,'ARAYA SILVA','MARITZA DEL CARMEN','9227815-8','MARITZA.ARAYA@USACH:CL','','','',2,19,2),
  (203,'ARAYA RAMIREZ','LETICIA BEATRIZ','12940341-1','LETICIA.ARAYA@USACH:CL','','','',2,23,2),
  (204,'ARAYA BERMUDEZ','MARIO FERNANDO','5278224-4','MARIO.ARAYA@USACH:CL','','','',2,35,2),
  (205,'ARAYA VILLALOBOS','ALFREDO SERGIO','6748957-8','ALFREDO.ARAYA@USACH:CL','','','',2,23,2),
  (206,'ARAYA SILVA','BELLA LORENA','10735087-K','BELLA.ARAYA@USACH:CL','','','',2,23,2),
  (207,'ARAYA SANCHEZ','DINO MAURICIO','11858156-3','DINO.ARAYA@USACH:CL','','','',2,19,2),
  (208,'ARAYA PENA','MARILU ALEXANDRA','10045984-1','MARILU.ARAYA@USACH:CL','','','',2,31,2),
  (209,'ARAYA CAMPOS','PATRICIO ANDRES','9990846-7','PATRICIO.ARAYA@USACH:CL','','','',2,11,2),
  (210,'ARAYA BASTIAS','DANIELA ANDREA','15339428-8','DANIELA.ARAYA@USACH:CL','','','',2,19,2),
  (211,'ARAYA MARIN','HERNAN EMILIO','7433438-5','HERNAN.ARAYA@USACH:CL','','','',2,32,2),
  (212,'ARELLANO CATALAN','VICTOR HUGO','6346530-5','VICTOR.ARELLANO@USACH:CL','','','',2,19,2),
  (213,'ARELLANO RETAMAL','HECTOR ULISES ENRIQUE','12589127-6','HECTOR.ARELLANO@USACH:CL','','','',2,11,2),
  (214,'ARENAS MACHUCA','BLANCA FILOMENA','9041851-3','BLANCA.ARENAS@USACH:CL','','','',2,15,2),
  (215,'ARENAS AMPUERO','CLAUDIA ANABELA','12667522-4','CLAUDIA.ARENAS@USACH:CL','','','',2,22,2),
  (216,'ARENAS SUAZO','MICHEL GIOVANNI','10321770-9','MICHEL.ARENAS@USACH:CL','','','',2,25,2),
  (217,'ARENAS AHUMADA','REYNALDO','4524195-5','REYNALDO.ARENAS@USACH:CL','','','',2,25,2),
  (218,'ARESTIZABAL LOPEZ','EDWIN GERMAN','7622956-2','EDWIN.ARESTIZABAL@USACH:CL','','','',2,25,2),
  (219,'ARETIO AGUIRREBENA','MARIA CECILIA','6818573-4','MARIA.ARETIO@USACH:CL','','','',2,30,2),
  (220,'AREVALO VILCHES','MARIA TERESA DE LA LUZ','7207618-4','MARIA.AREVALO@USACH:CL','','','',2,11,2),
  (221,'ARGANDONA GUERRA','GUILLERMO','5026975-2','GUILLERMO.ARGANDONA@USACH:CL','','','',2,36,2),
  (222,'ARIAS TAMAYO','SUSANA MARIELA','12645113-K','SUSANA.ARIAS@USACH:CL','','','',2,31,2),
  (223,'ARIAS YURISCH','KARINA ALEJANDRA','15379823-0','KARINA.ARIAS@USACH:CL','','','',2,23,2),
  (224,'ARIAS ALBORNOZ','MIGUEL ALADINO','5992121-5','MIGUEL.ARIAS@USACH:CL','','','',2,10,2),
  (225,'ARIAS VARGAS','PATRICIO ALEIDE SOTERO DE','6338051-2','PATRICIO.ARIAS@USACH:CL','','','',2,14,2),
  (226,'ARIAS GARCIA','ISMAEL ARMANDO','6369379-0','ISMAEL.ARIAS@USACH:CL','','','',2,12,2),
  (227,'ARMIJO VIDELA','RICARDO ANTONIO','7762039-7','RICARDO.ARMIJO@USACH:CL','','','',2,11,2),
  (228,'ARRIAGADA REYES','MAURICIO ENRIQUE','8733183-0','MAURICIO.ARRIAGADA@USACH:CL','','','',2,34,2),
  (229,'ARRIAGADA NECULPAN','VIRGINIA JUANA','12587131-3','VIRGINIA.ARRIAGADA@USACH:CL','','','',2,31,2),
  (230,'ARRIAGADA ALARCON','MARIA ALBINA','5900567-7','MARIA.ARRIAGADA@USACH:CL','','','',2,12,2),
  (231,'ARRIAGADA GONZALEZ','SONIA','10785826-1','SONIA.ARRIAGADA@USACH:CL','','','',2,19,2),
  (232,'ARRIAGADA CONTRERAS','DANIELA KARINA','15742199-9','DANIELA.ARRIAGADA@USACH:CL','','','',2,30,2),
  (233,'ARRIETA SANHUEZA','ALEJANDRO ANTONIO','7690795-1','ALEJANDRO.ARRIETA@USACH:CL','','','',2,34,2),
  (234,'ARRIETA ESCOBAR','ABEL','4941912-0','ABEL.ARRIETA@USACH:CL','','','',2,6,2),
  (235,'ARROQUI LECAROS','INGRID JACQUELINE','7735292-9','INGRID.ARROQUI@USACH:CL','','','',2,6,2),
  (236,'ARROYO ARROYO','CLAUDIO GABRIEL','13681049-9','CLAUDIO.ARROYO@USACH:CL','','','',2,11,2),
  (237,'ARRUE ZAPATA','MABEL ANGELICA','9147842-0','MABEL.ARRUE@USACH:CL','','','',2,11,2),
  (238,'ARTAZA BARRIOS','PABLO IGNACIO','11472029-1','PABLO.ARTAZA@USACH:CL','','','',2,32,2),
  (239,'ASCENCIO CASTILLO','JOSE ALFREDO','5031234-8','JOSE.ASCENCIO@USACH:CL','','','',2,33,2),
  (240,'ASPEE LAMAS','ALEXIS','8352014-0','ALEXIS.ASPEE@USACH:CL','','','',2,7,2),
  (241,'ASTUDILLO GONZALEZ','MARIA ESTELA','7071905-3','MARIA.ASTUDILLO@USACH:CL','','','',2,35,2),
  (242,'ASTUDILLO CARMI','PAOLA ANDREA','15563495-2','PAOLA.ASTUDILLO@USACH:CL','','','',2,25,2),
  (243,'ATERO MONTES','LUIS ROGERS','6634890-3','LUIS.ATERO@USACH:CL','','','',2,12,2),
  (244,'ATRIA LEMAITRE','MAXIMIANO JOSE','12644389-7','MAXIMIANO.ATRIA@USACH:CL','','','',2,17,2),
  (245,'AUSPONT BERDIE','MARIA MONICA','4848122-1','MARIA.AUSPONT@USACH:CL','','','',2,18,2),
  (246,'AVAGLIANO GAETA','ALESSANDRO RAMON','8828557-3','ALESSANDRO.AVAGLIANO@USACH:CL','','','',2,13,2),
  (247,'AVARIA ALVARADO','MARCO ANTONIO','7365075-5','MARCO.AVARIA@USACH:CL','','','',2,36,2),
  (248,'AVENDANO BERTOGLIO','CRISTIAN','12722556-7','CRISTIAN.AVENDANO@USACH:CL','','','',2,34,2),
  (249,'AVENDANO MORALES','FRANCISCO JAVIER','10666332-7','FRANCISCO.AVENDANO@USACH:CL','','','',2,25,2),
  (250,'AVILA URIBE','SONIA','7775100-9','SONIA.AVILA@USACH:CL','','','',2,31,2),
  (251,'AVILA URIBE','INES','7775097-5','INES.AVILA@USACH:CL','','','',2,31,2),
  (252,'AVILA CHAMPIN','LEONARDO ESTEBAN','7578285-3','LEONARDO.AVILA@USACH:CL','','','',2,10,2),
  (253,'AVILES VIDAL','ENRIQUE FRANCISCO','6362275-3','ENRIQUE.AVILES@USACH:CL','','','',2,34,2),
  (254,'AYAL LASAGNA','HUGO ATILIO','5128280-9','HUGO.AYAL@USACH:CL','','','',2,7,2),
  (255,'AYALA ERAZO','DENISSE ALEJANDRA','13758566-9','DENISSE.AYALA@USACH:CL','','','',2,25,2),
  (256,'AYALA ESPINOZA','PATRICIO EDUARDO','7621214-7','PATRICIO.AYALA@USACH:CL','','','',2,23,2),
  (257,'AYARES ZUZULICH','CAROLINA ELENA','5310800-8','CAROLINA.AYARES@USACH:CL','','','',2,27,2),
  (258,'AZOCAR GUZMAN','MANUEL IGNACIO','12869817-5','MANUEL.AZOCAR@USACH:CL','','','',2,8,2),
  (259,'BAEZA FUENTES','MARGARITA DEL ROSARIO','7049234-2','MARGARITA.BAEZA@USACH:CL','','','',2,26,2),
  (260,'BAEZA ALIAGA','CAROLL TATIANA','8676956-5','CAROLL.BAEZA@USACH:CL','','','',2,31,2),
  (261,'BAHAMONDES PINA','OSCAR JOAQUIN','5201499-9','OSCAR.BAHAMONDES@USACH:CL','','','',2,18,2),
  (262,'BAHAMONDES ALFARO','ROBERTO OSVALDO','8235775-0','ROBERTO.BAHAMONDES@USACH:CL','','','',2,5,2),
  (263,'BAHAMONDES CERDA','CLAUDIA HORTENCIA','14593661-6','CLAUDIA.BAHAMONDES@USACH:CL','','','',2,19,2),
  (264,'BALBIANO SEPULVEDA','MARIA ANGELICA','7840157-5','MARIA.BALBIANO@USACH:CL','','','',2,27,2),
  (265,'BALBOA CARDEMIL','ORLANDO IVAN','9358132-6','ORLANDO.BALBOA@USACH:CL','','','',2,22,2),
  (266,'BALOCCHI CARRENO','EMILIO JUAN','5201385-2','EMILIO.BALOCCHI@USACH:CL','','','',2,8,2),
  (267,'BALOCCHI CARRENO','CARLOS ENRIQUE','6348403-2','CARLOS.BALOCCHI@USACH:CL','','','',2,18,2),
  (268,'BARAHONA FUENTES','MARIA EUGENIA','6024968-7','MARIA.BARAHONA@USACH:CL','','','',2,27,2),
  (269,'BARAHONA RAMIREZ','ROMUALDO ANTONIO','7985809-9','ROMUALDO.BARAHONA@USACH:CL','','','',2,22,2),
  (270,'BARBE FARRE','JOAQUIM','14690261-8','JOAQUIM.BARBE@USACH:CL','','','',2,19,2),
  (271,'BARHAM ABU-MUHOR','ESPERANZA','6445602-4','ESPERANZA.BARHAM@USACH:CL','','','',2,25,2),
  (272,'BARKER REYES','ROSA AMELIA DEL CARMEN','5716359-3','ROSA.BARKER@USACH:CL','','','',2,13,2),
  (273,'BARLOW GANDARA','WINSTON ALFRED LEOPOLDO','5289995-8','WINSTON.BARLOW@USACH:CL','','','',2,37,2),
  (274,'BARQUI CAVIEDES','MATILDE ELIANA','8336710-5','MATILDE.BARQUI@USACH:CL','','','',2,11,2),
  (275,'BARRA RIVERA','EDUARDO FERNANDO DEL TRANSITO','3764816-7','EDUARDO.BARRA@USACH:CL','','','',2,34,2),
  (276,'BARRA ALMAGIA','ENZO ENRIQUE','4313378-0','ENZO.BARRA@USACH:CL','','','',2,23,2),
  (277,'BARRA MARCIEL','FROILAN MARIO','6698921-6','FROILAN.BARRA@USACH:CL','','','',2,14,2),
  (278,'BARRA MANRIQUEZ','LIDIA MELANIA','6567749-0','LIDIA.BARRA@USACH:CL','','','',2,5,2),
  (279,'BARRAZA CONTRERAS','JENNIFER PAMELA','13258384-6','JENNIFER.BARRAZA@USACH:CL','','','',2,21,2),
  (280,'BARRERA CAPOT','ROSA ANGELICA','10268449-4','ROSA.BARRERA@USACH:CL','','','',2,19,2),
  (281,'BARRERA BARRERA','GABRIEL EDMUNDO','6820165-9','GABRIEL.BARRERA@USACH:CL','','','',2,11,2),
  (282,'BARRERA FUENTEALBA','ADOLFO ALEJANDRO','13671373-6','ADOLFO.BARRERA@USACH:CL','','','',2,36,2),
  (283,'BARRIA LEIVA','JOSE CLAUDIO','9609185-0','JOSE.BARRIA@USACH:CL','','','',2,10,2),
  (284,'BARRIA RAMIREZ','RODOLFO EDUARDO','6866273-7','RODOLFO.BARRIA@USACH:CL','','','',2,19,2),
  (285,'BARRIENTOS PACHECO','MACARENA DEL CARMEN','13900669-0','MACARENA.BARRIENTOS@USACH:CL','','','',2,17,2),
  (286,'BARRIENTOS URIBE','NELSON EDMUNDO','5023894-6','NELSON.BARRIENTOS@USACH:CL','','','',2,25,2),
  (287,'BARRIENTOS OLAVARRIA','ALBERTO GASTON','6629093-K','ALBERTO.BARRIENTOS@USACH:CL','','','',2,22,2),
  (288,'BARRIENTOS CARVACHO','HERNA REGINA','13199797-3','HERNA.BARRIENTOS@USACH:CL','','','',2,8,2),
  (289,'BARRIGA JARA','JUAN JOSE','13717956-3','JUAN.BARRIGA@USACH:CL','','','',2,36,2),
  (290,'BARRUETO CESPEDES','LUIS ALBERTO','5719275-5','LUIS.BARRUETO@USACH:CL','','','',2,25,2),
  (291,'BASCUR CERDA','JUAN CARLOS','8962368-5','JUAN.BASCUR@USACH:CL','','','',2,19,2),
  (292,'BASCUR PARADA','JOSE ENRIQUE','7628399-0','JOSE.BASCUR@USACH:CL','','','',2,10,2),
  (293,'BASOALTO CAMANO','ROSA ESTER','8605230-K','ROSA.BASOALTO@USACH:CL','','','',2,17,2),
  (294,'BASSO GALLO','MARIO ALBERTO','4487228-5','MARIO.BASSO@USACH:CL','','','',2,11,2),
  (295,'BASSO GONZALEZ','PABLO ANDRES','13052249-1','PABLO.BASSO@USACH:CL','','','',2,10,2),
  (296,'BASSO MUNOZ','RINALDO','7438835-3','RINALDO.BASSO@USACH:CL','','','',2,25,2),
  (297,'BECKER CARES','CRISTHIAN MARCELO','13470867-0','CRISTHIAN.BECKER@USACH:CL','','','',2,10,2),
  (298,'BELLIDO DE LUNA DEL ROSARIO','JOSE ANTONIO','14561656-5','JOSE.BELLIDO@USACH:CL','','','',2,34,2),
  (299,'BELLO CARMONA','JOSE','3909637-4','JOSE.BELLO@USACH:CL','','','',2,13,2),
  (300,'BELLO ROJAS','DANIELA','8005322-3','DANIELA.BELLO@USACH:CL','','','',2,32,2),
  (301,'BELTRAN BUENDIA','CARLOS JOSE','5697162-9','CARLOS.BELTRAN@USACH:CL','','','',2,25,2),
  (302,'BELTRAN RIVERA','CLAUDIO ALEJANDRO','11473372-5','CLAUDIO.BELTRAN@USACH:CL','','','',2,19,2),
  (303,'BELTRAN MEJIA','JARNISHS','22724038-5','JARNISHS.BELTRAN@USACH:CL','','','',2,19,2),
  (304,'BENAVENTE KENNEDY','GUSTAVO ENRIQUE MARIO','5717274-6','GUSTAVO.BENAVENTE@USACH:CL','','','',2,19,2),
  (305,'BENAVIDES VALENZUELA','RICARDO RAUL','8109698-8','RICARDO.BENAVIDES@USACH:CL','','','',2,5,2),
  (306,'BERRIOS FARIAS','NOEMI DEL CARMEN','13034051-2','NOEMI.BERRIOS@USACH:CL','','','',2,29,2),
  (307,'BERTRAND HERMOSILLA','ANTONIO EDGARDO','7042370-7','ANTONIO.BERTRAND@USACH:CL','','','',2,22,2),
  (308,'BETANCOURT GUTIERREZ','VICTOR HUGO','8032797-8','VICTOR.BETANCOURT@USACH:CL','','','',2,11,2),
  (309,'BETANCOURT ORELLANA','CESAR AUGUSTO','6839761-8','CESAR.BETANCOURT@USACH:CL','','','',2,29,2),
  (310,'BETANCOURT CHOU','CINZIA','9143932-8','CINZIA.BETANCOURT@USACH:CL','','','',2,36,2),
  (311,'BEYZAGA MEDEL','CARLOS','8678635-4','CARLOS.BEYZAGA@USACH:CL','','','',2,19,2),
  (312,'BEYZAGA ESPINOSA','CARLOS VICTOR','13932985-6','CARLOS.BEYZAGA@USACH:CL','','','',2,10,2),
  (313,'BIANCHI PARRAGUEZ','ROSSER MACARENA','6086523-K','ROSSER.BIANCHI@USACH:CL','','','',2,32,2),
  (314,'BLANCO PAREDES','RUBEN FRANCISCO','4204408-3','RUBEN.BLANCO@USACH:CL','','','',2,10,2),
  (315,'BLANCO NUNEZ','GONZALO ANDRES','11759666-4','GONZALO.BLANCO@USACH:CL','','','',2,30,2),
  (316,'BLANCO GOMEZ','IRANIA JULIA','14539330-2','IRANIA.BLANCO@USACH:CL','','','',2,25,2),
  (317,'BLEST CASTILLO','ROLANDO ADRIAN','4465614-0','ROLANDO.BLEST@USACH:CL','','','',2,18,2),
  (318,'BOBADILLA ABARCA','GLADYS PATRICIA','5989656-3','GLADYS.BOBADILLA@USACH:CL','','','',2,19,2),
  (319,'BOBADILLA BRUNEAU','FRANCISCO ROBERTO','11382183-3','FRANCISCO.BOBADILLA@USACH:CL','','','',2,25,2),
  (320,'BOLBARAN AGUILERA','GUILLERMO','9903251-0','GUILLERMO.BOLBARAN@USACH:CL','','','',2,34,2),
  (321,'BOLDRINI LOPEZ','PABLO IGNACIO','9344449-3','PABLO.BOLDRINI@USACH:CL','','','',2,25,2),
  (322,'BOLIVAR ONATE','VERONICA ISABEL','6690580-2','VERONICA.BOLIVAR@USACH:CL','','','',2,25,2),
  (323,'BORCOSQUE DIAZ','JOSE LUIS','6198189-6','JOSE.BORCOSQUE@USACH:CL','','','',2,35,2),
  (324,'BOSCH PEREZ','PAUL JESUS','14686653-0','PAUL.BOSCH@USACH:CL','','','',2,19,2),
  (325,'BOTTESELLE RODRIGUEZ','RODOLFO LUIS','13235056-6','RODOLFO.BOTTESELLE@USACH:CL','','','',2,33,2),
  (326,'BOUYSSIERES MAC-LEOD','LILIAN RUTH','5180002-8','LILIAN.BOUYSSIERES@USACH:CL','','','',2,7,2),
  (327,'BOZZO DIAZ DE VALDES','MARIA LAURA','13946930-5','MARIA.BOZZO@USACH:CL','','','',2,30,2),
  (328,'BRAVO BARRERA','LORENA DEL CARMEN','11977368-7','LORENA.BRAVO@USACH:CL','','','',2,13,2),
  (329,'BRAVO CHACON','JORGE EDUARDO','6229070-6','JORGE.BRAVO@USACH:CL','','','',2,11,2),
  (330,'BRAVO MENDEZ','BERNARDO LUIS ANTONIO','6779441-9','BERNARDO.BRAVO@USACH:CL','','','',2,10,2),
  (331,'BRAVO PEREZ','LUIS ALBERTO','8314007-0','LUIS.BRAVO@USACH:CL','','','',2,36,2),
  (332,'BRAVO QUEZADA','CARMEN GLORIA','8350428-5','CARMEN.BRAVO@USACH:CL','','','',2,32,2),
  (333,'BRAVO SILVA','MARIA ISABEL MARGARITA','7255261-K','MARIA.BRAVO@USACH:CL','','','',2,38,2),
  (334,'BRAVO ZAMBRANO','DANIELA MYRIAM','9431706-1','DANIELA.BRAVO@USACH:CL','','','',2,11,2),
  (335,'BRAVO CONTRERAS','JORGE ALBERTO','9007576-4','JORGE.BRAVO@USACH:CL','','','',2,21,2),
  (336,'BRAVO VASQUEZ','PAZ LORETO','13923175-9','PAZ.BRAVO@USACH:CL','','','',2,8,2),
  (337,'BRAVO UBILLA','EDUARDO','13234400-0','EDUARDO.BRAVO@USACH:CL','','','',2,6,2),
  (338,'BRAVO-IRATCHET ADASME','HECTOR HERNAN','4738164-9','HECTOR.BRAVO-IRATCHET@USACH:CL','','','',2,19,2),
  (339,'BRICENO RAMIREZ','FRANCISCO JOSE','9220084-1','FRANCISCO.BRICENO@USACH:CL','','','',2,36,2),
  (340,'BRIONES SEPULVEDA','LEONCIO JAVIER','8488132-5','LEONCIO.BRIONES@USACH:CL','','','',2,13,2),
  (341,'BRIONES SANCHEZ','GABRIELA PATRICIA','13045392-9','GABRIELA.BRIONES@USACH:CL','','','',2,27,2),
  (342,'BRITO PAREDES','JULIO ALBERTO','6261424-2','JULIO.BRITO@USACH:CL','','','',2,33,2),
  (343,'BRITO GONZALEZ','LOREDANA DEL CARMEN','13950374-0','LOREDANA.BRITO@USACH:CL','','','',2,37,2),
  (344,'BROCKWAY ADRIAZOLA','MYRIAM NEVENKA','7169736-3','MYRIAM.BROCKWAY@USACH:CL','','','',2,33,2),
  (345,'BRONTE SALAS','EMELINA ESTER','15931229-1','EMELINA.BRONTE@USACH:CL','','','',2,18,2),
  (346,'BRUNA DAY','GUILLERMO GASTON','2499554-2','GUILLERMO.BRUNA@USACH:CL','','','',2,37,2),
  (347,'BUCCIONI PENA','MANUEL EDUARDO','4665521-4','MANUEL.BUCCIONI@USACH:CL','','','',2,19,2),
  (348,'BUCCIONI VADULLI','ROLLY RUBEN ANTONIO','8071646-K','ROLLY.BUCCIONI@USACH:CL','','','',2,19,2),
  (349,'BUGUENO ARAVENA','JULIO ERNESTO','5665320-1','JULIO.BUGUENO@USACH:CL','','','',2,18,2),
  (350,'BURMEISTER VALENZUELA','RODOLFO JAIME','5313255-3','RODOLFO.BURMEISTER@USACH:CL','','','',2,23,2),
  (351,'BURQUEZ CORNEJO','ERIKA BEATRIZ','7694271-4','ERIKA.BURQUEZ@USACH:CL','','','',2,30,2),
  (352,'BUSTAMANTE GONZALEZ','RICHARD NIBALDO','12633329-3','RICHARD.BUSTAMANTE@USACH:CL','','','',2,13,2),
  (353,'BUSTAMANTE HENRIQUEZ','KARINA IVONNE','13452929-6','KARINA.BUSTAMANTE@USACH:CL','','','',2,17,2),
  (354,'BUSTAMANTE MORENO','RENE VICTOR','4771213-0','RENE.BUSTAMANTE@USACH:CL','','','',2,14,2),
  (355,'BUSTAMANTE HOCHFARBER','MARIA ANGELICA','6694128-0','MARIA.BUSTAMANTE@USACH:CL','','','',2,31,2),
  (356,'BUSTAMANTE MUNOZ','OSCAR ALEJANDRO','14375720-K','OSCAR.BUSTAMANTE@USACH:CL','','','',2,37,2),
  (357,'BUSTIMAN VIZCARRA','MIGUEL ANGEL','5716769-6','MIGUEL.BUSTIMAN@USACH:CL','','','',2,37,2),
  (358,'BUSTOS DURAN','DANILO HERNAN','9704382-5','DANILO.BUSTOS@USACH:CL','','','',2,14,2),
  (359,'BUSTOS CASTILLO','OSCAR LIONEL','7366222-2','OSCAR.BUSTOS@USACH:CL','','','',2,14,2),
  (360,'BUSTOS MALDONADO','CRISTIAN IVAN','8042457-4','CRISTIAN.BUSTOS@USACH:CL','','','',2,21,2),
  (361,'BUSTOS MALDONADO','EDUARDO JAIME','8042455-8','EDUARDO.BUSTOS@USACH:CL','','','',2,23,2),
  (362,'BUSTOS CERDA','PABLO ANDRES','11979193-6','PABLO.BUSTOS@USACH:CL','','','',2,14,2),
  (363,'BUSTOS REYES','CARLOS ANTONIO','9154122-K','CARLOS.BUSTOS@USACH:CL','','','',2,32,2),
  (364,'CABALLERO MULLER','JAIME VICTORINO','5787839-8','JAIME.CABALLERO@USACH:CL','','','',2,18,2),
  (365,'CABALLERO INOSTROZA','LEOCADIO ALBERTO','4423472-6','LEOCADIO.CABALLERO@USACH:CL','','','',2,11,2),
  (366,'CABALLERO ALVIAL','LEONARDO ANTONIO','10394546-1','LEONARDO.CABALLERO@USACH:CL','','','',2,18,2),
  (367,'CABANAS SALAZAR','MARIA SOLEDAD','8513950-9','MARIA.CABANAS@USACH:CL','','','',2,19,2),
  (368,'CABELLOS DUENAS','CARLOS CHRISTIAN','7012038-0','CARLOS.CABELLOS@USACH:CL','','','',2,19,2),
  (369,'CABEZA MUNOZ','MARITZA GEMITA','10392259-3','MARITZA.CABEZA@USACH:CL','','','',2,32,2),
  (370,'CABRERA ORREGO','LUISA ISABEL','4830699-3','LUISA.CABRERA@USACH:CL','','','',2,14,2),
  (371,'CABRERA HINOJOSA','DAVID','7427623-7','DAVID.CABRERA@USACH:CL','','','',2,17,2),
  (372,'CABRERA BEIZA','RODRIGO SIGIFREDO','7617112-2','RODRIGO.CABRERA@USACH:CL','','','',2,10,2),
  (373,'CABRERA GONZALEZ','FERNANDO ENRIQUE','9663245-2','FERNANDO.CABRERA@USACH:CL','','','',2,13,2),
  (374,'CABRERA RIVAS','CARLOS ANDRES JOSE','19657616-9','CARLOS.CABRERA@USACH:CL','','','',2,10,2),
  (375,'CACERES CASTRO','CARLOS DESIDERIO','10520822-7','CARLOS.CACERES@USACH:CL','','','',2,25,2),
  (376,'CACERES ALTUNA','JUAN FERMIN','8103808-2','JUAN.CACERES@USACH:CL','','','',2,22,2),
  (377,'CACERES RIQUELME','ARIEL JACOB','13492404-7','ARIEL.CACERES@USACH:CL','','','',2,5,2),
  (378,'CAICEO ESCUDERO','JAIME','5697697-3','JAIME.CAICEO@USACH:CL','','','',2,21,2),
  (379,'CALCAGNO BASTIDAS','JAIME ALBERTO','8736586-7','JAIME.CALCAGNO@USACH:CL','','','',2,11,2),
  (380,'CALDERON ESCALONA','RODRIGO FERNANDO','12016878-9','RODRIGO.CALDERON@USACH:CL','','','',2,17,2),
  (381,'CALDERON ARAYA','RAUL ALEXIS','14347473-9','RAUL.CALDERON@USACH:CL','','','',2,8,2),
  (382,'CALLEJAS PINO','ANDRES MARCELO','9668988-8','ANDRES.CALLEJAS@USACH:CL','','','',2,21,2),
  (383,'CALQUIN DONOSO','CLAUDIA ALEJANDRA','12907231-8','CLAUDIA.CALQUIN@USACH:CL','','','',2,30,2),
  (384,'CALVO FLORES','GONZALO','5024969-7','GONZALO.CALVO@USACH:CL','','','',2,10,2),
  (385,'CALZADILLAS NIECHI','SEBASTIAN ANDRES','15348257-8','SEBASTIAN.CALZADILLAS@USACH:CL','','','',2,19,2),
  (386,'CAMILO CARMONA','SERGIO AGUSTIN','8595629-9','SERGIO.CAMILO@USACH:CL','','','',2,33,2),
  (387,'CAMPANA ZEPEDA','JOSE ENRIQUE','11510817-4','JOSE.CAMPANA@USACH:CL','','','',2,34,2),
  (388,'CAMPOS GUTIERREZ','JAIME FRANCISCO','9798805-6','JAIME.CAMPOS@USACH:CL','','','',2,22,2),
  (389,'CAMPOS QUIROZ','SERGIO ALBERTO','7574630-K','SERGIO.CAMPOS@USACH:CL','','','',2,34,2),
  (390,'CAMPOS SALAZAR','MARISOL DEL CARMEN','10661685-K','MARISOL.CAMPOS@USACH:CL','','','',2,29,2),
  (391,'CAMPOS LABRA','MARTA ROSA','7239711-8','MARTA.CAMPOS@USACH:CL','','','',2,27,2),
  (392,'CAMPOS RIOS','VICTOR MANUEL','2924262-3','VICTOR.CAMPOS@USACH:CL','','','',2,21,2),
  (393,'CAMPOS DERAMOND','ANA MARIA','8250367-6','ANA.CAMPOS@USACH:CL','','','',2,8,2),
  (394,'CAMPOS RIVAS','JOSE PEDRO','7518026-8','JOSE.CAMPOS@USACH:CL','','','',2,17,2),
  (395,'CAMPOS CAMPOS','MARLYS GIANNITZA','12015541-5','MARLYS.CAMPOS@USACH:CL','','','',2,6,2),
  (396,'CAMPOS MUNOZ','LUIS EUGENIO','10206561-1','LUIS.CAMPOS@USACH:CL','','','',2,32,2),
  (397,'CAMPOS YANEZ','LUIS ARMANDO','9764334-2','LUIS.CAMPOS@USACH:CL','','','',2,14,2),
  (398,'CAMUS SALINAS','JUAN RODOLFO','6043208-2','JUAN.CAMUS@USACH:CL','','','',2,36,2),
  (399,'CANALES ARAYA','CAROLINA EUGENIA','16195218-4','CAROLINA.CANALES@USACH:CL','','','',2,30,2),
  (400,'CANAS VICEDO','MITCHEL ENRIQUE','12603965-4','MITCHEL.CANAS@USACH:CL','','','',2,34,2),
  (401,'CANCINO HORMAZABAL','JOSE ROBERTO','5907297-8','JOSE.CANCINO@USACH:CL','','','',2,13,2),
  (402,'CANDIA ALIAGA','MONICA DEL PILAR','5546422-7','MONICA.CANDIA@USACH:CL','','','',2,27,2),
  (403,'CANIULEF MENDEZ','INGRID SUSABET','14381670-2','INGRID.CANIULEF@USACH:CL','','','',2,32,2),
  (404,'CANTILLANO VERGARA','MARIA EUGENIA','7367946-K','MARIA.CANTILLANO@USACH:CL','','','',2,18,2),
  (405,'CANTUARIAS LARRONDO','PAMELA VICTORIA','6026706-5','PAMELA.CANTUARIAS@USACH:CL','','','',2,29,2),
  (406,'CARACCI MARABOLI','IGOR NOLBERTO','6976563-7','IGOR.CARACCI@USACH:CL','','','',2,19,2),
  (407,'CARDEMIL URZUA','EMILIO VICENTE','4815377-1','EMILIO.CARDEMIL@USACH:CL','','','',2,7,2),
  (408,'CARDENAS JIRON','GLORIA INES AURORA','8970114-7','GLORIA.CARDENAS@USACH:CL','','','',2,7,2),
  (409,'CARDENAS ALCAINO','FABIOLA DEL PILAR','8776485-0','FABIOLA.CARDENAS@USACH:CL','','','',2,5,2),
  (410,'CARIMAN LINARES','BRAULIO ERNESTO','12492928-8','BRAULIO.CARIMAN@USACH:CL','','','',2,23,2),
  (411,'CARMONA OLIVOS','VERONICA DEL CARMEN','15606081-K','VERONICA.CARMONA@USACH:CL','','','',2,27,2),
  (412,'CARMONA COLLAO','MARIO ABELARDO','5325519-1','MARIO.CARMONA@USACH:CL','','','',2,13,2),
  (413,'CARMONA JIMENEZ','JAVIERA ANTONIA','12265631-4','JAVIERA.CARMONA@USACH:CL','','','',2,29,2),
  (414,'CARMONA GARCIA','CECILE RAYEN','21870313-5','CECILE.CARMONA@USACH:CL','','','',2,32,2),
  (415,'CARO HERNANDEZ','LUIS IGNACIO','4600962-2','LUIS.CARO@USACH:CL','','','',2,35,2),
  (416,'CARO VELOZ','HUGO ENRIQUE','6870065-5','HUGO.CARO@USACH:CL','','','',2,10,2),
  (417,'CAROLI REZENDE','MARCOS','7250619-7','MARCOS.CAROLI@USACH:CL','','','',2,7,2),
  (418,'CARRACEDO CONTADOR','MANUEL','5996115-2','MANUEL.CARRACEDO@USACH:CL','','','',2,34,2),
  (419,'CARRANZA VENGOA','CLAUDIO','3744594-0','CLAUDIO.CARRANZA@USACH:CL','','','',2,25,2),
  (420,'CARRASCO PALMA','MARTA DEL PILAR','13072507-4','MARTA.CARRASCO@USACH:CL','','','',2,22,2),
  (421,'CARRASCO CARRASCO','MARIA PATRICIA DEL CARMEN','5714859-4','MARIA.CARRASCO@USACH:CL','','','',2,10,2),
  (422,'CARRASCO RAMOS','NELSON JUVENAL ROLANDO','5710720-0','NELSON.CARRASCO@USACH:CL','','','',2,8,2),
  (423,'CARRASCO PUENTES','BERNARDO VICTOR','5836266-2','BERNARDO.CARRASCO@USACH:CL','','','',2,18,2),
  (424,'CARRASCO TRINCADO','SUSANA PAOLA','7207845-4','SUSANA.CARRASCO@USACH:CL','','','',2,25,2),
  (425,'CARRASCO PLAZA','AMADO HERNAN','8518982-4','AMADO.CARRASCO@USACH:CL','','','',2,13,2),
  (426,'CARRASCO MOSCOSO','DARIO GUILLERMO','6887174-3','DARIO.CARRASCO@USACH:CL','','','',2,19,2),
  (427,'CARRASCO MONSALVES','DENIK MARSEL','13608615-4','DENIK.CARRASCO@USACH:CL','','','',2,29,2),
  (428,'CARRASCO HENRIQUEZ','ALFREDO RAFAEL','13052056-1','ALFREDO.CARRASCO@USACH:CL','','','',2,19,2),
  (429,'CARRAZANA MORALES','LINFORD LYONEL','3202475-0','LINFORD.CARRAZANA@USACH:CL','','','',2,19,2),
  (430,'CARRENO GAJARDO','HECTOR MARIO','7203707-3','HECTOR.CARRENO@USACH:CL','','','',2,19,2),
  (431,'CARRERA GAMONAL','HILDA DEL CARMEN','9435122-7','HILDA.CARRERA@USACH:CL','','','',2,37,2),
  (432,'CARRIL TORRES','HERMOGENES','6182724-2','HERMOGENES.CARRIL@USACH:CL','','','',2,29,2),
  (433,'CARRILLANCA CARRILLANCA','ELEODORO SEGUNDO','5226987-3','ELEODORO.CARRILLANCA@USACH:CL','','','',2,15,2),
  (434,'CARRILLO ANDRADES','LUCIA EUGENIA','6208452-9','LUCIA.CARRILLO@USACH:CL','','','',2,23,2),
  (435,'CARRILLO RODRIGUEZ','MANUEL','5342514-3','MANUEL.CARRILLO@USACH:CL','','','',2,19,2),
  (436,'CARRILLO REYNOSO','MIREYA ISABEL','12873193-8','MIREYA.CARRILLO@USACH:CL','','','',2,30,2),
  (437,'CARSTENS ULLOA','EDUARDO','7510634-3','EDUARDO.CARSTENS@USACH:CL','','','',2,25,2),
  (438,'CARTES ZURITA','OSCAR ADEMIR','9890924-9','OSCAR.CARTES@USACH:CL','','','',2,35,2),
  (439,'CARVAJAL ORTEGA','LINTON PATRICIO','8890224-6','LINTON.CARVAJAL@USACH:CL','','','',2,14,2),
  (440,'CARVAJAL PEREZ','SILVIA DEL CARMEN','8138093-7','SILVIA.CARVAJAL@USACH:CL','','','',2,22,2),
  (441,'CARVAJAL SCHIAFFINO','RUBEN JAIME','8003325-7','RUBEN.CARVAJAL@USACH:CL','','','',2,19,2),
  (442,'CARVAJAL REEVES','CYNTHIA LILIANA','5431518-K','CYNTHIA.CARVAJAL@USACH:CL','','','',2,15,2),
  (443,'CARVAJAL BARRIOS','MILTON OLIVERIO','4539388-7','MILTON.CARVAJAL@USACH:CL','','','',2,19,2),
  (444,'CARVAJAL GUERRA','MIGUEL ANGEL','4594815-3','MIGUEL.CARVAJAL@USACH:CL','','','',2,19,2),
  (445,'CARVALLO SUMA DE VILLA','NELSON ALEJANDRO','11944423-3','NELSON.CARVALLO@USACH:CL','','','',2,34,2),
  (446,'CASANOVA VASQUEZ','JESSICA DE LOURDES','12819140-2','JESSICA.CASANOVA@USACH:CL','','','',2,35,2),
  (447,'CASTANEDA GONZALEZ','FRANCISCO ENRIQUE','10605708-7','FRANCISCO.CASTANEDA@USACH:CL','','','',2,29,2),
  (448,'CASTANEDA GONZALEZ','ALVARO PATRICIO','13692443-5','ALVARO.CASTANEDA@USACH:CL','','','',2,19,2),
  (449,'CASTILLO CERDA','MARIA TERESA','9472728-6','MARIA.CASTILLO@USACH:CL','','','',2,6,2),
  (450,'CASTILLO DIAZ','MAGDALENA DEL PILAR','12359929-2','MAGDALENA.CASTILLO@USACH:CL','','','',2,18,2),
  (451,'CASTILLO LOPEZ','ITAMAR SABA','16278541-9','ITAMAR.CASTILLO@USACH:CL','','','',2,26,2),
  (452,'CASTILLO GATICA','CRISTINA DEL CARMEN','5573044-K','CRISTINA.CASTILLO@USACH:CL','','','',2,21,2),
  (453,'CASTILLO FIGUEROA','NORMA CLARA','6586780-K','NORMA.CASTILLO@USACH:CL','','','',2,38,2),
  (454,'CASTILLO VUKOVIC','CLAUDIO ALEJANDRO','11693157-5','CLAUDIO.CASTILLO@USACH:CL','','','',2,25,2),
  (455,'CASTILLO HERRERA','ALBERTO ELIAS','5639063-4','ALBERTO.CASTILLO@USACH:CL','','','',2,25,2),
  (456,'CASTILLO FIGUEROA','SERGIO ALEJANDRO','6735126-6','SERGIO.CASTILLO@USACH:CL','','','',2,22,2),
  (457,'CASTILLO SEPULVEDA','JORGE LEANDRO','13905697-3','JORGE.CASTILLO@USACH:CL','','','',2,30,2),
  (458,'CASTILLO REYNAUD','CARMEN LORETO','4106873-6','CARMEN.CASTILLO@USACH:CL','','','',2,25,2),
  (459,'CASTILLO CORDOBA','CESAR WILLY','7100109-1','CESAR.CASTILLO@USACH:CL','','','',2,25,2),
  (460,'CASTRO RIVERA','MONICA SOLEDAD','9216659-7','MONICA.CASTRO@USACH:CL','','','',2,35,2),
  (461,'CASTRO GUTIERREZ','JULIO ALBERTO','6876684-2','JULIO.CASTRO@USACH:CL','','','',2,19,2),
  (462,'CASTRO HAASE','EMILIA AURISTELA','4492215-0','EMILIA.CASTRO@USACH:CL','','','',2,19,2),
  (463,'CASTRO VEGA','MARIO ANTONIO','5277178-1','MARIO.CASTRO@USACH:CL','','','',2,14,2),
  (464,'CASTRO DA-COSTA','MIRNA LUCY','8004473-9','MIRNA.CASTRO@USACH:CL','','','',2,8,2),
  (465,'CASTRO CORREA','CARMEN PAZ','9093074-5','CARMEN.CASTRO@USACH:CL','','','',2,35,2),
  (466,'CASTRO RETAMAL','PATRICIA ELENA','9577940-9','PATRICIA.CASTRO@USACH:CL','','','',2,19,2),
  (467,'CASTRO GOMEZ','GONZALO SALVADOR','15775487-4','GONZALO.CASTRO@USACH:CL','','','',2,19,2),
  (468,'CASTRO PONCE','JORGE ENRIQUE','13347533-8','JORGE.CASTRO@USACH:CL','','','',2,6,2),
  (469,'CASTRO MARIN','RODRIGO ALBERTO','22129150-6','RODRIGO.CASTRO@USACH:CL','','','',2,19,2),
  (470,'CATALAN VELASQUEZ','ROBERTO JOEL','5063209-1','ROBERTO.CATALAN@USACH:CL','','','',2,13,2),
  (471,'CATALAN MOYA','OSCAR ENRIQUE','4978523-2','OSCAR.CATALAN@USACH:CL','','','',2,19,2),
  (472,'CAVERLOTTI SILVA','MARCELO ALBERTO','9917651-2','MARCELO.CAVERLOTTI@USACH:CL','','','',2,35,2),
  (473,'CAVERO JARAMILLO','RENE','4662902-7','RENE.CAVERO@USACH:CL','','','',2,25,2),
  (474,'CAVIERES ROJAS','PATRICIO HERNAN','6824949-K','PATRICIO.CAVIERES@USACH:CL','','','',2,33,2),
  (475,'CAZANGA SOLAR','MARCIA MELIDA MARIANA','6863905-0','MARCIA.CAZANGA@USACH:CL','','','',2,8,2),
  (476,'CAZENAVE PONTANILLA','JAIME EDUARDO','6022980-5','JAIME.CAZENAVE@USACH:CL','','','',2,19,2),
  (477,'CAZENAVE GUIER','IRENE JENNIFER','6866445-4','IRENE.CAZENAVE@USACH:CL','','','',2,27,2),
  (478,'CEA MUENA','MARIA PAMELA','11524154-0','MARIA.CEA@USACH:CL','','','',2,37,2),
  (479,'CEA RAMIREZ','ALDO ALEXIS','12016647-6','ALDO.CEA@USACH:CL','','','',2,11,2),
  (480,'CEBALLOS PIZARRO','ENRIQUE CECILIO','5865519-8','ENRIQUE.CEBALLOS@USACH:CL','','','',2,19,2),
  (481,'CEBALLOS RIVERA','ALBERTO ANDRES','13671126-1','ALBERTO.CEBALLOS@USACH:CL','','','',2,12,2),
  (482,'CELIS SILVA','LUIS GUSTAVO','7815830-1','LUIS.CELIS@USACH:CL','','','',2,34,2),
  (483,'CELIS SILVA','LUIS ALBERTO','7815697-K','LUIS.CELIS@USACH:CL','','','',2,8,2),
  (484,'CELIS ATENAS','KAREM MITCHEL','14148126-6','KAREM.CELIS@USACH:CL','','','',2,30,2),
  (485,'CERDA MOLINA','LUISA GREGORIA','8968485-4','LUISA.CERDA@USACH:CL','','','',2,13,2),
  (486,'CERDA MORALES','ARTURO FERNANDO','4103681-8','ARTURO.CERDA@USACH:CL','','','',2,21,2),
  (487,'CERDA ALBARRACIN','VICTOR FRANKLIN','5028394-1','VICTOR.CERDA@USACH:CL','','','',2,11,2),
  (488,'CERDA RIQUELME','VICTOR MANUEL','6417542-4','VICTOR.CERDA@USACH:CL','','','',2,5,2),
  (489,'CERDA LOYOLA','PATRICIO HUMBERTO','15648911-5','PATRICIO.CERDA@USACH:CL','','','',2,19,2),
  (490,'CERECEDA ROMO','JUAN ABELARDO','2899641-1','JUAN.CERECEDA@USACH:CL','','','',2,19,2),
  (491,'CERECEDA MARCOS','ANGELA NEVENKA','7773360-4','ANGELA.CERECEDA@USACH:CL','','','',2,31,2),
  (492,'CERON FRANCO','RAUL PATRICIO','5471146-8','RAUL.CERON@USACH:CL','','','',2,8,2),
  (493,'CERON CANALES','VICTOR GREGORIO','6778942-3','VICTOR.CERON@USACH:CL','','','',2,35,2),
  (494,'CERVA CORTES','JOSE LUIS','7824924-2','JOSE.CERVA@USACH:CL','','','',2,25,2),
  (495,'CESPEDES FAUNDEZ','FRANCISCA ALEJANDRA','13655493-K','FRANCISCA.CESPEDES@USACH:CL','','','',2,17,2),
  (496,'CESPEDES PINCHEIRA','VERONICA ALEJANDRA','10332523-4','VERONICA.CESPEDES@USACH:CL','','','',2,6,2),
  (497,'CHACALTANA PIZARRO','ANA MARIA','5543735-1','ANA.CHACALTANA@USACH:CL','','','',2,23,2),
  (498,'CHACON PAREDES','HUMBERTO IDONICIO','4461781-1','HUMBERTO.CHACON@USACH:CL','','','',2,19,2),
  (499,'CHACON POZO','GUILLERMO','3558110-3','GUILLERMO.CHACON@USACH:CL','','','',2,11,2),
  (500,'CHAMORRO AVILA','MARIA SOLEDAD MIREYA','8253944-1','MARIA.CHAMORRO@USACH:CL','','','',2,26,2),
  (501,'CHAMORRO POLANCO','JOSE MIGUEL','5192666-8','JOSE.CHAMORRO@USACH:CL','','','',2,13,2),
  (502,'CHAMORRO AHUMADA','MARIA CAROLINA','13832844-9','MARIA.CHAMORRO@USACH:CL','','','',2,12,2),
  (503,'CHANDIA PARRA','NANCY PAOLA','12697278-4','NANCY.CHANDIA@USACH:CL','','','',2,7,2),
  (504,'CHAPSAL ESCUDERO','MAURICIO','8704210-3','MAURICIO.CHAPSAL@USACH:CL','','','',2,40,2),
  (505,'CHARLIN FERNANDEZ','RAUL FELIPE','13198632-7','RAUL.CHARLIN@USACH:CL','','','',2,25,2);
COMMIT;

/* Data for the `investigador` table  (LIMIT 500,500) */

INSERT INTO `investigador` (`idInvestigador`, `apellidos`, `nombres`, `numeroIdentificacion`, `email`, `telefonoFijo`, `telefonoMovil`, `direccion`, `idPerfilInvestigador`, `departamento_id`, `institucion_id`) VALUES
  (506,'CHAVEZ ROSALES','RENATO ANTONIO','12235076-2','RENATO.CHAVEZ@USACH:CL','','','',2,6,2),
  (507,'CHAVEZ OROSTICA','HECTOR PATRICIO','14163424-0','HECTOR.CHAVEZ@USACH:CL','','','',2,10,2),
  (508,'CHAVEZ CHAVEZ','REBECA INES','4929409-3','REBECA.CHAVEZ@USACH:CL','','','',2,31,2),
  (509,'CHEN CARRILLO','YO-YING ADRIANA','10078380-0','YO-YING.CHEN@USACH:CL','','','',2,6,2),
  (510,'CHEUQUEPAN VALENZUELA','WILLIAM','15374854-3','WILLIAM.CHEUQUEPAN@USACH:CL','','','',2,8,2),
  (511,'CHONG MORENO','ALI-SHAN CAROLINA','10678119-2','ALI-SHAN.CHONG@USACH:CL','','','',2,25,2),
  (512,'CHOQUE VALDEZ','MERY','22414542-K','MERY.CHOQUE@USACH:CL','','','',2,19,2),
  (513,'CHUREO PICHUANTE','VERONICA SOLANGE','13060918-K','VERONICA.CHUREO@USACH:CL','','','',2,13,2),
  (514,'CID MELO','ERNESTO MAXIMO','5799870-9','ERNESTO.CID@USACH:CL','','','',2,31,2),
  (515,'CID MERINO','CARLOS ALBERTO','7691373-0','CARLOS.CID@USACH:CL','','','',2,11,2),
  (516,'CIFUENTES SANCHEZ','LUIS GUILLERMO','10562301-1','LUIS.CIFUENTES@USACH:CL','','','',2,15,2),
  (517,'CIFUENTES MARTINEZ','JUAN JOSE','5134868-0','JUAN.CIFUENTES@USACH:CL','','','',2,10,2),
  (518,'CIFUENTES ASTETE','ANGELA NATHALIA','15806874-5','ANGELA.CIFUENTES@USACH:CL','','','',2,30,2),
  (519,'CISTERNAS ALVAREZ','JUAN EDGARDO','4505193-5','JUAN.CISTERNAS@USACH:CL','','','',2,29,2),
  (520,'CLAVEL GUTIERREZ','CARLOS RENE','3201659-6','CARLOS.CLAVEL@USACH:CL','','','',2,22,2),
  (521,'CLAVERO PEREZ','MARCO ANTONIO','7402331-2','MARCO.CLAVERO@USACH:CL','','','',2,25,2),
  (522,'CLERC TAPIA','MADELEINE MARIA LUCIA','6816764-7','MADELEINE.CLERC@USACH:CL','','','',2,21,2),
  (523,'COCKBAINE OJEDA','JUAN','7317271-3','JUAN.COCKBAINE@USACH:CL','','','',2,12,2),
  (524,'COLIL BARRA','IRIS DEL CARMEN','7800693-5','IRIS.COLIL@USACH:CL','','','',2,29,2),
  (525,'CONCHA NAVARRO','PAULA ANGELICA','9127940-1','PAULA.CONCHA@USACH:CL','','','',2,36,2),
  (526,'CONCHA MACHUCA','RICARDO ALBERTO','13625405-7','RICARDO.CONCHA@USACH:CL','','','',2,33,2),
  (527,'CONTRERAS ORTIZ','ERIKA FABIOLA','14253186-0','ERIKA.CONTRERAS@USACH:CL','','','',2,25,2),
  (528,'CONTRERAS BOTTO','FERNANDO','5636932-5','FERNANDO.CONTRERAS@USACH:CL','','','',2,12,2),
  (529,'CONTRERAS FUENTES','MARIA LEONOR','5543328-3','MARIA.CONTRERAS@USACH:CL','','','',2,7,2),
  (530,'CONTRERAS VILLACURA','ELSA GLORIA DEL CARMEN','6068101-5','ELSA.CONTRERAS@USACH:CL','','','',2,15,2),
  (531,'CONTRERAS MORENO','EDUARDO HUMBERTO','6195903-3','EDUARDO.CONTRERAS@USACH:CL','','','',2,33,2),
  (532,'CONTRERAS GAJARDO','RIGOBERTO ELEUTERIO','6227975-3','RIGOBERTO.CONTRERAS@USACH:CL','','','',2,33,2),
  (533,'CONTRERAS PEZZANI','HERNAN PEDRO','6614054-7','HERNAN.CONTRERAS@USACH:CL','','','',2,30,2),
  (534,'CONTRERAS GAETE','JOEL','6584419-2','JOEL.CONTRERAS@USACH:CL','','','',2,34,2),
  (535,'CONTRERAS DIAZ','ENRIQUE FERNANDO','5160918-2','ENRIQUE.CONTRERAS@USACH:CL','','','',2,5,2),
  (536,'CONTRERAS PAVEZ','HERNAN RAUL','5892893-3','HERNAN.CONTRERAS@USACH:CL','','','',2,14,2),
  (537,'CONTRERAS ROJAS','LEONEL OMAR','8920129-2','LEONEL.CONTRERAS@USACH:CL','','','',2,14,2),
  (538,'CONTRERAS AVILA','HECTOR PATRICIO','7463178-9','HECTOR.CONTRERAS@USACH:CL','','','',2,35,2),
  (539,'CONTRERAS FIERRO','CARMEN GLORIA','11649572-4','CARMEN.CONTRERAS@USACH:CL','','','',2,35,2),
  (540,'CONTRERAS OPAZO','ARIEL URBANO','9344935-5','ARIEL.CONTRERAS@USACH:CL','','','',2,5,2),
  (541,'CONTRERAS SEPULVEDA','RICARDO DANIEL','9007081-9','RICARDO.CONTRERAS@USACH:CL','','','',2,12,2),
  (542,'CONTRERAS PASTENE','JAVIER ALEJANDRO','19454508-8','JAVIER.CONTRERAS@USACH:CL','','','',2,18,2),
  (543,'CONTRERAS FAUNDEZ','CRISTIAN RODRIGO','15537381-4','CRISTIAN.CONTRERAS@USACH:CL','','','',2,19,2),
  (544,'CONTRERAS RAMIREZ','DANIELA ANDREA','13903999-8','DANIELA.CONTRERAS@USACH:CL','','','',2,30,2),
  (545,'CORDOVA GONZALEZ','FELISA MARGARITA','6831159-4','FELISA.CORDOVA@USACH:CL','','','',2,11,2),
  (546,'CORDOVA ACEVEDO','MARIO ANTONIO','12098215-K','MARIO.CORDOVA@USACH:CL','','','',2,35,2),
  (547,'CORDOVA RUBIO','NATALIA ALEJANDRA','15385133-6','NATALIA.CORDOVA@USACH:CL','','','',2,30,2),
  (548,'CORDOVEZ PEREZ','ALVARO CRISTIAN','8004196-9','ALVARO.CORDOVEZ@USACH:CL','','','',2,25,2),
  (549,'CORNEJO YANEZ','SOFIA ALEJANDRA DEL CARMEN','13702522-1','SOFIA.CORNEJO@USACH:CL','','','',2,7,2),
  (550,'CORNEJO PEREZ','JAIME DE JESUS','5121699-7','JAIME.CORNEJO@USACH:CL','','','',2,8,2),
  (551,'CORNEJO ROMERO','RAUL HUMBERTO','6087727-0','RAUL.CORNEJO@USACH:CL','','','',2,19,2),
  (552,'CORNEJO ESPINOZA','ISIDRO','5815014-2','ISIDRO.CORNEJO@USACH:CL','','','',2,19,2),
  (553,'CORNEJO GONZALEZ','HERNAN EUGENIO','10411476-8','HERNAN.CORNEJO@USACH:CL','','','',2,14,2),
  (554,'CORON PAK','MICHEL','10669455-9','MICHEL.CORON@USACH:CL','','','',2,25,2),
  (555,'CORRAL ECHEVERRIA','PEDRO JORGE','4465674-4','PEDRO.CORRAL@USACH:CL','','','',2,13,2),
  (556,'CORREA HENRIQUEZ','HORACIO ALBERTO','3800250-3','HORACIO.CORREA@USACH:CL','','','',2,15,2),
  (557,'CORREA VERA','LORETO EDITH','8538203-9','LORETO.CORREA@USACH:CL','','','',2,32,2),
  (558,'CORREA SEPULVEDA','ORIALIS PATRICIA','10737896-0','ORIALIS.CORREA@USACH:CL','','','',2,36,2),
  (559,'CORTES HURTADO','RICARDO ANDRES','7989639-K','RICARDO.CORTES@USACH:CL','','','',2,33,2),
  (560,'CORTES HURTADO','SERGIO RAMON','6590068-8','SERGIO.CORTES@USACH:CL','','','',2,15,2),
  (561,'CORTES CAMPOS','AURELIO DANILO','4488523-9','AURELIO.CORTES@USACH:CL','','','',2,36,2),
  (562,'CORTES IRIARTE','GERMAN HERNAN','5327335-1','GERMAN.CORTES@USACH:CL','','','',2,10,2),
  (563,'CORTES ARAYA','LUIS ERNESTO','8509851-9','LUIS.CORTES@USACH:CL','','','',2,13,2),
  (564,'CORTES MOMBERG','JULIAN ERNESTO','7240323-1','JULIAN.CORTES@USACH:CL','','','',2,19,2),
  (565,'CORTES ALTI','JAVIER VALENTIN','10528042-4','JAVIER.CORTES@USACH:CL','','','',2,30,2),
  (566,'CORTES HINOJOSA','PEDRO ANDRES','14044279-8','PEDRO.CORTES@USACH:CL','','','',2,25,2),
  (567,'CORTEZ MUNOZ','MARIA ISABEL','9148001-8','MARIA.CORTEZ@USACH:CL','','','',2,19,2),
  (568,'CORTEZ VALLADARES','ROBERTO GERARDO','5668199-K','ROBERTO.CORTEZ@USACH:CL','','','',2,36,2),
  (569,'CORTEZ CORTEZ-MONROY','HERNAN ALFREDO','9688465-6','HERNAN.CORTEZ@USACH:CL','','','',2,40,2),
  (570,'CORTEZ OSORIO','JUAN MANUEL','13688424-7','JUAN.CORTEZ@USACH:CL','','','',2,36,2),
  (571,'CORVALAN QUIROZ','FERNANDO','4844404-0','FERNANDO.CORVALAN@USACH:CL','','','',2,35,2),
  (572,'CORVALAN MARQUEZ','LUIS ABRAHAM','5811272-0','LUIS.CORVALAN@USACH:CL','','','',2,32,2),
  (573,'CORVALAN FIERRO','FRANCISCA JAVIERA','13257906-7','FRANCISCA.CORVALAN@USACH:CL','','','',2,17,2),
  (574,'COSTAMAGNA MARTRA','JUAN ALBERTO','6246672-3','JUAN.COSTAMAGNA@USACH:CL','','','',2,8,2),
  (575,'COSTOYA ARRIGONI','ALBERTO LUIS','3983606-8','ALBERTO.COSTOYA@USACH:CL','','','',2,25,2),
  (576,'COULON LOPEZ','LUIS ALBERTO','6147873-6','LUIS.COULON@USACH:CL','','','',2,10,2),
  (577,'COVARRUBIAS PIZARRO','GLORIA YASMIN','12686556-2','GLORIA.COVARRUBIAS@USACH:CL','','','',2,15,2),
  (578,'CROXATTO AVONI','HORACIO BRUNO','3430177-8','HORACIO.CROXATTO@USACH:CL','','','',2,6,2),
  (579,'CRUCHAGA SSA.','MARCELA ANDREA','14650811-1','MARCELA.CRUCHAGA@USACH:CL','','','',2,13,2),
  (580,'CRUZ NEIRA','GUSTAVO ADOLFO','13465255-1','GUSTAVO.CRUZ@USACH:CL','','','',2,18,2),
  (581,'CRUZ DIAZ','EUGENIO PATRICIO','7363426-1','EUGENIO.CRUZ@USACH:CL','','','',2,40,2),
  (582,'CRUZ SALVADOR','LUIS HERNAN','10569868-2','LUIS.CRUZ@USACH:CL','','','',2,14,2),
  (583,'CUADRA REBOLLEDO','EDUARDO ARTURO','5314185-4','EDUARDO.CUADRA@USACH:CL','','','',2,19,2),
  (584,'CUBILLOS ARTIGAS','EDUARDO','6686601-7','EDUARDO.CUBILLOS@USACH:CL','','','',2,33,2),
  (585,'CUBILLOS GUZMAN','JUAN MANUEL','12643474-K','JUAN.CUBILLOS@USACH:CL','','','',2,19,2),
  (586,'CUELLAR BERMAL','MARIA CECILIA','6065763-7','MARIA.CUELLAR@USACH:CL','','','',2,25,2),
  (587,'CUELLO CORTES','PATRICIA KIMENA','8152460-2','PATRICIA.CUELLO@USACH:CL','','','',2,19,2),
  (588,'CUEVAS OJEDA','MARITZA PAMELA','10300959-6','MARITZA.CUEVAS@USACH:CL','','','',2,19,2),
  (589,'CUPER DEREZUNSKY','DAVID SAUL','4661263-9','DAVID.CUPER@USACH:CL','','','',2,10,2),
  (590,'CURE OJEDA','MICHEL JORGE DANIEL','5640810-K','MICHEL.CURE@USACH:CL','','','',2,19,2),
  (591,'CURIN RETAMAL','CARLOS PETRONIO','8961602-6','CARLOS.CURIN@USACH:CL','','','',2,18,2),
  (592,'DAUDET PROUST','JOSE HUGO','3896924-2','JOSE.DAUDET@USACH:CL','','','',2,21,2),
  (593,'DE LA BARRA BARRAZA','SERGIO AGUSTIN','7278622-K','SERGIO.DE@USACH:CL','','','',2,25,2),
  (594,'DE LA CUADRA CASTILLO','PABLO FRANCISCO','10056371-1','PABLO.DE@USACH:CL','','','',2,36,2),
  (595,'DE LA CUADRA ARANDA','HUMBERTO ENRIQUE','3983298-4','HUMBERTO.DE@USACH:CL','','','',2,25,2),
  (596,'DE LA SOTTA CERBINO','MIGUEL ANGEL','5637449-3','MIGUEL.DE@USACH:CL','','','',2,10,2),
  (597,'DE LA VEGA ORELLANA','RAUL ANTONIO','5089811-3','RAUL.DE@USACH:CL','','','',2,11,2),
  (598,'DE LA VEGA EGUILUZ','DARIO ARTURO','8054439-1','DARIO.DE@USACH:CL','','','',2,36,2),
  (599,'DE LAS POZAS DEL RIO','CARLOS ENRIQUE','22082652-K','CARLOS.DE@USACH:CL','','','',2,19,2),
  (600,'DE SOLMINIHAC ITURRIA','JAIME EDUARDO FELIX BERNARDINO','3554495-K','JAIME.DE@USACH:CL','','','',2,21,2),
  (601,'DEL PINO SALINAS','CLAUDIO GABRIEL MANUEL','4043341-4','CLAUDIO.DEL@USACH:CL','','','',2,19,2),
  (602,'DEL SOLAR SALCEDO','JAVIERA CONSTANZA','14208640-9','JAVIERA.DEL@USACH:CL','','','',2,30,2),
  (603,'DEL VALLE CONTRERAS','SERGIA DANIELA','12660235-9','SERGIA.DEL@USACH:CL','','','',2,6,2),
  (604,'DEL VALLE JELDRES','JULIO CESAR','6221603-4','JULIO.DEL@USACH:CL','','','',2,10,2),
  (605,'DEMARCO GREZ','BLANCA PAULINA','6979230-8','BLANCA.DEMARCO@USACH:CL','','','',2,11,2),
  (606,'DEMETRIO PENA','IGOR IVAN','7081854-K','IGOR.DEMETRIO@USACH:CL','','','',2,5,2),
  (607,'DERPICH CONTRERAS','IVAN SERGIO','7200864-2','IVAN.DERPICH@USACH:CL','','','',2,11,2),
  (608,'DEVIA SAAVEDRA','ELIANA ESTER','6421180-3','ELIANA.DEVIA@USACH:CL','','','',2,19,2),
  (609,'DIAMANTINO ROJAS','HECTOR OCTAVIO','7693223-9','HECTOR.DIAMANTINO@USACH:CL','','','',2,12,2),
  (610,'DIAMANTINO IBAR','VALERY DENISSE','15934235-2','VALERY.DIAMANTINO@USACH:CL','','','',2,30,2),
  (611,'DIAZ SOTO','MARCELO PABLO','7909261-4','MARCELO.DIAZ@USACH:CL','','','',2,40,2),
  (612,'DIAZ ROZAS','SALVADOR FIDEL','11644862-9','SALVADOR.DIAZ@USACH:CL','','','',2,36,2),
  (613,'DIAZ DIAZ','MANUEL MIGUEL','14660564-8','MANUEL.DIAZ@USACH:CL','','','',2,25,2),
  (614,'DIAZ SCHULZE','OSCAR PABLO','5394684-4','OSCAR.DIAZ@USACH:CL','','','',2,6,2),
  (615,'DIAZ CARO','GEORGINA DEL CARMEN','5898486-8','GEORGINA.DIAZ@USACH:CL','','','',2,15,2),
  (616,'DIAZ MARIN','RUBEN ARMANDO','4597870-2','RUBEN.DIAZ@USACH:CL','','','',2,34,2),
  (617,'DIAZ SAAVEDRA','MARIA ELENA','5386581-K','MARIA.DIAZ@USACH:CL','','','',2,35,2),
  (618,'DIAZ MUNOZ','RENE ORLANDO','7362941-1','RENE.DIAZ@USACH:CL','','','',2,10,2),
  (619,'DIAZ GONZALEZ','MIGUEL ULISES','6340819-0','MIGUEL.DIAZ@USACH:CL','','','',2,11,2),
  (620,'DIAZ BAMBACH','MIGUEL ALFREDO','6225534-K','MIGUEL.DIAZ@USACH:CL','','','',2,35,2),
  (621,'DIAZ BUSTAMANTE','LISANDRO ALBERTO','6591054-3','LISANDRO.DIAZ@USACH:CL','','','',2,19,2),
  (622,'DIAZ AVILA','JAIME ANTONIO','10462895-8','JAIME.DIAZ@USACH:CL',NULL,NULL,NULL,1,NULL,NULL),
  (623,'DIAZ CANEPA','CARLOS IGNACIO','6582122-2','CARLOS.DIAZ@USACH:CL','','','',2,30,2),
  (624,'DIAZ ARAYA','ANA MARIA','6556318-5','ANA.DIAZ@USACH:CL','','','',2,19,2),
  (625,'DIAZ GARCIA','SERGIO EDUARDO','8351099-4','SERGIO.DIAZ@USACH:CL','','','',2,11,2),
  (626,'DIAZ MUNOZ','HERNAN ALEJANDRO','10426528-6','HERNAN.DIAZ@USACH:CL',NULL,NULL,NULL,1,NULL,NULL),
  (627,'DIAZ VARGAS','PABLO EUGENIO','9383255-8','PABLO.DIAZ@USACH:CL','','','',2,19,2),
  (628,'DIAZ CORNEJO','XIMENA DANIELA','14144018-7','XIMENA.DIAZ@USACH:CL','','','',2,30,2),
  (629,'DIAZ VARGAS','RUTH PATRICIA','8978737-8','RUTH.DIAZ@USACH:CL','','','',2,25,2),
  (630,'DIEZ SANTIBANEZ','BASILIO RAMIRO','6524167-6','BASILIO.DIEZ@USACH:CL','','','',2,35,2),
  (631,'DOBBS DIAZ','FREDERICK MICHAEL','6513488-8','FREDERICK.DOBBS@USACH:CL','','','',2,33,2),
  (632,'DONOSO ROJAS','MARIA LUISA','8206405-2','MARIA.DONOSO@USACH:CL','','','',2,38,2),
  (633,'DONOSO BRAVO','ROBERTO ANTONIO','6983570-8','ROBERTO.DONOSO@USACH:CL','','','',2,36,2),
  (634,'DOSSI DOSSI','ARNALDO','5631857-7','ARNALDO.DOSSI@USACH:CL','','','',2,10,2),
  (635,'DROGUETT JARA','DENISSE ANDREA DEL CARMEN','16342926-8','DENISSE.DROGUETT@USACH:CL','','','',2,19,2),
  (636,'DUCOS SANCHEZ','ADRIANA ELISA','4104182-K','ADRIANA.DUCOS@USACH:CL','','','',2,25,2),
  (637,'DURAN CORREA','ALICIA ISABEL','8542064-K','ALICIA.DURAN@USACH:CL','','','',2,14,2),
  (638,'DURAN ROMERO','NICOLE DEL CARMEN','16697889-0','NICOLE.DURAN@USACH:CL','','','',2,8,2),
  (639,'DURAN PEREIRA','HERMENEGILDO','5470073-3','HERMENEGILDO.DURAN@USACH:CL','','','',2,29,2),
  (640,'DURAN ILLANES','WASHINGTON ALBERTO','3274328-5','WASHINGTON.DURAN@USACH:CL','','','',2,25,2),
  (641,'DURAN FIERRO','FELIX ORLANDO','3170478-2','FELIX.DURAN@USACH:CL','','','',2,22,2),
  (642,'DURAN SAN MARTIN','CLAUDIA ANDREA','8474577-4','CLAUDIA.DURAN@USACH:CL','','','',2,22,2),
  (643,'DZIEKONSKI RUCHARDT','MATIAS ANTONIO','6228787-K','MATIAS.DZIEKONSKI@USACH:CL','','','',2,17,2),
  (644,'ECHEVERRIA BAHAMONDE','RICARDO NABOR','7138048-3','RICARDO.ECHEVERRIA@USACH:CL','','','',2,19,2),
  (645,'ECHIBURU MORALES','ITZEL CHERIE','13659035-9','ITZEL.ECHIBURU@USACH:CL','','','',2,30,2),
  (646,'EGNEN DEL PINO','OSCAR NICOLAS ALFONSO','13605717-0','OSCAR.EGNEN@USACH:CL','','','',2,29,2),
  (647,'ELIAS ECHAURREN','ENRIQUE IGNACIO','13232851-K','ENRIQUE.ELIAS@USACH:CL','','','',2,25,2),
  (648,'ENCINA ROJAS','MARIA VICTORIA','5099462-7','MARIA.ENCINA@USACH:CL','','','',2,7,2),
  (649,'ENCINA TAPIA','DANIEL DOMINGO','15397883-2','DANIEL.ENCINA@USACH:CL','','','',2,35,2),
  (650,'ERAZO JIMENEZ','MARIA SOLEDAD','8519131-4','MARIA.ERAZO@USACH:CL','','','',2,31,2),
  (651,'ERLBAUN OLMOS','MONICA GERTRUDIS','7082286-5','MONICA.ERLBAUN@USACH:CL','','','',2,27,2),
  (652,'ESCOBAR MARTINEZ','BLANCA ALICIA','6058983-6','BLANCA.ESCOBAR@USACH:CL','','','',2,32,2),
  (653,'ESCOBAR ARRUE','LUIS HUMBERTO','6352781-5','LUIS.ESCOBAR@USACH:CL','','','',2,19,2),
  (654,'ESCOBAR INOSTROZA','NELSON FERNANDO','5837972-7','NELSON.ESCOBAR@USACH:CL','','','',2,22,2),
  (655,'ESCOBAR ARRIAGADA','WALDO HUGO','7443709-5','WALDO.ESCOBAR@USACH:CL','','','',2,27,2),
  (656,'ESCOBAR GONZALEZ','LUIS HUMBERTO','7682791-5','LUIS.ESCOBAR@USACH:CL','','','',2,25,2),
  (657,'ESPARZA BARRERA','CARLOS HUMBERTO','5581921-1','CARLOS.ESPARZA@USACH:CL','','','',2,18,2),
  (658,'ESPINDOLA FLORES','OCTAVIO HERNAN','9387424-2','OCTAVIO.ESPINDOLA@USACH:CL','','','',2,10,2),
  (659,'ESPINOSA FERRADA','VICTORIA ALICIA','11907035-K','VICTORIA.ESPINOSA@USACH:CL','','','',2,25,2),
  (660,'ESPINOSA SEPULVEDA','MARIA ELENA DEL ROSARIO','6225521-8','MARIA.ESPINOSA@USACH:CL','','','',2,26,2),
  (661,'ESPINOZA SALFATE','LORENA BEATRIZ','8713116-5','LORENA.ESPINOZA@USACH:CL','','','',2,19,2),
  (662,'ESPINOZA RAMIREZ','JUAN CARLOS','7579063-5','JUAN.ESPINOZA@USACH:CL','','','',2,35,2),
  (663,'ESPINOZA TORO','SALVADOR ADRIAN','10203978-5','SALVADOR.ESPINOZA@USACH:CL','','','',2,17,2),
  (664,'ESPINOZA MUNOZ','CRISTINA ALEJANDRA','15456537-K','CRISTINA.ESPINOZA@USACH:CL','','','',2,8,2),
  (665,'ESPINOZA OYARZUN','JAIME CESAR','4776291-K','JAIME.ESPINOZA@USACH:CL','','','',2,5,2),
  (666,'ESPINOZA SERRANO','LUIS HERNAN','4813697-4','LUIS.ESPINOZA@USACH:CL','','','',2,36,2),
  (667,'ESPINOZA MONCADA','MANUEL EDUARDO','5122777-8','MANUEL.ESPINOZA@USACH:CL','','','',2,21,2),
  (668,'ESPINOZA MINO','LUIS ALBERTO','6362845-K','LUIS.ESPINOZA@USACH:CL','','','',2,13,2),
  (669,'ESPINOZA SOTO','ADRIANA ELIZABETH','7838640-1','ADRIANA.ESPINOZA@USACH:CL','','','',2,30,2),
  (670,'ESPINOZA CASANOVA','TERESITA DEL CARMEN','9123696-6','TERESITA.ESPINOZA@USACH:CL','','','',2,29,2),
  (671,'ESPINOZA FERNANDEZ','ALEJANDRA ISABEL','9210499-0','ALEJANDRA.ESPINOZA@USACH:CL','','','',2,8,2),
  (672,'ESPINOZA ESPEJO','ELIZABETH ALEJANDRA','15633120-1','ELIZABETH.ESPINOZA@USACH:CL','','','',2,30,2),
  (673,'ESPINOZA LARA','PABLO ANDRES','16197251-7','PABLO.ESPINOZA@USACH:CL','','','',2,13,2),
  (674,'ESPINOZA MARIN','SERGIO ENRIQUE','12868129-9','SERGIO.ESPINOZA@USACH:CL','','','',2,13,2),
  (675,'ESQUIVEL CONTRERAS','MARIA JOSE','10612006-4','MARIA.ESQUIVEL@USACH:CL','','','',2,37,2),
  (676,'ESTAY TOBAR','GREGORIO CESARIO','5113085-5','GREGORIO.ESTAY@USACH:CL','','','',2,15,2),
  (677,'ESTAY CUBILLOS','GERALDINE','15379135-K','GERALDINE.ESTAY@USACH:CL','','','',2,18,2),
  (678,'ESTELLE AGUIRRE','LUIS ENRIQUE','5315873-0','LUIS.ESTELLE@USACH:CL','','','',2,34,2),
  (679,'ESTRADA TRONCOSO','HILDA DE LAS MERCEDES','6443942-1','HILDA.ESTRADA@USACH:CL','','','',2,21,2),
  (680,'ESTROZ ESTROZ','JUAN CARLOS','9164619-6','JUAN.ESTROZ@USACH:CL','','','',2,30,2),
  (681,'EUGENIN LEON','JAIME LUCIANO','6595381-1','JAIME.EUGENIN@USACH:CL','','','',2,6,2),
  (682,'EVANS MIRANDA','ROSA MARIA','5935289-K','ROSA.EVANS@USACH:CL','','','',2,22,2),
  (683,'FABBRI AGUILERA','AIDA LILIANA','5363692-6','AIDA.FABBRI@USACH:CL','','','',2,10,2),
  (684,'FAJARDO CONTRERAS','GASTON CARLOS ANDRES','2885127-8','GASTON.FAJARDO@USACH:CL','','','',2,33,2),
  (685,'FAJARDO ROSSEL','PAOLA INES','10908796-3','PAOLA.FAJARDO@USACH:CL','','','',2,38,2),
  (686,'FAJRE ACUNA','VICTOR EDUARDO','7366683-K','VICTOR.FAJRE@USACH:CL','','','',2,36,2),
  (687,'FALCONI CONCHA','ENRIQUE','3102072-7','ENRIQUE.FALCONI@USACH:CL','','','',2,36,2),
  (688,'FARIAS MARTINEZ','FANNY DEL CARMEN','10678201-6','FANNY.FARIAS@USACH:CL','','','',2,18,2),
  (689,'FARIAS MATURANA','LILIANA ANITA','5320897-5','LILIANA.FARIAS@USACH:CL','','','',2,8,2),
  (690,'FARIAS ESCUDERO','JUAN CARLOS','9210364-1','JUAN.FARIAS@USACH:CL','','','',2,22,2),
  (691,'FARIAS GUERRERO','EMILIO  ALBERTO','10069604-5','EMILIO.FARIAS@USACH:CL','','','',2,33,2),
  (692,'FARIAS MOENA','EDUARDO LEONCIO','9668853-9','EDUARDO.FARIAS@USACH:CL','','','',2,35,2),
  (693,'FAUNDEZ CASTRO','MARIA ANTONIETA','8821162-6','MARIA.FAUNDEZ@USACH:CL','','','',2,38,2),
  (694,'FAUNDEZ SEPULVEDA','ALEJOS HOMAR','5348119-1','ALEJOS.FAUNDEZ@USACH:CL','','','',2,19,2),
  (695,'FERNANDEZ TAPIA','ANA MARIA','8537671-3','ANA.FERNANDEZ@USACH:CL','','','',2,30,2),
  (696,'FERNANDEZ GALVEZ','JORGE RENE','4432032-0','JORGE.FERNANDEZ@USACH:CL','','','',2,13,2),
  (697,'FERNANDEZ VENEGAS','CARLOS JAIME','4484665-9','CARLOS.FERNANDEZ@USACH:CL','','','',2,14,2),
  (698,'FERNANDEZ DROGUETT','FRANCISCA','13889909-8','FRANCISCA.FERNANDEZ@USACH:CL','','','',2,32,2),
  (699,'FERNANDEZ ALEGRIA','RICARDO ROBERTO','9151926-7','RICARDO.FERNANDEZ@USACH:CL','','','',2,25,2),
  (700,'FERONE MAISTO','SANDRA CONCETTA','7360086-3','SANDRA.FERONE@USACH:CL','','','',2,25,2),
  (701,'FERRADA LIENDOR','VANESSA GLADYS','10430252-1','VANESSA.FERRADA@USACH:CL','','','',2,29,2),
  (702,'FERRADA DAVILA','CRISTIAN ANTONIO','6394281-2','CRISTIAN.FERRADA@USACH:CL','','','',2,11,2),
  (703,'FERREIRA SOLORZA','HECTOR ENRIQUE','8026841-6','HECTOR.FERREIRA@USACH:CL','','','',2,18,2),
  (704,'FERRER MELI','JORGE PABLO','5895552-3','JORGE.FERRER@USACH:CL','','','',2,18,2),
  (705,'FIABANE SALAS','ANDREA JULIA','7434623-5','ANDREA.FIABANE@USACH:CL','','','',2,25,2),
  (706,'FICA SEPULVEDA','SILVANA VIRGINIA','13259637-9','SILVANA.FICA@USACH:CL','','','',2,19,2),
  (707,'FICA ORTEGA','ARSENIO OMAR','6946633-8','ARSENIO.FICA@USACH:CL','','','',2,15,2),
  (708,'FIGUEROA MUNOZ','ROBERTO ENRIQUE','14603830-1','ROBERTO.FIGUEROA@USACH:CL','','','',2,10,2),
  (709,'FIGUEROA SALAS','JONAS','5822138-4','JONAS.FIGUEROA@USACH:CL','','','',2,17,2),
  (710,'FIGUEROA MORALES','LORNA NAYADER DEL CARMEN','6497297-9','LORNA.FIGUEROA@USACH:CL','','','',2,13,2),
  (711,'FINSTERBUSCH RODRIGUEZ','CARLOS ARIEL','13903612-3','CARLOS.FINSTERBUSCH@USACH:CL','','','',2,25,2),
  (712,'FLORES ARAYA','FERNANDO DANTE','9165334-6','FERNANDO.FLORES@USACH:CL','','','',2,17,2),
  (713,'FLORES YANEZ','BENEDICTO ANTONIO','5732278-0','BENEDICTO.FLORES@USACH:CL','','','',2,19,2),
  (714,'FLORES MENESES','MARIO ALEJANDRO','5253271-K','MARIO.FLORES@USACH:CL','','','',2,10,2),
  (715,'FLORES CONTRERAS','GUILLERMO DOMINGO','6696750-6','GUILLERMO.FLORES@USACH:CL','','','',2,19,2),
  (716,'FLORES REYES','NELSON OSVALDO','6718504-8','NELSON.FLORES@USACH:CL','','','',2,18,2),
  (717,'FLORES NAVARRETE','CARLOS ABRAHAM','7350422-8','CARLOS.FLORES@USACH:CL','','','',2,25,2),
  (718,'FLORES DIAZ','ELIAS GRACIANO','6507184-3','ELIAS.FLORES@USACH:CL','','','',2,10,2),
  (719,'FLORES GOMEZ','TERCELINA ELIANA','7129444-7','TERCELINA.FLORES@USACH:CL','','','',2,18,2),
  (720,'FLORES ZUNIGA','HECTOR PATRICIO','7620526-4','HECTOR.FLORES@USACH:CL','','','',2,37,2),
  (721,'FLORES POBLETE','GRACE MARGARITA','9001693-8','GRACE.FLORES@USACH:CL','','','',2,15,2),
  (722,'FLORES CARRASCO','VICTORIA ANGELICA','4486216-6','VICTORIA.FLORES@USACH:CL','','','',2,27,2),
  (723,'FODICH SATTA','PEDRO ANDRES','13507646-5','PEDRO.FODICH@USACH:CL','','','',2,29,2),
  (724,'FONFACH UGALDE','FRANZ RUPERTO','10769968-6','FRANZ.FONFACH@USACH:CL','','','',2,36,2),
  (725,'FORSTER MUJICA','JUAN ENRIQUE','4779341-6','JUAN.FORSTER@USACH:CL','','','',2,8,2),
  (726,'FOX TIMMLING','HANS JORG HERMANN','4873179-1','HANS.FOX@USACH:CL','','','',2,17,2),
  (727,'FRANCO PADILLA','MARIA ENCARNACION','5520147-1','MARIA.FRANCO@USACH:CL','','','',2,11,2),
  (728,'FREITTE VIVANCO','ANDREA MARCELA','9499582-5','ANDREA.FREITTE@USACH:CL','','','',2,25,2),
  (729,'FREY LOPEZ','CLAUDIO ANDRES','10032953-0','CLAUDIO.FREY@USACH:CL','','','',2,5,2),
  (730,'FRIEDMAN RAFAEL','JORGE RICARDO','7014199-K','JORGE.FRIEDMAN@USACH:CL','','','',2,22,2),
  (731,'FUENTEALBA ACUNA','CLAUDIO PASCUAL EULOGIO','5055639-5','CLAUDIO.FUENTEALBA@USACH:CL','','','',2,19,2),
  (732,'FUENTES MENDEZ','MARIA ANGELICA','7437302-K','MARIA.FUENTES@USACH:CL','','','',2,18,2),
  (733,'FUENTES VENEGAS','JULIO CESAR','8004432-1','JULIO.FUENTES@USACH:CL','','','',2,18,2),
  (734,'FUENTES FIGUEROA','MARCELO RODRIGO','14455625-9','MARCELO.FUENTES@USACH:CL','','','',2,19,2),
  (735,'FUENTES OSORIO','JESSICA LORENA','13937515-7','JESSICA.FUENTES@USACH:CL','','','',2,25,2),
  (736,'FUENTES POZO','JOSE ENRIQUE','4200734-K','JOSE.FUENTES@USACH:CL','','','',2,25,2),
  (737,'FUENTES PAVEZ','OLGA ISABEL','6348312-5','OLGA.FUENTES@USACH:CL','','','',2,19,2),
  (738,'FUENTES OLAVE','VOLTAIRE DAVID','6409122-0','VOLTAIRE.FUENTES@USACH:CL','','','',2,18,2),
  (739,'FUENTES VILLALOBOS','MIGUEL ANGEL','6406104-6','MIGUEL.FUENTES@USACH:CL','','','',2,12,2),
  (740,'FUENTES RAMIREZ','DIANA STELLA','6004656-5','DIANA.FUENTES@USACH:CL','','','',2,19,2),
  (741,'FUENTES OLIVARES','ROXANA DEL PILAR','12562676-9','ROXANA.FUENTES@USACH:CL','','','',2,8,2),
  (742,'FUENTES GOMEZ','LORENA ARLETTE','14534090-K','LORENA.FUENTES@USACH:CL','','','',2,27,2),
  (743,'FUENZALIDA DONOSO','LUCINDA DEL CARMEN','8539083-K','LUCINDA.FUENZALIDA@USACH:CL','','','',2,34,2),
  (744,'FUENZALIDA CARRENO','CARLOS CLAUDIO','9190216-8','CARLOS.FUENZALIDA@USACH:CL','','','',2,14,2),
  (745,'FUENZALIDA MIRANDA','LUIS ALBERTO','5258364-0','LUIS.FUENZALIDA@USACH:CL','','','',2,18,2),
  (746,'FUENZALIDA CRUZ','HECTOR OSVALDO','10002802-6','HECTOR.FUENZALIDA@USACH:CL','','','',2,25,2),
  (747,'FUENZALIDA ROZAS','CRISTIAN RODRIGO','13058223-0','CRISTIAN.FUENZALIDA@USACH:CL','','','',2,17,2),
  (748,'FUHRER JIMENEZ','GUILLERMO ALBERTO','6816340-4','GUILLERMO.FUHRER@USACH:CL','','','',2,18,2),
  (749,'FUHRER FUSTER','JUAN GUILLERMO','4889121-7','JUAN.FUHRER@USACH:CL','','','',2,25,2),
  (750,'GACITUA MUNOZ','GUSTAVO','5843206-7','GUSTAVO.GACITUA@USACH:CL','','','',2,30,2),
  (751,'GACITUA MOLINA','FREDDY EDGARDO','7697367-9','FREDDY.GACITUA@USACH:CL','','','',2,11,2),
  (752,'GAETE ROCO','JANET DEL CARMEN','10652809-8','JANET.GAETE@USACH:CL','','','',2,30,2),
  (753,'GAETE TORRES','ANDRES EUGENIO','14398197-5','ANDRES.GAETE@USACH:CL','','','',2,18,2),
  (754,'GALAZ PEREZ','MANUEL ALEJANDRO','10765472-0','MANUEL.GALAZ@USACH:CL','','','',2,19,2),
  (755,'GALDAMES TURRA','CARMEN GLORIA','5714625-7','CARMEN.GALDAMES@USACH:CL','','','',2,31,2),
  (756,'GALDAMES SEGUEL','MARCELA CAROLINA','15650509-9','MARCELA.GALDAMES@USACH:CL','','','',2,30,2),
  (757,'GALINDO VILLARROEL','CARLA XIMENA','11717684-3','CARLA.GALINDO@USACH:CL','','','',2,30,2),
  (758,'GALLARDO CANALES','RODRIGO IGNACIO','15791441-3','RODRIGO.GALLARDO@USACH:CL','','','',2,36,2),
  (759,'GALLARDO GALLARDO','OMAR PADIS DEL CARMEN','4985212-6','OMAR.GALLARDO@USACH:CL','','','',2,33,2),
  (760,'GALLARDO BARAHONA','ESTELA ELISELA','7064418-5','ESTELA.GALLARDO@USACH:CL','','','',2,13,2),
  (761,'GALLARDO SALAS','TRANSITO DEL CARMEN','5927462-7','TRANSITO.GALLARDO@USACH:CL','','','',2,23,2),
  (762,'GALLARDO PASSARGE','JULIO MARCELO','6971457-9','JULIO.GALLARDO@USACH:CL','','','',2,19,2),
  (763,'GALLARDO PORRAS','VIVIANA XIMENA','10739104-5','VIVIANA.GALLARDO@USACH:CL','','','',2,32,2),
  (764,'GALLARDO GOMEZ','ANDRES EUGENIO','12245417-7','ANDRES.GALLARDO@USACH:CL','','','',2,15,2),
  (765,'GALLARDO GONZALEZ','FRANCISCO JAVIER','9476299-5','FRANCISCO.GALLARDO@USACH:CL','','','',2,22,2),
  (766,'GALLARDO NUNEZ','CLAUDIO ANDRES','12283856-0','CLAUDIO.GALLARDO@USACH:CL','','','',2,25,2),
  (767,'GALVEZ ORLANDINI','JUAN FRANCISCO','13364103-3','JUAN.GALVEZ@USACH:CL','','','',2,10,2),
  (768,'GALVEZ ARIAS','MARYLUCY','6509829-6','MARYLUCY.GALVEZ@USACH:CL','','','',2,25,2),
  (769,'GAMBOA RIOS','JORGE FELIPE','6589354-1','JORGE.GAMBOA@USACH:CL','','','',2,18,2),
  (770,'GAMBOA OTERO','LUIS EMILIO','7848825-5','LUIS.GAMBOA@USACH:CL','','','',2,25,2),
  (771,'GANA FUENZALIDA','RODRIGO ANDRES','13035473-4','RODRIGO.GANA@USACH:CL','','','',2,17,2),
  (772,'GARATE COLLADO','RUBEN ISNALDO','5524643-2','RUBEN.GARATE@USACH:CL','','','',2,18,2),
  (773,'GARATE PIZARRO','BERNARDO GERMAN','8961742-1','BERNARDO.GARATE@USACH:CL','','','',2,13,2),
  (774,'GARCIA INOSTROZA','MARIANELA','4367584-2','MARIANELA.GARCIA@USACH:CL','','','',2,26,2),
  (775,'GARCIA ESPINOZA','SILVIA ELIANA','5192785-0','SILVIA.GARCIA@USACH:CL','','','',2,19,2),
  (776,'GARCIA FLORES','JESUS NOLBERTO','7318776-1','JESUS.GARCIA@USACH:CL','','','',2,11,2),
  (777,'GARCIA GARCIA','AMALIA DEL CARMEN','6255604-8','AMALIA.GARCIA@USACH:CL','','','',2,26,2),
  (778,'GARCIA DE LA CERDA','OSVALDO','6060385-5','OSVALDO.GARCIA@USACH:CL','','','',2,11,2),
  (779,'GARCIA PAIVA','FERNANDO MIGUEL','4555269-1','FERNANDO.GARCIA@USACH:CL','','','',2,10,2),
  (780,'GARCIA RIVADENEIRA','HERMANN CAMILO','6071298-0','HERMANN.GARCIA@USACH:CL','','','',2,10,2),
  (781,'GARCIA OLIVARES','JULIAN ANTONIO','6471783-9','JULIAN.GARCIA@USACH:CL','','','',2,11,2),
  (782,'GARCIA PEREZ','PATRICIO JOSE','7668358-1','PATRICIO.GARCIA@USACH:CL','','','',2,32,2),
  (783,'GARCIA BRITO','RODRIGO JAVIER','9431750-9','RODRIGO.GARCIA@USACH:CL','','','',2,12,2),
  (784,'GARCIA BENAVIDES','JOSE MIGUEL','9035367-5','JOSE.GARCIA@USACH:CL','','','',2,10,2),
  (785,'GARCIA PEREZ','TIAREN CAROLINA','15541678-5','TIAREN.GARCIA@USACH:CL','','','',2,18,2),
  (786,'GARCIA HERRERA','CLAUDIO MOISES','13200909-0','CLAUDIO.GARCIA@USACH:CL','','','',2,13,2),
  (787,'GARIN CORDOVA','JORGE LEONIDAS','4660430-K','JORGE.GARIN@USACH:CL','','','',2,14,2),
  (788,'GARRAMUNO GUERRA','SERGIO ANTONIO','14392864-0','SERGIO.GARRAMUNO@USACH:CL','','','',2,18,2),
  (789,'GARRIDO CIFUENTES','FERMIN ARTURO','6473224-2','FERMIN.GARRIDO@USACH:CL','','','',2,10,2),
  (790,'GARRIDO CORTES','RICARDO ANTONIO','10837837-9','RICARDO.GARRIDO@USACH:CL','','','',2,23,2),
  (791,'GARRIDO HERNANDEZ','MIGUEL ANGEL','15412396-2','MIGUEL.GARRIDO@USACH:CL','','','',2,36,2),
  (792,'GATICA PINTO','TERESA DEL CARMEN','6033020-4','TERESA.GATICA@USACH:CL','','','',2,32,2),
  (793,'GATICA JIMENEZ','FRANCISCO MIGUEL','12877777-6','FRANCISCO.GATICA@USACH:CL','','','',2,25,2),
  (794,'GAVILAN LEON','JORGE EXEQUIEL','3976298-6','JORGE.GAVILAN@USACH:CL','','','',2,10,2),
  (795,'GAYMER CORTES','MARIO ALFREDO','5270886-9','MARIO.GAYMER@USACH:CL','','','',2,22,2),
  (796,'GEERDTS GONZALEZ','ALEMITH MARTA','6540759-0','ALEMITH.GEERDTS@USACH:CL','','','',2,18,2),
  (797,'GERALDO PUELLES','ROBERTO GABRIEL','10929489-6','ROBERTO.GERALDO@USACH:CL','','','',2,19,2),
  (798,'GERALDO DURAN','DANIELA ANDREA','12009210-3','DANIELA.GERALDO@USACH:CL','','','',2,8,2),
  (799,'GERTOSIO SALINAS','CECILIA ANGELICA','5256700-9','CECILIA.GERTOSIO@USACH:CL','','','',2,38,2),
  (800,'GIAVENO S.S.A.','LAURA ELENA','21620643-6','LAURA.GIAVENO@USACH:CL','','','',2,25,2),
  (801,'GILABERT MENESES','VICENTE','5926031-6','VICENTE.GILABERT@USACH:CL','','','',2,15,2),
  (802,'GODOY GUZMAN','CARLOS IGNACIO','16026360-1','CARLOS.GODOY@USACH:CL','','','',2,25,2),
  (803,'GODOY GONZALEZ','FERNANDO JOSE','14453265-1','FERNANDO.GODOY@USACH:CL','','','',2,8,2),
  (804,'GODOY LEON','HUGO OSVALDO FABIAN','6166576-5','HUGO.GODOY@USACH:CL','','','',2,29,2),
  (805,'GODOY SEQUEIDA','RICARDO ANTONIO','9508175-4','RICARDO.GODOY@USACH:CL','','','',2,14,2),
  (806,'GODOY OLIVARES','LILIANA DEL PILAR','13698808-5','LILIANA.GODOY@USACH:CL','','','',2,37,2),
  (807,'GOICOVIC DONOSO','IGOR ALEXIS','8011139-8','IGOR.GOICOVIC@USACH:CL','','','',2,32,2),
  (808,'GOITY EBENSPERGER','LEON RENE','6433462-K','LEON.GOITY@USACH:CL','','','',2,38,2),
  (809,'GOMEZ CERDA','ESTEBAN SEGUNDO','7919158-2','ESTEBAN.GOMEZ@USACH:CL','','','',2,37,2),
  (810,'GOMEZ GOMEZ','LUIS JOSE','3422735-7','LUIS.GOMEZ@USACH:CL','','','',2,19,2),
  (811,'GOMEZ GONZALEZ','JUAN CARLOS','2029529-5','JUAN.GOMEZ@USACH:CL','','','',2,25,2),
  (812,'GOMEZ MALDONADO','BETTY DEL CARMEN','5501019-6','BETTY.GOMEZ@USACH:CL','','','',2,26,2),
  (813,'GOMEZ FERNANDEZ','FRANCISCO JAVIER','7963160-4','FRANCISCO.GOMEZ@USACH:CL','','','',2,19,2),
  (814,'GOMEZ OJEDA','SILVANA MARGARITA','8702103-3','SILVANA.GOMEZ@USACH:CL','','','',2,19,2),
  (815,'GOMEZ PANTOJA','CARLOS LUIS','13453627-6','CARLOS.GOMEZ@USACH:CL','','','',2,12,2),
  (816,'GONZALEZ SOTO','ELENA PAULINA','7513687-0','ELENA.GONZALEZ@USACH:CL','','','',2,34,2),
  (817,'GONZALEZ REYES','VICTOR EUGENIO','7478422-4','VICTOR.GONZALEZ@USACH:CL','','','',2,38,2),
  (818,'GONZALEZ BRAVO','SERGIO SEGUNDO','8004692-8','SERGIO.GONZALEZ@USACH:CL','','','',2,34,2),
  (819,'GONZALEZ POBLETE','MAGALY ANDREA','10613991-1','MAGALY.GONZALEZ@USACH:CL','','','',2,30,2),
  (820,'GONZALEZ DIAZ','FELIPE ERNESTO','13501933-K','FELIPE.GONZALEZ@USACH:CL','','','',2,21,2),
  (821,'GONZALEZ SERRANO','HERALDO PATRICIO','5963922-6','HERALDO.GONZALEZ@USACH:CL','','','',2,19,2),
  (822,'GONZALEZ SASSO','MAXIMO ERNESTO','5316539-7','MAXIMO.GONZALEZ@USACH:CL','','','',2,19,2),
  (823,'GONZALEZ RODRIGUEZ','SERGIO JOSE','6067727-1','SERGIO.GONZALEZ@USACH:CL','','','',2,30,2),
  (824,'GONZALEZ SALINAS','ARTURO EDGARDO','6553425-8','ARTURO.GONZALEZ@USACH:CL','','','',2,10,2),
  (825,'GONZALEZ SALINAS','JORGE OMAR','5528838-0','JORGE.GONZALEZ@USACH:CL','','','',2,10,2),
  (826,'GONZALEZ GUAJARDO','HERNAN ENRIQUE','4019523-8','HERNAN.GONZALEZ@USACH:CL','','','',2,19,2),
  (827,'GONZALEZ REVECO','YENNY MARGARITA','14134677-6','YENNY.GONZALEZ@USACH:CL','','','',2,11,2),
  (828,'GONZALEZ SOLIS','JORGE HERIBERTO','6797427-1','JORGE.GONZALEZ@USACH:CL','','','',2,37,2),
  (829,'GONZALEZ TAPIA','SERGIO MANUEL','6590231-1','SERGIO.GONZALEZ@USACH:CL','','','',2,17,2),
  (830,'GONZALEZ BARRA','WALTERIO','5532557-K','WALTERIO.GONZALEZ@USACH:CL','','','',2,35,2),
  (831,'GONZALEZ VALENZUELA','NESTOR ALEJANDRO','5887283-0','NESTOR.GONZALEZ@USACH:CL','','','',2,12,2),
  (832,'GONZALEZ PEREZ','RUTH ELIZABETH','8349090-K','RUTH.GONZALEZ@USACH:CL','','','',2,19,2),
  (833,'GONZALEZ MATUS','XIMENA DEL CARMEN','8507162-9','XIMENA.GONZALEZ@USACH:CL','','','',2,19,2),
  (834,'GONZALEZ ALARCON','HUGO MIGUEL','7190196-3','HUGO.GONZALEZ@USACH:CL','','','',2,19,2),
  (835,'GONZALEZ MATURANA','JORGE ENRIQUE','7554469-3','JORGE.GONZALEZ@USACH:CL','','','',2,25,2),
  (836,'GONZALEZ TOLEDO','JUAN PABLO','10790680-0','JUAN.GONZALEZ@USACH:CL','','','',2,33,2),
  (837,'GONZALEZ SAAVEDRA','ANA PAOLA','12134191-3','ANA.GONZALEZ@USACH:CL','','','',2,36,2),
  (838,'GONZALEZ TUGAS','CLEMENCIA','12043657-0','CLEMENCIA.GONZALEZ@USACH:CL','','','',2,31,2),
  (839,'GONZALEZ MOLINA','HECTOR RODRIGO','12422406-3','HECTOR.GONZALEZ@USACH:CL','','','',2,34,2),
  (840,'GONZALEZ LASSEUBE','ENRIQUE IVAN','10302081-6','ENRIQUE.GONZALEZ@USACH:CL','','','',2,19,2),
  (841,'GONZALEZ SOZA','LUZ AURORA','9748071-0','LUZ.GONZALEZ@USACH:CL','','','',2,19,2),
  (842,'GONZALEZ MONDACA','PABLO ANDRES','14401650-5','PABLO.GONZALEZ@USACH:CL','','','',2,34,2),
  (843,'GONZALEZ SEPULVEDA','SANDRA PATRICIA','15071251-3','SANDRA.GONZALEZ@USACH:CL','','','',2,5,2),
  (844,'GONZALEZ SILVA','LUIS ALEXIS','15341827-6','LUIS.GONZALEZ@USACH:CL','','','',2,19,2),
  (845,'GONZALEZ CORDOVA','LUIS SALVADOR','13019488-5','LUIS.GONZALEZ@USACH:CL','','','',2,37,2),
  (846,'GONZALEZ CAMPANO','FERNANDO PATRICIO','8483047-K','FERNANDO.GONZALEZ@USACH:CL','','','',2,25,2),
  (847,'GORMAZ VENEGAS','JULIO VICENTE','4660331-1','JULIO.GORMAZ@USACH:CL','','','',2,13,2),
  (848,'GOTTSCHALK VILLEGAS','AXEL DEL CARMEN','5602966-4','AXEL.GOTTSCHALK@USACH:CL','','','',2,11,2),
  (849,'GRAMSCH SANJINES','ERNESTO ROBERTO','1495032-K','ERNESTO.GRAMSCH@USACH:CL','','','',2,13,2),
  (850,'GRANDON RIVERA','JOSE MANUEL','9123927-2','JOSE.GRANDON@USACH:CL','','','',2,11,2),
  (851,'GROLLEAU OLGUIN','JORGE ALEX','7973645-7','JORGE.GROLLEAU@USACH:CL','','','',2,19,2),
  (852,'GUAJARDO MATURANA','PAULINA JESUS','13085434-6','PAULINA.GUAJARDO@USACH:CL','','','',2,14,2),
  (853,'GUAJARDO RUBILAR','JUAN MANUEL','6338199-3','JUAN.GUAJARDO@USACH:CL','','','',2,31,2),
  (854,'GUAJARDO NUNEZ','SYLVIA XIMENA','7208328-8','SYLVIA.GUAJARDO@USACH:CL','','','',2,26,2),
  (855,'GUAJARDO REBOLLEDO','FERNANDO ANDRES','15804163-4','FERNANDO.GUAJARDO@USACH:CL','','','',2,12,2),
  (856,'GUARDIA MEDIANO','ROBERTO OSCAR','12265683-7','ROBERTO.GUARDIA@USACH:CL','','','',2,5,2),
  (857,'GUERRA BENAVENTE','IGNACIO ANTONIO','9370444-4','IGNACIO.GUERRA@USACH:CL','','','',2,19,2),
  (858,'GUERRA CASTRO','LUCIA ANGELICA','5523889-8','LUCIA.GUERRA@USACH:CL','','','',2,32,2),
  (859,'GUERRA MOSQUERA','JORGE LEONARDO','7670983-1','JORGE.GUERRA@USACH:CL','','','',2,19,2),
  (860,'GUERRERO VALENZUELA','MAURICIO ALLAN','8761590-1','MAURICIO.GUERRERO@USACH:CL','','','',2,36,2),
  (861,'GUERRERO ACEVEDO','ANDRES ESTEBAN','8517290-5','ANDRES.GUERRERO@USACH:CL','','','',2,36,2),
  (862,'GUEVARA RUIZ','FERNANDO','10165814-7','FERNANDO.GUEVARA@USACH:CL','','','',2,12,2),
  (863,'GUEVARA TERRAZAS','LIDA MIRNA','4593400-4','LIDA.GUEVARA@USACH:CL','','','',2,27,2),
  (864,'GUINEZ MATAMALA','VICTOR HUGO','6186056-8','VICTOR.GUINEZ@USACH:CL','','','',2,19,2),
  (865,'GULPPI CABRA','MIGUEL ANGEL','9194404-9','MIGUEL.GULPPI@USACH:CL','','','',2,8,2),
  (866,'GUMERA CALDERON','MARIA SOLEDAD','9388408-6','MARIA.GUMERA@USACH:CL','','','',2,19,2),
  (867,'GUTIERREZ CARRASCO','JUAN CARLOS','10851468-K','JUAN.GUTIERREZ@USACH:CL','','','',2,15,2),
  (868,'GUTIERREZ OSORIO','ANTONIO LEON','5571062-7','ANTONIO.GUTIERREZ@USACH:CL','','','',2,10,2),
  (869,'GUTIERREZ MOLINA','RAMON SEGUNDO','6381702-3','RAMON.GUTIERREZ@USACH:CL','','','',2,10,2),
  (870,'GUTIERREZ TEUTSCH','JUAN ENRIQUE','2854630-0','JUAN.GUTIERREZ@USACH:CL','','','',2,11,2),
  (871,'GUTIERREZ DAURE','MARIA ELENA','5315233-3','MARIA.GUTIERREZ@USACH:CL','','','',2,18,2),
  (872,'GUTIERREZ HERMANSEN','CLAUDIO ALEJANDRO','12403157-5','CLAUDIO.GUTIERREZ@USACH:CL','','','',2,11,2),
  (873,'GUTIERREZ OYARCE','ANA ROSA','9969950-7','ANA.GUTIERREZ@USACH:CL','','','',2,31,2),
  (874,'GUTIERREZ PINO','JUAN ANTONIO','15725742-0','JUAN.GUTIERREZ@USACH:CL','','','',2,35,2),
  (875,'GUTIERREZ PINTO','JORGE','7939525-0','JORGE.GUTIERREZ@USACH:CL','','','',2,25,2),
  (876,'GUZMAN CUEVAS','AMADOR MIGUEL','7514455-5','AMADOR.GUZMAN@USACH:CL','','','',2,13,2),
  (877,'GUZMAN MEZA','LIENTUR','4764713-4','LIENTUR.GUZMAN@USACH:CL','','','',2,34,2),
  (878,'GUZMAN CASTRO','ERNESTO RAMON','5122370-5','ERNESTO.GUZMAN@USACH:CL','','','',2,38,2),
  (879,'GUZMAN RAMIREZ','JORGE FERNANDO','6056816-2','JORGE.GUZMAN@USACH:CL','','','',2,19,2),
  (880,'GUZMAN NUNEZ','MIGUEL EDUARDO','10483502-3','MIGUEL.GUZMAN@USACH:CL','','','',2,25,2),
  (881,'GUZMAN SILVA','MAURICIO ANDRES','11986632-4','MAURICIO.GUZMAN@USACH:CL','','','',2,34,2),
  (882,'GYSLING CASELLI','OLGA VIVIANA','6626614-1','OLGA.GYSLING@USACH:CL','','','',2,27,2),
  (883,'HADDAD BAJANA','WASHINGTON ELIAS','14623633-2','WASHINGTON.HADDAD@USACH:CL','','','',2,25,2),
  (884,'HAUVA SAN JUAN','MARCO ANTONIO','8248161-3','MARCO.HAUVA@USACH:CL','','','',2,11,2),
  (885,'HENRIQUEZ BARRIENTOS','FERNANDO JOSE','4889987-0','FERNANDO.HENRIQUEZ@USACH:CL','','','',2,33,2),
  (886,'HENRIQUEZ MIRANDA','HERNAN ROBERTO','6325302-2','HERNAN.HENRIQUEZ@USACH:CL','','','',2,19,2),
  (887,'HENRIQUEZ ACUNA','HECTOR ENRIQUE','11551795-3','HECTOR.HENRIQUEZ@USACH:CL','','','',2,5,2),
  (888,'HENRIQUEZ MONCADA','ETELVINA DEL ROSARIO','8962695-1','ETELVINA.HENRIQUEZ@USACH:CL','','','',2,18,2),
  (889,'HENRIQUEZ BUSTAMANTE','MARCIA GLORIA','9134002-K','MARCIA.HENRIQUEZ@USACH:CL','','','',2,8,2),
  (890,'HENRIQUEZ VARGAS','LUIS ANDRES','14125189-9','LUIS.HENRIQUEZ@USACH:CL','','','',2,15,2),
  (891,'HENRIQUEZ BERROETA','CLAUDIO ALEX','13758250-3','CLAUDIO.HENRIQUEZ@USACH:CL','','','',2,12,2),
  (892,'HERMOSILLA CUEVAS','MARIO EDUARDO','8400768-4','MARIO.HERMOSILLA@USACH:CL','','','',2,18,2),
  (893,'HERMOSILLA PINO','JESUS ALBERTO','12289675-7','JESUS.HERMOSILLA@USACH:CL','','','',2,18,2),
  (894,'HERNANDEZ VALENZUELA','FABIOLA CRISTINA','11872127-6','FABIOLA.HERNANDEZ@USACH:CL','','','',2,18,2),
  (895,'HERNANDEZ CONTRERAS','JOSE RAMON','10143639-K','JOSE.HERNANDEZ@USACH:CL','','','',2,25,2),
  (896,'HERNANDEZ CAMPOS','MARCOS PATRICIO','17509023-1','MARCOS.HERNANDEZ@USACH:CL','','','',2,17,2),
  (897,'HERNANDEZ KUNSTMANN','ALEJANDRO ANTONIO','5529591-3','ALEJANDRO.HERNANDEZ@USACH:CL','','','',2,6,2),
  (898,'HERNANDEZ MEDINA','LUIS ALBERTO','5294837-1','LUIS.HERNANDEZ@USACH:CL','','','',2,18,2),
  (899,'HERNANDEZ LAGOS','CLAUDIO ANTONIO','7108985-1','CLAUDIO.HERNANDEZ@USACH:CL','','','',2,29,2),
  (900,'HERNANDEZ ARAOS','MARIA TERESA','6551537-7','MARIA.HERNANDEZ@USACH:CL','','','',2,11,2),
  (901,'HERNANDEZ PAVEZ','RAMON FRANCISCO','3377306-4','RAMON.HERNANDEZ@USACH:CL','','','',2,13,2),
  (902,'HERNANDEZ VERGARA','HUMBERTO DOMINGO','5067922-5','HUMBERTO.HERNANDEZ@USACH:CL','','','',2,36,2),
  (903,'HERNANDEZ MANQUI','NIEVES DE LAS MERCEDES','10613401-4','NIEVES.HERNANDEZ@USACH:CL','','','',2,15,2),
  (904,'HERNANDEZ GONZALEZ','RODRIGO MANUEL','9483508-9','RODRIGO.HERNANDEZ@USACH:CL','','','',2,10,2),
  (905,'HERNANDEZ ZEPEDA','JUAN FERNANDO','14456884-2','JUAN.HERNANDEZ@USACH:CL','','','',2,17,2),
  (906,'HERNANDEZ ARAYA','ROBERTO ANTONIO','13433120-8','ROBERTO.HERNANDEZ@USACH:CL','','','',2,22,2),
  (907,'HERRERA MUNOZ','JOSE ANTONIO','5151208-1','JOSE.HERRERA@USACH:CL','','','',2,10,2),
  (908,'HERRERA QUIROZ','JUAN AROLDO','6073559-K','JUAN.HERRERA@USACH:CL','','','',2,10,2),
  (909,'HERRERA ASTUDILLO','GASTON BUENAVENTURA','8354877-0','GASTON.HERRERA@USACH:CL','','','',2,17,2),
  (910,'HERRERA GARCIA','GUSTAVO ERNESTO','4043973-0','GUSTAVO.HERRERA@USACH:CL','','','',2,11,2),
  (911,'HERRERA SEPULVEDA','HECTOR PABLO','6366308-5','HECTOR.HERRERA@USACH:CL','','','',2,10,2),
  (912,'HERRERA GONZALEZ','VICTOR FERNANDO','6018972-2','VICTOR.HERRERA@USACH:CL','','','',2,5,2),
  (913,'HERRERA ZEPPELIN','ALBERT LEANDRO','6975962-9','ALBERT.HERRERA@USACH:CL','','','',2,15,2),
  (914,'HERRERA ESPINOZA','FREDDY RODRIGO','12479822-1','FREDDY.HERRERA@USACH:CL','','','',2,36,2),
  (915,'HEVIA TAPIA','JOSE MANUEL','6670932-9','JOSE.HEVIA@USACH:CL','','','',2,38,2),
  (916,'HIDALGO HORMAZABAL','CLAUDIA ANDREA','11856682-3','CLAUDIA.HIDALGO@USACH:CL','','','',2,7,2),
  (917,'HIDALGO HERMOSILLA','ALDO DANIEL','6086463-2','ALDO.HIDALGO@USACH:CL','','','',2,17,2),
  (918,'HIDALGO BUSTOS','ADOLFO ALEXIS','15339282-K','ADOLFO.HIDALGO@USACH:CL','','','',2,5,2),
  (919,'HINOJOSA RAMIREZ','ELIZABETH DE LAS MERCEDES','9495996-9','ELIZABETH.HINOJOSA@USACH:CL','','','',2,25,2),
  (920,'HINOJOSA ACUNA','RICARDO ARTURO','5012473-8','RICARDO.HINOJOSA@USACH:CL','','','',2,10,2),
  (921,'HIRANE GALDAMES','MARTIN','8653298-0','MARTIN.HIRANE@USACH:CL','','','',2,25,2),
  (922,'HOFER VIDAL','ANDRES ORLANDO','10237888-1','ANDRES.HOFER@USACH:CL','','','',2,11,2),
  (923,'HOLLOWAY GRANDON','SARA BERTA','6415653-5','SARA.HOLLOWAY@USACH:CL','','','',2,21,2),
  (924,'HONORATO GUTIERREZ','GERARDO ANDRES','13467001-0','GERARDO.HONORATO@USACH:CL','','','',2,19,2),
  (925,'HUAMBACHANO RODRIGUEZ','JUAN ALBERTO','14469844-4','JUAN.HUAMBACHANO@USACH:CL','','','',2,13,2),
  (926,'HUENUQUEO MALLEO','CESAR IVAN','9920915-1','CESAR.HUENUQUEO@USACH:CL','','','',2,18,2),
  (927,'HUERTA CANCINO','LEONOR PATRICIA','11644985-4','LEONOR.HUERTA@USACH:CL','','','',2,18,2),
  (928,'HURTADO GAJARDO','EDUARDO ORLANDO','10868226-4','EDUARDO.HURTADO@USACH:CL','','','',2,5,2),
  (929,'HURTADO SEJAS','GUALBERTO JAVIER','14617510-4','GUALBERTO.HURTADO@USACH:CL','','','',2,25,2),
  (930,'IBACETA DIAZ','ANAKENA ISOLDA','7735294-5','ANAKENA.IBACETA@USACH:CL','','','',2,19,2),
  (931,'IBANEZ HENRIQUEZ','VALERIA EUGENIA','6489362-9','VALERIA.IBANEZ@USACH:CL','','','',2,25,2),
  (932,'IBANEZ NERI','ALBERTO','21865719-2','ALBERTO.IBANEZ@USACH:CL','','','',2,11,2),
  (933,'IBARRA LARA','AMERICO EDGARDO','9672985-5','AMERICO.IBARRA@USACH:CL','','','',2,23,2),
  (934,'IGLESIAS GAC','MARCELA ELIZABETH','8693085-4','MARCELA.IGLESIAS@USACH:CL','','','',2,5,2),
  (935,'IGLESIAS TORRES','CARLOS ORLANDO','12488215-K','CARLOS.IGLESIAS@USACH:CL','','','',2,34,2),
  (936,'ILABACA MOORE','MARCELA XIMENA','6875391-0','MARCELA.ILABACA@USACH:CL','','','',2,19,2),
  (937,'INDA RODRIGUEZ','ERICK FRANCISCO','10716469-3','ERICK.INDA@USACH:CL','','','',2,19,2),
  (938,'INFANTE SAZO','JOSE MIGUEL','8173824-6','JOSE.INFANTE@USACH:CL','','','',2,29,2),
  (939,'INOJOSA PACHA','YASSIM','14276818-6','YASSIM.INOJOSA@USACH:CL','','','',2,32,2),
  (940,'INOSTROZA PONTA','MARIO ROMUALDO','13043816-4','MARIO.INOSTROZA@USACH:CL','','','',2,12,2),
  (941,'INOSTROZA LAGOS','JORGE ALEJANDRO','4164525-3','JORGE.INOSTROZA@USACH:CL','','','',2,19,2),
  (942,'INTURIAS CASTELLON','RENE RAIMUNDO','12061313-8','RENE.INTURIAS@USACH:CL','','','',2,25,2),
  (943,'IRIBARREN MANRIQUEZ','ISA MILEN','13273470-4','ISA.IRIBARREN@USACH:CL','','','',2,14,2),
  (944,'IVANOVICH PAGES','JUAN FELIX NICOLAS','4523279-4','JUAN.IVANOVICH@USACH:CL','','','',2,21,2),
  (945,'JABALQUINTO LOPEZ','ANA MARIA PAZ','5710255-1','ANA.JABALQUINTO@USACH:CL','','','',2,7,2),
  (946,'JACOB DAZAROLA','RUBEN HERNAN','10624211-9','RUBEN.JACOB@USACH:CL','','','',2,36,2),
  (947,'JADUE MAGLUF','JULIA','3411740-3','JULIA.JADUE@USACH:CL','','','',2,19,2),
  (948,'JADUE ANDRIOLA','FABIOLA ANDREA','15340553-0','FABIOLA.JADUE@USACH:CL','','','',2,30,2),
  (949,'JAMETT DOMINGUEZ','MARCELA BEATRIZ','8868855-4','MARCELA.JAMETT@USACH:CL','','','',2,10,2),
  (950,'JARA MORONI','PEDRO DANIEL','9034092-1','PEDRO.JARA@USACH:CL','','','',2,22,2),
  (951,'JARA VALENCIA','JOSE LUIS','9674297-5','JOSE.JARA@USACH:CL','','','',2,12,2),
  (952,'JARA HENRIQUEZ','JOSE LUCIANO','4776990-6','JOSE.JARA@USACH:CL','','','',2,35,2),
  (953,'JARA GOMEZ','DELIA DEL CARMEN','6253826-0','DELIA.JARA@USACH:CL','','','',2,10,2),
  (954,'JARA SEGUEL','DANITZA MAGDALENA','6617176-0','DANITZA.JARA@USACH:CL','','','',2,19,2),
  (955,'JARA EWERT','PATRICIO ALBERT','6604512-9','PATRICIO.JARA@USACH:CL','','','',2,5,2),
  (956,'JARA TIRAPEGUI','WILFREDO','6028327-3','WILFREDO.JARA@USACH:CL','','','',2,13,2),
  (957,'JARA JORQUERA','CATALINA ANDREA','13924006-5','CATALINA.JARA@USACH:CL','','','',2,17,2),
  (958,'JARA VALENCIA','JAVIER ATILIO','12878111-0','JAVIER.JARA@USACH:CL','','','',2,12,2),
  (959,'JARA HERRERA','JORGE','10581465-8','JORGE.JARA@USACH:CL','','','',2,25,2),
  (960,'JASHES MORGUES','MATILDE MYRIAM','7870179-K','MATILDE.JASHES@USACH:CL','','','',2,6,2),
  (961,'JERARDINO WIESENBORN','BRUNO MAURICIO JAVIER','7065882-8','BRUNO.JERARDINO@USACH:CL','','','',2,12,2),
  (962,'JEREZ SILVA','PATRICIA EUGENIA','7381662-9','PATRICIA.JEREZ@USACH:CL','','','',2,40,2),
  (963,'JEREZ FLORES','IVAN DAGOBERTO','6286628-4','IVAN.JEREZ@USACH:CL','','','',2,13,2),
  (964,'JEREZ VENEGAS','MARTA EUGENIA','15772159-3','MARTA.JEREZ@USACH:CL','','','',2,30,2),
  (965,'JERIA CABELLO','EUGENIA DE LAS MERCEDES','6259834-4','EUGENIA.JERIA@USACH:CL','','','',2,27,2),
  (966,'JIMENEZ RAMIREZ','JAIME ANTONIO','11667471-8','JAIME.JIMENEZ@USACH:CL','','','',2,13,2),
  (967,'JIMENEZ CASTRO','JAIME OCTAVIO','4374991-9','JAIME.JIMENEZ@USACH:CL','','','',2,19,2),
  (968,'JIMENEZ CAVIERES','RODOLFO','7192652-4','RODOLFO.JIMENEZ@USACH:CL','','','',2,17,2),
  (969,'JIMENEZ MEZA','WALDO EUGENIO','6371103-9','WALDO.JIMENEZ@USACH:CL','','','',2,11,2),
  (970,'JIMENEZ ROMERO','OSCAR SEGUNDO','5467605-0','OSCAR.JIMENEZ@USACH:CL','','','',2,36,2),
  (971,'JIMENEZ OROZCO','JUAN LUIS','7540416-6','JUAN.JIMENEZ@USACH:CL','','','',2,18,2),
  (972,'JIMENEZ MOGLIA','MIRIAM ANDREA','13032178-K','MIRIAM.JIMENEZ@USACH:CL','','','',2,25,2),
  (973,'JORQUERA SALAZAR','HUMBERTO OSVALDO','4755307-5','HUMBERTO.JORQUERA@USACH:CL','','','',2,11,2),
  (974,'JORQUERA RODRIGUEZ','SERGIO ARNALDO','4469571-5','SERGIO.JORQUERA@USACH:CL','','','',2,21,2),
  (975,'JORQUERA MARTINEZ','CAROLINA PAZ','9394415-1','CAROLINA.JORQUERA@USACH:CL','','','',2,30,2),
  (976,'JORQUERA VEGA','RENE ENRIQUE','15110918-7','RENE.JORQUERA@USACH:CL','','','',2,34,2),
  (977,'JORQUERA MONTERO','FRANCISCA CONSTANZA','13255451-K','FRANCISCA.JORQUERA@USACH:CL','','','',2,34,2),
  (978,'JUICA YANTEN','CRISTOBAL FRANCISCO','15635904-1','CRISTOBAL.JUICA@USACH:CL','','','',2,12,2),
  (979,'KARL BRAVO','SEGUNDO NAPOLEON','3500038-0','SEGUNDO.KARL@USACH:CL','','','',2,19,2),
  (980,'KASCHEL CARCAMO','HECTOR OBRIEN','6518361-7','HECTOR.KASCHEL@USACH:CL','','','',2,10,2),
  (981,'KERN BASCUNAN','ANDRES EUGENIO','7673943-9','ANDRES.KERN@USACH:CL','','','',2,11,2),
  (982,'KESSRA PIZARRO','YAMILLE DIRCE','6453092-5','YAMILLE.KESSRA@USACH:CL','','','',2,25,2),
  (983,'KINKEAD BOUTIN','ANA PATRICIA','14661779-4','ANA.KINKEAD@USACH:CL','','','',2,30,2),
  (984,'KLIMPEL LILLO','SONIA MARGARITA','5621326-0','SONIA.KLIMPEL@USACH:CL','','','',2,19,2),
  (985,'KOHLER CASASEMPERE','JACQUELINE','13672509-2','JACQUELINE.KOHLER@USACH:CL','','','',2,12,2),
  (986,'KONG LAO','DOMINGO ARMANDO','5192023-6','DOMINGO.KONG@USACH:CL','','','',2,36,2),
  (987,'KOVACIC SAPUNAR','IVO YURE','8026894-7','IVO.KOVACIC@USACH:CL','','','',2,32,2),
  (988,'KRAUSE IAMPAGLIA','SUSANA','7066862-9','SUSANA.KRAUSE@USACH:CL','','','',2,11,2),
  (989,'KRI AMAR','FERNANDA ROSA','10985701-7','FERNANDA.KRI@USACH:CL','','','',2,12,2),
  (990,'KRUG DIAZ','CARLOS ADOLFO','4927265-0','CARLOS.KRUG@USACH:CL','','','',2,17,2),
  (991,'LABARCA BRIONES','RAFAEL EUSEBIO','7297443-3','RAFAEL.LABARCA@USACH:CL','','','',2,19,2),
  (992,'LABBE MORALES','RAUL SANTIAGO','6870641-6','RAUL.LABBE@USACH:CL','','','',2,18,2),
  (993,'LABBE VERGARA','BENJAMIN VLADIMIR','4754266-9','BENJAMIN.LABBE@USACH:CL','','','',2,38,2),
  (994,'LABBE GALLEGOS','OSVALDO JULIO','4490330-K','OSVALDO.LABBE@USACH:CL','','','',2,21,2),
  (995,'LAGOS AGUIRRE','CARLOS ALFONSO','7434740-1','CARLOS.LAGOS@USACH:CL','','','',2,25,2),
  (996,'LANYON OLIVARES','CARLOS ALEJANDRO','7150273-2','CARLOS.LANYON@USACH:CL','','','',2,10,2),
  (997,'LAPORTE CASTILLO','CARLOS SANDRO','5134475-8','CARLOS.LAPORTE@USACH:CL','','','',2,25,2),
  (998,'LARA AGUILERA','FRESIA ELIANA','11529138-6','FRESIA.LARA@USACH:CL','','','',2,19,2),
  (999,'LARENAS MEZA','LUIS HUMBERTO','7898982-3','LUIS.LARENAS@USACH:CL','','','',2,34,2),
  (1000,'LARRAGUIBEL FLORES','PATRICIA INES','8290270-8','PATRICIA.LARRAGUIBEL@USACH:CL','','','',2,25,2),
  (1001,'LARRAIN HUERTA','ANGELICA DEL CARMEN','8661631-9','ANGELICA.LARRAIN@USACH:CL','','','',2,27,2),
  (1002,'LARRAIN ROA','CECILIA MARGARITA','7694829-1','CECILIA.LARRAIN@USACH:CL','','','',2,19,2),
  (1003,'LARRAIN AMUNATEGUI','FRANCISCO','12020123-9','FRANCISCO.LARRAIN@USACH:CL','','','',2,25,2),
  (1004,'LASTRA ROJAS','JULIA EMA','14054233-4','JULIA.LASTRA@USACH:CL','','','',2,10,2),
  (1005,'LATORRE VALLADARES','CARLOS ALBERTO','6313928-9','CARLOS.LATORRE@USACH:CL','','','',2,10,2);
COMMIT;

/* Data for the `investigador` table  (LIMIT 1000,500) */

INSERT INTO `investigador` (`idInvestigador`, `apellidos`, `nombres`, `numeroIdentificacion`, `email`, `telefonoFijo`, `telefonoMovil`, `direccion`, `idPerfilInvestigador`, `departamento_id`, `institucion_id`) VALUES
  (1006,'LAY-SON RIVAS','LUIS ARTURO','6505562-7','LUIS.LAY-SON@USACH:CL','','','',2,25,2),
  (1007,'LAZO VASQUEZ','CARMEN ALEJANDRINA','8347952-3','CARMEN.LAZO@USACH:CL','','','',2,31,2),
  (1008,'LEIVA LOBOS','EDMUNDO PABLO','7813288-4','EDMUNDO.LEIVA@USACH:CL','','','',2,12,2),
  (1009,'LEIVA ORTIZ','JOSE MIGUEL ANGEL','9833119-0','JOSE.LEIVA@USACH:CL','','','',2,5,2),
  (1010,'LEIVA ARAVENA','LUIS ALEJANDRO','6190353-4','LUIS.LEIVA@USACH:CL','','','',2,17,2),
  (1011,'LEIVA SILVA','HECTOR ENRIQUE','4771150-9','HECTOR.LEIVA@USACH:CL','','','',2,8,2),
  (1012,'LEIVA OTAROLA','GABRIEL','4946347-2','GABRIEL.LEIVA@USACH:CL','','','',2,5,2),
  (1013,'LEIVA CORTES','NEXTOR GABRIEL','2484773-K','NEXTOR.LEIVA@USACH:CL','','','',2,5,2),
  (1014,'LEIVA PONCE','MARCO ANTONIO','10634305-5','MARCO.LEIVA@USACH:CL','','','',2,11,2),
  (1015,'LEIVA FLORES','SEBASTIAN ANTONIO','11945328-3','SEBASTIAN.LEIVA@USACH:CL','','','',2,32,2),
  (1016,'LEMUS CHAVEZ','LUIS ALBERTO','13253545-0','LUIS.LEMUS@USACH:CL','','','',2,8,2),
  (1017,'LEON ESPEJO','GREGORIO ARTURO GONZALO','5342839-8','GREGORIO.LEON@USACH:CL','','','',2,7,2),
  (1018,'LEON SOLAR','PABLO LUIS','3561650-0','PABLO.LEON@USACH:CL','','','',2,22,2),
  (1019,'LEWINSOHN CASTRO','CLAUDIA LORENA','13663471-2','CLAUDIA.LEWINSOHN@USACH:CL','','','',2,29,2),
  (1020,'LEYTON SILVA','LUCIANO DE LA CRUZ','9973736-0','LUCIANO.LEYTON@USACH:CL','','','',2,33,2),
  (1021,'LEYTON GUERRERO','EDUARDO ALEJANDRO','6784310-K','EDUARDO.LEYTON@USACH:CL','','','',2,21,2),
  (1022,'LICUIME HARATSCK','RUBEN DOMINGO','5603789-6','RUBEN.LICUIME@USACH:CL','','','',2,19,2),
  (1023,'LINCOVILO GARCIA','ANDREA ISABEL','12858377-7','ANDREA.LINCOVILO@USACH:CL','','','',2,17,2),
  (1024,'LIRA WERCHEZ','VICTOR MAURICIO','10456360-0','VICTOR.LIRA@USACH:CL','','','',2,12,2),
  (1025,'LIRA ALVAREZ','HECTOR SEVERINO','5364500-3','HECTOR.LIRA@USACH:CL','','','',2,10,2),
  (1026,'LISBOA LINEROS','JAIME RAMON','9675519-8','JAIME.LISBOA@USACH:CL','','','',2,14,2),
  (1027,'LISSI GERVASO','EDUARDO ALEJANDRO','6228819-1','EDUARDO.LISSI@USACH:CL','','','',2,7,2),
  (1028,'LIVACIC ROJAS','PABLO ESTEBAN','10520812-K','PABLO.LIVACIC@USACH:CL','','','',2,30,2),
  (1029,'LIZAMA YANEZ','CARLOS ENRIQUE','9001771-3','CARLOS.LIZAMA@USACH:CL','','','',2,19,2),
  (1030,'LLANOS ASCENCIO','JOSE LUIS','11840035-6','JOSE.LLANOS@USACH:CL','','','',2,37,2),
  (1031,'LLEDO ARAYA','PATRICIO ESTEBAN','12862966-1','PATRICIO.LLEDO@USACH:CL','','','',2,33,2),
  (1032,'LLONA RODRIGUEZ','ISABEL','6778071-K','ISABEL.LLONA@USACH:CL','','','',2,6,2),
  (1033,'LLUCH ARENAS','ELIANA DEL CARMEN','4946070-8','ELIANA.LLUCH@USACH:CL','','','',2,19,2),
  (1034,'LOBIANO YABER','JORGE RODRIGO','10013005-K','JORGE.LOBIANO@USACH:CL','','','',2,17,2),
  (1035,'LOBOS BASULTO','ALFONSO ROLANDO','4889256-6','ALFONSO.LOBOS@USACH:CL','','','',2,19,2),
  (1036,'LOBOS PEREZ','ANDRES OMAR','14498027-1','ANDRES.LOBOS@USACH:CL','','','',2,10,2),
  (1037,'LOBOS ARAVENA','PABLO ELIAS','10032642-6','PABLO.LOBOS@USACH:CL','','','',2,25,2),
  (1038,'LOPETEGUI OYARZO','FERNANDO IVAN','5932986-3','FERNANDO.LOPETEGUI@USACH:CL','','','',2,38,2),
  (1039,'LOPEZ GUERRERO','HUMBERTO FRANCISCO','8758551-4','HUMBERTO.LOPEZ@USACH:CL','','','',2,29,2),
  (1040,'LOPEZ FREIRE','SUSANA','5603905-8','SUSANA.LOPEZ@USACH:CL','','','',2,18,2),
  (1041,'LOPEZ ALEGRIA','FANNY VIVIANA','8062030-6','FANNY.LOPEZ@USACH:CL','','','',2,27,2),
  (1042,'LOPEZ LEIVA','MIGUEL HERNAN','4287333-0','MIGUEL.LOPEZ@USACH:CL','','','',2,15,2),
  (1043,'LOPEZ CATALAN','BENEDICTO SALVADOR','3409342-3','BENEDICTO.LOPEZ@USACH:CL','','','',2,19,2),
  (1044,'LOPEZ VIDAL','MARIA CECILIA','6687164-9','MARIA.LOPEZ@USACH:CL','','','',2,19,2),
  (1045,'LOPEZ VILLARROEL','VERONICA DEL CARMEN','6558606-1','VERONICA.LOPEZ@USACH:CL','','','',2,5,2),
  (1046,'LOPEZ URBINA','MARCEL RODRIGO','9356541-K','MARCEL.LOPEZ@USACH:CL','','','',2,18,2),
  (1047,'LOPEZ BECERRA','EDUARDO LOHENGRIN','9473173-9','EDUARDO.LOPEZ@USACH:CL','','','',2,6,2),
  (1048,'LOPEZ BRIONES','ROSA DE LAS MERCEDES','9910758-8','ROSA.LOPEZ@USACH:CL','','','',2,8,2),
  (1049,'LOPEZ BORGES','FELIPE ANDRES','15363271-5','FELIPE.LOPEZ@USACH:CL','','','',2,19,2),
  (1050,'LOPEZ CATALAN','PABLO ISAAC','15453225-0','PABLO.LOPEZ@USACH:CL','','','',2,5,2),
  (1051,'LOUBAT OYARCE','MARGARITA ANGELICA','5398920-9','MARGARITA.LOUBAT@USACH:CL','','','',2,30,2),
  (1052,'LOYOLA CONTRERAS','BENITA DEL CARMEN','6581655-5','BENITA.LOYOLA@USACH:CL','','','',2,10,2),
  (1053,'LOZOYA LOPEZ','IVETTE ANGELICA','14469623-9','IVETTE.LOZOYA@USACH:CL','','','',2,32,2),
  (1054,'LUCABECHE ESCHMAN','MONICA AZUCENA','7741223-9','MONICA.LUCABECHE@USACH:CL','','','',2,18,2),
  (1055,'LUCERO MUNOZ','MAURICIO ANTONIO','12637908-0','MAURICIO.LUCERO@USACH:CL','','','',2,8,2),
  (1056,'LUENGO MORENO','OSCAR FABIAN','15334984-3','OSCAR.LUENGO@USACH:CL','','','',2,17,2),
  (1057,'LUNA SARMIENTO','ANGELA DEL CARMEN','12249171-4','ANGELA.LUNA@USACH:CL','','','',2,26,2),
  (1058,'MAC-GINTY GAETE','RONALD','9133257-4','RONALD.MAC-GINTY@USACH:CL','','','',2,11,2),
  (1059,'MACHALA FERRADA','KARINA BILENA','9021017-3','KARINA.MACHALA@USACH:CL','','','',2,31,2),
  (1060,'MACHUCA ARRIAGADA','MAGALY DEL CARMEN','11486070-0','MAGALY.MACHUCA@USACH:CL','','','',2,13,2),
  (1061,'MACHUCA PEREZ','FERNANDO ANTONIO','5542033-5','FERNANDO.MACHUCA@USACH:CL','','','',2,33,2),
  (1062,'MACIA SEPULVEDA','FELIPE EMILIO','16557308-0','FELIPE.MACIA@USACH:CL','','','',2,30,2),
  (1063,'MADARIAGA MUNOZ','GONZALO FERNANDO','6292975-8','GONZALO.MADARIAGA@USACH:CL','','','',2,5,2),
  (1064,'MAGANA FRADE','IRENE VERONICA ROSA','5978164-2','IRENE.MAGANA@USACH:CL','','','',2,30,2),
  (1065,'MAHLA ALVAREZ','ADELHEID INGEBORG','6232522-4','ADELHEID.MAHLA@USACH:CL','','','',2,10,2),
  (1066,'MAHNCKE TORRES','MARGARITA DEL CARMEN','5399975-1','MARGARITA.MAHNCKE@USACH:CL','','','',2,21,2),
  (1067,'MAISEY MUNOZ','KEVIN RICARDO','11823341-7','KEVIN.MAISEY@USACH:CL','','','',2,6,2),
  (1068,'MALLOL VILLABLANCA','ENZO JAVIER','5892386-9','ENZO.MALLOL@USACH:CL','','','',2,25,2),
  (1069,'MALVERDE ESCOBAR','RODOLFO ARTURO','5127785-6','RODOLFO.MALVERDE@USACH:CL','','','',2,40,2),
  (1070,'MAMANI SORIA','JUAN FERNANDO','8613303-2','JUAN.MAMANI@USACH:CL','','','',2,25,2),
  (1071,'MANCINI RUEDA','HUMBERTO JESUS','5918578-0','HUMBERTO.MANCINI@USACH:CL','','','',2,25,2),
  (1072,'MANDLER SNAIDER','ISRAEL SIMON','5815228-5','ISRAEL.MANDLER@USACH:CL','','','',2,22,2),
  (1073,'MANNHEIM CASSIERER','RODOLFO LUIS','5190563-6','RODOLFO.MANNHEIM@USACH:CL','','','',2,14,2),
  (1074,'MANQUIAN CERDA','KAREN DE LOS ANGELES','13499021-K','KAREN.MANQUIAN@USACH:CL','','','',2,8,2),
  (1075,'MANRIQUEZ FICA','JORGE ALEJANDRO','8779537-3','JORGE.MANRIQUEZ@USACH:CL','','','',2,14,2),
  (1076,'MANZO SALAZAR','RAMON DOMINGO','4713381-5','RAMON.MANZO@USACH:CL','','','',2,13,2),
  (1077,'MANZO GARCIA','CATERINA','8576616-3','CATERINA.MANZO@USACH:CL','','','',2,30,2),
  (1078,'MARAMBIO ECHEVERRIA','HECTOR HUMBERTO','6425354-9','HECTOR.MARAMBIO@USACH:CL','','','',2,19,2),
  (1079,'MARCHANT ARCE','JUAN ANTONIO','6737907-1','JUAN.MARCHANT@USACH:CL','','','',2,12,2),
  (1080,'MARDONES CABRERA','PEDRO NOLASCO','6555689-8','PEDRO.MARDONES@USACH:CL','','','',2,14,2),
  (1081,'MARDONES RAMIREZ','LUIS HUMBERTO','4379610-0','LUIS.MARDONES@USACH:CL','','','',2,21,2),
  (1082,'MARIN ALVAREZ','PEDRO ENRIQUE','5001988-8','PEDRO.MARIN@USACH:CL','','','',2,19,2),
  (1083,'MARIN FRABASILE','SILVIA CECILIA','6551286-6','SILVIA.MARIN@USACH:CL','','','',2,36,2),
  (1084,'MARIN ESPINOZA','JORGE','5629608-5','JORGE.MARIN@USACH:CL','','','',2,14,2),
  (1085,'MARKUSOVIC MARDONES','DENIS LENKA','8167795-6','DENIS.MARKUSOVIC@USACH:CL','','','',2,5,2),
  (1086,'MARSCHHAUSEN OGALDE','MARIO ANTONIO','8315520-5','MARIO.MARSCHHAUSEN@USACH:CL','','','',2,13,2),
  (1087,'MARTICORENA ARAYA','MIGUEL FERNANDO','10700422-K','MIGUEL.MARTICORENA@USACH:CL','','','',2,30,2),
  (1088,'MARTIN QUIJADA','RODRIGO WERNER','9996123-6','RODRIGO.MARTIN@USACH:CL','','','',2,17,2),
  (1089,'MARTIN VALDIVIA','MIGUEL ANGEL','5665522-0','MIGUEL.MARTIN@USACH:CL','','','',2,34,2),
  (1090,'MARTINEZ RUIZ','RICARDO ADEMAR','9738785-0','RICARDO.MARTINEZ@USACH:CL','','','',2,17,2),
  (1091,'MARTINEZ CUEVAS','EMA GABRIELA DE TODOS LOS SANT','5704456-K','EMA.MARTINEZ@USACH:CL','','','',2,29,2),
  (1092,'MARTINEZ VALDES','CECILIA DEL CARMEN','5899042-6','CECILIA.MARTINEZ@USACH:CL','','','',2,17,2),
  (1093,'MARTINEZ CONCHA','MIGUEL NICOLAS','4680364-7','MIGUEL.MARTINEZ@USACH:CL','','','',2,19,2),
  (1094,'MARTINEZ MARTINEZ','MANUEL','5052149-4','MANUEL.MARTINEZ@USACH:CL','','','',2,8,2),
  (1095,'MARTINEZ CAMPOS','ABNER','2603471-K','ABNER.MARTINEZ@USACH:CL','','','',2,19,2),
  (1096,'MARTINEZ ROJAS','LUIS ALEXIS','5668024-1','LUIS.MARTINEZ@USACH:CL','','','',2,5,2),
  (1097,'MARTINEZ PEIRET','ANA MARIA','8639321-2','ANA.MARTINEZ@USACH:CL','','','',2,31,2),
  (1098,'MARTINEZ ROJAS','MARIO ANDRES','11625265-1','MARIO.MARTINEZ@USACH:CL','','','',2,13,2),
  (1099,'MARTINEZ URQUIZA','CLAUDIO ALEJANDRO','10283828-9','CLAUDIO.MARTINEZ@USACH:CL','','','',2,37,2),
  (1100,'MARTINEZ AHUMADA','RAMON CRISTIAN','10218331-2','RAMON.MARTINEZ@USACH:CL','','','',2,23,2),
  (1101,'MARTINEZ RIVERA','MANUEL','13256774-3','MANUEL.MARTINEZ@USACH:CL','','','',2,11,2),
  (1102,'MARTNER FANTA','GONZALO DANIEL','7514846-1','GONZALO.MARTNER@USACH:CL','','','',2,23,2),
  (1103,'MATELUNA ACEVEDO','ARGENTINA DEL CARMEN','4775899-8','ARGENTINA.MATELUNA@USACH:CL','','','',2,38,2),
  (1104,'MATELUNA HERNANDEZ','CRISTIAN FABIAN','16032334-5','CRISTIAN.MATELUNA@USACH:CL','','','',2,11,2),
  (1105,'MATTA PALACIOS','ALICIA ANTONIETA','14167514-1','ALICIA.MATTA@USACH:CL','','','',2,35,2),
  (1106,'MATTE HIRIART','JORGE','6693606-6','JORGE.MATTE@USACH:CL','','','',2,25,2),
  (1107,'MATURANA QUIJADA','MARTA VERONICA','7938384-8','MARTA.MATURANA@USACH:CL','','','',2,26,2),
  (1108,'MATURANA ZENTENO','MARIA SOLEDAD','8108874-8','MARIA.MATURANA@USACH:CL','','','',2,15,2),
  (1109,'MATURANA COURDURIER','PAMELA EUGENIA','9496287-0','PAMELA.MATURANA@USACH:CL','','','',2,30,2),
  (1110,'MATUS VARGAS','CRISTOFER ANTONIO','17106573-9','CRISTOFER.MATUS@USACH:CL','','','',2,25,2),
  (1111,'MATUS CORREA','CLAUDIA VICTORIA','6753730-0','CLAUDIA.MATUS@USACH:CL','','','',2,19,2),
  (1112,'MATUS PEREZ','OMAR EVARISTO','10838169-8','OMAR.MATUS@USACH:CL','','','',2,11,2),
  (1113,'MATUS ARANEDA','JUAN DANIEL','9230286-5','JUAN.MATUS@USACH:CL','','','',2,19,2),
  (1114,'MATUTE CARVAJAL','ERNESTO ABRAHAM','6207488-4','ERNESTO.MATUTE@USACH:CL','','','',2,18,2),
  (1115,'MAUERSBERGER STEIN','HEINZ WOLFGANG','14935372-0','HEINZ.MAUERSBERGER@USACH:CL','','','',2,25,2),
  (1116,'MAUREIRA GALVEZ','JUAN ANTONIO','5325079-3','JUAN.MAUREIRA@USACH:CL','','','',2,10,2),
  (1117,'MAURO MORALES','ALVARO DEL TRANSITO','4936792-9','ALVARO.MAURO@USACH:CL','','','',2,35,2),
  (1118,'MAYA PIZARRO','ANA VERONICA','12420128-4','ANA.MAYA@USACH:CL','','','',2,10,2),
  (1119,'MAYORGA SARIEGO','NELSON EDUARDO','5954222-2','NELSON.MAYORGA@USACH:CL','','','',2,18,2),
  (1120,'MEBOLD PORTALES','JOSE FERNANDO ALEJANDRO','4515231-6','JOSE.MEBOLD@USACH:CL','','','',2,25,2),
  (1121,'MEDINA PINA','ELIZABETH MYRIAM','7983430-0','ELIZABETH.MEDINA@USACH:CL','','','',2,29,2),
  (1122,'MEDINA DAVILA','PABLO ANDRES','13129882-K','PABLO.MEDINA@USACH:CL','','','',2,34,2),
  (1123,'MEDINA TAPIA','MARCOS CRISTIAN ANTONIO','13234511-2','MARCOS.MEDINA@USACH:CL','','','',2,35,2),
  (1124,'MELENDEZ HERNANDEZ','MARCIA DE LAS NIEVES','9618858-7','MARCIA.MELENDEZ@USACH:CL','','','',2,18,2),
  (1125,'MELGAREJO REYES','KATHERINE VANESA','16268566-K','KATHERINE.MELGAREJO@USACH:CL','','','',2,38,2),
  (1126,'MELLA POLANCO','JUAN MARCELO','11367207-2','JUAN.MELLA@USACH:CL','','','',2,32,2),
  (1127,'MELLADO MUNOZ','MANUEL MAURICIO','14602874-8','MANUEL.MELLADO@USACH:CL','','','',2,17,2),
  (1128,'MELLADO ESPINOZA','MIGUEL ANGEL','7542167-2','MIGUEL.MELLADO@USACH:CL','','','',2,34,2),
  (1129,'MELO HURTADO','FRANCISCO ESTEBAN','8016472-6','FRANCISCO.MELO@USACH:CL','','','',2,18,2),
  (1130,'MELO BENAVIDES','MARIA ALEJANDRA','5619910-1','MARIA.MELO@USACH:CL','','','',2,8,2),
  (1131,'MENA MIRANDA','LUIS EDMUNDO','9414632-1','LUIS.MENA@USACH:CL','','','',2,30,2),
  (1132,'MENA BARTIERRA','SUSAN HELEN','16241322-8','SUSAN.MENA@USACH:CL','','','',2,30,2),
  (1133,'MENDEZ VASQUEZ','JULIO RENE','8112971-1','JULIO.MENDEZ@USACH:CL','','','',2,34,2),
  (1134,'MENDEZ FERRADA','FERNANDO ANTONIO','11745688-9','FERNANDO.MENDEZ@USACH:CL','','','',2,18,2),
  (1135,'MENDEZ IRRAZABAL','CLAUDIO ERNESTO','7388348-2','CLAUDIO.MENDEZ@USACH:CL','','','',2,5,2),
  (1136,'MENDEZ DIAZ','DIEGO IGNACIO','16359696-2','DIEGO.MENDEZ@USACH:CL','','','',2,30,2),
  (1137,'MENDEZ HERNANDEZ','MARIA JOSE','13270214-4','MARIA.MENDEZ@USACH:CL','','','',2,36,2),
  (1138,'MENDOZA MENDOZA','ROSITA NATALIA','14165574-4','ROSITA.MENDOZA@USACH:CL','','','',2,26,2),
  (1139,'MENDOZA MUNOZ','DIOCLES ARMANDO','5394478-7','DIOCLES.MENDOZA@USACH:CL','','','',2,36,2),
  (1140,'MENDOZA CAMUS','LUIS ARMANDO','7297534-0','LUIS.MENDOZA@USACH:CL','','','',2,13,2),
  (1141,'MENDOZA GONZALEZ','LIDA MARIA','22724031-8','LIDA.MENDOZA@USACH:CL','','','',2,19,2),
  (1142,'MENESES ZAMBRANO','SARA ROSA','12256812-1','SARA.MENESES@USACH:CL','','','',2,12,2),
  (1143,'MENESES ZAMBRANO','EDITH MAGALY','13036496-9','EDITH.MENESES@USACH:CL','','','',2,11,2),
  (1144,'MENESES ARZOLA','ROSARIO DEL CARMEN','7984899-9','ROSARIO.MENESES@USACH:CL','','','',2,19,2),
  (1145,'MERA CORREA','MARTA GABRIELA','9667381-7','MARTA.MERA@USACH:CL','','','',2,31,2),
  (1146,'MERINO ACEVEDO','JOSE PABLO','13052272-6','JOSE.MERINO@USACH:CL','','','',2,13,2),
  (1147,'MERY OLIVARES','MARIA LORETO DEL CARMEN','5710657-3','MARIA.MERY@USACH:CL','','','',2,18,2),
  (1148,'MERY CAMPOSANO','PATRICIA DEL CARMEN','6067323-3','PATRICIA.MERY@USACH:CL','','','',2,34,2),
  (1149,'MESSEN HINOSTROZA','RICARDO MIGUEL','5637696-8','RICARDO.MESSEN@USACH:CL','','','',2,25,2),
  (1150,'MEZA LAGOS','MANUEL ANTONIO','7928915-9','MANUEL.MEZA@USACH:CL','','','',2,18,2),
  (1151,'MEZA ESPINOZA','MARTA YANET','7959171-8','MARTA.MEZA@USACH:CL','','','',2,27,2),
  (1152,'MICHEL ARAYA','FABIOLA IVETTE','16121618-6','FABIOLA.MICHEL@USACH:CL','','','',2,6,2),
  (1153,'MICHEL MICHEL','RICARDO JORGE','4780644-5','RICARDO.MICHEL@USACH:CL','','','',2,36,2),
  (1154,'MICHELI SAAVEDRA','HUMBERTO GREGORIO LORENZO','3463768-7','HUMBERTO.MICHELI@USACH:CL','','','',2,15,2),
  (1155,'MIHOVILOVICH CONTRERAS','MARTIN ELEAZAR','6383378-9','MARTIN.MIHOVILOVICH@USACH:CL','','','',2,21,2),
  (1156,'MILLAN PEREZ','LUIS AGUSTIN','4102179-9','LUIS.MILLAN@USACH:CL','','','',2,10,2),
  (1157,'MILOS MENDEZ','IVAN ANDRES','7745633-3','IVAN.MILOS@USACH:CL','','','',2,30,2),
  (1158,'MINO MINO','TIRSO ANGEL','5752029-9','TIRSO.MINO@USACH:CL','','','',2,5,2),
  (1159,'MIRANDA MORTTON','CHRISTIAN HENRY','9032580-9','CHRISTIAN.MIRANDA@USACH:CL','','','',2,11,2),
  (1160,'MIRANDA OLIVOS','EUGENIO FERNANDO','5122359-4','EUGENIO.MIRANDA@USACH:CL','','','',2,18,2),
  (1161,'MIRANDA GUERRERO','SOLEDAD DEL CARMEN','6873686-2','SOLEDAD.MIRANDA@USACH:CL','','','',2,12,2),
  (1162,'MIRANDA CABALLERO','RODRIGO','2694081-8','RODRIGO.MIRANDA@USACH:CL','','','',2,25,2),
  (1163,'MIRANDA SALINAS','MOISES ALBERTO','5324209-K','MOISES.MIRANDA@USACH:CL','','','',2,19,2),
  (1164,'MIRANDA ARREDONDO','PALOMA ESPERANZA DEL PILAR','14579900-7','PALOMA.MIRANDA@USACH:CL','','','',2,32,2),
  (1165,'MIRANDA ALLENDE','CARLOS RODRIGO','14318491-9','CARLOS.MIRANDA@USACH:CL','','','',2,12,2),
  (1166,'MIRANDA DIAZ','MARLEN ANDREA','16340328-5','MARLEN.MIRANDA@USACH:CL','','','',2,31,2),
  (1167,'MITROVICH GARCIA','DINKO ALEJANDRO','9858508-7','DINKO.MITROVICH@USACH:CL','','','',2,19,2),
  (1168,'MOLINA SOTO','GREDYS DEL CARMEN','8727351-2','GREDYS.MOLINA@USACH:CL','','','',2,21,2),
  (1169,'MOLINA CASTRO','RAUL PATRICIO','7077302-3','RAUL.MOLINA@USACH:CL','','','',2,15,2),
  (1170,'MOLINA FUENZALIDA','JOSE RAMON','6080320-K','JOSE.MOLINA@USACH:CL','','','',2,40,2),
  (1171,'MOLINA FUENZALIDA','HECTOR EDUARDO','7108444-2','HECTOR.MOLINA@USACH:CL','','','',2,40,2),
  (1172,'MOLINA GONZALEZ','SNIDER JAVIER','22741031-0','SNIDER.MOLINA@USACH:CL','','','',2,11,2),
  (1173,'MONCADA CORTES','RODRIGO ERNESTO','13836900-5','RODRIGO.MONCADA@USACH:CL','','','',2,10,2),
  (1174,'MONDACA MONDACA','CESAR MANUEL','9903895-0','CESAR.MONDACA@USACH:CL','','','',2,31,2),
  (1175,'MONETTA MOREIRA','JUAN CARLOS','6002550-9','JUAN.MONETTA@USACH:CL','','','',2,10,2),
  (1176,'MONJE AGUERO','ELISABET DEL TRANSITO','5933241-4','ELISABET.MONJE@USACH:CL','','','',2,26,2),
  (1177,'MONREAL CAAMANO','ELCIRA DEL CARMEN','4489595-1','ELCIRA.MONREAL@USACH:CL','','','',2,10,2),
  (1178,'MONROY CIFUENTES','SERGIO ROLANDO','3555454-8','SERGIO.MONROY@USACH:CL','','','',2,11,2),
  (1179,'MONROY VERA','FERNANDO ALFREDO','14564620-0','FERNANDO.MONROY@USACH:CL','','','',2,37,2),
  (1180,'MONSALVE RETAMAL','MARIA HERMOSINA','5895478-0','MARIA.MONSALVE@USACH:CL','','','',2,19,2),
  (1181,'MONTALDO LORCA','GUSTAVO ADRIAN','5574735-0','GUSTAVO.MONTALDO@USACH:CL','','','',2,25,2),
  (1182,'MONTANO ESPINOZA','ROSA MYRIAM','9582385-8','ROSA.MONTANO@USACH:CL','','','',2,19,2),
  (1183,'MONTERO LAGOS','PATRICIO BENJAMIN','4855087-8','PATRICIO.MONTERO@USACH:CL','','','',2,19,2),
  (1184,'MONTERO SILVA','LUIS','6998665-K','LUIS.MONTERO@USACH:CL','','','',2,25,2),
  (1185,'MONTES SOTOMAYOR','SERGIO GONZALO','4756566-9','SERGIO.MONTES@USACH:CL','','','',2,8,2),
  (1186,'MONTESINO JEREZ','JOSE LEOPOLDO','7366354-7','JOSE.MONTESINO@USACH:CL','','','',2,22,2),
  (1187,'MONTT VEAS','CECILIA ANTONIETA','6365984-3','CECILIA.MONTT@USACH:CL','','','',2,11,2),
  (1188,'MORA CHACON','ELIZABETH XIMENA','9582480-3','ELIZABETH.MORA@USACH:CL','','','',2,33,2),
  (1189,'MORA CANCINO','VICTOR MAURICIO','15148391-7','VICTOR.MORA@USACH:CL','','','',2,17,2),
  (1190,'MORAGA RODRIGUEZ','EDITH DEL CARMEN','5816522-0','EDITH.MORAGA@USACH:CL','','','',2,35,2),
  (1191,'MORAGA MALDONADO','MARIANELA TERESA','6978111-K','MARIANELA.MORAGA@USACH:CL','','','',2,38,2),
  (1192,'MORAGA ESPINOZA','ANA PAULINA','14044065-5','ANA.MORAGA@USACH:CL','','','',2,19,2),
  (1193,'MORALES GAMBONI','JORGE LEONARDO','8541210-8','JORGE.MORALES@USACH:CL','','','',2,37,2),
  (1194,'MORALES MORALES','HECTOR DANILO','8314659-1','HECTOR.MORALES@USACH:CL','','','',2,15,2),
  (1195,'MORALES MORA','JEANNETTE DEL CARMEN','10647534-2','JEANNETTE.MORALES@USACH:CL','','','',2,33,2),
  (1196,'MORALES MAURIZ','HUGO ADOLFO','5132554-0','HUGO.MORALES@USACH:CL','','','',2,25,2),
  (1197,'MORALES MORALES','ALICIA YOLANDA','6700437-K','ALICIA.MORALES@USACH:CL','','','',2,5,2),
  (1198,'MORALES NAVARRO','MARIO ANTONIO','6587571-3','MARIO.MORALES@USACH:CL','','','',2,30,2),
  (1199,'MORALES LIZANA','JOSE ENRIQUE','3895150-5','JOSE.MORALES@USACH:CL','','','',2,13,2),
  (1200,'MORALES PERALTA','JIMENA DEL CARMEN','7100948-3','JIMENA.MORALES@USACH:CL','','','',2,17,2),
  (1201,'MORALES RIOS','MYRIAM ERIKA','7201675-0','MYRIAM.MORALES@USACH:CL','','','',2,18,2),
  (1202,'MORALES NEJAZ','DANIVER ANTONIO','11843633-4','DANIVER.MORALES@USACH:CL','','','',2,6,2),
  (1203,'MORALES SEPULVEDA','NELSON HUMBERTO','9077046-2','NELSON.MORALES@USACH:CL','','','',2,23,2),
  (1204,'MORALES REYES','CRISTINA FABIOLA','14184259-5','CRISTINA.MORALES@USACH:CL','','','',2,8,2),
  (1205,'MORALES PINO','JOSE ANTONIO','10279802-3','JOSE.MORALES@USACH:CL','','','',2,25,2),
  (1206,'MORALES SANTOS','EDUARDO DEL CARMEN','3509638-8','EDUARDO.MORALES@USACH:CL','','','',2,10,2),
  (1207,'MORALES PARRA','NICOLE DENISSE RUTH','16931956-1','NICOLE.MORALES@USACH:CL','','','',2,36,2),
  (1208,'MORENO VELASQUEZ','LUIS ALBERTO','5437323-6','LUIS.MORENO@USACH:CL','','','',2,5,2),
  (1209,'MORENO VELASQUEZ','EUSEBIO ENRIQUE','7256621-1','EUSEBIO.MORENO@USACH:CL','','','',2,5,2),
  (1210,'MORENO HERRERA','FRANCISCO FELIPE','11946962-7','FRANCISCO.MORENO@USACH:CL','','','',2,19,2),
  (1211,'MORENO LOYOLA','MAURICIO ANDRES','13047672-4','MAURICIO.MORENO@USACH:CL','','','',2,34,2),
  (1212,'MORENO GONZALEZ','ERIKA TATIANA','12775705-4','ERIKA.MORENO@USACH:CL','','','',2,30,2),
  (1213,'MORGADO ALCAYAGA','JUAN ENRIQUE','4958569-1','JUAN.MORGADO@USACH:CL','','','',2,25,2),
  (1214,'MORIS IBANEZ','MAKARENA','13923379-4','MAKARENA.MORIS@USACH:CL','','','',2,30,2),
  (1215,'MOSCOSO MATEUS','JULIO ARMANDO','14597410-0','JULIO.MOSCOSO@USACH:CL','','','',2,25,2),
  (1216,'MOYA MARTINEZ','RAFAEL ANDRES','13446229-9','RAFAEL.MOYA@USACH:CL','','','',2,18,2),
  (1217,'MOYA DURAN','SERGIO ANTONIO','4341686-3','SERGIO.MOYA@USACH:CL','','','',2,8,2),
  (1218,'MUNOZ RIQUELME','SARA IRENE','8616204-0','SARA.MUNOZ@USACH:CL','','','',2,25,2),
  (1219,'MUNOZ ROMERO','HECTOR GUILLERMO','8561966-7','HECTOR.MUNOZ@USACH:CL','','','',2,13,2),
  (1220,'MUNOZ CALANCHIE','ROSA DEL CARMEN','7765749-5','ROSA.MUNOZ@USACH:CL','','','',2,12,2),
  (1221,'MUNOZ CARO','JORGE ARTURO','8063652-0','JORGE.MUNOZ@USACH:CL','','','',2,11,2),
  (1222,'MUNOZ MELINIR','EVELYN DEL CARMEN','13662116-5','EVELYN.MUNOZ@USACH:CL','','','',2,34,2),
  (1223,'MUNOZ CONTRERAS','MARION DE LAS MERCEDES','5627915-6','MARION.MUNOZ@USACH:CL','','','',2,30,2),
  (1224,'MUNOZ OROSTICA','BERNARDA DEL CARMEN','6008735-0','BERNARDA.MUNOZ@USACH:CL','','','',2,36,2),
  (1225,'MUNOZ CORREA','JUAN GUILLERMO','4662242-1','JUAN.MUNOZ@USACH:CL','','','',2,32,2),
  (1226,'MUNOZ CASTILLO','PEDRO BARTOLOME','5072352-6','PEDRO.MUNOZ@USACH:CL','','','',2,33,2),
  (1227,'MUNOZ PAREDES','CARLOS ALBERTO','5075537-1','CARLOS.MUNOZ@USACH:CL','','','',2,10,2),
  (1228,'MUNOZ CISTERNAS','RICARDO MAXIMILIANO','7148221-9','RICARDO.MUNOZ@USACH:CL','','','',2,37,2),
  (1229,'MUNOZ BANARES','JUAN GUILLERMO','7436045-9','JUAN.MUNOZ@USACH:CL','','','',2,11,2),
  (1230,'MUNOZ FARIAS','BENITO','3928629-7','BENITO.MUNOZ@USACH:CL','','','',2,36,2),
  (1231,'MUNOZ VILLALOBOS','ALVARO ORLANDO','6506680-7','ALVARO.MUNOZ@USACH:CL','','','',2,11,2),
  (1232,'MUNOZ FAUNDEZ','JAIME ANTONIO','5819501-4','JAIME.MUNOZ@USACH:CL','','','',2,10,2),
  (1233,'MUNOZ DE LA PARRA','SERGIO','5636929-5','SERGIO.MUNOZ@USACH:CL','','','',2,17,2),
  (1234,'MUNOZ CASTILLO','HILDA CAROLINA PAMELA ROXANA','7837367-9','HILDA.MUNOZ@USACH:CL','','','',2,29,2),
  (1235,'MUNOZ MANRIQUEZ','LUIS NAZARIO','7363986-7','LUIS.MUNOZ@USACH:CL','','','',2,13,2),
  (1236,'MUNOZ JARA','MIGUEL ANGEL','12269927-7','MIGUEL.MUNOZ@USACH:CL','','','',2,19,2),
  (1237,'MUNOZ LAGOS','VICTOR RODRIGO','12486689-8','VICTOR.MUNOZ@USACH:CL','','','',2,36,2),
  (1238,'MUNOZ CAMPOS','BEATRIZ SOLANGE','13931863-3','BEATRIZ.MUNOZ@USACH:CL','','','',2,30,2),
  (1239,'MUNOZ VERA','NICOLAS ANDRES','15894035-3','NICOLAS.MUNOZ@USACH:CL','','','',2,30,2),
  (1240,'MUNOZ BARRIOS','PATRICIO ALBERTO','15843032-0','PATRICIO.MUNOZ@USACH:CL','','','',2,30,2),
  (1241,'MUNOZ ALVARADO','WILLY ALEJANDRO','15345833-2','WILLY.MUNOZ@USACH:CL','','','',2,17,2),
  (1242,'MUNOZ SOLIS','MARIA JOSE','15546843-2','MARIA.MUNOZ@USACH:CL','','','',2,30,2),
  (1243,'MUNOZ RAMIREZ','JANINA PAOLA ANDREA','13274183-2','JANINA.MUNOZ@USACH:CL','','','',2,34,2),
  (1244,'MUNOZ MIRANDA','MAURICIO ANTONIO','10838195-7','MAURICIO.MUNOZ@USACH:CL','','','',2,25,2),
  (1245,'MUNOZ ZUNIGA','PATRICIA ELENA','13695566-7','PATRICIA.MUNOZ@USACH:CL','','','',2,14,2),
  (1246,'MUNOZ ILABACA','MABEL ALICIA','13045773-8','MABEL.MUNOZ@USACH:CL','','','',2,32,2),
  (1247,'NACARATTE NACARATTE','JUDITH ALEJANDRA','15706513-0','JUDITH.NACARATTE@USACH:CL','','','',2,33,2),
  (1248,'NADER NASER','GERMAN ORLANDO','6870539-8','GERMAN.NADER@USACH:CL','','','',2,5,2),
  (1249,'NADINIC CRUZ','MLADEN WILLIAMS','11472974-4','MLADEN.NADINIC@USACH:CL','','','',2,19,2),
  (1250,'NAPOLITANO RISPOLLI','CAYETANO ENRIQUE','6404198-3','CAYETANO.NAPOLITANO@USACH:CL','','','',2,25,2),
  (1251,'NARVAEZ FLIES','IVONNE ALEJANDRA','13100902-K','IVONNE.NARVAEZ@USACH:CL','','','',2,25,2),
  (1252,'NAUDY PACHECO','LUIS EDUARDO','7725987-2','LUIS.NAUDY@USACH:CL','','','',2,19,2),
  (1253,'NAVARRETE BURGOS','ROGELIO','5929271-4','ROGELIO.NAVARRETE@USACH:CL','','','',2,21,2),
  (1254,'NAVARRO MORA','JESSICA ALEJANDRA','17248926-5','JESSICA.NAVARRO@USACH:CL','','','',2,36,2),
  (1255,'NEGRETE ZAMORANO','CATALINA MATILDE','6615240-5','CATALINA.NEGRETE@USACH:CL','','','',2,38,2),
  (1256,'NEGRETE ROMO','MARIA EUGENIA DEL CARMEN','5787526-7','MARIA.NEGRETE@USACH:CL','','','',2,19,2),
  (1257,'NEIRA LORCA','MARIA PETRONILA','9186650-1','MARIA.NEIRA@USACH:CL','','','',2,15,2),
  (1258,'NELSON HUNT','PABLO ANDRES','10931013-1','PABLO.NELSON@USACH:CL','','','',2,6,60),
  (1259,'NUNEZ SANCHEZ','JULIETA IVONNE','12238531-0','JULIETA.NUNEZ@USACH:CL','','','',2,5,2),
  (1260,'NUNEZ CARRASCO','ELIZABETH ROCIO','13664255-3','ELIZABETH.NUNEZ@USACH:CL','','','',2,26,2),
  (1261,'NUNEZ GONZALEZ','SARA DEL ROSARIO','6671353-9','SARA.NUNEZ@USACH:CL','','','',2,18,2),
  (1262,'NUNEZ GOMEZ','HERNAN ALFREDO','5366139-4','HERNAN.NUNEZ@USACH:CL','','','',2,11,2),
  (1263,'NUNEZ CANCINO','HUGO FERNANDO','6551096-0','HUGO.NUNEZ@USACH:CL','','','',2,35,2),
  (1264,'NUNEZ RODRIGUEZ','CARLOS EDUARDO','9746477-4','CARLOS.NUNEZ@USACH:CL','','','',2,5,2),
  (1265,'NUNEZ VELIZ','LORETO ANDREA','12642110-9','LORETO.NUNEZ@USACH:CL','','','',2,31,2),
  (1266,'NUNEZ LAGOS','CLAUDIO','9483191-1','CLAUDIO.NUNEZ@USACH:CL','','','',2,25,2),
  (1267,'OCHOA MORENO','JORGE','2633646-5','JORGE.OCHOA@USACH:CL','','','',2,30,2),
  (1268,'ODDERSHEDE HERRERA','ASTRID MARIA BRUNILDA','5388872-0','ASTRID.ODDERSHEDE@USACH:CL','','','',2,11,2),
  (1269,'OJEDA REYES','OSVALDO FRANCISCO','4224499-6','OSVALDO.OJEDA@USACH:CL','','','',2,10,2),
  (1270,'OLATE BARRA','EVELYN OLIMPIA','9932396-5','EVELYN.OLATE@USACH:CL','','','',2,36,2),
  (1271,'OLAVARRIA ARAVENA','SERGIO ANTONIO','6731073-K','SERGIO.OLAVARRIA@USACH:CL','','','',2,33,2),
  (1272,'OLGUI MARCHANT','NICOLAS LEOPOLDO','8638762-K','NICOLAS.OLGUI@USACH:CL','','','',2,13,2),
  (1273,'OLGUI DINATOR','MARIA ROSA','7041916-5','MARIA.OLGUI@USACH:CL','','','',2,25,2),
  (1274,'OLGUIN PIZARRO','ALEJANDRA ANDREA','14499174-5','ALEJANDRA.OLGUIN@USACH:CL','','','',2,25,2),
  (1275,'OLGUIN PARADA','GABRIEL MAURICIO','8534704-7','GABRIEL.OLGUIN@USACH:CL','','','',2,10,2),
  (1276,'OLGUIN MONRAS','FERNANDO ANTONIO','8564547-1','FERNANDO.OLGUIN@USACH:CL','','','',2,25,2),
  (1277,'OLIVA REID','JORGE ANDRES','15924479-2','JORGE.OLIVA@USACH:CL','','','',2,25,2),
  (1278,'OLIVARES ROJAS','GLADYS CECILIA','9608249-5','GLADYS.OLIVARES@USACH:CL','','','',2,14,2),
  (1279,'OLIVARES BAHAMONDES','IGNACIO ENRIQUE','7497813-4','IGNACIO.OLIVARES@USACH:CL','','','',2,18,2),
  (1280,'OLIVARES CHIAPPA','VICTOR EDUARDO','7580843-7','VICTOR.OLIVARES@USACH:CL','','','',2,11,2),
  (1281,'OLIVARES CORTES','GIL ENRIQUE','4624518-0','GIL.OLIVARES@USACH:CL','','','',2,33,2),
  (1282,'OLIVARES POWER','OSVALDO ALFONSO','5075563-0','OSVALDO.OLIVARES@USACH:CL','','','',2,25,2),
  (1283,'OLIVARES GODOY','EFRAIN RICARDO','6702124-K','EFRAIN.OLIVARES@USACH:CL','','','',2,35,2),
  (1284,'OLIVARES ROJAS','CLAUDIO ALEJANDRO','9388948-7','CLAUDIO.OLIVARES@USACH:CL','','','',2,13,2),
  (1285,'OLIVARES ESPINOZA','BARBARA ROCIO','13979532-6','BARBARA.OLIVARES@USACH:CL','','','',2,30,2),
  (1286,'OLIVARES ALTAMIRANO','MARTIN OCTAVIO','12663470-6','MARTIN.OLIVARES@USACH:CL','','','',2,35,2),
  (1287,'OLIVARES FLORES','JUAN JOSE','6893684-5','JUAN.OLIVARES@USACH:CL','','','',2,25,2),
  (1288,'OLMEDO QUEVEDO','ELIZABETH MARGARITA','15370916-5','ELIZABETH.OLMEDO@USACH:CL','','','',2,25,2),
  (1289,'OPAZO CARVAJAL','PAMELA ANDREA','10335629-6','PAMELA.OPAZO@USACH:CL','','','',2,34,2),
  (1290,'OPAZO LOBOS','KAREM FABIOLA','13281691-3','KAREM.OPAZO@USACH:CL','','','',2,17,2),
  (1291,'ORDEN VARGAS','GIANNINA MACARENA','15778250-9','GIANNINA.ORDEN@USACH:CL','','','',2,30,2),
  (1292,'ORDONEZ ','STELLA MARIS','14650630-5','STELLA.ORDONEZ@USACH:CL','','','',2,14,2),
  (1293,'ORELLANA SANDOVAL','JAZMIN DE LAS MERCEDES','9668456-8','JAZMIN.ORELLANA@USACH:CL','','','',2,37,2),
  (1294,'ORELLANA ALVEAR','REINALDO ALBERTO','10383335-3','REINALDO.ORELLANA@USACH:CL','','','',2,30,2),
  (1295,'ORELLANA LOBOS','ANTONIO ERNESTO','4748756-0','ANTONIO.ORELLANA@USACH:CL','','','',2,19,2),
  (1296,'ORELLANA CAMPOS','CAROLINA LIU','10601330-6','CAROLINA.ORELLANA@USACH:CL','','','',2,25,2),
  (1297,'ORMENO AGUIRRE','MARIA ISABEL','5865786-7','MARIA.ORMENO@USACH:CL','','','',2,18,2),
  (1298,'ORMENO MILLA','FABIAN CLAUDIO','8049995-7','FABIAN.ORMENO@USACH:CL','','','',2,37,2),
  (1299,'ORMENO CORONADO','BARBARA XIMENA','9201891-1','BARBARA.ORMENO@USACH:CL','','','',2,36,2),
  (1300,'OROSTEGUI MARTINEZ','HECTOR SOLANO','5250782-0','HECTOR.OROSTEGUI@USACH:CL','','','',2,10,2),
  (1301,'ORQUERA CRUZ','LUIS JAVIER','7923276-9','LUIS.ORQUERA@USACH:CL','','','',2,11,2),
  (1302,'ORREGO BARRIOS','CLAUDIO ENRIQUE','10929238-9','CLAUDIO.ORREGO@USACH:CL','','','',2,15,2),
  (1303,'ORREGO BARRIOS','ADRIAN JESUS','5529939-0','ADRIAN.ORREGO@USACH:CL','','','',2,14,2),
  (1304,'ORREGO HUERTA','LUIS ALBERTO','1710052-1','LUIS.ORREGO@USACH:CL','','','',2,33,2),
  (1305,'ORREGO ESCOBAR','EDUARDO FREDDY','14590470-6','EDUARDO.ORREGO@USACH:CL','','','',2,6,2),
  (1306,'ORTEGA MUNOZ','PEDRO ANGEL','3917133-3','PEDRO.ORTEGA@USACH:CL','','','',2,23,2),
  (1307,'ORTEGA MARTINEZ','LUIS MARCELO ALBERTO','6408584-0','LUIS.ORTEGA@USACH:CL','','','',2,32,2),
  (1308,'ORTEGA BUSTAMANTE','ROXANA ISABEL','10080892-7','ROXANA.ORTEGA@USACH:CL','','','',2,33,2),
  (1309,'ORTEGA TAPIA','LUIS MARCELO','14154005-K','LUIS.ORTEGA@USACH:CL','','','',2,6,2),
  (1310,'ORTEGA BARO','ALICIA PALOMA','13280183-5','ALICIA.ORTEGA@USACH:CL','','','',2,30,2),
  (1311,'ORTEGA ARAYA','CLAUDIA ANDREA','12545381-3','CLAUDIA.ORTEGA@USACH:CL','','','',2,25,2),
  (1312,'ORTIZ NAVARRETE','LUIS ORLANDO DE JESUS','4864161-K','LUIS.ORTIZ@USACH:CL','','','',2,10,2),
  (1313,'ORTIZ FARIAS','JUAN ENRIQUE','4101127-0','JUAN.ORTIZ@USACH:CL','','','',2,8,2),
  (1314,'ORTIZ AVILES','MIGUEL ANGEL','5321896-2','MIGUEL.ORTIZ@USACH:CL','','','',2,34,2),
  (1315,'ORTIZ RIVAS','DENNIS ESTEBAN','10352430-K','DENNIS.ORTIZ@USACH:CL','','','',2,5,2),
  (1316,'ORTIZ DIAZ','PABLO JAVIER','9918153-2','PABLO.ORTIZ@USACH:CL','','','',2,23,2),
  (1317,'ORTUVIA CARRIZO','GUSTAVO ADOLFO','7428649-6','GUSTAVO.ORTUVIA@USACH:CL','','','',2,25,2),
  (1318,'OSORIO SANTELICES','SERGIO FELIPE','14121164-1','SERGIO.OSORIO@USACH:CL','','','',2,36,2),
  (1319,'OSORIO RIQUELME','CLEMIRA DEL TRANSITO','5713298-1','CLEMIRA.OSORIO@USACH:CL','','','',2,11,2),
  (1320,'OSORIO RIQUELME','CLARA LUZ','4106477-3','CLARA.OSORIO@USACH:CL','','','',2,27,2),
  (1321,'OSORIO VALENZUELA','LUIS DAVID','13764138-0','LUIS.OSORIO@USACH:CL','','','',2,10,2),
  (1322,'OSORIO ROMAN','IGOR ORLANDO','13483186-3','IGOR.OSORIO@USACH:CL','','','',2,7,2),
  (1323,'OSSANDON BULJEVIC','BARBARA LUCRECIA','6069597-0','BARBARA.OSSANDON@USACH:CL','','','',2,18,2),
  (1324,'OSSES MC INTYRE','MONICA LAURA','11477605-K','MONICA.OSSES@USACH:CL','','','',2,25,2),
  (1325,'OSSES SAGREDO','LEONIDAS ALBERTO','5026059-3','LEONIDAS.OSSES@USACH:CL','','','',2,8,2),
  (1326,'OTAROLA ARPOULET','ISABEL CRISTINA','10449308-4','ISABEL.OTAROLA@USACH:CL','','','',2,19,2),
  (1327,'OTAROLA LATORRE','NATALIA LISSETTE','16297371-1','NATALIA.OTAROLA@USACH:CL','','','',2,30,2),
  (1328,'OTEGUI PARRA','JOSE ALEJANDRO','7817424-2','JOSE.OTEGUI@USACH:CL','','','',2,5,2),
  (1329,'OVALLE DIAZ','LUIS AURELIO','5587803-K','LUIS.OVALLE@USACH:CL','','','',2,36,2),
  (1330,'OYANADER ZUNIGA','ROBINSON DANTE','9605492-0','ROBINSON.OYANADER@USACH:CL','','','',2,33,2),
  (1331,'OYARCE PALAVECINO','EDWIN RENE','5930872-6','EDWIN.OYARCE@USACH:CL','','','',2,38,2),
  (1332,'OYARZUN RIQUELME','FRANCISCO JAVIER','15722446-8','FRANCISCO.OYARZUN@USACH:CL','','','',2,34,2),
  (1333,'PAEZ RIVERA','OSCAR ALFREDO','5599603-2','OSCAR.PAEZ@USACH:CL','','','',2,10,2),
  (1334,'PAEZ COLLIO','MARITZA ANGELICA','6032383-6','MARITZA.PAEZ@USACH:CL','','','',2,8,2),
  (1335,'PAILLACAR SILVA','CARLOS ENRIQUE','7567380-9','CARLOS.PAILLACAR@USACH:CL','','','',2,21,2),
  (1336,'PAINEMAL PAINEO','FRANCISCO ERNESTO','7919172-8','FRANCISCO.PAINEMAL@USACH:CL','','','',2,5,2),
  (1337,'PAINEMAL PAINEO','LEUFY CELIA','6480238-0','LEUFY.PAINEMAL@USACH:CL','','','',2,38,2),
  (1338,'PALACIOS GUZMAN','JOSE MANUEL','5529502-6','JOSE.PALACIOS@USACH:CL','','','',2,14,2),
  (1339,'PALLAVICINI MAGNERE','PATRICIA ALEJANDRA','8955149-8','PATRICIA.PALLAVICINI@USACH:CL','','','',2,30,2),
  (1340,'PALMA AGUIRRE','GUILLERMO OCTAVIO','8342064-2','GUILLERMO.PALMA@USACH:CL','','','',2,18,2),
  (1341,'PALMA TOLOZA','CAROLYN LILIAN','10813793-2','CAROLYN.PALMA@USACH:CL','','','',2,15,2),
  (1342,'PALMA TORO','JULIO ISMAEL','14413674-8','JULIO.PALMA@USACH:CL','','','',2,10,2),
  (1343,'PALMA VERGARA','JOSE MARCOS','4943577-0','JOSE.PALMA@USACH:CL','','','',2,23,2),
  (1344,'PALMA HILLERNS','RODRIGO HERBERTO','7064247-6','RODRIGO.PALMA@USACH:CL','','','',2,14,2),
  (1345,'PALMA ALVARADO','DANIEL ANDRES','11347752-0','DANIEL.PALMA@USACH:CL','','','',2,32,2),
  (1346,'PALMA ROJAS','ALEJANDRO IVAN','12585600-4','ALEJANDRO.PALMA@USACH:CL','','','',2,5,2),
  (1347,'PALMA ARAVENA','FREDDY ANTONIO','7149481-0','FREDDY.PALMA@USACH:CL','','','',2,25,2),
  (1348,'PALOMINOS VILLAVICENCIO','FREDI EDGARDO','7995857-3','FREDI.PALOMINOS@USACH:CL','','','',2,19,2),
  (1349,'PALOMINOS BELMAR','PEDRO IVAN','7315056-6','PEDRO.PALOMINOS@USACH:CL','','','',2,11,2),
  (1350,'PALOMINOS GONZALEZ','NELSON FERNANDO','5570086-9','NELSON.PALOMINOS@USACH:CL','','','',2,21,2),
  (1351,'PANTOJA MAZZINI','VICTOR MANUEL','6240940-1','VICTOR.PANTOJA@USACH:CL','','','',2,35,2),
  (1352,'PANTOJA MACARI','JORGE PEDRO','4174033-7','JORGE.PANTOJA@USACH:CL','','','',2,36,2),
  (1353,'PARADA DAZA','VICTOR MANUEL','8223097-1','VICTOR.PARADA@USACH:CL','','','',2,12,2),
  (1354,'PARDO CONTADOR','MARCO ANTONIO','11814542-9','MARCO.PARDO@USACH:CL','','','',2,31,2),
  (1355,'PAREDES GONZALEZ','VICTOR FLORENCIO','6307130-7','VICTOR.PAREDES@USACH:CL','','','',2,11,2),
  (1356,'PAREDES HIDALGO','VICTOR RAUL','5188136-2','VICTOR.PAREDES@USACH:CL','','','',2,14,2),
  (1357,'PAREDES CAJAS','FERNANDO HERNAN','5636896-5','FERNANDO.PAREDES@USACH:CL','','','',2,11,2),
  (1358,'PAREDES PAREDES','JUAN PABLO','13468942-0','JUAN.PAREDES@USACH:CL','','','',2,36,2),
  (1359,'PARODI DAVILA','MARIA CAROLINA','9553205-5','MARIA.PARODI@USACH:CL','','','',2,15,2),
  (1360,'PARRA URZUA','MARGARITA DEL CARMEN','5817101-8','MARGARITA.PARRA@USACH:CL','','','',2,19,2),
  (1361,'PARRAGUEZ ISLA','JULIO PATRICIO','14154025-4','JULIO.PARRAGUEZ@USACH:CL','','','',2,10,2),
  (1362,'PARRAGUEZ ALVARADO','ERIK ADOLFO','15564574-1','ERIK.PARRAGUEZ@USACH:CL','','','',2,17,2),
  (1363,'PARTARRIEU VARGAS','SOLANGE CATERINE','12872723-K','SOLANGE.PARTARRIEU@USACH:CL','','','',2,25,2),
  (1364,'PASMANIK VOLOCHINSKY','DIANA ROSA','6495208-0','DIANA.PASMANIK@USACH:CL','','','',2,30,2),
  (1365,'PASTEN CASTRO','PAUL ARNALDO','7537106-3','PAUL.PASTEN@USACH:CL','','','',2,36,2),
  (1366,'PASTENE OLIVARES','RUBEN ENRIQUE','6585388-4','RUBEN.PASTENE@USACH:CL','','','',2,8,2),
  (1367,'PATTILLO ALVAREZ','GUILLERMO ALFONSO','6543728-7','GUILLERMO.PATTILLO@USACH:CL','','','',2,22,2),
  (1368,'PAVEZ MIRANDA','CAROLYN CRISTY','12877448-3','CAROLYN.PAVEZ@USACH:CL','','','',2,34,2),
  (1369,'PAVEZ SILVA','LUIS PATRICIO','6868029-8','LUIS.PAVEZ@USACH:CL','','','',2,11,2),
  (1370,'PAVEZ SOTO','FERNANDO JAIME','6224954-4','FERNANDO.PAVEZ@USACH:CL','','','',2,5,2),
  (1371,'PAVLOV PERUZOVIC','PABLO ANTONIO','5604446-9','PABLO.PAVLOV@USACH:CL','','','',2,13,2),
  (1372,'PEDRAZA GONZALEZ','MANUEL ALEJANDRO','4524072-K','MANUEL.PEDRAZA@USACH:CL','','','',2,13,2),
  (1373,'PELAEZ ANAY','JUAN JOSE','5666038-0','JUAN.PELAEZ@USACH:CL','','','',2,18,2),
  (1374,'PELLEGRIN FRIEDMANN','CARLA','6617866-8','CARLA.PELLEGRIN@USACH:CL','','','',2,25,2),
  (1375,'PENA FAUNDEZ','CLAUDIA ROXANA','12466281-8','CLAUDIA.PENA@USACH:CL','','','',2,17,2),
  (1376,'PENA GALAZ','FELIPE IGNACIO','14176725-9','FELIPE.PENA@USACH:CL','','','',2,27,2),
  (1377,'PENA GODOY','JUAN ANTONIO','6877331-8','JUAN.PENA@USACH:CL','','','',2,35,2),
  (1378,'PENA CARCAMO','FRANCISCO JAVIER','6526931-7','FRANCISCO.PENA@USACH:CL','','','',2,19,2),
  (1379,'PENA GONZALEZ','RICARDO','4485413-9','RICARDO.PENA@USACH:CL','','','',2,25,2),
  (1380,'PENA PENA','JOSE JORGE','3878575-3','JOSE.PENA@USACH:CL','','','',2,19,2),
  (1381,'PENA HERRERA','LUIS ANDRES','12266838-K','LUIS.PENA@USACH:CL','','','',2,12,2),
  (1382,'PENA FAUNDEZ','ROBERTO ANDRES','15410000-8','ROBERTO.PENA@USACH:CL','','','',2,5,2),
  (1383,'PERALTA ROSSEL','CARLOS ALFREDO','10887953-K','CARLOS.PERALTA@USACH:CL','','','',2,22,2),
  (1384,'PEREDA TAPIOL','JAIME SIXTO','4132275-6','JAIME.PEREDA@USACH:CL','','','',2,25,2),
  (1385,'PEREDO PARADA','SANTIAGO FELIPE','10996584-7','SANTIAGO.PEREDO@USACH:CL','','','',2,37,2),
  (1386,'PEREZ PEREZ','GABRIEL DANILO','9746556-8','GABRIEL.PEREZ@USACH:CL','','','',2,11,2),
  (1387,'PEREZ GARRIDO','PEDRO ESTEBAN','12272056-K','PEDRO.PEREZ@USACH:CL',NULL,NULL,NULL,1,NULL,NULL),
  (1388,'PEREZ ACUNA','PATRICIA VERONICA','10531801-4','PATRICIA.PEREZ@USACH:CL','','','',2,38,2),
  (1389,'PEREZ PULGAR','EDUARDO JOSE','9963216-K','EDUARDO.PEREZ@USACH:CL','','','',2,34,2),
  (1390,'PEREZ GILES','DAGOR','4600865-0','DAGOR.PEREZ@USACH:CL','','','',2,10,2),
  (1391,'PEREZ ARAYA','LUZ SOLEDAD','5107132-8','LUZ.PEREZ@USACH:CL','','','',2,10,2),
  (1392,'PEREZ JARA','PATRICIO ALBERTO','6769394-9','PATRICIO.PEREZ@USACH:CL','','','',2,18,2),
  (1393,'PEREZ DEVIA','MANUEL EDUARDO','7079315-6','MANUEL.PEREZ@USACH:CL','','','',2,33,2),
  (1394,'PEREZ VASQUEZ','GUILLERMO','6184150-4','GUILLERMO.PEREZ@USACH:CL','','','',2,10,2),
  (1395,'PEREZ BARRIOS','EVA ALEJANDRA','13298559-6','EVA.PEREZ@USACH:CL','','','',2,27,2),
  (1396,'PEREZ GALAZ','VICENTE ANTONIO','3243389-8','VICENTE.PEREZ@USACH:CL','','','',2,34,2),
  (1397,'PEREZ ROMERO','PEDRO HERNAN','6433295-3','PEDRO.PEREZ@USACH:CL','','','',2,21,2),
  (1398,'PEREZ SILVA','CLAUDIO FERNANDO','8366755-9','CLAUDIO.PEREZ@USACH:CL','','','',2,32,2),
  (1399,'PEREZ ARANCIBIA','RODRIGO PATRICIO','12401245-7','RODRIGO.PEREZ@USACH:CL','','','',2,19,2),
  (1400,'PEREZ MARINKOVIC','PATRICIA VERONICA','11846262-9','PATRICIA.PEREZ@USACH:CL','','','',2,10,2),
  (1401,'PEREZ SAAVEDRA','JOSE LUIS','10234391-3','JOSE.PEREZ@USACH:CL','','','',2,5,2),
  (1402,'PEREZ ROCCO','EUGENIO ENRIQUE','16354459-8','EUGENIO.PEREZ@USACH:CL','','','',2,19,2),
  (1403,'PEREZ DONOSO','JOSE MANUEL','13057654-0','JOSE.PEREZ@USACH:CL','','','',2,6,2),
  (1404,'PEREZ DE ARCE FIGUEROA','ANDRES IGNACIO','7059324-6','ANDRES.PEREZ@USACH:CL','','','',2,37,2),
  (1405,'PESCE ALVAREZ','MARIA ESTER','4908192-8','MARIA.PESCE@USACH:CL','','','',2,25,2),
  (1406,'PETERS VALENCIA','GLORIA VERONICA','6898263-4','GLORIA.PETERS@USACH:CL','','','',2,18,2),
  (1407,'PETTORINO BESNIER','ALEX GERARD','8126553-4','ALEX.PETTORINO@USACH:CL','','','',2,18,2),
  (1408,'PIMENTEL MELO','CAROLINA ANGELICA','13275861-1','CAROLINA.PIMENTEL@USACH:CL','','','',2,29,2),
  (1409,'PINA BURGOS','FREDDY EDUARDO','13028867-7','FREDDY.PINA@USACH:CL','','','',2,34,2),
  (1410,'PINILLA MEJIAS','MANUEL EDUARDO','7687614-2','MANUEL.PINILLA@USACH:CL','','','',2,18,2),
  (1411,'PINO VALENZUELA','ASTRID MARISOL','6248197-8','ASTRID.PINO@USACH:CL','','','',2,25,2),
  (1412,'PINTO PERRY','GERMAN RODOLFO','9609501-5','GERMAN.PINTO@USACH:CL','','','',2,21,2),
  (1413,'PINTO NAVARRETE','IRIS DEL ROSARIO','9244595-K','IRIS.PINTO@USACH:CL','','','',2,18,2),
  (1414,'PINTO VALLEJOS','JULIO ALEJANDRO','7453582-8','JULIO.PINTO@USACH:CL','','','',2,32,2),
  (1415,'PINTO CORREA','JUAN HUMBERTO','2746247-2','JUAN.PINTO@USACH:CL','','','',2,5,2),
  (1416,'PINTO LINCONIR','ERNESTO ALEJANDRO','10664158-7','ERNESTO.PINTO@USACH:CL','','','',2,10,2),
  (1417,'PINTO AGUERO BARRIA','CAROL MARCIAL RODRIGO','5198749-7','CAROL.PINTO@USACH:CL','','','',2,22,2),
  (1418,'PIZARRO HIDALGO','CLAUDIO JAVIER','8003487-3','CLAUDIO.PIZARRO@USACH:CL','','','',2,30,2),
  (1419,'PIZARRO CRUZ','MYRIAM DEL CARMEN','10590490-8','MYRIAM.PIZARRO@USACH:CL','','','',2,38,2),
  (1420,'PIZARRO VARGAS','ANDREA JOSELYN','14009502-8','ANDREA.PIZARRO@USACH:CL','','','',2,30,2),
  (1421,'PIZARRO GUZMAN','RODRIGO ANDRES','15442285-4','RODRIGO.PIZARRO@USACH:CL','','','',2,12,2),
  (1422,'PLACENCIA COFRE','ALMA HEDY LUISA','3919911-4','ALMA.PLACENCIA@USACH:CL','','','',2,19,2),
  (1423,'PLANT PAVLOV','RODERICK WILLIAM','7966857-5','RODERICK.PLANT@USACH:CL','','','',2,11,2),
  (1424,'PLAZA SALINAS','SERGIO EUGENIO','7167219-0','SERGIO.PLAZA@USACH:CL','','','',2,19,2),
  (1425,'PLAZA RAMIREZ','ANDREA FRANCISCA','13672263-8','ANDREA.PLAZA@USACH:CL','','','',2,15,2),
  (1426,'PLIOUCHTCHAI ','MIKHAIL','14668270-7','MIKHAIL.PLIOUCHTCHAI@USACH:CL','','','',2,18,2),
  (1427,'POBLETE VILLASECA','RUBEN ELIAS','12508279-3','RUBEN.POBLETE@USACH:CL','','','',2,17,2),
  (1428,'POBLETE LABBE','ADRIANA DEL CARMEN','5771562-6','ADRIANA.POBLETE@USACH:CL','','','',2,23,2),
  (1429,'POBLETE ZUNIGA','JUAN MANUEL','6298497-K','JUAN.POBLETE@USACH:CL','','','',2,29,2),
  (1430,'POBLETE HIDALGO','SERGIO ROBERTO','6971977-5','SERGIO.POBLETE@USACH:CL','','','',2,19,2),
  (1431,'POLANCO PEREZ','OSCAR HERNAN','5642174-2','OSCAR.POLANCO@USACH:CL','','','',2,10,2),
  (1432,'PONCE CUBILLOS','RODRIGO EDUARDO','15131194-6','RODRIGO.PONCE@USACH:CL','','','',2,19,2),
  (1433,'POPPESCOU LAZO','ALEJANDRO AUGUSTO','4773557-2','ALEJANDRO.POPPESCOU@USACH:CL','','','',2,25,2),
  (1434,'PORTAL VALENZUELA','BELFOR FERNANDO','4210595-3','BELFOR.PORTAL@USACH:CL','','','',2,35,2),
  (1435,'PORTUGAL CAMPILLAY','MIGUEL WALDEMAR','4765892-6','MIGUEL.PORTUGAL@USACH:CL','','','',2,36,2),
  (1436,'POZZO CLAVIJO','MARIO','10096495-3','MARIO.POZZO@USACH:CL','','','',2,25,2),
  (1437,'PRADO CASTILLO','HUMBERTO EDUARDO','5009040-K','HUMBERTO.PRADO@USACH:CL','','','',2,19,2),
  (1438,'PRADO GAJARDO','PATRICIA AUDOLIA','6292834-4','PATRICIA.PRADO@USACH:CL','','','',2,19,2),
  (1439,'PRENAFETA JENKIN','SERGIO ARTURO','3484557-3','SERGIO.PRENAFETA@USACH:CL','','','',2,29,2),
  (1440,'PRESAS LILLO','SILVIA SUSANA','7479429-7','SILVIA.PRESAS@USACH:CL','','','',2,30,2),
  (1441,'PRESLE BERRIOS','LUIS CHRISTIAN','9749337-5','LUIS.PRESLE@USACH:CL','','','',2,18,2),
  (1442,'PUCCIO HUIDOBRO','JOSE MIGUEL HIRAM','6865522-6','JOSE.PUCCIO@USACH:CL','','','',2,25,2),
  (1443,'PUCHEU MORIS','JUAN ANDRES','9569686-4','JUAN.PUCHEU@USACH:CL','','','',2,30,2),
  (1444,'PUGA MARFULL','ANGELA MARIA','9409865-3','ANGELA.PUGA@USACH:CL','','','',2,5,2),
  (1445,'PUGA YOUNG','ISABEL MARGARITA','9452771-6','ISABEL.PUGA@USACH:CL','','','',2,30,2),
  (1446,'PULGAR GONZALEZ','ERIC FERNANDO','10058111-6','ERIC.PULGAR@USACH:CL','','','',2,5,2),
  (1447,'PUMARINO MELENDEZ','GONZALO JAVIER','7745426-8','GONZALO.PUMARINO@USACH:CL','','','',2,25,2),
  (1448,'QUEZADA PULIDO','WILFREDO HUMBERTO','7796241-7','WILFREDO.QUEZADA@USACH:CL','','','',2,40,2),
  (1449,'QUEZADA LLANCA','LUIS ERNESTO','7683293-5','LUIS.QUEZADA@USACH:CL','','','',2,11,2),
  (1450,'QUEZADA QUEZADA','OSVALDO MELITON','5005896-4','OSVALDO.QUEZADA@USACH:CL','','','',2,10,2),
  (1451,'QUEZADA GUTIERREZ','MARCELO ANDRES','11847569-0','MARCELO.QUEZADA@USACH:CL','','','',2,17,2),
  (1452,'QUEZADA NOWAJEWSKI','RODRIGO GERMAN','15633093-0','RODRIGO.QUEZADA@USACH:CL','','','',2,11,2),
  (1453,'QUEZADA ROJAS','DIEGO BENITO','13243679-7','DIEGO.QUEZADA@USACH:CL','','','',2,33,2),
  (1454,'QUIJADA CORNEJOS','MARCELA ANGELICA','13495869-3','MARCELA.QUIJADA@USACH:CL','','','',2,30,2),
  (1455,'QUINONES AVARIA','LUIS ALBERTO','7387499-8','LUIS.QUINONES@USACH:CL','','','',2,33,2),
  (1456,'QUINSACARA JOFRE','PAULO LUIS FRANCISCO','12841637-4','PAULO.QUINSACARA@USACH:CL','','','',2,12,2),
  (1457,'QUINTANILLA PEREZ','VICTOR GUILLERMO','4300164-7','VICTOR.QUINTANILLA@USACH:CL','','','',2,35,2),
  (1458,'QUINTANILLA GONZALEZ','PABLO CESAR','11836233-0','PABLO.QUINTANILLA@USACH:CL','','','',2,13,2),
  (1459,'QUINTANILLA HERNANDEZ','CONSTANZA VERONICA','15619361-5','CONSTANZA.QUINTANILLA@USACH:CL','','','',2,30,2),
  (1460,'QUINTEROS ESPINOZA','RODOLFO VICTOR','6365819-7','RODOLFO.QUINTEROS@USACH:CL','','','',2,18,2),
  (1461,'QUIROGA PARRAGA','JOSE LUIS','22465991-1','JOSE.QUIROGA@USACH:CL','','','',2,11,2),
  (1462,'QUIROZ MEZA','ALONSO BENJAMIN','6877789-5','ALONSO.QUIROZ@USACH:CL','','','',2,19,2),
  (1463,'RABANALES RIEGO','GABRIEL ALEPH','4649507-1','GABRIEL.RABANALES@USACH:CL','','','',2,19,2),
  (1464,'RAFF BIGGEMANN','ULRICH','8829275-8','ULRICH.RAFF@USACH:CL','','','',2,18,2),
  (1465,'RAFFO LAGUNA','JULIO ANTONIO','3528946-1','JULIO.RAFFO@USACH:CL','','','',2,25,2),
  (1466,'RAMIREZ CONCHA','LORENA LUISA','8711681-6','LORENA.RAMIREZ@USACH:CL','','','',2,27,2),
  (1467,'RAMIREZ UNWIN','MARIA BEATRIZ','4779599-0','MARIA.RAMIREZ@USACH:CL','','','',2,25,2),
  (1468,'RAMIREZ LEON','DAVID','4522167-9','DAVID.RAMIREZ@USACH:CL','','','',2,18,2),
  (1469,'RAMIREZ VIDELA','RAUL ELIUD','7135188-2','RAUL.RAMIREZ@USACH:CL','','','',2,5,2),
  (1470,'RAMIREZ ALCANTARA','IVAN MARCELO','12464490-9','IVAN.RAMIREZ@USACH:CL','','','',2,36,2),
  (1471,'RAMIREZ SANTIBANEZ','CONSUELO ESMERALDA','14440955-8','CONSUELO.RAMIREZ@USACH:CL','','','',2,12,2),
  (1472,'RAMOS SANHUEZA','DAGOBERTO ENRIQUE','5065528-8','DAGOBERTO.RAMOS@USACH:CL','','','',2,10,2),
  (1473,'RAMOS ABARZUA','GUILLERMO ANDRES','10913278-0','GUILLERMO.RAMOS@USACH:CL','','','',2,10,2),
  (1474,'RAMOS ASTORGA','JOSE NELSON','9259592-7','JOSE.RAMOS@USACH:CL','','','',2,23,2),
  (1475,'RAMOS ARRIAGADA','RAMON ALFONSO','4209203-7','RAMON.RAMOS@USACH:CL','','','',2,21,2),
  (1476,'RANNOU FUENTES','FERNANDO RODRIGO','9579491-2','FERNANDO.RANNOU@USACH:CL','','','',2,12,2),
  (1477,'RAVANAL ESPINA','CARLOS ALBERTO','8635587-6','CARLOS.RAVANAL@USACH:CL','','','',2,37,2),
  (1478,'RAYMAN FUENTES','ANGEL GUSTAVO','5972973-K','ANGEL.RAYMAN@USACH:CL','','','',2,11,2),
  (1479,'RAYMOND GUTIERREZ','EMILIA','7694559-4','EMILIA.RAYMOND@USACH:CL','','','',2,38,2),
  (1480,'READI LAMA','ROBERTO ELIAS','4017072-3','ROBERTO.READI@USACH:CL','','','',2,37,2),
  (1481,'RECABARREN GUERRA','ESTELA MAGDALENA','5615797-2','ESTELA.RECABARREN@USACH:CL','','','',2,8,2),
  (1482,'RECUERO DEL SOLAR','MARCO ANTONIO','6590660-0','MARCO.RECUERO@USACH:CL','','','',2,30,2),
  (1483,'REMENTERIA PINONES','JOSE ARIEL','6360448-8','JOSE.REMENTERIA@USACH:CL','','','',2,38,2),
  (1484,'RETAMAL ABARZUA','JUAN CARLOS','9170314-9','JUAN.RETAMAL@USACH:CL','','','',2,18,2),
  (1485,'RETAMAL POBLETE','ALEJANDRO GUIDO','4740838-5','ALEJANDRO.RETAMAL@USACH:CL','','','',2,36,2),
  (1486,'RETAMAL ORTEGA','ROBERTO SEGUNDO','5884875-1','ROBERTO.RETAMAL@USACH:CL','','','',2,19,2),
  (1487,'REVECO ARENAS','MARIA JOSE','12638145-K','MARIA.REVECO@USACH:CL','','','',2,11,2),
  (1488,'REY CARRASCO','PIA BERNARDITA','8186457-8','PIA.REY@USACH:CL','','','',2,29,2),
  (1489,'REYES GARCIA','ENRIQUE GONZALO','8826962-4','ENRIQUE.REYES@USACH:CL','','','',2,19,2),
  (1490,'REYES PARADA','MIGUEL IVAN','9806000-6','MIGUEL.REYES@USACH:CL','','','',2,25,2),
  (1491,'REYES CARO','FLOR TRINIDAD','11525204-6','FLOR.REYES@USACH:CL','','','',2,14,2),
  (1492,'REYES SALINAS','ALEJANDRO ENRIQUE','6070447-3','ALEJANDRO.REYES@USACH:CL','','','',2,15,2),
  (1493,'REYES MAZZINI','MAGALI DEL ROSARIO','5002272-2','MAGALI.REYES@USACH:CL','','','',2,18,2),
  (1494,'REYES FRANZANI','JOSE PEDRO','6004137-7','JOSE.REYES@USACH:CL','','','',2,17,2),
  (1495,'REYES MANRIQUEZ','JOSE GONZALO','8344592-0','JOSE.REYES@USACH:CL','','','',2,5,2),
  (1496,'REYES BUBERT','XIMENA MARCELA','11633165-9','XIMENA.REYES@USACH:CL','','','',2,31,2),
  (1497,'REYES LOPEZ','FELIPE ESTEBAN','14148107-K','FELIPE.REYES@USACH:CL','','','',2,6,2),
  (1498,'REYES ESPEJO','MARIA ISABEL','12585831-7','MARIA.REYES@USACH:CL','','','',2,30,2),
  (1499,'REYES GATICA','GIANNINA LORENA','13899982-3','GIANNINA.REYES@USACH:CL','','','',2,35,2),
  (1500,'RIBOT SOTO','GLADYS DEL CARMEN','5632124-1','GLADYS.RIBOT@USACH:CL','','','',2,8,2),
  (1501,'RICHARDS MADARIAGA','CARLOS EMILIO','6580011-K','CARLOS.RICHARDS@USACH:CL','','','',2,17,2),
  (1502,'RIHM SILVA','JUAN ALFREDO','10792303-9','JUAN.RIHM@USACH:CL','','','',2,35,2),
  (1503,'RINCON RODRIGUEZ','RAMIRO JAVIER','22066576-3','RAMIRO.RINCON@USACH:CL','','','',2,6,2),
  (1504,'RIOS MUNOZ','DANIEL EDUARDO','6699077-K','DANIEL.RIOS@USACH:CL','','','',2,31,2),
  (1505,'RIOS VILCHES','EDMUNDO ISMAEL','6382637-5','EDMUNDO.RIOS@USACH:CL','','','',2,8,2);
COMMIT;

/* Data for the `investigador` table  (LIMIT 1500,500) */

INSERT INTO `investigador` (`idInvestigador`, `apellidos`, `nombres`, `numeroIdentificacion`, `email`, `telefonoFijo`, `telefonoMovil`, `direccion`, `idPerfilInvestigador`, `departamento_id`, `institucion_id`) VALUES
  (1506,'RIOS SEPULVEDA','LUIS ANGEL','5965302-4','LUIS.RIOS@USACH:CL','','','',2,12,2),
  (1507,'RIOSECO VALENZUELA','MARCO ANTONIO','9478442-5','MARCO.RIOSECO@USACH:CL','','','',2,25,2),
  (1508,'RIQUELME VERDUGO','HUGO','5077031-1','HUGO.RIQUELME@USACH:CL','','','',2,10,2),
  (1509,'RIQUELME HERRERA','CARLOS ORLANDO','5819170-1','CARLOS.RIQUELME@USACH:CL','','','',2,10,2),
  (1510,'RIQUELME VALENZUELA','MARITZA ANDREA','8865043-3','MARITZA.RIQUELME@USACH:CL','','','',2,8,2),
  (1511,'RIQUELME SANFELIU','ROGELIO','7285519-1','ROGELIO.RIQUELME@USACH:CL','','','',2,19,2),
  (1512,'RIQUELME HORMAZABAL','NESTOR GUIDO','11489242-4','NESTOR.RIQUELME@USACH:CL','','','',2,10,2),
  (1513,'RIQUELME QUEZADA','LUIS MARIO','13032826-1','LUIS.RIQUELME@USACH:CL','','','',2,19,2),
  (1514,'RISSO FAUNDEZ','OLGA DEL CARMEN','9825032-8','OLGA.RISSO@USACH:CL','','','',2,38,2),
  (1515,'RIVAS SOLIS','JOSE IGNACIO','7517600-7','JOSE.RIVAS@USACH:CL','','','',2,15,2),
  (1516,'RIVAS CORONADO','NORBERTO','6523574-9','NORBERTO.RIVAS@USACH:CL','','','',2,21,2),
  (1517,'RIVERA VERGARA','RICARDO VENANCIO','6026964-5','RICARDO.RIVERA@USACH:CL','','','',2,18,2),
  (1518,'RIVERA PARDO','VICTORIA','5193773-2','VICTORIA.RIVERA@USACH:CL','','','',2,30,2),
  (1519,'RIVERA QUEVEDO','CARMEN LUZ','6782917-4','CARMEN.RIVERA@USACH:CL','','','',2,26,2),
  (1520,'RIVERA NAVARRO','JOSE LUIS','7875195-9','JOSE.RIVERA@USACH:CL','','','',2,5,2),
  (1521,'RIVERA SEREY','CAROLINA PAZ','8719305-5','CAROLINA.RIVERA@USACH:CL','','','',2,30,2),
  (1522,'RIVERA MANCILLA','EUGENIO ANDRES','13341814-8','EUGENIO.RIVERA@USACH:CL','','','',2,19,2),
  (1523,'RIVERA ZEBALLOS','RENE EDUARDO','9643960-1','RENE.RIVERA@USACH:CL','','','',2,27,2),
  (1524,'RIVEROS SILVA','PEDRO EUGENIO','4574721-2','PEDRO.RIVEROS@USACH:CL','','','',2,25,2),
  (1525,'RIVEROS JARA','HECTOR RODRIGO','6227456-5','HECTOR.RIVEROS@USACH:CL','','','',2,36,2),
  (1526,'RIVEROS CUELLO','LUIS ALBERTO','6198325-2','LUIS.RIVEROS@USACH:CL','','','',2,19,2),
  (1527,'RIVEROS LOPEZ','SANTIAGO RAUL','5525331-5','SANTIAGO.RIVEROS@USACH:CL','','','',2,14,2),
  (1528,'RIVEROS LEPE','ALEJANDRO ALBERTO','6825019-6','ALEJANDRO.RIVEROS@USACH:CL','','','',2,26,2),
  (1529,'RIVEROS OLIVARES','MARIA DALILA','7745573-6','MARIA.RIVEROS@USACH:CL','','','',2,34,2),
  (1530,'ROA CONTRERAS','CATALINA EUGENIA','14123592-3','CATALINA.ROA@USACH:CL','','','',2,32,2),
  (1531,'ROBLEDO CEBALLOS','JOSELYN ALEJANDRA','14092598-5','JOSELYN.ROBLEDO@USACH:CL','','','',2,35,2),
  (1532,'ROBLES CONTRERAS','CAROLINA ALEJANDRA','16384547-4','CAROLINA.ROBLES@USACH:CL','','','',2,7,2),
  (1533,'ROBLES LABARCA','GUSTAVO ENRIQUE','6512558-7','GUSTAVO.ROBLES@USACH:CL','','','',2,23,2),
  (1534,'ROCABADO BENAVIDES','JOSE LUIS','14442523-5','JOSE.ROCABADO@USACH:CL','','','',2,25,2),
  (1535,'ROCCO MONTENEGRO','VICTOR PASCUAL','6433587-1','VICTOR.ROCCO@USACH:CL','','','',2,25,2),
  (1536,'RODRIGUEZ GUTIERREZ','SANDRA EUGENIA','11030626-1','SANDRA.RODRIGUEZ@USACH:CL','','','',2,25,2),
  (1537,'RODRIGUEZ VALENCIA','LUIS ALBERTO HERNAN','4706643-3','LUIS.RODRIGUEZ@USACH:CL','','','',2,18,2),
  (1538,'RODRIGUEZ MOYA','CARLOS HUMBERTO','5028262-7','CARLOS.RODRIGUEZ@USACH:CL','','','',2,10,2),
  (1539,'RODRIGUEZ ROZAS','MARIO DEL TRANSITO','5295508-4','MARIO.RODRIGUEZ@USACH:CL','','','',2,10,2),
  (1540,'RODRIGUEZ FERNANDEZ','RODRIGO','8780842-4','RODRIGO.RODRIGUEZ@USACH:CL','','','',2,35,2),
  (1541,'RODRIGUEZ ASTORGA','CLAUDIO ROMAN','8542447-5','CLAUDIO.RODRIGUEZ@USACH:CL','','','',2,33,2),
  (1542,'RODRIGUEZ ARENAS','CAROLYN HAYDEE','12237864-0','CAROLYN.RODRIGUEZ@USACH:CL','','','',2,25,2),
  (1543,'RODRIGUEZ GUZMAN','AGUSTIN ESTEBAN','9300553-8','AGUSTIN.RODRIGUEZ@USACH:CL','','','',2,5,2),
  (1544,'RODRIGUEZ ARANEDA','MARIA JOSE','9939764-0','MARIA.RODRIGUEZ@USACH:CL','','','',2,30,2),
  (1545,'RODRIGUEZ GARCIA','ARTURO BENITO','14726133-0','ARTURO.RODRIGUEZ@USACH:CL','','','',2,19,2),
  (1546,'RODRIGUEZ OPAZO','EMERSON EBER','13265522-7','EMERSON.RODRIGUEZ@USACH:CL','','','',2,13,2),
  (1547,'RODRIGUEZ TAPIA','KATHERINNE WALESKA','13920199-K','KATHERINNE.RODRIGUEZ@USACH:CL','','','',2,17,2),
  (1548,'RODRIGUEZ PEREZ','MARIO HUMBERTO','5122758-1','MARIO.RODRIGUEZ@USACH:CL','','','',2,25,2),
  (1549,'RODRIGUEZ ABARCA','JENNIFER ELIZABETH','16709380-9','JENNIFER.RODRIGUEZ@USACH:CL','','','',2,27,2),
  (1550,'ROJAS JIMENEZ','HECTOR IGNACIO','11836034-6','HECTOR.ROJAS@USACH:CL','','','',2,30,2),
  (1551,'ROJAS CABALLERO','CRISTIAN ALFREDO','13665776-3','CRISTIAN.ROJAS@USACH:CL','','','',2,35,2),
  (1552,'ROJAS ROJAS','SERGIO FERNANDO','4871238-K','SERGIO.ROJAS@USACH:CL','','','',2,23,2),
  (1553,'ROJAS PAVEZ','JUAN LUIS DORIAN','5314675-9','JUAN.ROJAS@USACH:CL','','','',2,25,2),
  (1554,'ROJAS PUENTES','CELSA VERONICA','5312696-0','CELSA.ROJAS@USACH:CL','','','',2,19,2),
  (1555,'ROJAS MANALICH','ANA MARIA','7256855-9','ANA.ROJAS@USACH:CL','','','',2,38,2),
  (1556,'ROJAS AHUMADA','RENATO DEL CARMEN','6264689-6','RENATO.ROJAS@USACH:CL','','','',2,11,2),
  (1557,'ROJAS ZAMORANO','EDUARDO GUILLERMO','6617344-5','EDUARDO.ROJAS@USACH:CL','','','',2,32,2),
  (1558,'ROJAS DE LA ROSA','GERMAN NELSON LEONARDO','5862407-1','GERMAN.ROJAS@USACH:CL','','','',2,19,2),
  (1559,'ROJAS LAGOS','MIGUEL ANGEL','6370054-1','MIGUEL.ROJAS@USACH:CL','','','',2,25,2),
  (1560,'ROJAS VERCELOTTI','LEONARDO ANDRES','6207245-8','LEONARDO.ROJAS@USACH:CL','','','',2,21,2),
  (1561,'ROJAS POZO','ELEODORO DAVID','5754970-K','ELEODORO.ROJAS@USACH:CL','','','',2,10,2),
  (1562,'ROJAS NAVARRO','PATRICIO HERNAN','10397580-8','PATRICIO.ROJAS@USACH:CL',NULL,NULL,NULL,1,NULL,NULL),
  (1563,'ROJAS PINEDA','ALEXIS EUGENIO','9490971-6','ALEXIS.ROJAS@USACH:CL','','','',2,19,2),
  (1564,'ROJAS DE LA CERDA','EDUARDO ALBERTO','10063611-5','EDUARDO.ROJAS@USACH:CL','','','',2,36,2),
  (1565,'ROJAS BASTIAS','DANIELA HERMINIA','14561020-6','DANIELA.ROJAS@USACH:CL','','','',2,19,2),
  (1566,'ROLDAN TOLEDO','ROSA ELENA','7645316-0','ROSA.ROLDAN@USACH:CL','','','',2,25,2),
  (1567,'ROMAN ALVAREZ','EDUARDO HERNAN','6440621-3','EDUARDO.ROMAN@USACH:CL','','','',2,29,2),
  (1568,'ROMAN MIRANDA','JOSE MANUEL','3903675-4','JOSE.ROMAN@USACH:CL','','','',2,38,2),
  (1569,'ROMAN URBINA','AYLINNE DEL PILAR','15621366-7','AYLINNE.ROMAN@USACH:CL','','','',2,18,2),
  (1570,'ROMEO NUNEZ','JOSE SANTOS','10682441-K','JOSE.ROMEO@USACH:CL','','','',2,19,2),
  (1571,'ROMERO DETTONI','CARLOS JOSE','5122524-4','CARLOS.ROMERO@USACH:CL','','','',2,10,2),
  (1572,'ROMERO ECHEVERRIA','LUIS ESTEBAN','8314315-0','LUIS.ROMERO@USACH:CL','','','',2,32,2),
  (1573,'RONCONE DITZEL','ENRIQUE GERMAN ANTONIO','8496567-7','ENRIQUE.RONCONE@USACH:CL','','','',2,25,2),
  (1574,'ROPERT CONTRERAS','MAX LUIS MARIO','5027376-8','MAX.ROPERT@USACH:CL','','','',2,25,2),
  (1575,'ROSAS VILLALOBOS','SANDRA DEL CARMEN','10088643-K','SANDRA.ROSAS@USACH:CL','','','',2,5,2),
  (1576,'ROSINELLI CONTRERAS','MARCELA LORENA','10853850-3','MARCELA.ROSINELLI@USACH:CL','','','',2,11,2),
  (1577,'ROSSI DIAZ-MUNOZ','PATRICIO ALEJANDRO','8401860-0','PATRICIO.ROSSI@USACH:CL','','','',2,25,2),
  (1578,'ROUDERGUE GUZMAN','ROBINSON','6410859-K','ROBINSON.ROUDERGUE@USACH:CL','','','',2,10,2),
  (1579,'ROZAS MELLADO','SERGIO ANTONIO RODRIGO','7161874-9','SERGIO.ROZAS@USACH:CL','','','',2,11,2),
  (1580,'ROZAS CAAMANO','GRACIELA CECILIA','11349941-9','GRACIELA.ROZAS@USACH:CL','','','',2,30,2),
  (1581,'ROZAS SALAS','CARLOS ALBERTO','11673955-0','CARLOS.ROZAS@USACH:CL','','','',2,6,2),
  (1582,'RUBEL COHEN','SERGIO MAURICIO','10902603-4','SERGIO.RUBEL@USACH:CL','','','',2,25,2),
  (1583,'RUBILAR FIGUEROA','ROBERTO','4986889-8','ROBERTO.RUBILAR@USACH:CL','','','',2,11,2),
  (1584,'RUBILAR JIMENEZ','OSVALDO ENRIQUE','10858276-6','OSVALDO.RUBILAR@USACH:CL','','','',2,38,2),
  (1585,'RUBIO MADRID','ANA MARIA','5203188-5','ANA.RUBIO@USACH:CL','','','',2,12,2),
  (1586,'RUBIO CAMPOS','MARIA ANGELICA','6338415-1','MARIA.RUBIO@USACH:CL','','','',2,7,2),
  (1587,'RUBIO ARANCIBIA','VICTOR HUGO','5023541-6','VICTOR.RUBIO@USACH:CL','','','',2,25,2),
  (1588,'RUEDA BRUESTLEN','BELKYS ELIZABETH','14670753-K','BELKYS.RUEDA@USACH:CL','','','',2,25,2),
  (1589,'RUFS BELLIZZIA','ANA MARIA','7683448-2','ANA.RUFS@USACH:CL','','','',2,8,2),
  (1590,'RUGIERO PEREZ','ELSA IVONE','7747368-8','ELSA.RUGIERO@USACH:CL','','','',2,25,2),
  (1591,'RUIZ DE VINASPRE CABRERA','ADRIAN SERAFIN','4970471-2','ADRIAN.RUIZ@USACH:CL','','','',2,19,2),
  (1592,'RUPERTHUZ HONORATO','LUIS MARIANO','13290369-7','LUIS.RUPERTHUZ@USACH:CL','','','',2,30,2),
  (1593,'RUSSI CALEGARI','MAURICIO','9150124-4','MAURICIO.RUSSI@USACH:CL','','','',2,25,2),
  (1594,'SAA HERRERA','PEDRO LUIS','5597778-K','PEDRO.SAA@USACH:CL','','','',2,5,2),
  (1595,'SAAVEDRA QUINTANA','MARIA LUISA','8716703-8','MARIA.SAAVEDRA@USACH:CL','','','',2,15,2),
  (1596,'SAAVEDRA GALLARDO','EUGENIO ANTONIO','8218909-2','EUGENIO.SAAVEDRA@USACH:CL','','','',2,19,2),
  (1597,'SAAVEDRA FLORES','ERICK ISAAC','13027223-1','ERICK.SAAVEDRA@USACH:CL','','','',2,34,2),
  (1598,'SAAVEDRA FENOGLIO','ALDO IVAN ANTONIO','7074850-9','ALDO.SAAVEDRA@USACH:CL','','','',2,15,2),
  (1599,'SAAVEDRA ARPAS','NESTOR IVAN','8663306-K','NESTOR.SAAVEDRA@USACH:CL','','','',2,17,2),
  (1600,'SAAVEDRA GALLARDO','CATALINA MERCEDES','14168661-5','CATALINA.SAAVEDRA@USACH:CL','','','',2,17,2),
  (1601,'SAAVEDRA FLORES','ALEJANDRA ANDREA','13484890-1','ALEJANDRA.SAAVEDRA@USACH:CL','','','',2,6,2),
  (1602,'SABALLA PAVEZ','DEYDI KATHERINE','14163979-K','DEYDI.SABALLA@USACH:CL','','','',2,30,2),
  (1603,'SAEZ TONACCA','LUIS DAVID','7807114-1','LUIS.SAEZ@USACH:CL','','','',2,37,2),
  (1604,'SAEZ ARRIETA','CRISTIAN LORENZO','12147399-2','CRISTIAN.SAEZ@USACH:CL','','','',2,38,2),
  (1605,'SAEZ BRIONES','PATRICIO MANUEL EUGENIO','10558774-0','PATRICIO.SAEZ@USACH:CL','','','',2,25,2),
  (1606,'SAEZ SAN MARTIN','PATRICIA AURORA','10433757-0','PATRICIA.SAEZ@USACH:CL','','','',2,21,2),
  (1607,'SAEZ GACITUA','MYRIAM','7052500-3','MYRIAM.SAEZ@USACH:CL','','','',2,8,2),
  (1608,'SAEZ BAHAMONDES','ALEJANDRO MAURICIO','12720234-6','ALEJANDRO.SAEZ@USACH:CL','','','',2,18,2),
  (1609,'SAEZ KIFAFI','PAULINA HALIME','13905561-6','PAULINA.SAEZ@USACH:CL','','','',2,31,2),
  (1610,'SAEZ HERRERA','ENZO','4483835-4','ENZO.SAEZ@USACH:CL','','','',2,25,2),
  (1611,'SAGACETA CIENFUEGOS','ALICIA EMILIA','4947964-6','ALICIA.SAGACETA@USACH:CL','','','',2,26,2),
  (1612,'SAINTARD VERA','MARCEL PIERRE','7327319-6','MARCEL.SAINTARD@USACH:CL','','','',2,19,2),
  (1613,'SAINTARD FLORES','JULIO RODRIGO','13720441-K','JULIO.SAINTARD@USACH:CL','','','',2,10,2),
  (1614,'SALAMANCA OSORIO','HECTOR ORLANDO','5409829-4','HECTOR.SALAMANCA@USACH:CL','','','',2,30,2),
  (1615,'SALAMANCA BARRIOS','JORGE ABRAHAM CESAR','4594086-1','JORGE.SALAMANCA@USACH:CL','','','',2,25,2),
  (1616,'SALAS MOYA','FRANCISCA ELIZABETH','16838968-K','FRANCISCA.SALAS@USACH:CL','','','',2,14,2),
  (1617,'SALAS OPAZO','VICTOR ALEXIS','5048123-9','VICTOR.SALAS@USACH:CL','','','',2,22,2),
  (1618,'SALAS DIEHL','INES ELIANA','6440940-9','INES.SALAS@USACH:CL','','','',2,25,2),
  (1619,'SALAZAR BRITO','MARIA ELIZABETH','6183861-9','MARIA.SALAZAR@USACH:CL','','','',2,17,2),
  (1620,'SALAZAR MORAGA','ELIANA ISABEL','5199224-5','ELIANA.SALAZAR@USACH:CL','','','',2,19,2),
  (1621,'SALAZAR GALLARDO','ELSA GLORIA','7350498-8','ELSA.SALAZAR@USACH:CL','','','',2,31,2),
  (1622,'SALAZAR PEREIRA','DAVID OCTAVIO','14339813-7','DAVID.SALAZAR@USACH:CL','','','',2,19,2),
  (1623,'SALDIVIA ROJAS','MARIA VICTORIA','6382162-4','MARIA.SALDIVIA@USACH:CL','','','',2,27,2),
  (1624,'SALGADO PARIS','PATRICIO ALEJANDRO','9322883-9','PATRICIO.SALGADO@USACH:CL','','','',2,11,2),
  (1625,'SALINAS SALAS','MANUEL DARIO','5869985-3','MANUEL.SALINAS@USACH:CL','','','',2,13,2),
  (1626,'SALINAS TORRES','VICTOR HUGO','7209793-9','VICTOR.SALINAS@USACH:CL','','','',2,19,2),
  (1627,'SALINAS CAMPOS','MAXIMILIANO AUGUSTO GABRIEL','6257137-3','MAXIMILIANO.SALINAS@USACH:CL','','','',2,32,2),
  (1628,'SALINAS VELIZ','JUAN ALBERTO','6485083-0','JUAN.SALINAS@USACH:CL','','','',2,25,2),
  (1629,'SALINAS CAVIEDES','RUTH XIMENA','8114779-5','RUTH.SALINAS@USACH:CL','','','',2,38,2),
  (1630,'SALINAS REBOLLEDO','ELIZABETH ANGELICA','13755998-6','ELIZABETH.SALINAS@USACH:CL','','','',2,26,2),
  (1631,'SALINAS MEZA','LUIS RENE','3788340-9','LUIS.SALINAS@USACH:CL','','','',2,32,2),
  (1632,'SALVATIERRA GARRIDO','JOSE LUIS','13930046-7','JOSE.SALVATIERRA@USACH:CL','','','',2,34,2),
  (1633,'SALVATIERRA FLOREZ','VILMA LUCIA','5712508-K','VILMA.SALVATIERRA@USACH:CL','','','',2,26,2),
  (1634,'SALVATIERRA SALAS','ALVARO ARTURO','5002751-1','ALVARO.SALVATIERRA@USACH:CL','','','',2,13,2),
  (1635,'SALVO SAAVEDRA','DAGOBERTO EDUARDO','10552672-5','DAGOBERTO.SALVO@USACH:CL','','','',2,25,2),
  (1636,'SAMANIEGO MESIAS','SEVERO AUGUSTO','4754505-6','SEVERO.SAMANIEGO@USACH:CL','','','',2,32,2),
  (1637,'SAMHAN ESCANDAR','GERARDO IVAN','5029716-0','GERARDO.SAMHAN@USACH:CL','','','',2,5,2),
  (1638,'SAN JUAN URRUTIA','ENRIQUE ALBERTO','8825281-0','ENRIQUE.SAN@USACH:CL','','','',2,10,2),
  (1639,'SAN MARTIN ULLOA','ALVARO ENRIQUE','4288312-3','ALVARO.SAN@USACH:CL','','','',2,18,2),
  (1640,'SAN MARTIN NARVAEZ','ALVARO GONZALO','12264886-9','ALVARO.SAN@USACH:CL','','','',2,35,2),
  (1641,'SANCHEZ VASQUEZ','JORGE LUIS','8319717-K','JORGE.SANCHEZ@USACH:CL','','','',2,31,2),
  (1642,'SANCHEZ Y BERNAL','LUIS MANUEL','14569153-2','LUIS.SANCHEZ@USACH:CL','','','',2,19,2),
  (1643,'SANCHEZ MUNOZ','GUILLERMO CESAR','5590307-7','GUILLERMO.SANCHEZ@USACH:CL','','','',2,19,2),
  (1644,'SANCHEZ CARRENO','JOSE LUIS','6911533-0','JOSE.SANCHEZ@USACH:CL','','','',2,19,2),
  (1645,'SANCHEZ VALLE','LUIS ALFONSO','7517478-0','LUIS.SANCHEZ@USACH:CL','','','',2,19,2),
  (1646,'SANCHEZ GONZALEZ','EVELYN LORENA','10758612-1','EVELYN.SANCHEZ@USACH:CL','','','',2,19,2),
  (1647,'SANCHEZ FERNANDEZ','LAURA','21799812-3','LAURA.SANCHEZ@USACH:CL','','','',2,19,2),
  (1648,'SANCY VELASQUEZ','MAMIE ODETTE','10675797-6','MAMIE.SANCY@USACH:CL','','','',2,8,2),
  (1649,'SANDOVAL PARDO','ALEJANDRA ELISA','14239437-5','ALEJANDRA.SANDOVAL@USACH:CL','','','',2,10,2),
  (1650,'SANDOVAL MARTINEZ','ANA EUGENIA','7540556-1','ANA.SANDOVAL@USACH:CL','','','',2,18,2),
  (1651,'SANDOVAL GUTIERREZ','SONIA ISABEL','6098866-8','SONIA.SANDOVAL@USACH:CL','','','',2,25,2),
  (1652,'SANHUEZA CHUREO','PAOLA ANDREA','12258343-0','PAOLA.SANHUEZA@USACH:CL','','','',2,11,2),
  (1653,'SANHUEZA MUNOZ','GERMAN OLIVER','12899179-4','GERMAN.SANHUEZA@USACH:CL','','','',2,23,2),
  (1654,'SANHUEZA MATURANA','LILIAN DEL PILAR','8030162-6','LILIAN.SANHUEZA@USACH:CL','','','',2,25,2),
  (1655,'SANHUEZA FLORES','JOSE EDUARDO','4875849-5','JOSE.SANHUEZA@USACH:CL','','','',2,8,2),
  (1656,'SANTANA GODOY','CARLOS AUGUSTO','4966753-1','CARLOS.SANTANA@USACH:CL','','','',2,5,2),
  (1657,'SANTANDER BAEZA','RICARDO AUGUSTO','5204401-4','RICARDO.SANTANDER@USACH:CL','','','',2,19,2),
  (1658,'SANTANDER MORALES','FELIPE ALEJANDRO','15663921-4','FELIPE.SANTANDER@USACH:CL','','','',2,10,2),
  (1659,'SANTELICES GOMEZ','GUILLERMINA MARIA JACINTA','7197745-5','GUILLERMINA.SANTELICES@USACH:CL','','','',2,36,2),
  (1660,'SANTIAGO GUERRA','JUAN ANTONIO','7526047-4','JUAN.SANTIAGO@USACH:CL','','','',2,19,2),
  (1661,'SANTIBANEZ MUNOZ','HECTOR ENRIQUE','12605770-9','HECTOR.SANTIBANEZ@USACH:CL','','','',2,26,2),
  (1662,'SANTIBANEZ ARIAS','SERGIO HARUL','5863838-2','SERGIO.SANTIBANEZ@USACH:CL','','','',2,19,2),
  (1663,'SANTIBANEZ VIANI','EDGARDO JULIO JUAN','8544139-6','EDGARDO.SANTIBANEZ@USACH:CL','','','',2,11,2),
  (1664,'SANTIBANEZ CALDERON','FRANCISCO JAVIER','15623502-4','FRANCISCO.SANTIBANEZ@USACH:CL','','','',2,18,2),
  (1665,'SANTORO GUERRERO','ROSA MARIA','6925578-7','ROSA.SANTORO@USACH:CL','','','',2,11,2),
  (1666,'SANZANA TORO','JACQUELINE DEL CARMEN','10652850-0','JACQUELINE.SANZANA@USACH:CL','','','',2,25,2),
  (1667,'SARIEGO BADAL','LUIS RENATO','4108170-8','LUIS.SARIEGO@USACH:CL','','','',2,8,2),
  (1668,'SARTORI HEVIA','MARIA REBECA JIMENA','4134322-2','MARIA.SARTORI@USACH:CL','','','',2,8,2),
  (1669,'SCHACHTER CISTERNAS','ENZO HENRY','6344443-K','ENZO.SCHACHTER@USACH:CL','','','',2,13,2),
  (1670,'SCHACHTER CISTERNAS','MICHEL LUIS','6022917-1','MICHEL.SCHACHTER@USACH:CL','','','',2,13,2),
  (1671,'SCHIATTINO LEMUS','MARIA IRENE','6276323-K','MARIA.SCHIATTINO@USACH:CL','','','',2,19,2),
  (1672,'SCHMESSANE LOPEZ','ANDREA GIANNINA','15584696-8','ANDREA.SCHMESSANE@USACH:CL','','','',2,18,2),
  (1673,'SCHMIDT MANRIQUEZ','HERMO RICARDO','5439335-0','HERMO.SCHMIDT@USACH:CL','','','',2,8,2),
  (1674,'SCHRODER RODRIGUEZ','EDUARDO RUPERTO RAMON','5169433-3','EDUARDO.SCHRODER@USACH:CL','','','',2,12,2),
  (1675,'SCHROEDER MARQUEZ','GRACIELA GUILLERMINA','6490222-9','GRACIELA.SCHROEDER@USACH:CL','','','',2,30,2),
  (1676,'SCHROEDER HANKE','FRANCISCA','9259757-1','FRANCISCA.SCHROEDER@USACH:CL','','','',2,25,2),
  (1677,'SCHULZ PEREZ','HECTOR EDUARDO','5326153-1','HECTOR.SCHULZ@USACH:CL','','','',2,19,2),
  (1678,'SCHULZ EGLIN','BERND JURGEN','3477325-4','BERND.SCHULZ@USACH:CL','','','',2,14,2),
  (1679,'SCHUMILO ROGATKIN','ALEXANDER','7904169-6','ALEXANDER.SCHUMILO@USACH:CL','','','',2,34,2),
  (1680,'SEAL MERY','CHRISTIAN EDWARD','10201396-4','CHRISTIAN.SEAL@USACH:CL','','','',2,34,2),
  (1681,'SEBALLOS PALMA','SYLVIA DE LAS MERCEDES','5575303-2','SYLVIA.SEBALLOS@USACH:CL','','','',2,18,2),
  (1682,'SEGOVIA GONZALEZ','LAURA AIDA','6237777-1','LAURA.SEGOVIA@USACH:CL','','','',2,25,2),
  (1683,'SEGURA RAMIREZ','JAVIER ALBERTO','7316631-4','JAVIER.SEGURA@USACH:CL','','','',2,12,2),
  (1684,'SEPULVEDA CUEVAS','LUISA ANTONIA','8685088-5','LUISA.SEPULVEDA@USACH:CL','','','',2,15,2),
  (1685,'SEPULVEDA SALAS','JUAN MIGUEL','7773078-8','JUAN.SEPULVEDA@USACH:CL','','','',2,11,2),
  (1686,'SEPULVEDA GARCIA-HUIDOBRO','EDUARDO FRANCISCO','7684743-6','EDUARDO.SEPULVEDA@USACH:CL','','','',2,34,2),
  (1687,'SEPULVEDA PIZARRO','FACUNDO','11225943-0','FACUNDO.SEPULVEDA@USACH:CL','','','',2,22,2),
  (1688,'SEPULVEDA CARRASCO','CYNTHIA ANDREA','15609984-8','CYNTHIA.SEPULVEDA@USACH:CL','','','',2,13,2),
  (1689,'SEPULVEDA FARIAS','OLGA ROSA','5579191-0','OLGA.SEPULVEDA@USACH:CL','','','',2,34,2),
  (1690,'SEPULVEDA BOZA','SILVIA','4332266-4','SILVIA.SEPULVEDA@USACH:CL','','','',2,25,2),
  (1691,'SEPULVEDA CARMONA','FLORENCIO','3090523-7','FLORENCIO.SEPULVEDA@USACH:CL','','','',2,10,2),
  (1692,'SEPULVEDA SARIEGO','EDGARDO ANTOLIN','6863592-6','EDGARDO.SEPULVEDA@USACH:CL','','','',2,12,2),
  (1693,'SEPULVEDA NAVARRO','NELSON ESTEBAN','14582410-9','NELSON.SEPULVEDA@USACH:CL','','','',2,18,2),
  (1694,'SEPULVEDA TAPIA','PABLO ALEJANDRO','14148206-8','PABLO.SEPULVEDA@USACH:CL','','','',2,11,2),
  (1695,'SEPULVEDA SEPULVEDA','JULIO ANDRES','13245328-4','JULIO.SEPULVEDA@USACH:CL','','','',2,31,2),
  (1696,'SEPULVEDA TAPIA','EDUARDO LEON','12667189-K','EDUARDO.SEPULVEDA@USACH:CL','','','',2,37,2),
  (1697,'SEPULVEDA AVILA','SANDRA PAOLA','11667458-0','SANDRA.SEPULVEDA@USACH:CL','','','',2,25,2),
  (1698,'SERAFINI ','DANIEL OSVALDO','14747507-1','DANIEL.SERAFINI@USACH:CL','','','',2,18,2),
  (1699,'SERON ALUMINI','JUAN MARIO','4175969-0','JUAN.SERON@USACH:CL','','','',2,21,2),
  (1700,'SERON LEIVA','JUAN FRANCISCO','7749161-9','JUAN.SERON@USACH:CL','','','',2,37,2),
  (1701,'SERRANO HERRERA','MARIA MACARENA','7040734-5','MARIA.SERRANO@USACH:CL','','','',2,30,2),
  (1702,'SHIRAZAWA CORTES','SEIJI CARLOS CRISTIAN','10054738-4','SEIJI.SHIRAZAWA@USACH:CL','','','',2,17,2),
  (1703,'SIEGEL EICHENWALD','PETER DENNY','4207748-8','PETER.SIEGEL@USACH:CL','','','',2,33,2),
  (1704,'SIEGEL ALMENDRAS','STEPHANIE JEANNE','8953693-6','STEPHANIE.SIEGEL@USACH:CL','','','',2,25,2),
  (1705,'SIERRA BOSCH','LUIS ALBERTO','4878595-6','LUIS.SIERRA@USACH:CL','','','',2,23,2),
  (1706,'SILVA BUCAREI','ESTER DE LAS MERCEDES','9589121-7','ESTER.SILVA@USACH:CL','','','',2,11,2),
  (1707,'SILVA CHANDIA','GERARDO MARIO ANTONIO','5271024-3','GERARDO.SILVA@USACH:CL','','','',2,34,2),
  (1708,'SILVA CORNEJO','CARLOS MANUEL','4812730-4','CARLOS.SILVA@USACH:CL','','','',2,19,2),
  (1709,'SILVA CASANUEVA','ROBERTO PATRICIO','8009117-6','ROBERTO.SILVA@USACH:CL','','','',2,10,2),
  (1710,'SILVA VERA','WLADIMIR ENRIQUE','15873394-3','WLADIMIR.SILVA@USACH:CL','','','',2,38,2),
  (1711,'SILVA NADALES','SEBASTIAN ANDRES','15840315-3','SEBASTIAN.SILVA@USACH:CL','','','',2,30,2),
  (1712,'SILVA MANCILLA','GABRIEL ALEJANDRO','15837100-6','GABRIEL.SILVA@USACH:CL','','','',2,30,2),
  (1713,'SILVA BRITO','JESSICA JACQUELINE','22429633-9','JESSICA.SILVA@USACH:CL','','','',2,11,2),
  (1714,'SILVA RUIZ-TAGLE','MARITZA ELIZABETH','9725490-7','MARITZA.SILVA@USACH:CL','','','',2,19,2),
  (1715,'SOCIAS TRUJILLO','MACARENA','10616753-2','MACARENA.SOCIAS@USACH:CL','','','',2,25,2),
  (1716,'SOLAR FUENTES','MAURICIO GONZALO','8397887-2','MAURICIO.SOLAR@USACH:CL','','','',2,12,2),
  (1717,'SOLER FARIAS','MARIA FILOMENA','6084432-1','MARIA.SOLER@USACH:CL','','','',2,14,2),
  (1718,'SOLIS FLORES','VIOLETA DEL CARMEN','5860835-1','VIOLETA.SOLIS@USACH:CL','','','',2,34,2),
  (1719,'SOLIS FLORES','FLOR CECILIA DEL PILAR','6373399-7','FLOR.SOLIS@USACH:CL','','','',2,19,2),
  (1720,'SOTO ARAYA','JORGE ARTURO','8788295-0','JORGE.SOTO@USACH:CL','','','',2,29,2),
  (1721,'SOTO VILLARROEL','GLADYS DEL CARMEN','5443845-1','GLADYS.SOTO@USACH:CL','','','',2,21,2),
  (1722,'SOTO NILO','HERNAN O HIGGINS','5068190-4','HERNAN.SOTO@USACH:CL','','','',2,8,2),
  (1723,'SOTO GOMEZ','JOSE ISMAEL','7148573-0','JOSE.SOTO@USACH:CL','','','',2,11,2),
  (1724,'SOTO TRONCOSO','ALICIA PATRICIA','5310239-5','ALICIA.SOTO@USACH:CL','','','',2,21,2),
  (1725,'SOTO MANCILLA','AVELINO LUIS','5573171-3','AVELINO.SOTO@USACH:CL','','','',2,19,2),
  (1726,'SOTO BAUERLE','MARIA VICTORIA','8229093-1','MARIA.SOTO@USACH:CL','','','',2,35,2),
  (1727,'SOTO IBARRA','LILIAN  MARIA ELIZABETH','7659329-9','LILIAN.SOTO@USACH:CL','','','',2,19,2),
  (1728,'SOTO MARQUEZ','MONICA DE LAS MERCEDES','10709395-8','MONICA.SOTO@USACH:CL',NULL,NULL,NULL,1,NULL,NULL),
  (1729,'SOTO MUNOZ','JAIME ANTONIO','9026268-8','JAIME.SOTO@USACH:CL','','','',2,11,2),
  (1730,'SOTO PERALTA','HECTOR FELIPE','14483814-9','HECTOR.SOTO@USACH:CL','','','',2,36,2),
  (1731,'SOTO GAJARDO','ELIZABETH MARITZA','13300223-5','ELIZABETH.SOTO@USACH:CL','','','',2,10,2),
  (1732,'SPENCER OSSA','EUGENIO GERMAN','5898418-3','EUGENIO.SPENCER@USACH:CL','','','',2,6,2),
  (1733,'STARKE LAGOS','HANS KARL RICHARD','10125226-4','HANS.STARKE@USACH:CL','','','',2,11,2),
  (1734,'STEPANOVA ','MARINA','14562924-1','MARINA.STEPANOVA@USACH:CL','','','',2,18,2),
  (1735,'STERNBERG GUINEZ','ERICK BERNARDO','5077645-K','ERICK.STERNBERG@USACH:CL','','','',2,10,2),
  (1736,'SUAREZ MOLINA','LUIS ALFREDO','6431082-8','LUIS.SUAREZ@USACH:CL','','','',2,25,2),
  (1737,'SUDY OLEA','JORGE ALBERTO','8980953-3','JORGE.SUDY@USACH:CL','','','',2,19,2),
  (1738,'SULZ ECHEVERRIA','LORENA PAZ','11846778-7','LORENA.SULZ@USACH:CL','','','',2,25,2),
  (1739,'TAGLE ESCOBAR','MARIO RUBEN','12659418-6','MARIO.TAGLE@USACH:CL','','','',2,19,2),
  (1740,'TAPIA MEZA','MARIA JOSE','16209402-5','MARIA.TAPIA@USACH:CL','','','',2,38,2),
  (1741,'TAPIA SOTO','GLORIA GIGLIOLA','13497365-K','GLORIA.TAPIA@USACH:CL','','','',2,11,2),
  (1742,'TAPIA RESTELLI','ROSA ANA','7624968-7','ROSA.TAPIA@USACH:CL','','','',2,25,2),
  (1743,'TARIFENO SALAZAR','EDUARDO PATRICIO','7825144-1','EDUARDO.TARIFENO@USACH:CL','','','',2,23,2),
  (1744,'TARRIDE FERNANDEZ','MARIO IVAN','7012886-1','MARIO.TARRIDE@USACH:CL','','','',2,11,2),
  (1745,'TELLEZ FUENTES','GONZALO GUILLERMO','6493603-4','GONZALO.TELLEZ@USACH:CL','','','',2,10,2),
  (1746,'THOMS LOBOS','RAUL NADIM','7236132-6','RAUL.THOMS@USACH:CL','','','',2,19,2),
  (1747,'THONET RODAS','GERARDO PATRICIO','5817882-9','GERARDO.THONET@USACH:CL','','','',2,25,2),
  (1748,'TOBAR QUEZADA','MARCOS AUGUSTO','5056065-1','MARCOS.TOBAR@USACH:CL','','','',2,5,2),
  (1749,'TOLEDO ZAPATA','ENRIQUE','10381539-8','ENRIQUE.TOLEDO@USACH:CL','','','',2,25,2),
  (1750,'TOLEDO VILLEGAS','GERARDO ENRIQUE','16146459-7','GERARDO.TOLEDO@USACH:CL','','','',2,25,2),
  (1751,'TOLEDO MERINO','RUTH DEL CARMEN','5853010-7','RUTH.TOLEDO@USACH:CL','','','',2,19,2),
  (1752,'TOLEDO VALENCIA','CECILIA DEL TRANSITO','5536926-7','CECILIA.TOLEDO@USACH:CL','','','',2,18,2),
  (1753,'TOLEDO IBARRA','JUAN ALEJANDRO','7034675-3','JUAN.TOLEDO@USACH:CL','','','',2,35,2),
  (1754,'TOLEDO URRUTIA','ALEJANDRO RODRIGO','12896859-8','ALEJANDRO.TOLEDO@USACH:CL','','','',2,19,2),
  (1755,'TOLOSA GONZALEZ','JORGE MAURICIO','10773015-K','JORGE.TOLOSA@USACH:CL','','','',2,25,2),
  (1756,'TORO IBACACHE','LENISSETT MC NEAL','11941970-0','LENISSETT.TORO@USACH:CL','','','',2,32,2),
  (1757,'TORO BRAVO','JORGE ENRIQUE','13065058-9','JORGE.TORO@USACH:CL','','','',2,29,2),
  (1758,'TORO NUNEZ','MAGDALENA DE LOURDES','14447359-0','MAGDALENA.TORO@USACH:CL','','','',2,40,2),
  (1759,'TORO BANDA','JORGE HUMBERTO','5247143-5','JORGE.TORO@USACH:CL','','','',2,29,2),
  (1760,'TORO NUNEZ','PAMELA FERNANDA','13504491-1','PAMELA.TORO@USACH:CL','','','',2,19,2),
  (1761,'TORRES ZAPATA','ISABEL EDITH','13041616-0','ISABEL.TORRES@USACH:CL','','','',2,21,2),
  (1762,'TORRES OYARZUN','JOSE RAMON','10532973-3','JOSE.TORRES@USACH:CL','','','',2,19,2),
  (1763,'TORRES FLORES','JOSE ALEJANDRO','9909524-5','JOSE.TORRES@USACH:CL','','','',2,34,2),
  (1764,'TORRES MANCILLA','MARITZA GIOCONDA','7104128-K','MARITZA.TORRES@USACH:CL','','','',2,33,2),
  (1765,'TORRES MONTALBETTI','EMMA MARIA ELENA','4677746-8','EMMA.TORRES@USACH:CL','','','',2,8,2),
  (1766,'TORRES MUNOZ','OSVALDO ENRIQUE','8115775-8','OSVALDO.TORRES@USACH:CL','','','',2,38,2),
  (1767,'TORRES PAIVA','BETZABE ANDREA','14142618-4','BETZABE.TORRES@USACH:CL','','','',2,18,2),
  (1768,'TORRES GALVEZ','SIMONET EVELYN','13839498-0','SIMONET.TORRES@USACH:CL','','','',2,7,2),
  (1769,'TORRES ARAGON','DIANA CRISTINA','22741023-K','DIANA.TORRES@USACH:CL','','','',2,11,2),
  (1770,'TORRES ROJAS','JOAQUIN','9829169-5','JOAQUIN.TORRES@USACH:CL','','','',2,25,2),
  (1771,'TRAVERSO CALDANA','LAURA EMILIA GIOCONDA','6715462-2','LAURA.TRAVERSO@USACH:CL','','','',2,30,2),
  (1772,'TREWHELA NAVARRETE','RICARDO IGNACIO','12263088-9','RICARDO.TREWHELA@USACH:CL','','','',2,25,2),
  (1773,'TRIGO JORQUERA','PABLO ENRIQUE','4985214-2','PABLO.TRIGO@USACH:CL','','','',2,5,2),
  (1774,'TROLLUND ORELLANA','EJNAR HUMBERTO','4764869-6','EJNAR.TROLLUND@USACH:CL','','','',2,8,2),
  (1775,'TRONCOSO ESCARATE','JUAN CARLOS','7471452-8','JUAN.TRONCOSO@USACH:CL','','','',2,34,2),
  (1776,'TRONCOSO ROSALES','GISELA VALESKA DEL CARMEN','13496558-4','GISELA.TRONCOSO@USACH:CL','','','',2,17,2),
  (1777,'TRONCOSO VILLA','SERGIO DEL CARMEN','6617669-K','SERGIO.TRONCOSO@USACH:CL','','','',2,29,2),
  (1778,'UBILLA LOPEZ','PEDRO EDUARDO','9000064-0','PEDRO.UBILLA@USACH:CL','','','',2,19,2),
  (1779,'UGARTE SALDIVIA','YESSICA ANDREA','12654842-7','YESSICA.UGARTE@USACH:CL','','','',2,35,2),
  (1780,'UGARTE CORREA','MARIA LUISA','7022898-K','MARIA.UGARTE@USACH:CL','','','',2,30,2),
  (1781,'UNDA CHIAVEGAT','MARCELO SANTIAGO','6262353-5','MARCELO.UNDA@USACH:CL','','','',2,25,2),
  (1782,'URBINA CERDA','OLIVIA SOLEDAD','6875043-1','OLIVIA.URBINA@USACH:CL','','','',2,5,2),
  (1783,'URBINA RODRIGUEZ','FRANCISCO JAVIER','12661966-9','FRANCISCO.URBINA@USACH:CL','','','',2,8,2),
  (1784,'URETA ZANARTU','MARIA SOLEDAD','6026317-5','MARIA.URETA@USACH:CL','','','',2,7,2),
  (1785,'URETA BARRA','SERGIO HERNAN','5525170-3','SERGIO.URETA@USACH:CL','','','',2,25,2),
  (1786,'URRA SILVA','MILTON FERNANDO','9745956-8','MILTON.URRA@USACH:CL','','','',2,30,2),
  (1787,'URRA TOBAR','BENITO ALONSO','13047112-9','BENITO.URRA@USACH:CL','','','',2,30,2),
  (1788,'URRA HERNANDEZ','JOHANA EDITH','13250294-3','JOHANA.URRA@USACH:CL','','','',2,15,2),
  (1789,'URREA ONATE','ELEUTERIO CLAUDIO','10265767-5','ELEUTERIO.URREA@USACH:CL','','','',2,10,2),
  (1790,'URRUTIA CHIGUAY','MARCELO ANDRES','12122958-7','MARCELO.URRUTIA@USACH:CL','','','',2,19,2),
  (1791,'URZUA GARRIDO','OLGA PILAR','13045852-1','OLGA.URZUA@USACH:CL','','','',2,19,2),
  (1792,'URZUA MOLL','ALEJANDRO','4106949-K','ALEJANDRO.URZUA@USACH:CL','','','',2,7,2),
  (1793,'URZUA STRICKER','CARLOS CLAUDIO','6445368-8','CARLOS.URZUA@USACH:CL','','','',2,7,2),
  (1794,'VALDEBENITO GINART','JESUS HORTENCIA','7670888-6','JESUS.VALDEBENITO@USACH:CL','','','',2,21,2),
  (1795,'VALDERRAMA RODRIGUEZ','ALEJANDRO','9020909-4','ALEJANDRO.VALDERRAMA@USACH:CL','','','',2,25,2),
  (1796,'VALDES RUNCO','MIGUEL ANGEL','9036945-8','MIGUEL.VALDES@USACH:CL','','','',2,13,2),
  (1797,'VALDES SOTELO','LUIS ENRIQUE','12240329-7','LUIS.VALDES@USACH:CL','','','',2,34,2),
  (1798,'VALDES PAREJA','LUIS ANGEL','9864979-4','LUIS.VALDES@USACH:CL','','','',2,10,2),
  (1799,'VALDES REBOLLEDO','LUIS RENE','7419198-3','LUIS.VALDES@USACH:CL','','','',2,34,2),
  (1800,'VALDES RIQUELME','HUGO PATRICIO','14009788-8','HUGO.VALDES@USACH:CL','','','',2,11,2),
  (1801,'VALDES LARRONDO','CLAUDIO ANDRES','13905923-9','CLAUDIO.VALDES@USACH:CL','','','',2,10,2),
  (1802,'VALDIVIA MUNOZ','SAMUEL DAVID','4339671-4','SAMUEL.VALDIVIA@USACH:CL','','','',2,19,2),
  (1803,'VALDIVIA PRADENAS','VICTOR GUSTAVO','4532290-4','VICTOR.VALDIVIA@USACH:CL','','','',2,11,2),
  (1804,'VALDIVIA OLIVARES','ALVARO','3646364-3','ALVARO.VALDIVIA@USACH:CL','','','',2,19,2),
  (1805,'VALDIVIA ORTIZ DE ZARATE','VERONICA DEL PILAR','7989772-8','VERONICA.VALDIVIA@USACH:CL','','','',2,32,2),
  (1806,'VALDIVIA ARENAS','NINA ELENA','8560541-0','NINA.VALDIVIA@USACH:CL','','','',2,19,2),
  (1807,'VALDIVIA DATTOLI','PATRICIO GERMAN','2554490-0','PATRICIO.VALDIVIA@USACH:CL','','','',2,25,2),
  (1808,'VALDIVIA PENA','DANIELA ALEJANDRA','12868574-K','DANIELA.VALDIVIA@USACH:CL','','','',2,25,2),
  (1809,'VALENCIA REYES','GUADALUPE ERCILIA','6877972-3','GUADALUPE.VALENCIA@USACH:CL','','','',2,32,2),
  (1810,'VALENCIA MONTERO','CLAUDIO ANDRES','14243586-1','CLAUDIO.VALENCIA@USACH:CL','','','',2,33,2),
  (1811,'VALENCIA CORDERO','CLAUDIO TOMAS','21370099-5','CLAUDIO.VALENCIA@USACH:CL','','','',2,11,2),
  (1812,'VALENCIA CASTANEDA','RODRIGO SEGUNDO','10100595-K','RODRIGO.VALENCIA@USACH:CL','','','',2,32,2),
  (1813,'VALENCIA PALACIOS','MARCO ANTONIO','12474244-7','MARCO.VALENCIA@USACH:CL','','','',2,17,2),
  (1814,'VALENZUELA VENEGAS','JUAN DAGOBERTO','12058009-4','JUAN.VALENZUELA@USACH:CL','','','',2,12,2),
  (1815,'VALENZUELA ROJAS','MARIA CRISTINA','12160949-5','MARIA.VALENZUELA@USACH:CL','','','',2,6,2),
  (1816,'VALENZUELA ERAZO','MARICEL ANDREA','13248955-6','MARICEL.VALENZUELA@USACH:CL','','','',2,25,2),
  (1817,'VALENZUELA MELLA','JOCELYN VERONICA','14468489-3','JOCELYN.VALENZUELA@USACH:CL','','','',2,6,2),
  (1818,'VALENZUELA PONCE','MANUEL ALEXIS','5085315-2','MANUEL.VALENZUELA@USACH:CL','','','',2,10,2),
  (1819,'VALENZUELA BURGOS','DENNIS EDGARDO','4078454-3','DENNIS.VALENZUELA@USACH:CL','','','',2,25,2),
  (1820,'VALENZUELA BARNECH','CLAUDIO ALBERTO','3975400-2','CLAUDIO.VALENZUELA@USACH:CL','','','',2,19,2),
  (1821,'VALENZUELA BASCUNAN','XIMENA DEL CARMEN','11863488-8','XIMENA.VALENZUELA@USACH:CL','','','',2,38,2),
  (1822,'VALENZUELA ROMAN','YASNA PAOLA','11641999-8','YASNA.VALENZUELA@USACH:CL','','','',2,30,2),
  (1823,'VALENZUELA GALVEZ','FRANCISCO ELIAS','9003668-8','FRANCISCO.VALENZUELA@USACH:CL','','','',2,13,2),
  (1824,'VALENZUELA MORA','CRISTIAN FABIAN','15092288-7','CRISTIAN.VALENZUELA@USACH:CL','','','',2,18,2),
  (1825,'VALERO GONZALEZ','EDUARDO ABSALON','4109363-3','EDUARDO.VALERO@USACH:CL','','','',2,8,2),
  (1826,'VALVERDE PERALTA','FLORENCIO ORLANDO','4633551-1','FLORENCIO.VALVERDE@USACH:CL','','','',2,19,2),
  (1827,'VANIN FREIRE','MAURICIO ROMAN','13266530-3','MAURICIO.VANIN@USACH:CL','','','',2,10,2),
  (1828,'VARAS CONTRERAS','HUMBERTO ENRIQUE','3839472-K','HUMBERTO.VARAS@USACH:CL','','','',2,21,2),
  (1829,'VARGAS SANDOVAL','MARIA GABRIELA','9470088-4','MARIA.VARGAS@USACH:CL','','','',2,30,2),
  (1830,'VARGAS PUGA','ANA CRISTINA','5899249-6','ANA.VARGAS@USACH:CL','','','',2,5,2),
  (1831,'VARGAS FIGUEROA','PEDRO FLORIDOR','6142361-3','PEDRO.VARGAS@USACH:CL','','','',2,11,2),
  (1832,'VARGAS JARMET','SERGIO HUGO','4103475-0','SERGIO.VARGAS@USACH:CL','','','',2,26,2),
  (1833,'VARGAS SALAZAR','RENATO AQUILES','5177740-9','RENATO.VARGAS@USACH:CL','','','',2,34,2),
  (1834,'VARGAS RONA','CLAUDIO ANDRES','8041302-5','CLAUDIO.VARGAS@USACH:CL','','','',2,35,2),
  (1835,'VARGAS HERRERA','RODRIGO LUIS','8395637-2','RODRIGO.VARGAS@USACH:CL','','','',2,18,2),
  (1836,'VARGAS DIAZ-MUNOZ','IVAN ENRIQUE','7629924-2','IVAN.VARGAS@USACH:CL','','','',2,38,2),
  (1837,'VARGAS PACHECO','CARLOS ALFREDO','15844829-7','CARLOS.VARGAS@USACH:CL','','','',2,36,2),
  (1838,'VARGAS RODRIGUEZ','EUGENIO ELIAS MATIAS','13905137-8','EUGENIO.VARGAS@USACH:CL','','','',2,30,2),
  (1839,'VARGAS SANHUEZA','RENATO  HERNAN','9392853-9','RENATO.VARGAS@USACH:CL','','','',2,25,2),
  (1840,'VASQUEZ VILLEGAS','JOSE ARTURO','10433785-6','JOSE.VASQUEZ@USACH:CL','','','',2,10,2),
  (1841,'VASQUEZ ULLOA','PATRICIO ALEJANDRO','10784314-0','PATRICIO.VASQUEZ@USACH:CL','','','',2,25,2),
  (1842,'VASQUEZ GUZMAN','MARINA DAYANA','15605247-7','MARINA.VASQUEZ@USACH:CL','','','',2,25,2),
  (1843,'VASQUEZ MORCILLO','GLORIA ELENA','5817504-8','GLORIA.VASQUEZ@USACH:CL','','','',2,19,2),
  (1844,'VASQUEZ ORTIZ','LAUTARO VICTOR','13910519-2','LAUTARO.VASQUEZ@USACH:CL','','','',2,19,2),
  (1845,'VEAS SANCHEZ','ALICIA JIMENA','8863000-9','ALICIA.VEAS@USACH:CL','','','',2,31,2),
  (1846,'VEAS BROKERING','VERONICA','8959995-4','VERONICA.VEAS@USACH:CL','','','',2,17,2),
  (1847,'VEAS GOMEZ','CECILIA BEATRIZ','10200876-6','CECILIA.VEAS@USACH:CL','','','',2,25,2),
  (1848,'VEGA JERIA','RAUL HUMBERTO','9747452-4','RAUL.VEGA@USACH:CL','','','',2,17,2),
  (1849,'VEGA BAIGORRI','ROLANDO EDUARDO','5425155-6','ROLANDO.VEGA@USACH:CL','','','',2,15,2),
  (1850,'VEGA ABDALA','SANTIAGO ARTURO','4673395-9','SANTIAGO.VEGA@USACH:CL','','','',2,19,2),
  (1851,'VEGA PEREZ','MANUEL LUIS','5202561-3','MANUEL.VEGA@USACH:CL','','','',2,10,2),
  (1852,'VEGA ROMAN','OLGA ESTER','7382934-8','OLGA.VEGA@USACH:CL','','','',2,10,2),
  (1853,'VEGA JONES','RODRIGO INTI','13050615-1','RODRIGO.VEGA@USACH:CL','','','',2,25,2),
  (1854,'VEGA MARTINOYA','LINA MARIA EUGENIA','5033853-3','LINA.VEGA@USACH:CL','','','',2,27,2),
  (1855,'VEGA URQUIETA','MARIA ANGELICA','5543311-9','MARIA.VEGA@USACH:CL','','','',2,19,2),
  (1856,'VEGA YANEZ','SYLVANA ANDREA','12010330-K','SYLVANA.VEGA@USACH:CL','','','',2,13,2),
  (1857,'VEGA BRAVO','MARCELA SOLEDAD','10266655-0','MARCELA.VEGA@USACH:CL','','','',2,33,2),
  (1858,'VEGA ESPINOZA','VIVIANA DEL CARMEN','9765354-2','VIVIANA.VEGA@USACH:CL','','','',2,32,2),
  (1859,'VEJAR REYES','VALERIA ANDREA','15463461-4','VALERIA.VEJAR@USACH:CL','','','',2,8,2),
  (1860,'VEJAR VARGAS','NELSON DANIEL','13942867-6','NELSON.VEJAR@USACH:CL','','','',2,8,2),
  (1861,'VEJAR PEREZ','ANDRES ALBERTO','13499222-0','ANDRES.VEJAR@USACH:CL','','','',2,11,2),
  (1862,'VELASCO SAN MARTIN','VERONICA ALICIA','7311769-0','VERONICA.VELASCO@USACH:CL','','','',2,19,2),
  (1863,'VELASQUEZ VASQUEZ','ROBERTO FRANCISCO','8122422-6','ROBERTO.VELASQUEZ@USACH:CL','','','',2,34,2),
  (1864,'VELASQUEZ CUMPLIDO','LUIS ALBERTO','10665651-7','LUIS.VELASQUEZ@USACH:CL','','','',2,6,2),
  (1865,'VELASQUEZ SEGOVIA','CLAUDIO ARTURO','10673581-6','CLAUDIO.VELASQUEZ@USACH:CL','','','',2,13,2),
  (1866,'VELIZ HUINE','FABIAN ARSENIO','9264778-1','FABIAN.VELIZ@USACH:CL','','','',2,37,2),
  (1867,'VELOZ POZO','SERGIO FRANCISCO','10911110-4','SERGIO.VELOZ@USACH:CL','','','',2,34,2),
  (1868,'VELOZO FARIAS','RAUL EUSEBIO LINO','3424192-9','RAUL.VELOZO@USACH:CL','','','',2,40,2),
  (1869,'VELOZO PAPEZ','LUIS FRANCISCO','7590260-3','LUIS.VELOZO@USACH:CL','','','',2,25,2),
  (1870,'VENEGAS URENDA','VICTORIA REBECA','7746825-0','VICTORIA.VENEGAS@USACH:CL','','','',2,26,2),
  (1871,'VENEGAS VALDEBENITO','HERNAN ADRIAN','8355221-2','HERNAN.VENEGAS@USACH:CL','','','',2,32,2),
  (1872,'VENEGAS MARCEL','MARCELO EDUARDO','11436469-K','MARCELO.VENEGAS@USACH:CL','','','',2,36,2),
  (1873,'VERA BARRIENTOS','MIGUEL ANGEL','10381023-K','MIGUEL.VERA@USACH:CL','','','',2,33,2),
  (1874,'VERA VILLARROEL','PABLO ENRIQUE','10200450-7','PABLO.VERA@USACH:CL','','','',2,30,2),
  (1875,'VERA CARDENAS','ESTER DEL CARMEN','11107228-0','ESTER.VERA@USACH:CL','','','',2,34,2),
  (1876,'VERA SANTIBANEZ','ANDREA DEL CARMEN','14555088-2','ANDREA.VERA@USACH:CL','','','',2,17,2),
  (1877,'VERA VERA','HECTOR ALFONSO','5240211-5','HECTOR.VERA@USACH:CL','','','',2,29,2),
  (1878,'VERA SALAZAR','ROSA MARIA ELIANA','6622315-9','ROSA.VERA@USACH:CL','','','',2,8,2),
  (1879,'VERA VIVANCO','MARIA CECILIA','12883308-0','MARIA.VERA@USACH:CL','','','',2,17,2),
  (1880,'VERA CODOCEDO','RICARDO ALBERTO','12612855-K','RICARDO.VERA@USACH:CL','','','',2,10,2),
  (1881,'VERA ARAYA','JEANNETTE MARISOL','13696610-3','JEANNETTE.VERA@USACH:CL','','','',2,6,2),
  (1882,'VERA ACEVEDO','VICTOR HUGO','5712494-6','VICTOR.VERA@USACH:CL','','','',2,27,2),
  (1883,'VERA SAN MARTIN','MARIA','6986152-0','MARIA.VERA@USACH:CL','','','',2,25,2),
  (1884,'VERA GONZALEZ','JUAN ANTONIO','5866480-4','JUAN.VERA@USACH:CL','','','',2,25,2),
  (1885,'VERDUGO CHAURA','DANILO ANTONIO','11625652-5','DANILO.VERDUGO@USACH:CL','','','',2,35,2),
  (1886,'VERGARA COFRE','LAUTARO JOSE FRANCISCO','8986832-7','LAUTARO.VERGARA@USACH:CL','','','',2,18,2),
  (1887,'VERGARA CISTERNA','PEDRO ANTONIO','5813120-2','PEDRO.VERGARA@USACH:CL','','','',2,18,2),
  (1888,'VERGARA ARANA','RUBEN HERNAN','4667702-1','RUBEN.VERGARA@USACH:CL','','','',2,37,2),
  (1889,'VERGARA REYES','HUGO HUMBERTO','6878940-0','HUGO.VERGARA@USACH:CL','','','',2,36,2),
  (1890,'VERGARA AGUILAR','LUIS VICENTE','12108855-K','LUIS.VERGARA@USACH:CL','','','',2,19,2),
  (1891,'VERGARA CORONADO','VICTOR MANUEL','14185376-7','VICTOR.VERGARA@USACH:CL','','','',2,10,2),
  (1892,'VERGARA VALLS','JOANNA ANDREA','12869187-1','JOANNA.VERGARA@USACH:CL','','','',2,8,2),
  (1893,'VIAL LATORRE','ALEJANDRO AUGUSTO','5522725-K','ALEJANDRO.VIAL@USACH:CL','','','',2,35,2),
  (1894,'VICENCIO MOLINA','MARTA AIDA','6314641-2','MARTA.VICENCIO@USACH:CL','','','',2,11,2),
  (1895,'VICENCIO MOLINA','PATRICIA MARGARITA','6314640-4','PATRICIA.VICENCIO@USACH:CL','','','',2,11,2),
  (1896,'VIDAL MIRANDA','KAREN PAULINA','13083628-3','KAREN.VIDAL@USACH:CL','','','',2,25,2),
  (1897,'VIDAL ASTUDILLO','MATIAS SEBASTIAN','15315551-8','MATIAS.VIDAL@USACH:CL','','','',2,13,2),
  (1898,'VIDELA AROS','MYRNA VALENTINA','9019502-6','MYRNA.VIDELA@USACH:CL','','','',2,36,2),
  (1899,'VIDELA ALVAREZ','JULIO PATRICIO','5560401-0','JULIO.VIDELA@USACH:CL','','','',2,19,2),
  (1900,'VIEYRA SERRANO','JULIO ALBERTO','5520988-K','JULIO.VIEYRA@USACH:CL','','','',2,10,2),
  (1901,'VILCA CACERES','GUMERCINDO SEGUNDO','5982057-5','GUMERCINDO.VILCA@USACH:CL','','','',2,5,2),
  (1902,'VILCHES FUENTES','LUIS ARTURO','6739961-7','LUIS.VILCHES@USACH:CL','','','',2,33,2),
  (1903,'VILLA VIERTEL','JORGE OCTAVIO','14467036-1','JORGE.VILLA@USACH:CL','','','',2,10,2),
  (1904,'VILLABLANCA ICARTE','ALICIA SILVIA DEL CARMEN','6447191-0','ALICIA.VILLABLANCA@USACH:CL','','','',2,19,2),
  (1905,'VILLABLANCA GALVEZ','ROBERTO ANDRES','5164815-3','ROBERTO.VILLABLANCA@USACH:CL','','','',2,33,2),
  (1906,'VILLAFAENA UGARTE','JOSE ANTONIO','7774122-4','JOSE.VILLAFAENA@USACH:CL','','','',2,34,2),
  (1907,'VILLAGRA VALENZUELA','EDGARDO','5405819-5','EDGARDO.VILLAGRA@USACH:CL','','','',2,13,2),
  (1908,'VILLAGRAN RIVAS','SIDNEY HERNAN','10965656-9','SIDNEY.VILLAGRAN@USACH:CL','','','',2,18,2),
  (1909,'VILLALOBOS MARIN','EMILIO NARCISO','4211089-2','EMILIO.VILLALOBOS@USACH:CL','','','',2,19,2),
  (1910,'VILLALOBOS VERGARA','PAULA VERONICA','12793449-5','PAULA.VILLALOBOS@USACH:CL','','','',2,31,2),
  (1911,'VILLALTA PAUCAR','MARCO ANTONIO','14561698-0','MARCO.VILLALTA@USACH:CL','','','',2,30,2),
  (1912,'VILLANUEVA ILUFI','MONICA ROSA','5166831-6','MONICA.VILLANUEVA@USACH:CL','','','',2,12,2),
  (1913,'VILLARREAL FARAH','GONZALO','10851312-8','GONZALO.VILLARREAL@USACH:CL','','','',2,19,2),
  (1914,'VILLARROEL MORALES','MARIELA PATRICIA','13486197-5','MARIELA.VILLARROEL@USACH:CL','','','',2,8,2),
  (1915,'VILLARROEL','LUIS HELLMUT','4037511-2','LUIS.VILLARROEL@USACH:CL','','','',2,7,2),
  (1916,'VILLEGAS LORCA','CARLOS','2978331-4','CARLOS.VILLEGAS@USACH:CL','','','',2,37,2),
  (1917,'VILLOUTA OSORIO','PATRICIA ISABEL','12658694-9','PATRICIA.VILLOUTA@USACH:CL','','','',2,36,2),
  (1918,'VILO LAGOS','JORGE HERNAN','5223479-4','JORGE.VILO@USACH:CL','','','',2,11,2),
  (1919,'VILOS ORTIZ','CRISTIAN ANDRES','15129620-3','CRISTIAN.VILOS@USACH:CL','','','',2,6,2),
  (1920,'VIOVY ALARCON','ALEJANDRO VLADIMIR','8350049-2','ALEJANDRO.VIOVY@USACH:CL','','','',2,25,2),
  (1921,'VIVEROS MACHUCA','LISANDRO GUILLERMO','4533365-5','LISANDRO.VIVEROS@USACH:CL','','','',2,25,2),
  (1922,'VIVES NAVARRO','HERNAN IGNACIO','13062076-0','HERNAN.VIVES@USACH:CL','','','',2,33,2),
  (1923,'WALL ZIEGLER','RENATE MARGOT','9135940-5','RENATE.WALL@USACH:CL','','','',2,33,2),
  (1924,'WALTON LARRAGUIBEL','RODERICK','6450093-7','RODERICK.WALTON@USACH:CL','','','',2,25,2),
  (1925,'WAMAN MORAGA','ALVARO ANDRES','13679891-K','ALVARO.WAMAN@USACH:CL','','','',2,10,2),
  (1926,'WATKINS ORELLANA','FRANCISCO JOSE','5112183-K','FRANCISCO.WATKINS@USACH:CL','','','',2,10,2),
  (1927,'WIESCHOLLEK ACOSTA','JUAN PABLO','7719795-8','JUAN.WIESCHOLLEK@USACH:CL','','','',2,31,2),
  (1928,'WINKLER MULLER','MARIA INES','6718945-0','MARIA.WINKLER@USACH:CL','','','',2,30,2),
  (1929,'WLADDIMIRO ESTAY','MONICA GABRIELA','5020899-0','MONICA.WLADDIMIRO@USACH:CL','','','',2,30,2),
  (1930,'YANCA MENDEZ','LUIS OSVALDO','13488655-2','LUIS.YANCA@USACH:CL','','','',2,14,2),
  (1931,'YANEZ BETANCOURT','LEOPOLDO RICARDO','3793537-9','LEOPOLDO.YANEZ@USACH:CL','','','',2,23,2),
  (1932,'YANEZ CATALAN','LINA KATY','11109571-K','LINA.YANEZ@USACH:CL','','','',2,38,2),
  (1933,'YANEZ VILLOUTA','CHRISTIAN MARCELO','9906914-7','CHRISTIAN.YANEZ@USACH:CL','','','',2,19,2),
  (1934,'YANEZ PEREZ','MICHAEL RAFAEL','13937173-9','MICHAEL.YANEZ@USACH:CL','','','',2,19,2),
  (1935,'YARUR SAID','CECILIA','6285431-6','CECILIA.YARUR@USACH:CL','','','',2,19,2),
  (1936,'YEVENES ANDAUR','LUISA ELIANA','11532249-4','LUISA.YEVENES@USACH:CL','','','',2,21,2),
  (1937,'YEVENES ORTEGA','CARLOS FELIPE','15432304-K','CARLOS.YEVENES@USACH:CL','','','',2,22,2),
  (1938,'YOTSUMOTO FAGUETT','CLAUDIO GUILLERMO','5896704-1','CLAUDIO.YOTSUMOTO@USACH:CL','','','',2,35,2),
  (1939,'YUPANQUI POMA','VERONICA','22123750-1','VERONICA.YUPANQUI@USACH:CL','','','',2,19,2),
  (1940,'ZACCARELLI VENDER','OSCAR DIODORO','2596633-3','OSCAR.ZACCARELLI@USACH:CL','','','',2,17,2),
  (1941,'ZAGAL MOYA','JOSE HERACLITO','6154375-9','JOSE.ZAGAL@USACH:CL','','','',2,8,2),
  (1942,'ZAMORA FARIAS','HUGO EDUARDO','5328116-8','HUGO.ZAMORA@USACH:CL','','','',2,10,2),
  (1943,'ZAMORANO RIQUELME','MARCELA ALEJANDRA','9286635-1','MARCELA.ZAMORANO@USACH:CL','','','',2,38,2),
  (1944,'ZAMORANO CORNEJO','CALIXTO HERNAN','5812949-6','CALIXTO.ZAMORANO@USACH:CL','','','',2,34,2),
  (1945,'ZAMORANO CECCHI','CARLA ANDREA','6558978-8','CARLA.ZAMORANO@USACH:CL','','','',2,25,2),
  (1946,'ZAMORANO MOSNAIM','MAURICIO JAVIER','14221924-7','MAURICIO.ZAMORANO@USACH:CL','','','',2,15,2),
  (1947,'ZAMORANO ROJAS','ARIEL SEBASTIAN','15377558-3','ARIEL.ZAMORANO@USACH:CL','','','',2,11,2),
  (1948,'ZANARTU BRAVO','OLGA PATRICIA','7689990-8','OLGA.ZANARTU@USACH:CL','','','',2,27,2),
  (1949,'ZAPATA MALDONADO','MAXIMO SEGUNDO','5689924-3','MAXIMO.ZAPATA@USACH:CL','','','',2,35,2),
  (1950,'ZAPATA TAPIA','MARIO ORLANDO','5413139-9','MARIO.ZAPATA@USACH:CL','','','',2,13,2),
  (1951,'ZAPATA VASQUEZ','JULIO ENRIQUE','7848896-4','JULIO.ZAPATA@USACH:CL','','','',2,33,2),
  (1952,'ZAPATA ASCENCIO','PATRICIO ALBERTO','13070124-8','PATRICIO.ZAPATA@USACH:CL','','','',2,17,2),
  (1953,'ZAPATA GONZALEZ','EDUARDO ALEJANDRO','13858230-2','EDUARDO.ZAPATA@USACH:CL','','','',2,35,2),
  (1954,'ZAPATA PEREZ','LUIS ALEJANDRO','15078658-4','LUIS.ZAPATA@USACH:CL','','','',2,25,2),
  (1955,'ZEGERS QUINTEROS','CARLOS VALERIO','5818324-5','CARLOS.ZEGERS@USACH:CL','','','',2,15,2),
  (1956,'ZEISE SSA.','MARC LEANDER','14607337-9','MARC.ZEISE@USACH:CL','','','',2,30,2),
  (1957,'ZENTENO ROZAS','JAIME ANTONIO','6498625-2','JAIME.ZENTENO@USACH:CL','','','',2,13,2),
  (1958,'ZEPEDA GODOY','RENE ARMANDO','7472430-2','RENE.ZEPEDA@USACH:CL','','','',2,35,2),
  (1959,'ZORRILLA FUENZALIDA','SERGIO MARIO','5390326-6','SERGIO.ZORRILLA@USACH:CL','','','',2,25,2),
  (1960,'ZUCCAR PARRINI','IRENE ROSA','13046178-6','IRENE.ZUCCAR@USACH:CL','','','',2,12,2),
  (1961,'ZULETA SIPPA','RICARDO EUGENIO','10087044-4','RICARDO.ZULETA@USACH:CL','','','',2,25,2),
  (1962,'ZUNIGA QUINTANILLA','UBALDO AMABLE','5357312-6','UBALDO.ZUNIGA@USACH:CL','','','',2,13,2),
  (1963,'ZUNIGA HIGUERA','AQUILES ENRIQUE','7417833-2','AQUILES.ZUNIGA@USACH:CL','','','',2,10,2),
  (1964,'ZUNIGA URZUA','RITA MARIA ISABEL','6377035-3','RITA.ZUNIGA@USACH:CL','','','',2,27,2),
  (1965,'ZUNIGA LAMARQUE','MARIA LUISA','6592639-3','MARIA.ZUNIGA@USACH:CL','','','',2,17,2),
  (1966,'ZUNIGA POBLETE','MANUEL AGUSTO','6486437-8','MANUEL.ZUNIGA@USACH:CL','','','',2,5,2),
  (1967,'ZUNIGA VON DER MEDEN','OLIVIA','5191588-7','OLIVIA.ZUNIGA@USACH:CL','','','',2,36,2),
  (1968,'ZUNIGA VIDELA','MILTON GUSTAVO','13609478-5','MILTON.ZUNIGA@USACH:CL','','','',2,11,2),
  (1969,'ZUNZUNEGUI HERRERA','JULIO','4172402-1','JULIO.ZUNZUNEGUI@USACH:CL','','','',2,25,2),
  (1970,'ESCOBAR FICA','JORGE','EXT-JESCOBAR',NULL,'','','',2,16,9),
  (1971,'COTTET BUSTAMANTE','LUIS EDUARDO','13289258-k','luis.cottet@usach.cl','','','',2,6,2),
  (1972,'JAÑA VERDUGO','YANARA DANINA','EXT-YJAÑA','yanarajv@ug.uchile.cl','','','',2,6,12),
  (1973,'LAGOS AGUIRRE','CAROLINA','11031493-0',NULL,'','','',2,10,2),
  (1974,'YANEZ SANCHEZ','MAURICIO EDINSON','14448673-0','mauricio.yanez@usach.cl','','','',2,7,2),
  (1975,'MOLINA','RODRIGO','EXT-RMOLINA',NULL,'','','',2,16,20),
  (1976,'KERN MOLINA','JOHN ALBERTO','11549538-0','john.kern@usach.cl','','','',2,10,2),
  (1977,'ARTIGAS ABUIN','ALFREDO','11845057-4','alfredo.artigas@usach.cl','','','',2,14,2),
  (1978,'Travieso Torres','Juan Carlos','14706220-6','juan.travieso@usach.cl','','','',2,10,2),
  (1979,'ROSAS OLIVOS','ERIKA SUSANA','15556000-2','erika.rosas@usach.cl','','','',2,39,2),
  (1980,'HIDALGO CASTILLO','NICOLAS ANDRES','15589871-2','nicolas.hidalgo@usach.cl','','','',2,12,2),
  (1981,'GIL-COSTA','VERONICA','24315663-7',NULL,'','','',2,12,2),
  (1982,'','','',NULL,'','','',2,16,1),
  (1983,'BONACIC CASTRO','CAROLINA ALEJANDRA','12018861-5','','','','',2,39,2),
  (1984,'CASTILLO CASTILLO','XIMENA ANDREA','USACH-XCASTILLO',NULL,'','','',2,15,2),
  (1985,'JARA MORALES','SEBASTIAN ANDRES','16304067-0',NULL,'','','',2,10,21),
  (1986,'BELZILE','NELSON','EXT-NBELZILE',NULL,'','','',2,16,1),
  (1987,'GRANCELLI OLIVEIRA','ALEJANDRO OCTAVIO','17028451-8',NULL,'','','',2,16,1),
  (1988,'GODOY PEDRAZA','DIEGO ORLANDO','16910037-3',NULL,'','','',2,16,1),
  (1989,'TAPIA','PAMELA','EXT-PTAPIA',NULL,'','','',2,16,1),
  (1990,'SANDOVAL ANTINAO','MATIAS RICARDO','17411298-3','m.sandoval.a@hotmail.com','','','',2,16,21),
  (1991,'PACHECO PARRA','GONZALO ANDRES','17269181-1',NULL,'','','',2,13,21),
  (1992,'TORO ASCUY','DANIELA ANDREA','16360270-9',NULL,'','','',2,6,21),
  (1993,'TAMBLEY','CAROLINA','AL-CTAMBLEY',NULL,'','','',2,7,21),
  (1994,'BELTRAN','CAROLINA 2','EXT-CBELTRAN',NULL,'','','',2,16,1),
  (1996,'MENA','GERALDINE FRANCISCA','16630272-2',NULL,'','','',2,16,21),
  (1997,'LEIVA','NICOLAS','17003438-4',NULL,'','','',2,16,21),
  (1998,'AGNESE','MARIEL','EXT-MAGNESE',NULL,'','','',2,16,1),
  (1999,'TONN','CARLOS','EXT-CTONN',NULL,'','','',2,16,1),
  (2000,'VALLEJOS','MARIANA','EXT-MVALLEJOS',NULL,'','','',2,16,1),
  (2001,'TAMAYO VILLAROEL','LAURA ANDREA','15546145-4',NULL,'','','',2,6,2),
  (2002,'ALLENDE PRIETO','SEBASTIAN EDUARDO','14120602-8',NULL,'','','',2,18,2),
  (2003,'ESCOBAR DONOSO','ROBERTO','15535732-6',NULL,'','','',2,18,2),
  (2004,'VARGAS AYALA','NICOLAS','16984467-4',NULL,'','','',2,18,21),
  (2005,'CASTILLO SEPULVEDA','SEBASTIAN','17416379-0',NULL,'','','',2,18,21),
  (2006,'PEREIRA BAHIANA','MONICA','3384197',NULL,'','','',2,16,14);
COMMIT;

/* Data for the `investigador` table  (LIMIT 2000,500) */

INSERT INTO `investigador` (`idInvestigador`, `apellidos`, `nombres`, `numeroIdentificacion`, `email`, `telefonoFijo`, `telefonoMovil`, `direccion`, `idPerfilInvestigador`, `departamento_id`, `institucion_id`) VALUES
  (2007,'D´ALBUQUERQUE E CASTRO','JOSE','3336054',NULL,'','','',2,16,14),
  (2008,'SILVA LEIVA','TABITA SARAI','17590387-9',NULL,'','','',2,22,21),
  (2009,'CABA GAJARDO','SEBASTIAN IGNACIO','17313594-7',NULL,'','','',2,5,21),
  (2010,'CORTES CATALAN','SALVADOR','16150929-9',NULL,'','','',2,12,21),
  (2011,'SOTO GUEVARA','NATALIA ANDREA','17.023.028-0','Natalia.sotog@usach.cl','','','',2,11,21),
  (2012,'VIDAL NEIRA','LIZZY SOLEDAD','15536732-6','lizzyvidal@gmail.com','','','',2,22,21),
  (2013,'SILVA RAMIREZ','BALTHAZAR ULISES','18.668.624-1','balthazar.silva94@gmail.com','','','',2,5,21),
  (2014,'MUÑOZ CONCHA','ARMANDO ANDREZ','15772413-4','arm.munozc@gmail.com','','','',2,36,21),
  (2015,'SANTIAGO OLMED','ROBERTO ANTONIO','17312957-2','Roberto.santiago@usach.cl','','','',2,15,21),
  (2016,'LAGOS ORMEÑO','JAIME FELIPE','17227631-8','Jaime.lagos@usach.cl','','','',2,18,1),
  (2017,'ACEVEDO SOTO','LORETO ESTER','17504874-K','Loreto.acevedo@usach.cl','','','',2,38,21),
  (2018,'MANFREDI SANTIS','CAMILA FRANCISCA','17.113.816-7','camila.manfredi@usach.cl','','','',2,28,21),
  (2019,'ESPEJO PIÑA','ALVARO PATRICIO','15.841.695-6','alvaro.espejo@usach.cl','','','',2,18,21),
  (2020,'VIDAL SILVA','NICOLAS SEGUNDO','17666421-5',NULL,'','','',2,18,21),
  (2021,'TEJO LAZO','FELIPE SEBASTIAN','16627755-8',NULL,'','','',2,18,21),
  (2022,'ESCRIG MURUA','JUAN EDUARDO','13757748-8','juan.escrig@usach.cl','','','',2,18,2),
  (2023,'ARANEDA MEDINA','JUAN','AL-JARANEDA',NULL,'','','',2,18,21),
  (2024,'HERNANDEZ','MAXIMILIANO','16.470.160-3',NULL,'','','',2,16,1),
  (2025,'ARAVENA TRONCOSO','BELTRAN RODRIGO','14.275.686-2',NULL,'','','',2,16,1),
  (2026,'PALMA TORRES','SAMUEL','10584237-6',NULL,'','','',2,16,1),
  (2027,'MONTOYA KUNSTING','MARGARITA PAZ','12.248.207-3','margarita.montoya@usach.cl','','','',2,6,2),
  (2028,'SANHUEZA CHAVEZ','LORETO ELISA','15590707-K',NULL,'','','',2,6,2),
  (2029,'LOPEZ LAGOS','XIMENA','16741789-2',NULL,'','','',2,7,21),
  (2030,'REINA ARTILES','MATIAS','EXT-MREINA',NULL,'','','',2,16,3),
  (2031,'OLMEDA GARCIA','ANGELES SONIA','EXT-AOLMEDA',NULL,'','','',2,16,3),
  (2032,'SPODINE SPIRIDONOVA','EVGENIA','EXT-ESPODINE',NULL,'','','',2,16,1),
  (2033,'GALLEGUILLOS SILVA','RENATO','AL-RGALLEGUILLO',NULL,'','','',2,18,21),
  (2034,'RAMIREZ BUNSTER','MARIA BELEN','16094625-3',NULL,'','','',2,13,2),
  (2035,'DIAZ S.','PATRICIA','22.498.262-3',NULL,'','','',2,39,2),
  (2036,'ROJAS BUSTOS','FRANCISCO JAVIER','EXT-FROJAS',NULL,'','','',2,16,1),
  (2037,'BRUNA BUGUEÑO','JULIO ELIAS','11.817.379-1','julio.bruna@usach.cl','','','',2,39,2),
  (2038,'RODRIGUEZ MERCADO','FRANCISCO','10.637.328-0','francisco.rodriguez.m@usach.cl',NULL,NULL,NULL,1,NULL,NULL),
  (2039,'GUICHOU LEIGHTON','JULES','13684546-2',NULL,'','','',2,13,21),
  (2040,'SANCHEZ HERNANDEZ','ENRIQUE PABLO','USACH-ESANCHEZ',NULL,'','','',2,15,2),
  (2041,'GUERRERO SALDES','LORNA ELENA','EXT-LGUERRERO',NULL,'','','',2,16,1),
  (2042,'GONZALEZ FIGUEROA','ALBERTO NICOLAS','USACH-AGONZALEZ',NULL,'','','',2,6,2),
  (2043,'BALTAZAR ROJAS','SAMUEL ELIAZAR','9370187-9',NULL,'','','',2,39,2),
  (2044,'ROCCO SALINAS','MARCELO ANDRES','USACH-MROCCO','marcelo.rocco@usach.cl','','','',2,7,2),
  (2045,'FREDES','PABLO','AL-PFREDES',NULL,'','','',2,18,2),
  (2046,'SANCHEZ MONTIEL','ELIZABETH YENY','EXT-ELISANCHEZ',NULL,'','','',2,6,13),
  (2047,'YOUNG ANZE','MANUEL','EXT-YMANUEL',NULL,'','','',2,16,13),
  (2048,'GARCIA GONZALEZ','MARIA TERESA','EXT-MGARCIA',NULL,'','','',2,16,3),
  (2049,'JUNQUERIA CONCEICAO','MARIA PAULA','22518851-3',NULL,'','','',2,38,2),
  (2050,'TAPIA ULLOA','ANDREA MACARENA','AL-ATAPIA',NULL,'','','',2,38,21),
  (2051,'CASTRO RETAMAL','MIGUEL','11952502-0',NULL,'','','',2,6,60),
  (2052,'ENRIONE CÁCERES','JAVIER','12231690-4',NULL,'','','',2,38,40),
  (2053,'SKURTYS','OLIVIER','21943011-6','olivier.skurtys@usm.cl','','','',2,38,13),
  (2054,'ANDRADE PIZARRO','RICARDO DAVID','AL-RANDRADE',NULL,'','','',2,38,21),
  (2055,'DIAZ CALDERON','PAULO','AL-PDIAZ',NULL,'','','',2,38,21),
  (2056,'CAPELLI','CLAUDIO','AL-CCAPPELLI',NULL,'','','',2,7,21),
  (2057,'CODDOU','CLAUDIO 2','AL-CCODDOU',NULL,'','','',2,6,21),
  (2058,'LABRA','JOHANA','AL-JLABRA',NULL,'','','',2,6,21),
  (2059,'GALVEZ PEREZ','PAULA','AL-PGALVEZ',NULL,'','','',2,7,21),
  (2060,'THERIAULT','NICOLAS','EXT-NTHERIAULT',NULL,'','','',2,16,1),
  (2061,'AVANZI','ROBERTO','EXT-RAVANZI',NULL,'','','',2,16,1),
  (2062,'ESPINACE','RAUL','EXT-RESPINACE',NULL,'','','',2,15,9),
  (2063,'VALENZUELA','PAMELA','EXT-PVALENZUELA',NULL,'','','',2,15,9),
  (2064,'PALMA','JUAN','EXT-JPALMA',NULL,'','','',2,15,9),
  (2065,'RAMIREZ','ALBERTO','EXT-ARAMIREZ',NULL,'','','',2,16,1),
  (2066,'TITICHOCA','GILDA','USACH-GTITICHOC',NULL,'','','',2,14,2),
  (2067,'ALTAMIRANO CABRERA','EDUARDO','EXT-EALTAMIRANO',NULL,'','','',2,14,1),
  (2068,'MONRAS CHARLES','JUAN PABLO','AL-JMONRAS',NULL,'','','',2,6,21),
  (2069,'SEPULVEDA VILLALOBOS','GERMAN','EXT-GSEPULVEDA','Externo','','','',2,16,13),
  (2070,'VASQUEZ LASTRA','MARCELO','EXT-MVASQUEZ',NULL,'','','',2,16,13),
  (2071,'RUBILAR PARRA','JAVIERA','AL-JRUBILAR',NULL,'','','',2,38,21),
  (2072,'ACEVEDO GUTIERREZ','CRISTIAN','EXT-CACEVEDO',NULL,'','','',2,38,13),
  (2073,'ESCOBAR ALVAREZ','ALEJANDRO','EXT-AESCOBAR',NULL,'','','',2,6,1),
  (2074,'PARDO GONZALEZ','ORLANDO ANTONIO','4551118-9',NULL,'','','',2,16,1),
  (2075,'SEQUEIDA HONORATO','ALVARO EDUARDO','AL-ASEQUEIDA',NULL,'','','',2,6,21),
  (2076,'CASTRO OYARZUN','ALVARO GONZALO','14.408.852-2,','alvaro.castro@inia.cl','','','',2,6,21),
  (2077,'TAPIA RODRIGUEZ','EDUARDO ANDRES','EXT-ETAPIA',NULL,'','','',2,16,9),
  (2078,'PRIETO ENCALADA','HUMBERTO GODOFREDO','EXT-HPRIETO',NULL,'','','',2,16,4),
  (2079,'ZAMORA CANTILLANA','PABLO ANDRES','EXT-PZAMORA',NULL,'','','',2,16,41),
  (2080,'ANDERSON','ROGER','EXT-RANDERSON',NULL,'','','',2,16,1),
  (2081,'BOBADILLA PARADA','FRANCISCA','USACH-FBOBADILL','fbobadillap@gmail.com','','','',2,16,2),
  (2082,'AREVALO MORALES','MARIA DEL CARMEN','EXT-MAREVALO',NULL,'','','',2,8,1),
  (2083,'CASANOVA','MAURICIO ISAACS','EXT-MCASANOVA',NULL,'','','',2,16,43),
  (2084,'BASSI ACUNA','DANILO FRANCISCO','USACH-DBASSI',NULL,'','','',2,10,2),
  (2085,'DOMINGOS FABRIS','JOSE','EXT-JDOMINGOSF',NULL,'','','',2,16,1),
  (2086,'HAMM HAHN','LUIS EUGENIO','8516981-5','luis.hamm(at)usach.cl','','','',2,18,2),
  (2087,'ROMERO GRAMEGNA','VICTOR','USACH-VROMERO',NULL,'','','',2,18,2),
  (2088,'ROMAN','BENOIT','EXT-BROMAN',NULL,'','','',2,16,44),
  (2089,'ROMERO HUENCHUÑIR','GUILLERMO','EXT-GROMERO',NULL,'','','',2,18,45),
  (2090,'SOLANO VILLANUEVA','ENRIQUE','EXT-ESOLANO',NULL,'','','',2,18,45),
  (2091,'GARCIA-RIPOLL','JUAN JOSE','EXT-JGARCIA-RIP',NULL,'','','',2,18,38),
  (2092,'TORRES MEDIANO','ALEJANDRA','USACH-ATORRES',NULL,'','','',2,15,2),
  (2093,'HAUSER','CAROLIN','EXT-CHAUSER',NULL,'','','',2,16,1),
  (2094,'VELASTIN CARROZA','SERGIO ALEJANDRO','7062905-4',NULL,'','','',2,39,2),
  (2095,'BECKROM','TOBY','EXT-TBECKROM',NULL,'','','',2,16,1),
  (2096,'MAKRIS','DIMITRIOS','EXT-DMAKRIS',NULL,'','','',2,16,1),
  (2097,'SANDOVAL','DIEGO','AL-DSANDOVAL',NULL,'','','',2,10,2),
  (2098,'GARCIA MENA','VERONICA ALEJANDRA','13450118-9','veronica.garcia@usach.cl','','','',2,39,2),
  (2099,'PALACIOS PINO','JOSE LUIS','10762403-1',NULL,'','','',2,38,2),
  (2100,'BERNAL VALENZUELA','ROBERTO ALEXANDER','12876420-8','roberto.bernal@usach.cl','','','',2,18,2),
  (2101,'VIVANCO AVARIA','FRANCISCO JAVIER','9477285-0',NULL,'','','',2,18,2),
  (2102,'GALAZ DONOSO','BELFOR ANTONIO','13679464-7',NULL,'','','',2,18,2),
  (2103,'ABKARIAN','MANOUK','EXT-MABKARIAN',NULL,'','','',2,16,1),
  (2104,'SANTIBAÑEZ','FRANSCISCO','USACH-FSANTIBAÑ',NULL,'','','',2,18,2),
  (2105,'THOMAS','PETER','EXT-PTHOMAS',NULL,'','','',2,16,1),
  (2106,'FERNANDEZ','WASHINGTON','EXT-WFERNANDEZ',NULL,'','','',2,10,1),
  (2107,'RAMIREZ LOPEZ','LEONARDO','EXT-LRAMIREZ',NULL,'','','',2,16,1),
  (2108,'ARAYA LEON','MARIA JOSE','15348875-4',NULL,'','','',2,36,2),
  (2109,'QUINTEROS','DANIEL','USACH-DQUINTERO',NULL,'','','',2,12,2),
  (2110,'FLOREZ','FRANSCISCO','EXT-FFLOREZ',NULL,'','','',2,16,1),
  (2111,'BILBAO','MARIA ANGELES','12.628.852-2','bilbao.angeles@gmail.com','','','',2,20,2),
  (2112,'OYANEDEL SEPULVEDA','JUAN CARLOS','15367648-8',NULL,'','','',2,23,2),
  (2113,'ORIOL GRANADO','XAVIER','24.359.242-9','xoriolgranado@yahoo.es','','','',2,20,2),
  (2114,'MENDIBURU','ANDRES','USACH-AMENDIBUR',NULL,'','','',2,20,2),
  (2115,'GARCIA VEGA','JOSE DE JESUS','EXT-JGARCIA',NULL,'','','',2,16,1),
  (2116,'TORRES','JAVIER','USACH-JTORRES',NULL,'','','',2,20,2),
  (2117,'TELLO REYES','MARIO CESAR GERARDO','14423507-k','mario.tello@usach.cl','','','',2,6,2),
  (2118,'ALVAREZ','EDUARDO','EXT-EALVAREZ',NULL,'','','',2,25,12),
  (2119,'CANALES','DANIEL','EXT-DCANALES',NULL,'','','',2,16,1),
  (2120,'GALVEZ','PAULA','EXT-PGALVEZ',NULL,'','','',2,16,1),
  (2121,'RIVAS','LINA MARIA','EXT-LRIVAS',NULL,'','','',2,6,1),
  (2122,'DIAZ ROBLES','LUIS ALONSOs','11162556-5',NULL,NULL,NULL,NULL,2,NULL,NULL),
  (2123,'VERGARA','ALBERTO','EXT-AVERGARA',NULL,'','','',2,15,40),
  (2124,'PINO CORTES','ERNESTO','23059933-5',NULL,'','','',2,15,2),
  (2125,'HOEKMAN','KENT','EXT-KHOEKMAN',NULL,'','','',2,16,1),
  (2126,'HURTADO CRUZ','JUAN PABLO','12464416-k',NULL,'','','',2,33,2),
  (2127,'VARGAS NORAMBUENA','JUAN P.','12664474-K',NULL,'','','',2,33,2),
  (2128,'TORRES MANRIQUEZ','MIGUEL ALEJANDRO','USACH-MTORRES',NULL,'','','',2,13,2),
  (2129,'SAAVEDRA','MARIO','USACH-MSAAVEDRA',NULL,'','','',2,13,2),
  (2130,'THIBEAUTH','JULES','EXT-JTHIBEAUTH',NULL,'','','',2,16,1),
  (2131,'VALDEZ','DIEGO','USACH-DVALDEZ',NULL,'','','',2,10,2),
  (2132,'ANTILEN','MONICA','EXT-MANTILEN',NULL,'','','',2,8,43),
  (2133,'TAPIA','YASNA','EXT-YTAPIA',NULL,'','','',2,16,12),
  (2134,'BURGOS LEIVA','CAMILA ANDREA','14207114-2',NULL,'','','',2,5,2),
  (2135,'DIAZ NAVARRO','RODRIGO','EXT-RDIAZ',NULL,'','','',2,16,1),
  (2136,'CHAVEZ ROJAS','JORGE EDUARDO','12374267-2','Jorge.chavez@usach.cl','','','',2,39,2),
  (2137,'ROMERO','MARGARIDA','EXT-MROMERO',NULL,'','','',2,16,1),
  (2138,'JARAMILLO MARTINEZ','CLAUDIA VERONICA','15.175.427-9.','cjaramillomartinez@gmail.com','','','',2,39,2),
  (2139,'FAURE NIÑOLES','JAIME IGNACIO','17.267.725-8',NULL,'','','',2,30,2),
  (2140,'RAMIREZ DONOSO','LUIS ALEJANDRO','EXT-LRAMIREZD',NULL,'','','',2,16,43),
  (2141,'GARRIDO LAZO','RENE ANDRE','15934908-K',NULL,'','','',2,39,2),
  (2142,'SOTO','CARMEN','EXT-CSOTO',NULL,'','','',2,16,1),
  (2143,'SATRIO','JUSTINOS','EXT-JSATRIO',NULL,'','','',2,16,1),
  (2144,'CONTRERAS','RODRIGO','USACH-RCONTRERA',NULL,'','','',2,6,2),
  (2145,'PARADA','RODOLFO','USACH-RPARADA',NULL,'','','',2,6,2),
  (2146,'ROSENTHIEL','TODD','EXT-TROSENTHIEL',NULL,'','','',2,16,1),
  (2147,'VASQUEZ','YESSENY','12.628.464-0',NULL,'','','',2,16,2),
  (2148,'LEVICAN JAQUE','GLORIA PAZ','9172204-6',NULL,'','','',2,6,2),
  (2149,'REMONSELLEZ','FRANSCISCO','USACH-FREMONSEL',NULL,'','','',2,16,2),
  (2150,'HOLMES','DAVID','EXT-DHOLMES',NULL,'','','',2,16,1),
  (2151,'RODRIGUEZ','HUGO GUSTAVO','22491404-0',NULL,'','','',2,11,2),
  (2152,'DUCHENS SILVA','HECTOR ALFREDO','USACH-HDUCHENS',NULL,'','','',2,16,2),
  (2153,'SALAZAR NAVARRETE','JOSE LUIS','USACH-JSALAZAR',NULL,'','','',2,15,2),
  (2154,'SEPULVEDA ROJAS','JUAN PEDRO','11.953.788-6','juanpedro.sepulveda@usach.cl','','','',2,11,2),
  (2155,'BENAVENTE MARTINEZ','JAVIER','EXT-JBENAVENTE',NULL,'','','',2,16,1),
  (2156,'LATORRE GUZMAN','BERNANDO ANTONIO','EXT-BLATORRE',NULL,'','','',2,16,43),
  (2157,'MUÑOZ','DANIELA','USACH-DMUÑOZ',NULL,'','','',2,16,2),
  (2158,'SEPULVEDA','PAMELA','USACH-PSEPULVED',NULL,'','','',2,16,2),
  (2159,'SUAZO','JONATHAN','USACH-JSUAZO',NULL,'','','',2,16,2),
  (2160,'GRENECHE','JEAN-MARC','EXT-JGRENECHE',NULL,'','','',2,16,1),
  (2161,'CANDIA MUÑOZ','NICOLAS MAURICIO','USACH-NCANDIA',NULL,'','','',2,18,2),
  (2162,'VIDELA LEIVA','ALVARO','USACH-AVIDELA',NULL,'','','',2,16,2),
  (2163,'RODRIGUEZ COLLAZO','PEDRO','24363720-1',NULL,'','','',2,25,2),
  (2164,'ZAMBRA S.','CARLOS','EXT-CZAMBRA',NULL,'','','',2,16,53),
  (2165,'PLAZA','ANDREA','EXT-APLAZA',NULL,'','','',2,16,53),
  (2166,'PEREZ','FRANSCISCO','EXT-FPEREZ',NULL,'','','',2,16,53),
  (2167,'MEJIAS','JAIME','EXT-JMEJIAS',NULL,'','','',2,16,4),
  (2168,'GALDAMES','RAFAEL','EXT-RGALDAMES',NULL,'','','',2,16,4),
  (2169,'VERGARA','VERONICA','EXT-VVERGARA',NULL,'','','',2,16,4),
  (2170,'VALDEBENITO','ALEXIS','EXT-AVALDEBENIT',NULL,'','','',2,16,4),
  (2171,'HERNANDEZ','JOSE','EXT-JHERNANDEZ',NULL,'','','',2,16,7),
  (2172,'FLEMING','PETER','EXT-PFLEMING',NULL,'','','',2,16,7),
  (2173,'MORENO','PATRICIO','EXT-PMORENO',NULL,'','','',2,16,40),
  (2174,'GUERRERO','SICHEM','EXT-SGUERRERO',NULL,'','','',2,16,40),
  (2175,'ARAYA','PAULO','EXT-PARAYA',NULL,'','','',2,16,12),
  (2176,'JOGLAR','CAROL','USACH-CJOGLAR',NULL,'','','',2,6,2),
  (2177,'SALAZAR GONZALEZ','RICARDO ANDRES','12124729-1',NULL,'','','',2,8,2),
  (2178,'GONZALEZ DONOSO','ALEXIS MIGUEL','16617163-6',NULL,'','','',2,8,2),
  (2179,'SEPERIZA WITTWER','ASTRID JEANISSE','9911340-5',NULL,'','','',2,16,2),
  (2180,'FLORES CALDERON','CORINA ANDREA','14082443-7',NULL,'','','',2,16,2),
  (2181,'ZAMORANO','PEDRO','USACH-PZAMORANO',NULL,'','','',2,16,2),
  (2182,'MENDEZ FERRADA','MIGUEL','EXT-MMENDEZ',NULL,'','','',2,16,56),
  (2183,'ROJAS PAVEZ','JUAN LUIS DORIAN','USACH-JROJAS',NULL,'','','',2,25,2),
  (2184,'MUÑOZ','LEOPOLDO','USACH-LMUNOZ',NULL,'','','',2,13,2),
  (2185,'GONZALEZ SANCHEZ','EVELYN ANDREA','14127031-1',NULL,'','','',2,8,2),
  (2186,'DE L´HERBE','MICHEL','USACH-MDELHERBE',NULL,'','','',2,16,2),
  (2187,'CONTRERAS','DANIELA','USACH-DCONTRERA',NULL,'','','',2,16,2),
  (2188,'VELASCO MARTIN','JAVIER ENRIQUE','9090861-8','javier.velasco@usach.cl','','','',2,16,2),
  (2189,'CERECEDA','FRANCISCO','EXT-FCERECEDA',NULL,'','','',2,16,13),
  (2190,'AGUILAR','CLAUDIO','EXT-CAGUILAR',NULL,'','','',2,16,13),
  (2191,'VIDAL','VICTOR','EXT-VVIDAL',NULL,'','','',2,16,13),
  (2192,'FUNES','MARIO','EXT-MFUNES',NULL,'','','',2,16,13),
  (2193,'MUÑOZ','JUAN PABLO','EXT-JPMUÑOZ',NULL,'','','',2,16,13),
  (2194,'FADIC','XIMENA','EXT-XFADIC',NULL,'','','',2,16,13),
  (2195,'YAÑEZ','KAREN','EXT-KYAÑEZ',NULL,'','','',2,16,13),
  (2196,'DIAZ','RICARDO','EXT-RIDIAZ',NULL,'','','',2,16,53),
  (2197,'CORDERO CARRASCO','RAUL RODRIGO','14664169-5',NULL,'','','',2,18,2),
  (2198,'CASSASA','GINO','EXT-GCASSASA',NULL,'','','',2,16,10),
  (2199,'GACITUA','GUISELLA','EXT-GGACITUA',NULL,'','','',2,16,10),
  (2200,'CARVALLO','RUBEN','EXT-RCARVALLO',NULL,'','','',2,16,10),
  (2201,'AREVALO','MARCELO','EXT-MAAREVALO',NULL,'','','',2,16,10),
  (2202,'CORRIPIO','JAVIER','EXT-JCORRIPIO',NULL,'','','',2,16,10),
  (2203,'GONZALEZ BOWN','MARIA JOSE','USACH-MGONZALEZ',NULL,'','','',2,16,2),
  (2204,'REYES CERPA','SEBASTIAN ANDRES','15468776-9',NULL,'','','',2,6,2),
  (2205,'CASTILLO REYES','ALEJANDRA DANIELA','USACH-ACASTILLO',NULL,'','','',2,15,2),
  (2206,'GOMEZ BERRENA','MAURICIO MANUEL','USACH-MGOMEZ',NULL,'','','',2,8,2),
  (2207,'QUIJADA MALDONADO','ESTEBAN DE LA CRUZ','USACH-EQUIJADA',NULL,'','','',2,15,2),
  (2208,'TERAN AGUILAR','MARCO','12747551-2','marco.teran@usach.cl','','','',2,11,2),
  (2209,'ORTUZAR FLORES','HARRY ANDRES','USACH-HORTUZAR',NULL,'','','',2,16,2),
  (2210,'RUBIO RIVERA','ANDRES','USACH-ARUBIO',NULL,'','','',2,11,2),
  (2211,'MENDIBURO SEGUEL','ANDRES FERNANDO','USACH-ANMENDIBU',NULL,'','','',2,16,2),
  (2212,'VIDAL OYARCE','MARICEL DE LOURDES','USACH-MVIDAL',NULL,'','','',2,16,2),
  (2213,'SILVA MORENO','EVELYN DEL CARMEN','USACH-EDELCARME',NULL,'','','',2,16,2),
  (2214,'MUÑOZ VASQUEZ','VALERIA ALEJANDRA','USACH-VMUÑOZ',NULL,'','','',2,38,2),
  (2215,'SANCHEZ GONZALEZ','ANDRES ALBERTO','USACH-ASANCHEZ',NULL,'','','',2,16,2),
  (2216,'PALMA','JUAN LUIS','15.350.514-4','juan.palma.s@usach.cl','','','',2,18,2),
  (2217,'Cid Silva','Héctor Andrés','15.669.251-4',NULL,'','','',2,6,2),
  (2218,'Barros Vásquez','Daniel','16.067.829-1',NULL,'','','',2,6,2),
  (2219,'Rivas Aravena','Andrea','9.123.903-5','andrea.rivas@usach.cl','','','',2,6,7),
  (2220,'MALDONADO SAAVEDRA','MIGUEL ANDRES','14.391.727-4','miguel.maldonado@usach.cl','','','',2,14,2),
  (2221,'Gomez Ocaranza','Cesar Patricio','5.077.415-5',NULL,'','','',2,16,1),
  (2222,'Almendares Calderon','Laura del Carmen','6377550-9','laura.almendares@usach.cl','','','',2,38,2),
  (2223,'Muñoz Muñoz','Carlos Humberto','13.911.108-7','carlos.mzmz@gmail.com','','','',2,6,21),
  (2224,'Bravo Lopez','David','15322114-6',NULL,'','','',2,6,21),
  (2225,'Pelissier serrano','Teresa','6248141-2',NULL,'','','',2,6,1),
  (2226,'CASTILLO MORAGA','ESTEBAN EDUARDO','AL-ECASTILLO','esteban.castillo.1901@gmail.com','','','',2,14,21),
  (2227,'MENESES DIAZ','FELIPE ARTURO','EXT17836246-1','felipe.menesesd@hotmail.com','','','',2,16,1),
  (2228,'AROCA ARCAYA','GERMAN EDUARDO','7857085-7',NULL,'','','',2,16,9),
  (2229,'CACERES SANCHEZ','MANUEL SEBASTIAN','13890877-1',NULL,'','','',2,16,9),
  (2230,'MENARGUEZ CRUZ','FRANCISCO JAVIER','EXT-FMENARGUEZ',NULL,'','','',2,16,40),
  (2231,'ISOPI NAVARRETE','CRISTIAN ANDRES','16246744-1','isopi.cristian@gmail.com','','','',2,5,2),
  (2232,'HERNANDEZ CARCAMO','PABLO','15.626.736-8',NULL,'','','',2,5,2),
  (2233,'SOTO PEREIRA','ANDRES','USACH-ASOTO',NULL,'','','',2,10,2),
  (2234,'MARCHANT DINTEN','CAROLINA','10672255-2','carolina.marchant@usach.cl','','','',2,5,2),
  (2235,'SANTANDER','MARIA TERESA','USACH-MSANTANDE',NULL,'','','',2,11,2),
  (2236,'HERRERA','CLAUDIO','USACH-CHERRERA',NULL,'','','',2,40,2),
  (2237,'MORA','PABLO','USACH-PMORA',NULL,'','','',2,29,2),
  (2238,'ROBLES','CLAUDIA','16744824-0',NULL,'','','',2,6,21),
  (2239,'MEDINA SILVA','RAFAELA','12856391-1',NULL,'','','',2,16,43),
  (2240,'MONTECINOS','LUISA','10043961-1',NULL,'','','',2,16,43),
  (2241,'TAPIA CASTRO','KARLA','14008135-3',NULL,'','','',2,16,43),
  (2242,'OLIVIERA','PAULO','13128732-1',NULL,'','','',2,16,43),
  (2243,'VALENZUELA','LISSETTE','10311124-2',NULL,'','','',2,16,1),
  (2244,'BERTI','MARITZA','9.607.561-8',NULL,'','','',2,16,1),
  (2245,'ARENAS','ANDREA','EXT-AARENAS',NULL,'','','',2,16,43),
  (2246,'ELGUETA','ESTEFANIA','AL-EELGUETA',NULL,'','','',2,6,21),
  (2247,'ACUNA','GUSTAVO ALEJANDRO','5810243-1','gustavoa@vollkorn.cl','','','',2,16,55),
  (2248,'OSSES TORO','ALEJANDRO DANIEL','14502873-6','aosses@fundacionchile.cl','','','',2,16,1),
  (2249,'ARENILLAS SALINAS','ESTEBAN EDUARDO','17575055-K','esteban.arenillas@usach.cl','','','',2,6,21),
  (2250,'URRA','PAMELA','USACH-PURRA',NULL,'','','',2,16,2),
  (2251,'KIWI TICHAUER','MIGUEL','EXT-MKIWI',NULL,'','','',2,16,43),
  (2252,'GONZALEZ MORAGA','GUILLERMO','EXT-GGONZALEZ',NULL,'','','',2,16,12),
  (2253,'RAMIREZ','RICARDO','3075363-1',NULL,'','','',2,16,2),
  (2254,'GARCIA','GRISELDA','21314807-9',NULL,'','','',2,16,2),
  (2255,'DE LA VEGA','FERNANDO','EXT-FDELAVEGA',NULL,'','','',2,16,1),
  (2256,'LAGOS','VERONICA','EXT-VLAGOS',NULL,'','','',2,16,57),
  (2257,'ACUNA MORA','JUAN DE DIOS','5979453-1',NULL,'','','',2,16,1),
  (2258,'CAÑAS CRUCHAGA','RAUL','4132715-4','rcanas@biotecnicaschile.com','','','',2,16,1),
  (2259,'AVILA','MANUEL','USACH-MAVILA',NULL,'','','',2,22,2),
  (2260,'LEIVA CAMPUSANO','ANGEL','10783737-K',NULL,'','','',2,16,43),
  (2261,'ARANCIBIA','ALBERTO','USACH-AARANCIBI',NULL,'','','',2,16,2),
  (2262,'ASTUDILLO ROJAS','HERNAN','9683664-3','hernan@acm.org','','','',2,16,1),
  (2263,'BECERRA CASTRO','CARLOS','13780487-5',NULL,'','','',2,16,59),
  (2264,'ASTUDILLO ROJAS','ELBA','9140828-7',NULL,'','','',2,16,9),
  (2265,'MENDOZA MONTOYA','ROSE','13878084-8','rmendoza@inf.utfsm.cl','','','',2,16,13),
  (2266,'ATKINSON ABUTRIDY','JOHN','10634325-K','atkinson@inf.udec.cl','','','',2,16,47),
  (2267,'RODRIGUEZ TASTETS','MARIA','9028031-7','andrea@inf.udec.cl','','','',2,16,47),
  (2268,'BUSTOS CARDENAS','BENJAMIN','13271569-6','bebustos@dcc.uchile.cl','','','',2,16,12),
  (2269,'POBLETE LABRA','BARBARA','9587752-4','barbara@poblete.cl','','','',2,16,1),
  (2270,'MENDOZA ROCHA','MARCELO','10351848-2','marcelo.mendoza@uv.cl','','','',2,16,59),
  (2271,'LILLO VIDAL','SEBASTIAN','USACH-SLILLO',NULL,'','','',2,30,2),
  (2272,'CONTRERAS','DANIELA','USACH-ACONTRERA',NULL,'','','',2,16,2),
  (2273,'VIDAL','ROBERTO','10837405-5',NULL,'','','',2,16,2),
  (2274,'VERGARA EGERT','PABLO','USACH-PVERGARA',NULL,'','','',2,37,2),
  (2275,'VILA','IRMA','EXT-IVILA',NULL,'','','',2,16,12),
  (2276,'CONSTANZO ROJAS','ROBINSON ALEXIS','13136554-3',NULL,'','','',2,14,9),
  (2277,'VERA ARAVENA','ROSA DE LAS MERCEDES','5581282-9',NULL,'','','',2,14,9),
  (2278,'ARANEDA HERNANDEZ','EUGENIA ALEJANDRA','11903669-0',NULL,'','','',2,14,47),
  (2279,'GONZALEZ','ROBERTO','14147578-9',NULL,'','','',2,12,2),
  (2280,'ARROYUELO','DIEGO','EXT-DARROYUELO',NULL,'','','',2,16,13),
  (2281,'PRIETO','ALFREDO','EXT-APRIETO',NULL,'','','',2,16,10),
  (2282,'GIBBONS','JORGE','EXT-JGIBBONS',NULL,'','','',2,16,10),
  (2283,'URIBE','ROBERTO','10808460-K',NULL,'','','',2,16,10),
  (2284,'GONZALEZ IBAÑEZ','ROBERTO','USACH-RGONZALEZ',NULL,'','','',2,16,2),
  (2285,'CRUZAT CONTRERAS','CHRISTIAN','12869969-4','christiancruzat@gmail.com','','','',2,16,2),
  (2286,'FIGUEROA FIGUEROA','LUIS FELIPE','USACH-LFIGUEROA','luis.figueroa@usach.cl','','','',2,16,2),
  (2287,'VASQUEZ','OSCAR','USACH-OVASQUEZ',NULL,'','','',2,11,2),
  (2288,'PEREZ CORTES','SEBASTIAN','USACH-SPEREZ',NULL,'','','',2,33,2),
  (2289,'PALACIOS','ERNESTO','AL-EPALACIOS',NULL,'','','',2,16,21),
  (2290,'FLORES TAPIA','FERNANDO','6773377-0','fflores@tiptop.cl','','','',2,16,21),
  (2291,'HUAYON BELMONTE','FREDDY ANTONIO','14186496-3',NULL,'','','',2,16,21),
  (2292,'OYARZO OYARZO','FRANCISCO JAVIER','USACH-FOYARZO',NULL,'','','',2,16,2),
  (2293,'GALVEZ PEIRANO','RODRIGO LEONARDO','8455711-0',NULL,'','','',2,16,2),
  (2294,'MARTINEZ COSTAS','JOSE','EXT-JMARTINEZ',NULL,'','','',2,16,1),
  (2295,'SANTIBAÑEZ','ALVARO','USACH-ASANTIBAÑ',NULL,'','','',2,16,21),
  (2296,'SANCHEZ VILLALOBOS','RODRIGO','EXT-RSANCHEZ',NULL,'','','',2,16,12),
  (2297,'VERA MARAMBIO','GONZALO','USACH-GVERA',NULL,'','','',2,16,2),
  (2298,'RODRIGUEZ MACHUCA','PABLO ANDRES','USACH-PRODRIGUE',NULL,'','','',2,18,2),
  (2299,'ALMARZA','FRANCISCO','EXT-FALMARZA',NULL,'','','',2,16,1),
  (2300,'TORO','OSCAR','USACH-OTORO',NULL,'','','',2,16,2),
  (2301,'BARRAZA','JULIA','USACH-JBARRAZA',NULL,'','','',2,16,2),
  (2302,'LOYOLA','MARIA SOLEDAD','USACH-MLOYOLA',NULL,'','','',2,16,2),
  (2303,'MOISAN','MARCELO','EXT-MMOISAN',NULL,'','','',2,16,1),
  (2304,'OVALLE','RICARDO','USACH-ROVALLE',NULL,'','','',2,16,2),
  (2305,'TRIVIÑO','JAIME','EXT-JTRIVIÑO',NULL,'','','',2,16,13),
  (2306,'SAN MARTIN','PEDRO','EXT-PSANMARTI',NULL,'','','',2,16,1),
  (2307,'IBARRA VASQUEZ','LEONIDAS','EXT-LIBARRA',NULL,'','','',2,16,1),
  (2308,'ENGDHAL PLASS','CLAUDIO','EXT-CENGDHAL',NULL,'','','',2,16,1),
  (2309,'GONZALEZ LABRA','JAIME ANDRES','EXT13.670.532-6','jgonzalez@capitalcreativo.com','','','',2,16,1),
  (2310,'TASCA GOTTARDO','FEDERICO','24293609-4','Federico.tasca@usach.cl','','','',2,8,2),
  (2311,'CASTRO CASTILLO','CARMEN','USACH-CCASTRO','Carmen.castroc@usach.cl','','','',2,8,21),
  (2312,'MUNOZ MEDINA','LUIS FELIPE','16.190.723-5','felipeantonio.munoz@usach.cl','','','',2,36,2),
  (2313,'ZEPEDA FLORES','ALEJANDRO','USACH-AZEPEDA',NULL,'','','',2,36,2),
  (2315,'PINTO','ALONSO','AL-APINTO',NULL,'','','',2,14,21),
  (2316,'REYES','DANIELA','16187809-k',NULL,'','','',2,12,2),
  (2317,'RIVERA MENDEZ','LUIS','USACH-LRIVERA','luis.rivera@usach.cl','','','',2,5,2),
  (2318,'TORRES','VICTORIA','13.436.379-7',NULL,'','','',2,16,2),
  (2319,'DEERENBERG VAN HARTEN','ROBERT MITCH','EXT-RDEERENBERG',NULL,'','','',2,16,1),
  (2320,'PIZARRO GUERRA','RODRIGO IVAN','13200956-2',NULL,'','','',2,16,1),
  (2321,'PIZARRO GUERRA','ENRIQUE ORLANDO','11368092-k',NULL,'','','',2,16,1),
  (2322,'GUERRA DURAN','MIGUEL ANGEL','17746292-6',NULL,'','','',2,16,1),
  (2323,'ABALLAY','ERWIN','EXT-EABALLAY',NULL,'','','',2,16,1),
  (2324,'PALMA','FRANCISCO','EXT-FPALMA',NULL,'','','',2,16,1),
  (2325,'DIAZ RAMIREZ','CARLOS','12854934-K',NULL,'','','',2,16,2),
  (2326,'ACEVEDO CABELLO','JORGE LUIS','USACH-JACEVEDO',NULL,'','','',2,13,2),
  (2327,'NAVARRO QUIROGA','CAMILO IGNACIO','AL-CNAVARRO','camilo.navarro@usach.cl','','','',2,13,21),
  (2328,'VALDES','NATALIA','17.186.295-7',NULL,'','','',2,16,21),
  (2329,'FLORES CARVAJAL','CLAUDIA PILAR','15337942-4',NULL,'','','',2,16,1),
  (2330,'ESCOBEDO','SANDRA','15708756-8',NULL,'','','',2,16,1),
  (2331,'BUSTOS','SOFIA','EXT-SBUSTOS',NULL,'','','',2,16,1),
  (2332,'MARCHANT','LORENA','EXT-LMARCHANT',NULL,'','','',2,16,1),
  (2333,'BARRERA','CLAUDIA','EXT-CBARRERA',NULL,'','','',2,16,1),
  (2334,'CORTES','ANDREA','EXT-ACORTES',NULL,'','','',2,16,1),
  (2335,'LOPEZ','MACARENA','EXT-MLOPEZ',NULL,'','','',2,16,1),
  (2336,'KOBRICH GRUEBLER','CLAUS','7016022-6',NULL,'','','',2,16,1),
  (2337,'BRAVO PEÑA','FELIPE','16804260-4',NULL,'','','',2,16,1),
  (2338,'ALVIAL CABRERA','NATALIA','16659271-2',NULL,'','','',2,16,1),
  (2339,'VILLAROEL FUENTES','ALVARO','16303323-2',NULL,'','','',2,16,1),
  (2340,'MICHELSON QUINTANA','SOFIA ANTONIETA','USACH-SMICHELSO','Sofia.michelson@usach.cl','','','',2,6,21),
  (2341,'MIR CASTILLO','SARA ETELINDA','EXT-SMIR',NULL,'','','',2,16,1),
  (2342,'ROJAS MONTECINOS','PATRICIO','USACH-PROJAS','patricio.rojas.m@usach.cl','','','',2,6,2),
  (2343,'LORCA PONCE','ENRIQUE','18.079.772-6',NULL,'','','',2,6,21),
  (2344,'AMPUERO NILO','LEANDRO ANDRES','AL-LAMPUERO',NULL,'','','',2,5,21),
  (2345,'WAGNER M','MARIO','EXT-MWAGNER',NULL,'','','',2,16,1),
  (2346,'YANEZ','SERGIO','EXT-SYANEZ',NULL,'','','',2,16,1),
  (2347,'TANNERT','THOMAS','EXT-TTANNERT',NULL,'','','',2,16,1),
  (2348,'POPOVSKI','MARJAN','EXT-MPOPOVSKI',NULL,'','','',2,16,1),
  (2349,'REX HERMOSILLA','ELIZABETH','17.875.206-5',NULL,'','','',2,6,2),
  (2350,'LIKAO','JULIA','EX-JLIKAO',NULL,'','','',2,16,1),
  (2351,'CARRASCO','SAMUEL','USACH-SCARRASCO',NULL,'','','',2,15,2),
  (2352,'PELZ','STEFAN','EXT-SPELZ',NULL,'','','',2,16,1),
  (2353,'DIAZ','HERNAN','USACH-HDIAZ',NULL,'','','',2,16,2),
  (2354,'CIFUENTES','FERNANDO','USACH-FCIFUENTE',NULL,'','','',2,16,2),
  (2355,'MEZA','JUVISKA','USACH-JMEZA',NULL,'','','',2,16,2),
  (2356,'TITOS','ANA','USACH-ATITOS',NULL,'','','',2,16,2),
  (2357,'CURILEM SALDIAS','MILLARAY','EXT-MCURILEM',NULL,'','','',2,10,1),
  (2358,'YANEZ DURAN','ANDRES','11890233-5','andres@xml.cl','','','',2,16,1),
  (2359,'VIDELA ZAVALA','DANIEL','13454926-2',NULL,'','','',2,16,1),
  (2360,'RUZ CORDERO','JUAN','15776231-1',NULL,'','','',2,12,2),
  (2361,'BLAZQUEZ','MARISA','7520842-1',NULL,'','','',2,16,2),
  (2362,'CASTILLO','ERIKA','9924463-1',NULL,'','','',2,5,1),
  (2363,'CERDA BONOMO','FRANCISCO','5892472-5',NULL,'','','',2,16,2),
  (2364,'ARENAS SALINAS','FELIPE','USACH-FARENAS','felipe.arenass@usach.cl','','','',2,16,2),
  (2365,'ARENAS SALINAS','MAURICIO','USACH-MARENAS',NULL,'','','',2,16,2),
  (2366,'LACOSTE GARGANTINI','PABLO ALBERTO','USACH-PLACOSTE',NULL,'','','',2,16,2),
  (2367,'AGUILERA SALAZAR','PAULETTE ALEJANDRA','AL-PAGUILERA',NULL,'','','',2,38,2),
  (2368,'AGUILERA BARRAZA','FABIAN ALBERTO','EXT-FAGUILERA',NULL,'','','',2,16,1),
  (2369,'LOPEZ DE DICASTILLO BERGAMO','ANA CAROLINA','24.315.306-9','analopez.dediscastillo@usach.cl','','','',2,16,2),
  (2370,'ALARCON ALVAREZ','EDUARDO','EXT-EALARCON',NULL,'','','',2,16,1),
  (2371,'MENARES KOPPE','MACARENA','AL-MMENARES',NULL,'','','',2,25,21),
  (2372,'TORRES','HUGO','EXT-HTORRES',NULL,'','','',2,16,1),
  (2373,'HERRERA GARCES','SOFIA LILIANA','USACH-SHERRERA',NULL,'','','',2,10,2),
  (2374,'MUNOZ G','JOSE','15715544-K',NULL,'','','',2,16,1),
  (2375,'ORTEGA MELO','FELIPE','8657604-k','felipe.ortega.m@usach.cl','','','',2,22,2),
  (2376,'CERON VILLARROEL','ROSAISMEL CECILIA','USACH-RCERON','rosaismel.ceron@usach.cl','','','',2,16,21),
  (2377,'GONZALEZ CANDIA','JULIO CESAR','11795571-0',NULL,'','','',2,16,2),
  (2378,'ILLESCA CAMPOS','MARCOS CLAUDIO','9971972-9','millesca@exportachile.cl','','','',2,16,1),
  (2379,'PALMA GONZALEZ','LUIS ALBERTO','7776713-4',NULL,'','','',2,16,2),
  (2380,'AGUIRRE BOZA','ALVARO SEBASTIAN','10371358-7','alvaro.aguirre@usach.cl','','','',2,16,2),
  (2381,'ZUNIGA JORQUERA','PABLO','13912102-3',NULL,'','','',2,16,2),
  (2382,'CAVADA VERA','ANDREA','12263997-5','cavada.am@gmail.com','','','',2,16,2),
  (2383,'BORGES QUINTANILLA','HUMBERTO','12873004-4','hborges.gib.ltda@gmail.com','','','',2,16,2),
  (2384,'VERGARA ORTIZ','MARIO ANDRES','13252115-6',NULL,'','','',2,16,1),
  (2385,'LARA SUZARTE','MARCELO ANDRES','AL-MLARA',NULL,'','','',2,6,21),
  (2386,'MADRID MONTECINOS','RODOLFO','USACH-RMADRID','rodolfo.madrid@usach.cl','','','',2,6,2),
  (2387,'PERTUSA PASTOR','MARIA','23428313-8',NULL,'','','',2,6,2),
  (2388,'GARCIA HUIDOBRO-TORO','JUAN PABLO','4779225-8',NULL,'','','',2,6,2),
  (2389,'GONZALEZ MONTELONGO','RAFAELA','EXT-RGONZALEZ',NULL,'','','',2,16,1),
  (2390,'GIRALDEZ FERNANDEZ','TERESA','EXT-TGIRALDEZ',NULL,'','','',2,16,1),
  (2391,'SEPULVEDA RAMIREZ','GONZALO ALEJANDRO','AL-GSEPULVEDA','gonzalo.sepulvedara@usach.cl','','','',2,14,21),
  (2392,'ROMAN ALISTE','JUAN ISMAEL','AL-JROMAN','juan.romana@usach.cl','','','',2,15,21),
  (2393,'ANGULO NEUBURG','ALEJANDRO','AL-AANGULO','alejandro.angulo@usach.cl','','','',2,15,21),
  (2394,'HERNANDEZ','PABLO','EXT-PHERNANDEZ',NULL,'','','',2,16,1),
  (2395,'ARREDONDO','TOMAS','EXT-TARREDONDO',NULL,'','','',2,16,13),
  (2396,'SANTANDER MEYER','ROCIO','EXT-RSANTANDER',NULL,'','','',2,16,1),
  (2397,'GIMENEZ CASTILLO','BEGOÑA','EXT-BGIMENEZ',NULL,'','','',2,16,2),
  (2398,'DE MATTOS','IVANILDO LUIZ','22747946-9','ivanildo.demattos@usach.cl','','','',2,8,2),
  (2399,'SEGURA SEGURA','RODRIGO','11651887-2','rodrigo.segura@usach.cl','','','',2,8,2),
  (2400,'PAVEZ IRRAZABAL','JORGE','8024540-8','jorge.pavez@usach.cl','','','',2,15,2),
  (2401,'PAREDES GARCIA','VERONICA','9409911-0',NULL,'','','',2,16,57),
  (2402,'MANSILLA MUÑOZ','ANDRES','9822959-0',NULL,'','','',2,16,10),
  (2403,'GARRIDO NEGRI','JORGE','2633774-7',NULL,'','','',2,16,60),
  (2404,'ZUÑIGA GARAY','ELISA ARIADNE','10193984-7',NULL,'','','',2,16,1),
  (2405,'CABAÑAS','FERNANDA','17145609-6',NULL,'','','',2,16,1),
  (2406,'ROMAN ALISTE','JUAN ISMAEL','17307957-5','juan.romana@usach.cl','','','',2,38,21),
  (2407,'VIDAL ROJAS','RODRIGO','8900392-K','rodrigo.vidal@usach.cl','','','',2,17,2),
  (2408,'ALCARAZ','LUIS ANTONIO','EXT-LALCARAZ',NULL,'','','',2,16,1),
  (2409,'PALMA IRARRAZABAL','ANDRES','7.040.289-0','andres.palma@usach.cl','','','',2,23,2),
  (2410,'BARRIA TRAVERSO','DIEGO','15366667-9',NULL,'','','',2,16,2),
  (2411,'PEÑA CASTILLO','LILIAN EUGENIA','9748861-4',NULL,'','','',2,16,2),
  (2412,'DONOSO SIERRA','PEDRO','8879465-6',NULL,'','','',2,16,2),
  (2413,'GIL GALVEZ','CARLOS RAUL','73774941-7',NULL,'','','',2,16,2),
  (2414,'ROBERT CANALES','PAZ SOLEDAD','EXT-PROBERT',NULL,'','','',2,16,12),
  (2415,'SILVA WEISS','ANDREA CRISTINA','USACH-ASILVA','andrea.silva@usach.cl','','','',2,38,2),
  (2416,'COFRADES','SUSANA','EXT-SCOFRADES',NULL,'','','',2,16,1),
  (2417,'VERDUGO','CHRISTIAN','EXT-CVERDUGO',NULL,'','','',2,16,1),
  (2418,'RETAMAL','MAURICIO','EXT-MRETAMAL',NULL,'','','',2,16,1),
  (2419,'SILVA QUIROZ','JUAN EUSEBIO','10.380.940-1','juan.silva@usach.cl','','','',2,31,2),
  (2420,'FERNANDEZ SERRANO','ELIO','EXT-EFERNANDEZ',NULL,'','','',2,16,1),
  (2421,'REVUELTA','FRANCISCO','EXT-FREVUELTA',NULL,'','','',2,16,1),
  (2422,'COBO','CRISTOBAL','EXT-CCOBO',NULL,'','','',2,16,1),
  (2423,'IBARRA','PAULA','13964326-7',NULL,'','','',2,16,2),
  (2424,'GONZALEZ POBLETE','LAURA','8013648-K',NULL,'','','',2,6,2),
  (2425,'MANDIOLA QUILILONGO','CHRISTIAN JESUS','12802124-8',NULL,'','','',2,16,2),
  (2426,'SEGUEL','GUILLERMO','EXT-GSEGUEL',NULL,'','','',2,16,1),
  (2427,'BRITO','CARMEN','EXT-CBRITO',NULL,'','','',2,16,1),
  (2428,'BERRIOS GUIÑEZ','CRISTHIAN','EXT-CBERRIOS',NULL,'','','',2,16,1),
  (2429,'CAMPBELL','DANIEL','EXT-DCAMPBELL',NULL,'','','',2,16,1),
  (2430,'ARANDA','JORGE','EXT-JARANDA',NULL,'','','',2,16,1),
  (2431,'MORGADO CONTARDO','RODRIGO FERNAN','15722707-6','rmorgado@gmail.com',NULL,NULL,NULL,1,NULL,NULL),
  (2432,'BECERRA MUÑOZ','JUAN PABLO','14564407-0',NULL,'','','',2,16,2),
  (2433,'TORRES GALVEZ','CLAUDIO','USACH-CTORRES',NULL,'','','',2,16,2),
  (2434,'ABELLO VARAS','CARLOS IGNACIO','17.313.640-4','carlos.abello@usach.cl','','','',2,16,2),
  (2435,'LINO','LUIS','USACH-LLINO','luis.lino@innovo.usach.cL','','','',2,16,2),
  (2436,'CARO CASTRO','VICTOR','13263514-5','victor.caro@usach.cl','','','',2,16,2),
  (2437,'GONZALEZ','SEBASTIAN','17022367-5',NULL,'','','',2,6,21),
  (2438,'SANDOVAL','NICOLAS','16663651-5',NULL,'','','',2,6,2),
  (2439,'Muñoz Vásquez','Carla','17.155.739-9',NULL,'','','',2,6,2),
  (2440,'Villegas Ramírez','Loreto','13.288.151-0',NULL,'','','',2,6,2),
  (2441,'Santander Meyer','Rocío','15.314.535-0',NULL,'','','',2,6,1),
  (2442,'SOTO','MARIO','EXT_MSOTO',NULL,'','','',2,16,1),
  (2443,'Morales Díaz','Claudio','EXT-6','Ext','','','',2,16,1),
  (2445,'FARAN','RUTH PAZ','EXT-7','EXT','','','',2,16,1),
  (2446,'Mejías Medina','Sophia Charlotte','16.415.156-5',NULL,'','','',2,6,2),
  (2447,'Herrera Urbina','Felipe Andrés','15.476.687-1','felipe.herrera.u@usach.cl','','','',2,18,2),
  (2448,'MOLINA VILLAVICENCIA','RODRIGO','EXT-RMOLINAVILL',NULL,'','','',2,16,15),
  (2449,'Ramon Lavin','Jorge Arturo','EXT- JRAMON','Externo','','','',2,16,4),
  (2450,'CONTRERAS GUZMAN','EMILIO SEGUNDO','EXT-3705678-2','Externo','','','',2,38,1),
  (2451,'SANCHEZ ROMERO','CECILIA','S/I','S/I','','','',2,16,2),
  (2452,'VALDERRAMA REYES','WALDO','EXT-WVALDERRAMA','Externo','','','',2,16,13),
  (2453,'PONTT OLIVARES','JORGE','EXT-JPONTT','Externo','','','',2,16,13),
  (2454,'PERELLI BACIGALUPO','ENNIO','EXT-EPERELLI','Externo','','','',2,16,13),
  (2455,'VELASQUEZ','CLAUDIA','EXT-CVELASQUEZ','Externo','','','',2,16,1),
  (2456,'RIQUELME HORMAZABAL','RODRIGO','EXT-RRIQUELME','Externo','','','',2,16,13),
  (2457,'SALGADO IBARRA','F','EXT-FSALGADO','Externo','','','',2,16,13),
  (2458,'VILLARROEL VILLARROEL','LUIS','EXT-LVILLARROEL','Externo','','','',2,16,5),
  (2459,'SINGH SINGH','DINESH PRATAP','23.708.532-9','singh.dinesh@usach.cl','','','',2,18,2),
  (2460,'LÓPEZ CABRERA','CARLOS ENRIQUE','13.469.447-5','carlos.lopez@usach.cl','','','',2,18,2),
  (2461,'CARRILLO AVILA','SAUL PAULO','13672518-1','saul.carrillo@usach.cl','','','',2,16,2),
  (2462,'Guzmán Delgado','Paulina Alejandra','18.153.228-9','paulina.guzman237@gmail.com','','','',2,6,2),
  (2463,'CASTILLO SEGURA','JONATHAN ALEJANDRO','EXT-JCASTILLO',NULL,'','','',2,14,65),
  (2464,'GUZMÁN MÉNDEZ','DANNY FRANCISCO','EXT-DGUZMÁN',NULL,'','','',2,14,65),
  (2465,'SEPÚLVEDA RIVERA','ROSSANA DANIELA','EXT-RSEPÚLVEDA',NULL,'','','',2,14,65),
  (2466,'SOLIZ AYALA','ÁLVARO DAVID','EXT-ASOLIZ',NULL,'','','',2,16,65),
  (2467,'MUÑOZ ARAYA','PATRICIO ALBERTO','EXT-PMUÑOZ',NULL,'','','',2,16,65),
  (2468,'RIVERA LI KAO','ÓSCAR RODRIGO','EXT-ORIVERA',NULL,'','','',2,16,65),
  (2469,'ZAZZALI MARTIN','BRUNO SALVATORE','EXT-BZAZZALI',NULL,'','','',2,16,65),
  (2470,'ARAYA','LUZ','EXT-LARAYA',NULL,'','','',2,16,65),
  (2471,'BIEGER','KLAUS','EXT-KBIEGER',NULL,'','','',2,16,65),
  (2472,'TARRÍO MOSQUERA','JOSÉ ANTONIO','ESP-JTARRÍO',NULL,'','','',2,35,2),
  (2473,'ZURUTUZA','JOAQUÍN','ESP-JZURUTUZA',NULL,'','','',2,35,2),
  (2474,'HERNÁNDEZ LÓPEZ','DAVID','ESP 07555547R',NULL,'','','',2,35,2),
  (2475,'CUADRADO MÉNDEZ','ÓSCAR','ESP-OCUADRADO',NULL,'','','',2,35,2),
  (2476,'SOTO MÁRQUEZ','ESTEBAN MANUEL','877628-0',NULL,'','','',2,35,2),
  (2477,'MONTOYA TORRES','JAIRO R.','COL-JMONTOYA','jrmontoy@yahoo.com','','','',2,11,2),
  (2478,'BENÍTEZ FUENTES','PAULO ANDRÉS','10.353.406-2','paulo@test.cl',NULL,NULL,NULL,1,NULL,NULL),
  (2479,'TUDELA ROMÁN','ALEJANDRO','9.456.178-7',NULL,'','','',2,16,47),
  (2480,'GARCÍA MELERO','GUSTAVO','ESP-GGARCÍA',NULL,'','','',2,16,9),
  (2481,'PEZOA','JORGE E.','EXT-JPEZOA',NULL,'','','',2,16,47),
  (2482,'CARRASCO MONTAGNA','JUAN ANTONIO','EXT-JCARRASCO',NULL,'','','',2,16,47),
  (2483,'MONTT VEAS','CECILIA ANTONIETA','EXT-CMONTT',NULL,'','','',2,16,9),
  (2484,'VALENCIA VÁSQUEZ','ALEJANDRA','EXT-AVALENCIA',NULL,'','','',2,16,9),
  (2485,'ARANCIBIA','CARLA','13985202-8',NULL,'','','',2,38,2),
  (2486,'VEGA VIVEROS','RICARDO','5.788.851-2','ricardo.vega@usach.cl','','','',2,15,1),
  (2487,'GUEVARA PEZOA','FELIPE','14.176.093-9','felipe.guevara.p@usach.cl','','','',2,38,2),
  (2488,'SEPULVEDA PALMA','FRANCISCO HERNAN','10.032.641-8','francisco.sepulveda.p@usach.cl',NULL,NULL,NULL,1,NULL,NULL),
  (2489,'Radrigán Rubio','Mario','x',NULL,'','','',2,22,2),
  (2490,'Escrig Durán','Daniela Nicole','xx','dany.escrig@gmail.com','','','',2,6,1),
  (2491,'Mena Silva','Javier Alejandro','17.310.177-5','javier.mena@usach.cl','','','',2,6,1),
  (2492,'Hachim','Luis','7.055.598-0','luis.hachim@usach.cl','','','',2,41,2),
  (2493,'Egaña Baraona','Ana María','5.892.497-0','anamaria.egana@usach.cl','','','',2,29,2),
  (2494,'Pérez Arrau','José Gregorio','xxxx',NULL,'','','',2,20,2),
  (2495,'BUGUEÑO LARA','ESTEBAN OMAR','EX17.965.719- 8','ebuguenolara@gmail.com','','','',2,17,1),
  (2496,'Oviedo Castillo','Nicolás Eduardo','EXT18.071.852-4','Nicolas.oviedo@usach.cl','','','',2,16,1),
  (2497,'Guerrero Escudero','Esteban Emanuel','EXT18.116.454-9','Esteban.guerrero@usach.cl','','','',2,16,1),
  (2498,'MORALES SIERRA','EDUARDO HUGO','17.178.271-6','eduardo.morales.s@hotmail.com','','','',2,6,2),
  (2499,'CRUCES ROMERO','EDGARDO ANTONIO','11.722.766-9','edgardo.cruces@usach.cl','','','',2,6,2),
  (2500,'Muñoz Rojas','Alejandro Patricio','16473862-0',NULL,'','','',2,6,2),
  (2501,'AHUMADA MUÑOZ','VIVIANA ANDREA','16855251-3',NULL,'','','',2,6,1),
  (2502,'Ruiz León','Domingo Arturo','14423958-K','domingo.ruiz@usach.cl','','','',2,8,2),
  (2503,'Navarro Lisboa','Rosa Macarena','15.770.405-2','rosa.navarro@usach.cl','','','',2,38,2),
  (2504,'Astudillo Castro','Carolina Luisa','8.701.321-9',NULL,'','','',2,16,9),
  (2505,'CONTRERAS ARREDONDO','RODRIGO ANDRÉS','EXT','rodrigo.contrerasar@usach.cl','','','',2,16,1),
  (2506,'ARANCIBIA ROCO','NATALY ESTEFANÍA','17.618.321-7','naty.roco@gmail.com','','','',2,6,1),
  (2507,'ALARCON LILLO','CARLOS SEBASTIAN','18.039.015-4','carlos.alarconl@usach.cl','','','',2,5,1),
  (2508,'PINTO BIZAMA','CAMILO ANTONIO','16.809.302-0','cpinto.bizama@gmail.com','','','',2,6,2);
COMMIT;

/* Data for the `investigador` table  (LIMIT 2079,500) */

INSERT INTO `investigador` (`idInvestigador`, `apellidos`, `nombres`, `numeroIdentificacion`, `email`, `telefonoFijo`, `telefonoMovil`, `direccion`, `idPerfilInvestigador`, `departamento_id`, `institucion_id`) VALUES
  (2509,'MARINAO ARTIGAS','ENRIQUE ALEX','9249941-3','enrique.marinao@usach.cl','','','',2,20,2),
  (2510,'MUÑOZ BUZETA','ROMINA WALESKA','16.207.468-7','romina.munoz@usach.cl','','','',2,18,1),
  (2511,'AGUILAR SANDOVAL','FELIPE ANDRES','13.774.511-9',NULL,'','','',2,18,2),
  (2512,'Lara Suzarte','Marcelo Andrés','17.740.726-7',NULL,'','','',2,6,2),
  (2513,'PEREDO PARADA','MATÍAS','-','matias.peredo@usach.cl','','','',2,34,2),
  (2514,'YEVENES CUEVAS','JUAN PABLO','17.158.594-5','juan.yevenesc@usach.cl','','','',2,34,21),
  (2515,'MENA SILVA','DENISSE ROXANA','18.173.358-3','denisse.mena@usach.cl','','','',2,6,21),
  (2516,'ZAVALA PULGAR','EDUARDO JAVIER','USACH-EZAVALA','edzavalap@usach.cl','','','',2,6,2),
  (2517,'DIAZ PONCE','IGNACIO RAÚL','18.122.655-2','ignacio.diaz@usach.cl','','','',2,10,21),
  (2518,'VENEGAS ACEVEDO','PAULA ANDREA','USACH-PVENEGAS','-','','','',2,41,2),
  (2519,'GALLEGUILLOS HENRIQUEZ','EMILIO JAVIER','USACH-EGALLEGUI','emilio.galleguillos@gmail.com','','','',2,10,2),
  (2520,'CARDENAS LATTUS','JOSE IGNACIO','USACH-JCARDENAS','JOSE.CARDENASL@USACH.CL','','','',2,10,21),
  (2521,'Santiagos Hevia','Pablo Ignacio','USACH-PSANTIAGO','pablo.santiagos@usach.cl','','','',2,14,21),
  (2522,'Sills Arias','Michella Natalie','15.523.808-9','michella.sills@usach.cl','','','',2,11,21),
  (2523,'Parra Mardonez','Mick','USACH-MPARRA','-','','','',2,7,57),
  (2524,'Ayala Chaparro','Cristian','EXT-CCHAPARRO','cristian.ayala@live.cl','','','',2,18,21),
  (2525,'Pimentel Henríquez','Antonio','USACH.APIMENTEL','antonio.pimentel@usach.cl','','','',2,11,21),
  (2526,'Valenzuela Fuenzalida','Eduardo','USACH-EVALENZUE','rectoria@usach.cl','','','',2,13,21),
  (2527,'EASTMAN FIGUEROA','CRISTOBAL IGNACIO','17.168.355-6','cristobal.eastman@usach.cl','','','',2,10,21),
  (2528,'UGARTE','GASPAR','USACH-GUGARTE',NULL,'','','',2,13,21),
  (2529,'VASCO CALLE','DIEGO ANDRÉS','22.675.656-6','diego.vascoc@usach.cl','','','',2,15,2),
  (2530,'SILVA GONZÁLEZ','NATALY','16.360.045-5','natalysilvag@gmail.com','','','',2,8,2),
  (2531,'JARA PICAS','PABLO ENRIQUE','12.863.285-9','pablo.jara.p@usach.cl','','','',2,6,2),
  (2532,'VELÁSQUEZ YÉVENES','LILIAN DE LOURDES','10.421.292-1','lilian.velasquez@usach.cl','','','',2,33,2),
  (2533,'QUEVEDO TEJADA','DIANA ISABEL','23194080','diana.quevedo@usach.cl','','','',2,34,2),
  (2534,'TORRES ORTEGA','JORGE ANTONIO','13.055.616-7','jorge.torres@usach.cl','','','',2,39,2),
  (2535,'SILVA MENDEZ','CRISTIAN MOISES','17.839.246-8','cmfa01@gmail.com','','','',2,16,1),
  (2536,'BOBILLIER ROCHET','FELIPE ANDRES','17318747-5','bobi17@hotmail.com','','','',2,16,1),
  (2537,'DIAZ NOVOA','BORIS MANUEL','17.858.134-1','borisdiazn@gmail.com','','','',2,16,1),
  (2538,'SEURA ARAYA','PABLO ANDRES','16.940.696-0','seurajuniorp_14@hotmail.com','','','',2,16,1),
  (2539,'CANALES AREVALO','DANIEL ALBERTO','16.127.224-8','daniel.canalesarevalo@gmail.com','','','',2,16,1),
  (2540,'Yañez Soto','Francisco Andrés','17.907.377-3','Francisco.yanez@usach.cl','','','',2,16,1),
  (2541,'CELIS COFRÉ','DANIELA ANDREA','15.730.608-1','daniela.celisc@usach.cl','','','',2,38,2),
  (2542,'PEÑA CORTÉS','ANGÉLICA','9.018.459-8','angelica.pena@usach.cl','','','',2,21,2),
  (2543,'PINO LÓPEZ','EDUARDO FRANCISCO','10.929.578-7','eduardo.pino@usach.cl','','','',2,24,2),
  (2544,'ALIAGA VIDAL','CAROLINA DEL PILAR','9.971.734-3','carolina.aliaga@usach.cl','','','',2,7,2),
  (2545,'PEREZ HERRERA','HUGO','REV','hugo.perez.h@usach.cl','','','',2,28,2),
  (2546,'ECHEVERRIA MORGADO','JAVIER FELIPE','15.405.332-8','javier.echeverriam@usach.cl','','','',2,7,2),
  (2547,'OLIVARES CASTILLO','ERIC','15.819.531-3','eric.olivares@centrocomenius.org','','','',2,12,1),
  (2548,'FIGARI LEIVA','JUAN PABLO','18120417-6','uan.figari@usach.cl','','','',2,6,2),
  (2549,'ESCALANTE SALAMANCA','MACARENA ANDREA','15.564.362-5','macarena.escalante@usach.cl','','','',2,31,2),
  (2550,'SILVA CUEVAS','MAURO ESTEBAN','9.054.100-5','MAURO.SILVA@USACH.CL','','','',2,31,2),
  (2551,'FERRADA CABRERA','CARLOS ALBERTO','15.899.733-9','carlos.ferrada.c@gmail.com','','','',2,13,2),
  (2552,'Muñoz','Cristian','USACH-CMUÑOZ',NULL,'','','',2,20,2),
  (2553,'YANEZ ALVARADO','PEDRO','8.351-579-1','pedro.yanez.a@usach.cl','','','',2,25,2),
  (2554,'Parker Gumucio','Cristian','6.342.162-6','Cristian.parker@usach.cl','','','',2,39,2),
  (2555,'CARRASCO NORAMBUENA','CARMEN ELIANA','4.374.760-6','carmen.norambuena@usach.','','','',2,32,2),
  (2556,'GARCÍA CORRALES','MIGUEL','9.904.328-8','ipt@ucentral.cl','','','',2,39,1),
  (2557,'RIOS MOMBERG','MAURICIO','11.413.320-5','mauricio.rios@usach.cl','','','',2,39,2),
  (2558,'ARELLANO BAEZA','ALONSO','10.607.568-9','alonso.arellano@usach.cl','','','',2,33,2),
  (2559,'GARAY SALAS','PATRICIA','5.813.283-7','-','','','',2,26,2),
  (2560,'OTEIZA MORRA','FIDEL','3.199.293-1','foteiza@comenius.usach.cl','','','',2,19,2),
  (2561,'CARDENAS NUÑEZ','JOSE','4.779.310-6','jcardena@usach.cl','','','',2,25,2),
  (2562,'GIL','FRANCISCO JAVIER','USACH-FGIL','-','','','',2,7,2),
  (2563,'SAAVEDRA','FIDEROMO','USACH-FSAAVEDRA',NULL,'','','',2,10,2),
  (2564,'LAGOS TAPIA','JOSE IGNACIO','20.083.846-7','ignaciolagos.arq@gmail.com','','','',2,16,1),
  (2565,'Ampuero Nilo','Leandro','18.055.719-9','leandro.ampuero@usach.cl','','','',2,16,1),
  (2566,'MADRID SALAZAR','MACARENA','Externo',NULL,'','','',2,16,21),
  (2567,'MUÑOZ','LISA','EXT-LISAMUÑOZ',NULL,'','','',2,16,21),
  (2568,'MENA','JAVIER','EXT-JAVIERMENA',NULL,'','','',2,16,21),
  (2569,'JIMENEZ MATURANA','IVAN','13.300.936-1','ijimenezmaturana@gmail.com','','','',2,17,2),
  (2570,'TOLEDO ALONSO','JORGE','Ext-UdeC',NULL,'','','',2,6,47),
  (2571,'SANCHEZ RAMOS','OLIBERTO','Ext-UdeConce',NULL,'','','',2,5,47),
  (2572,'RUIZ GARRIDO','ALVARO RAFAEL','Ext-UdeCo',NULL,'','','',2,6,47),
  (2573,'VILLAMIL PEREZ','AURA','Ext-UdeCon',NULL,'','','',2,6,47),
  (2574,'GUTIERREZ ROJAS','FERNANDO','Ext-UdeConcep',NULL,'','','',2,6,47),
  (2575,'LAZAMARES ARCIA','EMILIO','Ext-UdeConcepc',NULL,'','','',2,6,47),
  (2577,'CIFUENTES','DIEGO','Ext-CIFU',NULL,'','','',2,6,1),
  (2578,'GONZALEZ LINCOÑIR','PATRICIA ALEJANDRA','18.128.399-8','patricia.gonzalezl@usach.cl','','','',2,6,21),
  (2579,'RAMÍREZ TAGLE','RODRIGO','13.435.606-5',NULL,'','','',2,16,81),
  (2580,'SAMITH MONSALVE','VICENTE','9.668.059-7','vdsamith@uc.cl','','','',2,16,1),
  (2581,'VILLANUEVA','GARY','ALUMNO','gary.villanueva@usach.cl','','','',2,16,1),
  (2582,'IPINZA OLATTE','CONSTANZA ALEXANDRA','15.644.057-4','constanza.ipinza@gmail.com','','','',2,28,2),
  (2583,'test','test 2','2222111','test 3',NULL,NULL,'',2,NULL,NULL),
  (2584,'test 1','test 2','898989','test 3',NULL,NULL,'',1,NULL,NULL),
  (2585,'A','B','1212','C',NULL,NULL,'',1,NULL,NULL),
  (2586,'s','df','2323','g',NULL,NULL,'',2,NULL,NULL),
  (2587,'A','B','5555','C',NULL,NULL,'',1,NULL,NULL),
  (2588,'Urrea','Rodolfo','41021012','rurrea',NULL,NULL,NULL,1,NULL,NULL);
COMMIT;

/* Data for the `investigador_fuentefinanciamiento` table  (LIMIT 0,500) */

INSERT INTO `investigador_fuentefinanciamiento` (`idInvestigador`, `idFuenteFinanciamiento`) VALUES
  (2431,1),
  (2431,2),
  (2431,3),
  (2431,4);
COMMIT;

/* Data for the `itempresupuesto` table  (LIMIT 0,500) */

INSERT INTO `itempresupuesto` (`idItemPresupuesto`, `idProyecto`, `idCuentaPresupuesto`, `item`, `monto`, `mes`, `ano`, `detalle`) VALUES
  (8,10,1,'test',500000,2,2018,'prueba'),
  (9,10,1,'test',500000,3,2018,'prueba'),
  (10,10,1,'test',500000,4,2018,'prueba'),
  (11,10,1,'test',500000,5,2018,'prueba'),
  (12,10,1,'test',500000,6,2018,'prueba'),
  (13,10,1,'test',500000,7,2018,'prueba'),
  (14,10,1,'test',500000,8,2018,'prueba'),
  (15,10,1,'test',500000,9,2018,'prueba'),
  (16,10,1,'test',500000,10,2018,'prueba'),
  (17,10,1,'Desarrollador 1',650000,1,2018,'Jorge Perez'),
  (18,10,1,'Desarrollador 1',650000,2,2018,'Jorge Perez'),
  (19,10,1,'Desarrollador 1',650000,3,2018,'Jorge Perez'),
  (20,10,1,'Desarrollador 1',650000,4,2018,'Jorge Perez'),
  (21,10,1,'Desarrollador 1',650000,5,2018,'Jorge Perez'),
  (22,10,1,'Desarrollador 1',650000,6,2018,'Jorge Perez'),
  (23,10,1,'Desarrollador 1',650000,7,2018,'Jorge Perez'),
  (27,10,3,'viaticos',250000,5,2018,'colacion y movilizacion'),
  (28,10,3,'viaticos',120000,6,2018,'colacion y movilizacion'),
  (29,10,3,'viaticos',120000,7,2018,'colacion y movilizacion'),
  (30,10,3,'viaticos',125000,8,2018,'colacion y movilizacion'),
  (32,10,1,'Jefe de Proyecto',600000,4,2018,'Rodrigo M.'),
  (33,10,1,'Jefe de Proyecto',600000,5,2018,'Rodrigo M.'),
  (34,10,1,'Jefe de Proyecto',600000,6,2018,'Rodrigo M.'),
  (35,10,1,'Jefe de Proyecto',600000,7,2018,'Rodrigo M.'),
  (36,10,1,'Jefe de Proyecto',600000,8,2018,'Rodrigo M.'),
  (37,10,1,'Jefe de Proyecto',600000,9,2018,'Rodrigo M.'),
  (38,10,1,'Jefe de Proyecto',600000,10,2018,'Rodrigo M.'),
  (39,10,1,'Jefe de Proyecto',600000,11,2018,'Rodrigo M.'),
  (40,10,1,'Jefe de Proyecto',600000,0,2019,'Rodrigo M.'),
  (41,10,1,'Jefe de Proyecto',600000,1,2019,'Rodrigo M.'),
  (42,10,1,'Jefe de Proyecto',600000,2,2019,'Rodrigo M.'),
  (43,10,1,'Jefe de Proyecto',600000,3,2019,'Rodrigo M.'),
  (44,10,1,'Jefe de Proyecto',600000,4,2019,'Rodrigo M.'),
  (45,10,1,'Jefe de Proyecto',600000,5,2019,'Rodrigo M.'),
  (46,10,1,'viaticos',130000,8,2018,'colacion y movilizacion'),
  (47,10,1,'viaticos',130000,8,2018,'colacion y movilizacion'),
  (48,10,1,'viaticos',130000,8,2018,'colacion y movilizacion'),
  (49,10,1,'viaticos',125000,8,2018,'colacion y movilizacion'),
  (50,10,1,'viaticos',120000,8,2018,'colacion y movilizacion'),
  (53,10,1,'Desarrollador ayudante',500000,0,2019,'Ricardo Soto'),
  (54,10,1,'Desarrollador ayudante',500000,1,2019,'Ricardo Soto'),
  (55,10,1,'Desarrollador ayudante',500000,2,2019,'Ricardo Soto'),
  (56,10,1,'Desarrollador ayudante',500000,3,2019,'Ricardo Soto'),
  (57,10,1,'Desarrollador ayudante',500000,4,2019,'Ricardo Soto'),
  (58,10,1,'Desarrollador ayudante',500000,5,2019,'Ricardo Soto'),
  (59,10,1,'Control de Calidad',380000,2,2019,'Luis Catalan'),
  (60,10,1,'Control de Calidad',380000,3,2019,'Luis Catalan'),
  (61,10,1,'Control de Calidad',380000,4,2019,'Luis Catalan'),
  (62,10,1,'Control de Calidad',380000,5,2019,'Luis Catalan'),
  (63,10,1,'Ingeniero Electrico',500000,1,2019,'Jorge Santos'),
  (64,10,1,'Ingeniero Electrico',500000,2,2019,'Jorge Santos'),
  (65,10,1,'Ingeniero Electrico',500000,3,2019,'Jorge Santos'),
  (66,12,1,'Programador Junior',850000,8,2019,'Luis Rivas'),
  (67,12,1,'Programador Junior',850000,1,2019,'Luis Rivas'),
  (68,12,1,'Programador Junior',850000,2,2019,'Luis Rivas'),
  (69,12,1,'Programador Junior',850000,3,2019,'Luis Rivas'),
  (70,12,1,'Programador Junior',850000,4,2019,'Luis Rivas'),
  (71,12,1,'Programador Junior',850000,5,2019,'Luis Rivas'),
  (72,12,1,'Programador Junior',850000,6,2019,'Luis Rivas'),
  (73,12,1,'Programador Junior',850000,7,2019,'Luis Rivas'),
  (74,12,1,'Programador Senior',1800000,8,2019,'David Diaz'),
  (75,12,1,'Programador Senior',1800000,1,2019,'David Diaz'),
  (76,12,1,'Programador Senior',1800000,2,2019,'David Diaz'),
  (77,12,1,'Programador Senior',1800000,3,2019,'David Diaz'),
  (78,12,1,'Programador Senior',1800000,4,2019,'David Diaz'),
  (79,12,1,'Programador Senior',1800000,5,2019,'David Diaz'),
  (80,12,1,'Programador Senior',1800000,6,2019,'David Diaz'),
  (81,12,1,'Programador Senior',1800000,7,2019,'David Diaz'),
  (82,12,1,'Jefe de Proyecto',1200000,0,2019,'Eric Diaz'),
  (83,12,1,'Jefe de Proyecto',1200000,1,2019,'Eric Diaz'),
  (84,12,1,'Jefe de Proyecto',1200000,2,2019,'Eric Diaz'),
  (85,12,1,'Jefe de Proyecto',1200000,3,2019,'Eric Diaz'),
  (86,12,1,'Jefe de Proyecto',1200000,4,2019,'Eric Diaz'),
  (87,12,1,'Jefe de Proyecto',1200000,5,2019,'Eric Diaz'),
  (88,12,1,'Jefe de Proyecto',1200000,6,2019,'Eric Diaz'),
  (89,12,1,'Jefe de Proyecto',1200000,8,2019,'Eric Diaz'),
  (90,12,1,'test',100000,0,2019,'lucho perez'),
  (91,12,1,'test',100000,1,2019,'lucho perez'),
  (92,12,1,'test',100000,2,2019,'lucho perez'),
  (93,12,1,'test',100000,3,2019,'lucho perez'),
  (94,12,1,'test',100000,4,2019,'lucho perez'),
  (95,12,1,'test',100000,5,2019,'lucho perez'),
  (96,12,1,'test',100000,6,2019,'lucho perez'),
  (97,12,1,'test',100000,8,2019,'lucho perez'),
  (98,12,1,'test 2',150000,0,2019,'prueba 2'),
  (99,12,1,'test 2',150000,1,2019,'prueba 2'),
  (100,12,1,'test 2',150000,2,2019,'prueba 2'),
  (101,12,1,'test 2',150000,3,2019,'prueba 2'),
  (102,12,1,'test 2',150000,4,2019,'prueba 2'),
  (103,12,1,'test 2',150000,5,2019,'prueba 2'),
  (104,12,1,'test 2',150000,6,2019,'prueba 2'),
  (105,12,1,'test 2',150000,8,2019,'prueba 2'),
  (106,12,1,'zsss',121212,0,2019,'sdsds'),
  (107,12,1,'zsss',121212,1,2019,'sdsds'),
  (108,12,1,'zsss',121212,2,2019,'sdsds'),
  (109,12,1,'zsss',121212,3,2019,'sdsds'),
  (110,12,1,'zsss',121212,4,2019,'sdsds'),
  (111,12,1,'zsss',121212,5,2019,'sdsds'),
  (112,12,1,'zsss',121212,6,2019,'sdsds'),
  (113,12,1,'zsss',121212,8,2019,'sdsds'),
  (114,12,1,'TEST 5',180000,1,2019,'PRUEBA 5'),
  (115,12,1,'TEST 5',180000,2,2019,'PRUEBA 5'),
  (116,12,1,'TEST 5',180000,3,2019,'PRUEBA 5'),
  (117,12,1,'TEST 5',180000,4,2019,'PRUEBA 5'),
  (118,12,1,'TEST 5',180000,5,2019,'PRUEBA 5'),
  (119,12,1,'TEST 5',180000,6,2019,'PRUEBA 5'),
  (120,12,1,'TEST 5',180000,7,2019,'PRUEBA 5'),
  (121,12,1,'TEST 5',180000,8,2019,'PRUEBA 5'),
  (122,12,1,'test 6',150000,1,2019,'prueba 6'),
  (123,12,1,'test 6',150000,2,2019,'prueba 6'),
  (124,12,1,'test 6',150000,3,2019,'prueba 6'),
  (125,12,1,'test 6',150000,4,2019,'prueba 6'),
  (126,12,1,'test 6',150000,5,2019,'prueba 6'),
  (127,12,1,'test 6',150000,6,2019,'prueba 6'),
  (128,12,1,'test 6',150000,7,2019,'prueba 6'),
  (129,12,1,'test 6',150000,8,2019,'prueba 6'),
  (130,12,1,'test 6',150000,9,2019,'prueba 6');
COMMIT;

/* Data for the `menu` table  (LIMIT 0,500) */

INSERT INTO `menu` (`idMenu`, `etiqueta`, `submenu`, `orden`, `activo`, `href`) VALUES
  (1,'Inicio',0,1,1,'dashboard/'),
  (2,'Iniciativas',0,2,0,'seliniciativa/'),
  (3,'Proyectos',0,3,0,'selproyecto/'),
  (4,'Tecnologías',0,4,0,'seltecnologia/'),
  (5,'Finanzas',0,6,0,'finanzas/'),
  (6,'Informes',0,7,0,'#'),
  (7,'Tareas',0,8,0,'listaTareasUsuario'),
  (8,'Maestros',1,9,0,NULL),
  (9,'Respaldo',0,10,0,'#'),
  (10,'Contratos',0,5,0,'selcontrato/');
COMMIT;

/* Data for the `oficinaregistro` table  (LIMIT 0,500) */

INSERT INTO `oficinaregistro` (`idOficinaRegistro`, `nombre`, `tipo`, `codigo`) VALUES
  (1,'Chile',2,'CL'),
  (2,'EEUU',2,'EEUU'),
  (3,'PCT',1,'PCT'),
  (4,'Afganistán',1,'AF'),
  (5,'Andorra',1,'AN'),
  (6,'Anguilla',1,'AN'),
  (7,'Antillas Holandesas',1,'AH'),
  (8,'Argentina',1,'AR'),
  (9,'Aruba',1,'AR'),
  (10,'Bahamas',1,'BA'),
  (11,'Bangladesh',1,'BA'),
  (12,'Bermuda',1,'BE'),
  (13,'Bolivia',1,'BO'),
  (14,'Burundi',1,'BU'),
  (15,'Bután',1,'BU'),
  (16,'Cabo Verde',1,'CV'),
  (17,'Camboya',1,'CA'),
  (18,'Estados Federales de la Micronesia',1,'EF'),
  (19,'Etiopía',1,'ET'),
  (20,'Fiyi',1,'FI'),
  (21,'Groenlandia',1,'GR'),
  (22,'Guadalupe',1,'GU'),
  (23,'Guam',1,'GU'),
  (24,'Guayana',1,'GU'),
  (25,'Guayana Francesa',1,'GF'),
  (26,'Haití',1,'HA'),
  (27,'Iraq',1,'IR'),
  (28,'Isla Pitcairn',1,'IP'),
  (29,'Islas Caimán',1,'IC'),
  (30,'Islas Cocos',1,'IC'),
  (31,'Islas Cook',1,'IC'),
  (32,'Islas de Navidad',1,'IN'),
  (33,'Islas Feroés',1,'IF'),
  (34,'Islas Maldivas',1,'IM'),
  (35,'Islas Marshall',1,'IM'),
  (36,'Islas salomón',1,'IS'),
  (37,'Islas Turcas y Caicos',1,'IT'),
  (38,'Islas Vírgenes Americanas',1,'IV'),
  (39,'Islas Vírgenes Británicas',1,'IV'),
  (40,'Jamaica',1,'JA'),
  (41,'Jordania',1,'JO'),
  (42,'Kiribati',1,'KI'),
  (43,'Kosovo',1,'KO'),
  (44,'Kuwait',1,'KU'),
  (45,'Líbano',1,'LI'),
  (46,'Macao',1,'MA'),
  (47,'Maldivas',1,'MA'),
  (48,'Marianas del Norte',1,'MN'),
  (49,'Martinica',1,'MA'),
  (50,'Mauricio',1,'MA'),
  (51,'Mayotte',1,'MA'),
  (52,'Myanmar',1,'MY'),
  (53,'Nauru',1,'NA'),
  (54,'Nepal',1,'NE'),
  (55,'Niue',1,'NI'),
  (56,'Pakistán',1,'PA'),
  (57,'Paraguay',1,'PA'),
  (58,'Polinesia Francesa',1,'PF'),
  (59,'República Centroafricana',1,'RC'),
  (60,'Sahara Occidental',1,'SO'),
  (61,'Samoa',1,'SA'),
  (62,'Samoa Americana',1,'SA'),
  (63,'Santa Sede',1,'SS'),
  (64,'Sudán del Sur',1,'SS'),
  (65,'Surinam',1,'SU'),
  (66,'Taiwán',1,'TA'),
  (67,'Territorios Palestinos',1,'TP'),
  (68,'Tibet',1,'TI'),
  (69,'Timor Oriental',1,'TO'),
  (70,'Tokelau',1,'TO'),
  (71,'Tonga',1,'TO'),
  (72,'Tuvalu',1,'TU'),
  (73,'Uruguay',1,'UR'),
  (74,'Vanuatu',1,'VA'),
  (75,'Venezuela',1,'VE'),
  (76,'Wallis y Futuna',1,'WF'),
  (77,'Yemen',1,'YE');
COMMIT;

/* Data for the `paises` table  (LIMIT 0,500) */

INSERT INTO `paises` (`idPais`, `nombre`, `default`) VALUES
  (1,'Chile',1),
  (2,'Argentina',0),
  (3,'Peru',0),
  (4,'Brasil',0),
  (5,'Uruguay',0);
COMMIT;

/* Data for the `perfil` table  (LIMIT 0,500) */

INSERT INTO `perfil` (`idPerfil`, `nombre`, `orden`) VALUES
  (1,'Administrador de Sistema',1),
  (2,'Administrador de Proyectos',2);
COMMIT;

/* Data for the `perfilinvestigador` table  (LIMIT 0,500) */

INSERT INTO `perfilinvestigador` (`idPerfilInvestigador`, `nombre`) VALUES
  (1,'Estudiante'),
  (2,'Postgrado'),
  (3,'Doctor');
COMMIT;

/* Data for the `postulacion` table  (LIMIT 0,500) */

INSERT INTO `postulacion` (`idPostulacion`, `nombre`, `descripcion`, `codigoPostulacion`, `fechaPostulacion`, `idEstadoPostulacion`, `fechaEstado`, `idConcurso`, `fechaCreacion`, `idIniciativa`) VALUES
  (8,'primera postulacion','prueba','','',0,'',0,'2018-10-06 12:51:47',11),
  (9,'PRUEBA','test','aaaaaa','20181011',1,'20181208',0,'2018-10-12 00:00:54',22),
  (10,'nueva postulacion','nueva postulacion','1502545','20190110',0,'',0,'2019-01-28 20:55:45',22),
  (11,'test','test','4541520','20190109',0,'',0,'2019-01-28 20:57:04',23),
  (12,'test dos','test dos','152400','20190117',0,'20190128',0,'2019-01-28 21:09:38',23);
COMMIT;

/* Data for the `postulacion_equipotrabajo` table  (LIMIT 0,500) */

INSERT INTO `postulacion_equipotrabajo` (`idPostulacion`, `idInvestigador`, `idFuenteFinanciamiento`, `idPerfil`, `horas`, `porcentajeParticipacion`, `principal`) VALUES
  (20,225,8,0,0,0,0),
  (21,340,8,0,0,0,1),
  (22,221,8,0,0,0,1),
  (23,341,8,0,0,0,1),
  (24,342,8,0,0,0,1),
  (25,9,8,0,0,0,1),
  (26,341,8,0,0,0,1),
  (27,204,8,0,0,0,0),
  (28,343,8,0,0,0,1),
  (29,344,8,0,0,0,1),
  (30,345,8,0,0,0,1),
  (31,346,8,0,0,0,1),
  (32,291,8,0,0,0,1),
  (33,348,8,0,0,0,1),
  (34,325,8,0,0,0,1),
  (35,35,8,0,0,0,1),
  (36,225,8,0,0,0,1),
  (37,302,8,0,0,0,1),
  (39,351,8,0,0,0,1),
  (40,352,8,0,0,0,1),
  (41,16,8,0,0,0,1),
  (42,221,8,0,0,0,1),
  (43,353,8,0,0,0,0),
  (44,354,8,0,0,0,1),
  (45,142,8,0,0,0,1),
  (46,44,8,0,0,0,1),
  (47,221,8,0,0,0,1),
  (48,29,8,0,0,0,1),
  (49,341,8,0,0,0,1),
  (51,223,8,0,0,0,1),
  (52,359,8,0,0,0,1),
  (53,360,8,0,0,0,1),
  (54,119,8,0,0,0,1),
  (55,31,8,0,0,0,1),
  (56,361,8,0,0,0,1),
  (57,296,8,0,0,0,1),
  (58,225,8,0,0,0,1),
  (59,226,8,0,0,0,1),
  (60,362,8,0,0,0,1),
  (61,363,8,0,0,0,1),
  (62,339,8,0,0,0,1),
  (63,341,8,0,0,0,1),
  (64,199,8,0,0,0,0),
  (64,201,8,0,0,0,1),
  (65,199,8,0,0,0,1),
  (65,201,8,0,0,0,0),
  (66,201,8,0,0,0,0),
  (67,218,8,0,0,0,1),
  (68,201,8,0,0,0,0),
  (68,223,8,0,0,0,1),
  (69,199,8,0,0,0,1),
  (72,199,8,0,0,0,1),
  (74,199,8,0,0,0,0),
  (76,199,8,0,0,0,1),
  (78,362,8,0,0,0,1),
  (81,223,8,0,0,0,1),
  (81,225,8,0,0,0,0),
  (82,223,8,0,0,0,1),
  (82,225,8,0,0,0,0),
  (84,295,8,0,0,0,1),
  (85,223,8,0,0,0,0),
  (85,225,8,0,0,0,1),
  (86,223,8,0,0,0,0),
  (86,225,8,0,0,0,0),
  (87,295,8,0,0,0,1),
  (88,223,8,0,0,0,1),
  (89,199,8,0,0,0,1),
  (90,199,8,0,0,0,1),
  (91,222,8,0,0,0,1),
  (92,221,8,0,0,0,1),
  (93,223,8,0,0,0,0),
  (93,225,8,0,0,0,1),
  (94,223,8,0,0,0,0),
  (94,225,8,0,0,0,1),
  (95,223,8,0,0,0,0),
  (96,222,8,0,0,0,1),
  (98,329,8,0,0,0,1),
  (100,363,8,0,0,0,1);
COMMIT;

/* Data for the `postulacion_estadopostulacion` table  (LIMIT 0,500) */

INSERT INTO `postulacion_estadopostulacion` (`idPostulacion_EstadoPostulacion`, `idPostulacion`, `idEstadoPostulacion`, `fechaEstado`) VALUES
  (1,1,0,'20181017'),
  (2,9,1,'20181208'),
  (3,12,0,'20190128');
COMMIT;

/* Data for the `postulacion_notas` table  (LIMIT 0,500) */

INSERT INTO `postulacion_notas` (`idNota`, `idPostulacion`, `nota`, `fechahora`, `idUsuario`) VALUES
  (1,1,'test nota 1','2018-10-04 00:24:54',2),
  (2,9,'test','2018-10-12 00:11:25',2);
COMMIT;

/* Data for the `presupuestos` table  (LIMIT 0,500) */

INSERT INTO `presupuestos` (`idPresupuesto`, `idProyecto`, `fechaInicio`, `fechaTermino`) VALUES
  (1,1,'20180101','20180101');
COMMIT;

/* Data for the `presupuestos_detalles` table  (LIMIT 0,500) */

INSERT INTO `presupuestos_detalles` (`idPresupuestoDetalle`, `idPresupuesto`, `idCuenta`, `idSubcuenta`, `idFuenteFinanciamiento`, `detalle`, `monto`, `periodo`) VALUES
  (1,1,1,2,1,'DAVID DIAZ',150000,'201802');
COMMIT;

/* Data for the `prioridadtarea` table  (LIMIT 0,500) */

INSERT INTO `prioridadtarea` (`idPrioridadTarea`, `descripcion`) VALUES
  (1,'Baja'),
  (2,'Media'),
  (3,'Alta');
COMMIT;

/* Data for the `proteccion` table  (LIMIT 0,500) */

INSERT INTO `proteccion` (`idProteccion`, `idTecnologia`, `codigo`, `idTipoProteccion`, `titulo`, `numeroSolicitud`, `idOficinaRegistro`, `numeroPublicacion`, `numeroRegistro`, `idRepresentante`, `linkBaseDatos`, `fechaCreacion`, `idEstadoProteccion`, `fechaEstado`) VALUES
  (1,4,'a',3,'test','1',1,'2','3',2,'prueba','20190223',NULL,NULL),
  (2,4,'COD01',3,'Primera proteccion creada','1',1,'2','3',2,'prueba','20190223',2,'20190227'),
  (3,4,'test010',4,'prueba','102102',2,'1500000','8954120',1,'mi link','20190223',NULL,NULL),
  (4,4,'cod123',8,'test domingo','1010',12,'2020','32030',2,'link de prueba','20190223',NULL,NULL);
COMMIT;

/* Data for the `proteccion_estadoproteccion` table  (LIMIT 0,500) */

INSERT INTO `proteccion_estadoproteccion` (`idProteccion_EstadoProteccion`, `idProteccion`, `idEstadoProteccion`, `fechaEstado`) VALUES
  (32,2,1,'20190220'),
  (33,2,2,'20190227');
COMMIT;

/* Data for the `proteccion_notas` table  (LIMIT 0,500) */

INSERT INTO `proteccion_notas` (`idNota`, `idProteccion`, `nota`, `fechahora`, `idUsuario`) VALUES
  (25,2,'Test','2018-02-02 01:01:00',2);
COMMIT;

/* Data for the `proyecto` table  (LIMIT 0,500) */

INSERT INTO `proyecto` (`idProyecto`, `codigoProyecto`, `nombre`, `descripcion`, `idPostulacion`, `idTipoProyecto`, `idUsuarioEncargado`, `idUnidadNegocio`, `fechaInicio`, `fechaTermino`, `idEstadoProyecto`, `fechaEstado`, `totalProyecto`, `fechaCreacion`) VALUES
  (1,'100','MODERNIZACION SISTEMA DE REGISTRO DE PROYECTOS','proyecto numero unogfhfghfghfghfgh','0',2,2,2,'20180404','20180411',1,'20180517',NULL,'2018-08-27 11:35:54'),
  (2,'101','test','descripcion xcvcvdcvdfvdfvdf','0',2,3,2,'20180301','20180330',2,'20180401',NULL,'2018-08-27 11:35:54'),
  (3,'102','test','descripcion','0',1,1,1,'20180315','20180324',1,'20180427',NULL,'2018-08-27 11:35:54'),
  (4,'103','otrio','test','0',1,0,1,'20180316','20180314',2,'20180411',NULL,'2018-08-27 11:35:54'),
  (5,'105','prueba','oprobando','0',1,0,1,'20180328','20180331',1,NULL,NULL,'2018-08-27 11:35:54'),
  (6,'106','proyecto uno','prueba de proyectos','0',1,0,1,'20180314','20180331',1,NULL,NULL,'2018-08-27 11:35:54'),
  (7,'200','prueba dos','otto','0',1,0,1,'20180308','20180324',1,NULL,NULL,'2018-08-27 11:35:54'),
  (8,'110','Proyecto numero uno','proyecto numero uno','0',2,2,2,'20180405','20180426',5,'20180425',NULL,'2018-08-27 11:35:54'),
  (9,'111','Proyecto numero uno  ddddddd','proyecto numero uno','0',2,2,2,'//////','//////',1,'20180730',NULL,'2018-08-27 11:35:54'),
  (10,'TEST0010','PRUEBA','PRUEBA NUEVA','0',2,3,2,'20180701','20180701',5,'20181031',15200000,'2018-08-27 11:35:54'),
  (11,'15401','prueba','test','0',1,2,2,'20181003','20181031',2,'20181011',10500000,'2018-10-07 20:00:59'),
  (12,'482100','otra prueba','otra prueba','0',1,3,1,'20181003','20181018',0,NULL,25000000,'2018-10-07 20:05:30');
COMMIT;

/* Data for the `proyecto_areaprioritaria` table  (LIMIT 0,500) */

INSERT INTO `proyecto_areaprioritaria` (`idProyecto`, `idArea`) VALUES
  (10,2),
  (10,3);
COMMIT;

/* Data for the `proyecto_centro` table  (LIMIT 0,500) */

INSERT INTO `proyecto_centro` (`idProyecto`, `idCentro`) VALUES
  (10,2),
  (10,3);
COMMIT;

/* Data for the `proyecto_disciplinaconocimiento` table  (LIMIT 0,500) */

INSERT INTO `proyecto_disciplinaconocimiento` (`idProyecto`, `idDisciplinaConocimiento`) VALUES
  (2,1),
  (2,3),
  (3,2),
  (3,3),
  (3,1),
  (3,1),
  (10,2),
  (1,1),
  (1,2),
  (10,1),
  (10,3);
COMMIT;

/* Data for the `proyecto_equipotrabajo` table  (LIMIT 0,500) */

INSERT INTO `proyecto_equipotrabajo` (`idProyecto`, `idInvestigador`, `idFuenteFinanciamiento`, `idPerfil`, `horas`, `porcentajeParticipacion`, `principal`) VALUES
  (1,622,1,1,5,10,0),
  (1,1499,1,1,50,25,0),
  (1,2431,1,1,250,50,0),
  (3,626,1,1,4,3,1),
  (3,2011,1,1,70,10,0),
  (3,2122,2,2,600,50,0),
  (10,1728,1,1,250,50,0);
COMMIT;

/* Data for the `proyecto_estadoproyecto` table  (LIMIT 0,500) */

INSERT INTO `proyecto_estadoproyecto` (`idProyecto_EstadoProyecto`, `idProyecto`, `idEstadoProyecto`, `fechaEstado`) VALUES
  (23,10,2,'20180731'),
  (28,10,1,'20180710'),
  (29,10,4,'20180822'),
  (30,10,5,'20181031'),
  (31,11,2,'20181011');
COMMIT;

/* Data for the `proyecto_etapa` table  (LIMIT 0,500) */

INSERT INTO `proyecto_etapa` (`idProyectoEtapa`, `idProyecto`, `descripcion`, `fechaInicio`, `fechaTermino`) VALUES
  (2,1,'etapa 2','20180601','20180615'),
  (3,1,'etapa 1','20180509','20180531'),
  (5,10,'test','20180808','20180824'),
  (9,10,'prueba','20180801','20180820');
COMMIT;

/* Data for the `proyecto_fuentefinanciamiento` table  (LIMIT 0,500) */

INSERT INTO `proyecto_fuentefinanciamiento` (`idProyecto_FuenteFinanciamiento`, `idProyecto`, `idFuenteFinanciamiento`, `idNombreFinanciamiento`, `idEstadoFinanciamiento`, `fechaEstado`) VALUES
  (1,1,1,0,1,'20180101'),
  (2,1,2,0,1,'20180301');
COMMIT;

/* Data for the `proyecto_notas` table  (LIMIT 0,500) */

INSERT INTO `proyecto_notas` (`idNota`, `idProyecto`, `nota`, `fechahora`, `idUsuario`) VALUES
  (10,1,'prueba ultima de hoy','2018-05-03 00:14:05',2),
  (11,1,'prueba requerido','2018-05-05 14:02:16',2),
  (20,10,'prueba de nota','2018-07-31 19:37:24',2),
  (23,10,'nueva prueba de nota  cccc','2018-07-31 19:56:38',2),
  (24,10,'cambio de fecha ddd','2018-07-31 20:01:31',2);
COMMIT;

/* Data for the `proyecto_sectorimpacto` table  (LIMIT 0,500) */

INSERT INTO `proyecto_sectorimpacto` (`idProyecto`, `idSectorImpacto`) VALUES
  (3,1),
  (3,2),
  (3,6),
  (2,4),
  (2,6),
  (1,1),
  (1,3),
  (1,6),
  (1,4),
  (10,6),
  (10,3),
  (10,5);
COMMIT;

/* Data for the `representante` table  (LIMIT 0,500) */

INSERT INTO `representante` (`idRepresentante`, `rut`, `nombre`, `direccion`, `telefono`, `numeroResolucionConvenio`, `idPais`) VALUES
  (1,'78.773.320-4','Clarke, Modet & C°','Huerfanos 835, piso 10','56-2-24336830',NULL,1),
  (2,'78.169.860-1','Estudio Federico Villaseca y cía','Avenida Alonso de Córdova 5151, piso 8','56-2-23623500',NULL,1);
COMMIT;

/* Data for the `reservas` table  (LIMIT 0,500) */

INSERT INTO `reservas` (`idReserva`, `origen`, `idOrigen`, `descripcion`, `monto`, `fechaHora`, `idUsuario`, `idCuentaCorriente`) VALUES
  (1,2,1,'prueba',60000,'2018-07-27 12:50:35',2,2),
  (2,2,10,'pago proveedores insumos tecnicos',500000,'2018-07-27 12:57:13',2,1),
  (3,2,10,'cvbbvc',1000000,'2018-07-30 22:00:17',2,1),
  (4,2,12,'prueba select',120000,'2018-10-09 21:26:12',2,1),
  (5,2,3,'aaaaa',3444,'2018-10-18 18:16:35',NULL,1),
  (6,2,1,'qaqa',12500,'2018-10-18 18:17:41',NULL,1),
  (7,2,3,'aaaaabbbb',12222,'2018-10-18 18:20:48',NULL,1),
  (8,2,3,'aaaaabbbb',12222,'2018-10-18 18:24:35',NULL,1),
  (9,2,2,'assd',12222,'2018-10-18 18:25:13',NULL,1),
  (10,2,1,'aaaaaa',12222,'2018-10-18 18:31:32',NULL,1),
  (11,2,4,'aaaaaaprueba',1000000,'2018-10-18 18:32:16',NULL,1),
  (12,2,8,'sdfdfddf',780120,'2018-10-18 18:38:23',NULL,1),
  (13,2,6,'blabla',23201,'2018-10-18 19:12:12',2,1);
COMMIT;

/* Data for the `sectorimpacto` table  (LIMIT 0,500) */

INSERT INTO `sectorimpacto` (`idSectorImpacto`, `nombre`) VALUES
  (1,'Minería'),
  (2,'Agricultura'),
  (3,'Acuicultura'),
  (4,'Agropecuario'),
  (5,'Energía'),
  (6,'Manufactura');
COMMIT;

/* Data for the `subcuentaspresupuesto` table  (LIMIT 0,500) */

INSERT INTO `subcuentaspresupuesto` (`idSubcuenta`, `idCuenta`, `descripcion`) VALUES
  (1,1,'DIRECTOR'),
  (2,1,'DIRECTORES DE I + D'),
  (3,1,'AYUDAN, INVES. Y TESISTAS'),
  (4,1,'PROFESIONALES');
COMMIT;

/* Data for the `submenu` table  (LIMIT 0,500) */

INSERT INTO `submenu` (`idMenu`, `idSubMenu`, `etiqueta`, `href`, `orden`) VALUES
  (8,1,'Disciplinas de Conocimiento','listaDisciplinasconocimiento',1),
  (8,2,'Sectores de Impacto','listaSectoresdeimpacto',2),
  (8,3,'Areas Prioritarias','listaAreasPrioritarias',3),
  (8,4,'Centros','listaCentros',4),
  (8,5,'Unidades','listaUnidades',5),
  (8,6,'Estados Iniciativa','listaEstadosIniciativa',6),
  (8,7,'Estados Postulación','listaEstadosPostulacion',7),
  (8,8,'Estados Proyecto','listaEstadosProyecto',8),
  (8,9,'Estados Tecnología','listaEstadosTecnologia',9),
  (8,10,'Tipos de Proyecto','listaTiposdeProyecto',10),
  (8,11,'Fuentes de Financiamiento','#',11),
  (8,12,'Perfiles Investigador','listaPerfilesInvestigador',12),
  (8,13,'Investigadores','#',13),
  (8,14,'Cuentas Corrientes','#',14),
  (8,15,'Perfiles Usuario','listaPerfilesUsuario',15),
  (8,16,'Usuarios','#',16);
COMMIT;

/* Data for the `tarea` table  (LIMIT 0,500) */

INSERT INTO `tarea` (`idTarea`, `descripcion`, `fecha`, `hora`, `prioridad`, `estado`, `origen`, `idOrigen`, `alarma_fecha`, `alarma_hora`, `idUsuario`) VALUES
  (4,'solicitar información a investigador principal','20180518','15:30',1,1,1,1,'','',0),
  (10,'test 3','20181010','12:00',1,1,3,1,'20181009','15:00',0),
  (11,'test 1','20181010','9:00',3,1,3,1,'20181009','10:00',0),
  (12,'prueba','20181003','9:00',2,1,1,10,'20181024','10:00',0),
  (13,'prueba 2','20180927','23:15',2,1,1,10,'20181025','0:45',0),
  (14,'sddsdsds','20181009','9:00',2,1,1,12,'20181016','10:00',0),
  (15,'sdfsdfsf','20181003','1:30',1,1,1,10,NULL,NULL,0),
  (17,'test 1','20181003','9:00',1,1,1,22,'20181015','16:00',0),
  (18,'nueva tarea','20181001','10:00',3,1,1,22,NULL,NULL,0),
  (19,'prueba tarea','20181001','19:00',3,1,1,22,NULL,NULL,0),
  (20,'test','20181003','24:00',2,1,1,10,'20181009','10:00',0),
  (22,'prueba','20181003','10:30',3,1,3,9,'20181023','15:00',0),
  (23,'sssss','20181204','9:00',1,1,4,4,'20181009','10:00',0),
  (24,'test 1','20181129','9:00',3,1,4,4,'20190101','15:00',0),
  (25,'test','20181205','17:00',1,1,1,23,'20181213','17:00',0),
  (26,'tareas iniciativa','20181207','17:45',1,1,2,23,'20181207','9:00',2),
  (27,'test contrato','20190207','15:30',1,1,6,14,'20190217','12:30',2),
  (29,'tarea proyecto id 10','20190129','19:00',1,1,1,10,'20190228','19:00',2),
  (30,'postulacion id 11','20190209','19:00',1,1,3,11,'20190307','19:00',2),
  (31,'tarea id 23','20190204','19:00',1,1,2,23,'20190213','19:00',2),
  (32,'tarea tecnologia id 4','20190201','19:00',1,1,4,4,'20190228','19:00',2),
  (33,'prueba tarea proteccion','20190129','23:30',3,1,6,2,'20190228','23:30',2);
COMMIT;

/* Data for the `tecnologia` table  (LIMIT 0,500) */

INSERT INTO `tecnologia` (`idTecnologia`, `codigo`, `nombre`, `descripcion`, `idUsuarioEncargado`, `idUnidad`, `idEstadoTecnologia`, `fechaEstado`, `fechaCreacion`) VALUES
  (1,'','aaaa','bbbb',2,0,0,'','2018-12-05 22:32:41'),
  (2,'','bbbbb','bb',3,0,0,'','2018-12-05 22:32:41'),
  (3,'','ccccc','cc',2,0,0,'','2018-12-05 22:32:41'),
  (4,'','dddddd','ddd',1,0,3,'20190227','2018-12-05 22:32:41');
COMMIT;

/* Data for the `tecnologia_areaprioritaria` table  (LIMIT 0,500) */

INSERT INTO `tecnologia_areaprioritaria` (`idTecnologia`, `idArea`) VALUES
  (4,3);
COMMIT;

/* Data for the `tecnologia_centro` table  (LIMIT 0,500) */

INSERT INTO `tecnologia_centro` (`idTecnologia`, `idCentro`) VALUES
  (4,2),
  (4,3);
COMMIT;

/* Data for the `tecnologia_disciplinaconocimiento` table  (LIMIT 0,500) */

INSERT INTO `tecnologia_disciplinaconocimiento` (`idTecnologia`, `idDisciplinaConocimiento`) VALUES
  (4,1);
COMMIT;

/* Data for the `tecnologia_equipotrabajo` table  (LIMIT 0,500) */

INSERT INTO `tecnologia_equipotrabajo` (`idTecnologia`, `idInvestigador`, `idFuenteFinanciamiento`, `idPerfil`, `horas`, `porcentajeParticipacion`, `principal`) VALUES
  (4,1387,1,1,800,100,1);
COMMIT;

/* Data for the `tecnologia_estadotecnologia` table  (LIMIT 0,500) */

INSERT INTO `tecnologia_estadotecnologia` (`idTecnologia_EstadoTecnologia`, `idTecnologia`, `idEstadoTecnologia`, `fechaEstado`) VALUES
  (4,4,1,'20181227'),
  (5,4,1,'20190206'),
  (6,4,3,'20190227');
COMMIT;

/* Data for the `tecnologia_notas` table  (LIMIT 0,500) */

INSERT INTO `tecnologia_notas` (`idNota`, `idTecnologia`, `nota`, `fechahora`, `idUsuario`) VALUES
  (1,4,'test2','2018-12-05 17:30:41',2);
COMMIT;

/* Data for the `tecnologia_sectorimpacto` table  (LIMIT 0,500) */

INSERT INTO `tecnologia_sectorimpacto` (`idTecnologia`, `idSectorImpacto`) VALUES
  (4,1),
  (4,4);
COMMIT;

/* Data for the `tipocontrato` table  (LIMIT 0,500) */

INSERT INTO `tipocontrato` (`idTipoContrato`, `nombre`) VALUES
  (1,'Tipo contrato 1'),
  (2,'Tipo contrato 2'),
  (3,'Tipo contrato 3');
COMMIT;

/* Data for the `tipoiniciativa` table  (LIMIT 0,500) */

INSERT INTO `tipoiniciativa` (`idTipoIniciativa`, `nombre`) VALUES
  (3,'tipo iniciativa 1'),
  (4,'tipo iniciativa 2');
COMMIT;

/* Data for the `tipoorigen` table  (LIMIT 0,500) */

INSERT INTO `tipoorigen` (`origen`, `nombre`) VALUES
  (1,'Proyecto'),
  (2,'Iniciativa'),
  (3,'Postulacion'),
  (4,'Tecnologia'),
  (5,'Contrato'),
  (6,'Proteccion');
COMMIT;

/* Data for the `tipoproteccion` table  (LIMIT 0,500) */

INSERT INTO `tipoproteccion` (`idTipoProteccion`, `nombre`) VALUES
  (1,'Patente de Invención'),
  (2,'Marca'),
  (3,'Modelo de Utilidad'),
  (4,'Secreto Industrial'),
  (5,'Dibujo Industrial'),
  (6,'Diseño Industrial'),
  (7,'Esquemas de Trazado'),
  (8,'Marcas Comerciales'),
  (9,'Indicaciones Geográficas'),
  (10,'Denominaciones de Origen');
COMMIT;

/* Data for the `tipoproyecto` table  (LIMIT 0,500) */

INSERT INTO `tipoproyecto` (`idTipoProyecto`, `nombre`) VALUES
  (1,'Proyecto de Ingeniería'),
  (2,'Proyecto Social'),
  (5,'prueba'),
  (6,'prueba 2');
COMMIT;

/* Data for the `unidad` table  (LIMIT 0,500) */

INSERT INTO `unidad` (`idUnidad`, `nombre`) VALUES
  (1,'Unidad Proyectos Ambientales'),
  (2,'Unidad Proyectos Cientificos');
COMMIT;

/* Data for the `users` table  (LIMIT 0,500) */

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
  (1,'david','ddiaz@gmail.com','123','123',NULL,NULL);
COMMIT;

/* Data for the `usuario` table  (LIMIT 0,500) */

INSERT INTO `usuario` (`idUsuario`, `correo`, `nombreCompleto`, `password`, `activo`, `administradorSistema`) VALUES
  (1,'morgado@gmail.com','Rodrigo Morgado','123',1,0),
  (2,'test@gmail.com','test','123',1,1),
  (3,'ediaz@gmail.com','Eric Diaz','123',1,0);
COMMIT;

/* Data for the `usuario_menu` table  (LIMIT 0,500) */

INSERT INTO `usuario_menu` (`idUsuario`, `idMenu`) VALUES
  (1,1),
  (1,2),
  (1,3);
COMMIT;

/* Data for the `usuarios_perfil` table  (LIMIT 0,500) */

INSERT INTO `usuarios_perfil` (`idUsuario`, `idPerfil`) VALUES
  (1,2),
  (2,1),
  (2,2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;