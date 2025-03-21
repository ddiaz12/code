@layout('templates/master')
@section('titulo')
    {{ isset($inspeccion) ? 'Editar Inspección' : 'Agregar Inspección' }}
@endsection
@section('navbar')
    @include('templates/navbarSujeto')
@endsection
@section('menu')
    @include('templates/menuSujeto')
@endsection
@section('contenido')

@if($this->session->flashdata('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ $this->session->flashdata('success') }}',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#8E354A'
        });
    </script>
@endif

@if($this->session->flashdata('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ $this->session->flashdata('error') }}',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#8E354A'
        });
    </script>
@endif

<div class="container-fluid mt-4">
    <!-- Breadcrumb -->
    <ol class="breadcrumb mb-4 mt-5" style="margin-left: 5px;">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url('home'); ?>" class="text-decoration-none">
                <i class="fas fa-home me-1"></i>Home
            </a>
        </li>
        <li class="breadcrumb-item">
            <a href="<?php echo base_url('inspecciones'); ?>" class="text-decoration-none">
                <i class="fas fa-file-alt me-1"></i>Inspecciones
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <i class="fas fa-plus-circle me-1"></i>{{ isset($inspeccion) ? 'Editar Inspección' : 'Agregar Inspección' }}
        </li>
    </ol>

    <div class="row">
        <!-- Sidebar Wizard -->
        <div class="col-md-3 sidebar-wizard">
            <div class="list-group">
                <?php
                $steps = [
                    ["label" => "Datos de identificación", "icon" => "fa-solid fa-id-card"],
                    ["label" => "Autoridad Pública", "icon" => "fa-solid fa-user-shield"],
                    ["label" => "Información sobre la inspección", "icon" => "fa-solid fa-file-alt"],
                    ["label" => "Más detalles", "icon" => "fa-solid fa-info-circle"],
                    ["label" => "Información de la Autoridad Pública y Contacto", "icon" => "fa-solid fa-building"],
                    ["label" => "Estadísticas", "icon" => "fa-solid fa-chart-bar"],
                    ["label" => "Información adicional", "icon" => "fa-solid fa-list"],
                    ["label" => "No publicidad", "icon" => "fa fa-user-secret"],
                    ["label" => "Emergencias", "icon" => "fa-solid fa-exclamation-triangle"]
                ];
                foreach ($steps as $index => $step) {
                    $stepNumber = $index + 1;
                    echo '<button class="list-group-item list-group-item-action wizard-step" data-step="' . $stepNumber . '">
                            <i class="' . $step["icon"] . ' me-2"></i>' . $step["label"] . '</button>';
                }
                ?>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 main-content">
            <script>
                $(document).ready(function () {
                    $('label').css('font-weight', 'bold');
                });
            </script>

            <div class="form-container">
                <!-- Formulario principal -->
                <form id="inspeccionForm" novalidate method="post" action="<?= base_url('InspeccionesController/guardar'); ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id_inspeccion" value="{{ isset($inspeccion) && isset($inspeccion->ID) ? $inspeccion->ID : '' }}">

                    <!-- =================== STEP 1: Datos de identificación =================== -->
                    <div class="form-step" id="step-1">
                        @include('Inspecciones/partials/step1')
                    </div>

                    <!-- =================== STEP 2: Autoridad Pública =================== -->
                    <div class="form-step" id="step-2">
                        @include('Inspecciones/partials/step2')
                    </div>

                    <!-- =================== STEP 3: Información sobre la inspección =================== -->
                    <div class="form-step" id="step-3">
                        @include('Inspecciones/partials/step3')
                    </div>

                    <!-- =================== STEP 4: Más detalles =================== -->
                    <div class="form-step" id="step-4">
                        @include('Inspecciones/partials/step4')
                    </div>

                    <!-- =================== STEP 5: Información de la Autoridad Pública y Contacto =================== -->
                    <div class="form-step" id="step-5">
                        @include('Inspecciones/partials/step5')
                    </div>

                    <!-- =================== STEP 6: Estadísticas =================== -->
                    <div class="form-step" id="step-6">
                        @include('Inspecciones/partials/step6')
                    </div>

                    <!-- =================== STEP 7: Información adicional =================== -->
                    <div class="form-step" id="step-7">
                        @include('Inspecciones/partials/step7')
                    </div>

                    <!-- =================== STEP 8: No publicidad =================== -->
                    <div class="form-step" id="step-8">
                        @include('Inspecciones/partials/step8')
                    </div>

                    <!-- =================== STEP 9: Emergencias =================== -->
                    <div class="form-step" id="step-9">
                        @include('Inspecciones/partials/step9')
                    </div>

                    <!-- Botones de navegación -->
                    <div class="form-navigation">
                        <button type="button" class="btn" id="prevBtn" onclick="navigateStep(-1)">Anterior</button>
                        <button type="button" class="btn" id="nextBtn" onclick="navigateStep(1)">Siguiente</button>
                        <button type="submit" class="btn" id="submitBtn" style="display:none;">
                            {{ isset($inspeccion) ? 'Actualizar' : 'Guardar' }}
                        </button>
                    </div>
                </form>
                <!-- Nueva sección para manejar el envío del formulario vía AJAX -->
                <script>
                    // Nueva función para recolectar y guardar datos de los 9 steps
                    function guardarInspeccionDatos(form) {
                        var formData = new FormData(form);
                        // Opcional: agregar validaciones adicionales de cada step aquí
                        $.ajax({
                            url: $(form).attr('action'),
                            type: $(form).attr('method'),
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Éxito!',
                                    text: 'Inspección guardada correctamente.',
                                    confirmButtonColor: '#8E354A'
                                }).then(function() {
                                    window.location.href = '<?= base_url("InspeccionesController/index") ?>';
                                });
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'No se pudo guardar la inspección. ' + errorThrown,
                                    confirmButtonColor: '#8E354A'
                                });
                            }
                        });
                    }

                    $(document).ready(function(){
                        $('#inspeccionForm').on('submit', function(e){
                            e.preventDefault(); // Prevenir el envío normal
                            guardarInspeccionDatos(this);
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>

<!-- ========================= ESTILOS ========================= -->
<style>
    :root {
        --primary-color: #8E354A;
        --border-color: #E5E7EB;
        --background-color: #F9FAFB;
        --text-color: #374151;
        --heading-color: #111827;
    }
    .container-fluid {
        background-color: var(--background-color);
        min-height: 100vh;
        padding-top: 1rem;
    }
    .main-content {
        margin-top: 0;
    }
    .form-container {
        padding: 1.5rem;
        margin: 0 0.5cm;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    .sidebar-wizard {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    .wizard-step {
        border: none !important;
        color: var(--text-color);
        padding: 1rem 1.5rem;
        margin-bottom: 0.5rem;
        border-radius: 0.375rem !important;
        transition: all 0.2s;
    }
    .wizard-step:hover {
        background-color: #F3F4F6;
    }
    .wizard-step.active {
        background-color: var(--primary-color) !important;
        color: white;
    }
    .form-step {
        display: none; /* Por defecto, se ocultan */
    }
    .form-step.active {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 1rem;
    }
    .form-step > h3,
    .form-step > h5,
    .form-step > .full-width {
        grid-column: 1 / -1;
    }
    .form-control {
        width: 100%;
        max-width: 500px;
        padding: 0.375rem 0.5rem;
        font-size: 0.9rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }
    textarea.form-control {
        min-height: 60px;
        max-height: 120px;
        resize: vertical;
    }
    select.form-control {
        width: 100%;
        max-width: 500px;
        padding: 0.375rem 0.5rem;
        font-size: 0.9rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }
    .form-group {
        margin-bottom: 0.5rem !important;
    }
    .form-group label {
        display: block;
        margin-bottom: 0.25rem;
        font-size: 0.9rem;
        font-weight: bold;
        text-align: left;
    }
    @media (max-width: 768px) {
        .form-step.active {
            grid-template-columns: 1fr;
        }
        .statistics-row {
            flex-direction: column;
            gap: 10px;
        }
        .statistics-item {
            width: 100%;
        }
    }
    .form-navigation {
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        padding-bottom: 1rem;
    }
    .form-navigation .btn {
        padding: 8px 24px;
        border-radius: 4px;
        font-weight: 500;
        transition: all 0.2s;
        border: none;
    }
    #prevBtn {
        background-color: #6B7280;
        color: white;
    }
    #prevBtn:hover {
        background-color: #4B5563;
    }
    #nextBtn {
        background-color: #4A0404;
        color: white;
    }
    #nextBtn:hover {
        background-color: #3A0303;
    }
    #submitBtn {
        background-color: rgb(76, 228, 134);
        color: white;
    }
    #submitBtn:hover {
        background-color: #3A0303;
    }
    .form-navigation .btn:disabled {
        background-color: #D1D5DB;
        cursor: not-allowed;
        opacity: 0.7;
    }
    .statistics-container {
        width: 100%;
        max-width: 800px;
        margin-left: 0;
    }
    .statistics-row {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
    }
    .statistics-item {
        display: flex;
        align-items: center;
        width: 250px;
        flex-direction: column;
    }
    .mes-label {
        width: 100px;
        text-align: left;
        margin-right: 10px;
    }
    .statistics-input {
        width: 80px !important;
        padding: 0.375rem 0.5rem;
        font-size: 0.9rem;
    }
