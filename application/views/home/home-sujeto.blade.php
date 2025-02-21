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
<!-- Contenido -->
<div class="container-fluid px-4" style="max-width: calc(100% - 6cm); margin: 0 auto;">
    <h1 class="mt-4 mb-4 titulo-menu">Escritorio de la Secretaria de Desarrollo Económico</h1>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
        <!-- Regulaciones -->
        <div class="col">
            <div class="card shadow h-100">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-cards text-center">Regulaciones</h6>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center" style="height: 80px; overflow-y: auto;">
                    <p class="card-text text-center mb-0" style="font-size: 0.85rem;">Administra las normativas estatales.</p>
                </div>
                <div class="card-footer text-center py-2">
                    <a href="<?= base_url('regulacionController'); ?>" class="btn btn-primary btn-oficina btn-sm">Administrar</a>
                </div>
            </div>
        </div>
        <!-- Inspecciones -->
        <div class="col">
            <div class="card shadow h-100">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-cards text-center">Inspecciones</h6>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center" style="height: 80px; overflow-y: auto;">
                    <p class="card-text text-center mb-0" style="font-size: 0.85rem;">Administra inspecciones, verificaciones y visitas domiciliarias.</p>
                </div>
                <div class="card-footer text-center py-2">
                    <a href="<?= base_url('visitas'); ?>" class="btn btn-primary btn-oficina btn-sm">Administrar</a>
                </div>
            </div>
        </div>
        <!-- Inspectores -->
        <div class="col">
            <div class="card shadow h-100">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-cards text-center">Inspectores</h6>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center" style="height: 80px; overflow-y: auto;">
                    <p class="card-text text-center mb-0" style="font-size: 0.85rem;">Gestiona tus inspectores y verificadores.</p>
                </div>
                <div class="card-footer text-center py-2">
                    <a href="<?= base_url('inspectores'); ?>" class="btn btn-primary btn-oficina btn-sm">Administrar</a>
                </div>
            </div>
        </div>
        <!-- Unidades Administrativas -->
        <div class="col">
            <div class="card shadow h-100">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-cards text-center">Unidades Administrativas</h6>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center" style="height: 80px; overflow-y: auto;">
                    <p class="card-text text-center mb-0" style="font-size: 0.85rem;">Administra las unidades administrativas de tu dependencia.</p>
                </div>
                <div class="card-footer text-center py-2">
                    <a href="<?= base_url('menu/menu_unidades'); ?>" class="btn btn-primary btn-oficina btn-sm">Administrar</a>
                </div>
            </div>
        </div>
        <!-- Estadísticas -->
        <div class="col">
            <div class="card shadow h-100">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-cards text-center">Estadísticas</h6>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center" style="height: 80px; overflow-y: auto;">
                    <p class="card-text text-center mb-0" style="font-size: 0.85rem;">Consulta estadísticas de inspecciones y visitas.</p>
                </div>
                <div class="card-footer text-center py-2">
                    <a href="<?= base_url('Estadisticas'); ?>" class="btn btn-primary btn-oficina btn-sm">Administrar</a>
                </div>
            </div>
        </div>
        <!-- Mesa de ayuda -->
        <div class="col">
            <div class="card shadow h-100">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-cards text-center">Mesa de ayuda</h6>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center" style="height: 80px; overflow-y: auto;">
                    <p class="card-text text-center mb-0" style="font-size: 0.85rem;">Soporte e incidencias del sistema.</p>
                </div>
                <div class="card-footer text-center py-2">
                    <a href="<?= base_url('ayuda'); ?>" class="btn btn-primary btn-oficina btn-sm">Administrar</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contenido -->
@endsection
@section('footer')
@include('templates/footer')
@endsection