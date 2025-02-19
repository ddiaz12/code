@layout('templates/master')
@section('titulo')
    Registro Estatal de Regulaciones y Visitas Domiciliarias
@endsection
@section('navbar')
    @include('templates/navbarAdmin')
@endsection
@section('menu')
    @include('templates/menuAdmin')
@endsection
@section('contenido')

    <div class="container-fluid px-4">
        <ol class="breadcrumb mb-4 mt-5">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('home'); ?>" class="text-decoration-none">
                    <i class="fas fa-home me-1"></i>Home
                </a>
            </li>
            <li class="breadcrumb-item">Inspectores(as)</li>
        </ol>

        <h2 class="mt-4 text-center"><b>Registro Estatal de Visitas Domiciliarias (REVID)</b></h2>
        <h5 class="text-center fs-5 fst-italic mb-4">Inspectores(as), Verificadores(as) y Visitadores(as) Domiciliarios(as)
        </h5>

        <div style="height: 1.5cm;"></div>

        <div class="container-fluid px-4" style="max-width: calc(100% - 3cm); margin: 0 auto;">
            <div class="row align-items-center mb-3">
                <div class="col-12 col-md-8">
                    <p class="text-muted mb-0">
                        En este apartado encontrarás las Inspectores(as), Verificadores(as) y Visitadores(as)
                        Domiciliarios(as) que se encuentran en edición y/o revisión.
                    </p>
                </div>
                <div class="col-12 col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="<?php echo base_url('AgregarInspector/agregarInspector'); ?>" class="btn btn-warning">
                        <i class="fas fa-plus-circle me-1"></i> Agregar Inspector
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr style="background-color: #8E354A; color: white;">
                            <th class="text-center">ID</th>
                            <th class="text-center">Homoclave</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Primer Apellido</th>
                            <th class="text-center">Segundo Apellido</th>
                            <th class="text-center">Sujeto Obligado</th>
                            <th class="text-center">Unidad Administrativa</th>
                            <th class="text-center">Estatus</th>
                            <th class="text-center">Tipo</th>
                            <th class="text-center">Vigencia</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($inspectores))
                            @foreach ($inspectores as $inspector)
                                <tr>
                                    <td class="text-center">{{ $inspector->Inspector_ID ?? '' }}</td>
                                    <td class="text-center">{{ $inspector->Homoclave ?? '' }}</td>
                                    <td class="text-center">{{ $inspector->Nombre ?? '' }}</td>
                                    <td class="text-center">{{ $inspector->Apellido_Paterno ?? '' }}</td>
                                    <td class="text-center">{{ $inspector->Apellido_Materno ?? '' }}</td>
                                    <td class="text-center">{{ $inspector->Sujeto_Obligado ?? '' }}</td>
                                    <td class="text-center">{{ $inspector->Unidad_Administrativa ?? '' }}</td>
                                    <td class="text-center">{{ $inspector->Estatus ?? '' }}</td>
                                    <td class="text-center">{{ $inspector->Tipo ?? '' }}</td>
                                    <td class="text-center">{{ $inspector->Vigencia ?? '' }}</td>
                                    <td class="text-center">
                                        <a href="#" title="Enviar"><i class="fas fa-paper-plane"></i></a>
                                        <a href="<?= base_url('AgregarInspector/editarInspector/'.$inspector->Inspector_ID) ?>" title="Editar"><i class="fas fa-edit"></i></a>
                                        <a href="#" title="Trazabilidad"><i class="fas fa-route"></i></a>
                                        <a href="#" title="Agregar Comentarios"><i class="fas fa-comments"></i></a>
                                        <a href="#" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11" class="text-center py-3">No hay información disponible</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 767px) {
            .col-12.col-md-4.text-md-end {
                text-align: left !important;
            }
        }
    </style>

    <style>
        .btn-warning {
            background-color: #8E354A;
            border-color: #8E354A;
            color: #fff;
        }

        .breadcrumb-item a {
            color: #0d6efd;
        }

        .table th {
            font-weight: normal;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            table-layout: auto;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: middle; /* Cambiado a middle para centrar verticalmente */
            border-top: 1px solid #dee2e6;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center; /* Centrar el contenido de todas las celdas */
        }

        @media screen and (max-width: 767px) {

            .table th,
            .table td {
                white-space: normal;
                word-wrap: break-word;
            }
        }

        /* Eliminar flechas de ordenamiento */
        table.dataTable thead th {
            background-image: none !important;
            padding-right: 15px !important;
        }

        /* Eliminar todos los indicadores de ordenamiento */
        table.dataTable thead .sorting,
        table.dataTable thead .sorting_asc,
        table.dataTable thead .sorting_desc,
        table.dataTable thead .sorting_asc_disabled,
        table.dataTable thead .sorting_desc_disabled {
            background: none !important;
        }
    </style>

    <script>
        $(document).ready(function () {
            // Inicializar DataTables con configuración en español
            $('.table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                },
                "ordering": false,  // Deshabilitar el ordenamiento
                "paging": false,
                "searching": false,
                "info": false,
                "columnDefs": [
                    { "orderable": false, "targets": '_all' }  // Hacer todas las columnas no ordenables
                ]
            });
        });
    </script>

@endsection
@section('footer')
    @include('templates/footer')
@endsection