<!-- Step 4: Emergencias -->
<div id="step-4" class="form-step">
    <!-- Contenido del Step 4 -->
    <h3 class="card-title" style="background-color: #8E354A; color: white; padding: 10px; border-radius: 10px;">Emergencias</h3>
    <h5 class="alert alert-warning" style="color: grey; font-size: 14px; padding: 10px; margin: 0; box-sizing: border-box;">
        Atención: Esta ficha debe ser requisitada con el uso de letras mayúsculas y minúsculas.
    </h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="es_emergencia">¿El inspector es requerido para atender una situación de emergencia?</label>
                <?php echo form_checkbox([
                    'name' => 'es_emergencia', 
                    'id' => 'es_emergencia', 
                    'class' => 'form-check-input', 
                    'checked' => isset($inspector->es_emergencia) ? $inspector->es_emergencia : false
                ]); ?>
            </div>
            <div class="form-group">
                <label for="justificacion_emergencia">Justificar las razones por las cuales se habilita un inspector(a) para atender una situación de emergencia.</label>
                <?php echo form_textarea([
                    'name' => 'justificacion_emergencia', 
                    'id' => 'justificacion_emergencia', 
                    'class' => 'form-control', 
                    'rows' => '3', 
                    'value' => isset($inspector->justificacion_emergencia) ? $inspector->justificacion_emergencia : ''
                ]); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="oficio_emergencia">Cargar el oficio o acta de declaración de emergencia (PDF, PNG, JPG).</label>
                <?php echo form_upload(['name' => 'oficio_emergencia', 'id' => 'oficio_emergencia', 'class' => 'form-control-file']); ?>
            </div>
        </div>
    </div>
</div>
