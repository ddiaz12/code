<!DOCTYPE html>
<html>

<head>
    <title>Detalles de la Regulación</title>
    <link rel="stylesheet" href="<?php echo site_url('assets/css/pdf.css'); ?>">
    <link rel="stylesheet" href="https://openapis.col.gob.mx/API_PU/css/bs4/bootstrap.min.css">

    <meta name="google-site-verification" content="vgE7xTPnRDI9JNHuGHmNQeU55Yr58j9hwq9Wk06R8qk" />
    <title>
        Gobierno del Estado de Colima </title>
    <link rel="SHORTCUT ICON" href="https://openapis.col.gob.mx/API_PU/img/favicon.ico" rel="icon" type="image/x-icon">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?php echo base_url("assets/css/styles.css") ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url("assets/css/ciudadania.css") ?>">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Customcss -->

    <!--<link rel="stylesheet" href="https://openapis.col.gob.mx/API_PU/css/bs4/layout.css">-->
    <script type="text/javascript" src="https://openapis.col.gob.mx/API_PU/js/b4/jquery-3.2.1.js"></script>

    <script src='http://localhost:8090/PORTALUNICO/ICSIC/assets/js/customjs.js' type='text/javascript'></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-121812210-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-121812210-1');
    </script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Arvo" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body>
