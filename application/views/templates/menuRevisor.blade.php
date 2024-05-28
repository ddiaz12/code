<div id="layoutSidenav_nav" class="div-menu">
    <nav class="sb-sidenav sb-sidenav-black" id="sidenavAccordion">
        <div class="sb-sidenav-menu menu-custom">
            <div class="nav">
                <a class="nav-link" href="<?php echo base_url('home/home_revisor'); ?>" title="Inicio">
                    <div class="sb-nav-link-icon div-home"><i class="fa-solid fa-house icon-home"></i></div>
                </a>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownBalanced"
                        data-bs-toggle="dropdown" aria-expanded="false" title="Regulaciones">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-scale-balanced icon-balanced"></i>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownBalanced">
                        <h6 class="dropdown-header">Regulaciones</h6>
                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-inbox icon-inbox"></i> Mi
                                buzon</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('menu/menu_enviadas'); ?>"><i
                                    class="fa-solid fa-paper-plane icon-sent"></i>
                                Enviadas</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-bullhorn icon-published"></i>
                                Publicadas</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownUser"
                        data-bs-toggle="dropdown" aria-expanded="false" title="Modulo de capacitaciones">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-chalkboard-user icon-user"></i>
                        </div>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownUser">
                        <h6 class="dropdown-header">Modulo de capacitaciones</h6>
                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-book icon-cursos"></i>
                                Cursos</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownGear"
                        data-bs-toggle="dropdown" aria-expanded="false" title="Ayuda">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-gear icon-gear"></i></div>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownGear">
                        <h6 class="dropdown-header">Ayuda</h6>
                        <li><a class="dropdown-item" href="<?php echo base_url('menu/menu_sujeto'); ?>">Sujeto obligado</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('menu/menu_unidades'); ?>">Unidades administrativas</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('oficinas'); ?>">Oficinas</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('usuarios'); ?>">Usuarios</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownInfo"
                        data-bs-toggle="dropdown" aria-expanded="false" title="Informacion">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-info icon-info"></i></div>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownInfo">
                        <h6 class="dropdown-header">Información</h6>
                        <li><a class="dropdown-item" href="<?php echo base_url('menu/menu_guia'); ?>">Guias</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('menu/menu_log'); ?>">Log de versiones</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
