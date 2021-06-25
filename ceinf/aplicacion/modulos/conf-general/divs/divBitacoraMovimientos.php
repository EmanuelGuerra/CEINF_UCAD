<?php 
    @session_start();
    require_once '../../../../librerias/contenido/logica/conexion.php';

    $sqlNombreUsuario = $bd->query("
        SELECT
            CONCAT(
                IFNULL(apellido1, '-'),
                ' ',
                IFNULL(apellido2, '-'),
                ', ',
                IFNULL(nombre1, '-'),
                ' ',
                IFNULL(nombre2, '-')
            ) AS nombreUsuario
        FROM credenciales
        WHERE credencialId = '$_POST[credencialId]'
    ");
    $getNombreUsuario = $sqlNombreUsuario->fetch_assoc();
?>
<h3>Usuario: <?php echo $getNombreUsuario["nombreUsuario"]; ?><br>Movimientos desde <?php echo date("d/m/Y H:i:s", strtotime($_POST["fhInicio"])); ?> hasta <?php echo date("d/m/Y H:i:s", strtotime($_POST["fhFin"])); ?></h3>
<hr>
<table id="tblMovimientosEmp" class="table table-hover" style="width: 100%;">
    <thead>
        <tr id="filterboxrow">
            <th>#</th>
            <th>Información</th>
            <th>Movimientos</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#tblMovimientosEmp thead tr#filterboxrow th').each(function(index) {
            if(index==1 || index==2) {
                var title = $('#tblMovimientosEmp thead tr#filterboxrow th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="input' + $(this).index() + '" type="text" class="form-control" placeholder="Buscar..." />');
                $(this).on('keyup change', function() {
                    tblMovimientosEmp.column($(this).index()).search($('#input' + $(this).index()).val()).draw();
                });
            } else {
                var title = $('#tblMovimientosEmp thead tr#filterboxrow th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="input' + $(this).index() + '" type="text" class="form-control" disabled />');
            }
        });

        let tblMovimientosEmp = $('#tblMovimientosEmp').DataTable({
            "dom": 'lrtip',
            "ajax": {
                "type": "POST",
                "url": "tables/tableMovimientosEmp",
                "data": {
                    "credencialId": '<?php echo $_POST["credencialId"]; ?>',
                    "fhInicio": '<?php echo $_POST["fhInicio"]; ?>',
                    "fhFin": '<?php echo $_POST["fhFin"]; ?>'
                }
            },
            "columns": [
                {"width": "7%"},
                null,
                null
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