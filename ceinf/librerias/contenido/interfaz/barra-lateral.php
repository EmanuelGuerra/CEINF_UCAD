<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="/ceinf/aplicacion/" class="site_title"><i class="fa fa-desktop"></i> <span>CEINF</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="<?php echo $libreriasUrl; ?>imagenes/user.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Bienvenido,</span>
                <h2><?php echo $_SESSION["nombrePersona"]; ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Principal</h3>
                <ul class="nav side-menu">              
                    <li><a href="/ceinf/aplicacion/"><i class="fa fa-laptop"></i> Escritorio</a></li>
                </ul>
            </div>
            <?php 
                // Obtener los modulos a los que el rol que ingreso tiene permiso
                $getModulosPermiso = $bd->query("
                    SELECT 
                        mo.moduloId AS moduloId,
                        mo.nombreModulo AS nombreModulo,
                        mo.carpetaModulo AS carpetaModulo
                    FROM roles_menus rm
                    JOIN menus m ON m.menuId = rm.menuId
                    JOIN modulos mo ON mo.moduloId = m.moduloId
                    WHERE rm.rolId = '$_SESSION[rolId]' AND rm.flgEliminado = '0' AND m.flgEliminado = '0' AND mo.flgEliminado = '0'
                    GROUP BY m.moduloId
                    ORDER BY mo.moduloId
                ");
                while($arrayModulosPermiso = $getModulosPermiso->fetch_assoc()) {
                    $moduloId = $arrayModulosPermiso["moduloId"];
            ?>
                    <div class="menu_section">
                        <h3><?php echo $arrayModulosPermiso["nombreModulo"]; ?></h3>
                        <ul class="nav side-menu">
                            <?php 
                                $getMenusPadre = $bd->query("
                                    SELECT
                                        menuId, 
                                        nombreMenu, 
                                        iconoMenu, 
                                        urlMenu, 
                                        tipoMenu,
                                        menuDropdown
                                    FROM menus
                                    WHERE moduloId = '$moduloId' AND (tipoMenu = 'Menú' OR tipoMenu = 'Dropdown') AND flgEliminado = '0'
                                    ORDER BY menuId
                                ");
                                while($arrayMenusPadre = $getMenusPadre->fetch_assoc()) {
                                    $menuId = $arrayMenusPadre["menuId"];

                                    $queryExistePermiso = $bd->query("
                                        SELECT COUNT(permisoRolId) AS existe
                                        FROM roles_menus
                                        WHERE rolId = '$_SESSION[rolId]' AND menuId = '$menuId' AND flgEliminado = '0'
                                    ");
                                    $getExistePermiso = $queryExistePermiso->fetch_assoc();
                                    if($getExistePermiso["existe"] > 0) {

                                        if($arrayMenusPadre["tipoMenu"] == "Dropdown") {
                                            // Posee dropdown, dibujar el nombre del dropdown
                            ?>
                                            <li><a><i class="<?php echo $arrayMenusPadre['iconoMenu']; ?>"></i> <?php echo $arrayMenusPadre["nombreMenu"]; ?><span class="fa fa-chevron-down"></span></a>
                                                <ul class="nav child_menu">
                                <?php
                                                    // Consultar - Traer sus "hijos"
                                                    $getMenusHijo = $bd->query("
                                                        SELECT
                                                            menuId, 
                                                            nombreMenu, 
                                                            urlMenu
                                                        FROM menus
                                                        WHERE menuDropdown = '$menuId' AND flgEliminado = '0'
                                                        ORDER BY menuId
                                                    ");
                                                    while($arrayMenusHijo = $getMenusHijo->fetch_assoc()) {
                                                        $menuHijoId = $arrayMenusHijo["menuId"];
                                                        $queryExisteSubPermiso = $bd->query("
                                                            SELECT COUNT(permisoRolId) AS existe
                                                            FROM roles_menus
                                                            WHERE rolId = '$_SESSION[rolId]' AND menuId = '$menuHijoId' AND flgEliminado = '0'
                                                        ");
                                                        $getExisteSubPermiso = $queryExisteSubPermiso->fetch_assoc();
                                                        if($getExisteSubPermiso["existe"] > 0) {
                                                            echo '<li><a href="/ceinf/aplicacion/modulos/'.$arrayModulosPermiso["carpetaModulo"].'/'.$arrayMenusHijo["urlMenu"].'">'.$arrayMenusHijo["nombreMenu"].'</a></li>';
                                                        } else {
                                                            // Omitir permiso
                                                        }
                                                        
                                                    }
                                ?>
                                                </ul>
                                            </li>
                            <?php 
                                        } else {
                                            // No posee dropdown, dibujar unicamente el menu
                                            echo '
                                            <li>
                                                <a href="/ceinf/aplicacion/modulos/'.$arrayModulosPermiso["carpetaModulo"].'/'.$arrayMenusPadre["urlMenu"].'">
                                                    <i class="'.$arrayMenusPadre["iconoMenu"].'"></i> '.$arrayMenusPadre["nombreMenu"].'
                                                </a>
                                            </li>';
                                        }
                                    } else {
                                        // Omitir menu
                                    }
                                } // while arrayMenusPadre
                            ?>
                        </ul>
                    </div>
            <?php 
                } // while arrayModulosPermiso
            ?>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>