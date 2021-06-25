<?php 
	require_once '../../../../librerias/contenido/logica/conexion.php';
	@session_start();

	$fhActual = date("Y-m-d H:i:s");
	$case = (isset($_REQUEST["case"])) ? $_REQUEST["case"] : "n/a";

	switch($case) {
		case "eliminar-unidad-militar":
			/*
				POST:
				unidadMilitarId		
				nombreUnidad	
			*/
			$queryEliminarUnidadMilitar = $bd->query("
				UPDATE unidades_militares SET
					flgEliminado = '1',
					eliminadoPor = '$_SESSION[carnet]',
					fhEliminado = '$fhActual'
				WHERE unidadMilitarId = '$_POST[unidadMilitarId]'
			") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
			// Escribir en bitacora
			$bitacora = "(".$fhActual.") Eliminó la unidad militar: ".$_POST["nombreUnidad"].", ";
			$updateBitacora = $bd->query("
				UPDATE bit_credenciales SET
					movimientos = CONCAT(movimientos, '$bitacora')
				WHERE bitCredencialId = '$_SESSION[bitCredencialId]'
			") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));	
			echo "completado";
		break;

		case "eliminar-dependencia":
			/*
				POST:
				dependenciaId		
				nombreDependencia	
			*/
			$queryEliminarUnidadMilitar = $bd->query("
				UPDATE dependencias SET
					flgEliminado = '1',
					eliminadoPor = '$_SESSION[carnet]',
					fhEliminado = '$fhActual'
				WHERE dependenciaId = '$_POST[dependenciaId]'
			") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
			// Escribir en bitacora
			$bitacora = "(".$fhActual.") Eliminó la dependencia: ".$_POST["nombreDependencia"].", ";
			$updateBitacora = $bd->query("
				UPDATE bit_credenciales SET
					movimientos = CONCAT(movimientos, '$bitacora')
				WHERE bitCredencialId = '$_SESSION[bitCredencialId]'
			") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));	
			echo "completado";
		break;

		case "eliminar-rol":
			/*
				POST:
				rolId		
				rol	
			*/
			$queryEliminarUnidadMilitar = $bd->query("
				UPDATE roles SET
					flgEliminado = '1',
					eliminadoPor = '$_SESSION[carnet]',
					fhEliminado = '$fhActual'
				WHERE rolId = '$_POST[rolId]'
			") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
			// Escribir en bitacora
			$bitacora = "(".$fhActual.") Eliminó el rol: ".$_POST["rol"].", ";
			$updateBitacora = $bd->query("
				UPDATE bit_credenciales SET
					movimientos = CONCAT(movimientos, '$bitacora')
				WHERE bitCredencialId = '$_SESSION[bitCredencialId]'
			") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));	
			echo "completado";
		break;

		case "eliminar-permisos-menu":
			/*
				POST:
				permisoRolId
				menu
				rol
			*/
			$queryMenuId = $bd->query("
				SELECT rolId, menuId FROM roles_menus
				WHERE permisoRolId = '$_POST[permisoRolId]'
			");
			$getMenuId = $queryMenuId->fetch_assoc();

			$rolId = $getMenuId["rolId"];
			$menuId = $getMenuId["menuId"];

			$sqlNombreMenu = $bd->query("
				SELECT nombreMenu, tipoMenu, menuDropdown FROM menus
				WHERE menuId = '$menuId'
			");
			$getNombreMenu = $sqlNombreMenu->fetch_assoc();

			if($getNombreMenu["tipoMenu"] == "Submenú") {
				$menuDropdown = $getNombreMenu["menuDropdown"];
				$queryExistePermisoDropdown = $bd->query("
					SELECT 
						COUNT(rm.permisoRolId) AS existe 
					FROM roles_menus rm
					JOIN menus m ON m.menuId = rm.menuId
					WHERE m.menuDropdown = '$menuDropdown' AND rm.rolId = '$rolId' AND rm.flgEliminado = '0'
				");
				$getExistePermisoDropdown = $queryExistePermisoDropdown->fetch_assoc();

				if($getExistePermisoDropdown["existe"] == 1) {
					$queryCrearPermisoDropdown = $bd->query("
						UPDATE roles_menus SET
							flgEliminado = '1',
							eliminadoPor = '$_SESSION[carnet]',
							fhEliminado = '$fhActual'
						WHERE rolId = '$rolId' AND menuId = '$menuDropdown'
					") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
				} else {
					// Tiene otros submenus
				}
			} else {
				// Era menú normal
			}

			$queryEliminarUnidadMilitar = $bd->query("
				UPDATE roles_menus SET
					flgEliminado = '1',
					eliminadoPor = '$_SESSION[carnet]',
					fhEliminado = '$fhActual'
				WHERE permisoRolId = '$_POST[permisoRolId]'
			") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
			// Escribir en bitacora
			$bitacora = "(".$fhActual.") Eliminó el permiso: ".$_POST["menu"]." al rol: ".$_POST["rol"].", ";
			$updateBitacora = $bd->query("
				UPDATE bit_credenciales SET
					movimientos = CONCAT(movimientos, '$bitacora')
				WHERE bitCredencialId = '$_SESSION[bitCredencialId]'
			") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));	
			echo "completado";		
		break;

		case "eliminar-cargo":
			/*
				POST:
				cargoId		
				nombreCargo	
			*/
			$queryEliminarUnidadMilitar = $bd->query("
				UPDATE cargos SET
					flgEliminado = '1',
					eliminadoPor = '$_SESSION[carnet]',
					fhEliminado = '$fhActual'
				WHERE cargoId = '$_POST[cargoId]'
			") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
			// Escribir en bitacora
			$bitacora = "(".$fhActual.") Eliminó el rol: ".$_POST["nombreCargo"].", ";
			$updateBitacora = $bd->query("
				UPDATE bit_credenciales SET
					movimientos = CONCAT(movimientos, '$bitacora')
				WHERE bitCredencialId = '$_SESSION[bitCredencialId]'
			") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));	
			echo "completado";
		break;

		default:
			echo "Operación no encontrada";
		break;
	}
?>