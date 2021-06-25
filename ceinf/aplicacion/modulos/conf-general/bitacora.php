<?php 
    $verificarMenuPermiso = 4; // tabla menus
	$libreriasUrl = "../../../librerias/";
	$tituloPagina = "Bitácora - Conf. General";
	$historialNavegacion = "CEINF / Conf. General / Bitácora";
	$encabezadoVista = "Bitácora";
  	include($libreriasUrl."contenido/interfaz/header.php");
?>
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" class="active" href="#usuarios">Movimientos de Usuarios</a></li>
    <li><a data-toggle="tab" href="#intentos">Intentos de acceso</a></li>
</ul>
<div class="tab-content">
    <div id="usuarios" class="tab-pane fade in active show">
        <form id="frmBitacoraUsuarios">
            <br><br>
            <div class="row mb-4">
                <div class="col-lg-3 mb-4">
                    <select name="credencialId" id="credencialId" class="form-control has-feedback-left" required>
                        <option value="0" selected disabled>Usuario</option>
                        <?php 
                            $queryUsuarios = $bd->query("
                                SELECT
                                    credencialId,
                                    CONCAT(
                                        IFNULL(apellido1, '-'),
                                        ' ',
                                        IFNULL(apellido2, '-'),
                                        ', ',
                                        IFNULL(nombre1, '-'),
                                        ' ',
                                        IFNULL(nombre2, '-')
                                    ) AS nombreUsuario
                                FROM credenciales
                                WHERE flgEliminado = '0'
                            ");
                            while($getUsuarios = $queryUsuarios->fetch_assoc()) {
                                echo '<option value="'.$getUsuarios["credencialId"].'">'.$getUsuarios["nombreUsuario"].'</option>';
                            }
                        ?>
                    </select>
                    <span class="fa fa-user  form-control-feedback left" aria-hidden="true"></span>
                </div>
                <div class="col-lg-3 mb-4">
                    <input type="datetime-local" name="fhInicio" id="fhInicio" class="form-control has-feedback-left" value="<?php echo date('Y-m-d') . 'T00:00:00'; ?>" required>
                    <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                </div>
                <div class="col-lg-3 mb-4">
                    <input type="datetime-local" name="fhFin" id="fhFin" class="form-control has-feedback-left" value="<?php echo date('Y-m-d') . 'T'. date('H:i:s'); ?>" required>
                    <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                </div>
                <div class="col-lg-3 mb-4">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa fa-search"></i> Movimientos
                    </button>
                </div>
            </div>
            <div id="divBitacora" class="table-responsive">
            </div>
        </form>
    </div>
    <div id="intentos" class="tab-pane fade">
        <form id="frmBitacoraIntentos">
            <br><br>
            <div class="row mb-4">
                <div class="col-lg-4 mb-4">
                    <input type="datetime-local" name="fhInicioIntento" id="fhInicioIntento" class="form-control has-feedback-left" value="<?php echo date('Y-m-d') . 'T00:00:00'; ?>" required>
                    <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                </div>
                <div class="col-lg-4 mb-4">
                    <input type="datetime-local" name="fhFinIntento" id="fhFinIntento" class="form-control has-feedback-left" value="<?php echo date('Y-m-d') . 'T'. date('H:i:s'); ?>" required>
                    <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                </div>
                <div class="col-lg-4 mb-4">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa fa-search"></i> Movimientos
                    </button>
                </div>
            </div>
            <div id="divBitacoraIntentos" class="table-responsive">
            </div>
        </form>
    </div>
</div>
<script>
    function compararFechas(inicio, fin) {
        let fechaInicio = new Date($("#"+inicio).val());
        let fechaFin = new Date($("#"+fin).val()); 
        if(fechaInicio > fechaFin) {
            return 1;
        } else {
            return 0;
        }
    }

    $(document).ready(function() {
        $("#frmBitacoraUsuarios").validate({
            submitHandler: function(form) {
                if(compararFechas('fhInicio', 'fhFin') == 0) {
                    $.post(
                        "divs/divBitacoraMovimientos", 
                        $.param({credencialId: $("#credencialId").val(), fhInicio: $("#fhInicio").val(), fhFin: $("#fhFin").val()}), 
                        function(data) {
                            $("#divBitacora").html(data);
                        }
                    );
                } else {
                    alertify.set({labels: {ok: "Aceptar"}});
                    alertify.alert("La fecha de inicio debe ser menor o igual que la fecha fin");  
                    $("#fhFin").val("");
                }
            }
        });
        $("#frmBitacoraIntentos").validate({
            submitHandler: function(form) {
                if(compararFechas('fhInicioIntento', 'fhFinIntento') == 0) {
                    $.post(
                        "divs/divBitacoraIntentosAcceso", 
                        $.param({fhInicio: $("#fhInicioIntento").val(), fhFin: $("#fhFinIntento").val()}), 
                        function(data) {
                            $("#divBitacoraIntentos").html(data);
                        }
                    );
                } else {
                    alertify.set({labels: {ok: "Aceptar"}});
                    alertify.alert("La fecha de inicio debe ser menor o igual que la fecha fin");  
                    $("#fhFin").val("");
                }
            }
        });
    });
</script>
<?php 
  	include($libreriasUrl."contenido/interfaz/footer.php");
?>