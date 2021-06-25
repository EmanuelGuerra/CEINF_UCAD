<?php 
    @session_start();
    require_once '../../../../librerias/contenido/logica/conexion.php';
?>
<h3>Intentos de acceso desde <?php echo date("d/m/Y H:i:s", strtotime($_POST["fhInicio"])); ?> hasta <?php echo date("d/m/Y H:i:s", strtotime($_POST["fhFin"])); ?></h3>
<hr>
<table id="tblIntentosAcceso" class="table table-hover" style="width: 100%;">
    <thead>
        <tr id="filterboxrow-intentos">
            <th>#</th>
            <th>Información</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#tblIntentosAcceso thead tr#filterboxrow-intentos th').each(function(index) {
            if(index==1) {
                var title = $('#tblIntentosAcceso thead tr#filterboxrow-intentos th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="intentos-input' + $(this).index() + '" type="text" class="form-control" placeholder="Buscar..." />');
                $(this).on('keyup change', function() {
                    tblIntentosAcceso.column($(this).index()).search($('#intentos-input' + $(this).index()).val()).draw();
                });
            } else {
                var title = $('#tblIntentosAcceso thead tr#filterboxrow-intentos th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="intentos-input' + $(this).index() + '" type="text" class="form-control" disabled />');
            }
        });

        let tblIntentosAcceso = $('#tblIntentosAcceso').DataTable({
            "dom": 'lrtip',
            "ajax": {
                "type": "POST",
                "url": "tables/tableIntentosAcceso",
                "data": {
                    "fhInicio": '<?php echo $_POST["fhInicio"]; ?>',
                    "fhFin": '<?php echo $_POST["fhFin"]; ?>'
                }
            },
            "columns": [
                {"width": "7%"},
                null
            ],
            "columnDefs": [
                { "orderable": false, "targets": [1] }
            ],
            "language": {
                "url": "../../../librerias/js/spanish_dt.json"
            }
        });
    });
</script>