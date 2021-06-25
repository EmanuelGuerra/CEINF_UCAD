<h3>Unidades Militares</h3>
<hr>
<div class="row">
	<div class="col-lg-3 offset-lg-9">
		<button type="button" id="btnAddUnidad" class="btn btn-primary btn-block">
			<i class="fa fa-plus"></i> Nueva Unidad Militar
		</button>
	</div>
</div>
<div class="table-responsive">
	<table id="tblUnidadesMilitares" class="table table-hover" style="width: 100%;">
		<thead>
			<tr id="filterboxrow">
				<th>#</th>
				<th>Unidad Militar</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script>
    function formEditarUnidadMilitar(id) {
        loadModal(id, "modals/", "modalEditarUnidadMilitar");
    }

    function eliminarUnidadMilitar(id, nombreUnidad) {
        alertify.set({ buttonReverse: true, labels: { ok: "Aceptar", cancel: "Cancelar" }  });
        alertify.confirm("¿Está seguro que desea eliminar la unidad militar " + nombreUnidad + "?", function (e) {
            if(e) {
                $.post(
                    "logica/delete?case=eliminar-unidad-militar", 
                    $.param({unidadMilitarId: id, nombreUnidad: nombreUnidad}), 
                    function(data) {
                        if(data == "completado") {
                            alertify.alert(nombreUnidad + " ha sido eliminada con éxito", function(){
                                $('#tblUnidadesMilitares').DataTable().ajax.reload();
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
        $("#btnAddUnidad").click(function(e) {
            e.preventDefault();
            loadModal('', "modals/", "modalNuevaUnidadMilitar");
        });

        $('#tblUnidadesMilitares thead tr#filterboxrow th').each(function(index) {
            if(index==1) {
                var title = $('#tblUnidadesMilitares thead tr#filterboxrow th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="input' + $(this).index() + '" type="text" class="form-control" placeholder="Buscar..." />');
                $(this).on('keyup change', function() {
                    tblUnidadesMilitares.column($(this).index()).search($('#input' + $(this).index()).val()).draw();
                });
            } else {
                var title = $('#tblUnidadesMilitares thead tr#filterboxrow th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="input' + $(this).index() + '" type="text" class="form-control" disabled />');
            }
        });

        let tblUnidadesMilitares = $('#tblUnidadesMilitares').DataTable({
            "dom": 'lrtip',
            "ajax": {
                "type": "POST",
                "url": "tables/tableUnidadesMilitares",
                "data": {
                    "id": ''
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