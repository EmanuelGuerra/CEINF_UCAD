<?php 
    $verificarMenuPermiso = 9; // tabla menus
	$libreriasUrl = "../../../librerias/";
	$tituloPagina = "Cargos - Conf. General";
	$historialNavegacion = "Conf. General / Catálogos / Cargos";
	$encabezadoVista = "Cargos";
  	include($libreriasUrl."contenido/interfaz/header.php");
?>
<div class="row">
    <div class="col-lg-3 offset-lg-9">
        <button type="button" id="btnAddCargo" class="btn btn-primary btn-block">
            <i class="fa fa-plus"></i> Nuevo Cargo
    </div>
</div>
<div class="table-responsive">
    <table id="tblCargos" class="table table-hover" style="width: 100%;">
        <thead>
            <tr id="filterboxrow">
                <th>#</th>
                <th>Cargo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<script>
    function formEditarCargo(id) {
        loadModal(id, "modals/", "modalEditarCargo");
    }

    function eliminarCargo(id, nombreCargo) {
        alertify.set({ buttonReverse: true, labels: { ok: "Aceptar", cancel: "Cancelar" }  });
        alertify.confirm("¿Está seguro que desea eliminar el cargo " + nombreCargo + "?", function (e) {
            if(e) {
                $.post(
                    "logica/delete?case=eliminar-cargo", 
                    $.param({cargoId: id, nombreCargo: nombreCargo}), 
                    function(data) {
                        if(data == "completado") {
                            alertify.alert(nombreCargo + " ha sido eliminada con éxito", function(){
                                $('#tblCargos').DataTable().ajax.reload();
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
        $("#btnAddCargo").click(function(e) {
            e.preventDefault();
            loadModal('', "modals/", "modalNuevoCargo");
        });

        $('#tblCargos thead tr#filterboxrow th').each(function(index) {
            if(index==1) {
                var title = $('#tblCargos thead tr#filterboxrow th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="input' + $(this).index() + '" type="text" class="form-control" placeholder="Buscar..." />');
                $(this).on('keyup change', function() {
                    tblCargos.column($(this).index()).search($('#input' + $(this).index()).val()).draw();
                });
            } else {
                var title = $('#tblCargos thead tr#filterboxrow th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="input' + $(this).index() + '" type="text" class="form-control" disabled />');
            }
        });

        let tblCargos = $('#tblCargos').DataTable({
            "dom": 'lrtip',
            "ajax": {
                "type": "POST",
                "url": "tables/tableCargos",
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
<?php 
  	include($libreriasUrl."contenido/interfaz/footer.php");
?>