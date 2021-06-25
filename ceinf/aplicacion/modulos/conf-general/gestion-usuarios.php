<?php 
    $verificarMenuPermiso = 2; // tabla menus
	$libreriasUrl = "../../../librerias/";
	$tituloPagina = "Usuarios - Conf. General";
	$historialNavegacion = "CEINF / Conf. General / Gestión de Usuarios / Usuarios";
	$encabezadoVista = "Usuarios";
  	include($libreriasUrl."contenido/interfaz/header.php");
?>
<div class="row">
	<div class="col-lg-3 offset-lg-9">
		<button type="button" id="btnAddUsuario" class="btn btn-primary btn-block">
			<i class="fa fa-plus"></i> Nuevo Usuario
		</button>
	</div>
</div>
<div class="table-responsive">
	<table id="tblUsuarios" class="table table-hover" style="width: 100%;">
		<thead>
			<tr id="filterboxrow">
				<th>#</th>
				<th>Usuario</th>
				<th>Estado</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<script>
    function formEditarUsuario(id) {
        loadModal(id, "modals/", "modalEditarUsuario");
    }

    function cambiarEstadoUsuario(id, estado, usuario) {
        alertify.set({ buttonReverse: true, labels: { ok: "Aceptar", cancel: "Cancelar" }  });
        alertify.confirm("¿Está seguro que desea " + estado + " las credenciales de " + usuario + "?", function (e) {
            if(e) {
                $.post(
                    "logica/update?case=estado-usuario", 
                    $.param({credencialId: id, estado: estado}), 
                    function(data) {
                        if(data == "completado") {
                            let txt = (estado == "activar") ? "Se restableció a la contraseña por defecto." : "Las credenciales fueron desactivadas, por lo que no podrá iniciar sesión.";
                            alertify.alert("Estado actualizado con éxito. " + txt, function(){
                                $('#tblUsuarios').DataTable().ajax.reload();
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
        $("#btnAddUsuario").click(function(e) {
            e.preventDefault();
            loadModal('', "modals/", "modalNuevoUsuario");
        });

        $('#tblUsuarios thead tr#filterboxrow th').each(function(index) {
            if(index==1 || index==2) {
                var title = $('#tblUsuarios thead tr#filterboxrow th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="input' + $(this).index() + '" type="text" class="form-control" placeholder="Buscar..." />');
                $(this).on('keyup change', function() {
                    tblUsuarios.column($(this).index()).search($('#input' + $(this).index()).val()).draw();
                });
            } else {
                var title = $('#tblUsuarios thead tr#filterboxrow th').eq($(this).index()).text();
                $(this).html(title+'<br/><input id="input' + $(this).index() + '" type="text" class="form-control" disabled />');
            }
        });

        let tblUsuarios = $('#tblUsuarios').DataTable({
            "dom": 'lrtip',
            "ajax": {
                "type": "POST",
                "url": "tables/tableUsuarios",
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