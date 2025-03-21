@layout('templates/master')
@section('titulo')
    Registro Estatal de Regulaciones y Visitas Domiciliarias
@endsection
@section('navbar')
    @include('templates/navbarSujeto')
@endsection
@section('menu')
    @include('templates/menuSujeto')
@endsection
@section('contenido')
    <style>
        .container-main {
            padding: 0 2rem;
        }

        .breadcrumb {
            margin-top: 2rem;
            background: none;
        }

        .breadcrumb-item a {
            color: #000;
            /* Color negro */
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            color: #0d6efd;
            /* Color azul al pasar el cursor */
        }

        .titulo-principal {
            color: #333;
            font-weight: bold;
            margin: 2rem 0 1rem;
        }

        .subtitulo {
            color: #666;
            font-style: italic;
            margin-bottom: 1rem;
        }

        .descripcion {
            color: #666;
            margin-bottom: 2rem;
        }

        .btn-agregar {
            background-color: #8E354A;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }

        .btn-agregar:hover {
            background-color: #722c3c;
            color: white;
        }

        .table-container {
            clear: both;
        }

        .table thead th {
            background-color: #8E354A;
            color: white;
            font-weight: normal;
            vertical-align: middle;
            text-align: center;
            border: none;
        }

        .table tbody td {
            vertical-align: middle;
            text-align: center;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .action-icons a {
            margin: 0 5px;
            color: #333;
        }
    </style>

    <div class="container-main">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">
                    <a href="{{ base_url('home') }}">
                        <i class="fas fa-home me-1"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item">Inspecciones</li>
            </ol>
        </nav>

        <!-- Header Section -->
        <h1 class="text-center titulo-principal">Registro Estatal de Visitas Domiciliarias (REVID)</h1>
        <h2 class="text-center subtitulo">Inspecciones, Verificaciones y Visitas Domiciliarias</h2>
        <p class="text-center descripcion">
            En este apartado encontrarás las Inspecciones, Verificaciones y Visitas Domiciliarias que se encuentran en
            edición y/o revisión
        </p>

        <!-- Botón Agregar -->
        <div class="text-end">
            <a href="{{ base_url('InspeccionesController/form') }}" class="btn btn-agregar">
                <i class="fas fa-plus"></i> Agregar Inspección
            </a>
        </div>

        <!-- Tabla -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Homoclave</th>
                            <th>Nombre</th>
                            <th>Modalidad</th>
                            <th>Sujeto Obligado</th>
                            <th>Unidad Administrativa</th>
                            <th>Estatus</th>
                            <th>Tipo</th>
                            <th>Vigencia</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inspecciones as $inspeccion)
                            <tr>
                                <td>{{ $inspeccion['ID'] }}</td>
                                <td>{{ $inspeccion['Homoclave'] }}</td>
                                <td>{{ $inspeccion['Nombre'] }}</td>
                                <td>{{ $inspeccion['Modalidad'] }}</td>
                                <td>{{ $inspeccion['ID_sujeto'] }}</td>
                                <td>{{ $inspeccion['ID_unidad'] }}</td>
                                <td>{{ $inspeccion['Estatus'] }}</td>
                                <td>{{ $inspeccion['Tipo'] }}</td>
                                <td>{{ $inspeccion['Vigencia'] }}</td>
                                <td class="action-icons">
                                    <a href="{{ base_url('InspeccionesController/form/' . $inspeccion['ID']) }}" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ base_url('InspeccionesController/eliminar/' . $inspeccion['ID']) }}"
                                        title="Eliminar"
                                        onclick="return confirm('¿Estás seguro de eliminar esta inspección?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                    "emptyTable": "No hay datos disponibles en la tabla"
                },
                "ordering": false,
                "paging": false,
                "searching": false,
                "info": false,
                "columnDefs": [
                    { "orderable": false, "targets": '_all' }
                ]
            });
        });
    </script>
@endsection

@section('footer')
    @include('templates/footer')
@endsection