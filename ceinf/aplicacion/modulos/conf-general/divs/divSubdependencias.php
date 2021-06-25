<?php 
    @session_start();
    require_once '../../../../librerias/contenido/logica/conexion.php';

    $dependenciaId = $_POST["dependenciaId"];
    if($dependenciaId == 0) {
?>
	    <select name="tempSubdependencia" id="tempSubdependencia" class="form-control has-feedback-left" required>
	        <option value="0" selected disabled>Subdependencia</option>
	        <option value="1" disabled>Seleccione Dependencia</option>
	    </select>
	    <span class="fa fa-building-o  form-control-feedback left" aria-hidden="true"></span>
<?php 
	} else {
?>
	    <select name="subdependenciaId" id="subdependenciaId" class="form-control has-feedback-left" required>
	        <option value="0" selected disabled>Subdependencia</option>
	        <?php 
	            $querySubdependencias = $bd->query("
	                SELECT
	                    subdependenciaId,
	                    nombreSubdependencia,
	                    abreviatura
	                FROM subdependencias
	                WHERE dependenciaId = '$dependenciaId' AND flgEliminado = '0'
	            ");
	            $n = 0;
	            while($getSubdependencias = $querySubdependencias->fetch_assoc()) {
	            	$n += 1;
	                echo '<option value="'.$getSubdependencias["subdependenciaId"].'">('.$getSubdependencias["abreviatura"].') '.$getSubdependencias["nombreSubdependencia"].'</option>';
	            }
	            if($n == 0) {
	            	echo '<option value="1" disabled>Subdependencias no asignadas</option>';
	            } else {
	            }
	        ?>
	    </select>
	    <span class="fa fa-building-o  form-control-feedback left" aria-hidden="true"></span>
<?php 
	}
?>
