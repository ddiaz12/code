@layout('templates/masterCiudadania')
@section('titulo')
Inspecciones - Registro Estatal de Visitas Domiciliarias
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
    .breadcrumb {
        background: none;
        padding: 0.5rem 0;
        margin-bottom: 1rem;
    }
    .breadcrumb-item a {
        color: #712F3E;
        text-decoration: none;
    }
    .breadcrumb-item.active {
        color: #666;
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
    .btn-search {
        background-color: #712F3E;
        border-color: #712F3E;
        border-radius: 0 20px 20px 0 !important;
        padding: 0.375rem 1rem;
    }
    .inspeccion-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 1.5rem;
        display: flex;
        flex-direction: column;
    }
    .inspeccion-header {
        background-color: #712F3E;
        color: white;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        text-align: center;
        min-height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .inspeccion-body {
        padding: 1rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .inspeccion-info {
        text-align: center;
        margin-bottom: 1rem;
    }
    .secretaria {
        font-weight: 500;
        color: #333;
        margin-bottom: 0.5rem;
    }
    .costo {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
    .inspector-link {
        color: #0066cc;
        text-decoration: none;
        font-size: 0.9rem;
    }
    .inspector-link:hover {
        text-decoration: underline;
    }
    .btn-consultar {
        background-color: #712F3E;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 0.5rem 2rem;
        transition: background-color 0.2s;
        width: 100%;
        margin-top: auto;
    }
    .btn-consultar:hover {
        background-color: #5a2632;
        color: white;
        text-decoration: none;
    }
    .btn-mostrar-mas {
        background-color: #C19C67;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 0.5rem 2rem;
        transition: background-color 0.2s;
        margin: 2rem auto;
        display: block;
    }
    .btn-mostrar-mas:hover {
        background-color: #a88757;
        color: white;
        text-decoration: none;
    }
    .busqueda-avanzada {
        color: #712F3E;
        text-decoration: none;
        font-size: 0.9rem;
    }
    .txtBusqueda {
        color: #666;
        font-size: 0.9rem;
    }
</style>

<div class="container-main">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Inspecciones</li>
        </ol>
    </nav>

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

    <!-- Grid de Inspecciones -->
    <div class="row">
        @foreach ($inspecciones as $inspeccion)
        <div class="col-md-4">
            <div class="inspeccion-card">
                <div class="inspeccion-header">
                    {{ $inspeccion->titulo }}
                </div>
                <div class="inspeccion-body">
                    <div class="inspeccion-info">
                        <div class="secretaria">{{ $inspeccion->secretaria }}</div>
                        @if($inspeccion->costo)
                            <div class="costo">Costo: ${{ $inspeccion->costo }} Actualización (UMA)</div>
                        @else
                            <div class="costo">Sin costo</div>
                        @endif
                        <a href="#" class="inspector-link">{{ $inspeccion->inspector }}</a>
                    </div>
                    <a href="#" class="btn btn-consultar">Consultar</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Botón Mostrar Más -->
    <button class="btn btn-mostrar-mas">
        Mostrar más
    </button>
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