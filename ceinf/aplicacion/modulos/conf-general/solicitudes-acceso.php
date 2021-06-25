<?php 
    $verificarMenuPermiso = 3; // tabla menus
	$libreriasUrl = "../../../librerias/";
	$tituloPagina = "Solicitudes de Acceso - Conf. General";
	$historialNavegacion = "CEINF / Conf. General / Gestión de Usuarios / Solicitudes de Acceso";
	$encabezadoVista = "Solicitudes de Acceso";
  	include($libreriasUrl."contenido/interfaz/header.php");
?>
<div class="row">
	<div class="col-lg-3 offset-lg-6">
		<button type="button" class="btn btn-success btn-block" onclick="formHistorialSolicitudes('Autorizada');">
			<i class="fa fa-check-circle"></i> Autorizadas
		</button>
	</div>
	<div class="col-lg-3">
		<button type="button" class="btn btn-danger btn-block" onclick="formHistorialSolicitudes('Rechazada');">
			<i class="fa fa-times-circle"></i> Rechazadas
		</button>
	</div>
</div>
<div class="table-responsive">
	<table id="tblSolicitudes" class="table table-hover" style="width: 100%;">
		<thead>
			<tr id="filterboxrow">
				<th>#</th>
				<th>Empleado</th>
				<th>F/H Solicitud</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script>
    function formHistorialSolicitudes(estadoSolicitud) {
        loadModal(estadoSolicitud, "modals/", 'modalHistorialSolicitudesAcceso');
    }

	function formProcesarSolicitud(tipo, tableData) {
		if(tipo == "aprobar") {
			loadModal(tableData, "modals/", 'modalAprobarSolicitudAcceso');
		} else {
			loadModal(tableData, "modals/", 'modalRechazarSolicitudAcceso');
		}
	}

    $(document).ready(function() {
        $('#tblSolicitudes thead tr#filterboxrow th').each(function(index) {
            if(index==1 || index==2) {
                var title = $('#tblSolicitudes thead tr#filterboxrow th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="input' + $(this).index() + '" type="text" class="form-control" placeholder="Buscar..." />');
                $(this).on('keyup change', function() {
                    tblSolicitudes.column($(this).index()).search($('#input' + $(this).index()).val()).draw();
                });
            } else {
                var title = $('#tblSolicitudes thead tr#filterboxrow th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="input' + $(this).index() + '" type="text" class="form-control" disabled />');
            }
        });

        let tblSolicitudes = $('#tblSolicitudes').DataTable({
            "dom": 'lrtip',
            "ajax": {
                "type": "POST",
                "url": "tables/tableSolicitudesAcceso",
                "data": {
                    "id": ''
                }
            },
            "columns": [
                {"width": "7%"},
                null,
                null,
                {"width": "20%"}
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
<?php 
  	include($libreriasUrl."contenido/interfaz/footer.php");
?>