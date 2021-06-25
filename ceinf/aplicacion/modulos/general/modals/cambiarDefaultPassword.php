<?php 
    @session_start();
    require_once '../../../../librerias/contenido/logica/conexion.php';
?>
<form id="frmModal">
    <div class="modal fade" id="modal" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cambiar Contraseña - <?php echo $_SESSION["nombrePersona"]; ?></h5>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <p align="justify">Estimado <?php echo $_SESSION["nombrePersona"]; ?>, por motivos de seguridad en la plataforma, solicitamos que cambie su contraseña por una distinta a la que se le brindó. Mientras no realice dicha acción no podrá realizar ningún movimiento dentro de la plataforma.</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-6">
			              	<input type="password" name="passwordNueva" id="passwordNueva" class="form-control has-feedback-left" placeholder="Contraseña nueva" data-rule-minlength="4" required>
                            <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
                        </div>                
                    
                        <div class="col-lg-6">
			              	<input type="password" name="passwordNueva2" id="passwordNueva2" class="form-control has-feedback-left" placeholder="Repetir contraseña" data-rule-equalTo="#passwordNueva" required>      
                            <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span> 
                        </div> 
                    </div>                 
                    <div class="row" onclick="mostrarPassword();">
                        <div class="col-lg-12">
                        	<div class="form-check">
								<label for="show2" class="form-check-label" style="cursor: pointer;">
									<input type="checkbox" class="form-check-input" id="show2"> 
									<span class="fa fa-eye"></span> Mostrar contraseñas
									</label>
							</div>
                        </div>
                    </div>                             
                </div>  
                <div class="modal-footer" id="verificarCambios">
                    <button type="submit" class="btn btn-primary">
                    	<i class="fa fa-retweet"></i> Cambiar Contraseña
                    </button>
                    <a href="../librerias/contenido/logica/cerrarSesion" class="btn btn-secondary">
                    	<i class="fa fa-sign-out"></i> Cerrar sesión
                    </a>
                </div>  
            </div>
        </div>
    </div>  
</form>
<script>
    function mostrarPassword() {
        if($('#show2').is(':checked')) {
            $('#passwordNueva').prop('type','text');
            $('#passwordNueva2').prop('type','text');
        } else {
            $('#passwordNueva').prop('type','password');
            $('#passwordNueva2').prop('type','password');
        }
    }

    $("#frmModal").validate({
        messages: {
            passwordNueva2: {
                equalTo: "Las contraseñas deben coincidir"
            }
        },
        submitHandler: function(form) {
            $.post(
                "modulos/general/logica/update?case=default-password", 
                $.param($("#frmModal").serializeArray()), 
                function(data) {
                    if(data == "completado") {
                        alertify.alert("Su contraseña ha sido actualizada con éxito, por favor vuelva a iniciar sesión utilizando su nueva contraseña.", function(){
                            location.href = '../librerias/contenido/logica/cerrarSesion';
                        });
                    } else {
                        alertify.set({labels: {ok: "Aceptar"}});
                        alertify.alert(data);  
                    }
                }
            );  
        }
    });
</script>