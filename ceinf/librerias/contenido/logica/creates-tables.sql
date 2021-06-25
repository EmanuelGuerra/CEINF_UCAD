CREATE TABLE `credenciales` (
  `credencialId` BIGINT NOT NULL AUTO_INCREMENT,
  `carnet` VARCHAR(15) NULL DEFAULT NULL COMMENT 'usuario/login',
  `nombre1` VARCHAR(30) NULL DEFAULT NULL,
  `nombre2` VARCHAR(30) NULL DEFAULT NULL,
  `nombre3` VARCHAR(30) NULL DEFAULT NULL,
  `apellido1` VARCHAR(30) NULL DEFAULT NULL COMMENT 'paterno',
  `apellido2` VARCHAR(30) NULL DEFAULT NULL COMMENT 'materno',
  `apellido3` VARCHAR(30) NULL DEFAULT NULL COMMENT 'casada',
  `fechaNacimiento` DATE NULL DEFAULT NULL,
  `rolId` BIGINT NULL DEFAULT NULL COMMENT 'roles',
  `passw` VARCHAR(100) NULL DEFAULT NULL,
  `numLogin` INT DEFAULT 0,
  `fhUltimoLogin` DATETIME NULL DEFAULT NULL,
  `intentosLogin` INT DEFAULT 0,
  `enLinea` INT(1) DEFAULT 0,
  `estadoCredencial` VARCHAR(25) NULL DEFAULT NULL COMMENT 'activo, inactivo, ...',
  PRIMARY KEY (`credencialId`));

CREATE TABLE `bit_intentos_login` (
  `intentoLoginId` BIGINT NOT NULL AUTO_INCREMENT,
  `remoteIp` VARCHAR(50) NULL DEFAULT NULL,
  `forwardIp` VARCHAR(50) NULL DEFAULT NULL,
  `carnet` VARCHAR(100) NULL DEFAULT NULL,
  `fhIntento` DATETIME NULL DEFAULT NULL,
  `navegador` VARCHAR(100) NULL DEFAULT NULL,
PRIMARY KEY (`intentoLoginId`));

CREATE TABLE `bit_credenciales` (
  `bitCredencialId` BIGINT NOT NULL AUTO_INCREMENT,
  `credencialId` BIGINT NULL COMMENT 'credenciales',
  `fhLogin` DATETIME NULL DEFAULT NULL,
  `fhLogout` DATETIME NULL DEFAULT NULL,
  `movimientos` LONGTEXT NULL DEFAULT NULL,
  `remoteIp` VARCHAR(50) NULL DEFAULT NULL,
  `forwardIp` VARCHAR(50) NULL DEFAULT NULL,
  `navegador` VARCHAR(100) NULL DEFAULT NULL,
PRIMARY KEY (`bitCredencialId`));

CREATE TABLE `roles` (
  `rolId` BIGINT NOT NULL AUTO_INCREMENT,
  `rol` VARCHAR(100) NULL DEFAULT NULL,
PRIMARY KEY (`rolId`));

ALTER TABLE `credenciales`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 

  ALTER TABLE `roles`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 




















  CREATE TABLE `marcas` (
  `marcaId` BIGINT NOT NULL AUTO_INCREMENT,
  `parteEquipoId` BIGINT NULL DEFAULT NULL,
  `nombreMarca` VARCHAR(200) NULL DEFAULT NULL,
PRIMARY KEY (`marcaId`)); 
 
 ALTER TABLE `marcas`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `marcas` 
ENGINE = InnoDB ;

  CREATE TABLE `tipos_equipos_af` (
  `tipoEquipoAFId` BIGINT NOT NULL AUTO_INCREMENT,
  `nombreTipoEquipo` VARCHAR(200) NULL DEFAULT NULL,
PRIMARY KEY (`tipoEquipoAFId`)); 
 
 ALTER TABLE `tipos_equipos_af`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `tipos_equipos_af` 
ENGINE = InnoDB ;

  CREATE TABLE `tipos_procesador` (
  `tipoProcesadorId` BIGINT NOT NULL AUTO_INCREMENT,
  `modeloId` BIGINT NULL DEFAULT NULL,
  `nombreTipoProcesador` VARCHAR(200) NULL DEFAULT NULL,
  `velocidad` VARCHAR(100) NULL DEFAULT NULL,
PRIMARY KEY (`tipoProcesadorId`)); 
 
 ALTER TABLE `tipos_procesador`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `tipos_procesador` 
ENGINE = InnoDB ;

  CREATE TABLE `tipos_accesorios_integrados` (
  `tipoAccesorioIntegradoId` BIGINT NOT NULL AUTO_INCREMENT,
  `nombreTipoProcesador` VARCHAR(200) NULL DEFAULT NULL,
PRIMARY KEY (`tipoAccesorioIntegradoId`)); 
 
 ALTER TABLE `tipos_accesorios_integrados`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `tipos_accesorios_integrados` 
