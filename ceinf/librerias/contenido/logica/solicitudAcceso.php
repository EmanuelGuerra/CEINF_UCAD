<?php 
    session_start();
    include 'conexion.php';
    $fhActual = date("Y-m-d H:i:s");
	/*
		$_POST:
		carnet
		nombres
		apellidos
		cargo
		departamento
	*/
	// POST variables
	$carnet = $_POST["carnet"];
	$nombres = $_POST["nombres"];
	$apellidos = $_POST["apellidos"];
	$cargo = $_POST["cargo"];
	$departamento = $_POST["departamento"];

	// Verificar si existe una solicitud de la persona
	$getExisteSolicitud = $bd->query("
		SELECT
			COUNT(solicitudAccesoId) AS existeSolicitud
		FROM solicitudes_acceso
		WHERE carnet = '$carnet'
    ");
    $getExisteSolicitud = $getExisteSolicitud->fetch_assoc();

    if($getExisteSolicitud["existeSolicitud"] == 0) {
    	// Insertar solicitud
    	$insSolicitudAcceso = $bd->query("
    		INSERT INTO solicitudes_acceso (carnet, nombres, apellidos, cargo, departamento, estadoSolicitud, agregadoPor, fhAgregado)
    		VALUES ('$carnet', '$nombres', '$apellidos', '$cargo', '$departamento', 'Pendiente', 'Automático', '$fhActual')
    	") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
    	echo "aprobado";
    } else {
    	// Ya existe el carnet ingresado, verificar su estado
    	$getEstadoSolicitud = $bd->query("
    		SELECT
    			estadoSolicitud
    		FROM solicitudes_acceso
    		WHERE carnet = '$carnet'
    	");
    	$getEstadoSolicitud = $getEstadoSolicitud->fetch_assoc();
    	if($getEstadoSolicitud["estadoSolicitud"] == "Pendiente") {
    		echo "Su solicitud se encuentra en proceso de revisión.";
    	} else {
    		if($getEstadoSolicitud["estadoSolicitud"] == "Autorizada") {
    			echo "Su solicitud ha sido autorizada, por favor inicie sesión.";
    		} else {
    			echo "Su solicitud ha sido rechazada. Comuníquese con el departamento de Informática.";
    		}
    	}
    }
?>