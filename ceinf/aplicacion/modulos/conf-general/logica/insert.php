<?php 
	require_once '../../../../librerias/contenido/logica/conexion.php';
	@session_start();

	$fhActual = date("Y-m-d H:i:s");
	$case = (isset($_REQUEST["case"])) ? $_REQUEST["case"] : "n/a";

	switch($case) {
		case "aprobar-solicitud-acceso":
			/*
				POST:
				solicitudAccesoId
				nombre1
				nombre2
				apellido1
				apellido2
				fechaNacimiento
				cargoId
				carnet
				rolId
				dependenciaId
				subdependenciaId
			 */
			// Verificar que el carnet no exista
			$queryExisteCarnet = $bd->query("
				SELECT COUNT(credencialId) AS existeCarnet FROM credenciales
				WHERE carnet = '$_POST[carnet]'
			");
			$getExisteCarnet = $queryExisteCarnet->fetch_assoc();

			if($getExisteCarnet["existeCarnet"] == 0) {
				// Update a la solicitud - Autorizar
				$queryAutorizarSolicitud = $bd->query("
					UPDATE solicitudes_acceso SET
						estadoSolicitud = 'Autorizada',
						editadoPor = '$_SESSION[carnet]',
						fhEditado = '$fhActual'
					WHERE solicitudAccesoId = '$_POST[solicitudAccesoId]'
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));

				// Crear credenciales
				// Encriptar contraseña por defecto
				$nuevaPassword = password_hash("ceinf" . date("Y") . "$", PASSWORD_DEFAULT);

				$queryCrearCredenciales = $bd->query("
					INSERT INTO credenciales (carnet, nombre1, nombre2, apellido1, apellido2, fechaNacimiento, cargoId, subdependenciaId, rolId, passw, estadoCredencial, agregadoPor, fhAgregado) 
					VALUES ('$_POST[carnet]', '$_POST[nombre1]', '$_POST[nombre2]', '$_POST[apellido1]', '$_POST[apellido2]', '$_POST[fechaNacimiento]', '$_POST[cargoId]', '$_POST[subdependenciaId]', '$_POST[rolId]', '$nuevaPassword', 'Activo', '$_SESSION[carnet]', '$fhActual')
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));

				// Escribir en bitacora
				$bitacora = "(".$fhActual.") Autorizó la solicitud de acceso de: ".$_POST["apellido1"].", " . $_POST["nombre1"] . ",";
				$updateBitacora = $bd->query("
					UPDATE bit_credenciales SET
						movimientos = CONCAT(movimientos, '$bitacora')
					WHERE bitCredencialId = '$_SESSION[bitCredencialId]'
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				echo "completado";
			} else {
				echo "El carnet ingresado ya cuenta con credenciales. Por favor verificar desde Gestión de Usuarios - Usuarios.";
			}
		break;

		case "nuevo-usuario":
			/*
				POST:
				nombre1: Ezequiel
				nombre2: 
				apellido1: Rodriguez
				apellido2: 
				fechaNacimiento: 2021-05-24
				cargoId: 1
				carnet: EG1234
				rolId: 1
				dependenciaId: 1
				subdependenciaId: 2
			*/
			// Verificar que el carnet no exista
			$queryExisteCarnet = $bd->query("
				SELECT COUNT(credencialId) AS existeCarnet FROM credenciales
				WHERE carnet = '$_POST[carnet]'
			");
			$getExisteCarnet = $queryExisteCarnet->fetch_assoc();

			if($getExisteCarnet["existeCarnet"] == 0) {
				// Crear credenciales
				// Encriptar contraseña por defecto
				$nuevaPassword = password_hash("ceinf" . date("Y") . "$", PASSWORD_DEFAULT);

				$queryCrearCredenciales = $bd->query("
					INSERT INTO credenciales (carnet, nombre1, nombre2, apellido1, apellido2, fechaNacimiento, cargoId, subdependenciaId, rolId, passw, estadoCredencial, agregadoPor, fhAgregado) 
					VALUES ('$_POST[carnet]', '$_POST[nombre1]', '$_POST[nombre2]', '$_POST[apellido1]', '$_POST[apellido2]', '$_POST[fechaNacimiento]', '$_POST[cargoId]', '$_POST[subdependenciaId]', '$_POST[rolId]', '$nuevaPassword', 'Activo', '$_SESSION[carnet]', '$fhActual')
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				// Escribir en bitacora
				$bitacora = "(".$fhActual.") Registró un nuevo usuario: ".$_POST["apellido1"].", " . $_POST["nombre1"] . ",";
				$updateBitacora = $bd->query("
					UPDATE bit_credenciales SET
						movimientos = CONCAT(movimientos, '$bitacora')
					WHERE bitCredencialId = '$_SESSION[bitCredencialId]'
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				echo "completado";
			} else {
				echo "El carnet ingresado ya cuenta con credenciales.";
			}
		break;

		case "nueva-unidad-militar":
			/*
				POST:
				nombreUnidadMilitar
				abreviatura
			*/
			$sqlExisteUnidadMilitar = $bd->query("
				SELECT
					COUNT(unidadMilitarId) AS existeUnidad
				FROM unidades_militares
				WHERE abreviatura = '$_POST[abreviatura]' AND flgEliminado = '0' 
			");
			$getExisteUnidadMilitar = $sqlExisteUnidadMilitar->fetch_assoc();

			if($getExisteUnidadMilitar["existeUnidad"] == 0) {
				$queryCrearUnidad = $bd->query("
					INSERT INTO unidades_militares (abreviatura, nombreUnidadMilitar, agregadoPor, fhAgregado) 
					VALUES ('$_POST[abreviatura]', '$_POST[nombreUnidadMilitar]', '$_SESSION[carnet]', '$fhActual')
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				// Escribir en bitacora
				$bitacora = "(".$fhActual.") Registró una nueva unidad militar: (".$_POST["abreviatura"].") " . $_POST["nombreUnidadMilitar"] . ",";
				$updateBitacora = $bd->query("
					UPDATE bit_credenciales SET
						movimientos = CONCAT(movimientos, '$bitacora')
					WHERE bitCredencialId = '$_SESSION[bitCredencialId]'
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				echo "completado";
			} else {
				echo "La Unidad Militar " . $_POST["abreviatura"] . " ya ha sido creada.";
			}
		break;

		case "nueva-dependencia":
			/*
				POST:
				unidadMilitarId
				nombreDependencia
				abreviatura
			*/
			$sqlExisteDependencia = $bd->query("
				SELECT
					COUNT(dependenciaId) AS existeUnidad
				FROM dependencias
				WHERE abreviatura = '$_POST[abreviatura]' AND flgEliminado = '0' 
			");
			$getExisteDependencia = $sqlExisteDependencia->fetch_assoc();

			if($getExisteDependencia["existeUnidad"] == 0) {
				$queryCrearDependencia = $bd->query("
					INSERT INTO dependencias (unidadMilitarId, abreviatura, nombreDependencia, agregadoPor, fhAgregado) 
					VALUES ('$_POST[unidadMilitarId]', '$_POST[abreviatura]', '$_POST[nombreDependencia]', '$_SESSION[carnet]', '$fhActual')
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				// Escribir en bitacora
				$bitacora = "(".$fhActual.") Registró una nueva dependencia: (".$_POST["abreviatura"].") " . $_POST["nombreDependencia"] . ",";
				$updateBitacora = $bd->query("
					UPDATE bit_credenciales SET
						movimientos = CONCAT(movimientos, '$bitacora')
					WHERE bitCredencialId = '$_SESSION[bitCredencialId]'
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				echo "completado";
			} else {
				echo "La Dependencia " . $_POST["abreviatura"] . " ya ha sido creada.";
			}
		break;

		case "nueva-subdependencia":
			/*
				POST:
				dependenciaId
				nombreSubdependencia
				abreviatura
			*/
			$sqlExisteDependencia = $bd->query("
				SELECT
					COUNT(subdependenciaId) AS existeUnidad
				FROM subdependencias
				WHERE abreviatura = '$_POST[abreviatura]' AND flgEliminado = '0' 
			");
			$getExisteDependencia = $sqlExisteDependencia->fetch_assoc();

			if($getExisteDependencia["existeUnidad"] == 0) {
				$queryCrearSubdependencia = $bd->query("
					INSERT INTO subdependencias (dependenciaId, abreviatura, nombreSubdependencia, agregadoPor, fhAgregado) 
					VALUES ('$_POST[dependenciaId]', '$_POST[abreviatura]', '$_POST[nombreSubdependencia]', '$_SESSION[carnet]', '$fhActual')
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				// Escribir en bitacora
				$bitacora = "(".$fhActual.") Registró una nueva subdependencia: (".$_POST["abreviatura"].") " . $_POST["nombreSubdependencia"] . ",";
				$updateBitacora = $bd->query("
					UPDATE bit_credenciales SET
						movimientos = CONCAT(movimientos, '$bitacora')
					WHERE bitCredencialId = '$_SESSION[bitCredencialId]'
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				echo "completado";
			} else {
				echo "La Subdependencia " . $_POST["abreviatura"] . " ya ha sido creada.";
			}
		break;

		case "nuevo-rol":
			/*
				POST:
				rol
			*/
			$sqlExisteRol = $bd->query("
				SELECT
					COUNT(rolId) AS existe
				FROM roles
				WHERE rol = '$_POST[rol]' AND flgEliminado = '0' 
			");
			$getExisteRol = $sqlExisteRol->fetch_assoc();

			if($getExisteRol["existe"] == 0) {
				$queryCrearRol = $bd->query("
					INSERT INTO roles (rol, agregadoPor, fhAgregado) 
					VALUES ('$_POST[rol]', '$_SESSION[carnet]', '$fhActual')
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				// Escribir en bitacora
				$bitacora = "(".$fhActual.") Registró un nuevo rol: " . $_POST["rol"] . ",";
				$updateBitacora = $bd->query("
					UPDATE bit_credenciales SET
						movimientos = CONCAT(movimientos, '$bitacora')
					WHERE bitCredencialId = '$_SESSION[bitCredencialId]'
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				echo "completado";				
			} else {
				echo "El rol " . $_POST["rol"] . " ya ha sido creado.";
			}		
		break;

		case "nuevo-permiso-menu":
			/*
				POST:
				rolId
				moduloId
				menuId[]
			*/
			foreach ($_POST["menuId"] as $menuId) {
				$sqlExistePermiso = $bd->query("
					SELECT COUNT(permisoRolId) AS existe FROM roles_menus
					WHERE rolId = '$_POST[rolId]' AND menuId = '$menuId' AND flgEliminado = '0'
				");
				$getExistePermiso = $sqlExistePermiso->fetch_assoc();
				if($getExistePermiso["existe"] == 0) {
					$sqlNombreMenu = $bd->query("
						SELECT nombreMenu, tipoMenu, menuDropdown FROM menus
						WHERE menuId = '$menuId'
					");
					$getNombreMenu = $sqlNombreMenu->fetch_assoc();

					$sqlNombreRol = $bd->query("
						SELECT rol FROM roles
						WHERE rolId = '$_POST[rolId]'
					");
					$getNombreRol = $sqlNombreRol->fetch_assoc();

					$queryCrearPermiso = $bd->query("
						INSERT INTO roles_menus (rolId, menuId, agregadoPor, fhAgregado) 
						VALUES ('$_POST[rolId]', '$menuId', '$_SESSION[carnet]', '$fhActual')
					") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));

					if($getNombreMenu["tipoMenu"] == "Submenú") {
						$menuDropdown = $getNombreMenu["menuDropdown"];
						$queryExistePermisoDropdown = $bd->query("
							SELECT COUNT(permisoRolId) AS existe FROM roles_menus
							WHERE menuId = '$menuDropdown' AND rolId = '$_POST[rolId]' AND flgEliminado = '0'
						");
						$getExistePermisoDropdown = $queryExistePermisoDropdown->fetch_assoc();

						if($getExistePermisoDropdown["existe"] == 0) {
							$queryCrearPermisoDropdown = $bd->query("
								INSERT INTO roles_menus (rolId, menuId, agregadoPor, fhAgregado) 
								VALUES ('$_POST[rolId]', '$menuDropdown', '$_SESSION[carnet]', '$fhActual')
							") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
						} else {
							// Ya tiene el dropdown
						}
					} else {
						// es menú normal
					}

					// Escribir en bitacora
					$bitacora = "(".$fhActual.") Registró el permiso: " . $getNombreMenu["nombreMenu"] . " para el rol: ".$getNombreRol["rol"].",";
					$updateBitacora = $bd->query("
						UPDATE bit_credenciales SET
							movimientos = CONCAT(movimientos, '$bitacora')
						WHERE bitCredencialId = '$_SESSION[bitCredencialId]'
					") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));					
				} else {
					// omitir permiso
				}
			}
			echo "completado";
		break;

		case "nuevo-cargo":
			/*
				POST:
				nombreCargo
			*/
			$sqlExisteCargo = $bd->query("
				SELECT
					COUNT(cargoId) AS existe
				FROM cargos
				WHERE nombreCargo = '$_POST[nombreCargo]' AND flgEliminado = '0' 
			");
			$getExisteCargo = $sqlExisteCargo->fetch_assoc();

			if($getExisteCargo["existe"] == 0) {
				$queryCrearCargo = $bd->query("
					INSERT INTO cargos (nombreCargo, agregadoPor, fhAgregado) 
					VALUES ('$_POST[nombreCargo]', '$_SESSION[carnet]', '$fhActual')
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				// Escribir en bitacora
				$bitacora = "(".$fhActual.") Registró un nuevo cargo: " . $_POST["nombreCargo"] . ",";
				$updateBitacora = $bd->query("
					UPDATE bit_credenciales SET
						movimientos = CONCAT(movimientos, '$bitacora')
					WHERE bitCredencialId = '$_SESSION[bitCredencialId]'
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				echo "completado";				
			} else {
				echo "El cargo " . $_POST["nombreCargo"] . " ya ha sido creado.";
			}		
		break;

		default:
			echo "Operación no encontrada";
		break;
	}
?>