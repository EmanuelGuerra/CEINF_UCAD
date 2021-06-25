<?php 
	require_once '../../../../librerias/contenido/logica/conexion.php';
	@session_start();

	$fhActual = date("Y-m-d H:i:s");
	$case = (isset($_REQUEST["case"])) ? $_REQUEST["case"] : "n/a";

	switch($case) {
		case 'rechazar-solicitud-acceso':
			/*
				POST:
				solicitudAccesoId
				justificacionEstado
			 */
			$queryRechazarSolicitud = $bd->query("
				UPDATE solicitudes_acceso SET
					estadoSolicitud = 'Rechazada',
					justificacionEstado = '$_POST[justificacionEstado]',
					editadoPor = '$_SESSION[carnet]',
					fhEditado = '$fhActual'
				WHERE solicitudAccesoId = '$_POST[solicitudAccesoId]'
			") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
			// Escribir en bitacora
			$bitacora = "(".$fhActual.") Rechazó la solicitud de acceso de: ".$_POST["nombreSolicitud"].", ";
			$updateBitacora = $bd->query("
				UPDATE bit_credenciales SET
					movimientos = CONCAT(movimientos, '$bitacora')
				WHERE bitCredencialId = '$_SESSION[bitCredencialId]'
			") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));	
			echo "completado";
		break;
		
		case 'editar-usuario':
			/*
				POST:
				credencialId
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
				WHERE carnet = '$_POST[carnet]' AND credencialId <> '$_POST[credencialId]'
			");
			$getExisteCarnet = $queryExisteCarnet->fetch_assoc();

			if($getExisteCarnet["existeCarnet"] == 0) {
				$queryActualizarCredenciales = $bd->query("
					UPDATE credenciales SET
						carnet = '$_POST[carnet]',
						nombre1 = '$_POST[nombre1]',
						nombre2 = '$_POST[nombre2]',
						apellido1 = '$_POST[apellido1]',
						apellido2 = '$_POST[apellido2]',
						fechaNacimiento = '$_POST[fechaNacimiento]',
						cargoId = '$_POST[cargoId]',
						subdependenciaId = '$_POST[subdependenciaId]',
						rolId = '$_POST[rolId]',
						editadoPor = '$_SESSION[carnet]',
						fhEditado = '$fhActual'
					WHERE credencialId = '$_POST[credencialId]'
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				// Escribir en bitacora
				$bitacora = "(".$fhActual.") Editó la información del usuario: ".$_POST["apellido1"].", " . $_POST["nombre1"] . ",";
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

		case "estado-usuario":
			/*
				POST:
				credencialId
				estado
			*/
			if($_POST["estado"] == "activar") { // restablecer sus accesos
				// restablecer password
				$nuevaPassword = password_hash("ceinf" . date("Y") . "$", PASSWORD_DEFAULT);
				$queryCambiarEstado = $bd->query("
					UPDATE credenciales SET
						estadoCredencial = 'Activo',
						intentosLogin = '0',
						passw = '$nuevaPassword',
						editadoPor = '$_SESSION[carnet]',
						fhEditado = '$fhActual'
					WHERE credencialId = '$_POST[credencialId]'
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				$estadoBitacora = "Activó";
			} else {
				// asignar otra contraseña para no permitir el intento de inicio de sesión
				$nuevaPassword = password_hash("abc1234^(*)5678", PASSWORD_DEFAULT);
				$queryCambiarEstado = $bd->query("
					UPDATE credenciales SET
						estadoCredencial = 'Inactivo',
						passw = '$nuevaPassword',
						editadoPor = '$_SESSION[carnet]',
						fhEditado = '$fhActual'
					WHERE credencialId = '$_POST[credencialId]'
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				$estadoBitacora = "Desactivó";
			}
			$queryNombreUsuario = $bd->query("
				SELECT nombre1, apellido1
				FROM credenciales
				WHERE credencialId = '$_POST[credencialId]'
			");
			$getNombreUsuario = $queryNombreUsuario->fetch_assoc();
			$nombreUsuario = $getNombreUsuario["apellido1"] . ", " . $getNombreUsuario["nombre1"];
			// Escribir en bitacora
			$bitacora = "(".$fhActual.") ".$estadoBitacora." las credenciales de: ".$nombreUsuario.",";
			$updateBitacora = $bd->query("
				UPDATE bit_credenciales SET
					movimientos = CONCAT(movimientos, '$bitacora')
				WHERE bitCredencialId = '$_SESSION[bitCredencialId]'
			") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
			echo "completado";
		break;

		case "editar-unidad-militar":
			/*
				POST:
				unidadMilitarId
				nombreUnidadMilitar
				abreviatura
			*/
			$sqlExisteUnidadMilitar = $bd->query("
				SELECT
					COUNT(unidadMilitarId) AS existeUnidad
				FROM unidades_militares
				WHERE abreviatura = '$_POST[abreviatura]' AND unidadMilitarId <> '$_POST[unidadMilitarId]' AND flgEliminado = '0' 
			");
			$getExisteUnidadMilitar = $sqlExisteUnidadMilitar->fetch_assoc();

			if($getExisteUnidadMilitar["existeUnidad"] == 0) {
				$queryEditarUnidadMilitar = $bd->query("
					UPDATE unidades_militares SET
						nombreUnidadMilitar = '$_POST[nombreUnidadMilitar]',
						abreviatura = '$_POST[abreviatura]',
						editadoPor = '$_SESSION[carnet]',
						fhEditado = '$fhActual'
					WHERE unidadMilitarId = '$_POST[unidadMilitarId]'
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				// Escribir en bitacora
				$bitacora = "(".$fhActual.") Actualizó la información de la unidad militar: ".$_POST["nombreUnidadMilitar"].",";
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

		case "editar-dependencia":
			/*
				POST:
				dependenciaId
				unidadMilitarId
				nombreDependencia
				abreviatura
			*/
			$sqlExisteDependencia = $bd->query("
				SELECT
					COUNT(dependenciaId) AS existeUnidad
				FROM dependencias
				WHERE abreviatura = '$_POST[abreviatura]' AND dependenciaId <> '$_POST[dependenciaId]' AND flgEliminado = '0' 
			");
			$getExisteDependencia = $sqlExisteDependencia->fetch_assoc();

			if($getExisteDependencia["existeUnidad"] == 0) {
				$queryEditar = $bd->query("
					UPDATE dependencias SET
						nombreDependencia = '$_POST[nombreDependencia]',
						abreviatura = '$_POST[abreviatura]',
						editadoPor = '$_SESSION[carnet]',
						fhEditado = '$fhActual'
					WHERE dependenciaId = '$_POST[dependenciaId]'
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				// Escribir en bitacora
				$bitacora = "(".$fhActual.") Actualizó la información de la dependencia: ".$_POST["nombreDependencia"].",";
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

		case "editar-subdependencia":
			/*
				POST:
				subdependenciaId
				dependenciaId
				nombreSubdependencia
				abreviatura
			*/
			$sqlExisteSubdependencia = $bd->query("
				SELECT
					COUNT(subdependenciaId) AS existeUnidad
				FROM subdependencias
				WHERE abreviatura = '$_POST[abreviatura]' AND subdependenciaId <> '$_POST[subdependenciaId]' AND flgEliminado = '0' 
			");
			$getExisteSubdependencia = $sqlExisteSubdependencia->fetch_assoc();

			if($getExisteSubdependencia["existeUnidad"] == 0) {
				$queryEditar = $bd->query("
					UPDATE subdependencias SET
						nombreSubdependencia = '$_POST[nombreSubdependencia]',
						abreviatura = '$_POST[abreviatura]',
						editadoPor = '$_SESSION[carnet]',
						fhEditado = '$fhActual'
					WHERE subdependenciaId = '$_POST[subdependenciaId]'
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				// Escribir en bitacora
				$bitacora = "(".$fhActual.") Actualizó la información de la subdependencia: ".$_POST["nombreSubdependencia"].",";
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

		case "editar-rol":
			/*
				POST:
				rolId
				rol
			*/
			$sqlExisteRol = $bd->query("
				SELECT
					COUNT(rolId) AS existe
				FROM roles
				WHERE rol = '$_POST[rol]' AND rolId <> '$_POST[rolId]' AND flgEliminado = '0' 
			");
			$getExisteRol = $sqlExisteRol->fetch_assoc();

			if($getExisteRol["existe"] == 0) {
				$queryRol = $bd->query("
					UPDATE roles SET
						rol = '$_POST[rol]',
						editadoPor = '$_SESSION[carnet]',
						fhEditado = '$fhActual'
					WHERE rolId = '$_POST[rolId]'
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				// Escribir en bitacora
				$bitacora = "(".$fhActual.") Actualizó la información del rol: " . $_POST["rol"] . ",";
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

		case "editar-cargo":
			/*
				POST:
				cargoId
				nombreCargo
			*/
			$sqlExisteCargo = $bd->query("
				SELECT
					COUNT(cargoId) AS existe
				FROM cargos
				WHERE nombreCargo = '$_POST[nombreCargo]' AND cargoId <> '$_POST[cargoId]' AND flgEliminado = '0' 
			");
			$getExisteCargo = $sqlExisteCargo->fetch_assoc();

			if($getExisteCargo["existe"] == 0) {
				$queryCargo = $bd->query("
					UPDATE cargos SET
						nombreCargo = '$_POST[nombreCargo]',
						editadoPor = '$_SESSION[carnet]',
						fhEditado = '$fhActual'
					WHERE cargoId = '$_POST[cargoId]'
				") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				// Escribir en bitacora
				$bitacora = "(".$fhActual.") Actualizó la información del cargo: " . $_POST["nombreCargo"] . ",";
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