<!DOCTYPE html>
<html ng-app="PortalUnico" prueba="true">

<head>
    <meta name="google-site-verification" content="vgE7xTPnRDI9JNHuGHmNQeU55Yr58j9hwq9Wk06R8qk" />
    <title>
        Gobierno del Estado de Colima </title>
    <link rel="SHORTCUT ICON" href="https://openapis.col.gob.mx/API_PU/img/favicon.ico" rel="icon" type="image/x-icon">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://openapis.col.gob.mx/API_PU/css/bs4/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?php echo base_url("assets/") ?>css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url("assets/") ?>css/ciudadania.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Customcss -->

    <link rel="stylesheet" href="https://openapis.col.gob.mx/API_PU/css/bs4/layout.css">
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

<body data-url="https://openapis.col.gob.mx/API_PU/" id="Body">
    <!-- nav container -->
    <div id="GobNavbar" class="container-fluid navbar-container-pu op GobNavbar">
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
                                    <a class="nav-link" id="navbar-search-li-first" href="#" onclick="ocultar(this)"><i
                                            alt="Buscar" title="Buscar" class="fa fa-search" aria-hidden="true"></i></a>
                                </li>

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

    <!-- Modal -->
    <div class="modal fade" id="modal-mensajes-pu" tabindex="-1" role="dialog" aria-labelledby="modalGenericaPu"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-titulo-pu"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-contenido-pu">
                </div>
                <div class="modal-footer" id="modal-footer-pu">
                    <button type="button" class="btn btn-secondary btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <main class="main">
        <div id="layoutSidenav">
            <!-- Menu -->
            @include('templates/menu_ciudadania')
            <!-- Menu -->
            <div id="buscadorContainer" class="input-group"
                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%; height: 50%; text-align: center;">
                <div id="tituloBuscador" style="text-align: center; width: 100%;">
                    <h2>Registro Estatal de Regulaciones</h2>
                </div>
                <div id="buscador" class="form-outline" data-mdb-input-init>
                    <input type="search" id="nombreRegulacion" placeholder="Ingrese el nombre de la regulación"
                        class="form-control" required>
                    <label class="form-label" id="texto" for="form1">Buscar</label>
                    <div id="buttonContainer">
                        <button type="button" id="btn-search" type="button" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label id="regdisp">Regulaciones Disponibles: <?php echo $numeroDeRegulaciones; ?></label>
                    <label for="advancedSearch" id="txtBusqueda">Búsqueda avanzada</label>
                    <button id="advancedSearch" onclick="toggleAdvancedSearch()">
                        <i class="fas fa-arrow-down"></i>
                    </button>
                </div>
                <div id="mostrarFiltros" style="display:none">
                    <div id="advancedSearchOptions">
                        <div class="d-flex justify-content-center">
                            <div class="row" id="avanzada">
                                <div class="col-md-auto">
                                    <label for="option1">Desde</label>
                                    <input type="date" id="option1">
                                </div>
                                <div class="col-md-auto">
                                    <label for="option2">Hasta</label>
                                    <input type="date" id="option2">
                                </div>
                                <div class="col-md-auto">
                                    <label for="option3">Dependencia</label>
                                    <select id="option3">
                                        <?php 
                                        foreach($tiposOrdenamiento as $tipo): ?>
                                        <option value="<?= htmlspecialchars($tipo['Tipo_Ordenamiento']); ?>">
                                            <?= htmlspecialchars($tipo['Tipo_Ordenamiento']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-auto">
                                    <button type="button" class="btn btn-primary" id="buscarBtn">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container d-flex justify-content-center align-items-center" id="cardsReg">
                    <!-- Asegúrate de que el contenedor ocupe al menos el alto de la pantalla -->
                    <div class="container mt-4">
                        <div class="row">
                            <!-- Parte PHP para mostrar solo los primeros 3 elementos -->
                            <?php $mostrados = array_slice($regulaciones, 0, 9); ?>
                            <?php foreach ($mostrados as $regulacion): ?>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $regulacion->Nombre_Regulacion; ?></h5>
                                        <p class="card-text"><?php echo $regulacion->Objetivo_Reg; ?></p>
                                        <a href="#" class="btn btn-secondary">Ver Más</a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <div>
                                <button type="button" id="loadMore" class="btn btn-secondary"
                                    onclick="cargarMasRegulaciones()">Cargar más</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- Modal -->
    <footer class="footer">
        <div class="container-fluid footer-backgroundcolor-pu" id="piePagina">
            <div class="container-fluid footer-back-dark">&nbsp;</div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-12 container-img-footer">
                        <div class="row">
                            <div class="col-md-12 col-12 ">
                                <img class="img-fluid" src="https://openapis.col.gob.mx/API_PU/img/logo-colima-2021.png"
                                    alt="Colima">
                            </div>
                            <div class="col-md-12 col-12 hidden-sm-down">
                                <p class="footer-texto-pu ">Complejo Administrativo del Gobierno del Estado 3er. Anillo
                                    Perif&eacute;rico, Esq. Ej&eacute;rcito Mexicano S/N. Colonia el Diezmo. C.P. 28010,
                                    Colima, Colima, M&eacute;xico. Tel. (312) 316 2000</p>
                            </div>
                            <div class="col-12 footer-link-left footer-links-color-pu">
                                <a class="linksfooter" href="http://www.col.gob.mx/Portal/mapa_sitio" target="_self"
                                    title="">Mapa del sitio</a> <br>
                                <a target="_blank" class="linksfooter"
                                    href="http://www.col.gob.mx/Portal/contenido/MTA3MzI="
                                    title="Pol&iacute;ticas de uso">Pol&iacute;ticas de uso y privacidad</a>
                                <!-- http://www.col.gob.mx/portal/contenido/OTQ5MA== -->

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="row footer-social-separador-pu">
                            <div class="col-12 text-center footer-social-separador-pu">
                                <ul class="list-inline">
                                    <li class="list-inline-item"><span class="footer-icon-separador-pu"></span><a
                                            href="https://www.facebook.com/gobiernocolima/" target="_blank"
                                            title="Facebook"><i class="fa fa-facebook-official footer-facebook fa-3x"
                                                aria-hidden="true"></a></i></li>
                                    <li class="list-inline-item "><span class="footer-icon-separador-pu"></span><a
                                            href="https://twitter.com/gobiernocolima" target="_blank"
                                            title="Twitter"><svg xmlns="http://www.w3.org/2000/svg" width="30"
                                                height="30" viewBox="0 0 512 512">
                                                <path
                                                    d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                                            </svg></a></i></li>
                                    <li class="list-inline-item "><span class="footer-icon-separador-pu"></span><a
                                            href="https://www.youtube.com/user/GobiernoColima" target="_blank"
                                            title="Youtube"><i class="fa fa-youtube-play footer-youtube fa-3x"
                                                aria-hidden="true"></a></i></li>
                                    <!-- <li class="list-inline-item "><span class="footer-icon-separador-pu"></span><a href="http://gobiernocolima.blogspot.mx/" target="_blank" title="Blogspot"><i class="fa fa-rss-square footer-rss fa-3x" aria-hidden="true"></a></i></li> -->
                                    <!-- <li class="list-inline-item "><span class="footer-icon-separador-pu"></span><a href="https://soundcloud.com/gobcolradio/" target="_blank" title="SoundCloud"><i class="fa fa-soundcloud footer-soundcloud fa-3x" aria-hidden="true"></a></i></li> -->
                                </ul>
                            </div>
                            <div class="col-12">
                                <div class="row padding-left-30">
                                    <div class="col text-center">
                                        <i class="fa fa-download fa-2x"></i><br>
                                        <a href="http://www.col.gob.mx/Portal/intranet" target="_blank" title="Intranet"
                                            class="linksfooter">Intranet</a>
                                    </div>
                                    <!-- <div class="col text-center">
                        		 <i class="fa fa-qrcode fa-2x" aria-hidden="true"></i><br>
			   			 	  		<a href="http://www.firel.col.gob.mx/" target="_blank" title="Validación e.firma SAT" class="linksfooter">Validaci&oacute;n <br>e.firma SAT</a> 
                        	</div> -->
                                    <div class="col text-center">
                                        <i class="fa fa-user fa-2x" aria-hidden="true"></i><br>
                                        <a href="http://directoriointegral.col.gob.mx/" target="_blank"
                                            title="Directorio integral" class="linksfooter">Directorio <br> integral</a>
                                    </div>
                                    <div class="col text-center">
                                        <i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i><br>
                                        <a href="http://www.firel.col.gob.mx/" target="_blank"
                                            title="Validación de documentos con firma electrónica"
                                            class="linksfooter">Validaci&oacute;n &nbsp; <br> de documentos</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script type="text/javascript" src="https://openapis.col.gob.mx/API_PU/js/b4/tether.min.js"></script>
    <script type="text/javascript" src="https://openapis.col.gob.mx/API_PU/js/b4/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://openapis.col.gob.mx/API_PU/js/plugins/sweetalert/sweetalert2.all.js">
    </script>
    <script type="text/javascript" src="https://openapis.col.gob.mx/API_PU/js/b4/colgob.js"></script>
    <script>
    function toggleAdvancedSearch() {
        console.log('toggle');
        $("#mostrarFiltros").toggle();
    }
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('advancedSearch').addEventListener('click', function() {
            // Cambiar el icono
            var icon = this.querySelector('i'); // Encuentra el icono dentro del botón
            if (icon.classList.contains('fa-arrow-down')) {
                icon.classList.remove('fa-arrow-down');
                icon.classList.add('fa-arrow-up');
            } else {
                icon.classList.remove('fa-arrow-up');
                icon.classList.add('fa-arrow-down');
            }
        });
    });
    </script>
    <script>
    function cargarMasRegulaciones() {
        let currentIndex = 3; // Asume que ya se han mostrado 3 tarjetas
        const regulaciones =
            <?php echo json_encode(array_values($regulaciones)); ?>; // Asegúrate de que esto se ejecute en el lado del servidor
        const container = document.querySelector("#cardsReg .row");

        for (let i = 0; i < 3; i++) {
            if (currentIndex >= regulaciones.length) {
                // Oculta el botón si no hay más elementos para mostrar
                document.getElementById("loadMore").style.display = 'none';
                break;
            }
            const reg = regulaciones[currentIndex];
            const cardHtml = `
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">${reg.Nombre_Regulacion}</h5>
                            <p class="card-text">${reg.Objetivo_Reg}</p>
                            <a href="#" class="btn btn-secondary">Ver Más</a>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', cardHtml);
            currentIndex++;
        }
        // Ocultar el botón después de cargar más regulaciones
        document.getElementById('loadMore').style.display = 'none';
    }
    </script>

    <script>
    document.getElementById('btn-search').addEventListener('click', function() {
        var nombreRegulacion = document.getElementById('nombreRegulacion').value;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/code-main/ciudadania/buscarRegulacion', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);
                var data = JSON.parse(xhr.responseText);
                document.getElementById('cardsReg').innerHTML = '';
                if (data.length > 0) {
                    data.forEach(function(regulacion) {
                        var cardHtml = `
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">${regulacion.Nombre_Regulacion}</h5>
                                    <p class="card-text">${regulacion.Objetivo_Reg}</p>
                                    <a href="#" class="btn btn-secondary">Ver Más</a>
                                </div>
                            </div>
                        </div>`;
                        document.getElementById('cardsReg').innerHTML += cardHtml;
                    });
                    // Agrega el botón Regresar
                    var regresarHtml =
                        `<div class="mt-3"><button id="btnRegresar" class="btn btn-info">Regresar</button></div>`;
                    document.getElementById('cardsReg').innerHTML += regresarHtml;
                    // Evento para el botón Regresar
                    document.getElementById('btnRegresar').addEventListener('click', function() {
                        window.location
                    .reload(); // Otra opción es restaurar el contenido original si no quieres recargar.
                    });
                } else {
                    document.getElementById('cardsReg').innerHTML = 'No se encontraron resultados.';
                }
            }
        };
        xhr.send('nombreRegulacion=' + encodeURIComponent(nombreRegulacion));
    });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("buscarBtn").addEventListener("click", function() {
            console.log(
                "Botón buscar fue clickeado"
            ); // Esto debería aparecer en la consola cuando hagas clic en el botón.
            var desdeFecha = document.getElementById("option1").value;
            var hastaFecha = document.getElementById("option2").value;
            var dependencia = document.getElementById("option3").value;
            var busqueda = {
                desde: desdeFecha,
                hasta: hastaFecha,
                dependencia: dependencia
            };
            console.log(busqueda);
            fetch('buscarRegulaciones', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(busqueda),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('La respuesta de la red no fue ok');
                    }
                    return response.json().catch(() => {
                        throw new Error('La respuesta no es JSON válido');
                    });
                })
                .then(data => {
                    // Limpia el contenedor antes de mostrar nuevos resultados
                    document.getElementById('cardsReg').innerHTML = '';
                    // Procesa y muestra los datos en cards
                    data.forEach(function(regulacion) {
                        var cardHtml = `
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">${regulacion.Nombre_Regulacion}</h5>
                                    <p class="card-text">${regulacion.Objetivo_Reg}</p>
                                    <a href="#" class="btn btn-secondary">Ver Más</a>
                                </div>
                            </div>
                        </div>`;
                        document.getElementById('cardsReg').innerHTML += cardHtml;
                    });
                    // Agrega el botón Regresar
                    var regresarHtml =
                        `<div class="mt-3"><button id="btnRegresar" class="btn btn-info">Regresar</button></div>`;
                    document.getElementById('cardsReg').innerHTML += regresarHtml;
                    // Evento para el botón Regresar
                    document.getElementById('btnRegresar').addEventListener('click', function() {
                        window.location
                    .reload(); // Otra opción es restaurar el contenido original si no quieres recargar.
                    });
                })
                .catch((error) => {
                    console.error('Error capturado:', error);
                });
        });
    });
    </script> 
    
</body>

</html>