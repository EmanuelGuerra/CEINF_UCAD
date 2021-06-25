<?php 
    @session_start();
    require_once '../../../../librerias/contenido/logica/conexion.php';

    // variables = dependenciaId
?>
<form id="frmModal">
    <input type="hidden" id="dependenciaId" name="dependenciaId" value="<?php echo $_POST['variables']; ?>">
    <div class="modal fade" id="modal" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nueva Subdependencia</h5>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-lg-8 mb-4">
                            <input type="text" name="nombreSubdependencia" id="nombreSubdependencia" class="form-control has-feedback-left" placeholder="Subdependencia" required>
                            <span class="fa fa-building form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <input type="text" name="abreviatura" id="abreviatura" class="form-control has-feedback-left" placeholder="Abreviatura" required>
                            <span class="fa fa-tag form-control-feedback left" aria-hidden="true"></span>
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
                    "logica/insert?case=nueva-subdependencia", 
                    $.param($("#frmModal").serializeArray()), 
                    function(data) {
                        if(data == "completado") {
                            alertify.alert("Subdependencia creada con éxito.", function(){
                                $('#tblSubdependencias').DataTable().ajax.reload();
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