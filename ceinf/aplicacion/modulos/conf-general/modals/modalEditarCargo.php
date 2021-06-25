<?php 
    @session_start();
    require_once '../../../../librerias/contenido/logica/conexion.php';
    // variables = unicamente viene cargoId

    $sqlDatosCargo = $bd->query("
        SELECT
            nombreCargo
        FROM cargos
        WHERE cargoId = '$_POST[variables]'
    ");
    $getDatosCargo = $sqlDatosCargo->fetch_assoc();
?>
<form id="frmModal">
    <input type="hidden" id="cargoId" name="cargoId" value="<?php echo $_POST['variables']; ?>">
    <div class="modal fade" id="modal" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Cargo: <?php echo $getDatosCargo["nombreCargo"]; ?></h5>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-lg-12 mb-4">
                            <input type="text" name="nombreCargo" id="nombreCargo" class="form-control has-feedback-left" placeholder="Cargo" value="<?php echo $getDatosCargo['nombreCargo']; ?>" required>
                            <span class="fa fa-briefcase form-control-feedback left" aria-hidden="true"></span>
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
                    "logica/update?case=editar-cargo", 
                    $.param($("#frmModal").serializeArray()), 
                    function(data) {
                        if(data == "completado") {
                            alertify.alert("Cargo actualizado con éxito.", function(){
                                $('#tblCargos').DataTable().ajax.reload();
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