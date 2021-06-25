<?php 
    @session_start();
    require_once '../../../../librerias/contenido/logica/conexion.php';

    // variables = rolId ^ nombreRol

    $arrayId = explode("^", $_POST["variables"]);
    $rolId = $arrayId[0];
?>
<form id="frmModal">
    <input type="hidden" id="rolId" name="rolId" value="<?php echo $rolId; ?>">
    <div class="modal fade" id="modal" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Asignación de Permisos - Rol: <?php echo $arrayId[1]; ?></h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3 offset-lg-9">
                            <button type="button" id="btnNuevoPermiso" class="btn btn-primary btn-block" onclick="mostrarAddPermiso(1);">
                                <i class="fa fa-plus"></i> Nuevo Permiso
                            </button>
                        </div>
                    </div>
                    <div class="row" id="divAddModulo">
                        <div class="col-lg-4 mb-4">
                            <select name="moduloId" id="moduloId" class="form-control has-feedback-left" onchange="validarMenusModulo();" required>
                                <option value="0" selected disabled>Módulo</option>
                                <?php 
                                    $queryModulos = $bd->query("
                                        SELECT
                                            moduloId,
                                            nombreModulo
                                        FROM modulos
                                        WHERE flgEliminado = '0'
                                    ");
                                    while($getModulos = $queryModulos->fetch_assoc()) {
                                        echo '<option value="'.$getModulos["moduloId"].'">'.$getModulos["nombreModulo"].'</option>';
                                    }
                                ?>
                            </select>
                            <span class="fa fa-folder-open form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div id="divModulosMenu" class="col-lg-4">
                            <select name="menuId" id="menuId" class="form-control has-feedback-left" required>
                                <option value="0" selected disabled>Seleccione Módulo</option>
                            </select>
                            <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fa fa-floppy-o"></i> Guardar
                            </button>
                        </div>
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-secondary btn-block" onclick="mostrarAddPermiso(0);">
                                <i class="fa fa-times-circle"></i> Cancelar
                            </button>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive" id="divtblPermisos">
                        <table id="tblPermisos" class="table table-hover" style="width:100%">
                            <thead>
                                <tr id="filterboxrow-permisos">
                                    <th>N°</th>
                                    <th>Módulo</th>
                                    <th>Menú</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                      <i class="fas fa-sign-out-alt"></i> Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    function validarMenusModulo() {
        $.post(
            "divs/divModulosMenu", 
            $.param({moduloId: $("#moduloId").val()}), 
            function(data) {
                $("#divModulosMenu").html(data);
            }
        );  
    }

    function eliminarPermiso(id, menu, rol) {
        alertify.set({ buttonReverse: true, labels: { ok: "Aceptar", cancel: "Cancelar" }  });
        alertify.confirm("¿Está seguro que desea eliminar el permiso del menú " + menu + "?", function (e) {
            if(e) {
                $.post(
                    "logica/delete?case=eliminar-permisos-menu", 
                    $.param({permisoRolId: id, menu: menu, rol: rol}), 
                    function(data) {
                        if(data == "completado") {
                            alertify.alert("El permiso del menú " + menu + " ha sido eliminado con éxito", function(){
                                $('#tblPermisos').DataTable().ajax.reload();
                                $('#tblRoles').DataTable().ajax.reload();
                            });
                        } else {
                            alertify.set({labels: {ok: "Aceptar"}});
                            alertify.alert(data);  
                        }
                    }
                );
            } else {
            }
        });
    }

    function mostrarAddPermiso(flg) {
        if(flg==1) {
            $("#btnNuevoPermiso").toggle(false);
            $('#divAddModulo').toggle(true);
        } else {
            // cancelar o ya se agregó y se va a ocultar
            $("#btnNuevoPermiso").toggle(true);
            $('#divAddModulo').toggle(false);
            $("#moduloId").val('0'); // reset select
            validarMenusModulo();
        }
    }

    $(document).ready(function() {
        $('#divAddModulo').toggle(false);

        $("#frmModal").validate({
            submitHandler: function(form) {
                $.post(
                    "logica/insert?case=nuevo-permiso-menu", 
                    $.param($("#frmModal").serializeArray()), 
                    function(data) {
                        if(data == "completado") {
                            alertify.alert("Permiso agregado con éxito.", function(){
                                $('#tblPermisos').DataTable().ajax.reload();
                                $('#tblRoles').DataTable().ajax.reload();
                                mostrarAddPermiso(0);
                            });
                        } else {
                            alertify.set({labels: {ok: "Aceptar"}});
                            alertify.alert(data);  
                        }
                    }
                );  
            }
        });

        $('#tblPermisos thead tr#filterboxrow-permisos th').each(function(index) {
            if(index==1 || index==2) {
                var title = $('#tblPermisos thead tr#filterboxrow-permisos th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="input' + $(this).index() + '-permisos" type="text" class="form-control" placeholder="Buscar..." />');
                $(this).on('keyup change', function() {
                    tblPermisos.column($(this).index()).search($('#input' + $(this).index() + '-permisos').val()).draw();
                });
            } else {
                var title = $('#tblPermisos thead tr#filterboxrow-permisos th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="input' + $(this).index() + '-permisos" type="text" class="form-control" disabled />');
            }
        });

        let tblPermisos = $('#tblPermisos').DataTable({
            "dom": 'lrtip',
            "ajax": {
                "type": "POST",
                "url": "tables/tablePermisosMenu",
                "data": {
                    "id": '<?php echo $arrayId[0]; ?>'
                }
            },
            "columns": [
                {"width": "10%"},
                null,
                null,
                {"width": "10%"}
            ],
            "columnDefs": [
                { "orderable": false, "targets": [1,2,3] }
            ],
            "language": {
                "url": "../../../librerias/js/spanish_dt.json"
            }
        });
    });
</script>