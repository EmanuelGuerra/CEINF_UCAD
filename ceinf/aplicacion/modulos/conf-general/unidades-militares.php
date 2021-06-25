<?php 
    $verificarMenuPermiso = 8; // tabla menus
	$libreriasUrl = "../../../librerias/";
	$tituloPagina = "Unidades Militares - Conf. General";
	$historialNavegacion = "Conf. General / Catálogos / Unidades Militares";
	$encabezadoVista = "";
  	include($libreriasUrl."contenido/interfaz/header.php");
?>
<div id="page"></div>
<script>
    function changePage(id, page) {
        $.post(
            "page-"+page, 
            $.param({id: id}), 
            function(data) {
                $("#page").html(data);
            }
        );  
    }
    $(document).ready(function() {
        changePage('', 'unidades-militares');
    })
</script>
<?php 
  	include($libreriasUrl."contenido/interfaz/footer.php");
?>