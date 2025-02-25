@layout('templates/masterCiudadania')
@section('titulo')
Registro Estatal de Visitas Domiciliarias
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
        max-width: 800px;
        margin: 0 auto;
        padding: 0 1rem;
    }
    .div-buscador {
        background-color: white;
        padding: 2rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin: 2rem auto;
    }
    .titulo-ciudadania {
        color: #712F3E;
        font-weight: bold;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
    .subtitulo {
        color: #666;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
    }
    .input-buscador {
        border: 1px solid #C19C67 !important;
        border-radius: 20px !important;
        height: 38px;
    }
    .input-buscador:focus {
        border-color: #712F3E !important;
        box-shadow: none !important;
    }
    .btn-search {
        background-color: #712F3E;
        border-color: #712F3E;
        border-radius: 20px;
        padding: 0.375rem 1rem;
    }
    .btn-search:hover {
        background-color: #5a2632;
        border-color: #5a2632;
    }
    .txtBusqueda {
        color: #666;
        font-size: 0.9rem;
    }
    .busqueda-avanzada {
        color: #712F3E;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
    }
    .flecha {
        transition: transform 0.3s ease;
    }
    .flecha.rotated {
        transform: rotate(180deg);
    }
    .filtros-container {
        margin-top: 1.5rem;
    }
    .form-label {
        color: #333;
        font-size: 14px;
        margin-bottom: 8px;
        display: block;
    }
    .form-control {
        border: 1px solid #C19C67;
        border-radius: 20px;
        height: 38px;
        color: #666;
        width: 100%;
        padding: 8px 16px;
        background-color: white;
    }
    .form-control:focus {
        border-color: #712F3E;
        box-shadow: none;
        outline: none;
    }
    .form-control::placeholder {
        color: #999;
    }
    select.form-control {
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23C19C67' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
        padding-right: 40px;
    }
    .btn-buscar {
        background-color: #712F3E;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 8px 24px;
        margin-top: 20px;
    }
    .btn-buscar:hover {
        background-color: #5a2632;
    }
    .input-group {
        border-radius: 20px;
        overflow: hidden;
    }
    .input-group .input-group-append .btn {
        border-radius: 0 20px 20px 0 !important;
    }
    .input-group .form-control:first-child {
        border-radius: 20px 0 0 20px !important;
    }
    .cards-container {
        max-width: 1000px;
        margin: 2rem auto;
    }
    .consulta-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .consulta-header {
        background-color: #712F3E;
        color: white;
        padding: 1rem;
        text-align: center;
    }
    .consulta-header h5 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 500;
    }
    .consulta-body {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .consulta-text {
        text-align: center;
        color: #666;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }
    .consulta-footer {
        padding: 1.5rem;
        text-align: center;
    }
    .btn-consultar {
        background-color: #712F3E;
        color: white;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 20px;
        text-decoration: none;
        transition: background-color 0.2s;
    }
    .btn-consultar:hover {
        background-color: #5a2632;
        color: white;
        text-decoration: none;
    }
</style>

<div class="container-main">
    <h4 class="text-center titulo-ciudadania">Registro Estatal de <strong>Visitas Domiciliarias</strong> (REVID)</h4>
    
    <div class="div-buscador">
        <p class="text-center subtitulo">Consulta las visitas domiciliarias en el Estado de Colima</p>
        
        <div class="input-group mb-2">
            <input type="search" 
                   placeholder="Ingrese búsqueda" 
                   class="form-control input-buscador"
                   onkeydown="buscarConEnter(event)">
            <div class="input-group-append">
                <button type="button" class="btn btn-search">
                    <i class="fas fa-search text-white"></i>
                </button>
            </div>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mt-2">
            <span class="txtBusqueda">Se encontraron {{ $numeroDeRegulaciones }} resultados</span>
            <a href="#" class="busqueda-avanzada" onclick="toggleAdvancedSearch(event)">
                Búsqueda avanzada
                <i class="fas fa-arrow-down flecha"></i>
            </a>
        </div>

        <div id="mostrarFiltros" style="display: none;" class="filtros-container">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Desde</label>
                        <input type="text" 
                               class="form-control" 
                               placeholder="dd/mm/aaaa" 
                               onfocus="(this.type='date')"
                               onblur="if(!this.value)this.type='text'">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Hasta</label>
                        <input type="text" 
                               class="form-control" 
                               placeholder="dd/mm/aaaa"
                               onfocus="(this.type='date')"
                               onblur="if(!this.value)this.type='text'">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">Dependencia</label>
                        <select class="form-control">
                            <option value="">Seleccione una dependencia</option>
                            @foreach ($dependencias as $dependencia)
                                <option value="{{ $dependencia['nombre_sujeto'] }}">
                                    {{ $dependencia['nombre_sujeto'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6 mx-auto">
                    <div class="form-group">
                        <label class="form-label">Tipo de ordenamiento</label>
                        <select class="form-control">
                            <option value="">Seleccione un tipo de ordenamiento</option>
                            @foreach ($tiposOrdenamiento as $tipo)
                                <option value="{{ $tipo['Tipo_Ordenamiento'] }}">
                                    {{ $tipo['Tipo_Ordenamiento'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="button" class="btn-buscar">Buscar</button>
            </div>
        </div>
    </div>
</div>

<div class="cards-container">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="consulta-card">
                <div class="consulta-header">
                    <h5>Inspectores</h5>
                </div>
                <div class="consulta-body">
                    <p class="consulta-text">
                        Consulta la lista de Inspectores(as), Verificadores(as) y Visitadores(as).
                    </p>
                    <div class="consulta-footer">
                        <a href="{{ base_url('ver-inspectores') }}" class="btn-consultar">Consultar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="consulta-card">
                <div class="consulta-header">
                    <h5>Inspecciones</h5>
                </div>
                <div class="consulta-body">
                    <p class="consulta-text">
                        Consulta la información de Inspecciones, Verificaciones y Visitas Domiciliarias.
                    </p>
                    <div class="consulta-footer">
                        <a href="{{ base_url('ver-inspecciones') }}" class="btn-consultar">Consultar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="consulta-card">
                <div class="consulta-header">
                    <h5>Estadísticas</h5>
                </div>
                <div class="consulta-body">
                    <p class="consulta-text">
                        Consulta las estadísticas de Inspecciones, Verificaciones y Visitas Domiciliarias.
                    </p>
                    <div class="consulta-footer">
                        <a href="{{ base_url('ver-estadisticas') }}" class="btn-consultar">Consultar</a>
                    </div>
                </div>
            </div>
        </div>
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