<?php 
	require_once '../../../../librerias/contenido/logica/conexion.php';
	@session_start();

	$sqlPermisosRoles = $bd->query("
		SELECT
			rm.permisoRolId AS permisoRolId,
			rm.rolId AS rolId,
			r.rol AS rol,
			rm.menuId AS menuId,
			mo.nombreModulo AS nombreModulo,
			m.nombreMenu AS nombreMenu,
			m.tipoMenu AS tipoMenu
		FROM roles_menus rm
		JOIN menus m ON m.menuId = rm.menuId
		JOIN modulos mo ON mo.moduloId = m.moduloId
		JOIN roles r ON r.rolId = rm.rolId
		WHERE rm.rolId = '$_POST[id]' AND rm.flgEliminado = '0'
	");
	$n = 0;
	while($getPermisosRoles = $sqlPermisosRoles->fetch_assoc()) {
		$n += 1;
		$permisoRolId = $getPermisosRoles["permisoRolId"];

		$columnaModulo = $getPermisosRoles["nombreModulo"];

		if($getPermisosRoles["tipoMenu"] == "Dropdown") {
			$disabledEliminar = 'disabled';
		} else {
			$disabledEliminar = 'onclick="eliminarPermiso(`'.$permisoRolId.'`, `'.$getPermisosRoles["nombreMenu"].'`, `'.$getPermisosRoles["rol"].'`)"';
		}

		$columnaMenu = $getPermisosRoles["nombreMenu"] . " (" . $getPermisosRoles["tipoMenu"] . ")";

		$columnaAcciones = '
			<button type="button" class="btn btn-danger btn-sm" '.$disabledEliminar.'>
				<i class="fa fa-trash"></i>
			</button>
		';

	    $output['data'][] = array(
	        $n,
	        $columnaModulo,
	        $columnaMenu,
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