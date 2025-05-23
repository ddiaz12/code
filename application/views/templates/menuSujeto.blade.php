<div id="layoutSidenav_nav" class="div-menu">
    <nav class="sb-sidenav sb-sidenav-black" id="sidenavAccordion">
        <div class="sb-sidenav-menu menu-custom">
            <div class="nav">
                <a class="nav-link" href="<?php echo base_url('home'); ?>" title="Inicio">
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
                        <li><a class="dropdown-item" href="<?php echo base_url('menu/menu_buzon'); ?>"><i class="fa-solid fa-inbox icon-inbox"></i> Mi
                        buzón</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('menu/menu_enviadas'); ?>"><i
                                    class="fa-solid fa-paper-plane icon-sent"></i>
                                Enviadas</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('menu/menu_publicadas'); ?>"><i class="fa-solid fa-bullhorn icon-published"></i>
                                Publicadas</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('menu/menu_modificadas'); ?>"><i class="fa-solid fa-gavel icon-modified"></i>
                        Abrogadas</a></li>
                    </ul>
                </div>
                <!-- <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownUser"
                        data-bs-toggle="dropdown" aria-expanded="false" title="Modulo de capacitaciones">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-chalkboard-user icon-user"></i>
                        </div>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownUser">
                        <h6 class="dropdown-header">Módulo de capacitaciones</h6>
                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-book icon-cursos"></i>
                                Cursos</a></li>
                    </ul>
                </div> -->
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownGear"
                        data-bs-toggle="dropdown" aria-expanded="false" title="Ayuda">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-gear icon-gear"></i></div>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownGear">
                        <h6 class="dropdown-header">Ayuda</h6>
                        <li><a class="dropdown-item" href="<?php echo base_url('menu/menu_unidades'); ?>">Unidades administrativas</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('RegulacionController'); ?>">Regulaciones</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownInfo"
                        data-bs-toggle="dropdown" aria-expanded="false" title="Información">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-info icon-info"></i></div>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownInfo">
                        <h6 class="dropdown-header">Información</h6>
                        <li><a class="dropdown-item" href="<?php echo base_url('menu/menu_guia'); ?>">Guías</a></li>
                        <!-- <li><a class="dropdown-item" href="<?php echo base_url('menu/menu_log'); ?>">Log de versiones</a></li>-->
                    </ul>
                </div>
                <a class="nav-link" href="<?php echo base_url('emergency'); ?>" title="Emergencia">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-exclamation-triangle icon-emergency"></i></div>
                </a>
            </div>
        </div>
    </nav>
</div>