ENGINE = InnoDB ;

  CREATE TABLE `parlantes` (
  `parlanteId` BIGINT NOT NULL AUTO_INCREMENT,
  `modeloId` BIGINT NULL DEFAULT NULL,
  `serie` VARCHAR(100) NULL DEFAULT NULL,
  `capacidadWatts` VARCHAR(100) NULL DEFAULT NULL,
PRIMARY KEY (`parlanteId`)); 
 
 ALTER TABLE `parlantes`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `parlantes` 
ENGINE = InnoDB ;

  CREATE TABLE `ups` (
  `upsId` BIGINT NOT NULL AUTO_INCREMENT,
  `areaFisicaId` BIGINT NULL DEFAULT NULL,
  `modeloId` BIGINT NULL DEFAULT NULL,
  `capacidadUps` VARCHAR(100) NULL DEFAULT NULL,
  `cantidadTomasProtegidos` INT NULL DEFAULT NULL,
  `tiempoCargaEstimada` VARCHAR(100) NULL DEFAULT NULL,
  `cantidadTomasUps` INT NULL DEFAULT NULL,
PRIMARY KEY (`upsId`)); 
 
 ALTER TABLE `ups`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `ups` 
ENGINE = InnoDB ;

  CREATE TABLE `bajas_equipo` (
  `bajaEquipoId` BIGINT NOT NULL AUTO_INCREMENT,
  `areaFisicaId` BIGINT NULL DEFAULT NULL,
  `fhBaja` DATETIME NULL DEFAULT NULL,
  `descripcionBien` LONGTEXT NULL DEFAULT NULL,
  `observaciones` LONGTEXT NULL DEFAULT NULL,
PRIMARY KEY (`bajaEquipoId`)); 
 
 ALTER TABLE `bajas_equipo`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `bajas_equipo` 
ENGINE = InnoDB ;

  CREATE TABLE `bit_mantenimientos` (
  `bitMantenimientoId` BIGINT NOT NULL AUTO_INCREMENT,
  `areaFisicaId` BIGINT NULL DEFAULT NULL,
  `tecnicoMantenimientoId` BIGINT NULL DEFAULT NULL,
  `fhMantenimiento` DATETIME NULL DEFAULT NULL,
PRIMARY KEY (`bitMantenimientoId`)); 
 
 ALTER TABLE `bit_mantenimientos`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `bit_mantenimientos` 
ENGINE = InnoDB ;

  CREATE TABLE `bit_mantenimientos_detalle` (
  `bitMantenimientoDetalleId` BIGINT NOT NULL AUTO_INCREMENT,
  `bitMantenimientoId` BIGINT NULL DEFAULT NULL,
  `parteEquipoId` BIGINT NULL DEFAULT NULL,
  `id` BIGINT NULL DEFAULT NULL,
  `trabajoRealizado` LONGTEXT NULL DEFAULT NULL,
PRIMARY KEY (`bitMantenimientoDetalleId`)); 
 
 ALTER TABLE `bit_mantenimientos_detalle`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `bit_mantenimientos_detalle` 
ENGINE = InnoDB ;

  CREATE TABLE `tecnicos_mantenimiento` (
  `tecnicoMantenimientoId` BIGINT NOT NULL AUTO_INCREMENT,
  `nombreTecnico` VARCHAR(200) NULL DEFAULT NULL,
PRIMARY KEY (`tecnicoMantenimientoId`)); 
 
 ALTER TABLE `tecnicos_mantenimiento`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `tecnicos_mantenimiento` 
ENGINE = InnoDB ;

  CREATE TABLE `entrega_equipos` (
  `entregaEquipoId` BIGINT NOT NULL AUTO_INCREMENT,
  `areaFisicaId` BIGINT NULL DEFAULT NULL,
  `fhEntrega` DATETIME NULL DEFAULT NULL,
  `descripcionBien` LONGTEXT NULL DEFAULT NULL,
  `observaciones` LONGTEXT NULL DEFAULT NULL,
PRIMARY KEY (`entregaEquipoId`)); 
 
 ALTER TABLE `entrega_equipos`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `entrega_equipos` 
