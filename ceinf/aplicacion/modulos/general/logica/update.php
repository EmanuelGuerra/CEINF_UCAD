<?php 
	require_once '../../../../librerias/contenido/logica/conexion.php';
	@session_start();

	$fhActual = date("Y-m-d H:i:s");
	$case = (isset($_REQUEST["case"])) ? $_REQUEST["case"] : "n/a";

	switch($case) {
		case 'default-password':
			/*
				$_POST:
				passwordNueva
				passwordNueva2
			*/
			// Encriptar la nueva password
			$nuevaPassword = password_hash($_POST["passwordNueva"], PASSWORD_DEFAULT);
			$updatePassword = $bd->query("
				UPDATE credenciales SET
					passw = '$nuevaPassword',
					editadoPor = '$_SESSION[carnet]',
					fhEditado = '$fhActual'
				WHERE credencialId = '$_SESSION[credencialId]'
			") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));

			// Escribir en bitacora que se cambio la default password
			$bitacora = "(".$fhActual.") Actualizó la contraseña asignada por defecto, ";
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