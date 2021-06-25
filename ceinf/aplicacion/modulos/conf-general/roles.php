<?php 
    $verificarMenuPermiso = 10; // tabla menus
	$libreriasUrl = "../../../librerias/";
	$tituloPagina = "Roles - Conf. General";
	$historialNavegacion = "CEINF / Conf. General / Gestión de Usuarios / Roles";
	$encabezadoVista = "Roles";
  	include($libreriasUrl."contenido/interfaz/header.php");
?>
<div class="row">
	<div class="col-lg-3 offset-lg-9">
		<button type="button" id="btnAddRol" class="btn btn-primary btn-block">
			<i class="fa fa-plus"></i> Nuevo Rol
		</button>
	</div>
</div>
<div class="table-responsive">
	<table id="tblRoles" class="table table-hover" style="width: 100%;">
		<thead>
			<tr id="filterboxrow">
				<th>#</th>
				<th>Rol</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script>
    function formEditarRol(id) {
        loadModal(id, "modals/", "modalEditarRol");
    }

    function formPermisos(id) {
        loadModal(id, "modals/", "modalPermisosMenu");
    }

    function eliminarRol(id, rol) {
        alertify.set({ buttonReverse: true, labels: { ok: "Aceptar", cancel: "Cancelar" }  });
        alertify.confirm("¿Está seguro que desea eliminar el rol " + rol + "?", function (e) {
            if(e) {
                $.post(
                    "logica/delete?case=eliminar-rol", 
                    $.param({rolId: id, rol: rol}), 
                    function(data) {
                        if(data == "completado") {
                            alertify.alert(rol + " ha sido eliminado con éxito", function(){
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

    $(document).ready(function() {
        $("#btnAddRol").click(function(e) {
            e.preventDefault();
            loadModal('', "modals/", "modalNuevoRol");
        });

        $('#tblRoles thead tr#filterboxrow th').each(function(index) {
            if(index==1 || index==2) {
                var title = $('#tblRoles thead tr#filterboxrow th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="input' + $(this).index() + '" type="text" class="form-control" placeholder="Buscar..." />');
                $(this).on('keyup change', function() {
                    tblRoles.column($(this).index()).search($('#input' + $(this).index()).val()).draw();
                });
            } else {
                var title = $('#tblRoles thead tr#filterboxrow th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="input' + $(this).index() + '" type="text" class="form-control" disabled />');
            }
        });

        let tblRoles = $('#tblRoles').DataTable({
            "dom": 'lrtip',
            "ajax": {
                "type": "POST",
                "url": "tables/tableRoles",
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