<body class="sb-nav-fixed cuerpo-sujeto">

    <nav class="sb-topnav navbar navbar-expand navbar-custom" id="navbarhome">
        <!-- Navbar Brand-->
        <div class="div-escudo">
            <a class="navbar-brand" href="<?php echo base_url("home/home_sujeto") ?>">
                <img src="<?php echo base_url("assets/") ?>img/logo2.jpg" alt="Escudo del gobierno del estado"
                    id="logo">
            </a>
        </div>
        <!-- Navbar Brand-->

        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Sidebar Toggle-->

        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar Search-->

        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa-solid fa-user fa-2x"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
        <!-- Navbar-->
    </nav>

    <div id="layoutSidenav">
        <!-- Menu -->
        <div id="layoutSidenav_nav" class="div-menu">
            <nav class="sb-sidenav sb-sidenav-white" id="sidenavAccordion">
                <div class="sb-sidenav-menu menu-custom">
                    <div class="nav">
                        <a class="nav-link" href="<?php echo base_url("home/home_sujeto") ?>">
                            <div class="sb-nav-link-icon div-home"><i class="fa-solid fa-house icon-home"></i></div>
                        </a>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-scale-balanced icon-balanced"></i></div>
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-chalkboard-user icon-user"></i></div>
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-gear icon-gear"></i></div>
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-info icon-info"></i></div>
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <!-- Menu -->
        
        <!-- Contenido -->
        <div id="layoutSidenav_content" class="div-contenido">
            <main class="main-contenido">
                <div class="container-fluid px-4">
                    <h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER)</h1>


                    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                    <div class="overlay" style="display: none;">
                        <div class="loader" style="display: none;">
                        </div>
                    </div>
                    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <input id="hdTypeRol" type="hidden">
    <input id="hdTypeFilter" type="hidden" value="MiBuzon">
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    <a href="http://localhost/code/home/home_sujeto">Inicio</a>
                </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="https://catalogonacional.gob.mx/sujetosobligados/Panel" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <span class="kt-subheader__breadcrumbs-link">
                        Regulaciones
                    </span>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <span class="kt-subheader__breadcrumbs-link">
                        Mi Buzón
                    </span>
                </div>
            </div>
        </div>
    </div>
                    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>
                                        Mi Buzón
                                    </h4>
                                </div>
                                <div class="col-md-12">
                                    <span>
                                        En este apartado encontrarás las regulaciones que se encuentran en edición y/o revisión
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-wrapper">
                                <div class="kt-portlet__head-actions">
                                    <div class="dropdown dropdown-inline">
                                                <button id="btnAddRegulacion" type="button" class="btn btn-success btn-icon-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="la la-plus"></i> Agregar regulación
                                                </button>
                                        <button id="btnExcelExport" type="button" class="btn btn-success btn-icon-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="flaticon2-list-3"></i> Exportar Excel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                            <div class="row align-items-center">
                                <div class="col-xl-6 col-md-6 col-xs-12 order-2 order-xl-1">
                                    <div class="row align-items-center">
                                        <div class="col-md-12 kt-margin-b-20-tablet-and-mobile">
                                            <div class="form-group ">
                                                <div class="input-group">
                                                    <input id="txtSearchItem" type="text" class="form-control" placeholder="Buscar...">
                                                    <div class="input-group-append">
                                                        <button id="btnSearchItem" class="btn btn-secondary" type="button">Buscar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-xs-12 order-1 order-xl-2 kt-align-right">
                                            <div class="form-group " style="display: none;">
                                                <select id="selectSectorId" class="form-control">
                                                    <option value="">Todos los Sectores</option>
                                                </select>
                                            </div>
                                                <div class="form-group ">
                                                    <select id="selectDependenciasIdSector" class="form-control">
                                                        <option value="">Todas las Dependencias</option>
                                                                <option value="10446">Instituto de Pruebas REVID</option>
                                                    </select>
                                                </div>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                        </div>
                        <div id="gridRegulaciones">
<div class="kt-portlet__body kt-portlet__body--fit">
    <table class="table table-bordered table-striped" id="tbRegulacionPanel">
        <thead>
            <tr>
                <th title="Id">
                    <h4 style="cursor:pointer">
                        <span class="text-muted">
                            Id
                        </span>
                    </h4>

                </th>
                <th title="Nombre">
                    <h4 style="cursor:pointer">
                        <span class="text-muted">
                            Nombre
                        </span>
                    </h4>
                </th>
                <th title="Homoclave">
                    <h4 style="cursor:pointer">
                        <span class="text-muted">
                            Homoclave
                        </span>
                    </h4>
                </th>
                <th title="Estatus">
                    <h4 style="cursor:pointer">
                        <span class="text-muted">
                            Estatus
                        </span>
                    </h4>
                </th>
                    <th>
                        <h4>
                            <span class="text-muted">
                                Tipo
                            </span>
                        </h4>
                    </th>
                    <th>
                        <h4>
                            <span class="text-muted">
                                Vigencia
                            </span>
                        </h4>
                    </th>
                <th>
                    <h4>
                        <span class="text-muted">
                            Acciones
                        </span>
                    </h4>
                </th>
            </tr>
        </thead>
        <tbody>
                        <tr>
                        </tr>
                        <tr>
                            
                        </tr>

        </tbody>
    </table>
        <div id="paginationRegulacionesList">
            
        </div>
    <div><p>Total de registros: </p></div>

                </div>
            </main>

            <!-- Footer -->
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div class="text-muted div-info">Contacto: Secretaria de Desarrollo Económico
                            Complejo Administrativo del Gobierno del Estado de Colima
                            Tercer Anillo Perf. S/N, El Diezmo, 28010 31231620000
                        </div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- Footer -->
        </div>
        <!-- Contenido -->
    </div>
</body>