ENGINE = InnoDB ;

  CREATE TABLE `evaluacion_tecnica` (
  `evaluacionTecnicaId` BIGINT NOT NULL AUTO_INCREMENT,
  `areaFisicaId` BIGINT NULL DEFAULT NULL,
  `parteEquipoId` BIGINT NULL DEFAULT NULL,
  `id` BIGINT NULL DEFAULT NULL,
  `tecnicoMantenimientoId` BIGINT NULL DEFAULT NULL,
  `evaluacionRealizada` LONGTEXT NULL DEFAULT NULL,
  `recomendacion` LONGTEXT NULL DEFAULT NULL,
PRIMARY KEY (`evaluacionTecnicaId`)); 
 
 ALTER TABLE `evaluacion_tecnica`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `evaluacion_tecnica` 
ENGINE = InnoDB ;


























  CREATE TABLE `area_fisica` (
  `areaFisicaId` BIGINT NOT NULL AUTO_INCREMENT,
  `noInventario` VARCHAR(100) NULL DEFAULT NULL,
  `unidadMilitarId` BIGINT NULL DEFAULT NULL,
  `subdependenciaId` BIGINT NULL DEFAULT NULL,
  `encargadoId` BIGINT NULL DEFAULT NULL,
  `modeloId` BIGINT NULL DEFAULT NULL,
  `tipoEquipoAFId` BIGINT NULL DEFAULT NULL,
  `serie` VARCHAR(100) NULL DEFAULT NULL,
  `estadoAF` VARCHAR(25) NULL DEFAULT NULL,
PRIMARY KEY (`areaFisicaId`)); 
 
 ALTER TABLE `area_fisica`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `area_fisica` 
ENGINE = InnoDB ;

  CREATE TABLE `tarjeta_madre` (
  `tarjetaMadreId` BIGINT NOT NULL AUTO_INCREMENT,
  `areaFisicaId` BIGINT NULL DEFAULT NULL,
  `modeloId` BIGINT NULL DEFAULT NULL,
  `capacidad` VARCHAR(50) NULL DEFAULT NULL,
  `puertosMemoriaRam` INT NULL DEFAULT NULL,
PRIMARY KEY (`tarjetaMadreId`)); 
 
 ALTER TABLE `tarjeta_madre`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `tarjeta_madre` 
ENGINE = InnoDB ;

  CREATE TABLE `procesador` (
  `procesadorId` BIGINT NOT NULL AUTO_INCREMENT,
  `tarjetaMadreId` BIGINT NULL DEFAULT NULL,
  `tipoProcesadorId` BIGINT NULL DEFAULT NULL,
PRIMARY KEY (`procesadorId`)); 
 
 ALTER TABLE `procesador`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `procesador` 
ENGINE = InnoDB ;

  CREATE TABLE `memoria_ram` (
  `memoriaRamId` BIGINT NOT NULL AUTO_INCREMENT,
  `tarjetaMadreId` BIGINT NULL DEFAULT NULL,
  `tipoMemoriaRam` VARCHAR(200) NULL DEFAULT NULL,
  `totalMemoria` VARCHAR(100) NULL DEFAULT NULL,
  `velocidadTransferencia` VARCHAR(100) NULL DEFAULT NULL,
PRIMARY KEY (`memoriaRamId`)); 
 
 ALTER TABLE `memoria_ram`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `memoria_ram` 
ENGINE = InnoDB ;

  CREATE TABLE `accesorios_integrados` (
  `accesorioIntegradoId` BIGINT NOT NULL AUTO_INCREMENT,
  `tarjetaMadreId` BIGINT NULL DEFAULT NULL,
  `tiposAccesoriosIntegrados` LONGTEXT NULL DEFAULT NULL,
PRIMARY KEY (`accesorioIntegradoId`)); 
 
 ALTER TABLE `accesorios_integrados`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `accesorios_integrados` 
ENGINE = InnoDB ;

  CREATE TABLE `discos_duros` (
  `discoDuroId` BIGINT NOT NULL AUTO_INCREMENT,
  `tarjetaMadreId` BIGINT NULL DEFAULT NULL,
  `tipoDiscoDuro` VARCHAR(100) NULL DEFAULT NULL,
  `modeloId` BIGINT NULL DEFAULT NULL,
  `serie` VARCHAR(100) NULL DEFAULT NULL,
  `capacidadAlmacenaje` VARCHAR(100) NULL DEFAULT NULL,
PRIMARY KEY (`discoDuroId`)); 
 
 ALTER TABLE `discos_duros`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `discos_duros` 
ENGINE = InnoDB ;

  CREATE TABLE `multimedia` (
  `multimediaId` BIGINT NOT NULL AUTO_INCREMENT,
  `areaFisicaId` BIGINT NULL DEFAULT NULL,
  `tipoMultimedia` VARCHAR(100) NULL DEFAULT NULL,
  `modeloId` BIGINT NULL DEFAULT NULL,
  `serie` VARCHAR(100) NULL DEFAULT NULL,
  `velocidadReproduccion` VARCHAR(100) NULL DEFAULT NULL,
PRIMARY KEY (`multimediaId`)); 
 
 ALTER TABLE `multimedia`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `multimedia` 
