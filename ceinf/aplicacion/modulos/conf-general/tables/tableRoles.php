<?php 
	require_once '../../../../librerias/contenido/logica/conexion.php';
	@session_start();

	$sqlRoles = $bd->query("
		SELECT
			rolId,
			rol
		FROM roles
		WHERE flgEliminado = '0'
	");
	$n = 0;
	while($getRoles = $sqlRoles->fetch_assoc()) {
		$n += 1;
		$rolId = $getRoles["rolId"];

		$columnaRol = $getRoles["rol"];

		// Validar si tiene permisos
		$sqlExistePermiso = $bd->query("
			SELECT
				COUNT(permisoRolId) AS existe
			FROM roles_menus
			WHERE rolId = '$rolId' AND flgEliminado = '0'
		");
		$getExistePermiso = $sqlExistePermiso->fetch_assoc();

		// Validar si el rol ya fue asignado a un usuario
		$sqlExisteRolUsuario = $bd->query("
			SELECT
				COUNT(credencialId) AS existe
			FROM credenciales
			WHERE rolId = '$rolId' AND flgEliminado = '0'
		");
		$getExistenRolUsuario = $sqlExisteRolUsuario->fetch_assoc();

		// Si tiene permisos o ha sido asignado a un usuario, deshabilitar boton eliminar
		if($getExistePermiso["existe"] == 0 && $getExistenRolUsuario["existe"] == 0) {
			$disabledDelete = 'onclick="eliminarRol(`'.$rolId.'`, `'.$getRoles["rol"].'`)"';
		} else {
			$disabledDelete = "disabled";			
		}

		$columnaAcciones = '
			<button type="button" class="btn btn-primary btn-sm" onclick="formEditarRol('.$rolId.');">
				<i class="fa fa-pencil"></i>
			</button>
			<button type="button" class="btn btn-primary btn-sm" onclick="formPermisos(`'.$rolId.'^'.$getRoles["rol"].'`);">
				<i class="fa fa-lock"></i> Permisos
			</button>
			<button type="button" class="btn btn-danger btn-sm" '.$disabledDelete.'>
				<i class="fa fa-trash"></i>
			</button>
		';

	    $output['data'][] = array(
	        $n,
	        $columnaRol,
	        $columnaAcciones
	    );
	}
	
    if($n > 0) {
        echo json_encode($output);
    } else {
        // No retornar nada para evitar error "null"
        echo json_encode(array('data'=>'')); 
    }
?>