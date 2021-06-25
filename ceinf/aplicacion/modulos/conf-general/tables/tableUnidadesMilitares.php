<?php 
	require_once '../../../../librerias/contenido/logica/conexion.php';
	@session_start();

	$sqlUnidades = $bd->query("
		SELECT
			unidadMilitarId, 
			nombreUnidadMilitar, 
			abreviatura
		FROM unidades_militares
		WHERE flgEliminado = '0'
	");
	$n = 0;
	while($getUnidades = $sqlUnidades->fetch_assoc()) {
		$n += 1;
		$unidadMilitarId = $getUnidades["unidadMilitarId"];

		$columnaInformacion = '('.$getUnidades["abreviatura"].') '.$getUnidades["nombreUnidadMilitar"];

		// Validar si tiene dependencias
		$sqlExisteDependencia = $bd->query("
			SELECT
				COUNT(dependenciaId) AS existeDependencia
			FROM dependencias
			WHERE unidadMilitarId = '$unidadMilitarId' AND flgEliminado = '0'
		");
		$getExisteDependencia = $sqlExisteDependencia->fetch_assoc();

		// Si existe dependencia, deshabilitar boton eliminar
		if($getExisteDependencia["existeDependencia"] > 0) {
			$disabledDelete = "disabled";
		} else {
			$disabledDelete = 'onclick="eliminarUnidadMilitar(`'.$unidadMilitarId.'`, `'.$getUnidades["nombreUnidadMilitar"].'`)"';
		}

		$columnaAcciones = '
			<button type="button" class="btn btn-primary btn-sm" onclick="formEditarUnidadMilitar('.$unidadMilitarId.');">
				<i class="fa fa-pencil"></i>
			</button>
			<button type="button" class="btn btn-primary btn-sm" onclick="changePage(`'.$unidadMilitarId.'^('.$getUnidades["abreviatura"].') '.$getUnidades["nombreUnidadMilitar"].'`,`dependencias`);">
				<i class="fa fa-building"></i> Dependencias
			</button>
			<button type="button" class="btn btn-danger btn-sm" '.$disabledDelete.'>
				<i class="fa fa-trash"></i>
			</button>
		';

	    $output['data'][] = array(
	        $n,
	        $columnaInformacion,
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