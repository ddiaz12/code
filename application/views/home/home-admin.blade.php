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
<!-- Contenido -->
<div class="container-fluid px-4" style="max-width: calc(100% - 6cm); margin: 0 auto;">
    <h1 class="mt-4 mb-4 titulo-menu">Escritorio de la Secretaria de Desarrollo Económico</h1>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
        <div class="col">
            <div class="card shadow h-100">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-cards text-center">Regulaciones</h6>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center" style="height: 80px; overflow-y: auto;">
                    <p class="card-text text-center mb-0" style="font-size: 0.85rem;">Administra cualquier normativa de carácter estatal.</p>
                </div>
                <div class="card-footer text-center py-2">
                    <a href="<?php echo base_url('RegulacionController'); ?>"
                        class="btn btn-primary btn-oficina btn-sm">Administrar</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow h-100">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-cards text-center">Inspecciones</h6>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center" style="height: 80px; overflow-y: auto;">
                    <p class="card-text text-center mb-0" style="font-size: 0.85rem;">Administra Inspecciones, Verificaciones y Visitas Domiciliarias.</p>
                </div>
                <div class="card-footer text-center py-2">
                    <a href="<?php echo base_url('visitas'); ?>" class="btn btn-primary btn-oficina btn-sm">Administrar</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow h-100">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-cards text-center">Inspectores</h6>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center" style="height: 80px; overflow-y: auto;">
                    <p class="card-text text-center mb-0" style="font-size: 0.85rem;">Administra Inspectores, Verificadores y Visitadores domiciliarios.</p>
                </div>
                <div class="card-footer text-center py-2">
                    <a href="<?php echo base_url('inspectores'); ?>" class="btn btn-primary btn-oficina btn-sm">Administrar</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow h-100">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-cards text-center">Oficinas</h>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center" style="height: 80px; overflow-y: auto;">
                    <p class="card-text text-center mb-0" style="font-size: 0.85rem;">Administra las oficinas de tu Dependencia.</p>
                </div>
                <div class="card-footer text-center py-2">
                    <a href="<?php echo base_url('oficinas'); ?>" class="btn btn-primary btn-oficina btn-sm">Administrar</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow h-100">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-cards text-center">Usuarios</h>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center" style="height: 80px; overflow-y: auto;">
                    <p class="card-text text-center mb-0" style="font-size: 0.85rem;">Administrar usuarios.</p>
                </div>
                <div class="card-footer text-center py-2">
                    <a href="<?php echo base_url('auth'); ?>" class="btn btn-primary btn-oficina btn-sm">Administrar</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow h-100">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-cards text-center">Estadísticas</h>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center" style="height: 80px; overflow-y: auto;">
                    <p class="card-text text-center mb-0" style="font-size: 0.85rem;">Administra estadísticas de Inspecciones, Verificaciones y Visitas Domiciliarias.</p>
                </div>
                <div class="card-footer text-center py-2">
                    <a href="<?php echo base_url('Estadisticas'); ?>" class="btn btn-primary btn-oficina btn-sm">Administrar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow h-100">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-cards text-center">Mesa de ayuda</h6>
                </div>
                <div class="card-body d-flex align-items-center justify-content-center" style="height: 80px; overflow-y: auto;">
                    <p class="card-text text-center mb-0" style="font-size: 0.85rem;">Administra incidencias del sistema.</p>
                </div>
                <div class="card-footer text-center py-2">
                    <a href="<?php echo base_url('ayuda'); ?>" class="btn btn-primary btn-oficina btn-sm">Administrar</a>
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