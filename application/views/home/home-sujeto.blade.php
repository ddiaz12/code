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
<div class="container-fluid px-4 ">
    <h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER) y Visitas Domiciliarias</h1>
    <div class="row no-padding">
        <div class="card shadow mb-4 col-sm-5 div-card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-cards">Regulaciones</h6>
            </div>
            <div class="card-body ">
                Administrar normativas.
            </div>
            <div class="card-footer text-center">
                <a href="<?php echo base_url('regulacionController'); ?>"
                    class="btn btn-primary btn-oficina">Administrar</a>
            </div>
        </div>
        <div class="card shadow mb-4 col-sm-5 div-card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-cards">Unidades administrativas</h6>
            </div>
            <div class="card-body">
                Administrar Unidades administrativas.
            </div>
            <div class="card-footer text-center">
                <a href="<?php echo base_url('menu/menu_unidades'); ?>"
                    class="btn btn-primary btn-oficina">Administrar</a>
            </div>
        </div>
    </div>
</div>
<!-- Contenido -->
@endsection
@section('footer')
@include('templates/footer')
@endsection