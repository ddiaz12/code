@layout('templates/masterCiudadania')
@section('titulo')
Estadísticas - Registro Estatal de Visitas Domiciliarias
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
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin: 3rem auto;
        max-width: 800px;
    }
    .input-buscador {
        border: 1px solid #C19C67 !important;
        border-radius: 20px !important;
        height: 38px;
    }
    .table-container {
        background-color: white;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin: 2rem auto;
        padding: 1.5rem;
        overflow-x: auto;
    }
    .table-inspecciones {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-bottom: 1rem;
    }
    .table-inspecciones th {
        background-color: #712F3E;
        color: white;
        padding: 1rem;
        text-align: left;
        font-weight: 500;
        white-space: nowrap;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
    .table-inspecciones td {
        padding: 1rem;
        border-bottom: 1px solid #e2e8f0;
        color: #4a5568;
    }
    .table-inspecciones tr:last-child td {
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }
    .table-inspecciones tr:hover {
        background-color: #f8fafc;
    }
    .text-center-cell {
        text-align: center;
    }
    .btn-container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
    }
    .btn-custom {
        background-color: #712F3E;
        color: white;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 20px;
        text-decoration: none;
        transition: background-color 0.2s;
    }
    .btn-custom:hover {
        background-color: #5a2632;
        color: white;
        text-decoration: none;
    }
    .btn-container-bottom {
        display: flex;
        justify-content: flex-end;
        margin-top: 1rem;
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
    <div class="header-section">
        <h1 class="text-center titulo-ciudadania">
            Registro Estatal de Visitas Domiciliarias (REVID)
        </h1>
        <h2 class="text-center subtitulo">
            Inspecciones, Verificaciones y Visitas Domiciliarias
        </h2>
        <p class="text-center descripcion">
            Consulta de las Inspecciones, Verificaciones y Visitas Domiciliarias en el Estado de Colima
        </p>
    </div>

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

    <div class="btn-container">
        <button class="btn-custom" onclick="descargarPDF()">Descargar PDF</button>
    </div>

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

    <div class="btn-container-bottom">
        <a href="{{ base_url('consulta-visitas-domiciliarias') }}" class="btn-custom">Regresar</a>
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

    function descargarPDF() {
        // Lógica para descargar la tabla en formato PDF
        // Puedes usar una librería como jsPDF para generar el PDF
        const doc = new jsPDF();
        doc.text("Inspecciones, Verificaciones y Visitas Domiciliarias", 10, 10);
        doc.autoTable({ html: '.table-inspecciones' });
        doc.save('inspecciones.pdf');
    }
</script>
@endsection

@section('footer')
@include('templates/footerCiudadania')
@endsection