<?php 
	require_once '../../../../librerias/contenido/logica/conexion.php';
	@session_start();

	$sqlMovimientosUsuario = $bd->query("
		SELECT
			bitCredencialId, 
			credencialId, 
			fhLogin, 
			fhLogout, 
			movimientos, 
			remoteIp, 
			forwardIp, 
			navegador
		FROM bit_credenciales
		WHERE credencialId = '$_POST[credencialId]' AND fhLogin BETWEEN '$_POST[fhInicio]' AND '$_POST[fhFin]'
	");
	$n = 0;
	while($getMovimientosUsuario = $sqlMovimientosUsuario->fetch_assoc()) {
		$n += 1;

		$fhLogout = (is_null($getMovimientosUsuario["fhLogout"]) || $getMovimientosUsuario["fhLogout"] == "") ? "No finalizó sesión" : date("d/m/Y H:i:s", strtotime($getMovimientosUsuario['fhLogout']));

		$columnaInformacion = '
			<b>Inicio de sesión: </b> '.date("d/m/Y H:i:s", strtotime($getMovimientosUsuario['fhLogin'])).'<br>
			<b>Cierre de sesión: </b> '.$fhLogout.'<br>
			<b>Navegador: </b> '.$getMovimientosUsuario["navegador"].'
		';

		$columnaMovimientos = $getMovimientosUsuario["movimientos"];

	    $output['data'][] = array(
	        $n,
	        $columnaInformacion,
	        $columnaMovimientos
	    );
	}
	
    if($n > 0) {
        echo json_encode($output);
    } else {
        // No retornar nada para evitar error "null"
        echo json_encode(array('data'=>'')); 
    }
?>