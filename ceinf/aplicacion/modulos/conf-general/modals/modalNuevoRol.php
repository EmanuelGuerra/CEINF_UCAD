<?php 
    @session_start();
    require_once '../../../../librerias/contenido/logica/conexion.php';
?>
<form id="frmModal">
    <div class="modal fade" id="modal" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Rol</h5>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-lg-12 mb-4">
                            <input type="text" name="rol" id="rol" class="form-control has-feedback-left" placeholder="Rol" required>
                            <span class="fa fa-credit-card-alt form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>  
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                    	<i class="fa fa-floppy-o"></i> Guardar
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
                    "logica/insert?case=nuevo-rol", 
                    $.param($("#frmModal").serializeArray()), 
                    function(data) {
                        if(data == "completado") {
                            alertify.alert("Rol creado con éxito. Recuerde agregar sus permisos.", function(){
                                $('#tblRoles').DataTable().ajax.reload();
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