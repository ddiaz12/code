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
        <li class="breadcrumb-item active"><i class="fas fa-file me-1"></i>Regulaciones publicadas</li>
    </ol>
    <h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER)</h1>
    <div class="card mb-4 div-datatables">
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th class="tTabla-color">Id</th>
                        <th class="tTabla-color">Nombre</th>
                        <th class="tTabla-color">Homoclave</th>
                        <th class="tTabla-color">Estatus</th>
                        <th class="tTabla-color">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($publicadas as $publicada)
                        <tr>
                            <td>{{ $publicada->ID_Regulacion }}</td>
                            <td>{{ $publicada->Nombre_Regulacion }}</td>
                            <td>{{ $publicada->Homoclave }}</td>
                            <td>
                                @if ($publicada->publicada == 1)
                                    Regulación publicada
                                @endif
                            </td>
                            <td>
                                <a href="<?php    echo base_url('ciudadania/verRegulacion/' . $publicada->ID_Regulacion); ?>"
                                    class="btn btn-danger btn-sm">
                                    <i class="fas fa-eye" title="Ver regulacion"></i>
                                </a>
                                <button class="btn btn-warning btn-sm modificar-regulacion"
                                    data-id="<?php    echo $publicada->ID_Regulacion; ?>">
                                    <i class="fas fa-edit" title="Modificar regulación"></i>
                                </button>
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
    $(document).ready(function () {
        $('#datatablesSimple').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            }
        });
    });
    
    $('.modificar-regulacion').click(function () {
        var id = $(this).data('id');
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¿Quieres modificar la regulación?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '¡Sí, modificar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo base_url('ciudadania/modificarRegulacion/'); ?>" + id;
            }
        });
    });
</script>

@endsection