<?php
	require_once '../../../../librerias/contenido/logica/conexion.php';
	@session_start();

	// AGREGAR SIEMPRE WHERE FLGDELETE=0 para no mostrar eliminados
    $sqlSolicitudes = $bd->query("
    	SELECT
			solicitudAccesoId, 
			carnet, 
			nombres, 
			apellidos, 
			cargo, 
			departamento,
			fhAgregado
    	FROM solicitudes_acceso
    	WHERE estadoSolicitud = 'Pendiente' AND flgEliminado = '0'
    ");
	$n = 0;
	while($getSolicitudes = $sqlSolicitudes->fetch_assoc()) {
		$n += 1;

		$columnaEmpleado = '
			<b>Empleado: </b> '.$getSolicitudes["apellidos"].', '.$getSolicitudes["nombres"].'<br>
			<b>Carnet: </b> '.$getSolicitudes["carnet"].'<br>
			<b>Cargo: </b> '.$getSolicitudes["cargo"].'<br>
			<b>Departamento: </b>'.$getSolicitudes["departamento"].'
		';

		$columnaFHSolicitud = date("d/m/Y H:i:s", strtotime($getSolicitudes['fhAgregado']));

	    $columnaAcciones = '
	    	<button type="button" class="btn btn-success" onclick="formProcesarSolicitud(`aprobar`,`'.$getSolicitudes["solicitudAccesoId"].'^'.$getSolicitudes["apellidos"].', '.$getSolicitudes["nombres"].'`);">
				<i class="fa fa-check-circle"></i>
	    	</button>
	    	<button type="button" class="btn btn-danger" onclick="formProcesarSolicitud(`rechazar`,`'.$getSolicitudes["solicitudAccesoId"].'^'.$getSolicitudes["apellidos"].', '.$getSolicitudes["nombres"].'`);">
				<i class="fa fa-times-circle"></i>
	    	</button>	
	    ';
	    
	    $output['data'][] = array(
	        $n,
	        $columnaEmpleado,
	        $columnaFHSolicitud,
	        $columnaAcciones
	    );
	}

	$bd->close();

    if($n > 0) {
        echo json_encode($output);
    } else {
        // No retornar nada para evitar error "null"
        echo json_encode(array('data'=>'')); 
    }
?>