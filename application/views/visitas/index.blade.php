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
            <li class="breadcrumb-item">Inspecciones</li>
        </ol>

        <h2 class="mt-4 text-center"><b>Registro Estatal de Visitas Domiciliarias (REVID)</b></h2>
        <h5 class="text-center fs-5 fst-italic mb-4">Inspecciones, Verificaciones y Visitas Domiciliarias</h5>

        <!-- Eliminar o reducir el espacio extra -->
        <!-- <div style="height: 1.5cm;"></div> -->
        
        <div class="container-fluid px-4" style="max-width: calc(100% - 3cm); margin: 0 auto;">
            <div class="row align-items-center mb-3">
                <div class="col-12 col-md-8">
                    <p class="text-muted mb-0">
                        En este apartado encontrarás las Inspecciones, Verificaciones y Visitas Domiciliarias en edición y/o revisión.
                    </p>
                </div>
                <div class="col-12 col-md-4 text-md-end mt-3 mt-md-0">
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-download me-1"></i> Descargar
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="<?= base_url('visitas/descargar/pdf'); ?>?ids=<?= implode(',', array_column($inspecciones, 'id_inspeccion')); ?>">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= base_url('visitas/descargar/excel'); ?>?ids=<?= implode(',', array_column($inspecciones, 'id_inspeccion')); ?>">
                                    <i class="fas fa-file-excel"></i> Excel
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr style="background-color: #8E354A; color: white;">
                            <th class="text-center">ID</th>
                            <th class="text-center">Homoclave</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Modalidad</th>
                            <th class="text-center">Sujeto Obligado</th>
                            <th class="text-center">Unidad Administrativa</th>
                            <th class="text-center">Estatus</th>
                            <th class="text-center">Tipo</th>
                            <th class="text-center">Vigencia</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (empty($inspecciones))
                            <tr>
                                <td colspan="10" class="text-center py-3">No hay información disponible</td>
                            </tr>
                        @else
                            @foreach ($inspecciones as $inspeccion)
                                <tr>
                                    <td class="text-center">{{ $inspeccion['id_inspeccion'] }}</td>
                                    <td class="text-center">{{ $inspeccion['Homoclave'] }}</td>
                                    <td class="text-center">{{ $inspeccion['Nombre_Inspeccion'] }}</td>
                                    <td class="text-center">{{ $inspeccion['Modalidad'] }}</td>
                                    <td class="text-center">{{ $inspeccion['Sujeto_Obligado_ID'] }}</td>
                                    <td class="text-center">{{ $inspeccion['Unidad_Administrativa'] }}</td>
                                    <td class="text-center">{{ $inspeccion['Estatus'] }}</td>
                                    <td class="text-center">{{ $inspeccion['Tipo_Inspeccion'] }}</td>
                                    <td class="text-center">{{ $inspeccion['Vigencia'] }}</td>
                                    <td class="text-center">
                                        <a href="#" title="Enviar"><i class="fas fa-paper-plane"></i></a>
                                        <a href="<?= base_url('Agregarinspeccion/editar/'.$inspeccion['id_inspeccion']); ?>" title="Editar"><i class="fas fa-edit"></i></a>
                                        <a href="#" title="Trazabilidad"><i class="fas fa-route"></i></a>
                                        <a href="#" title="Agregar Comentarios"><i class="fas fa-comments"></i></a>
                                        <a href="#" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
                                        
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        /* Estilo similar a la vista de inspectores */
        .table td .fas {
            margin: 0 5px;
            color: #8E354A;
            font-size: 1rem;
            transition: transform 0.2s;
        }
        .table td .fas:hover {
            transform: scale(1.2);
            color: #6A2338;
        }
        .table td a {
            text-decoration: none;
        }
        .table th, 
        .table td {
            padding: 0.75rem;
            vertical-align: middle;
            border-top: 1px solid #dee2e6;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
        }
        @media screen and (max-width: 767px) {
            .table th, 
            .table td {
                white-space: normal;
                word-wrap: break-word;
            }
        }
        .btn-warning {
            background-color: #8E354A;
            border-color: #8E354A;
            color: #fff;
        }
        .breadcrumb-item a {
            color: #0d6efd;
        }
    </style>

    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
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
