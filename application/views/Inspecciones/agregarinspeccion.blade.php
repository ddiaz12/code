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
@if ($this->session->flashdata('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: '{{ $this->session->flashdata("success") }}',
        showConfirmButton: false,
        timer: 2000
    }).then(() => {
        window.location.href = '{{ base_url("inspectores") }}';
    });
</script>
@endif

<div class="container-fluid mt-4">
    <ol class="breadcrumb mb-4 mt-5" style="margin-left: 5px;">
        <li class="breadcrumb-item">
            <a href="{{ base_url('home') }}" class="text-decoration-none">
                <i class="fas fa-home me-1"></i> Home
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ base_url('Inspecciones') }}" class="text-decoration-none">
                <i class="fas fa-file-alt me-1"></i> Inspecciones
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <i class="fas fa-plus-circle me-1"></i> {{ isset($inspeccion) ? 'Editar Inspección' : 'Agregar Inspección' }}
        </li>
    </ol>

    <div class="row">
        <div class="col-md-3 sidebar-wizard">
            <div class="list-group">
                @foreach ($pasos as $index => $step)
                    <button class="list-group-item list-group-item-action wizard-step" data-step="{{ $index + 1 }}">
                        <i class="fas fa-check-circle me-2"></i> {{ $step }}
                    </button>
                @endforeach
            </div>
        </div>

        <div class="col-md-9 main-content">
            <form id="inspeccionForm" method="post" action="{{ base_url('InspeccionesController/guardar') }}" enctype="multipart/form-data">
                <input type="hidden" name="id_inspeccion" value="{{ isset($inspeccion) ? $inspeccion->id_inspeccion : '' }}">

                <div class="form-step" id="step-1">
                    <h3 class="card-title">Datos de Identificación</h3>
                    <div class="form-group">
                        <label>Homoclave</label>
                        <input type="text" name="Homoclave" class="form-control" value="{{ isset($inspeccion) ? $inspeccion->Homoclave : 'I-IPR-CTIH-0-IPR-0002' }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nombre de la Inspección <span class="text-danger">*</span></label>
                        <input type="text" name="Nombre_Inspeccion" class="form-control" required value="{{ isset($inspeccion) ? $inspeccion->Nombre_Inspeccion : '' }}">
                    </div>
                    <div class="form-group">
                        <label>Modalidad</label>
                        <input type="text" name="Modalidad" class="form-control" value="{{ isset($inspeccion) ? $inspeccion->Modalidad : '' }}">
                    </div>
                    <div class="form-group">
                        <label>Tipo de Inspección <span class="text-danger">*</span></label>
                        <select name="Tipo_Inspeccion" class="form-control" required>
                            <option value="">Selecciona</option>
                            @foreach($tipos_inspeccion as $tipo)
                                <option value="{{ $tipo }}" {{ $tipoSeleccionado == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-navigation">
                    <button type="button" class="btn btn-secondary" id="prevBtn" onclick="navigateStep(-1)">Anterior</button>
                    <button type="button" class="btn btn-primary" id="nextBtn" onclick="navigateStep(1)">Siguiente</button>
                    <button type="submit" class="btn btn-success" id="submitBtn" style="display:none;">{{ isset($inspeccion) ? 'Actualizar' : 'Guardar' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let currentStep = 1;
    const totalSteps = 9;

    function showStep(step) {
        $(".form-step").hide();
        $("#step-" + step).show();
        $(".wizard-step").removeClass("active");
        $(".wizard-step[data-step='" + step + "']").addClass("active");

        $("#prevBtn").toggle(step > 1);
        $("#nextBtn").toggle(step < totalSteps);
        $("#submitBtn").toggle(step === totalSteps);
        currentStep = step;
    }

    function navigateStep(direction) {
        if (currentStep + direction >= 1 && currentStep + direction <= totalSteps) {
            showStep(currentStep + direction);
        }
    }

    $(document).ready(function () {
        showStep(1);
        $(".wizard-step").click(function () {
            showStep($(this).data("step"));
        });
    });
</script>

@endsection