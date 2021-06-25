<?php
	require_once '../../../../librerias/contenido/logica/conexion.php';
	@session_start();

	// AGREGAR SIEMPRE WHERE FLGDELETE=0 para no mostrar eliminados
    $sqlUsuarios = $bd->query("
    	SELECT
    		c.credencialId AS credencialId, 
    		c.carnet AS carnet, 
		    CONCAT(
		        IFNULL(c.apellido1, '-'),
		        ' ',
		        IFNULL(c.apellido2, '-'),
		        ', ',
		        IFNULL(c.nombre1, '-'),
		        ' ',
		        IFNULL(c.nombre2, '-')
		    ) AS nombreUsuario,
    		c.fechaNacimiento AS fechaNacimiento, 
    		c.cargoId AS cargoId, 
    		cr.nombreCargo AS nombreCargo,
    		c.subdependenciaId AS subdependenciaId, 
    		sd.dependenciaId AS dependenciaId,
    		d.nombreDependencia AS nombreDependencia,
    		sd.nombreSubdependencia AS nombreSubdependencia,
    		c.rolId AS rolId, 
    		r.rol AS rol,
    		c.numLogin AS numLogin, 
    		c.fhUltimoLogin AS fhUltimoLogin, 
    		c.enLinea AS enLinea, 
    		c.estadoCredencial AS estadoCredencial
    	FROM credenciales c
    	JOIN cargos cr ON cr.cargoId = c.cargoId
    	JOIN subdependencias sd ON sd.subdependenciaId = c.subdependenciaId
    	JOIN dependencias d ON d.dependenciaId = sd.dependenciaId
    	JOIN roles r ON r.rolId = c.rolId
    	WHERE c.flgEliminado = '0'
    ");
	$n = 0;
	while($getUsuarios = $sqlUsuarios->fetch_assoc()) {
		$n += 1;

		$columnaEmpleado = '
			<b>Carnet: </b> '.$getUsuarios["carnet"].'<br>
			<b>Usuario: </b> '.$getUsuarios["nombreUsuario"].'<br>
			<b>Cargo: </b> '.$getUsuarios["nombreCargo"].'<br>
			<b>Dependencia: </b>'.$getUsuarios["nombreDependencia"].' - '.$getUsuarios["nombreSubdependencia"].'<br>
			<b>Rol: </b> '.$getUsuarios["rol"].'
		';

		if($getUsuarios["estadoCredencial"] == "Activo") {
			$estadoUsuario = '<span class="text-success"><b>Activo</b></span>';
			$btnEstado = '
				<button class="btn btn-danger btn-sm" onclick="cambiarEstadoUsuario(`'.$getUsuarios["credencialId"].'`,`desactivar`, `'.$getUsuarios["nombreUsuario"].'`);">
					<i class="fa fa-refresh"></i> Estado
				</button>
			';
		} else if($getUsuarios["estadoCredencial"] == "Suspendido") { // ya se alcanzó el limite de intentos
			$estadoUsuario = '<span class="text-secondary"><b>Suspendido</b> (Límite de intentos fallidos)</span>';
			$btnEstado = '
				<button class="btn btn-success btn-sm" onclick="cambiarEstadoUsuario(`'.$getUsuarios["credencialId"].'`,`activar`, `'.$getUsuarios["nombreUsuario"].'`);">
					<i class="fa fa-refresh"></i> Estado
				</button>
			';
		} else {
			$estadoUsuario = '<span class="text-danger"><b>Inactivo</b></span>';
			$btnEstado = '
				<button class="btn btn-success btn-sm" onclick="cambiarEstadoUsuario(`'.$getUsuarios["credencialId"].'`,`activar`, `'.$getUsuarios["nombreUsuario"].'`);">
					<i class="fa fa-refresh"></i> Estado
				</button>
			';
		}

        if($getUsuarios["enLinea"] == 0) {
            $enLinea = '<span class="text-secondary"><b><i class="fa fa-toggle-off"></i> Desconectado</b></span><br><b>Últ. vez: </b>' . date("d/m/Y H:i:s", strtotime($getUsuarios["fhUltimoLogin"]));
        } else {
            $enLinea = '<span class="text-success"><b><i class="fa fa-toggle-on"></i> En línea</b></span>';
        }

		$columnaEstados = '
			<b>Credenciales: </b> '.$estadoUsuario.'<br>
			<b>CEINF: </b>'.$enLinea.'
		';
	    
		$columnaAcciones = '
			<button class="btn btn-primary btn-sm" onclick="formEditarUsuario(`'.$getUsuarios["credencialId"].'`);">
				<i class="fa fa-pencil"></i>
			</button>
			'.$btnEstado.'
		';

	    $output['data'][] = array(
	        $n,
	        $columnaEmpleado,
	        $columnaEstados,
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