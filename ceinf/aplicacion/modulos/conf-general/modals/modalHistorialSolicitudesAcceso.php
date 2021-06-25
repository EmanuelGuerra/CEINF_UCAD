<?php 
    @session_start();
    require_once '../../../../librerias/contenido/logica/conexion.php';
    // variables = estadoSolicitud (Autorizada, Rechazada)
    $estadoSolicitud = $_POST["variables"];
?>
<form id="frmModal">
    <div class="modal fade" id="modal" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Historial de Solicitudes: <?php echo $estadoSolicitud . "s"; ?></h5>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="tblHistorial" class="table table-hover" style="width: 100%;">
                            <thead>
                                <tr id="filterboxrow-historial">
                                    <th>#</th>
                                    <th>Datos Solicitud</th>
                                    <th>F/H Solicitud</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>  
                <div class="modal-footer" id="verificarCambios">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                      <i class="fa fa-times-circle"></i> Cerrar
                    </button>
                </div>  
            </div>
        </div>
    </div>  
</form>
<script>
    $(document).ready(function() {
        $('#tblHistorial thead tr#filterboxrow-historial th').each(function(index) {
            if(index==1 || index==2) {
                var title = $('#tblHistorial thead tr#filterboxrow-historial th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="input' + $(this).index() + 'historial" type="text" class="form-control" placeholder="Buscar..." />');
                $(this).on('keyup change', function() {
                    tblHistorial.column($(this).index()).search($('#input' + $(this).index()).val()).draw();
                });
            } else {
                var title = $('#tblHistorial thead tr#filterboxrow-historial th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="input' + $(this).index() + 'historial" type="text" class="form-control" disabled />');
            }
        });

        let tblHistorial = $('#tblHistorial').DataTable({
            "dom": 'lrtip',
            "ajax": {
                "type": "POST",
                "url": "tables/tableHistorialSolicitudesAcceso",
                "data": {
                    "estadoSolicitud": '<?php echo $estadoSolicitud; ?>'
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