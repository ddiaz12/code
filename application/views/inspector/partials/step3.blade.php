<!-- Step 3: No publicidad -->
<div id="step-3" class="form-step">
    <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">No publicidad</h3>
    <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0; box-sizing: border-box;">
        Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
    </h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>¿Permitir que todos los datos del inspector, verificador o visitador sean públicos?</label>
                <?php echo form_dropdown('permitir_publicidad', ['si' => 'Sí', 'no' => 'No'], isset($inspector->permitir_publicidad) ? $inspector->permitir_publicidad : '', 'class="form-control"'); ?>
            </div>
            <div id="justificante_no_publicidad_container" class="form-group">
                <label for="justificante_no_publicidad">Justificante no publicidad (PDF, JPG, PNG)</label>
                <?php echo form_upload(['name' => 'justificante_no_publicidad', 'id' => 'justificante_no_publicidad', 'class' => 'form-control-file']); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div id="datos_no_publicar_container" class="form-group">
                <label>Determina la información de la ficha del Inspector(a) que no se puede publicar en el portal ciudadano:</label>
                <select class="form-control" name="datos_no_publicar[]" multiple>
                    <option value="nombre" <?php echo isset($inspector->datos_no_publicar) && in_array('nombre', $inspector->datos_no_publicar) ? 'selected' : ''; ?>>Nombre</option>
                    <option value="primer_apellido" <?php echo isset($inspector->datos_no_publicar) && in_array('primer_apellido', $inspector->datos_no_publicar) ? 'selected' : ''; ?>>Primer Apellido</option>
                    <option value="segundo_apellido" <?php echo isset($inspector->datos_no_publicar) && in_array('segundo_apellido', $inspector->datos_no_publicar) ? 'selected' : ''; ?>>Segundo Apellido</option>
                    <option value="fotografia" <?php echo isset($inspector->datos_no_publicar) && in_array('fotografia', $inspector->datos_no_publicar) ? 'selected' : ''; ?>>Fotografía</option>
                    <option value="cargo" <?php echo isset($inspector->datos_no_publicar) && in_array('cargo', $inspector->datos_no_publicar) ? 'selected' : ''; ?>>Cargo</option>
                </select>
            </div>
        </div>
    </div>
</div>