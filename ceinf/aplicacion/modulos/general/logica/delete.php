<?php 
	require_once '../../../../librerias/contenido/logica/conexion.php';
	@session_start();

	$fhActual = date("Y-m-d H:i:s");
	$case = (isset($_REQUEST["case"])) ? $_REQUEST["case"] : "n/a";

	switch($case) {
		default:
			echo "Operación no encontrada";
		break;
	}
?>