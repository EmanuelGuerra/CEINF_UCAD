<?php 
	require_once '../../../../librerias/contenido/logica/conexion.php';
	@session_start();

	$sqlCargos = $bd->query("
		SELECT
			cargoId,
			nombreCargo
		FROM cargos
		WHERE flgEliminado = '0'
	");
	$n = 0;
	while($getCargos = $sqlCargos->fetch_assoc()) {
		$n += 1;
		$cargoId = $getCargos["cargoId"];

		$columnaCargos = $getCargos["nombreCargo"];

		// Validar si ya se asigno el cargo
		$sqlExisteCargo = $bd->query("
			SELECT
				COUNT(credencialId) AS existe
			FROM credenciales
			WHERE cargoId = '$cargoId' AND flgEliminado = '0'
		");
		$getExisteDependencia = $sqlExisteCargo->fetch_assoc();

		// Si existe dependencia, deshabilitar boton eliminar
		if($getExisteDependencia["existe"] > 0) {
			$disabledDelete = "disabled";
		} else {
			$disabledDelete = 'onclick="eliminarCargo(`'.$cargoId.'`, `'.$getCargos["nombreCargo"].'`)"';
		}

		$columnaAcciones = '
			<button type="button" class="btn btn-primary btn-sm" onclick="formEditarCargo('.$cargoId.');">
				<i class="fa fa-pencil"></i>
			</button>
			<button type="button" class="btn btn-danger btn-sm" '.$disabledDelete.'>
				<i class="fa fa-trash"></i>
			</button>
		';

	    $output['data'][] = array(
	        $n,
	        $columnaCargos,
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