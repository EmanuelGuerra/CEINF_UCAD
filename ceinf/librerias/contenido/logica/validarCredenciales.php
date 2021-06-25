<?php 
    session_start();
    include 'conexion.php';

    $post_carnet = $_POST['usuarioLogin'];
    $post_password = $_POST['passLogin'];

    // quitar comentarios al subirlo al server
    //$remoteIp = $_SERVER['REMOTE_ADDR'];
    //$forwardIp = $_SERVER['HTTP_X_FORWARDED_FOR'];

    $remoteIp = "localhost";
    $forwardIp = "localhost";

    $navegador = $_SERVER['HTTP_USER_AGENT'];

    if(isset($_SESSION["intentosLogin"])) {
    } else {
        $_SESSION["intentosLogin"] = 0;
    }

    $fhActual = date("Y-m-d H:i:s");
    $getCredencial = $bd->query("
    	SELECT
    		cred.credencialId AS credencialId,
    		cred.carnet AS carnet,
    		cred.nombre1 AS nombre1,
    		cred.apellido1 AS apellido1,
    		cred.passw AS passw,
            cred.cargoId AS cargoId,
            c.nombreCargo AS nombreCargo,
            cred.subdependenciaId AS subdependenciaId,
            s.nombreSubdependencia AS nombreSubdependencia,
    		cred.rolId AS rolId, 
    		r.rol AS rol,
    		cred.intentosLogin AS intentosLogin,
    		cred.estadoCredencial AS estadoCredencial
    	FROM credenciales cred
    	JOIN roles r ON r.rolId = cred.rolId
        JOIN cargos c ON c.cargoId = cred.cargoId
        JOIN subdependencias s ON s.subdependenciaId = cred.subdependenciaId
    	WHERE cred.carnet = '$post_carnet'
    ");

    if(mysqli_num_rows($getCredencial) > 0 ) {
        $getCredencial = $getCredencial->fetch_assoc();

        $credencialId = $getCredencial["credencialId"];
        $carnet = $getCredencial["carnet"];
        $nombre1 = $getCredencial["nombre1"];
        $apellido1 = $getCredencial["apellido1"];
        $passw = $getCredencial["passw"];
        $cargoId = $getCredencial["cargoId"];
        $nombreCargo = $getCredencial["nombreCargo"];
        $subdependenciaId = $getCredencial["subdependenciaId"];
        $nombreSubdependencia = $getCredencial["nombreSubdependencia"];
        $rolId = $getCredencial["rolId"];
        $rol = $getCredencial["rol"];
        $intentosLogin = $getCredencial["intentosLogin"];
        $estadoCredencial = $getCredencial["estadoCredencial"];

        if (password_verify($post_password, $passw)) {
        	// do
            if($estadoCredencial == "Activo") {
            	$_SESSION["credencialId"] = $credencialId;
            	$_SESSION["carnet"] = $carnet;
            	$_SESSION["nombrePersona"] = $nombre1 . " " . $apellido1;
                $_SESSION["cargoId"] = $cargoId;
                $_SESSION["nombreCargo"] = $nombreCargo;
                $_SESSION["subdependenciaId"] = $subdependenciaId;
                $_SESSION["nombreSubdependencia"] = $nombreSubdependencia;
            	$_SESSION["rolId"] = $rolId;
            	$_SESSION["rol"] = $rol;

                $_SESSION["flgInactivo"] = 0;
                $bitacora = "(" . $fhActual . ") Inició sesión, ";

                // Reiniciar intentosLogin y sumar/guardar campos para auditoria
                $resetIntentos = $bd->query("
                    UPDATE credenciales SET 
                        intentosLogin = 0,
                        numLogin = numLogin + 1,
                        fhUltimoLogin = '$fhActual',
                        enLinea = 1
                    WHERE credencialId = '$_SESSION[credencialId]'
                ") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
                // Inicializar la bitacora
                $insBitacora = $bd->query("
                    INSERT INTO bit_credenciales (credencialId, fhLogin, movimientos, remoteIp, forwardIp, navegador)
                    VALUES('$_SESSION[credencialId]', '$fhActual', '$bitacora', '$remoteIp', '$forwardIp', '$navegador')
                ") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));

                $getBitacoraId = $bd->query("
                   SELECT MAX(bitCredencialId) AS bitCredencialId FROM bit_credenciales
                ");
                $getBitacoraId = $getBitacoraId->fetch_assoc();

                $_SESSION["bitCredencialId"] = $getBitacoraId["bitCredencialId"];

                if($post_password == "ceinf" . date("Y") . "$") { // Default password
                	$_SESSION["flgPassword"] = 1; // Obligar a cambiar contraseña por defecto al ingresar a la aplicación
                } else {
                	$_SESSION["flgPassword"] = 0;
                }
                echo "aprobado";
            } else if($estadoCredencial == "Suspendido") { // Las credenciales coinciden, pero ya se alcanzó el limite de intentos
                echo "no-aprobado/Sus credenciales han sido suspendidas por alcanzar el límite de intentos fallidos";
            } else { // Otro estado, "inhabilitado" manual desde la interfaz de usuarios
                echo "no-aprobado/No es posible iniciar sesión ya que sus credenciales han sido desactivadas";
            }
        } else { // Existe el carnet, pero la contraseña no es correcta
        	 // do
            if($estadoCredencial == "Suspendido") { // El carnet coincidia pero se alcanzó el limite de 5 intentos fallidos de la contraseña
                echo "no-aprobado/Sus credenciales han sido desactivadas por alcanzar el límite de intentos fallidos";
            } else { // El carnet coincide, pero la contraseña no, sumar + 1 a intentosLogin
                $intentosLogin += 1;

                $updateIntentos = $bd->query("
                    UPDATE credenciales SET intentosLogin='$intentosLogin'
                    WHERE credencialId='$credencialId'
                ") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));

                // Guardar intento login
                $saveIntento = $bd->query("
                    INSERT INTO bit_intentos_login (remoteIp, forwardIp, tipoIntento, carnet, fhIntento, navegador)
                    VALUES('$remoteIp','$forwardIp','Usuario','$post_carnet','$fhActual','$navegador')
                ") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));

                if($intentosLogin == 4) {
                    // Al 4to intento, mostrar aviso que el siguiente intento bloqueará sus credenciales
                    echo "no-aprobado/El próximo intento fallido suspenderá sus credenciales, asegúrese de ingresar correctamente la información";
                } else if($intentosLogin == 5) { // Al llegar al 5to intento, cambiar el estado de sus credenciales
                    $updateEstadoCredencial = $bd->query("
                        UPDATE credenciales SET estadoCredencial = 'Suspendido'
                        WHERE credencialId='$credencialId'
                    ") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
                    echo "no-aprobado/Sus credenciales han sido suspendidas por alcanzar el límite de intentos fallidos";
                } else { // La contraseña no coincide, solo mostrar mensajes
                    echo "no-aprobado/Credenciales incorrectas, por favor verifique la información ingresada";
                }
            }
        }
    } else {
    	$_SESSION["intentosLogin"] += 1;
        // No existe el carnet que se ingresó, registrar bitácora
	    $saveIntento = $bd->query("
	        INSERT INTO bit_intentos_login (remoteIp, forwardIp, tipoIntento, carnet, fhIntento, navegador)
	        VALUES('$remoteIp','$forwardIp','Externo','$post_carnet','$fhActual','$navegador')
	    ") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));

	    if($_SESSION["intentosLogin"] > 5) { // Al pasarse de 5 intentos, se bloqueará la pantalla de inicio de sesión
	    	echo "bloqueado/Credenciales incorrectas, por favor veriofique la información ingresada";
	    } else {
	    	echo "no-aprobado/Credenciales incorrectas, por favor verifique la información ingresada";
	    }
    }
?>