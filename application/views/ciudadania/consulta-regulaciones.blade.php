@layout('templates/masterCiudadania')
@section('titulo')
Registro Estatal de Regulaciones
@endsection
@section('navbar')
@include('templates/navbarCiudadania')
@endsection
@section('menu')
@include('templates/menu_ciudadania')
@endsection
@section('contenido')
<!-- Contenido -->
<div class="container mt-4 div-buscador">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center titulo-ciudadania">Registro Estatal de Regulaciones (RER)</h1>
            <p class="text-center subtitulo">Consulta las regulaciones vigentes en el Estado de Colima.</p>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12 ">
            <div class="shadow-sm">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div id="buscador" class="input-group mb-2" data-mdb-input-init>
                                <input type="search" id="nombreRegulacion" placeholder="Ingrese búsqueda"
                                    class="form-control input-buscador rounded-left" required
                                    onkeydown="buscarConEnter(event)">
                                <div class="input-group-append">
                                    <button type="button" id="btn-search" class="btn btn-primary rounded-right">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3 txtBusqueda">
                                <label id="regdisp">Se encontraron
                                    <?php echo $numeroDeRegulaciones; ?> resultados</label>
                                <div>
                                    <label for="advancedSearch">Búsqueda avanzada</label>
                                    <button id="advancedSearch" class="btn btn-link" onclick="toggleAdvancedSearch()">
                                        <i class="fas fa-arrow-down flecha"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3" id="mostrarFiltros" style="display: none;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="option1">Desde</label>
                                <input type="date" class="form-control" id="option1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="option2">Hasta</label>
                                <input type="date" class="form-control" id="option2">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="option3">Dependencia</label>
                                <select class="form-control" id="option3">
                                    <option value="">Seleccione una dependencia</option>
                                    <?php foreach ($dependencias as $dependencia): ?>
                                    <option value="<?= htmlspecialchars($dependencia['Tipo_Dependencia']); ?>">
                                        <?= htmlspecialchars($dependencia['Tipo_Dependencia']); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 offset-md-4"> <!-- Añadimos "offset-md-4" para centrar la columna -->
                            <div class="form-group">
                                <label for="option4">Tipo de ordenamiento</label>
                                <select class="form-control" id="option4">
                                    <option value="">Seleccione un tipo de ordenamiento</option>
                                    <?php foreach ($tiposOrdenamiento as $tipo): ?>
                                    <option value="<?= htmlspecialchars($tipo['Tipo_Ordenamiento']); ?>">
                                        <?= htmlspecialchars($tipo['Tipo_Ordenamiento']); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn" id="buscarBtn">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="cardsReg" class="mt-3">
        <!-- Aquí se mostrarán las regulaciones -->
        <div class="container mt-4 mt-5">
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
                                class="btn btn-secondary btn-sm btn-mostrar">Mostrar</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php if ($numeroDeRegulaciones > 0): ?>
            <div class="text-center mt-3">
                <button type="button" id="loadMore" class="btn btn-secondary btn-dorado cargarMas"
                    onclick="cargarMasRegulaciones()">Mostrar más</button>
            </div>
            <?php endif; ?>
        </div>
    </div>
    @include('templates/footerCiudadania')   
</div>
@endsection
@section('js')
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
    let currentIndex = 9; // Asume que ya se han mostrado 9 tarjetas inicialmente
    function cargarMasRegulaciones() {
        const regulaciones = <?php echo json_encode(array_values($regulaciones)); ?>; // Asegúrate de que esto se ejecute en el lado del servidor
        const container = document.querySelector("#cardsReg .row");

        for (let i = 0; i < 6; i++) { // Cargar 3 regulaciones más cada vez
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
                                ${reg.Nombre_Regulacion}
                            </h7>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <p class="card-text flex-grow-1">${reg.Objetivo_Reg}</p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="<?php echo base_url('ciudadania/verRegulacion/'); ?>${reg.ID_Regulacion}" class="btn btn-secondary btn-sm">Mostrar</a>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', cardHtml);
            currentIndex++;
        }

        // Ocultar el botón si no hay más regulaciones para cargar
        if (currentIndex >= regulaciones.length) {
            document.getElementById("loadMore").style.display = 'none';
        }
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
                                        <p class="card-text flex-grow-1">${regulacion.Objetivo_Reg}</p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="#" class="btn btn-secondary btn-sm">Mostrar</a>
                                    </div>
                                </div>
                            </div>`;
                        rowHtml += cardHtml;
                    });
                    rowHtml += '</div>'; // Cierra el contenedor row

                    document.getElementById('cardsReg').innerHTML = rowHtml;

                    // Agrega el botón Regresar
                    var regresarHtml =
                        `<div class="mt-3 text-center"><button id="btnRegresar" class="btn btn-info">Regresar</button></div>`;
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
    $(document).ready(function () {
        $('#buscarBtn').on('click', function () {
            // Capturar los valores de los campos
            var desde = $('#option1').val();
            var hasta = $('#option2').val();
            var dependencia = $('#option3').val();
            var tipoOrdenamiento = $('#option4').val();

            // Enviar la petición AJAX al servidor
            $.ajax({
                url: 'ciudadania/realizarBusquedaAvanzada', // Cambia la URL al controlador adecuado
                method: 'POST',
                data: {
                    desde: desde,
                    hasta: hasta,
                    dependencia: dependencia,
                    tipoOrdenamiento: tipoOrdenamiento
                },
                success: function (data) {
                    // Limpia el contenedor antes de mostrar nuevos resultados
                    $('#cardsReg').empty();

                    // Parsear la respuesta JSON
                    var resultados = JSON.parse(data);

                    // Verifica si resultados es un array
                    if (Array.isArray(resultados)) {
                        // Procesa y muestra los datos en cards
                        resultados.forEach(function (regulacion) {
                            var cardHtml = `
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm div-card h-100">
                                    <div class="card-header py-2">
                                        <h7 class="m-0 font-weight-bold text-cards card-title">
                                            ${regulacion.Nombre_Regulacion}
                                        </h7>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <p class="card-text flex-grow-1">${regulacion.Objetivo_Reg}</p>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="#" class="btn btn-secondary btn-sm">Mostrar</a>
                                    </div>
                                </div>
                            </div>`;

                            $('#cardsReg').append(cardHtml);
                        });

                        // Agrega el botón Regresar
                        var regresarHtml = `<div class="mt-3 text-center"><button id="btnRegresar" class="btn btn-primary">Regresar</button></div>`;
                        $('#cardsReg').append(regresarHtml);

                        // Evento para el botón Regresar
                        $('#btnRegresar').on('click', function () {
                            window.location.reload(); // Otra opción es restaurar el contenido original si no quieres recargar.
                        });
                    } else {
                        console.error('La respuesta no es un array:', resultados);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error en la búsqueda:', error);
                }
            });
        });
    });
</script>

</script>
<script>
    function buscarConEnter(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            document.getElementById('btn-search').click();
        }
    }
</script>
@endsection