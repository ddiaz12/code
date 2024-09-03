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
        <li class="breadcrumb-item"><a href="<?php echo base_url("home") ?>"><i class="fas fa-home me-1"></i>Home</a>
        </li>
        <li class="breadcrumb-item active"><i class="fas fa-file-alt me-1"></i>Buzon</li>
    </ol>
    <!-- Botón para abrir otra vista -->
    <h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER)</h1>

    <div class="card mb-4 div-datatables">
        <div class="card-body">
            <table id="datatablesSimple">
            <thead>
                    <tr>
                        <th class="tTabla-color">Titulo</th>
                        <th class="tTabla-color">Mensaje</th>
                        <th class="tTabla-color">Fecha de envio</th>
                    </tr>
                <tbody>
                    <?php if (!empty($notificaciones)): ?>
                    <?php    foreach ($notificaciones as $notificacion): ?>
                    <tr>
                        <td><?php        echo $notificacion->titulo; ?></td>
                        <td><?php        echo $notificacion->mensaje; ?></td>
                        <td><?php echo $notificacion->fecha_envio ?></td>
                    </tr>
                    <?php    endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="2">No hay notificaciones disponibles.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('footer')
@include('templates/footer')
@endsection

@section('js')
<script src="<?php echo base_url('assets/js/tablaIdioma.js'); ?>"></script>
@endsection