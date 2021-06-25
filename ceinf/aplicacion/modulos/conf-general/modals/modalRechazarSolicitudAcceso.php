<?php 
    @session_start();
    require_once '../../../../librerias/contenido/logica/conexion.php';
    // variables = solicitudAccesoId ^ apellidos, nombres
    $arrayVariables = explode("^", $_POST["variables"]);
?>
<form id="frmModal">
    <input type="hidden" id="solicitudAccesoId" name="solicitudAccesoId" value="<?php echo $arrayVariables[0]; ?>">
    <input type="hidden" id="nombreSolicitud" name="nombreSolicitud" value="<?php echo $arrayVariables[1]; ?>">
    <div class="modal fade" id="modal" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Rechazar Solicitud Acceso: <?php echo $arrayVariables[1]; ?></h5>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <textarea class="form-control" id="justificacionEstado" name="justificacionEstado" placeholder="Justificación/Motivo..." required></textarea>
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
    $(document).ready(function() {
        $("#frmModal").validate({
            submitHandler: function(form) {
                $.post(
                    "logica/update?case=rechazar-solicitud-acceso", 
                    $.param($("#frmModal").serializeArray()), 
                    function(data) {
                        if(data == "completado") {
                            alertify.alert("La solicitud de acceso de <?php echo $arrayVariables[1]; ?> ha sido rechazada con éxito.", function(){
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