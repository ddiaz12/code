@layout('templates/master')
@section('titulo')
    Registro Estatal de Regulaciones
@endsection
@section('navbar')
    @include('templates/navbarAdmin')
@endsection
@section('menu')
    @include('templates/menuAdmin')
@endsection
@section('contenido')
    <!-- Contenido -->
    <div class="container-fluid px-4 ">
        <h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER)</h1>
        <div class="row no-padding">
            <div class="card shadow mb-4 col-sm-5 div-card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-cards">Regulaciones</h6>
                </div>
                <div class="card-body ">
                    Administrar usuarios de la plataforma del Catálogo Nacional de
                    Trámites y Servicios.
                </div>
                <div class="card-footer text-center">
                    <a href="<?php echo base_url('regulaciones'); ?>" class="btn btn-primary btn-oficina">administrar</a>
                </div>
            </div>
            <div class="card shadow mb-4 col-sm-5 div-card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-cards">Oficinas</h6>
                </div>
                <div class="card-body ">
                    Administrar usuarios de la plataforma del Catálogo Nacional de
                    Trámites y Servicios.
                </div>
                <div class="card-footer text-center">
                    <a href="<?php echo base_url('oficinas'); ?>" class="btn btn-primary btn-oficina">administrar</a>
                </div>
            </div>
            <div class="card shadow mb-4 col-sm-5 div-card">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-cards">Usuarios</h6>
                </div>
                <div class="card-body">
                    Administrar usuarios de la plataforma del Catalogo Nacional
                    de Tramites y Servicios.
                </div>
                <div class="card-footer text-center">
                    <a href="<?php echo base_url('auth'); ?>" class="btn btn-primary btn-oficina">administrar</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Contenido -->
@endsection
@section('footer')
    @include('templates/footer')
@endsection