<div id="GobNavbar" class="container-fluid navbarGob op GobNavbar">
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav class="navbar navbar-toggleable-md navbar-light ">
                        <button class="navbar-toggler navbar-toggler-right custom-toggler" type="button"
                            data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <a class="navbar-brand text-center" href="https://www.col.gob.mx/">
                            <!-- <i class="fa fa-home fa-2x" style="color:#fff;"></i>    nav-image-colima-estado -->
                            <img src="https://openapis.col.gob.mx/API_PU/img/logomin.jpg" class="img-fluid"
                                title="Ir al portal" alt="colima estado">
                        </a>
                        <div class="collapse navbar-collapse justify-content-md-center" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link cursor denuncia-menu" target="_blank"
                                        href="https://www.col.gob.mx/coronavirus">CORONAVIRUS</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="https://www.col.gob.mx/Portal/Tramites">Tr&aacute;mites</a>
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
                                <!-- <li class="nav-item">
		      	<a href="https://www.col.gob.mx/transparencia" class="nav-link cursor" target="_blank">Transparencia</a>
		      </li> -->
                                <li class="nav-item">
                                    <a href="https://www.col.gob.mx/Portal/contenido/NDYzMDY=" class="nav-link cursor"
                                        target="_blank">Transparencia</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link cursor denuncia-menu"
                                        href="https://www.col.gob.mx/index.php/Portal/denuncia">DENUNCIA</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url('home'); ?>">
                                        <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                                    </a>
                                </li>
                                <!--
                                <li class="nav-item">
                                    <a class="nav-link" id="navbar-search-li-first" href="#" onclick="ocultar(this)"><i
                                            alt="Buscar" title="Buscar" class="fa fa-search" aria-hidden="true"></i></a>
                                </li>-->

                                <!--
                                <form id="formBusqueda" method="GET"
                                    action="https://www.col.gob.mx/Portal/detalle_busqueda"
                                    class="nav-item display-none" id="navbar-search-li-second">
                                    <div class="input-group" id="navbar-input-search">
                                        <input type="text" name="q" class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn btn-secondary" type="submit">
                                                <i alt="Buscar" title="Buscar" class="fa fa-search"
                                                    aria-hidden="true"></i></button>
                                        </span>
                                    </div>
                                </form>
                                -->
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <a href="#" class="scrollToTop" id="ScrollTop"></a>
        <script type="text/javascript">
            function ocultar(elem) {
                var id = elem.id;
                document.getElementById(id).style.display = "none";
                //document.getElementById("navbar-search-li-second").style.display = "inline";
                document.getElementById("formBusqueda").style.display = "inline";
            }
        </script>
    </div>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="card">
                <div class="header">
                    <img src="<?php echo base_url('assets/img/logo_transparente.png'); ?>" alt="Logo">
                    <h1>FICHA DE LA REGULACIÓN</h1>
                    <p>Decreto que crea el Organismo Público Descentralizado de la Administración Pública Estatal
                        denominado
                        Secretaría de Desarrollo Económico (SEDECO)</p>
                    <?php 
                    date_default_timezone_set('America/Mexico_City'); 
                    ?>
                    <p>Fecha de generación: <?php echo date('d/m/Y'); ?></p>
                </div>

                <div class="card-body">
                    <div class="subheader">
                        <h3>Acerca de la resolución</h3>
                    </div>
                    <p><strong>Medio de publicación:</strong> Periódico Oficial del Gobierno del Estado de Querétaro
                        "La Sombra de Arteaga"</p>
                    <p><strong>Tipo de Ordenamiento jurídico:</strong> Decreto de creación</p>
                    <p><strong>Fecha de publicación:</strong> 27/11/1996</p>
                    <p><strong>Vigencia:</strong> Vigencia indefinida</p>
                    <p><strong>Link de creación:</strong>
                        *
                    </p>
                    <p><strong>Fechas y links de modificaciones:</strong></p>
                    <p><strong>Fecha de Modificación:</strong> 15/07/2005</p>
                    <p><strong>Link de Modificación:</strong>
                        lasombradearteaga.segobqueretaro.gob.mx/2005/20050735-01.pdf</p>
                    <p><strong>Ámbito de Aplicación:</strong> Estatal</p>
                    <p><strong>Objeto de la Regulación:</strong> Prestar los Servicios de Salud a la población
                        abierta en el Estado de Querétaro, en cumplimiento de lo dispuesto por la Ley de Salud del
                        Estado de Querétaro y la Ley General de Salud, y por el Acuerdo de Coordinación.</p>
                    <p><strong>Sujetos Regulados:</strong></p>
                    <ul>
                        <li>Poder Ejecutivo</li>
                        <li>Público en general</li>
                    </ul>
                    <p><strong>Materias Reguladas:</strong></p>
                    <ul>
                        <li>Salud</li>
                        <li>Administrativa</li>
                    </ul>
                    <p><strong>Sectores regulados:</strong></p>
                    <ul>
                        <li>Servicios de salud y de asistencia social</li>
                    </ul>

                    <div class="subheader">
                        <h3>Índice de la Regulación</h3>
                    </div>
                    <p>No aplica</p>
                    <p><strong>Artículos que fundamentan la realización de inspecciones, verificaciones y visitas
                            domiciliarias:</strong></p>
                    <p>No aplica</p>
                    <p><strong>Regulación vigente transparencia:</strong>
                        https://www.queretaro.gob.mx/transparencia/marcojuridico_all.aspx</p>

                    <div class="subheader">
                        <h3>Autoridades</h3>
                    </div>
                    <p><strong>Autoridad que la emite:</strong> Poder Ejecutivo</p>
                    <p><strong>Autoridad que la aplica:</strong> Servicios de Salud del Estado de Querétaro (SESEQ)
                    </p>

                    <div class="subheader">
                        <h3>Regulaciones Vinculadas</h3>
                    </div>
                    <p>No existen relaciones</p>

                    <div class="subheader">
                        <h3>Trámites y Servicios Relacionados</h3>
                    </div>
                    <p><strong>Trámites Relacionados:</strong></p>
                    <ul>
                        <li>Servicios Relacionados</li>
                        <li>Solicitud de visita diagnóstica de campo normativo</li>
                    </ul>
                    <p><strong>Inspecciones Relacionadas:</strong></p>
                    <ul>
                        <li>Fundamento jurídico para la realización de inspecciones, verificaciones y visitas
                            domiciliarias</li>
                        <li>No existe fundamento</li>
                    </ul>

                    <div class="subheader">
                        <h3>Inspecciones Relacionadas</h3>
                    </div>
                    <p>No existen inspecciones relacionadas a esta regulación</p>

                    <div class="subheader">
                        <h3>Inspectores Relacionados</h3>
                    </div>
                    <p>No existen inspectores relacionados a esta regulación</p>
                </div>
                <div class="card-footer">
                    <form action="<?php echo base_url('ciudadania/descargarPdf/' . $regulacion->ID_Regulacion); ?>"
                        method="get" style="display:inline;">
                        <button type="submit" class="btn btn-guardar">Descargar PDF</button>
                    </form>
                    <form action="<?php echo base_url('ciudadania'); ?>" method="get" style="display:inline;">
                        <button type="submit" class="btn btn-regresar">Regresar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('templates/footerCiudadania')  
</body>

</html>