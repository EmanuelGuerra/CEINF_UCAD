<?php @session_start(); ?>
<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $libreriasUrl; ?>imagenes/user.png" alt=""><?php echo $_SESSION["nombrePersona"]; ?>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"  href="javascript:;">Mi Perfil</a>
                        <a class="dropdown-item"  href="javascript:;">Ayuda</a>
                        <a class="dropdown-item"  role="button" onclick="cerrarSesion();"><i class="fa fa-sign-out pull-right"></i> Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
<div class="right_col" role="main">
    <div id="contenido-pagina">