</style>

<!-- Incluir validateStep.js primero -->
<script src="<?= base_url('assets/js/insp_steps/validateStep.js'); ?>"></script>
<script src="<?= base_url('assets/js/insp_steps/step1.js'); ?>"></script>
<script src="<?= base_url('assets/js/insp_steps/step2.js'); ?>"></script>
<script src="<?= base_url('assets/js/insp_steps/step3.js'); ?>"></script>
<script src="<?= base_url('assets/js/insp_steps/step4.js'); ?>"></script>
<script src="<?= base_url('assets/js/insp_steps/step5.js'); ?>"></script>
<script src="<?= base_url('assets/js/insp_steps/step6.js'); ?>"></script>
<script src="<?= base_url('assets/js/insp_steps/step7.js'); ?>"></script>
<script src="<?= base_url('assets/js/insp_steps/step8.js'); ?>"></script>
<script src="<?= base_url('assets/js/insp_steps/step9.js'); ?>"></script>

<script>
    // La función showStep se define aquí, de forma única para controlar la visibilidad
    function showStep(step) {
        $('.form-step').removeClass('active');
        $('#step-' + step).addClass('active');
        
        // Actualizar la clase active en la sidebar
        $('.wizard-step').removeClass('active');
        $('.wizard-step[data-step="'+step+'"]').addClass('active');
        
        // Control de botones de navegación
        if (step === 1) {
            $('#prevBtn').hide();
        } else {
            $('#prevBtn').show();
        }
        if (step === totalSteps) {
            $('#nextBtn').hide();
            $('#submitBtn').show();
        } else {
            $('#nextBtn').show();
            $('#submitBtn').hide();
        }
        currentStep = step;
    }

    // Inicializa el primer step al cargar la página
    $(document).ready(function() {
        showStep(1);
    });
</script>
@endsection
