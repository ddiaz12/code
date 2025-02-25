@layout('templates/masterCiudadania')
@section('titulo')
Inspectores - Registro Estatal de Visitas Domiciliarias
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
    }
    .input-buscador {
        border: 1px solid #C19C67 !important;
        border-radius: 20px !important;
        height: 38px;
    }
    .input-group {
        max-width: 600px;
        margin: 0 auto;
    }
    .btn-search {
        background-color: #712F3E;
        border-color: #712F3E;
        border-radius: 0 20px 20px 0 !important;
        padding: 0.375rem 1rem;
    }
    .inspector-card {
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }
    .inspector-card:hover {
        transform: scale(1.05);
    }
    .inspector-img {
        width: 80px; /* Tamaño pequeño */
        height: 80px;
        border-radius: 50%; /* Esquinas redondeadas */
        object-fit: cover;
        margin-bottom: 10px;
    }
    .inspector-card .card-body {
        text-align: center;
    }
</style>

<div class="container-main">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Inspectores(as)</a></li>
            <li class="breadcrumb-item active">Inspecciones</li>
        </ol>
    </nav>

    <!-- Títulos -->
    <h1 class="text-center titulo-ciudadania">Registro Estatal de Visitas Domiciliarias (REVID)</h1>
    <h2 class="text-center subtitulo">Inspectores(as), Verificadores(as) y Visitadores (as) Domiciliarios(as)</h2>
    <p class="text-center descripcion">
        Consulta la información de los(las) Inspectores(as), Verificadores(as) y Visitadores (as) Domiciliarios(as) facultados(as) en el Estado de Colima
    </p>

    <!-- Buscador -->
    <div class="div-buscador">
        <div class="input-group mb-3">
            <input type="search" id="buscador" class="form-control input-buscador" placeholder="Buscar inspector por nombre...">
            <div class="input-group-append">
                <button class="btn btn-search" type="button">
                    <i class="fas fa-search text-white"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Contenedor de Inspectores -->
    <div class="row" id="inspectores-container">
        @foreach ($inspectores as $inspector)
            <div class="col-md-4">
                <div class="card inspector-card text-center p-3">
                    <img src="{{ base_url('uploads/inspectores/' . $inspector['Fotografia']) }}" alt="Foto de {{ $inspector['Nombre'] }}"
                        class="inspector-img">
                    <div class="card-body">
                        <h5 class="card-title">{{ $inspector['Nombre'] }} {{ $inspector['Apellido_Paterno'] }} {{ $inspector['Apellido_Materno'] }}</h5>
                        <p class="card-text"><strong>Dependencia:</strong> {{ $inspector['Dependencia'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $("#buscador").on("keyup", function () {
            var nombre = $(this).val();
            $.ajax({
                url: "{{ base_url('VerInspectoresController/buscarInspectores') }}",
                method: "POST",
                data: { nombreInspector: nombre },
                dataType: "json",
                success: function (data) {
                    $("#inspectores-container").html('');
                    if (data.length > 0) {
                        $.each(data, function (index, inspector) {
                            var card = `
                                <div class="col-md-4">
                                    <div class="card inspector-card text-center p-3">
                                        <img src="{{ base_url('uploads/inspectores/') }}${inspector.Fotografia}" alt="Foto de ${inspector.Nombre}"
                                            class="inspector-img">
                                        <div class="card-body">
                                            <h5 class="card-title">${inspector.Nombre} ${inspector.Apellido_Paterno} ${inspector.Apellido_Materno}</h5>
                                            <p class="card-text"><strong>Dependencia:</strong> ${inspector.Dependencia}</p>
                                        </div>
                                    </div>
                                </div>
                            `;
                            $("#inspectores-container").append(card);
                        });
                    } else {
                        $("#inspectores-container").html('<p class="text-center">No se encontraron resultados.</p>');
                    }
                }
            });
        });
    });
</script>
@endsection

@section('footer')
@include('templates/footerCiudadania')
@endsection