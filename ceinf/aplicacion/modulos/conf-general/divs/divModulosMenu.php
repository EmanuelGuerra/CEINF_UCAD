<?php 
	require_once '../../../../librerias/contenido/logica/conexion.php';
	@session_start();

	if($_POST["moduloId"] != "") {
?>
	    <select name="menuId[]" id="menuId" class="form-control has-feedback-left" multiple required>
	        <option value="0" selected disabled>Menú</option>
	        <?php 
	            $queryMenus = $bd->query("
	                SELECT
	                    menuId, 
	                    moduloId, 
	                    nombreMenu
	                FROM menus
	                WHERE moduloId = '$_POST[moduloId]' AND (tipoMenu = 'Menú' OR tipoMenu = 'Submenú') AND flgEliminado = '0'
	            ");
	            while($getMenus = $queryMenus->fetch_assoc()) {
	                echo '<option value="'.$getMenus["menuId"].'">'.$getMenus["nombreMenu"].'</option>';
	            }
	        ?>
	    </select>
	    <span class="fa fa-folder-open form-control-feedback left" aria-hidden="true"></span>
<?php
	} else {
?>
	    <select name="menuId" id="menuId" class="form-control has-feedback-left" required>
	        <option value="0" selected disabled>Seleccione Módulo</option>
	    </select>
	    <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
<?php
	}
?>