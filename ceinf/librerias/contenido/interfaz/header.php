<?php 
    @session_start(); 
    $fhActual = date("Y-m-d H:i:s");
    include($libreriasUrl."contenido/logica/conexion.php");

    if (isset($_SESSION["credencialId"])) {
        // Validar si ya cambió su contraseña por defecto
        if($_SESSION["flgPassword"] == "1" && basename($_SERVER['PHP_SELF']) != "index.php") {
            header("Location: /ceinf/aplicacion/");
        } else {
            if($_SESSION["flgInactivo"] == 0) {
            } else {
                header("Location: /ceinf/inactividad"); 
            }
        }
    } else {
        header("Location: /ceinf/"); 
    }

    $fhActual = date("Y-m-d H:i:s"); // EN CASO QUE EL MOVIMIENTO SEA DELICADO, CONCATENAR LA FECHA EN PARÉNTESIS

    $sqlVerificarPermisoAsignado = $bd->query("
        SELECT COUNT(permisoRolId) AS existe
        FROM roles_menus
        WHERE rolId = '$_SESSION[rolId]' AND menuId = '$verificarMenuPermiso' AND flgEliminado = '0'
    ");
    $getVerificarPermisoAsignado = $sqlVerificarPermisoAsignado->fetch_assoc();

    if($getVerificarPermisoAsignado["existe"] > 0 || $verificarMenuPermiso == "n/a") {
        // Tiene permiso
        // Registrar en bitacora a que página ingresó
        $bitacora = "(".$fhActual.") Ingresó al menú: ".$tituloPagina.", ";
        $updateBitacora = $bd->query("
            UPDATE bit_credenciales SET
                movimientos = CONCAT(movimientos, '$bitacora')
            WHERE bitCredencialId = '$_SESSION[bitCredencialId]'
        ") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
    } else {
        // No tiene permisos e intento acceder, registrar en bitacora
        // Escribir en bitacora
        $bitacora = "(".$fhActual.") Intentó acceder al menú: ".$tituloPagina.", ";
        $updateBitacora = $bd->query("
            UPDATE bit_credenciales SET
                movimientos = CONCAT(movimientos, '$bitacora')
            WHERE bitCredencialId = '$_SESSION[bitCredencialId]'
        ") or die("Parece que algo salió mal, por favor intente nuevamente" . mysqli_error($bd));
        // redireccionar
        header("Location: /ceinf/aplicacion/");
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    	 <link rel="icon" href="<?php echo $libreriasUrl; ?>imagenes/favicon.ico" type="image/ico" />

        <title><?php echo $tituloPagina; ?></title>

        <!-- Bootstrap -->
        <link href="<?php echo $libreriasUrl; ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $libreriasUrl; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo $libreriasUrl; ?>css/custom.min.css" rel="stylesheet">
        <link href="<?php echo $libreriasUrl; ?>alertify/themes/alertify.core.css" rel="stylesheet">
        <link href="<?php echo $libreriasUrl; ?>alertify/themes/alertify.default.css" rel="stylesheet">
        <link href="<?php echo $libreriasUrl; ?>css/datatables.min.css" rel="stylesheet">
        <link href="<?php echo $libreriasUrl; ?>css/select2.min.css" rel="stylesheet">
        <script src="<?php echo $libreriasUrl; ?>jquery/dist/jquery.min.js"></script>
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <?php 
                    include("barra-lateral.php"); 
                    include("barra-superior.php");
                ?>
                <div class="page-title">
                    <div class="title_left">
                        <h5><?php echo $historialNavegacion; ?></h5>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12  ">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2><?php echo $encabezadoVista; ?></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">