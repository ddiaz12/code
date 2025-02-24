@layout('templates/masterCiudadania')
@section('titulo')
Estadísticas - Registro Estatal de Visitas Domiciliarias
@endsection

@section('navbar')
@include('templates/navbarCiudadania')
@endsection

@section('menu')
@include('templates/menu_ciudadania')
@endsection

@section('contenido')
<style>
    .container-main {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }
    .titulo-ciudadania {
        color: #712F3E;
        font-weight: bold;
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }
    .subtitulo {
        color: #666;
        font-style: italic;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
    }
    .descripcion {
        color: #666;
        font-size: 0.95rem;
        margin-bottom: 2rem;
    }
    .div-buscador {
        background-color: white;
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin: 2rem auto;
        max-width: 800px;
    }
    .input-buscador {
        border: 1px solid #C19C67 !important;
        border-radius: 20px !important;
        height: 38px;
    }
    .table-container {
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin: 2rem auto;
        padding: 1.5rem;
        overflow-x: auto;
    }
    .table-inspecciones {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1rem;
    }
    .table-inspecciones th {
        background-color: #712F3E;
        color: white;
        padding: 1rem;
        text-align: left;
        font-weight: 500;
        white-space: nowrap;
    }
    .table-inspecciones td {
        padding: 1rem;
        border-bottom: 1px solid #e2e8f0;
        color: #4a5568;
    }
    .table-inspecciones tr:hover {
        background-color: #f8fafc;
    }
    .table-inspecciones tr:last-child td {
        border-bottom: none;
    }
    .text-center-cell {
        text-align: center;
    }
    @media (max-width: 768px) {
        .table-container {
            margin: 1rem -1rem;
            border-radius: 0;
        }
        .table-inspecciones {
            font-size: 0.875rem;
        }
        .table-inspecciones th,
        .table-inspecciones td {
            padding: 0.75rem;
        }
    }
</style>

<div class="container-main">
    <!-- Títulos -->
    <h1 class="text-center titulo-ciudadania">Registro Estatal de Visitas Domiciliarias (REVID)</h1>
    <h2 class="text-center subtitulo">Inspecciones, Verificaciones y Visitas Domiciliarias</h2>
    <p class="text-center descripcion">
        Consulta de las Inspecciones, Verificaciones y Visitas Domiciliarias en el Estado de Colima
    </p>

    <!-- Buscador -->
    <div class="div-buscador">
        <div class="input-group mb-3">
            <input type="search" 
                   class="form-control input-buscador" 
                   placeholder="Ingrese búsqueda"
                   onkeydown="buscarConEnter(event)">
            <div class="input-group-append">
                <button class="btn btn-search" type="button">
                    <i class="fas fa-search text-white"></i>
                </button>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <span class="txtBusqueda">Se encontraron {{ $numeroResultados }} resultados</span>
            <a href="#" class="busqueda-avanzada" onclick="toggleAdvancedSearch(event)">
                Búsqueda avanzada
                <i class="fas fa-arrow-down flecha"></i>
            </a>
        </div>
    </div>

    <!-- Tabla de Inspecciones -->
    <div class="table-container">
        <table class="table-inspecciones">
            <thead>
                <tr>
                    <th>Nombre del Sujeto Obligado</th>
                    <th>Nombre de la inspección, verificación o visita domiciliaria</th>
                    <th>Modalidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estadisticas as $estadistica)
                <tr>
                    <td>{{ $estadistica['nombre_sujeto'] }}</td>
                    <td>{{ $estadistica['Nombre_Inspeccion'] }}</td>
                    <td>{{ $estadistica['Modalidad'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
<script>
    function toggleAdvancedSearch(event) {
        event.preventDefault();
        const mostrarFiltros = document.getElementById('mostrarFiltros');
        const flecha = document.querySelector('.flecha');
        mostrarFiltros.style.display = mostrarFiltros.style.display === 'none' ? 'block' : 'none';
        flecha.classList.toggle('rotated');
    }

    function buscarConEnter(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            document.querySelector('.btn-search').click();
        }
    }
</script>
@endsection

@section('footer')
@include('templates/footerCiudadania')
@endsection