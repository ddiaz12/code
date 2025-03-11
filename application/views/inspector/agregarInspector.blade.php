@layout('templates/master')
@section('titulo')
    {{ isset($inspector) ? 'Editar Inspector' : 'Agregar Inspector' }}
@endsection
@section('navbar')
    @include('templates/navbarAdmin')
@endsection
@section('menu')
    @include('templates/menuAdmin')
@endsection
@section('contenido')

@if ($this->session->flashdata('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '<?= $this->session->flashdata('success') ?>',
            showConfirmButton: false,
            timer: 2000
        }).then(() => {
            window.location.href = '<?= base_url("inspectores") ?>';
        });
    </script>
@endif

<!-- Breadcrumb -->
<ol class="breadcrumb mb-4 mt-5" style="margin-left: 5px;">
    <li class="breadcrumb-item">
        <a href="<?php echo base_url('home'); ?>" class="text-decoration-none">
            <i class="fas fa-home me-1"></i>Home
        </a>
    </li>
    <li class="breadcrumb-item">
        <i class="fas fa-file-alt me-1"></i>Inspectores
    </li>
    <li class="breadcrumb-item">
        <i class="fas fa-plus-circle me-1"></i>{{ isset($inspector) ? 'Editar Inspector' : 'Agregar Inspector' }}
    </li>
</ol>

<div class="container-fluid px-4">
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
                            <i class="' . $step["icon"] . ' me-2"></i>' . $step["label"] . '
                          </button>';
                }
                ?>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 main-content">
            <div class="card">
                <div class="card-body">
                    <?php echo form_open_multipart('inspectores/guardar', ['id' => 'inspectorForm', 'class' => 'needs-validation', 'novalidate' => '']); ?>
                    <?php if(isset($inspector)): ?>
                        <?php echo form_hidden('Inspector_ID', $inspector->Inspector_ID); ?>
                    <?php endif; ?>

                    <!-- Incluir los steps desde la carpeta "partials" -->
                    <div id="wizardSteps">
                        @include('inspector/partials/step1')
                        @include('inspector/partials/step2')
                        @include('inspector/partials/step3')
                        @include('inspector/partials/step4')
                    </div>

                    <!-- Botones de navegación -->
                    <div class="form-navigation">
                        <button type="button" class="btn" id="prevBtn" onclick="navigateStep(-1)">Regresar</button>
                        <button type="button" class="btn" id="nextBtn" onclick="navigateStep(1)">Siguiente</button>
                        <button type="submit" class="btn" id="submitBtn" style="display: none;">Guardar todo</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Estilos personalizados -->
<style>
    :root {
        --primary-color: #8E354A;
        --border-color: #E5E7EB;
        --background-color: #F9FAFB;
        --text-color: #374151;
        --heading-color: #111827;
    }
    .main-content { margin-top: 20px; }
    .card { border: 1px solid var(--border-color); border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
    .card-body { padding: 1.5rem; }
    .form-step { display: none; }
    .form-step.active { display: block; }
    .sidebar-wizard { background: white; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
    .wizard-step { border: none !important; color: var(--text-color); padding: 1rem 1.5rem; margin-bottom: 0.5rem; border-radius: 0.375rem !important; transition: all 0.2s; }
    .wizard-step:hover { background-color: #F3F4F6; }
    .wizard-step.active { background-color: var(--primary-color) !important; color: white; }
    .form-navigation { margin-top: 2rem; padding-top: 1rem; border-top: 1px solid var(--border-color); display: flex; justify-content: space-between; gap: 1rem; }
    .form-navigation .btn { padding: 8px 24px; border-radius: 4px; font-weight: 500; border: none; }
    #prevBtn { background-color: #6B7280; color: white; }
    #nextBtn { background-color: #4A0404; color: white; }
    #submitBtn { background-color: rgb(76, 228, 134); color: white; }
</style>

<!-- Scripts: Asegúrate del orden: primero los específicos de cada step, luego la validación global -->
<script src="{{ base_url('assets/js/inspectoresSteps/step1.js') }}"></script>
<script src="{{ base_url('assets/js/inspectoresSteps/step2.js') }}"></script>
<script src="{{ base_url('assets/js/inspectoresSteps/step3.js') }}"></script>
<script src="{{ base_url('assets/js/inspectoresSteps/step4.js') }}"></script>
<script src="{{ base_url('assets/js/inspectoresSteps/validateStepInspectores.js') }}"></script>

@endsection
@section('footer')
    @include('templates/footer')
@endsection
