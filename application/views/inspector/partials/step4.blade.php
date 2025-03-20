<!-- Step 4: Emergencias -->
<div id="step-4" class="form-step active">
    <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">
        Emergencias
    </h3>
    <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0;">
        Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
    </h5>
    <div class="form-group">
        <label>¿El inspector es requerido para atender una situación de emergencia?</label>
        <select name="emergencias[Es_Emergencia]" class="form-control" required>
            <option value="No" selected>No</option>
            <option value="Si">Si</option>
        </select>
    </div>
    <div class="form-group">
        <label>Justificar las razones para habilitar al inspector(a) en una emergencia</label>
        <textarea name="emergencias[Justificacion]" class="form-control" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label>Cargar el oficio o acta de declaración de emergencia (PDF, PNG, JPG)</label>
        <input type="file" name="emergencias[Archivo_Oficio]" class="form-control-file" accept=".pdf,.jpg,.png">
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
