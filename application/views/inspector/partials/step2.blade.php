<!-- Step 2: Datos del superior jerárquico -->
<div id="step-2" class="form-step">
    <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">Datos
        del Superior(a) Jerarquico(a)</h3>
    <h5 class="alert alert-warning"
        style="color: grey; font-size: 14px; padding: 10px; margin: 0; box-sizing: border-box;">
        Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
    </h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="buscar_superior">Buscar superior(a) jerárquico(a) <span class="text-danger">*</span></label>
                <?php echo form_input([
    'name' => 'buscar_superior',
    'id' => 'buscar_superior',
    'class' => 'form-control',
    'required' => 'required',
    'value' => isset($inspector->buscar_superior) ? $inspector->buscar_superior : ''
]); ?>
            </div>

            <div class="form-group">
                <label for="nombre_superior">Nombre(s)</label>
                <?php echo form_input([
    'name' => 'nombre_superior',
    'id' => 'nombre_superior',
    'class' => 'form-control',
    'value' => isset($inspector->nombre_superior) ? $inspector->nombre_superior : ''
]); ?>
            </div>

            <div class="form-group">
                <label for="apellido_paterno_superior">Apellido paterno</label>
                <?php echo form_input([
    'name' => 'apellido_paterno_superior',
    'id' => 'apellido_paterno_superior',
    'class' => 'form-control',
    'value' => isset($inspector->apellido_paterno_superior) ? $inspector->apellido_paterno_superior : ''
]); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="apellido_materno_superior">Apellido materno</label>
                <?php echo form_input([
    'name' => 'apellido_materno_superior',
    'id' => 'apellido_materno_superior',
    'class' => 'form-control',
    'value' => isset($inspector->apellido_materno_superior) ? $inspector->apellido_materno_superior : ''
]); ?>
            </div>

            <div class="form-group">
                <label for="telefono_superior">Teléfono de contacto</label>
                <?php echo form_input([
    'name' => 'telefono_superior',
    'id' => 'telefono_superior',
    'class' => 'form-control',
    'value' => isset($inspector->telefono_superior) ? $inspector->telefono_superior : ''
]); ?>
            </div>

            <div class="form-group">
                <label for="extension_superior">Extensión</label>
                <?php echo form_input([
    'name' => 'extension_superior',
    'id' => 'extension_superior',
    'class' => 'form-control',
    'value' => isset($inspector->extension_superior) ? $inspector->extension_superior : ''
]); ?>
            </div>
        </div>
    </div>
</div>

<script>
function validateStep2() {
    let valid = true;
    $('#step-2 [required]').each(function() {
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
</script>