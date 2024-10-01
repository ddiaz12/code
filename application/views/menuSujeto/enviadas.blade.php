@layout('templates/master')
@section('titulo')
Registro Estatal de Regulaciones
@endsection
@section('navbar')
@include('templates/navbarSujeto')
@endsection
@section('menu')
@include('templates/menuSujeto')
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
    <div class="d-flex justify-content-end mb-3">
        <a href="<?php echo base_url(''); ?>" class="btn btn-primary btn-agregarOficina">
            <i class="fas fa-download me-1"></i> Descargar excel
        </a>
    </div>

    <div class="card mb-4 div-datatables">
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th class="tTabla-color">Id</th>
                        <th class="tTabla-color">Nombre</th>
                        <th class="tTabla-color">Homoclave</th>
                        <th class="tTabla-color">Estatus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($enviadas as $enviada)
                        <tr>
                            <td>{{ $enviada->ID_Regulacion }}</td>
                            <td>{{ $enviada->Nombre_Regulacion }}</td>
                            <td>{{ $enviada->Homoclave }}</td>
                            <td>
                                @if ($enviada->Estatus == 1)
                                    Regulación enviada a SEDECO
                                @elseif ($enviada->Estatus == 2)
                                    Regulación enviada a Consejería
                                @else
                                    {{ $enviada->Estatus }}
                                @endif
                            </td>
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
    $(document).ready(function () {
        $('#datatablesSimple').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            }
        });
    });

    $(document).ready(function () {
        $('.btn-danger').click(function () {
            var id = $(this).data('id_oficina');

            $.ajax({
                url: '<?php echo base_url('oficinas/eliminar_oficina/'); ?>' + id,
                type: 'POST',
                success: function (result) {
                    // Recargar la página o hacer algo con el resultado
                    location.reload();
                }
            });
        });
    });
</script>
@endsection