<?php
	$localhost = "localhost";
	$username = "root";
	$password = "";
	$dbname = "db_ceinf";

	$sql_details = array(
		'user' => $username,
		'pass' => $password,
		'db'   => $dbname,
		'host' => $localhost
	);

	$bd = new mysqli($localhost, $username, $password, $dbname);

	if($bd->connect_error) {
		die("No fue posible establecer conexión: " . $bd->connect_error);
	} else {
		date_default_timezone_set('America/El_Salvador');
	}
	if (!$bd->set_charset("utf8")) {
		printf("Error al definir UTF8: %s\n", $mysqli->error);
	} else {
		$charset = mysqli_character_set_name($bd);
	}
?>