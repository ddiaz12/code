@layout('templates/master')
@section('titulo')
    Registro Estatal de Regulaciones
@endsection
@section('navbar')
    @include('templates/navbarConsejeria')
@endsection
@section('menu')
    @include('templates/menuConsejeria')
@endsection
@section('contenido')
    <!-- Contenido -->
    <div class="container-fluid px-4">
        <ol class="breadcrumb mb-4 mt-5">
            <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active"><i class="fas fa-envelope me-1"></i>Enviadas</li>
        </ol>
        <h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER)</h1>
        <!-- Botón para abrir otra vista -->
        <!--<div class="d-flex justify-content-end mb-3">
            <a href="<?php echo base_url(''); ?>" class="btn btn-primary btn-agregarOficina">
            <i class="fas fa-download me-1"></i> Descargar excel
            </a>
        </div>-->

        <div class="card mb-4 div-datatables">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th class="tTabla-color">Nombre</th>
                            <th class="tTabla-color">Homoclave</th>
                            <th class="tTabla-color">Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enviadas as $enviada)
                            <tr>
                                <td>{{ $enviada->Nombre_Regulacion }}</td>
                                <td>{{ $enviada->Homoclave }}</td>
                                <td>
                                    @if ($enviada->Estatus == 0)
                                        Regulación devuelta a Sujeto Obligado
                                    @elseif ($enviada->publicada == 1)
                                        Regulación publicada
                                    @elseif ($enviada->publicada == 0)
                                        Regulación despublicada
                                    @else
                                        {{ $enviada->Estatus }}
                                    @endif
                                </td>
                            </tr>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Contenido -->
@endsection
@section('footer')
    @include('templates/footer')
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#datatablesSimple').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                }
            });
        });
    </script>

@endsection
