<?php 
    // dependenciaId ^ unidadMilitarId ^ nombreUnidadMilitar ^ nombreDependencia
    $arrayId = explode("^", $_POST["id"]);
    $dependenciaId = $arrayId[0];
    $unidadMilitarId = $arrayId[1];
?>
<h3><?php echo $arrayId[2] . " / " . $arrayId[3] . " / Subdependencias"; ?></h3>
<hr>
<div class="row mb-5">
    <div class="col-lg-3">
        <button type="button" class="btn btn-secondary btn-block" onclick="changePage('<?php echo $unidadMilitarId; ?>^<?php echo $arrayId[2]; ?>', 'dependencias');">
            <i class="fa fa-chevron-circle-left"></i> Dependencias
        </button>
    </div>
    <div class="col-lg-3 offset-lg-6">
        <button type="button" id="btnAddSubdependencia" class="btn btn-primary btn-block">
            <i class="fa fa-plus"></i> Nueva Subdependencia
        </button>
    </div>
</div>
<div class="table-responsive">
    <table id="tblSubdependencias" class="table table-hover" style="width: 100%;">
        <thead>
            <tr id="filterboxrow">
                <th>#</th>
                <th>Subdependencia</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<script>
    function formEditarSubdependencia(id) {
        loadModal(id, "modals/", "modalEditarSubdependencia");
    }

    $(document).ready(function() {
        $("#btnAddSubdependencia").click(function(e) {
            e.preventDefault();
            loadModal('<?php echo $dependenciaId; ?>', "modals/", "modalNuevaSubdependencia");
        });

        $('#tblSubdependencias thead tr#filterboxrow th').each(function(index) {
            if(index==1) {
                var title = $('#tblSubdependencias thead tr#filterboxrow th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="input' + $(this).index() + '" type="text" class="form-control" placeholder="Buscar..." />');
                $(this).on('keyup change', function() {
                    tblSubdependencias.column($(this).index()).search($('#input' + $(this).index()).val()).draw();
                });
            } else {
                var title = $('#tblSubdependencias thead tr#filterboxrow th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="input' + $(this).index() + '" type="text" class="form-control" disabled />');
            }
        });

        let tblSubdependencias = $('#tblSubdependencias').DataTable({
            "dom": 'lrtip',
            "ajax": {
                "type": "POST",
                "url": "tables/tableSubdependencias",
                "data": {
                    "id": '<?php echo $dependenciaId; ?>'
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