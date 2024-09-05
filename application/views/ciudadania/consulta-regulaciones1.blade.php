<!DOCTYPE html>
<html ng-app="PortalUnico" prueba="true">

<head>
    <meta name="google-site-verification" content="vgE7xTPnRDI9JNHuGHmNQeU55Yr58j9hwq9Wk06R8qk" />
        <title>
            Gobierno del Estado de Colima </title>
        <link rel="SHORTCUT ICON" href="https://openapis.col.gob.mx/API_PU/img/favicon.ico" rel="icon" type="image/x-icon">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://openapis.col.gob.mx/API_PU/css/bs4/bootstrap.min.css">
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

<body data-url="https://openapis.col.gob.mx/API_PU/" id="Body">
    <!-- nav container -->
    <div id="GobNavbar" class="container-fluid navbarGob op GobNavbar">
        <div class="row align-items-center">
            <div class="div-escudo">
                <a class="navbar-brand" href="https://www.col.gob.mx/">
                    <!-- <i class="fa fa-home fa-2x" style="color:#fff;"></i>    nav-image-colima-estado -->
                    <img src="<?php echo base_url('assets/img/logo_transparente.png'); ?>" id="logo"
                        title="Ir al portal" alt="colima estado">
                </a>
            </div>
            <div class="col">
                <nav class="navbar navbar-toggleable-md navbar-light ">
                    <button class="navbar-toggler navbar-toggler-right custom-toggler" type="button"
                        data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-md-center div-navbar" id="navbarNavDropdown">
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
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item login">
                                <a class="nav-link" href="<?php echo base_url('home'); ?>">
                                    <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
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

    <div id="layoutSidenav">

        <!-- Menu -->
        @include('templates/menu_ciudadania')
        <!-- Menu -->

        <main class="main">
            <div id="buscadorContainer" class="input-group"
                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%; height: 50%; text-align: center;">
                <div id="tituloBuscador" style="text-align: center; width: 100%;">
                    <h2>Registro Estatal de Regulaciones</h2>
                </div>
                <div id="buscador" class="input-group" data-mdb-input-init>
                    <input type="search" id="nombreRegulacion" placeholder="Ingrese el nombre de la regulación"
                        class="form-control" required onkeydown="buscarConEnter(event)">
                    <button type="button" id="btn-search" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
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
                                        <?php foreach ($tiposOrdenamiento as $tipo): ?>
                                        <option value="<?= htmlspecialchars($tipo['Tipo_Ordenamiento']); ?>">
                                            <?= htmlspecialchars($tipo['Tipo_Ordenamiento']); ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-auto">
                                    <button type="button" class="btn btn-dorado" id="buscarBtn">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container d-flex justify-content-center align-items-center" id="cardsReg">
                    <div class="container mt-4">
                        <div class="row no-gutters">
                            <!-- Parte PHP para mostrar solo los primeros 9 elementos -->
                            <?php $mostrados = array_slice($regulaciones, 0, 9); ?>
                            <?php foreach ($mostrados as $regulacion): ?>
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm div-card h-100">
                                    <div class="card-header py-2">
                                        <h7 class="m-0 font-weight-bold text-cards card-title">
                                            <?php    echo $regulacion->Nombre_Regulacion; ?>
                                        </h7>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <p class="card-text flex-grow-1"><?php    echo $regulacion->Objetivo_Reg; ?></p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="<?php    echo base_url('ciudadania/verRegulacion/' . $regulacion->ID_Regulacion); ?>"
                                            class="btn btn-secondary btn-sm">Ver Más</a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="text-center mt-3">
                            <button type="button" id="loadMore" class="btn btn-secondary btn-dorado"
                                onclick="cargarMasRegulaciones()">Cargar más</button>
                        </div>
                    </div>
                </div>
                @include('templates/footerCiudadania')               
            </div>
        </main>
    </div>


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
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('advancedSearch').addEventListener('click', function () {
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
                <div class="col-md-4 mb-3">
                                    <div class="card shadow-sm div-card h-100">
                                        <div class="card-header py-2">
                                            <h7 class="m-0 font-weight-bold text-cards card-title">
                                                <?php    echo $regulacion->Nombre_Regulacion; ?>
                                            </h7>
                                        </div>
                                    <div class="card-body d-flex flex-column">
                                        <p class="card-text flex-grow-1"><?php echo $regulacion->Objetivo_Reg; ?></p>
                                    </div>
                                        <div class="card-footer text-center">
                                            <a href="#" class="btn btn-secondary btn-sm">Ver Más</a>
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
        document.getElementById('btn-search').addEventListener('click', function () {
            var nombreRegulacion = document.getElementById('nombreRegulacion').value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?php echo base_url('ciudadania/buscarRegulacion'); ?>', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                    var data = JSON.parse(xhr.responseText);
                    document.getElementById('cardsReg').innerHTML = '';

                    if (data.length > 0) {
                        var rowHtml = '<div class="row">';
                        data.forEach(function (regulacion) {
                            var cardHtml = `
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm div-card h-100">
                                    <div class="card-header py-2">
                                        <h7 class="m-0 font-weight-bold text-cards card-title">
                                            ${regulacion.Nombre_Regulacion}
                                        </h7>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <p class="card-text flex-grow-1"><?php echo $regulacion->Objetivo_Reg; ?></p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="#" class="btn btn-secondary btn-sm">Ver Más</a>
                                    </div>
                                </div>
                            </div>`;
                            rowHtml += cardHtml;
                        });
                        rowHtml += '</div>'; // Cierra el contenedor row

                        document.getElementById('cardsReg').innerHTML = rowHtml;

                        // Agrega el botón Regresar
                        var regresarHtml =
                            `<div class="mt-3"><button id="btnRegresar" class="btn btn-info">Regresar</button></div>`;
                        document.getElementById('cardsReg').innerHTML += regresarHtml;

                        // Evento para el botón Regresar
                        document.getElementById('btnRegresar').addEventListener('click', function () {
                            window.location.reload(); // Recargar la página
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
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("buscarBtn").addEventListener("click", function () {
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
                        data.forEach(function (regulacion) {
                            var cardHtml = `
                         <div class="col-md-4 mb-3">
                                    <div class="card shadow-sm div-card h-100">
                                        <div class="card-header py-2">
                                            <h7 class="m-0 font-weight-bold text-cards card-title">
                                                <?php    echo $regulacion->Nombre_Regulacion; ?>
                                            </h7>
                                        </div>
                                        <div class="card-body d-flex flex-column">
                                            <p class="card-text flex-grow-1"><?php echo $regulacion->Objetivo_Reg; ?></p>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a href="#" class="btn btn-secondary btn-sm">Ver Más</a>
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
                        document.getElementById('btnRegresar').addEventListener('click', function () {
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
    <script>
        function buscarConEnter(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                document.getElementById('btn-search').click();
            }
        }
    </script>
</body>

</html>