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
            <h1 class="text-center">Registro Estatal de Regulaciones</h1>
            <p class="text-center">Consulta las regulaciones vigentes en el estado de Colima.</p>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12 ">
            <div class="shadow-sm">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div id="buscador" class="input-group mb-3" data-mdb-input-init>
                                <input type="search" id="nombreRegulacion"
                                    placeholder="Ingrese el nombre de la regulación" class="form-control" required
                                    onkeydown="buscarConEnter(event)">
                                <div class="input-group-append">
                                    <button type="button" id="btn-search" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3 txtBusqueda">
                                <label id="regdisp">Regulaciones Disponibles:
                                    <?php echo $numeroDeRegulaciones; ?></label>
                                <div>
                                    <label for="advancedSearch">Búsqueda avanzada</label>
                                    <button id="advancedSearch" class="btn btn-link" onclick="toggleAdvancedSearch()">
                                        <i class="fas fa-arrow-down"></i>
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
                                    <?php foreach ($tiposOrdenamiento as $tipo): ?>
                                    <option value="<?= htmlspecialchars($tipo['Tipo_Ordenamiento']); ?>">
                                        <?= htmlspecialchars($tipo['Tipo_Ordenamiento']); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-dorado" id="buscarBtn">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="cardsReg" class="mt-3">
        <!-- Aquí se mostrarán las regulaciones -->
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


@endsection
@section('footer')

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
                            <a href="<?php echo base_url('ciudadania/verRegulacion/'); ?>${reg.ID_Regulacion}" class="btn btn-secondary btn-sm">Ver Más</a>
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
                        `<div class="mt-3 text-center"><button id="btnRegresar" class="btn btn-primary">Regresar</button></div>`;
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
@endsection