ENGINE = InnoDB ;

  CREATE TABLE `almacenamiento_flexible` (
  `almacenamientoFlexibleId` BIGINT NOT NULL AUTO_INCREMENT,
  `areaFisicaId` BIGINT NULL DEFAULT NULL,
  `modeloId` BIGINT NULL DEFAULT NULL,
  `tipoDisquetera` VARCHAR(100) NULL DEFAULT NULL,
  `serie` VARCHAR(100) NULL DEFAULT NULL,
  `velocidadDisquetera` VARCHAR(100) NULL DEFAULT NULL,
PRIMARY KEY (`almacenamientoFlexibleId`)); 
 
 ALTER TABLE `almacenamiento_flexible`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `almacenamiento_flexible` 
ENGINE = InnoDB ;

  CREATE TABLE `monitores` (
  `monitorId` BIGINT NOT NULL AUTO_INCREMENT,
  `areaFisicaId` BIGINT NULL DEFAULT NULL,
  `modeloId` BIGINT NULL DEFAULT NULL,
  `tipoMonitor` VARCHAR(100) NULL DEFAULT NULL,
  `tipoPantalla` VARCHAR(100) NULL DEFAULT NULL,
  `serie` VARCHAR(100) NULL DEFAULT NULL,
  `resolucion` VARCHAR(100) NULL DEFAULT NULL,
PRIMARY KEY (`monitorId`)); 
 
 ALTER TABLE `monitores`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `monitores` 
ENGINE = InnoDB ;

  CREATE TABLE `teclados` (
  `tecladoId` BIGINT NOT NULL AUTO_INCREMENT,
  `areaFisicaId` BIGINT NULL DEFAULT NULL,
  `modeloId` BIGINT NULL DEFAULT NULL,
  `tipoTeclado` VARCHAR(100) NULL DEFAULT NULL,
  `serie` VARCHAR(100) NULL DEFAULT NULL,
  `cantidadTeclas` INT NULL DEFAULT NULL,
PRIMARY KEY (`tecladoId`)); 
 
 ALTER TABLE `teclados`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `teclados` 
ENGINE = InnoDB ;

  CREATE TABLE `mouse` (
  `mouseId` BIGINT NOT NULL AUTO_INCREMENT,
  `areaFisicaId` BIGINT NULL DEFAULT NULL,
  `modeloId` BIGINT NULL DEFAULT NULL,
  `tipoMouse` VARCHAR(100) NULL DEFAULT NULL,
  `serie` VARCHAR(100) NULL DEFAULT NULL,
  `poseeScroll` INT(1) NULL DEFAULT NULL,
  `cantidadBotones` INT NULL DEFAULT NULL,
PRIMARY KEY (`mouseId`)); 
 
 ALTER TABLE `mouse`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `mouse` 
ENGINE = InnoDB ;

  CREATE TABLE `impresoras` (
  `impresoraId` BIGINT NOT NULL AUTO_INCREMENT,
  `modeloId` BIGINT NULL DEFAULT NULL,
  `tipoImpresora` VARCHAR(100) NULL DEFAULT NULL,
  `tipoCartucho` VARCHAR(100) NULL DEFAULT NULL,
  `cantidadCartuchos` VARCHAR(100) NULL DEFAULT NULL,
  `serie` VARCHAR(100) NULL DEFAULT NULL,
PRIMARY KEY (`impresoraId`)); 
 
 ALTER TABLE `impresoras`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `impresoras` 
ENGINE = InnoDB ;

  CREATE TABLE `software` (
  `softwareId` BIGINT NOT NULL AUTO_INCREMENT,
  `areaFisicaId` BIGINT NULL DEFAULT NULL,
  `tipoSoftware` VARCHAR(100) NULL DEFAULT NULL,
  `arquitectura` VARCHAR(100) NULL DEFAULT NULL,
  `version` VARCHAR(50) NULL DEFAULT NULL,
  `cantidad` INT NULL DEFAULT NULL,
  `noLicencia` VARCHAR(100) NULL DEFAULT NULL,
PRIMARY KEY (`softwareId`)); 
 
 ALTER TABLE `software`
  ADD COLUMN `agregadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhAgregado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `editadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEditado` DATETIME NULL DEFAULT NULL,
  ADD COLUMN `flgEliminado` INT(1) DEFAULT 0,
  ADD COLUMN `eliminadoPor` VARCHAR(25) NULL DEFAULT NULL,
  ADD COLUMN `fhEliminado` DATETIME NULL DEFAULT NULL; 
  
ALTER TABLE `software` 
ENGINE = InnoDB ;