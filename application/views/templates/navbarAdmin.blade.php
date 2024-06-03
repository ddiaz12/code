<nav class="sb-topnav navbar navbar-expand navbar-custom" id="navbarhome">
    <!-- Navbar Brand-->
    <div class="div-escudo">
        <a class="navbar-brand" href="<?php echo base_url('home/home_admin'); ?>">
            <img src="<?php echo base_url('assets/'); ?>img/logo_transparente.png" alt="Escudo del gobierno del estado" id="logo">
        </a>
    </div>
    <!-- Navbar Brand-->

    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>
    <!-- Sidebar Toggle-->

    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    </form>
    <!-- Navbar Search-->

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <!-- Timer -->
        <li id="timer" class="nav-item temporizador">
            59:00
        </li>
        <!-- Timer -->
        <li class="nav-item">
            <a class="nav-link" href="#!"><i class="fas fa-envelope fa-lg"></i></a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-user fa-lg"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?php echo base_url('auth'); ?>">Settings</a></li>
                <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>">Logout</a></li>
            </ul>
        </li>
        <!-- User Email -->
        <li class="user-email">
            <?php echo $this->ion_auth->user()->row()->email; ?>
        </li>
        <!-- User Email -->
    </ul>
    <!-- Navbar-->
</nav>



