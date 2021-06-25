<?php 
    @session_start();
    include("conexion.php");

    if(isset($_REQUEST["flg"])) { // Cerrar sesión por inactividad
        $fhActual = date("Y-m-d H:i:s");

        $cambiarEstadoCredencial = $bd->query("
            UPDATE credenciales SET 
                enLinea = 0
            WHERE credencialId = '$_SESSION[credencialId]'
        ");

        $bitacora = '('.$fhActual.') Sesión finalizada por inactividad.';

        $actualizarBitacora = $bd->query("
            UPDATE bit_credenciales SET
                fhLogout = '$fhActual',
                movimientos = CONCAT(movimientos, '$bitacora')
            WHERE bitCredencialId = '$_SESSION[bitCredencialId]'
        ");

        unset ($SESSION["credencialId"]);
        session_destroy();
        session_start();

        $_SESSION["flgInactivo"] = 1;

        header("Location: /ceinf/inactividad");
    } else { // Cierre dde sesión manual
        $fhActual = date("Y-m-d H:i:s");
        $bitacora = '('.$fhActual.') Cerró sesión.';

        $cambiarEstadoCredencial = $bd->query("
            UPDATE credenciales SET 
                enLinea = 0
            WHERE credencialId = '$_SESSION[credencialId]'
        ");
        
        $actualizarBitacora = $bd->query("
            UPDATE bit_credenciales SET
                fhLogout = '$fhActual',
                movimientos = CONCAT(movimientos, '$bitacora')
            WHERE bitCredencialId = '$_SESSION[bitCredencialId]'
        ");

        unset ($SESSION["credencialId"]);
        session_destroy();
        session_start();

        $_SESSION["flgInactivo"] = 0;

        header("Location: /ceinf/");
    }
?>