<?php 
    @session_start();
    require_once '../../../../librerias/contenido/logica/conexion.php';
    // variables = solicitudAccesoId ^ apellidos, nombres
    $arrayVariables = explode("^", $_POST["variables"]);

    $queryDatosSolicitud = $bd->query("
        SELECT
            carnet, 
            cargo, 
            departamento
        FROM solicitudes_acceso
        WHERE solicitudAccesoId = '$arrayVariables[0]'
    ");
    $getDatosSolicitud = $queryDatosSolicitud->fetch_assoc();

    //   subdependenciaId
?>
<form id="frmModal">
    <input type="hidden" id="solicitudAccesoId" name="solicitudAccesoId" value="<?php echo $arrayVariables[0]; ?>">
    <div class="modal fade" id="modal" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Aprobar Solicitud Acceso: <?php echo $arrayVariables[1]; ?></h5>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-lg-6 mb-4">
                            <input type="text" name="nombre1" id="nombre1" class="form-control has-feedback-left" placeholder="Nombre 1" required>
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <input type="text" name="nombre2" id="nombre2" class="form-control has-feedback-left" placeholder="Nombre 2">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-6 mb-4">
                            <input type="text" name="apellido1" id="apellido1" class="form-control has-feedback-left" placeholder="Ap. Paterno" required>
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <input type="text" name="apellido2" id="apellido2" class="form-control has-feedback-left" placeholder="Ap. Materno">
                            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-6 mb-4">
                            <input type="date" name="fechaNacimiento" id="fechaNacimiento" class="form-control has-feedback-left" required>
                            <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <select name="cargoId" id="cargoId" class="form-control has-feedback-left" required>
                                <option value="0" selected disabled>Cargo</option>
                                <?php 
                                    $queryCargos = $bd->query("
                                        SELECT
                                            cargoId,
                                            nombreCargo
                                        FROM cargos
                                        WHERE flgEliminado = '0'
                                    ");
                                    while($getCargos = $queryCargos->fetch_assoc()) {
                                        echo '<option value="'.$getCargos["cargoId"].'">'.$getCargos["nombreCargo"].'</option>';
                                    }
                                ?>
                            </select>
                            <span class="fa fa-briefcase  form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-6 mb-4">
                            <input type="text" name="carnet" id="carnet" class="form-control has-feedback-left" placeholder="Carnet" value="<?php echo $getDatosSolicitud['carnet']; ?>" required>
                            <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <select name="rolId" id="rolId" class="form-control has-feedback-left" required>
                                <option value="0" selected disabled>Rol</option>
                                <?php 
                                    $queryRoles = $bd->query("
                                        SELECT
                                            rolId,
                                            rol
                                        FROM roles
                                        WHERE flgEliminado = '0'
                                    ");
                                    while($getRoles = $queryRoles->fetch_assoc()) {
                                        echo '<option value="'.$getRoles["rolId"].'">'.$getRoles["rol"].'</option>';
                                    }
                                ?>
                            </select>
                            <span class="fa fa-list-alt  form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-lg-6 mb-4">
                            <select name="dependenciaId" id="dependenciaId" class="form-control has-feedback-left" onchange="cargarSubdependencias();" required>
                                <option value="0" selected disabled>Dependencia</option>
                                <?php 
                                    $queryDependencias = $bd->query("
                                        SELECT
                                            um.unidadMilitarId AS unidadMilitarId,
                                            um.nombreUnidadMilitar AS nombreUnidadMilitar,
                                            um.abreviatura AS abreviaturaUM,
                                            dep.dependenciaId AS dependenciaId,
                                            dep.abreviatura AS abreviatura,
                                            dep.nombreDependencia AS nombreDependencia
                                        FROM dependencias dep
                                        JOIN unidades_militares um ON um.unidadMilitarId = dep.unidadMilitarId
                                        WHERE dep.flgEliminado = '0' AND um.flgEliminado = '0'
                                        ORDER BY dep.unidadMilitarId
                                    ");
                                    $anteriorUMId = 0; $flgCerrarGroup = 0;
                                    while($getDependencias = $queryDependencias->fetch_assoc()) {
                                        $unidadMilitarId = $getDependencias["unidadMilitarId"];

                                        if($anteriorUMId == 0 || $unidadMilitarId != $anteriorUMId) {
                                            echo '<optgroup label="('.$getDependencias["abreviaturaUM"].') '.$getDependencias["nombreUnidadMilitar"].'">';
                                        } else {
                                            $flgCerrarGroup = 1;
                                        }

                                        echo '<option value="'.$getDependencias["dependenciaId"].'">('.$getDependencias["abreviatura"].') '.$getDependencias["nombreDependencia"].'</option>';

                                        if($flgCerrarGroup == 1) {
                                            echo '</optgroup>';
                                            $flgCerrarGroup = 0;
                                        } else {
                                        }

                                        $anteriorUMId = $unidadMilitarId;
                                    }
                                ?>
                            </select>
                            <span class="fa fa-building  form-control-feedback left" aria-hidden="true"></span>                
                        </div>
                        <div id="divSubdependencia" class="col-lg-6 mb-4">
                            <select name="tempSubdependencia" id="tempSubdependencia" class="form-control has-feedback-left" required>
                                <option value="0" selected disabled>Subdependencia</option>
                                <option value="1" disabled>Seleccione Dependencia</option>
                            </select>
                            <span class="fa fa-building-o  form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>  
                <div class="modal-footer" id="verificarCambios">
                    <button type="submit" class="btn btn-primary">
                    	<i class="fa fa-floppy-o"></i> Procesar Solicitud
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                      <i class="fa fa-times-circle"></i> Cancelar
                    </button>
                </div>  
            </div>
        </div>
    </div>  
</form>
<script>
    function cargarSubdependencias() {
        $.post(
            "divs/divSubdependencias", 
            $.param($("#frmModal").serializeArray()), 
            function(data) {
                $("#divSubdependencia").html(data);
            }
        );  
    }

    $(document).ready(function() {
        $("#frmModal").validate({
            submitHandler: function(form) {
                $.post(
                    "logica/insert?case=aprobar-solicitud-acceso", 
                    $.param($("#frmModal").serializeArray()), 
                    function(data) {
                        if(data == "completado") {
                            alertify.alert("La solicitud de acceso de <?php echo $arrayVariables[1]; ?> ha sido aprobada con éxito. El empleado ya puede iniciar sesión.", function(){
                                $('#tblSolicitudes').DataTable().ajax.reload();
                                $('#modal').modal("hide");
                            });
                        } else {
                            alertify.set({labels: {ok: "Aceptar"}});
                            alertify.alert(data);  
                        }
                    }
                );  
            }
        });
    });
</script>