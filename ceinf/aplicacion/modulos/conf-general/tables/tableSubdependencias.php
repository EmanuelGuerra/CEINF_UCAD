<?php 
	require_once '../../../../librerias/contenido/logica/conexion.php';
	@session_start();

	$sqlSubdependencias = $bd->query("
		SELECT
			subdependenciaId, 
			nombreSubdependencia, 
			abreviatura
		FROM subdependencias
		WHERE dependenciaId = '$_POST[id]' AND flgEliminado = '0'
	");
	$n = 0;
	while($getSubdependencias = $sqlSubdependencias->fetch_assoc()) {
		$n += 1;
		$subdependenciaId = $getSubdependencias["subdependenciaId"];

		$columnaInformacion = '('.$getSubdependencias["abreviatura"].') '.$getSubdependencias["nombreSubdependencia"];
		
		$columnaAcciones = '
			<button type="button" class="btn btn-primary btn-sm" onclick="formEditarSubdependencia('.$subdependenciaId.');">
				<i class="fa fa-pencil"></i>
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