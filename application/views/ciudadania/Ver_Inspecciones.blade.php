@layout('templates/masterCiudadania')
@section('titulo')
Inspecciones - Registro Estatal de Visitas Domiciliarias
@endsection

@section('navbar')
@include('templates/navbarCiudadania')
@endsection

@section('menu')
@include('templates/menu_VisitasDomiciliarias')
@endsection

@section('contenido')
<style>
    .container-main {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }
    .header-section {
        margin: 3rem 0 4rem;
    }
    .titulo-ciudadania {
        color: #712F3E;
        font-weight: bold;
        font-size: 2rem;
        margin-bottom: 1rem;
        position: relative;
        padding-bottom: 1rem;
    }
    .titulo-ciudadania::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background-color: #C19C67;
    }
    .subtitulo {
        color: #666;
        font-style: italic;
        font-size: 1.2rem;
        margin-bottom: 1.5rem;
    }
    .descripcion {
        color: #666;
        font-size: 1rem;
        margin-bottom: 2rem;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }
    .div-buscador {
        background-color: white;
        padding: 2.5rem;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin: 3rem auto;
        max-width: 800px;
    }
    .input-buscador {
        border: 1px solid #C19C67 !important;
        border-radius: 20px !important;
        height: 42px;
        font-size: 1rem;
        padding: 0.5rem 1.5rem;
    }
    .input-buscador:focus {
        box-shadow: 0 0 0 2px rgba(193, 156, 103, 0.2) !important;
    }
    .btn-search {
        background-color: #712F3E;
        border-color: #712F3E;
        border-radius: 0 20px 20px 0 !important;
        padding: 0.375rem 1.5rem;
        transition: all 0.3s ease;
    }
    .btn-search:hover {
        background-color: #5a2632;
    }
    .inspeccion-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .inspeccion-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }
    .inspeccion-header {
        background-color: #712F3E;
        color: white;
        padding: 1.25rem 1rem;
        font-size: 1.1rem;
        text-align: center;
        min-height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    .inspeccion-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background-color: #C19C67;
    }
    .inspeccion-body {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        background: linear-gradient(to bottom, #ffffff, #f8f9fa);
    }
    .inspeccion-info {
        text-align: center;
        margin-bottom: 1.5rem;
    }
    .secretaria {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.75rem;
        font-size: 1.1rem;
    }
    .costo {
        color: #666;
        font-size: 0.95rem;
        margin-bottom: 0.75rem;
        padding: 0.5rem;
        background-color: #f8f9fa;
        border-radius: 10px;
    }
    .inspector-link {
        color: #712F3E;
        text-decoration: none;
        font-size: 0.95rem;
        transition: color 0.3s ease;
        display: inline-block;
        padding: 0.5rem 1rem;
        border: 1px solid #C19C67;
        border-radius: 20px;
        margin-top: 0.5rem;
    }
    .inspector-link:hover {
        color: #C19C67;
        text-decoration: none;
        background-color: #f8f9fa;
    }
    .btn-consultar {
        background-color: #712F3E;
        color: white;
        border: none;
        border-radius: 25px;
        padding: 0.75rem 2rem;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: auto;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .btn-consultar:hover {
        background-color: #5a2632;
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(113, 47, 62, 0.2);
    }
    .btn-mostrar-mas {
        background-color: #C19C67;
        color: white;
        border: none;
        border-radius: 25px;
        padding: 0.75rem 3rem;
        transition: all 0.3s ease;
        margin: 3rem auto;
        display: block;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .btn-mostrar-mas:hover {
        background-color: #a88757;
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(193, 156, 103, 0.2);
    }
    .busqueda-avanzada {
        color: #712F3E;
        text-decoration: none;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: color 0.3s ease;
    }
    .busqueda-avanzada:hover {
        color: #C19C67;
        text-decoration: none;
    }
    .txtBusqueda {
        color: #666;
        font-size: 0.95rem;
        padding: 0.5rem 1rem;
        background-color: #f8f9fa;
        border-radius: 20px;
    }
    .flecha {
        transition: transform 0.3s ease;
    }
    .flecha.rotated {
        transform: rotate(180deg);
    }
</style>

<div class="container-main">
    <div class="header-section">
        <h1 class="text-center titulo-ciudadania">Registro Estatal de Visitas Domiciliarias (REVID)</h1>
        <h2 class="text-center subtitulo">Inspecciones, Verificaciones y Visitas Domiciliarias</h2>
        <p class="text-center descripcion">
            Consulta de las Inspecciones, Verificaciones y Visitas Domiciliarias en el Estado de Colima
        </p>
    </div>

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
                    {{ $inspeccion->Nombre_Inspeccion }}
                </div>
                <div class="inspeccion-body">
                    <div class="inspeccion-info">
                        <div class="secretaria">{{ $inspeccion->Dependencia }}</div>
                        @if($inspeccion->Detalle_Costo)
                            <div class="costo">Costo: ${{ $inspeccion->Detalle_Costo }} Actualización (UMA)</div>
                        @else
                            <div class="costo">Sin costo</div>
                        @endif
                        <a href="#" class="inspector-link">{{ $inspeccion->Nombre }} {{ $inspeccion->Apellido_Paterno }} {{ $inspeccion->Apellido_Materno }}</a>
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