<!-- Step 4: Emergencias -->
<div id="step-4" class="form-step active">
    <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">
        Emergencias
    </h3>
    <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0;">
        Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
    </h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="es_emergencia"></label>¿El inspector es requerido para atender una situación de emergencia?</label>
                <?php echo form_checkbox([
                    'name' => 'es_emergencia', 
                    'id' => 'es_emergencia', 
                    'class' => 'form-check-input', 
                    'checked' => isset($inspector->es_emergencia) ? $inspector->es_emergencia : false
                ]); ?>
            </div>
            <div class="form-group">
                <label for="justificacion_emergencia">Justificar las razones para habilitar al inspector(a) en una emergencia <span class="text-danger">*</span></label>
                <?php echo form_textarea([
                    'name' => 'justificacion_emergencia', 
                    'id' => 'justificacion_emergencia', 
                    'class' => 'form-control', 
                    'rows' => '3', 
                    'required' => 'required',
                    'value' => isset($inspector->justificacion_emergencia) ? $inspector->justificacion_emergencia : ''
                ]); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="oficio_emergencia">Cargar el oficio o acta de declaración de emergencia (PDF, PNG, JPG)</label>
                <?php echo form_upload([
                    'name' => 'oficio_emergencia', 
                    'id' => 'oficio_emergencia', 
                    'class' => 'form-control-file'
                ]); ?>
            </div>
        </div>
    </div>
</div>

<script>
    // Función de validación para el Step 4 (Emergencias)
    function validateEmergencias() {
        let valid = true;
        // Validar los campos requeridos dentro de #step-4
        $('#step-4 [required]').each(function() {
            if ($(this).val().trim() === '') {
                $(this).addClass('is-invalid');
                valid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        if (!valid) {
            Swal.fire({
                icon: 'error',
                title: 'Campos requeridos',
                text: 'Por favor, complete todos los campos obligatorios en este paso.',
                confirmButtonColor: '#8E354A'
            });
        }
        return valid;
    }
    window.validateEmergencias = validateEmergencias;
</script>
