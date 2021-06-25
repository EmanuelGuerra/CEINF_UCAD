<?php 
	require_once '../../../../librerias/contenido/logica/conexion.php';
	@session_start();

	$sqlDependencias = $bd->query("
		SELECT
			d.dependenciaId AS  dependenciaId, 
			d.unidadMilitarId AS unidadMilitarId,
			um.nombreUnidadMilitar AS nombreUnidadMilitar,
			um.abreviatura AS abreviaturaUM,
			d.nombreDependencia AS nombreDependencia, 
			d.abreviatura AS abreviatura
		FROM dependencias d
		JOIN unidades_militares um ON um.unidadMilitarId = d.unidadMilitarId
		WHERE d.unidadMilitarId = '$_POST[id]' AND d.flgEliminado = '0'
	");
	$n = 0;
	while($getDependencias = $sqlDependencias->fetch_assoc()) {
		$n += 1;
		$dependenciaId = $getDependencias["dependenciaId"];

		$columnaInformacion = '('.$getDependencias["abreviatura"].') '.$getDependencias["nombreDependencia"];

		// Validar si tiene dependencias
		$sqlExisteSubdependencia = $bd->query("
			SELECT
				COUNT(subdependenciaId) AS existeSubdependencia
			FROM subdependencias
			WHERE dependenciaId = '$dependenciaId' AND flgEliminado = '0'
		");
		$getExisteSubdependencia = $sqlExisteSubdependencia->fetch_assoc();

		// Si existe dependencia, deshabilitar boton eliminar
		if($getExisteSubdependencia["existeSubdependencia"] > 0) {
			$disabledDelete = "disabled";
		} else {
			$disabledDelete = 'onclick="eliminarDependencia(`'.$dependenciaId.'`, `'.$getDependencias["nombreDependencia"].'`)"';
		}

		$columnaAcciones = '
			<button type="button" class="btn btn-primary btn-sm" onclick="formEditarDependencia('.$dependenciaId.');">
				<i class="fa fa-pencil"></i>
			</button>
			<button type="button" class="btn btn-primary btn-sm" onclick="changePage(`'.$dependenciaId.'^'.$getDependencias["unidadMilitarId"].'^('.$getDependencias["abreviaturaUM"].') '.$getDependencias["nombreUnidadMilitar"].'^('.$getDependencias["abreviatura"].') '.$getDependencias["nombreDependencia"].'`,`subdependencias`);">
				<i class="fa fa-building"></i> Subdependencias
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