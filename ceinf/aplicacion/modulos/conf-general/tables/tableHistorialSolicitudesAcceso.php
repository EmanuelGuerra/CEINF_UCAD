<?php
	require_once '../../../../librerias/contenido/logica/conexion.php';
	@session_start();

	$estadoSolicitud = $_POST["estadoSolicitud"];

	// AGREGAR SIEMPRE WHERE FLGDELETE=0 para no mostrar eliminados
    $sqlSolicitudes = $bd->query("
    	SELECT
			sa.solicitudAccesoId AS solicitudAccesoId, 
			sa.carnet AS carnet, 
			sa.nombres AS nombres, 
			sa.apellidos AS apellidos, 
			sa.cargo AS cargo, 
			sa.departamento AS departamento,
			sa.fhAgregado AS fhAgregado,
			sa.editadoPor AS editadoPor,
			sa.fhEditado AS fhEditado,
			c.nombre1 AS nombre1,
			c.apellido1 AS apellido1,
			sa.justificacionEstado AS justificacionEstado
    	FROM solicitudes_acceso sa
    	JOIN credenciales c ON c.carnet = sa.editadoPor
    	WHERE sa.estadoSolicitud = '$estadoSolicitud' AND sa.flgEliminado = '0'
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

		if($estadoSolicitud == "Rechazada") {
			$justificacionEstado = '<br><b>Justificación/Motivo: </b>' . $getSolicitudes["justificacionEstado"];
		} else {
			$justificacionEstado = "";
		}

		$columnaFHSolicitud = '
			<b>Solicitud recibida: </b> '.date("d/m/Y H:i:s", strtotime($getSolicitudes['fhAgregado'])).'<br>
			<b>Solicitud '.strtolower($estadoSolicitud).' por: </b>'.$getSolicitudes["apellido1"].', '.$getSolicitudes["nombre1"].' - '.date("d/m/Y H:i:s", strtotime($getSolicitudes['fhEditado'])).'
			'.$justificacionEstado.'
		';
	    
	    $output['data'][] = array(
	        $n,
	        $columnaEmpleado,
	        $columnaFHSolicitud
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