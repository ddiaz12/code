<div id="GobNavbar" class="container-fluid navbarGob op GobNavbar">
    <div class="row align-items-center">
        <div class="div-escudo">
            <a class="navbar-brand" href="https://www.col.gob.mx/">
                <img src="<?php echo base_url('assets/img/logo_transparente.png'); ?>" id="logo" title="Ir al portal"
                    alt="colima estado">
            </a>
        </div>
        <div class="col">
            <nav class="navbar navbar-expand-md navbar-light">
                <button class="navbar-toggler navbar-toggler-right custom-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link cursor denuncia-menu" target="_blank"
                                href="https://www.col.gob.mx/coronavirus">CORONAVIRUS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.col.gob.mx/Portal/Tramites">Tr&aacute;mites</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Gobierno</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="https://www.col.gob.mx/Portal/#sec_atencion">Cont&aacute;ctanos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link cursor" target="_blank"
                                href="https://www.col.gob.mx/DatosAbiertos">Datos</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.col.gob.mx/Portal/contenido/NDYzMDY=" class="nav-link cursor"
                                target="_blank">Transparencia</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="tooltip" data-placement="right"
                                title="Accesibilidad" onclick="showAccessibilityMenu()">
                                <div class="sb-nav-link-icon">
                                    <i class="fa-solid fa-universal-access"></i>
                                </div>
                                <span class="nav-text"></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link cursor denuncia-menu"
                                href="https://www.col.gob.mx/index.php/Portal/denuncia">DENUNCIA</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="col-auto">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link loginCiudadania" href="<?php echo base_url('home'); ?>">
                        <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                    </a>
                </li>
            </ul>
        </div>
        <a href="#" class="scrollToTop" id="ScrollTop"></a>
        <script type="text/javascript">
            function ocultar(elem) {
                var id = elem.id;
                document.getElementById(id).style.display = "none";
                document.getElementById("formBusqueda").style.display = "inline";
            }
        </script>
    </div>
</div>