<?php 
	require_once '../../../../librerias/contenido/logica/conexion.php';
	@session_start();

	$sqlIntentos = $bd->query("
		SELECT
			intentoLoginId, 
			remoteIp, 
			forwardIp, 
			tipoIntento, 
			carnet, 
			fhIntento, 
			navegador
		FROM bit_intentos_login
		WHERE fhIntento BETWEEN '$_POST[fhInicio]' AND '$_POST[fhFin]'
	");
	$n = 0;
	while($getIntentos = $sqlIntentos->fetch_assoc()) {
		$n += 1;

		$tipoIntento = ($getIntentos["tipoIntento"] == "Externo") ? "Externo - Carnet no registrado" : "Usuario - Carnet registrado, contraseña incorrecta";

		$columnaInformacion = '
			<b>Fecha y hora intento: </b> '.date("d/m/Y H:i:s", strtotime($getIntentos["fhIntento"])).'<br>
			<b>Carnet: </b> '.$getIntentos["carnet"].'<br>
			<b>Tipo de intento: </b> '.$tipoIntento.'<br>
			<b>Navegador: </b> '.$getIntentos["navegador"].'
		';
	    $output['data'][] = array(
	        $n,
	        $columnaInformacion
	    );
	}
	
    if($n > 0) {
        echo json_encode($output);
    } else {
        // No retornar nada para evitar error "null"
        echo json_encode(array('data'=>'')); 
    }
?>