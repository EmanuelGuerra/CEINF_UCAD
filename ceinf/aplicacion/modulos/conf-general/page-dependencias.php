<?php 
    // unidadMilitarId ^ nombreUnidadMilitar
    $arrayId = explode("^", $_POST["id"]);
    $unidadMilitarId = $arrayId[0];
?>
<h3><?php echo $arrayId[1]; ?> / Dependencias</h3>
<hr>
<div class="row mb-5">
    <div class="col-lg-3">
        <button type="button" class="btn btn-secondary btn-block" onclick="changePage('', 'unidades-militares');">
            <i class="fa fa-chevron-circle-left"></i> Unidades Militares
        </button>
    </div>
    <div class="col-lg-3 offset-lg-6">
        <button type="button" id="btnAddDependencia" class="btn btn-primary btn-block">
            <i class="fa fa-plus"></i> Nueva Dependencia
        </button>
    </div>
</div>
<div class="table-responsive">
    <table id="tblDependencias" class="table table-hover" style="width: 100%;">
        <thead>
            <tr id="filterboxrow">
                <th>#</th>
                <th>Dependencia</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<script>
    function formEditarDependencia(id) {
        loadModal(id, "modals/", "modalEditarDependencia");
    }

    function eliminarDependencia(id, nombreDependencia) {
        alertify.set({ buttonReverse: true, labels: { ok: "Aceptar", cancel: "Cancelar" }  });
        alertify.confirm("¿Está seguro que desea eliminar la dependencia " + nombreDependencia + "?", function (e) {
            if(e) {
                $.post(
                    "logica/delete?case=eliminar-dependencia", 
                    $.param({dependenciaId: id, nombreDependencia: nombreDependencia}), 
                    function(data) {
                        if(data == "completado") {
                            alertify.alert(nombreDependencia + " ha sido eliminada con éxito", function(){
                                $('#tblDependencias').DataTable().ajax.reload();
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

    $(document).ready(function() {
        $("#btnAddDependencia").click(function(e) {
            e.preventDefault();
            loadModal('<?php echo $unidadMilitarId; ?>', "modals/", "modalNuevaDependencia");
        });

        $('#tblDependencias thead tr#filterboxrow th').each(function(index) {
            if(index==1) {
                var title = $('#tblDependencias thead tr#filterboxrow th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="input' + $(this).index() + '" type="text" class="form-control" placeholder="Buscar..." />');
                $(this).on('keyup change', function() {
                    tblDependencias.column($(this).index()).search($('#input' + $(this).index()).val()).draw();
                });
            } else {
                var title = $('#tblDependencias thead tr#filterboxrow th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="input' + $(this).index() + '" type="text" class="form-control" disabled />');
            }
        });

        let tblDependencias = $('#tblDependencias').DataTable({
            "dom": 'lrtip',
            "ajax": {
                "type": "POST",
                "url": "tables/tableDependencias",
                "data": {
                    "id": '<?php echo $unidadMilitarId; ?>'
                }
            },
            "columns": [
                {"width": "7%"},
                null,
                {"width": "20%"}
            ],
            "columnDefs": [
                { "orderable": false, "targets": [1,2] }
            ],
            "language": {
                "url": "../../../librerias/js/spanish_dt.json"
            }
        });
    });
</script>