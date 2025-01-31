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
<div class="container-fluid mt-4">
    <ol class="breadcrumb mb-4 mt-5" style="margin-left: 5px;">
        <li class="breadcrumb-item">
            <a href="<?php echo base_url('home'); ?>" class="text-decoration-none">
                <i class="fas fa-home me-1"></i>Home
            </a>
        </li>
        <li class="breadcrumb-item"><i class="fas fa-file-alt me-1"></i>Inspecciones</li>
        <li class="breadcrumb-item"><i class="fas fa-plus-circle me-1"></i>Agregar</li>
    </ol>

    <div class="row">
        <!-- Sidebar Wizard -->
        <div class="col-md-3 sidebar-wizard">
            <div class="list-group">
                <?php
$steps = [
    ["label" => "Datos de identificación", "icon" => "fa-solid fa-id-card"],
    ["label" => "Datos del superior jerárquico", "icon" => "fa-solid fa-user-tie"],
    ["label" => "No publicidad", "icon" => "fa fa-user-secret"],
    ["label" => "Emergencias", "icon" => "fa-solid fa-exclamation-triangle"]
];

foreach ($steps as $index => $step) {
    $stepNumber = $index + 1;
    echo '<button class="list-group-item list-group-item-action wizard-step" data-step="' . $stepNumber . '">
                            <i class="' . $step["icon"] . ' me-2"></i>' .
        $step["label"] .
        '</button>';
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
            <div class="card">
                <div class="card-body">
                    <?php echo form_open_multipart('agregarinspector/guardar', ['id' => 'inspectorForm', 'class' => 'needs-validation', 'novalidate' => '']); ?>

                    <!-- Step 1: Datos de identificación -->
                    <div class="form-step" id="step-1">
                        <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px;">Datos de
                            identificación de Inspector(a), Verificador(a) y Visitador(a) Domiciliario(a)</h3>
                        <div class="alert alert-warning">
                            <h5 class="alert alert-warning"
                                style="color: grey; font-size: 14px; padding: 10px; margin: 0; box-sizing: border-box;">
                                Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
                            </h5>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombre(s) de servidor(a) público(a) <span
                                    class="text-danger">*</span></label>
                            <?php echo form_input(['name' => 'nombre', 'id' => 'nombre', 'class' => 'form-control', 'required' => 'required']); ?>
                        </div>

                        <div class="form-group">
                            <label for="primer_apellido">Primer Apellido <span class="text-danger">*</span></label>
                            <?php echo form_input(['name' => 'primer_apellido', 'id' => 'primer_apellido', 'class' => 'form-control', 'required' => 'required']); ?>
                        </div>

                        <div class="form-group">
                            <label for="segundo_apellido">Segundo Apellido <span class="text-danger">*</span></label>
                            <?php echo form_input(['name' => 'segundo_apellido', 'id' => 'segundo_apellido', 'class' => 'form-control', 'required' => 'required']); ?>
                        </div>

                        <div class="form-group">
                            <label for="fotografia">Fotografía (JPG, PDF o PNG) <span
                                    class="text-danger">*</span></label>
                            <?php echo form_upload(['name' => 'fotografia', 'id' => 'fotografia', 'class' => 'form-control-file', 'required' => 'required']); ?>
                        </div>

                        <div class="form-group">
                            <label for="numero_empleado">Número o clase del empleado <span
                                    class="text-danger">*</span></label>
                            <?php echo form_input(['name' => 'numero_empleado', 'id' => 'numero_empleado', 'class' => 'form-control', 'required' => 'required']); ?>
                        </div>

                        <div class="form-group">
                            <label for="cargo">Cargo del servidor público <span class="text-danger">*</span></label>
                            <?php echo form_input(['name' => 'cargo', 'id' => 'cargo', 'class' => 'form-control', 'required' => 'required']); ?>
                        </div>

                        <div class="form-group">
                            <label for="sujeto_obligado">Sujeto Obligado <span class="text-danger">*</span></label>
                            <?php echo form_input(['name' => 'sujeto_obligado', 'id' => 'sujeto_obligado', 'class' => 'form-control', 'required' => 'required']); ?>
                        </div>

                        <div class="form-group">
                            <label for="unidad_administrativa">Unidad administrativa <span
                                    class="text-danger">*</span></label>
                            <?php echo form_input(['name' => 'unidad_administrativa', 'id' => 'unidad_administrativa', 'class' => 'form-control', 'required' => 'required']); ?>
                        </div>

                        <div class="form-group">
                            <label for="telefono_oficial">Número telefónico oficial <span
                                    class="text-danger">*</span></label>
                            <?php echo form_input(['name' => 'telefono_oficial', 'id' => 'telefono_oficial', 'class' => 'form-control', 'required' => 'required']); ?>
                        </div>

                        <div class="form-group">
                            <label for="extension">Extensión <span class="text-danger">*</span></label>
                            <?php echo form_input(['name' => 'extension', 'id' => 'extension', 'class' => 'form-control', 'required' => 'required']); ?>
                        </div>

                        <div class="form-group">
                            <label for="correo_oficial">Correo electrónico oficial <span
                                    class="text-danger">*</span></label>
                            <?php echo form_input(['name' => 'correo_oficial', 'id' => 'correo_oficial', 'class' => 'form-control', 'required' => 'required']); ?>
                        </div>

                        <div class="form-group">
                            <label for="domicilio_dependencia">Domicilio de la dependencia al que está inscrito <span
                                    class="text-danger">*</span></label>
                            <?php echo form_input(['name' => 'domicilio_dependencia', 'id' => 'domicilio_dependencia', 'class' => 'form-control', 'required' => 'required']); ?>
                        </div>

                        <div class="form-group">
                            <label for="documento_cargo">Documento que acredite cargo o nombramiento (JPG, PNG o PDF)
                                <span class="text-danger">*</span></label>
                            <?php echo form_upload(['name' => 'documento_cargo', 'id' => 'documento_cargo', 'class' => 'form-control-file', 'required' => 'required']); ?>
                        </div>

                        <div class="form-group">
                            <label for="vigencia_cargo">Vigencia del cargo o nombramiento <span
                                    class="text-danger">*</span></label>
                            <?php echo form_input(['name' => 'vigencia_cargo', 'id' => 'vigencia_cargo', 'class' => 'form-control', 'required' => 'required']); ?>
                        </div>

                        <div class="form-group">
                            <label for="inspecciones_asociadas">Asociar servidor público con una o más inspecciones,
                                visita domiciliarias o verificaciones <span class="text-danger">*</span></label>
                            <?php echo form_input(['name' => 'inspecciones_asociadas', 'id' => 'inspecciones_asociadas', 'class' => 'form-control', 'required' => 'required']); ?>
                        </div>

                        <div class="form-group">
                            <label for="nombre_inspeccion">Nombre de la inspección <span
                                    class="text-danger">*</span></label>
                            <?php echo form_input(['name' => 'nombre_inspeccion', 'id' => 'nombre_inspeccion', 'class' => 'form-control', 'required' => 'required']); ?>
                        </div>

                        <div class="form-group">
                            <label for="inspecciones_facultadas">Inspecciones, verificaciones o visitas domiciliarias
                                que está facultado para realizar <span class="text-danger">*</span></label>
                            <?php echo form_input(['name' => 'inspecciones_facultadas', 'id' => 'inspecciones_facultadas', 'class' => 'form-control', 'required' => 'required']); ?>
                        </div>
                    </div>

                    <!-- Step 2: Datos del superior jerárquico -->
                    <div class="form-step" id="step-2" style="display: none;">
                        <div class="form-group">
                            <label for="buscar_superior">Buscar superior(a) jerárquico(a) <span
                                    class="text-danger">*</span></label>
                            <?php echo form_input(['name' => 'buscar_superior', 'id' => 'buscar_superior', 'class' => 'form-control', 'required' => 'required']); ?>
                        </div>

                        <div class="form-group">
                            <label for="nombre_superior">Nombre(s)</label>
                            <?php echo form_input(['name' => 'nombre_superior', 'id' => 'nombre_superior', 'class' => 'form-control']); ?>
                        </div>

                        <div class="form-group">
                            <label for="apellido_paterno_superior">Apellido paterno</label>
                            <?php echo form_input(['name' => 'apellido_paterno_superior', 'id' => 'apellido_paterno_superior', 'class' => 'form-control']); ?>
                        </div>

                        <div class="form-group">
                            <label for="apellido_materno_superior">Apellido materno</label>
                            <?php echo form_input(['name' => 'apellido_materno_superior', 'id' => 'apellido_materno_superior', 'class' => 'form-control']); ?>
                        </div>

                        <div class="form-group">
                            <label for="telefono_superior">Teléfono de contacto</label>
                            <?php echo form_input(['name' => 'telefono_superior', 'id' => 'telefono_superior', 'class' => 'form-control']); ?>
                        </div>

                        <div class="form-group">
                            <label for="extension_superior">Extensión</label>
                            <?php echo form_input(['name' => 'extension_superior', 'id' => 'extension_superior', 'class' => 'form-control']); ?>
                        </div>

                        <div class="form-group">
                            <label for="cargo_superior">Cargo</label>
                            <?php echo form_input(['name' => 'cargo_superior', 'id' => 'cargo_superior', 'class' => 'form-control']); ?>
                        </div>

                        <div class="form-group">
                            <label for="correo_superior">Correo electrónico</label>
                            <?php echo form_input(['name' => 'correo_superior', 'id' => 'correo_superior', 'class' => 'form-control']); ?>
                        </div>
                    </div>

                    <!-- Step 3: No publicidad -->
                    <div class="form-step" id="step-3" style="display: none;">

                        <div class="form-group">
                            <label>¿Permitir que todos los datos del inspector, verificador o visitador sean
                                públicos?</label>
                            <?php echo form_dropdown('permitir_publicidad', ['si' => 'Sí', 'no' => 'No'], '', 'class="form-control"'); ?>
                        </div>

                        <div class="form-group">
                            <label for="justificante_no_publicidad">Justificante no publicidad (PDF, JPG, PNG)</label>
                            <?php echo form_upload(['name' => 'justificante_no_publicidad', 'id' => 'justificante_no_publicidad', 'class' => 'form-control-file']); ?>
                        </div>

                        <div class="form-group">
                            <label>Determina la información de la ficha del Inspector(a) que no se puede publicar en el
                                portal ciudadano:</label>
                            <select class="form-control" name="datos_no_publicar[]" multiple>
                                <option value="nombre">Nombre</option>
                                <option value="primer_apellido">Primer Apellido</option>
                                <option value="segundo_apellido">Segundo Apellido</option>
                                <option value="fotografia">Fotografía</option>
                                <option value="cargo">Cargo</option>
                            </select>
                        </div>
                    </div>

                    <!-- Step 4: Emergencias -->
                    <div class="form-step" id="step-4" style="display: none;">
                        <div class="form-group">
                            <label for="es_emergencia">¿El inspector es requerido para atender una situación de
                                emergencia?</label>
                            <?php echo form_checkbox(['name' => 'es_emergencia', 'id' => 'es_emergencia', 'class' => 'form-check-input']); ?>
                        </div>

                        <div class="form-group">
                            <label for="justificacion_emergencia">Justificar las razones por las cuales se habilita un
                                inspector(a) para atender una situación de emergencia.</label>
                            <?php echo form_textarea(['name' => 'justificacion_emergencia', 'id' => 'justificacion_emergencia', 'class' => 'form-control', 'rows' => '3']); ?>
                        </div>

                        <div class="form-group">
                            <label for="oficio_emergencia">Cargar el oficio o acta de declaración de emergencia (PDF,
                                PNG, JPG).</label>
                            <?php echo form_upload(['name' => 'oficio_emergencia', 'id' => 'oficio_emergencia', 'class' => 'form-control-file']); ?>
                        </div>
                    </div>

                    <div class="form-navigation">
                        <button type="button" class="btn" id="prevBtn" onclick="navigateStep(-1)">Regresar</button>
                        <button type="button" class="btn" id="nextBtn" onclick="navigateStep(1)">Siguiente</button>
                        <button type="submit" class="btn" id="submitBtn" style="display:none;">Guardar todo</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-color: #8E354A;
        --border-color: #E5E7EB;
        --background-color: #F9FAFB;
        --text-color: #374151;
        --heading-color: #111827;
    }

    .main-content {
        margin-top: -100px;
    }

    .card {
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 1.5rem;
    }

    .form-step {
        display: none;
    }

    .form-step.active {
        display: block;
    }

    .form-control {
        padding: 0.375rem 0.5rem;
        min-height: unset;
    }

    textarea.form-control {
        min-height: 60px;
        max-height: 120px;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        margin-bottom: 0.25rem;
        font-size: 0.9rem;
    }

    .container-fluid {
        background-color: var(--background-color);
        min-height: 100vh;
        padding-top: 1rem;
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

    .form-navigation {
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: space-between;
        gap: 1rem;
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
</style>

<script>
    let currentStep = 1;
    const totalSteps = 4;

    function showStep(step) {
        $('.form-step').hide();
        $(`#step-${step}`).show();
        $('.wizard-step').removeClass('active');
        $(`.wizard-step[data-step="${step}"]`).addClass('active');

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

    function navigateStep(direction) {
        const newStep = currentStep + direction;
        if (newStep >= 1 && newStep <= totalSteps) {
            showStep(newStep);
        }
    }

    $(document).ready(function () {
        showStep(1);

        $('.wizard-step').click(function () {
            const step = $(this).data('step');
            showStep(step);
        });
    });

    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endsection